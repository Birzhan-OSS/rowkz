<?php
/*
Template Name: Contact Template
*/

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section bg-light py-5 text-center position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn">Свяжитесь с нами</h1>
            <p class="lead mb-4 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                Мы всегда готовы помочь! Обращайтесь с любыми вопросами или идеями — давайте будем на связи.
            </p>
            <a href="#contact-form" class="btn btn-primary btn-lg animate__animated animate__pulse" style="animation-delay: 0.4s;">Связаться</a>
        </div>
        <div class="hero-overlay position-absolute bottom-0 start-0 w-100" style="height: 50px; background: linear-gradient(to top, rgba(255,255,255,1), transparent);"></div>
    </section>

    <!-- Contact Form and Details Section -->
    <section id="contact-form" class="py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4 animate__animated animate__fadeInLeft">Отправьте нам сообщение</h2>
                    <?php
                    // Use Contact Form 7 or any other form plugin shortcode
                    echo do_shortcode('[contact-form-7 id="YOUR_FORM_ID" title="Contact Form"]');
                    ?>
                </div>
                <!-- Contact Details -->
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4 animate__animated animate__fadeInRight">Наши контакты</h2>
                    <div class="p-4 bg-light rounded shadow-sm">
                        <div class="mb-4">
                            <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                            <strong>Адрес:</strong> 123 Business Street, City, Country
                        </div>
                        <div class="mb-4">
                            <i class="bi bi-telephone-fill text-primary me-2"></i>
                            <strong>Телефон:</strong> <a href="tel:+1234567890" class="text-decoration-none">+1 (234) 567-890</a>
                        </div>
                        <div class="mb-4">
                            <i class="bi bi-envelope-fill text-primary me-2"></i>
                            <strong>Email:</strong> <a href="mailto:info@yourcompany.com" class="text-decoration-none">info@yourcompany.com</a>
                        </div>
                        <div>
                            <i class="bi bi-clock-fill text-primary me-2"></i>
                            <strong>Часы работы:</strong> Пн–Пт, 9:00 – 17:00
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 animate__animated animate__fadeInUp">Мы на карте</h2>
            <div class="ratio ratio-16x9 shadow rounded animate__animated animate__zoomIn">
                <!-- Replace with your Google Maps embed or other map service -->
                <iframe src="https://www.google.com/maps/embed?pb=YOUR_MAP_EMBED_URL" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>


</main>

<?php
// get_sidebar();
get_footer();
?>