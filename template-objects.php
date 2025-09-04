<?php
/*
Template Name: Categories Template
*/

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section bg-light py-5 text-center position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn">Каталог товаров</h1>
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
                <div class="col-md-5">
                    <input type="text" name="s" class="form-control shadow-sm" placeholder="Найти товар по названию или описанию">
                </div>
                <div class="col-md-3">
                    <?php
                    $categories = get_categories(['hide_empty' => true]);
                    ?>
                    <select name="cat" class="form-select shadow-sm">
                        <option value="">Любая категория</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
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
                cat: formData.get('cat') || ''
            })
        })
        .then(response => response.text())
        .then(html => {
            results.innerHTML = html;
        });
    }

    document.getElementById('catalog-filter').addEventListener('submit', function(e) {
        e.preventDefault();
        fetchCatalog();
    });

    // Реальный фильтр: реагировать на ввод и выбор
    document.querySelectorAll('#catalog-filter input, #catalog-filter select').forEach(el => {
        el.addEventListener('input', fetchCatalog);
        el.addEventListener('change', fetchCatalog);
    });

    // Первый запуск
    fetchCatalog();
});
</script>

<?php
// get_sidebar();
get_footer();
?>