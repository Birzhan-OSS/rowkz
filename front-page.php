<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rowkz
 */

get_header();
?>

	<main id="primary" class="site-main">
<section class="section-1">
		<!-- carussel -->
		 <div class="container">
			<div class="row">
				<div class="col-md-12">
						<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active" data-bs-interval="10000">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a52000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a52000_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a52000_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a52000_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item" data-bs-interval="2000">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a42000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a42000_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a42000_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a42000_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a32000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a32000_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a32000_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a32000_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a22000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a22000_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a22000_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a22000_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a12000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a12000_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a12000_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a12000_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
						</div>
				</div>
			</div>
		 </div>
			

	</section>
	<section class="section-2">
		<div class="container pb-5	pt-5">
			<div class="row">
				<div class="col-md-12 text-left speech ">
					<h2 class="section-2-h2" style="color:#207daf; font-weight:700;">Добро пожаловать в Rowkz!</h2>
					<p class="section-2-p" >Мы являемся официальным дистрибьютором компании Swift, которая с 2005 года производит лодки для академической гребли, аксессуары, вёсла, системы хранения и инфраструктуру для гребных баз. Сегодня Swift — один из крупнейших производителей в мире, представленный более чем в 50 странах. <br/> Наша цель — сделать греблю доступной и комфортной. Мы предлагаем полный ассортимент продукции Swift: от лодок и вёсел до решений для обустройства гребных клубов и спортивных школ. <br/> Выбирая Rowkz, вы получаете проверенное качество, современные технологии и надёжного партнёра в мире академической гребли.</p>
				</div>
			</div>
		</div>
	</section>

<!-- Categories -<< -->
 <section class="section-3 bg-light py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <img src="<?php echo get_template_directory_uri(); ?>/img/7.jpg" alt="Современная гребная лодка" class="img-fluid rounded shadow" style="object-fit:cover; width:100%; min-height:120px;">
            </div>
            <div class="col-lg-8">
                <h2 class="mb-3" style="color:#207daf; font-weight:700;">Инновации в каждой детали</h2>
                <p style="font-size:1.15rem; color:#394247;">
                    Компания swiftracing — мировой лидер в производстве лодок для академической гребли. Мы предлагаем современные решения для спортсменов, тренеров и клубов: от лёгких и прочных корпусов до эргономичных вёсел и аксессуаров.
                </p>
                <ul class="list-unstyled mb-4" >
                    <li><i class="bi bi-check-circle-fill me-2"></i>Премиальные материалы и технологии</li>
                    <li><i class="bi bi-check-circle-fill me-2"></i>Гарантия качества и надёжности</li>
                    <li><i class="bi bi-check-circle-fill me-2"></i>Поддержка и сервис по всей России</li>
                </ul>
                <!-- <a href="#" class="btn btn-primary px-4 py-2">Смотреть каталог</a> -->
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <i class="bi bi-tsunami" style="font-size: 3rem; color:#207daf; margin-bottom:16px;"></i>
                    <h5 class="mb-2" >Лодки для гребли</h5>
                    <p style="font-size:1rem; color:#394247;">Широкий выбор моделей для новичков и профессионалов. Индивидуальный подбор под ваши задачи.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <i class="bi bi-life-preserver" style="font-size: 3rem; color:#207daf; margin-bottom:16px;"></i>
                    <h5 class="mb-2" >Вёсла и аксессуары</h5>
                    <p style="font-size:1rem; color:#394247;">Современные вёсла, аксессуары, тренажеры и всё необходимое для тренировок и соревнований.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <i class="bi bi-headset" style="font-size: 3rem; color:#207daf; margin-bottom:16px;"></i>
                    <h5 class="mb-2" >Сервис и поддержка</h5>
                    <p style="font-size:1rem; color:#394247;">Консультации, гарантийное и постгарантийное обслуживание, помощь в выборе и эксплуатации.</p>
                </div>
            </div>
        </div>
    </div>
</section>
 <!-- New section with logos -->
  <section id="block-13" class="widget widget_block widget_media_image py-5">
    <div class="container text-center">
        <figure class="wp-block-image size-full m-0">
            <img 
                decoding="async" 
                width="876" 
                height="357" 
                src="https://swiftracing.com/wp-content/uploads/2025/05/logos-hrz-30May2025.png" 
                alt="Логотипы партнеров" 
                class="wp-image-8845 img-fluid"
                srcset="https://swiftracing.com/wp-content/uploads/2025/05/logos-hrz-30May2025.png 876w, https://swiftracing.com/wp-content/uploads/2025/05/logos-hrz-30May2025-130x53.png 130w, https://swiftracing.com/wp-content/uploads/2025/05/logos-hrz-30May2025-768x313.png 768w" 
                sizes="(max-width: 876px) 100vw, 876px"
            >
        </figure>
    </div>
</section>
 


	</main>
<!-- #main -->

<?php

get_footer();
