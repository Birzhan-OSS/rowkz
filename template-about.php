<?php
/*
Template Name: About Template
*/

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section bg-light py-5 text-center position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn">О нас</h1>
            <p class="lead mb-4 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                Откройте для себя нашу историю, нашу страсть и людей, стоящих за нашей миссией.
            </p>
        </div>
        <div class="hero-overlay position-absolute bottom-0 start-0 w-100" style="height: 50px; background: linear-gradient(to top, rgba(255,255,255,1), transparent);"></div>
    </section>

    <!-- Our Story Section -->
    <section id="our-story" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about-story.jpg" alt="Наша история" class="img-fluid rounded shadow animate__animated animate__fadeInLeft">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Наша история</h2>
                    <p class="text-muted">
                        Основанная в [Год], наша компания начинала с простой идеи: [вставьте миссию, например, "сделать мир лучше с помощью инноваций"]. Со временем мы выросли в команду увлечённых специалистов, посвятивших себя достижению совершенства. Наш путь основан на креативности, сотрудничестве и стремлении к качеству.
                    </p>
                    <p class="text-muted">
                        От скромных начинаний до статуса надёжного имени в [индустрии] — мы гордимся тем, что продолжаем двигать границы возможного и создавать значимый вклад.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Наша команда</h2>
            <div class="row g-4">
                <!-- Team Member 1 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center animate__animated animate__zoomIn">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-member1.jpg" class="card-img-top rounded-circle mx-auto mt-3" alt="Член команды" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Джон Доу</h5>
                            <p class="card-text text-muted">Генеральный директор и основатель</p>
                            <p class="card-text">Джон ведёт компанию вперёд с видением и страстью.</p>
                        </div>
                    </div>
                </div>
                <!-- Team Member 2 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center animate__animated animate__zoomIn" style="animation-delay: 0.2s;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-member2.jpg" class="card-img-top rounded-circle mx-auto mt-3" alt="Член команды" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Джейн Смит</h5>
                            <p class="card-text text-muted">Креативный директор</p>
                            <p class="card-text">Джейн приносит креативность и инновации в каждый проект.</p>
                        </div>
                    </div>
                </div>
                <!-- Team Member 3 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center animate__animated animate__zoomIn" style="animation-delay: 0.4s;">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-member3.jpg" class="card-img-top rounded-circle mx-auto mt-3" alt="Член команды" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Алекс Браун</h5>
                            <p class="card-text text-muted">Ведущий разработчик</p>
                            <p class="card-text">Алекс создаёт безупречные цифровые решения с помощью кода.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Наши ценности</h2>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="p-4 animate__animated animate__fadeInUp">
                        <i class="bi bi-heart-fill text-primary display-4 mb-3"></i>
                        <h4>Страсть</h4>
                        <p class="text-muted">Мы вкладываем душу во всё, что делаем, движимые любовью к совершенству.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                        <i class="bi bi-people-fill text-primary display-4 mb-3"></i>
                        <h4>Сотрудничество</h4>
                        <p class="text-muted">Вместе мы достигаем большего, развивая командную работу и открытое общение.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <i class="bi bi-lightbulb-fill text-primary display-4 mb-3"></i>
                        <h4>Инновации</h4>
                        <p class="text-muted">Мы приветствуем креативность и расширяем границы возможного.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

<?php
// get_sidebar();
get_footer();
?>