<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rowkz
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="sidebar-block mb-4" style="background: #27272A; color: #fff; padding: 20px;">
    <h5 style="font-weight:400;">Полезные ссылки</h5>
</div>
<div class="sidebar-block mb-4" style="background: #27272A; color: #fff;padding: 20px;">
    <h5 style="font-weight:400;">Доставка и оплата</h5>
</div>

<aside id="secondary" class="widget-area" style="padding: 24px; background: #fff; box-shadow: 0 4px 24px rgba(70,144,189,0.08);">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
<div class="sidebar-contact mt-4 p-3 mb-5" style="background: #f5faff; border-radius: 12px;">
	<strong>Связаться с нами:</strong><br>
	<a href="tel:+77072339261" style="color:#4690bd;">+7 707 233 92 61</a><br>
	<a href="mailto:info@example.com" style="color:#4690bd;">info@example.com</a>
</div>
<div class="sidebar-block mb-2" style="background: #27272A; color: #fff; padding: 10px;">
    <h5 style="font-weight:400;">Полезные ссылки</h5>
</div>
<div class="sidebar-block mb-2" style="background: #27272A; color: #fff;padding: 10px;">
    <h5 style="font-weight:400;">Доставка и оплата</h5>
</div>
