<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rowkz
 */

?>

<footer id="colophon" class="rk-footer">
	<div class="container">
		<div class="row g-4">
			<div class="col-lg-4">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="rk-footer__brand"><?php bloginfo( 'name' ); ?></a>
				<p class="rk-footer__muted"><?php echo esc_html( rowkz_t( 'Официальный дистрибьютор Swift в Казахстане. Лодки, вёсла, тренажеры и оснащение для академической гребли.' ) ); ?></p>
			</div>
			<div class="col-6 col-lg-2">
				<h4><?php echo esc_html( rowkz_t( 'Каталог' ) ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-lodki.php' ) ); ?>"><?php echo esc_html( rowkz_t( 'Лодки' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-vesla copy.php' ) ); ?>"><?php echo esc_html( rowkz_t( 'Вёсла' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-trenajery.php' ) ); ?>"><?php echo esc_html( rowkz_t( 'Тренажеры' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-komplekt.php' ) ); ?>"><?php echo esc_html( rowkz_t( 'Комплектующие' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-accessuary.php' ) ); ?>"><?php echo esc_html( rowkz_t( 'Аксессуары' ) ); ?></a></li>
				</ul>
			</div>
			<div class="col-6 col-lg-2">
				<h4><?php echo esc_html( rowkz_t( 'Компания' ) ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-about.php' ) ); ?>"><?php echo esc_html( rowkz_t( 'О нас' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>"><?php echo esc_html( rowkz_t( 'Контакты' ) ); ?></a></li>
				</ul>
			</div>
			<div class="col-lg-4">
				<h4><?php echo esc_html( rowkz_t( 'Контакты' ) ); ?></h4>
				<ul>
					<li><i class="bi bi-envelope"></i> <a href="mailto:info@example.com">info@example.com</a></li>
					<li><i class="bi bi-telephone"></i> <a href="tel:+79999999999">+7 (999) 999-99-99</a></li>
				</ul>
			</div>
		</div>
		<div class="rk-footer__bottom">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php echo esc_html( rowkz_t( 'Все права защищены.' ) ); ?></div>
	</div>
</footer>
</div><!-- #page -->

<!-- Модальное окно корзины и оформления заявки -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
		<div class="modal-content rk-cart">
			<div class="modal-header">
				<h5 class="modal-title" id="cartModalLabel"><?php echo esc_html( rowkz_t( 'Ваша заявка' ) ); ?></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo esc_attr( rowkz_t( 'Закрыть' ) ); ?>"></button>
			</div>

			<div class="modal-body">
				<div class="rk-steps" aria-hidden="true">
					<span class="rk-step is-active" data-step="cart"><?php echo esc_html( rowkz_t( '1. Товары' ) ); ?></span>
					<span class="rk-step" data-step="form"><?php echo esc_html( rowkz_t( '2. Контакты' ) ); ?></span>
					<span class="rk-step" data-step="done"><?php echo esc_html( rowkz_t( '3. Готово' ) ); ?></span>
				</div>

				<div data-pane="cart">
					<div id="cart-content">
						<div class="cart-empty">
							<i class="bi bi-bag-x"></i>
							<p><?php echo esc_html( rowkz_t( 'В заявке пока нет товаров' ) ); ?></p>
						</div>
					</div>
				</div>

				<form id="rk-checkout-form" data-pane="form" hidden novalidate>
					<p class="rk-muted mb-3"><?php echo esc_html( rowkz_t( 'Оставьте контакты — менеджер свяжется с вами, уточнит комплектацию и пришлёт цену с доставкой.' ) ); ?></p>
					<div class="row g-3">
						<div class="col-12">
							<label class="form-label" for="rk-name"><?php echo esc_html( rowkz_t( 'Имя' ) ); ?> <span aria-hidden="true">*</span></label>
							<input class="form-control" id="rk-name" name="name" autocomplete="name" required maxlength="80">
							<div class="invalid-feedback" data-error="name"></div>
						</div>
						<div class="col-md-6">
							<label class="form-label" for="rk-phone"><?php echo esc_html( rowkz_t( 'Телефон' ) ); ?> <span aria-hidden="true">*</span></label>
							<input class="form-control" id="rk-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="+7 700 000 00 00" required maxlength="25">
							<div class="invalid-feedback" data-error="phone"></div>
						</div>
						<div class="col-md-6">
							<label class="form-label" for="rk-email">Email <span aria-hidden="true">*</span></label>
							<input class="form-control" id="rk-email" name="email" type="email" autocomplete="email" placeholder="name@mail.kz" required maxlength="120">
							<div class="invalid-feedback" data-error="email"></div>
						</div>
						<div class="col-12">
							<label class="form-label" for="rk-comment"><?php echo esc_html( rowkz_t( 'Комментарий' ) ); ?> <span class="rk-muted"><?php echo esc_html( rowkz_t( '(необязательно)' ) ); ?></span></label>
							<textarea class="form-control" id="rk-comment" name="comment" rows="3" maxlength="1000" placeholder="<?php echo esc_attr( rowkz_t( 'Вес гребцов, город доставки, сроки…' ) ); ?>"></textarea>
						</div>
						<div class="rk-hp" aria-hidden="true"><label><?php echo esc_html( rowkz_t( 'Сайт' ) ); ?> <input name="website" tabindex="-1" autocomplete="off"></label></div>
					</div>
					<div class="alert alert-danger mt-3 mb-0" role="alert" data-form-error hidden></div>
					<p class="rk-muted small mt-3 mb-0"><?php echo esc_html( rowkz_t( 'Нажимая «Отправить заявку», вы соглашаетесь на обработку контактных данных для связи по заявке.' ) ); ?></p>
				</form>

				<div data-pane="done" hidden class="rk-done">
					<i class="bi bi-check2-circle"></i>
					<h3><?php echo esc_html( rowkz_t( 'Заявка отправлена' ) ); ?></h3>
					<p><?php echo esc_html( rowkz_t( 'Номер заявки:' ) ); ?> <strong data-order-number></strong>. <?php echo esc_html( rowkz_t( 'Мы свяжемся с вами в ближайшее рабочее время.' ) ); ?></p>
				</div>
			</div>

			<div class="modal-footer">
				<div class="cart-total d-none me-auto"><?php echo esc_html( rowkz_t( 'Итого:' ) ); ?> <span id="cart-total"><?php echo esc_html( rowkz_t( 'Цена по запросу' ) ); ?></span></div>
				<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" data-role="close"><?php echo esc_html( rowkz_t( 'Продолжить выбор' ) ); ?></button>
				<button type="button" class="btn btn-outline-primary" data-role="back" hidden><?php echo esc_html( rowkz_t( 'Назад' ) ); ?></button>
				<button type="button" class="btn btn-primary d-none" id="checkout-btn"><?php echo esc_html( rowkz_t( 'Оформить заявку' ) ); ?></button>
				<button type="submit" class="btn btn-primary" form="rk-checkout-form" data-role="submit" hidden><?php echo esc_html( rowkz_t( 'Отправить заявку' ) ); ?></button>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
