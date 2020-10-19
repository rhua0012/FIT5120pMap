<?php
/**
 * The sidebar containing the main widget area
 *
 * @package BlogGrid
 */

if ( ! is_active_sidebar( 'bloggrid-sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'bloggrid-sidebar-1' ); ?>
</aside><!-- #secondary -->
