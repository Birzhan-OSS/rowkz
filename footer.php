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
				<p class="rk-footer__muted">Официальный дистрибьютор Swift в Казахстане. Лодки, вёсла, тренажеры и оснащение для академической гребли.</p>
			</div>
			<div class="col-6 col-lg-2">
				<h4>Каталог</h4>
				<ul>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-lodki.php' ) ); ?>">Лодки</a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-vesla copy.php' ) ); ?>">Вёсла</a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-trenajery.php' ) ); ?>">Тренажеры</a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-komplekt.php' ) ); ?>">Комплектующие</a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-accessuary.php' ) ); ?>">Аксессуары</a></li>
				</ul>
			</div>
			<div class="col-6 col-lg-2">
				<h4>Компания</h4>
				<ul>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-about.php' ) ); ?>">О нас</a></li>
					<li><a href="<?php echo esc_url( rowkz_page_url( 'template-contact.php' ) ); ?>">Контакты</a></li>
				</ul>
			</div>
			<div class="col-lg-4">
				<h4>Контакты</h4>
				<ul>
					<li><i class="bi bi-envelope"></i> <a href="mailto:info@example.com">info@example.com</a></li>
					<li><i class="bi bi-telephone"></i> <a href="tel:+79999999999">+7 (999) 999-99-99</a></li>
				</ul>
			</div>
		</div>
		<div class="rk-footer__bottom">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Все права защищены.</div>
	</div>
</footer>
</div><!-- #page -->

<!-- Модальное окно корзины и оформления заявки -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
		<div class="modal-content rk-cart">
			<div class="modal-header">
				<h5 class="modal-title" id="cartModalLabel">Ваша заявка</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
			</div>

			<div class="modal-body">
				<div class="rk-steps" aria-hidden="true">
					<span class="rk-step is-active" data-step="cart">1. Товары</span>
					<span class="rk-step" data-step="form">2. Контакты</span>
					<span class="rk-step" data-step="done">3. Готово</span>
				</div>

				<div data-pane="cart">
					<div id="cart-content">
						<div class="cart-empty">
							<i class="bi bi-bag-x"></i>
							<p>В заявке пока нет товаров</p>
						</div>
					</div>
				</div>

				<form id="rk-checkout-form" data-pane="form" hidden novalidate>
					<p class="rk-muted mb-3">Оставьте контакты — менеджер свяжется с вами, уточнит комплектацию и пришлёт цену с доставкой.</p>
					<div class="row g-3">
						<div class="col-12">
							<label class="form-label" for="rk-name">Имя <span aria-hidden="true">*</span></label>
							<input class="form-control" id="rk-name" name="name" autocomplete="name" required maxlength="80">
							<div class="invalid-feedback" data-error="name"></div>
						</div>
						<div class="col-md-6">
							<label class="form-label" for="rk-phone">Телефон <span aria-hidden="true">*</span></label>
							<input class="form-control" id="rk-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="+7 700 000 00 00" required maxlength="25">
							<div class="invalid-feedback" data-error="phone"></div>
						</div>
						<div class="col-md-6">
							<label class="form-label" for="rk-email">Email <span aria-hidden="true">*</span></label>
							<input class="form-control" id="rk-email" name="email" type="email" autocomplete="email" placeholder="name@mail.kz" required maxlength="120">
							<div class="invalid-feedback" data-error="email"></div>
						</div>
						<div class="col-12">
							<label class="form-label" for="rk-comment">Комментарий <span class="rk-muted">(необязательно)</span></label>
							<textarea class="form-control" id="rk-comment" name="comment" rows="3" maxlength="1000" placeholder="Вес гребцов, город доставки, сроки…"></textarea>
						</div>
						<div class="rk-hp" aria-hidden="true"><label>Сайт <input name="website" tabindex="-1" autocomplete="off"></label></div>
					</div>
					<div class="alert alert-danger mt-3 mb-0" role="alert" data-form-error hidden></div>
					<p class="rk-muted small mt-3 mb-0">Нажимая «Отправить заявку», вы соглашаетесь на обработку контактных данных для связи по заявке.</p>
				</form>

				<div data-pane="done" hidden class="rk-done">
					<i class="bi bi-check2-circle"></i>
					<h3>Заявка отправлена</h3>
					<p>Номер заявки: <strong data-order-number></strong>. Мы свяжемся с вами в ближайшее рабочее время.</p>
				</div>
			</div>

			<div class="modal-footer">
				<div class="cart-total d-none me-auto">Итого: <span id="cart-total">Цена по запросу</span></div>
				<button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" data-role="close">Продолжить выбор</button>
				<button type="button" class="btn btn-outline-primary" data-role="back" hidden>Назад</button>
				<button type="button" class="btn btn-primary d-none" id="checkout-btn">Оформить заявку</button>
				<button type="submit" class="btn btn-primary" form="rk-checkout-form" data-role="submit" hidden>Отправить заявку</button>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
