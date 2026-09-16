<?php
/*
Template Name: lodki-main Template
*/

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section bg-light py-5 text-center position-relative" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeIn">История и виды лодок Swift</h1>
            <p class="lead mb-4 animate__animated animate__fadeIn" style="animation-delay: 0.2s;">
                Компания Swift — это не просто производитель лодок, а целая философия развития академической гребли. С 2005 года мы создаём лодки для спортсменов любого уровня, внедряя инновации и сохраняя традиции. Наш ассортимент охватывает все направления: от тренировочных моделей до гоночных шедевров, от академических до прибрежных лодок и даже каяков.
            </p>
        </div>
        <div class="hero-overlay position-absolute bottom-0 start-0 w-100" style="height: 50px; background: linear-gradient(to top, rgba(255,255,255,1), transparent);"></div>
    </section>

    <!-- Cards Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Тренировочные -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#207daf;">Тренировочные лодки</h5>
                            <p class="card-text">
                                Тренировочные лодки Swift созданы для ежедневных занятий и обучения. Они отличаются устойчивостью, простотой управления и долговечностью. Идеальный выбор для новичков, спортивных школ и клубов, где важна надёжность и безопасность.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="https://rowkz.kz/?page_id=51" class="btn btn-outline-primary btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>

                <!-- Гоночные -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#207daf;">Гоночные лодки</h5>
                            <p class="card-text">
                                Гоночные модели — это воплощение скорости и инноваций. Использование современных материалов и аэродинамических форм позволяет достигать максимальных результатов на соревнованиях любого уровня. Выбор чемпионов и профессионалов.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="https://rowkz.kz/?page_id=33" class="btn btn-outline-primary btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>

                <!-- Для академии -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#207daf;">Лодки для академии</h5>
                            <p class="card-text">
                                Академические лодки Swift — это баланс между традициями и технологиями. Они подходят для учебных заведений, спортивных школ и университетов, где важны универсальность, прочность и простота обслуживания.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="https://rowkz.kz/?page_id=53" class="btn btn-outline-primary btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>

                <!-- Для прибрежной гребли -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#207daf;">Для прибрежной гребли</h5>
                            <p class="card-text">
                                Прибрежные лодки разработаны для сложных условий: волн, ветра и переменчивой погоды. Они обладают повышенной устойчивостью и проходимостью, что делает их идеальными для тренировок и соревнований на открытой воде.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="https://rowkz.kz/?page_id=57" class="btn btn-outline-primary btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>

                <!-- Каяк -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title" style="color:#207daf;">Каяк</h5>
                            <p class="card-text">
                                Каяки Swift — это универсальные лодки для активного отдыха, туризма и спорта. Лёгкие, манёвренные и надёжные, они подходят как для спокойных прогулок, так и для динамичных сплавов по рекам и озёрам.
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="https://rowkz.kz/?page_id=55" class="btn btn-outline-primary btn-sm">Подробнее</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>