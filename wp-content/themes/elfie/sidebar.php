<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elfie
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || apply_filters( 'elfie_disable_sidebar', false ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-lg-3">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->