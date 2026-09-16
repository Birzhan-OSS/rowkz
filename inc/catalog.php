<?php
/**
 * Каталог: AJAX-фильтр карточек по рубрикам + импорт товаров для администратора.
 *
 * @package rowkz
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Структура рубрик каталога — повторяет навигацию сайта.
 * slug => [ name, parent_slug ]
 */
function rowkz_catalog_structure() {
	return array(
		'lodki'             => array( 'Лодки', '' ),
		'trenirovochnye'    => array( 'Тренировочные', 'lodki' ),
		'racing-boats'      => array( 'Гоночные', 'lodki' ),
		'dlya-akademii'     => array( 'Для академии', 'lodki' ),
		'pribrezhnye'       => array( 'Для прибрежной гребли', 'lodki' ),
		'kayak'             => array( 'Каяк', 'lodki' ),
		'para'              => array( 'PARA-гребля', 'lodki' ),
		'vesla'             => array( 'Весла', '' ),
		'parnye-vesla'      => array( 'Парные вёсла', 'vesla' ),
		'raspashnye-vesla'  => array( 'Распашные вёсла', 'vesla' ),
		'vesla-kadetskie'   => array( 'Вёсла для кадетов и PARA', 'vesla' ),
		'trenazhery'        => array( 'Тренажеры', '' ),
		'grebnye-trenazhery' => array( 'Гребные тренажеры', 'trenazhery' ),
		'lyzhnye-trenazhery' => array( 'Лыжные тренажеры', 'trenazhery' ),
		'velotrenazhery'    => array( 'Велотренажеры', 'trenazhery' ),
		'silovye-trenazhery' => array( 'Силовые тренажеры', 'trenazhery' ),
		'komplektuyushhie'  => array( 'Комплектующие', '' ),
		'aksessuary'        => array( 'Аксессуары', '' ),
		'elektronika'       => array( 'Электроника (SpeedCoach)', 'aksessuary' ),
		'stellazhi'         => array( 'Стеллажи и хранение', 'aksessuary' ),
	);
}

/**
 * Ссылка на страницу, которой назначен указанный шаблон (например, 'template-contact.php').
 */
function rowkz_page_url( $template ) {
	static $cache = array();
	if ( ! isset( $cache[ $template ] ) ) {
		$pages              = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => $template, 'number' => 1, 'post_status' => 'publish' ) );
		$cache[ $template ] = $pages ? get_permalink( $pages[0] ) : home_url( '/' );
	}
	return $cache[ $template ];
}

/**
 * Картинка для плитки раздела на главной.
 * $prefer — фрагмент адреса исходной страницы товара (мета _rowkz_source_url), чьё фото лучше смотрится в плитке.
 * Если такого товара нет — берётся последний товар раздела с фото.
 */
function rowkz_category_cover( $slug, $prefer = '' ) {
	$cat = get_category_by_slug( $slug );
	if ( ! $cat ) {
		return '';
	}
	$args = array( 'cat' => $cat->term_id, 'numberposts' => 1, 'fields' => 'ids', 'meta_query' => array( array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ) ) );
	if ( $prefer ) {
		$pref = get_posts( array_merge( $args, array( 'meta_query' => array( 'relation' => 'AND', array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ), array( 'key' => '_rowkz_source_url', 'value' => $prefer, 'compare' => 'LIKE' ) ) ) ) );
		if ( $pref ) {
			return (string) get_the_post_thumbnail_url( $pref[0], 'large' );
		}
	}
	$posts = get_posts( $args );
	return $posts ? (string) get_the_post_thumbnail_url( $posts[0], 'large' ) : '';
}

/**
 * Создаёт рубрику (и родителя) если её нет. Возвращает term_id.
 */
function rowkz_ensure_category( $slug ) {
	$structure = rowkz_catalog_structure();
	$existing  = get_category_by_slug( $slug );
	if ( $existing ) {
		return (int) $existing->term_id;
	}
	if ( ! isset( $structure[ $slug ] ) ) {
		return 0;
	}
	list( $name, $parent_slug ) = $structure[ $slug ];
	$parent_id = $parent_slug ? rowkz_ensure_category( $parent_slug ) : 0;
	$term      = wp_insert_term( $name, 'category', array( 'slug' => $slug, 'parent' => $parent_id ) );
	return is_wp_error( $term ) ? 0 : (int) $term['term_id'];
}

/**
 * Карточка товара (используется в AJAX-выдаче).
 */
function rowkz_render_product_card() {
	$id    = get_the_ID();
	$title = get_the_title();
	$thumb = get_the_post_thumbnail_url( $id, 'thumbnail' );
	$cats  = get_the_category( $id );
	$cat   = $cats ? $cats[0]->name : '';
	?>
	<div class="col-sm-6 col-lg-4">
		<article class="rk-card">
			<a class="rk-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
				<?php if ( has_post_thumbnail() ) : ?>
					<img src="<?php echo esc_url( get_the_post_thumbnail_url( $id, 'large' ) ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
				<?php endif; ?>
			</a>
			<div class="rk-card__body">
				<?php if ( $cat ) : ?><div class="rk-card__cat"><?php echo esc_html( $cat ); ?></div><?php endif; ?>
				<h3 class="rk-card__title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a></h3>
				<p class="rk-card__text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
				<div class="rk-card__foot">
					<div class="rk-price">Цена по запросу<small>Доставка по Казахстану</small></div>
					<button type="button" class="btn btn-primary btn-sm px-3"
						onclick="<?php echo esc_attr( sprintf( 'addToCart(%d, %s, 0, %s)', $id, wp_json_encode( $title ), wp_json_encode( (string) $thumb ) ) ); ?>">
						<i class="bi bi-bag-plus me-1"></i> В корзину
					</button>
				</div>
			</div>
		</article>
	</div>
	<?php
}

