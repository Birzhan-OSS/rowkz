<?php
/**
 * Мультиязычность: RU (по умолчанию), EN, KK. Работает с плагином Polylang,
 * без плагина сайт остаётся на русском.
 *
 * @package rowkz
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const ROWKZ_LANGS = array(
	'ru' => array( 'label' => 'RU', 'name' => 'Русский', 'locale' => 'ru_RU', 'flag' => 'ru', 'order' => 0 ),
	'en' => array( 'label' => 'EN', 'name' => 'English', 'locale' => 'en_US', 'flag' => 'us', 'order' => 1 ),
	'kk' => array( 'label' => 'KZ', 'name' => 'Қазақша', 'locale' => 'kk', 'flag' => 'kz', 'order' => 2 ),
);

/** Текущий язык: ru | en | kk. */
function rowkz_lang() {
	if ( wp_doing_ajax() && isset( $_REQUEST['lang'] ) ) {
		$l = sanitize_key( wp_unslash( $_REQUEST['lang'] ) );
		return isset( ROWKZ_LANGS[ $l ] ) ? $l : 'ru';
	}
	if ( function_exists( 'pll_current_language' ) ) {
		$l = pll_current_language( 'slug' );
		if ( $l && isset( ROWKZ_LANGS[ $l ] ) ) {
			return $l;
		}
	}
	return 'ru';
}

/** Перевод строки темы (ключ — русский текст). */
function rowkz_t( $ru, $lang = null ) {
	static $dict = null;
	if ( null === $dict ) {
		$dict = include get_template_directory() . '/inc/i18n-strings.php';
	}
	$lang = $lang ?: rowkz_lang();
	return ( 'ru' !== $lang && isset( $dict[ $lang ][ $ru ] ) ) ? $dict[ $lang ][ $ru ] : $ru;
}

/** ID записи/страницы на текущем языке. */
function rowkz_tr_post( $id ) {
	if ( function_exists( 'pll_get_post' ) ) {
		$tr = pll_get_post( $id, rowkz_lang() );
		if ( $tr ) {
			return (int) $tr;
		}
	}
	return (int) $id;
}

/** Рубрика по русскому slug, в версии текущего языка. */
function rowkz_category( $slug ) {
	$cat = get_category_by_slug( $slug );
	if ( ! $cat ) {
		return null;
	}
	if ( function_exists( 'pll_get_term' ) ) {
		$tr = pll_get_term( $cat->term_id, rowkz_lang() );
		if ( $tr && $tr !== $cat->term_id ) {
			$t = get_category( $tr );
			return ( $t && ! is_wp_error( $t ) ) ? $t : $cat;
		}
	}
	return $cat;
}

/** Ссылки на все языковые версии текущей страницы. */
function rowkz_language_links() {
	$out = array();
	if ( function_exists( 'pll_the_languages' ) ) {
		$raw = pll_the_languages( array( 'raw' => 1, 'hide_if_empty' => 0, 'hide_if_no_translation' => 0 ) );
		foreach ( (array) $raw as $l ) {
			if ( isset( ROWKZ_LANGS[ $l['slug'] ] ) ) {
				$out[ $l['slug'] ] = array( 'url' => $l['url'], 'current' => ! empty( $l['current_lang'] ) );
			}
		}
	}
	uksort( $out, function ( $a, $b ) {
		return ROWKZ_LANGS[ $a ]['order'] - ROWKZ_LANGS[ $b ]['order'];
	} );
	return $out;
}

function rowkz_language_switcher() {
	$links = rowkz_language_links();
	if ( count( $links ) < 2 ) {
		return;
	}
	echo '<nav class="rk-lang" aria-label="' . esc_attr( rowkz_t( 'Язык' ) ) . '">';
	foreach ( $links as $slug => $l ) {
		printf(
			'<a href="%s" hreflang="%s" lang="%s" title="%s"%s>%s</a>',
			esc_url( $l['url'] ),
			esc_attr( $slug ),
			esc_attr( $slug ),
			esc_attr( ROWKZ_LANGS[ $slug ]['name'] ),
			$l['current'] ? ' aria-current="true"' : '',
			esc_html( ROWKZ_LANGS[ $slug ]['label'] )
		);
	}
	echo '</nav>';
}

