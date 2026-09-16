<?php
/**
 * Заявки (оформление заказа): хранение в админке, письмо и уведомление в Telegram.
 *
 * @package rowkz
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const ROWKZ_ORDER_STATUSES = array(
	'new'        => 'Новая',
	'in_work'    => 'В работе',
	'done'       => 'Выполнена',
	'cancelled'  => 'Отменена',
);

/* ---------------------------------------------------------------------------
 * Тип записи «Заявки»
 * ------------------------------------------------------------------------ */
add_action( 'init', function () {
	register_post_type( 'rk_order', array(
		'labels'          => array(
			'name'          => 'Заявки',
			'singular_name' => 'Заявка',
			'menu_name'     => 'Заявки',
			'edit_item'     => 'Заявка',
			'all_items'     => 'Все заявки',
			'search_items'  => 'Найти заявку',
			'not_found'     => 'Заявок пока нет',
		),
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'menu_position'   => 3,
		'menu_icon'       => 'dashicons-cart',
		'supports'        => array( 'title' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

add_filter( 'manage_rk_order_posts_columns', function () {
	return array(
		'cb'        => '<input type="checkbox" />',
		'title'     => 'Заявка',
		'rk_client' => 'Клиент',
		'rk_items'  => 'Товары',
		'rk_status' => 'Статус',
		'date'      => 'Дата',
	);
} );

add_action( 'manage_rk_order_posts_custom_column', function ( $column, $post_id ) {
	switch ( $column ) {
		case 'rk_client':
			$phone = get_post_meta( $post_id, '_rk_phone', true );
			$email = get_post_meta( $post_id, '_rk_email', true );
			echo esc_html( get_post_meta( $post_id, '_rk_name', true ) ) . '<br>';
			echo '<a href="tel:' . esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a><br>';
			echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
			break;
		case 'rk_items':
			$items = (array) get_post_meta( $post_id, '_rk_items', true );
			$count = array_sum( wp_list_pluck( $items, 'qty' ) );
			echo esc_html( sprintf( '%d поз. / %d шт.', count( $items ), $count ) );
			break;
		case 'rk_status':
			$status = get_post_meta( $post_id, '_rk_status', true ) ?: 'new';
			echo esc_html( ROWKZ_ORDER_STATUSES[ $status ] ?? $status );
			break;
	}
}, 10, 2 );

add_action( 'add_meta_boxes_rk_order', function () {
	add_meta_box( 'rk_order_details', 'Детали заявки', 'rowkz_order_metabox', 'rk_order', 'normal', 'high' );
} );

function rowkz_order_metabox( $post ) {
	$items  = (array) get_post_meta( $post->ID, '_rk_items', true );
	$status = get_post_meta( $post->ID, '_rk_status', true ) ?: 'new';
	$phone  = get_post_meta( $post->ID, '_rk_phone', true );
	$email  = get_post_meta( $post->ID, '_rk_email', true );
	wp_nonce_field( 'rk_order_status', 'rk_order_status_nonce' );
	?>
	<table class="form-table" role="presentation">
		<tr><th>Имя</th><td><?php echo esc_html( get_post_meta( $post->ID, '_rk_name', true ) ); ?></td></tr>
		<tr><th>Телефон</th><td><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></td></tr>
		<tr><th>Email</th><td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></td></tr>
		<tr><th>Комментарий</th><td><?php echo nl2br( esc_html( get_post_meta( $post->ID, '_rk_comment', true ) ) ); ?></td></tr>
		<tr><th>Статус</th><td>
			<select name="rk_status">
				<?php foreach ( ROWKZ_ORDER_STATUSES as $key => $label ) : ?>
					<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $status, $key ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</td></tr>
	</table>
	<h4>Товары</h4>
	<table class="widefat striped">
		<thead><tr><th>Товар</th><th style="width:80px">Кол-во</th></tr></thead>
		<tbody>
		<?php foreach ( $items as $item ) : ?>
			<tr>
				<td><a href="<?php echo esc_url( get_permalink( $item['id'] ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $item['title'] ); ?></a></td>
				<td><?php echo (int) $item['qty']; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php
}

add_action( 'save_post_rk_order', function ( $post_id ) {
	if ( ! isset( $_POST['rk_order_status_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['rk_order_status_nonce'] ), 'rk_order_status' ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) || empty( $_POST['rk_status'] ) ) {
		return;
	}
	$status = sanitize_key( $_POST['rk_status'] );
	if ( isset( ROWKZ_ORDER_STATUSES[ $status ] ) ) {
		update_post_meta( $post_id, '_rk_status', $status );
	}
} );

/* ---------------------------------------------------------------------------
 * Настройки: почта владельца и Telegram-бот
 * ------------------------------------------------------------------------ */
add_action( 'admin_menu', function () {
	add_submenu_page( 'edit.php?post_type=rk_order', 'Уведомления о заявках', 'Уведомления', 'manage_options', 'rk-order-settings', 'rowkz_order_settings_page' );
} );

add_action( 'admin_init', function () {
	register_setting( 'rk_orders', 'rk_order_email', array( 'type' => 'string', 'sanitize_callback' => 'sanitize_email' ) );
	register_setting( 'rk_orders', 'rk_tg_token', array( 'type' => 'string', 'sanitize_callback' => function ( $v ) {
		$v = trim( (string) $v );
		return preg_match( '/^\d+:[A-Za-z0-9_-]{30,}$/', $v ) ? $v : '';
	} ) );
	register_setting( 'rk_orders', 'rk_tg_chat_ids', array( 'type' => 'string', 'sanitize_callback' => function ( $v ) {
		$ids = preg_split( '/[\s,]+/', (string) $v, -1, PREG_SPLIT_NO_EMPTY );
		$ids = array_filter( $ids, function ( $id ) {
			return preg_match( '/^-?\d{3,20}$/', $id );
		} );
		return implode( ', ', $ids );
	} ) );
} );

function rowkz_order_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$notice = '';
	if ( isset( $_POST['rk_tg_action'] ) && check_admin_referer( 'rk_tg_tools' ) ) {
		$action = sanitize_key( $_POST['rk_tg_action'] );
		if ( 'test' === $action ) {
			$ok     = rowkz_telegram_send( "✅ Тестовое сообщение с сайта <b>" . esc_html( get_bloginfo( 'name' ) ) . "</b>. Уведомления о заявках работают." );
			$notice = $ok ? 'Тестовое сообщение отправлено.' : 'Не удалось отправить. Проверьте токен, chat id и что вы нажали /start у бота.';
		} elseif ( 'find' === $action ) {
			$notice = rowkz_telegram_find_chats();
		}
	}
	?>
	<div class="wrap">
		<h1>Уведомления о заявках</h1>
		<?php if ( $notice ) : ?><div class="notice notice-info"><p><?php echo wp_kses_post( $notice ); ?></p></div><?php endif; ?>
		<form method="post" action="options.php">
			<?php settings_fields( 'rk_orders' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="rk_order_email">Почта для заявок</label></th>
					<td><input name="rk_order_email" id="rk_order_email" type="email" class="regular-text" value="<?php echo esc_attr( get_option( 'rk_order_email', get_option( 'admin_email' ) ) ); ?>"></td>
				</tr>
				<tr>
					<th scope="row"><label for="rk_tg_token">Токен Telegram-бота</label></th>
					<td><input name="rk_tg_token" id="rk_tg_token" type="password" class="regular-text" autocomplete="off" value="<?php echo esc_attr( get_option( 'rk_tg_token', '' ) ); ?>">
						<p class="description">Создайте бота у <a href="https://t.me/BotFather" target="_blank" rel="noopener">@BotFather</a> командой /newbot и вставьте выданный токен.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="rk_tg_chat_ids">Chat ID получателей</label></th>
					<td><input name="rk_tg_chat_ids" id="rk_tg_chat_ids" type="text" class="regular-text" value="<?php echo esc_attr( get_option( 'rk_tg_chat_ids', '' ) ); ?>">
						<p class="description">Можно несколько через запятую. Откройте своего бота в Telegram, нажмите «Start», затем кнопку «Найти chat id» ниже.</p></td>
				</tr>
			</table>
			<?php submit_button( 'Сохранить' ); ?>
		</form>
		<form method="post">
			<?php wp_nonce_field( 'rk_tg_tools' ); ?>
			<button class="button" name="rk_tg_action" value="find">Найти chat id</button>
			<button class="button button-primary" name="rk_tg_action" value="test">Отправить тестовое сообщение</button>
		</form>
	</div>
	<?php
}

function rowkz_telegram_api( $method, $args = array() ) {
	$token = get_option( 'rk_tg_token', '' );
	if ( ! $token ) {
		return null;
	}
	$res = wp_remote_post( 'https://api.telegram.org/bot' . $token . '/' . $method, array(
		'timeout' => 8,
		'body'    => $args,
	) );
	if ( is_wp_error( $res ) ) {
		return null;
	}
	$data = json_decode( wp_remote_retrieve_body( $res ), true );
	return ( is_array( $data ) && ! empty( $data['ok'] ) ) ? $data['result'] : null;
}

function rowkz_telegram_send( $html ) {
	$ids = preg_split( '/[\s,]+/', (string) get_option( 'rk_tg_chat_ids', '' ), -1, PREG_SPLIT_NO_EMPTY );
	$ok  = false;
	foreach ( $ids as $chat_id ) {
		$r  = rowkz_telegram_api( 'sendMessage', array(
			'chat_id'                  => $chat_id,
			'text'                     => $html,
			'parse_mode'               => 'HTML',
			'disable_web_page_preview' => 'true',
		) );
		$ok = $ok || null !== $r;
	}
	return $ok;
}

function rowkz_telegram_find_chats() {
	if ( ! get_option( 'rk_tg_token' ) ) {
		return 'Сначала сохраните токен бота.';
	}
	$updates = rowkz_telegram_api( 'getUpdates' );
	if ( null === $updates ) {
		return 'Telegram не ответил. Проверьте токен.';
	}
	$chats = array();
	foreach ( $updates as $u ) {
		$chat = $u['message']['chat'] ?? ( $u['my_chat_member']['chat'] ?? null );
		if ( $chat ) {
			$name                  = $chat['title'] ?? trim( ( $chat['first_name'] ?? '' ) . ' ' . ( $chat['last_name'] ?? '' ) . ( isset( $chat['username'] ) ? ' @' . $chat['username'] : '' ) );
			$chats[ $chat['id'] ] = $name;
		}
	}
	if ( ! $chats ) {
		return 'Сообщений боту пока нет. Откройте бота в Telegram, нажмите «Start» и повторите.';
	}
	$out = 'Найдены чаты (скопируйте нужный ID в поле выше):<br>';
	foreach ( $chats as $id => $name ) {
		$out .= '<code>' . esc_html( $id ) . '</code> — ' . esc_html( $name ) . '<br>';
	}
	return $out;
}

/* ---------------------------------------------------------------------------
 * Приём заявки с сайта
 * ------------------------------------------------------------------------ */
add_action( 'wp_enqueue_scripts', function () {
	wp_localize_script( 'cart-script', 'rkCheckout', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'rk_checkout' ),
	) );
}, 20 );

add_action( 'wp_ajax_rk_checkout', 'rowkz_handle_checkout' );
add_action( 'wp_ajax_nopriv_rk_checkout', 'rowkz_handle_checkout' );

function rowkz_handle_checkout() {
	if ( ! check_ajax_referer( 'rk_checkout', 'nonce', false ) ) {
		wp_send_json_error( array( 'message' => 'Сессия устарела. Обновите страницу и попробуйте ещё раз.' ), 403 );
	}
	// Ловушка для ботов: скрытое поле должно быть пустым.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'order' => 0 ) );
	}

	$ip      = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$rl_key  = 'rk_co_' . md5( $ip );
	$attempt = (int) get_transient( $rl_key );
	if ( $attempt >= 5 ) {
		wp_send_json_error( array( 'message' => 'Слишком много заявок. Попробуйте через несколько минут или позвоните нам.' ), 429 );
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$comment = sanitize_textarea_field( wp_unslash( $_POST['comment'] ?? '' ) );
	$digits  = preg_replace( '/\D/', '', $phone );

	$errors = array();
	if ( mb_strlen( $name ) < 2 || mb_strlen( $name ) > 80 ) {
		$errors['name'] = 'Укажите имя.';
	}
	if ( strlen( $digits ) < 10 || strlen( $digits ) > 15 ) {
		$errors['phone'] = 'Укажите телефон в формате +7 700 000 00 00.';
	}
	if ( ! is_email( $email ) ) {
		$errors['email'] = 'Укажите корректный email.';
	}

	$raw_items = json_decode( wp_unslash( $_POST['items'] ?? '[]' ), true );
	$items     = array();
	foreach ( array_slice( (array) $raw_items, 0, 50 ) as $row ) {
		$id   = absint( $row['id'] ?? 0 );
		$qty  = max( 1, min( 99, absint( $row['qty'] ?? 1 ) ) );
		$post = $id ? get_post( $id ) : null;
		if ( $post && 'post' === $post->post_type && 'publish' === $post->post_status ) {
			$items[ $id ] = array( 'id' => $id, 'title' => get_the_title( $post ), 'qty' => $qty );
		}
	}
	if ( ! $items ) {
		$errors['items'] = 'Корзина пуста.';
	}
	if ( $errors ) {
		wp_send_json_error( array( 'message' => 'Проверьте поля формы.', 'fields' => $errors ), 422 );
	}
	set_transient( $rl_key, $attempt + 1, 10 * MINUTE_IN_SECONDS );
	$items = array_values( $items );

	$order_id = wp_insert_post( array(
		'post_type'   => 'rk_order',
		'post_status' => 'publish',
		'post_title'  => 'Заявка — ' . $name,
	), true );
	if ( is_wp_error( $order_id ) ) {
		wp_send_json_error( array( 'message' => 'Не удалось сохранить заявку. Позвоните нам, пожалуйста.' ), 500 );
	}
	wp_update_post( array( 'ID' => $order_id, 'post_title' => sprintf( 'Заявка №%d — %s', $order_id, $name ) ) );
	update_post_meta( $order_id, '_rk_name', $name );
	update_post_meta( $order_id, '_rk_phone', $phone );
	update_post_meta( $order_id, '_rk_email', $email );
	update_post_meta( $order_id, '_rk_comment', $comment );
	update_post_meta( $order_id, '_rk_items', $items );
	update_post_meta( $order_id, '_rk_status', 'new' );

	$admin_link = admin_url( 'post.php?post=' . $order_id . '&action=edit' );

	// Письмо владельцу.
	$lines = array();
	foreach ( $items as $it ) {
		$lines[] = sprintf( '— %s × %d', $it['title'], $it['qty'] );
	}
	$body = sprintf(
		"Новая заявка №%d с сайта %s\n\nИмя: %s\nТелефон: %s\nEmail: %s\n%s\nТовары:\n%s\n\nОткрыть в админке: %s",
		$order_id,
		home_url( '/' ),
		$name,
		$phone,
		$email,
		$comment ? "Комментарий: {$comment}\n" : '',
		implode( "\n", $lines ),
		$admin_link
	);
	wp_mail( get_option( 'rk_order_email', get_option( 'admin_email' ) ), sprintf( 'Новая заявка №%d — %s', $order_id, $name ), $body, array( 'Reply-To: ' . $name . ' <' . $email . '>' ) );

	// Telegram.
	$tg_items = '';
	foreach ( $items as $it ) {
		$tg_items .= '• ' . esc_html( $it['title'] ) . ' × ' . (int) $it['qty'] . "\n";
	}
	rowkz_telegram_send(
		'🛶 <b>Новая заявка №' . (int) $order_id . "</b>\n\n" .
		'👤 ' . esc_html( $name ) . "\n" .
		'📞 ' . esc_html( $phone ) . "\n" .
		'✉️ ' . esc_html( $email ) . "\n" .
		( $comment ? '💬 ' . esc_html( $comment ) . "\n" : '' ) .
		"\n<b>Товары:</b>\n" . $tg_items . "\n" .
		'<a href="' . esc_url( $admin_link ) . '">Открыть заявку</a>'
	);

	wp_send_json_success( array( 'order' => $order_id ) );
}
