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
								<source srcset="<?php echo get_template_directory_uri();?>/img/a51400_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a5800_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a5600_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item" data-bs-interval="2000">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a42000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a41400_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a4800_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a4600_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a32000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a31400_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a3800_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a3600_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a22000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a21400_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a2800_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a2600_561.png" class="d-block w-100 img-fluid" alt="...">
							</picture>
							</div>
							<div class="carousel-item">
							<picture>
								<source srcset="<?php echo get_template_directory_uri();?>/img/a12000_561.png" media="(min-width: 1400px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a11400_561.png" media="(min-width: 768px)">
								<source srcset="<?php echo get_template_directory_uri();?>/img/a1800_561.png" media="(min-width: 576px)">
								<img src="<?php echo get_template_directory_uri();?>/img/a1600_561.png" class="d-block w-100 img-fluid" alt="...">
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
				<div class="col-md-12 text-left">
					<h2 class="section-2-h2">Добро пожаловать в Rowkz!</h2>
					<p class="section-2-p">Мы являемся официальным дистрибьютором компании Swift, которая с 2005 года производит лодки для академической гребли, аксессуары, вёсла, системы хранения и инфраструктуру для гребных баз. Сегодня Swift — один из крупнейших производителей в мире, представленный более чем в 50 странах. <br/> Наша цель — сделать греблю доступной и комфортной. Мы предлагаем полный ассортимент продукции Swift: от лодок и вёсел до решений для обустройства гребных клубов и спортивных школ. <br/> Выбирая Rowkz, вы получаете проверенное качество, современные технологии и надёжного партнёра в мире академической гребли.</p>
				</div>
			</div>
		</div>
	</section>
<section class="section-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="image-card" style="position: relative; overflow: hidden; border-radius: 12px;">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg" alt="Картинка 1" class="img-fluid" style="width:100%; height:320px; object-fit:cover;">
                            <div class="image-card-text" style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(39,39,42,0.7); color: #fff; padding: 20px;">
                                <h3 style="margin:0;">Заголовок 1</h3>
                                <p style="margin:0;">Описание или текст для первой картинки.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="image-card" style="position: relative; overflow: hidden; border-radius: 12px;">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg" alt="Картинка 2" class="img-fluid" style="width:100%; height:320px; object-fit:cover;">
                            <div class="image-card-text" style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(39,39,42,0.7); color: #fff; padding: 20px;">
                                <h3 style="margin:0;">Заголовок 2</h3>
                                <p style="margin:0;">Описание или текст для второй картинки.</p>
                            </div>
                        </div>
                    </div>
                </div>
				<!-- Categories ->> -->
				 <div class="row">
						<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
							<div style="position: relative;">
								<img
									src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg"
									class="w-100 shadow-1-strong rounded mb-4"
									alt="Boat on Calm Water"
								/>
								<div style="position: absolute; bottom: 16px; left: 16px; color: #fff; background: rgba(39,39,42,0.6); padding: 10px 18px; border-radius: 8px;">
									<strong>Лодка на воде</strong><br>
								</div>
							</div>
							<div style="position: relative;">
								<img
									src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg"
									class="w-100 shadow-1-strong rounded mb-4"
									alt="Wintry Mountain Landscape"
								/>
								<div style="position: absolute; bottom: 16px; left: 16px; color: #fff; background: rgba(39,39,42,0.6); padding: 10px 18px; border-radius: 8px;">
									<strong>Лодка на воде</strong><br>
								</div>
							</div>
						</div>

						<div class="col-lg-4 mb-4 mb-lg-0">
							<div style="position: relative;">
								<img
									src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg"
									class="w-100 shadow-1-strong rounded mb-4"
									alt="Mountains in the Clouds"
								/>
								<div style="position: absolute; bottom: 16px; left: 16px; color: #fff; background: rgba(39,39,42,0.6); padding: 10px 18px; border-radius: 8px;">
									<strong>Горы в облаках</strong>
								</div>
							</div>
							<div style="position: relative;">
								<img
									src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg"
									class="w-100 shadow-1-strong rounded mb-4"
									alt="Boat on Calm Water"
								/>
								<div style="position: absolute; bottom: 16px; left: 16px; color: #fff; background: rgba(39,39,42,0.6); padding: 10px 18px; border-radius: 8px;">
									<strong>Лодка на воде</strong>
								</div>
							</div>
						</div>

						<div class="col-lg-4 mb-4 mb-lg-0">
							<div style="position: relative;">
								<img
									src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg"
									class="w-100 shadow-1-strong rounded mb-4"
									alt="Waves at Sea"
								/>
								<div style="position: absolute; bottom: 16px; left: 16px; color: #fff; background: rgba(39,39,42,0.6); padding: 10px 18px; border-radius: 8px;">
									<strong>Морские волны</strong>
								</div>
							</div>
							<div style="position: relative;">
								<img
									src="<?php echo get_template_directory_uri(); ?>/img/WelshRowingCO_09Jul2024-392x272.jpg"
									class="w-100 shadow-1-strong rounded mb-4"
									alt="Yosemite National Park"
								/>
								<div style="position: absolute; bottom: 16px; left: 16px; color: #fff; background: rgba(39,39,42,0.6); padding: 10px 18px; border-radius: 8px;">
									<strong>Йосемити</strong>
								</div>
							</div>
						</div>
					</div>
<!-- Categories -<< -->
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
  <!-- End of new section with logos -->
            </div>
            <div class="col-md-4 text-center">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>


	</main>
<!-- #main -->

<?php

get_footer();