/** Фильтр каталога и корзина получают язык страницы. */
add_action( 'wp_enqueue_scripts', function () {
	$keys = array( 'Товар добавлен в заявку', 'Открыть', 'В заявке пока нет товаров', 'Цена по запросу', 'Удалить', 'Меньше', 'Больше', 'Количество', 'Закрыть', 'Продолжить выбор', 'Отправить заявку', 'Отправляем…', 'Укажите имя.', 'Укажите телефон в формате +7 700 000 00 00.', 'Укажите корректный email.', 'Не удалось отправить заявку.', 'Нет связи с сервером. Проверьте интернет и попробуйте ещё раз.', 'Ошибка сервера.' );
	$i18n = array();
	foreach ( $keys as $k ) {
		$i18n[ $k ] = rowkz_t( $k );
	}
	wp_localize_script( 'cart-script', 'rkI18n', array( 'lang' => rowkz_lang(), 'strings' => $i18n ) );
}, 21 );

/* ---------------------------------------------------------------------------
 * Настройка языков и перевод контента — только для администратора.
 * POST /wp-json/rowkz/v1/i18n  { action: ... }
 * ------------------------------------------------------------------------ */
add_action( 'rest_api_init', function () {
	register_rest_route( 'rowkz/v1', '/i18n', array(
		'methods'             => 'POST',
		'permission_callback' => function () {
			return current_user_can( 'manage_options' );
		},
		'callback'            => 'rowkz_rest_i18n',
	) );
} );

function rowkz_rest_i18n( WP_REST_Request $req ) {
	if ( ! function_exists( 'PLL' ) || ! function_exists( 'pll_set_post_language' ) ) {
		return new WP_Error( 'rowkz_no_polylang', 'Polylang не активен', array( 'status' => 400 ) );
	}
	$action = sanitize_key( $req->get_param( 'action' ) );
	switch ( $action ) {
		case 'status':
			return array( 'languages' => pll_languages_list( array( 'fields' => 'slug' ) ), 'default' => pll_default_language() );
		case 'setup_languages':
			return rowkz_i18n_setup_languages();
		case 'term':
			return rowkz_i18n_term( $req );
		case 'post':
			return rowkz_i18n_post( $req );
		case 'menus':
			return rowkz_i18n_menus( $req );
	}
	return new WP_Error( 'rowkz_bad_action', 'Неизвестное действие', array( 'status' => 400 ) );
}

function rowkz_i18n_setup_languages() {
	$model    = PLL()->model;
	$existing = pll_languages_list( array( 'fields' => 'slug' ) );
	$created  = array();
	foreach ( ROWKZ_LANGS as $slug => $l ) {
		if ( in_array( $slug, $existing, true ) ) {
			continue;
		}
		$args = array(
			'name'       => $l['name'],
			'slug'       => $slug,
			'locale'     => $l['locale'],
			'rtl'        => 0,
			'term_group' => $l['order'],
			'flag'       => $l['flag'],
		);
		try {
			if ( isset( $model->languages ) && is_object( $model->languages ) && method_exists( $model->languages, 'add' ) ) {
				$r = $model->languages->add( $args );
			} else {
				$r = $model->add_language( $args );
			}
			$created[ $slug ] = is_wp_error( $r ) ? $r->get_error_message() : 'ok';
		} catch ( Throwable $e ) {
			$created[ $slug ] = $e->getMessage();
		}
	}
	if ( method_exists( $model, 'clean_languages_cache' ) ) {
		$model->clean_languages_cache();
	}

	// Русский — по умолчанию, в адресе не показывается; язык браузера не переключает сайт сам.
	$options                 = get_option( 'polylang', array() );
	$options['default_lang'] = 'ru';
	$options['hide_default'] = 1;
	$options['browser']      = 0;
	update_option( 'polylang', $options );

	// Всё, что пока без языка, помечаем русским.
	$assigned = array( 'posts' => 0, 'terms' => 0 );
	$ids = get_posts( array( 'post_type' => array( 'post', 'page' ), 'post_status' => 'any', 'numberposts' => -1, 'fields' => 'ids', 'lang' => '' ) );
	foreach ( $ids as $id ) {
		if ( ! pll_get_post_language( $id ) ) {
			pll_set_post_language( $id, 'ru' );
			$assigned['posts']++;
		}
	}
	$terms = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false, 'fields' => 'ids', 'lang' => '' ) );
	foreach ( (array) $terms as $tid ) {
		if ( ! pll_get_term_language( $tid ) ) {
			pll_set_term_language( $tid, 'ru' );
			$assigned['terms']++;
		}
	}
	return array( 'created' => $created, 'assigned' => $assigned, 'languages' => pll_languages_list( array( 'fields' => 'slug' ) ) );
}

