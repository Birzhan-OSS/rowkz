<?php
/*
Template Name: boats-Construction/materials
*/

get_header();
$c = include get_template_directory() . '/template-parts/construction-content.php';
?>
<main id="primary" class="site-main">
	<section class="rk-hero">
		<div class="container">
			<div class="rk-eyebrow"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( rowkz_t( 'Главная' ) ); ?></a> · <?php echo esc_html( $c['eyebrow'] ); ?></div>
			<h1><?php echo esc_html( $c['title'] ); ?></h1>
			<p><?php echo esc_html( $c['lead'] ); ?></p>
		</div>
	</section>

	<section class="rk-section">
		<div class="container">
			<div class="row g-5 align-items-center mb-5">
				<div class="col-lg-5">
					<div class="rk-kicker"><?php echo esc_html( $c['grades_kicker'] ); ?></div>
					<h2><?php echo esc_html( $c['grades_title'] ); ?></h2>
					<p class="rk-muted mb-0"><?php echo esc_html( $c['grades_lead'] ); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="rk-photo"><img src="https://swiftracing.com/wp-content/uploads/2020/10/IMG_2930.jpg" alt="<?php echo esc_attr( $c['img_alt'] ); ?>" loading="lazy"></div>
				</div>
			</div>

			<div class="rk-grades">
				<div class="rk-grades__tabs" role="tablist" aria-label="<?php echo esc_attr( $c['grades_kicker'] ); ?>">
					<?php foreach ( $c['grades'] as $i => $g ) : ?>
						<button type="button" role="tab" class="rk-grades__tab<?php echo 0 === $i ? ' is-active' : ''; ?>" id="rk-tab-<?php echo esc_attr( $g['key'] ); ?>" aria-controls="rk-panel-<?php echo esc_attr( $g['key'] ); ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>" tabindex="<?php echo 0 === $i ? '0' : '-1'; ?>">
							<span class="rk-grades__dot rk-grade--<?php echo esc_attr( $g['key'] ); ?>"></span>
							<span><strong><?php echo esc_html( $g['name'] ); ?></strong><small><?php echo esc_html( $g['tag'] ); ?></small></span>
						</button>
					<?php endforeach; ?>
				</div>

				<?php foreach ( $c['grades'] as $i => $g ) : ?>
					<div class="rk-grades__panel" role="tabpanel" id="rk-panel-<?php echo esc_attr( $g['key'] ); ?>" aria-labelledby="rk-tab-<?php echo esc_attr( $g['key'] ); ?>"<?php echo 0 === $i ? '' : ' hidden'; ?>>
						<div class="rk-grades__head rk-grade--<?php echo esc_attr( $g['key'] ); ?>">
							<div>
								<span class="rk-grades__tag"><?php echo esc_html( $g['tag'] ); ?></span>
								<h3><?php echo esc_html( $g['name'] ); ?></h3>
							</div>
							<p><span><?php echo esc_html( $c['labels']['for'] ); ?>:</span> <?php echo esc_html( $g['for'] ); ?></p>
						</div>
						<div class="row g-3">
							<?php foreach ( array( 'hull', 'sides', 'decks' ) as $part ) : ?>
								<div class="col-md-4">
									<div class="rk-spec">
										<h4><?php echo esc_html( $c['labels'][ $part ] ); ?></h4>
										<ul>
											<?php foreach ( $g[ $part ] as $line ) : ?>
												<li><?php echo esc_html( $line ); ?></li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="rk-section rk-section--sand">
		<div class="container">
			<div class="rk-kicker"><?php echo esc_html( $c['weight_kicker'] ); ?></div>
			<h2><?php echo esc_html( $c['weight_title'] ); ?></h2>
			<div class="row rk-grid mt-2">
				<?php foreach ( $c['weight'] as $w ) : ?>
					<div class="col-md-6 col-lg-3">
						<div class="rk-spec rk-spec--white">
							<h4><?php echo esc_html( $w[0] ); ?></h4>
							<ul>
								<?php foreach ( $w[1] as $line ) : ?>
									<li><?php echo esc_html( $line ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<p class="rk-muted small mt-3 mb-0"><?php echo esc_html( $c['weight_note'] ); ?></p>
		</div>
	</section>

	<section class="rk-section">
		<div class="container">
			<div class="row g-5 align-items-start">
				<div class="col-lg-5">
					<div class="rk-kicker"><?php echo esc_html( $c['about_kicker'] ); ?></div>
					<h2><?php echo esc_html( $c['about_title'] ); ?></h2>
					<p class="rk-lead"><?php echo esc_html( $c['about_lead'] ); ?></p>
				</div>
				<div class="col-lg-7">
					<div class="rk-sandwich" aria-hidden="true">
						<span class="rk-sandwich__skin"></span>
						<span class="rk-sandwich__core"></span>
						<span class="rk-sandwich__skin"></span>
					</div>
					<div class="row rk-grid">
						<?php foreach ( $c['cores'] as $core ) : ?>
							<div class="col-md-6">
								<div class="rk-perk">
									<i class="bi <?php echo esc_attr( $core[0] ); ?>"></i>
									<h3><?php echo esc_html( $core[1] ); ?></h3>
									<p><?php echo esc_html( $core[2] ); ?></p>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="rk-section pt-0">
		<div class="container">
			<div class="rk-cta">
				<div>
					<h2><?php echo esc_html( $c['cta_title'] ); ?></h2>
					<p><?php echo esc_html( $c['cta_text'] ); ?></p>
				</div>
				<div class="d-flex flex-wrap gap-2">
					<a class="btn btn-light btn-lg" href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>"><?php echo esc_html( $c['cta_btn'] ); ?></a>
					<a class="btn btn-outline-light btn-lg" href="<?php echo esc_url( rowkz_page_url( 'template-boats-racing-boats.php' ) ); ?>"><?php echo esc_html( $c['cta_btn2'] ); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>

<script>
(function () {
	var tabs = Array.prototype.slice.call(document.querySelectorAll('.rk-grades__tab'));
	function select(tab, focus) {
		tabs.forEach(function (t) {
			var on = t === tab;
			t.classList.toggle('is-active', on);
			t.setAttribute('aria-selected', on ? 'true' : 'false');
			t.tabIndex = on ? 0 : -1;
			document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
		});
		if (focus) tab.focus();
	}
	tabs.forEach(function (tab, i) {
		tab.addEventListener('click', function () { select(tab); });
		tab.addEventListener('keydown', function (e) {
			var n = (e.key === 'ArrowRight' || e.key === 'ArrowDown') ? 1 : (e.key === 'ArrowLeft' || e.key === 'ArrowUp') ? -1 : 0;
			if (n) { e.preventDefault(); select(tabs[(i + n + tabs.length) % tabs.length], true); }
		});
	});
})();
</script>
<?php
get_footer();
