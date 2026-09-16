<?php
/**
 * Страница товара (одиночная запись).
 *
 * @package rowkz
 */

get_header();

while ( have_posts() ) :
	the_post();
	$id      = get_the_ID();
	$title   = get_the_title();
	$cats    = get_the_category( $id );
	$brands  = get_the_terms( $id, 'proizvoditel' );
	$mats    = get_the_terms( $id, 'material' );
	$thumb   = get_the_post_thumbnail_url( $id, 'thumbnail' );
	$primary = $cats ? $cats[0] : null;
	$top     = $primary && $primary->parent ? get_category( $primary->parent ) : null;
	?>
<main id="primary" class="site-main">
	<section class="rk-product">
		<div class="container">
			<nav class="rk-crumbs" aria-label="<?php echo esc_attr( rowkz_t( 'Навигация' ) ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( rowkz_t( 'Главная' ) ); ?></a>
				<?php if ( $top ) : ?> / <a href="<?php echo esc_url( get_category_link( $top ) ); ?>"><?php echo esc_html( $top->name ); ?></a><?php endif; ?>
				<?php if ( $primary ) : ?> / <a href="<?php echo esc_url( get_category_link( $primary ) ); ?>"><?php echo esc_html( $primary->name ); ?></a><?php endif; ?>
				/ <span><?php echo esc_html( $title ); ?></span>
			</nav>

			<div class="row g-4 align-items-start">
				<div class="col-lg-7">
					<div class="rk-gallery">
						<?php if ( has_post_thumbnail() ) : ?>
							<img src="<?php echo esc_url( get_the_post_thumbnail_url( $id, 'full' ) ); ?>" alt="<?php echo esc_attr( $title ); ?>">
						<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-5">
					<aside class="rk-buybox">
						<?php if ( $primary ) : ?><div class="rk-card__cat"><?php echo esc_html( $primary->name ); ?></div><?php endif; ?>
						<h1><?php echo esc_html( $title ); ?></h1>
						<?php if ( has_excerpt() ) : ?><p class="rk-lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>

						<div class="rk-tags">
							<?php foreach ( array( $brands, $mats ) as $terms ) : ?>
								<?php if ( $terms && ! is_wp_error( $terms ) ) : foreach ( $terms as $t ) : ?>
									<span class="rk-tag"><?php echo esc_html( rowkz_t( $t->name ) ); ?></span>
								<?php endforeach; endif; ?>
							<?php endforeach; ?>
						</div>

						<div class="rk-price"><?php echo esc_html( rowkz_t( 'Цена по запросу' ) ); ?><small><?php echo esc_html( rowkz_t( 'Рассчитаем стоимость с доставкой по Казахстану' ) ); ?></small></div>

						<div class="d-grid gap-2">
							<button type="button" class="btn btn-primary btn-lg"
								onclick="<?php echo esc_attr( sprintf( 'addToCart(%d, %s, 0, %s)', $id, wp_json_encode( $title ), wp_json_encode( (string) $thumb ) ) ); ?>">
								<i class="bi bi-bag-plus me-2"></i><?php echo esc_html( rowkz_t( 'Добавить в заявку' ) ); ?>
							</button>
							<a class="btn btn-outline-primary btn-lg" href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>">
								<i class="bi bi-chat-dots me-2"></i><?php echo esc_html( rowkz_t( 'Задать вопрос' ) ); ?>
							</a>
						</div>

						<ul class="rk-perks">
							<li><i class="bi bi-patch-check"></i> <?php echo esc_html( rowkz_t( 'Официальные поставки' ) ); ?></li>
							<li><i class="bi bi-rulers"></i> <?php echo esc_html( rowkz_t( 'Подбор модели под гребца и задачу' ) ); ?></li>
							<li><i class="bi bi-tools"></i> <?php echo esc_html( rowkz_t( 'Сервис и запчасти' ) ); ?></li>
						</ul>
					</aside>
				</div>
			</div>

			<?php if ( '' !== trim( get_the_content() ) ) : ?>
				<div class="rk-content">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>

			<?php
			if ( $primary ) :
				$related = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 3,
						'post__not_in'        => array( $id ),
						'cat'                 => $top ? $top->term_id : $primary->term_id,
						'lang'                => rowkz_lang(),
						'ignore_sticky_posts' => true,
					)
				);
				if ( $related->have_posts() ) :
					?>
					<section class="rk-related">
						<h2><?php echo esc_html( rowkz_t( 'Смотрите также' ) ); ?></h2>
						<div class="row rk-grid">
							<?php
							while ( $related->have_posts() ) :
								$related->the_post();
								rowkz_render_product_card();
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</section>
					<?php
				endif;
			endif;
			?>
		</div>
	</section>
</main>
	<?php
endwhile;

get_footer();
