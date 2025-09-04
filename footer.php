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

<footer id="colophon" class="site-footer bg-swift" style="padding: 40px 0; color: #fff;">
    <div class="container" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start;">
        <div class="footer-logo" style="flex: 1 1 200px; margin-bottom: 20px;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #fff; text-decoration: none; font-weight: bold; font-size: 1.5rem;">
                <?php bloginfo('name'); ?>
            </a>
            <p style="margin-top: 10px; color: #b0b0b0;"><?php bloginfo('description'); ?></p>
        </div>
        <nav class="footer-nav" style="flex: 1 1 200px; margin-bottom: 20px;">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class'     => 'footer-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </nav>
        <div class="footer-contacts" style="flex: 1 1 200px; margin-bottom: 20px;">
            <h4 style="margin-bottom: 10px;">Контакты</h4>
            <ul style="list-style: none; padding: 0; color: #b0b0b0;">
                <li>Email: <a href="mailto:info@example.com" style="color: #fff;">info@example.com</a></li>
                <li>Телефон: <a href="tel:+79999999999" style="color: #fff;">+7 (999) 999-99-99</a></li>
            </ul>
        </div>
    </div>
    <div class="site-info" style="text-align: center; margin-top: 30px; color: #b0b0b0; font-size: 0.95rem;">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Все права защищены.
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
