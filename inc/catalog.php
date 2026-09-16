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
		'vesla'             => array( 'Весла', '' ),
		'parnye-vesla'      => array( 'Парные вёсла', 'vesla' ),
		'raspashnye-vesla'  => array( 'Распашные вёсла', 'vesla' ),
		'trenazhery'        => array( 'Тренажеры', '' ),
		'grebnye-trenazhery' => array( 'Гребные тренажеры', 'trenazhery' ),
		'lyzhnye-trenazhery' => array( 'Лыжные тренажеры', 'trenazhery' ),
		'velotrenazhery'    => array( 'Велотренажеры', 'trenazhery' ),
		'silovye-trenazhery' => array( 'Силовые тренажеры', 'trenazhery' ),
		'komplektuyushhie'  => array( 'Комплектующие', '' ),
		'aksessuary'        => array( 'Аксессуары', '' ),
		'elektronika'       => array( 'Электроника (SpeedCoach)', 'aksessuary' ),
	);
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
	?>
	<div class="col-sm-6 col-md-4 col-lg-3 mb-4">
		<div class="card h-100 shadow-sm animate-fade-in-up">
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url( get_the_post_thumbnail_url( $id, 'medium' ) ); ?>" class="card-img-top" alt="<?php echo esc_attr( $title ); ?>" style="object-fit:contain;height:200px;background:#fff;">
				</a>
			<?php endif; ?>
			<div class="card-body d-flex flex-column">
				<h5 class="card-title"><?php echo esc_html( $title ); ?></h5>
				<p class="card-text small text-muted"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
				<div class="mt-auto">
					<div class="d-flex justify-content-between align-items-center">
						<span class="price-placeholder text-muted small">Цена по запросу</span>
						<button type="button" class="btn btn-primary btn-sm"
							onclick="<?php echo esc_attr( sprintf( 'addToCart(%d, %s, 0, %s)', $id, wp_json_encode( $title ), wp_json_encode( (string) $thumb ) ) ); ?>">
							<i class="bi bi-cart-plus"></i> В корзину
						</button>
					</div>
					<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm mt-2 w-100">Подробнее</a>
				</div>
			</div>
		</div>
	</div>
	<?php
}

add_action( 'wp_ajax_filter_catalog', 'rowkz_filter_catalog' );
add_action( 'wp_ajax_nopriv_filter_catalog', 'rowkz_filter_catalog' );
function rowkz_filter_catalog() {
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 24,
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
		echo '<div class="col-12 text-center text-muted"><p>Товары не найдены.</p></div>';
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
