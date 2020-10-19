<?php
/**
 * The sidebar for Pages containing the main widget area
 *
 * @package BlogGrid
 */

if ( ! is_active_sidebar( 'bloggrid-page-sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'bloggrid-page-sidebar-1' ); ?>
</aside><!-- #secondary -->
