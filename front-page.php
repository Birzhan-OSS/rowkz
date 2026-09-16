<?php
/**
 * Главная страница.
 *
 * @package rowkz
 */

get_header();

$img = get_template_directory_uri() . '/img/';

$sections = array(
	// Название, подпись, шаблон страницы, рубрика, товар с фото для плитки.
	array( 'Лодки', 'Гоночные, тренировочные, прибрежные и детские', 'template-lodki.php', 'lodki', 'para-rowing-1x' ),
	array( 'Вёсла', 'Парные вёсла и вёсла для кадетов', 'template-vesla copy.php', 'vesla', 'regular-oars' ),
	array( 'Тренажеры', 'Вся линейка Concept2', 'template-trenajery.php', 'trenazhery', 'concept2.com/ergs/rowerg' ),
	array( 'Аксессуары', 'SpeedCoach, стеллажи и хранение', 'template-accessuary.php', 'aksessuary', 'adjustable-boat-rack' ),
);

$latest = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 6,
		'ignore_sticky_posts' => true,
		'meta_key'            => '_thumbnail_id',
	)
);
?>
<main id="primary" class="site-main">

	<section class="rk-home-hero">
		<div class="rk-home-hero__slides">
			<?php get_template_part( 'template-parts/hero-rowing' ); ?>
		</div>
		<div class="rk-home-hero__shade"></div>
		<div class="container rk-home-hero__content">
			<div class="rk-eyebrow">Официальный дистрибьютор Swift · Казахстан</div>
			<h1>Лодки, вёсла и тренажеры для академической гребли</h1>
			<p>Оснащаем спортсменов, клубы и спортивные школы: подбор модели, поставка и сервис.</p>
			<div class="rk-home-hero__cta">
				<a class="btn btn-light btn-lg" href="<?php echo esc_url( rowkz_page_url( 'template-lodki.php' ) ); ?>">Смотреть каталог</a>
				<a class="btn btn-outline-light btn-lg" href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>">Получить консультацию</a>
			</div>
		</div>
	</section>

	<section class="rk-section">
		<div class="container">
			<div class="rk-section__head">
				<div>
					<div class="rk-kicker">Каталог</div>
					<h2>Разделы</h2>
				</div>
			</div>
			<div class="row rk-grid">
				<?php foreach ( $sections as $s ) :
					list( $name, $desc, $tpl, $slug, $prefer ) = $s;
					$cover = rowkz_category_cover( $slug, $prefer );
					?>
					<div class="col-sm-6 col-lg-3">
						<a class="rk-tile" href="<?php echo esc_url( rowkz_page_url( $tpl ) ); ?>">
							<span class="rk-tile__media"><?php if ( $cover ) : ?><img src="<?php echo esc_url( $cover ); ?>" alt="" loading="lazy"><?php endif; ?></span>
							<span class="rk-tile__body">
								<span class="rk-tile__title"><?php echo esc_html( $name ); ?> <i class="bi bi-arrow-right"></i></span>
								<span class="rk-tile__text"><?php echo esc_html( $desc ); ?></span>
							</span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php if ( $latest->have_posts() ) : ?>
	<section class="rk-section rk-section--sand">
		<div class="container">
			<div class="rk-section__head">
				<div>
					<div class="rk-kicker">Ассортимент</div>
					<h2>Популярные товары</h2>
				</div>
				<a class="btn btn-outline-primary" href="<?php echo esc_url( rowkz_page_url( 'template-lodki.php' ) ); ?>">Весь каталог</a>
			</div>
			<div class="row rk-grid">
				<?php
				while ( $latest->have_posts() ) :
					$latest->the_post();
					rowkz_render_product_card();
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section class="rk-section">
		<div class="container">
			<div class="row g-5 align-items-center">
				<div class="col-lg-6">
					<div class="rk-photo"><img src="<?php echo esc_url( $img . '7.jpg' ); ?>" alt="Гребная лодка Swift" loading="lazy"></div>
				</div>
				<div class="col-lg-6">
					<div class="rk-kicker">О компании</div>
					<h2>Добро пожаловать в Rowkz</h2>
					<p class="rk-lead">Мы — официальный дистрибьютор Swift, производителя лодок для академической гребли с 2005 года. Продукция Swift представлена более чем в 50 странах.</p>
					<p class="rk-muted">Предлагаем полный ассортимент: лодки и вёсла, тренажеры, аксессуары, системы хранения и оснащение для гребных клубов и спортивных школ. Наша цель — сделать греблю доступной и комфортной.</p>
					<a class="btn btn-primary btn-lg mt-2" href="<?php echo esc_url( rowkz_page_url( 'template-about.php' ) ); ?>">Подробнее о нас</a>
				</div>
			</div>
		</div>
	</section>

	<section class="rk-section rk-section--tight">
		<div class="container">
			<div class="row rk-grid">
				<?php
				$perks = array(
					array( 'bi-patch-check', 'Официальные поставки', 'Оригинальная продукция и гарантия производителя.' ),
					array( 'bi-rulers', 'Подбор под гребца', 'Поможем выбрать корпус, вёсла и оснастку под вес и задачи.' ),
					array( 'bi-truck', 'Доставка по Казахстану', 'Организуем доставку, в том числе крупногабаритных лодок.' ),
					array( 'bi-tools', 'Сервис и запчасти', 'Консультации, ремонт и комплектующие после покупки.' ),
				);
				foreach ( $perks as $p ) :
					?>
					<div class="col-sm-6 col-lg-3">
						<div class="rk-perk">
							<i class="bi <?php echo esc_attr( $p[0] ); ?>"></i>
							<h3><?php echo esc_html( $p[1] ); ?></h3>
							<p><?php echo esc_html( $p[2] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="rk-section rk-section--tight">
		<div class="container">
			<div class="rk-logos">
				<img src="https://swiftracing.com/wp-content/uploads/2025/05/logos-hrz-30May2025.png" alt="Партнёры Swift" loading="lazy" width="876" height="357">
			</div>
		</div>
	</section>

	<section class="rk-section">
		<div class="container">
			<div class="rk-cta">
				<div>
					<h2>Нужна помощь с выбором?</h2>
					<p>Расскажите о задачах клуба или спортсмена — подготовим предложение с ценой и сроками.</p>
				</div>
				<a class="btn btn-light btn-lg" href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>">Оставить заявку</a>
			</div>
		</div>
	</section>

</main>
<?php
get_footer();