/** Перевод рубрики: { slug (русский), lang, name } */
function rowkz_i18n_term( WP_REST_Request $req ) {
	$lang = sanitize_key( $req->get_param( 'lang' ) );
	$src  = get_category_by_slug( sanitize_title( $req->get_param( 'slug' ) ) );
	$name = sanitize_text_field( $req->get_param( 'name' ) );
	if ( ! $src || 'ru' === $lang || ! isset( ROWKZ_LANGS[ $lang ] ) || '' === $name ) {
		return new WP_Error( 'rowkz_bad_term', 'Нет рубрики или языка', array( 'status' => 400 ) );
	}
	if ( ! pll_get_term_language( $src->term_id ) ) {
		pll_set_term_language( $src->term_id, 'ru' );
	}
	$parent = 0;
	if ( $src->parent ) {
		$parent = (int) pll_get_term( $src->parent, $lang );
		if ( ! $parent ) {
			return new WP_Error( 'rowkz_no_parent', 'Сначала переведите родительскую рубрику', array( 'status' => 409 ) );
		}
	}
	$existing = pll_get_term( $src->term_id, $lang );
	if ( $existing ) {
		wp_update_term( $existing, 'category', array( 'name' => $name, 'parent' => $parent ) );
		$tid = (int) $existing;
	} else {
		$r = wp_insert_term( $name, 'category', array( 'slug' => $src->slug . '-' . $lang, 'parent' => $parent ) );
		if ( is_wp_error( $r ) ) {
			return $r;
		}
		$tid = (int) $r['term_id'];
		pll_set_term_language( $tid, $lang );
	}
	$tr          = pll_get_term_translations( $src->term_id );
	$tr['ru']    = $src->term_id;
	$tr[ $lang ] = $tid;
	pll_save_term_translations( $tr );
	return array( 'id' => $tid, 'updated' => (bool) $existing );
}

/**
 * Перевод записи или страницы: { source_id, lang, title, excerpt?, content? }
 * Копирует шаблон страницы, миниатюру, производителя/материал и рубрики (в версии языка).
 */
function rowkz_i18n_post( WP_REST_Request $req ) {
	$lang = sanitize_key( $req->get_param( 'lang' ) );
	$src  = get_post( absint( $req->get_param( 'source_id' ) ) );
	if ( ! $src || ! in_array( $src->post_type, array( 'post', 'page' ), true ) || 'ru' === $lang || ! isset( ROWKZ_LANGS[ $lang ] ) ) {
		return new WP_Error( 'rowkz_bad_post', 'Нет записи или языка', array( 'status' => 400 ) );
	}
	if ( ! pll_get_post_language( $src->ID ) ) {
		pll_set_post_language( $src->ID, 'ru' );
	}

	$cats = array();
	foreach ( wp_get_post_categories( $src->ID ) as $cid ) {
		$t = pll_get_term( $cid, $lang );
		if ( $t ) {
			$cats[] = (int) $t;
		}
	}

	$existing = pll_get_post( $src->ID, $lang );
	$postarr  = array(
		'post_type'    => $src->post_type,
		'post_status'  => $src->post_status,
		'post_title'   => sanitize_text_field( $req->get_param( 'title' ) ),
		'post_excerpt' => sanitize_textarea_field( (string) ( $req->get_param( 'excerpt' ) ?? $src->post_excerpt ) ),
		'post_content' => wp_kses_post( (string) ( $req->get_param( 'content' ) ?? '' ) ),
		'menu_order'   => $src->menu_order,
	);
	if ( 'post' === $src->post_type ) {
		$postarr['post_category'] = $cats;
	}
	if ( $existing ) {
		$postarr['ID'] = $existing;
	}
	$id = wp_insert_post( $postarr, true );
	if ( is_wp_error( $id ) ) {
		return $id;
	}
	if ( ! $existing ) {
		pll_set_post_language( $id, $lang );
	}

	$tpl = get_post_meta( $src->ID, '_wp_page_template', true );
	if ( $tpl ) {
		update_post_meta( $id, '_wp_page_template', $tpl );
	}
	$thumb = get_post_thumbnail_id( $src->ID );
	if ( $thumb ) {
		set_post_thumbnail( $id, $thumb );
	}
	$source_url = get_post_meta( $src->ID, '_rowkz_source_url', true );
	if ( $source_url ) {
		update_post_meta( $id, '_rowkz_source_url', $source_url );
	}
	foreach ( array( 'proizvoditel', 'material' ) as $tax ) {
		$terms = wp_get_object_terms( $src->ID, $tax, array( 'fields' => 'ids' ) );
		if ( ! is_wp_error( $terms ) ) {
			wp_set_object_terms( $id, $terms, $tax );
		}
	}

	$tr          = pll_get_post_translations( $src->ID );
	$tr['ru']    = $src->ID;
	$tr[ $lang ] = $id;
	pll_save_post_translations( $tr );
	return array( 'id' => $id, 'updated' => (bool) $existing, 'link' => get_permalink( $id ) );
}

