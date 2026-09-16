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

<!-- Модальное окно корзины -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Ваша заявка</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cart-content">
                    <div class="cart-empty">
                        <i class="bi bi-cart-x" style="font-size: 3rem; color: #ccc;"></i>
                        <p>Ваша корзина пуста</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="cart-total d-none">
                    Итого: <span id="cart-total">Цена по запросу</span>
                </div>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Продолжить выбор</button>
                <button type="button" class="btn btn-primary d-none" id="checkout-btn">Оформить заказ</button>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
