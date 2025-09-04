<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rowkz
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Include Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'rowkz' ); ?></a>
	<div class="announcement-bar pt-2 pb-2">
		<div class="container">
			<div class="row">
				<div class="col-md-8"><a href="#"></a></div>
				<div class="col-md-4">
					<ul class="announcement-bar__list">
						<li>
						Контакты
						</li>
						<li>
						<i class="bi bi-google"></i>
						</li>
						<li>
						<i class="bi bi-whatsapp"></i>
						</li>
						<li>
						<i class="bi bi-telegram"></i>
						</li>
						<li>
						<i class="bi bi-youtube"></i>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>



	<header id="masthead" class="site-header">

		<div class="container pt-2 pb-2">
			<div class="row align-items-center">

			<div class="col site-header__logo d-flex justify-content-center justify-content-md-start pb-2">
				<?php the_custom_logo();?>
				<a href="https://rowkz.kz" class="custom-logo-link" rel="home" aria-current="page">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo222.svg' ); ?>" class="custom-logo" alt="<?php bloginfo( 'name' ); ?>" />
					
				</a>
			</div>

			</div>
		</div>



		

		<nav id="site-navigation" class="main-navigation bg-swift">
			<div class="container d-flex justify-content-center">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Меню', 'rowkz' ); ?></button>
					</div>


					<div class="col-12 text-center">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								)
							);
							?>
					</div>
				</div>

			

			
			</div>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
