<?php
/**
 * rowkz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rowkz
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rowkz_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on rowkz, use a find and replace
		* to change 'rowkz' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'rowkz', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'rowkz' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'rowkz_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'rowkz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rowkz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rowkz_content_width', 640 );
}
add_action( 'after_setup_theme', 'rowkz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rowkz_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rowkz' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rowkz' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'rowkz_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function rowkz_scripts() {
	wp_enqueue_style( 'rowkz-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'rowkz-main', get_template_directory_uri() . '/css/main.css');
	wp_enqueue_style( 'rowkz-apple-theme', get_template_directory_uri() . '/css/apple-theme.css');
	wp_enqueue_style( 'rowkz-cart', get_template_directory_uri() . '/css/cart.css');
	wp_enqueue_style( 'rowkz-shop', get_template_directory_uri() . '/css/shop.css', array( 'rowkz-main', 'rowkz-cart' ), filemtime( get_template_directory() . '/css/shop.css' ) );
	wp_enqueue_style( 'bootstrap_icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css');
	//owl 
	wp_enqueue_style( 'owl-style', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
	wp_enqueue_style( 'owl-style-t', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');

	wp_style_add_data( 'rowkz-style', 'rtl', 'replace' );

	wp_enqueue_script( 'rowkz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script('jquery');

	wp_enqueue_script( 'owl-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' , array('jquery') );
	wp_enqueue_script( 'owl-script2', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js' , array('jquery') );

	wp_enqueue_script( 'bootstrap-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js' , array('jquery') );
	wp_enqueue_script( 'bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js' , array('jquery') );

	wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), null, true);
	wp_enqueue_script('cart-script', get_template_directory_uri() . '/js/cart.js', array('jquery'), null, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rowkz_scripts' );


// AJAX-фильтр каталога и импорт товаров — см. inc/catalog.php
require get_template_directory() . '/inc/catalog.php';
require get_template_directory() . '/inc/orders.php';

function register_custom_taxonomies() {
    register_taxonomy('proizvoditel', 'post', [
        'label' => 'Производитель',
        'rewrite' => ['slug' => 'proizvoditel'],
        'hierarchical' => true, // true — как рубрики, false — как метки
        'show_admin_column' => true,
        'show_in_rest' => true,
    ]);
    // Добавьте другие таксономии по аналогии:
    register_taxonomy('material', 'post', [
        'label' => 'Материал',
        'rewrite' => ['slug' => 'material'],
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
    ]);
}
add_action('init', 'register_custom_taxonomies');

/**
 * custom fonts
 */
//custom_fonts
function enqueue_custom_fonts() {
	if(!is_admin()) {
		wp_register_style('source_mont', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
		wp_enqueue_style('source_mont');
	}
}
add_action('wp_enqueue_scripts', 'enqueue_custom_fonts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

?>