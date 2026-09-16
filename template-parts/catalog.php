<?php
/**
 * Общий шаблон раздела каталога.
 * Аргументы: root — slug корневой рубрики; title — заголовок; lead — подзаголовок.
 *
 * @package rowkz
 */

$root_slug = isset( $args['root'] ) ? sanitize_title( $args['root'] ) : '';
$title     = isset( $args['title'] ) ? rowkz_t( $args['title'] ) : get_the_title();
$lead      = rowkz_t( isset( $args['lead'] ) ? $args['lead'] : 'Официальные поставки, консультация по подбору и сервис в Казахстане.' );
$root      = $root_slug ? rowkz_category( $root_slug ) : null;
$subcats   = $root ? get_categories( array( 'parent' => $root->term_id, 'hide_empty' => true ) ) : array();
$parent    = ( $root && $root->parent ) ? get_category( $root->parent ) : null;

$proizvoditeli = get_terms( array( 'taxonomy' => 'proizvoditel', 'hide_empty' => true ) );
$materials     = get_terms( array( 'taxonomy' => 'material', 'hide_empty' => true ) );
?>
<main id="primary" class="site-main">
	<section class="rk-hero">
		<div class="container">
			<div class="rk-eyebrow">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( rowkz_t( 'Главная' ) ); ?></a>
				<?php if ( $parent ) : ?> · <?php echo esc_html( $parent->name ); ?><?php endif; ?>
				· <?php echo esc_html( rowkz_t( 'Каталог' ) ); ?>
			</div>
			<h1><?php echo esc_html( $title ); ?></h1>
			<p><?php echo esc_html( $lead ); ?></p>
		</div>
	</section>

	<section class="rk-catalog">
		<div class="container">
			<form id="catalog-filter" class="rk-filters" data-root="<?php echo esc_attr( $root_slug ); ?>" role="search">
				<input type="hidden" name="subcat" value="">

				<?php if ( $subcats ) : ?>
					<div class="rk-chips" role="group" aria-label="<?php echo esc_attr( rowkz_t( 'Подрубрики' ) ); ?>">
						<button type="button" class="rk-chip is-active" data-subcat="" aria-pressed="true"><?php echo esc_html( rowkz_t( 'Все' ) ); ?></button>
						<?php foreach ( $subcats as $cat ) : ?>
							<button type="button" class="rk-chip" data-subcat="<?php echo esc_attr( $cat->term_id ); ?>" aria-pressed="false"><?php echo esc_html( $cat->name ); ?></button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="row g-2">
					<div class="col-md">
						<input type="search" name="s" class="form-control" placeholder="<?php echo esc_attr( rowkz_t( 'Поиск по названию или характеристикам' ) ); ?>" aria-label="<?php echo esc_attr( rowkz_t( 'Поиск' ) ); ?>">
					</div>
					<?php if ( ! is_wp_error( $proizvoditeli ) && count( $proizvoditeli ) > 1 ) : ?>
						<div class="col-md-3">
							<select name="proizvoditel" class="form-select" aria-label="<?php echo esc_attr( rowkz_t( 'Производитель' ) ); ?>">
								<option value=""><?php echo esc_html( rowkz_t( 'Все производители' ) ); ?></option>
								<?php foreach ( $proizvoditeli as $term ) : ?>
									<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>
					<?php if ( ! is_wp_error( $materials ) && $materials ) : ?>
						<div class="col-md-3">
							<select name="material" class="form-select" aria-label="<?php echo esc_attr( rowkz_t( 'Материал' ) ); ?>">
								<option value=""><?php echo esc_html( rowkz_t( 'Любой материал' ) ); ?></option>
								<?php foreach ( $materials as $term ) : ?>
									<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( rowkz_t( $term->name ) ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>
				</div>
			</form>

			<div class="rk-count" id="catalog-count" aria-live="polite"></div>
			<div id="catalog-results" class="row rk-grid">
				<div class="col-12 rk-empty"><p><?php echo esc_html( rowkz_t( 'Загрузка товаров…' ) ); ?></p></div>
			</div>
		</div>
	</section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
	const form = document.getElementById('catalog-filter');
	const results = document.getElementById('catalog-results');
	const count = document.getElementById('catalog-count');
	if (!form || !results) return;
	let timer = null, seq = 0;

	function plural(n) {
		const m10 = n % 10, m100 = n % 100;
		if (m10 === 1 && m100 !== 11) return <?php echo wp_json_encode( rowkz_t( 'товар' ) ); ?>;
		if (m10 >= 2 && m10 <= 4 && (m100 < 12 || m100 > 14)) return <?php echo wp_json_encode( rowkz_t( 'товара' ) ); ?>;
		return <?php echo wp_json_encode( rowkz_t( 'товаров' ) ); ?>;
	}

	function fetchCatalog() {
		const fd = new FormData(form);
		const body = new URLSearchParams({
			action: 'filter_catalog',
			lang: <?php echo wp_json_encode( rowkz_lang() ); ?>,
			root: form.dataset.root || '',
			subcat: fd.get('subcat') || '',
			s: fd.get('s') || '',
			proizvoditel: fd.get('proizvoditel') || '',
			material: fd.get('material') || ''
		});
		const mySeq = ++seq;
		results.style.opacity = '0.5';
		fetch(<?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>, { method: 'POST', credentials: 'same-origin', body: body })
			.then(r => r.text())
			.then(html => {
				if (mySeq !== seq) return;
				results.innerHTML = html;
				results.style.opacity = '';
				const n = results.querySelectorAll('.rk-card').length;
				count.textContent = n ? n + ' ' + plural(n) : '';
			})
			.catch(() => { results.innerHTML = '<div class="col-12 rk-empty"><p><?php echo esc_html( rowkz_t( 'Не удалось загрузить товары. Обновите страницу.' ) ); ?></p></div>'; results.style.opacity = ''; });
	}

	form.addEventListener('submit', e => { e.preventDefault(); fetchCatalog(); });
	form.querySelectorAll('select').forEach(el => el.addEventListener('change', fetchCatalog));
	form.querySelector('input[name="s"]').addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(fetchCatalog, 300); });

	form.querySelectorAll('.rk-chip').forEach(chip => chip.addEventListener('click', () => {
		form.querySelectorAll('.rk-chip').forEach(c => { c.classList.remove('is-active'); c.setAttribute('aria-pressed', 'false'); });
		chip.classList.add('is-active'); chip.setAttribute('aria-pressed', 'true');
		form.elements.subcat.value = chip.dataset.subcat;
		fetchCatalog();
	}));

	fetchCatalog();
});
</script>