/**
 * Меню для каждого языка: копирует русское меню (позиция menu-1),
 * подставляя переводы страниц/рубрик и названий.
 */
function rowkz_i18n_menus( WP_REST_Request $req ) {
	$locations = get_nav_menu_locations();
	$options   = get_option( 'polylang', array() );
	$theme     = get_option( 'stylesheet' );
	$ru_menu   = $options['nav_menus'][ $theme ]['menu-1']['ru'] ?? ( $locations['menu-1'] ?? 0 );
	if ( ! $ru_menu ) {
		return new WP_Error( 'rowkz_no_menu', 'Основное меню не назначено', array( 'status' => 400 ) );
	}
	$items  = wp_get_nav_menu_items( $ru_menu );
	$result = array();
	foreach ( array_keys( ROWKZ_LANGS ) as $lang ) {
		if ( 'ru' === $lang ) {
			continue;
		}
		$name    = 'Menu ' . strtoupper( $lang );
		$menu    = wp_get_nav_menu_object( $name );
		$menu_id = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu( $name );
		foreach ( (array) wp_get_nav_menu_items( $menu_id ) as $old ) {
			wp_delete_post( $old->ID, true );
		}
		$map = array();
		foreach ( (array) $items as $it ) {
			$args = array(
				'menu-item-title'     => rowkz_t( $it->title, $lang ),
				'menu-item-status'    => 'publish',
				'menu-item-parent-id' => $it->menu_item_parent ? ( $map[ $it->menu_item_parent ] ?? 0 ) : 0,
				'menu-item-position'  => $it->menu_order,
				'menu-item-classes'   => implode( ' ', array_filter( (array) $it->classes ) ),
			);
			if ( 'post_type' === $it->type ) {
				$tr = pll_get_post( $it->object_id, $lang );
				if ( ! $tr ) {
					continue;
				}
				$args += array( 'menu-item-type' => 'post_type', 'menu-item-object' => $it->object, 'menu-item-object-id' => $tr );
				$args['menu-item-title'] = get_the_title( $tr );
			} elseif ( 'taxonomy' === $it->type ) {
				$tr = pll_get_term( $it->object_id, $lang );
				if ( ! $tr ) {
					continue;
				}
				$args += array( 'menu-item-type' => 'taxonomy', 'menu-item-object' => $it->object, 'menu-item-object-id' => $tr );
			} else {
				$args += array( 'menu-item-type' => 'custom', 'menu-item-url' => $it->url );
			}
			$new = wp_update_nav_menu_item( $menu_id, 0, $args );
			if ( ! is_wp_error( $new ) ) {
				$map[ $it->ID ] = $new;
			}
		}
		$options['nav_menus'][ $theme ]['menu-1'][ $lang ] = $menu_id;
		$result[ $lang ] = array( 'menu' => $menu_id, 'items' => count( $map ) );
	}
	$options['nav_menus'][ $theme ]['menu-1']['ru'] = (int) $ru_menu;
	update_option( 'polylang', $options );
	return $result;
}
