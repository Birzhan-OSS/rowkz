<?php
/**
 * Шапка сайта.
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'rowkz' ); ?></a>

	<div class="rk-topbar">
		<div class="container">
			<span><i class="bi bi-patch-check"></i> Официальный дистрибьютор Swift в Казахстане</span>
			<a href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>">Связаться с нами <i class="bi bi-arrow-right"></i></a>
		</div>
	</div>

	<header id="masthead" class="rk-header">
		<div class="container rk-header__inner">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="rk-logo" rel="home">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/img/logo222.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="160" height="48">
			</a>

			<nav id="rk-nav" class="rk-nav" aria-label="Основное меню">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'rk-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<div class="rk-actions">
				<a class="rk-icon-btn d-none d-md-inline-flex" href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
				<a class="rk-icon-btn d-none d-md-inline-flex" href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>" aria-label="Telegram"><i class="bi bi-telegram"></i></a>
				<button type="button" class="rk-cart-btn cart-icon-container" data-bs-toggle="modal" data-bs-target="#cartModal" aria-label="Корзина">
					<i class="bi bi-bag"></i>
					<span class="rk-cart-label d-none d-sm-inline">Заявка</span>
					<span class="cart-count" id="cart-count">0</span>
				</button>
				<button type="button" class="rk-burger" aria-controls="rk-nav" aria-expanded="false" aria-label="Открыть меню">
					<span></span><span></span><span></span>
				</button>
			</div>
		</div>
	</header>

	<script>
	(function () {
		var header = document.getElementById('masthead');
		var burger = header.querySelector('.rk-burger');
		var nav = document.getElementById('rk-nav');
		burger.addEventListener('click', function () {
			var open = header.classList.toggle('is-open');
			burger.setAttribute('aria-expanded', open ? 'true' : 'false');
			burger.setAttribute('aria-label', open ? 'Закрыть меню' : 'Открыть меню');
		});
		nav.querySelectorAll('.menu-item-has-children > a').forEach(function (link) {
			var btn = document.createElement('button');
			btn.type = 'button';
			btn.className = 'rk-sub-toggle';
			btn.setAttribute('aria-expanded', 'false');
			btn.setAttribute('aria-label', 'Подменю: ' + link.textContent.trim());
			btn.innerHTML = '<i class="bi bi-chevron-down"></i>';
			btn.addEventListener('click', function () {
				var li = link.parentElement, open = li.classList.toggle('is-open');
				btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			});
			link.after(btn);
		});
		var onScroll = function () { header.classList.toggle('is-scrolled', window.scrollY > 8); };
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	})();
	</script>