add_action( 'wp_ajax_filter_catalog', 'rowkz_filter_catalog' );
add_action( 'wp_ajax_nopriv_filter_catalog', 'rowkz_filter_catalog' );
function rowkz_filter_catalog() {
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 60,
	);

	if ( ! empty( $_POST['s'] ) ) {
		$args['s'] = sanitize_text_field( wp_unslash( $_POST['s'] ) );
	}

	// Подрубрика (кнопки-фильтры) имеет приоритет, иначе — корневая рубрика раздела (включая дочерние).
	$subcat = ! empty( $_POST['subcat'] ) ? absint( $_POST['subcat'] ) : ( ! empty( $_POST['lodki_subcat'] ) ? absint( $_POST['lodki_subcat'] ) : 0 );
	if ( $subcat ) {
		$args['cat'] = $subcat;
	} elseif ( ! empty( $_POST['root'] ) ) {
		$root = get_category_by_slug( sanitize_title( wp_unslash( $_POST['root'] ) ) );
		// Рубрики ещё нет — показываем пустой раздел, а не все товары сайта.
		$args['cat'] = $root ? (int) $root->term_id : -1;
		if ( ! $root ) {
			$args['post__in'] = array( 0 );
		}
	}

	$tax_query = array();
	foreach ( array( 'proizvoditel', 'material' ) as $tax ) {
		if ( ! empty( $_POST[ $tax ] ) ) {
			$tax_query[] = array(
				'taxonomy' => $tax,
				'field'    => 'slug',
				'terms'    => sanitize_title( wp_unslash( $_POST[ $tax ] ) ),
			);
		}
	}
	if ( $tax_query ) {
		$tax_query['relation'] = 'AND';
		$args['tax_query']     = $tax_query;
	}

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			rowkz_render_product_card();
		}
		wp_reset_postdata();
	} else {
		echo '<div class="col-12 rk-empty"><p>В этом разделе пока нет товаров. Напишите нам — подберём под ваш запрос.</p></div>';
	}
	wp_die();
}

/**
 * Импорт товара администратором: POST /wp-json/rowkz/v1/import-product
 * Доступно только пользователю с правом manage_options (cookie + nonce).
 * Идемпотентно: повторный импорт того же source_url обновляет запись.
 */
add_action( 'rest_api_init', function () {
	register_rest_route( 'rowkz/v1', '/import-product', array(
		'methods'             => 'POST',
		'permission_callback' => function () {
			return current_user_can( 'manage_options' );
		},
		'callback'            => 'rowkz_rest_import_product',
	) );
} );

function rowkz_import_allowed_image_host( $url ) {
	$host    = wp_parse_url( $url, PHP_URL_HOST );
	$allowed = array( 'swiftracing.com', 'www.swiftracing.com', 'cms.concept2.com', 'www.concept2.com', 'nksports.com', 'www.nksports.com' );
	return $host && in_array( strtolower( $host ), $allowed, true );
}

function rowkz_rest_import_product( WP_REST_Request $req ) {
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';

	$title  = sanitize_text_field( (string) $req->get_param( 'title' ) );
	$source = esc_url_raw( (string) $req->get_param( 'source_url' ) );
	if ( '' === $title ) {
		return new WP_Error( 'rowkz_no_title', 'title обязателен', array( 'status' => 400 ) );
	}

	$cat_ids = array();
	foreach ( (array) $req->get_param( 'categories' ) as $slug ) {
		$id = rowkz_ensure_category( sanitize_title( $slug ) );
		if ( $id ) {
			$cat_ids[] = $id;
		}
	}

	$existing = $source ? get_posts( array(
		'post_type'   => 'post',
		'post_status' => 'any',
		'meta_key'    => '_rowkz_source_url',
		'meta_value'  => $source,
		'fields'      => 'ids',
		'numberposts' => 1,
	) ) : array();

	$postarr = array(
		'post_type'     => 'post',
		'post_status'   => 'publish',
		'post_title'    => $title,
		'post_content'  => wp_kses_post( (string) $req->get_param( 'content' ) ),
		'post_excerpt'  => sanitize_textarea_field( (string) $req->get_param( 'excerpt' ) ),
		'post_category' => $cat_ids,
	);
	if ( $existing ) {
		$postarr['ID'] = $existing[0];
	}
	$post_id = wp_insert_post( $postarr, true );
	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}
	if ( $source ) {
		update_post_meta( $post_id, '_rowkz_source_url', $source );
	}

	foreach ( array( 'proizvoditel', 'material' ) as $tax ) {
		$names = array_filter( array_map( 'sanitize_text_field', (array) $req->get_param( $tax ) ) );
		if ( $names ) {
			wp_set_object_terms( $post_id, $names, $tax );
		}
	}

	$image  = esc_url_raw( (string) $req->get_param( 'image_url' ) );
	$result = array( 'id' => $post_id, 'link' => get_permalink( $post_id ), 'updated' => (bool) $existing );
	if ( $image && ! has_post_thumbnail( $post_id ) ) {
		if ( ! rowkz_import_allowed_image_host( $image ) ) {
			$result['image_error'] = 'host not allowed';
		} else {
			$att = media_sideload_image( $image, $post_id, $title, 'id' );
			if ( is_wp_error( $att ) ) {
				$result['image_error'] = $att->get_error_message();
			} else {
				set_post_thumbnail( $post_id, $att );
				$result['thumbnail'] = wp_get_attachment_image_url( $att, 'medium' );
			}
		}
	}
	return $result;
}
