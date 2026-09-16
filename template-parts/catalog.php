<?php
/**
 * Общий шаблон раздела каталога.
 * Аргументы (get_template_part 3-й параметр):
 *   root  — slug корневой рубрики раздела (например, 'trenazhery')
 *   title — заголовок раздела
 *   lead  — подзаголовок
 *
 * @package rowkz
 */

$root_slug = isset( $args['root'] ) ? sanitize_title( $args['root'] ) : '';
$title     = isset( $args['title'] ) ? $args['title'] : get_the_title();
$lead      = isset( $args['lead'] ) ? $args['lead'] : 'Познакомьтесь с нашим широким ассортиментом продукции, отвечающей вашим потребностям.';
$root      = $root_slug ? get_category_by_slug( $root_slug ) : null;
$subcats   = $root ? get_categories( array( 'parent' => $root->term_id, 'hide_empty' => false ) ) : array();

$proizvoditeli = get_terms( array( 'taxonomy' => 'proizvoditel', 'hide_empty' => true ) );
$materials     = get_terms( array( 'taxonomy' => 'material', 'hide_empty' => true ) );
?>
<main id="primary" class="site-main">
	<section class="hero-section bg-light py-5 text-center position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
		<div class="container py-5">
			<h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn"><?php echo esc_html( $title ); ?></h1>
			<p class="lead mb-4 animate__animated animate__fadeIn" style="animation-delay: 0.2s;"><?php echo esc_html( $lead ); ?></p>
		</div>
		<div class="hero-overlay position-absolute bottom-0 start-0 w-100" style="height: 50px; background: linear-gradient(to top, rgba(255,255,255,1), transparent);"></div>
	</section>

	<section class="py-5">
		<div class="container">
			<form id="catalog-filter" class="mb-4" data-root="<?php echo esc_attr( $root_slug ); ?>">
				<input type="hidden" name="subcat" value="">

				<?php if ( $subcats ) : ?>
					<div class="catalog-chips d-flex flex-wrap gap-2 mb-3" role="group" aria-label="Подрубрики">
						<button type="button" class="btn btn-sm btn-primary catalog-chip" data-subcat="">Все</button>
						<?php foreach ( $subcats as $cat ) : ?>
							<button type="button" class="btn btn-sm btn-outline-primary catalog-chip" data-subcat="<?php echo esc_attr( $cat->term_id ); ?>">
								<?php echo esc_html( $cat->name ); ?>
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="row g-3">
					<div class="col-md-6">
						<input type="search" name="s" class="form-control shadow-sm" placeholder="Найти товар по названию или описанию">
					</div>
					<?php if ( ! is_wp_error( $proizvoditeli ) && $proizvoditeli ) : ?>
						<div class="col-md-3">
							<select name="proizvoditel" class="form-select shadow-sm">
								<option value="">Все производители</option>
								<?php foreach ( $proizvoditeli as $term ) : ?>
									<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>
					<?php if ( ! is_wp_error( $materials ) && $materials ) : ?>
						<div class="col-md-3">
							<select name="material" class="form-select shadow-sm">
								<option value="">Любой материал</option>
								<?php foreach ( $materials as $term ) : ?>
									<option value="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>
				</div>
			</form>

			<div id="catalog-results" class="row g-4" aria-live="polite">
				<div class="col-12 text-center text-muted"><p>Загрузка товаров…</p></div>
			</div>
		</div>
	</section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
	const form = document.getElementById('catalog-filter');
	const results = document.getElementById('catalog-results');
	if (!form || !results) return;
	let timer = null, seq = 0;

	function fetchCatalog() {
		const fd = new FormData(form);
		const body = new URLSearchParams({
			action: 'filter_catalog',
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
			.then(html => { if (mySeq === seq) { results.innerHTML = html; results.style.opacity = ''; } })
			.catch(() => { results.innerHTML = '<div class="col-12 text-center text-danger"><p>Не удалось загрузить товары.</p></div>'; results.style.opacity = ''; });
	}

	form.addEventListener('submit', e => { e.preventDefault(); fetchCatalog(); });
	form.querySelectorAll('select').forEach(el => el.addEventListener('change', fetchCatalog));
	const search = form.querySelector('input[name="s"]');
	search.addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(fetchCatalog, 300); });

	form.querySelectorAll('.catalog-chip').forEach(chip => chip.addEventListener('click', () => {
		form.querySelectorAll('.catalog-chip').forEach(c => { c.classList.remove('btn-primary'); c.classList.add('btn-outline-primary'); });
		chip.classList.remove('btn-outline-primary'); chip.classList.add('btn-primary');
		form.elements.subcat.value = chip.dataset.subcat;
		fetchCatalog();
	}));

	fetchCatalog();
});
</script>
