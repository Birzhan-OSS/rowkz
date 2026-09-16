<?php
/*
Template Name: racing boats
*/

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section py-5 text-center position-relative">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn">Лодки - Гоночные</h1>
            <p class="lead mb-4 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                Познакомьтесь с нашим широким ассортиментом продукции, отвечающей вашим потребностям.
            </p>
        </div>
        <div class="hero-overlay position-absolute bottom-0 start-0 w-100" style="height: 50px; background: linear-gradient(to top, rgba(255,255,255,1), transparent);"></div>
    </section>

    <!-- Catalog Filter and Results Section -->
    <section class="py-5">
        <div class="container">
            <form id="catalog-filter" class="row g-3 mb-5 animate__animated animate__fadeInUp">
                <div class="col-md-4">
                    <input type="text" name="s" class="form-control shadow-sm" placeholder="Найти товар по названию или описанию">
                </div>
                <div class="col-md-3">
                    <?php
                    // Получаем рубрику "racing boats"
                    $racing_boats_cat = get_category_by_slug('racing-boats');
                    $racing_boats_cat_id = $racing_boats_cat ? $racing_boats_cat->term_id : 0;
                    
                    // Получаем родительскую рубрику "boats"
                    $boats_cat = get_category_by_slug('boats');
                    $boats_cat_id = $boats_cat ? $boats_cat->term_id : 0;
                    
                    // Получаем все подрубрики рубрики "boats"
                    $boats_subcats = get_categories([
                        'child_of' => $boats_cat_id,
                        'hide_empty' => true
                    ]);
                    ?>
                    <select name="lodki_subcat" class="form-select shadow-sm">
                        <option value="">Все подкатегории лодок</option>
                        <?php foreach ($boats_subcats as $cat): ?>
                            <option value="<?php echo $cat->term_id; ?>" <?php echo ($cat->term_id == $racing_boats_cat_id) ? 'selected' : ''; ?>>
                                <?php echo $cat->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <?php
                    // Пример фильтра по произодителю (кастомный таксономия или мета-поле)
                    // Здесь пример для таксономии 'proizvoditel'
                    $proizvoditeli = get_terms([
                        'taxonomy' => 'proizvoditel',
                        'hide_empty' => true,
                    ]);
                    ?>
                    <select name="proizvoditel" class="form-select shadow-sm">
                        <option value="">Производство</option>
                        <?php foreach ($proizvoditeli as $term): ?>
                            <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                        <?php endforeach; ?>
                    </select> <br/>
                    <?php
                    $materials = get_terms([
                        'taxonomy' => 'material',
                        'hide_empty' => true,
                    ]);
                    ?>
                    <select name="material" class="form-select shadow-sm">
                        <option value="">Материал</option>
                        <?php foreach ($materials as $term): ?>
                            <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-2"></i> Показать
                    </button>
                </div>
            </form>

            <!-- Catalog Results -->
            <div id="catalog-results" class="row g-4">
                <!-- Placeholder for AJAX-loaded content -->
                <div class="col-12 text-center text-muted animate__animated animate__fadeIn">
                    <p>Loading products...</p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function fetchCatalog() {
        const form = document.getElementById('catalog-filter');
        const results = document.getElementById('catalog-results');
        const formData = new FormData(form);

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            credentials: 'same-origin',
            body: new URLSearchParams({
                action: 'filter_catalog',
                s: formData.get('s') || '',
                lodki_subcat: formData.get('lodki_subcat') || '<?php echo $racing_boats_cat_id; ?>',
                proizvoditel: formData.get('proizvoditel') || '',
                material: formData.get('material') || ''
            })
        })
        .then(response => response.text())
        .then(html => {
            results.innerHTML = html;
            // Добавляем анимацию к новым элементам
            const cards = results.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate-fade-in-up');
                }, index * 100);
            });
        });
    }

    document.getElementById('catalog-filter').addEventListener('submit', function(e) {
        e.preventDefault();
        fetchCatalog();
    });

    document.querySelectorAll('#catalog-filter input, #catalog-filter select').forEach(el => {
        el.addEventListener('input', fetchCatalog);
        el.addEventListener('change', fetchCatalog);
    });

    // Загружаем каталог при загрузке страницы с уже выбранной рубрикой "racing boats"
    fetchCatalog();
});
</script>

<?php
// get_sidebar();
get_footer();
?>