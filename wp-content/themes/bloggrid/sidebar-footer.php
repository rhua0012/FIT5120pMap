<?php
/**
 * The sidebar containing footer widget areas
 *
 * @package BlogGrid
 */

if ( ! is_active_sidebar( 'bloggrid-footer-1' ) &&
	! is_active_sidebar( 'bloggrid-footer-2' ) &&
	! is_active_sidebar( 'bloggrid-footer-3' ) ) {
	return;
}
?>

<div class="container bg-footer-widgets">
	<div class="row">
		<div class="col-md-4">
			<?php
				if ( is_active_sidebar( 'bloggrid-footer-1' ) ) :
					dynamic_sidebar( 'bloggrid-footer-1' );
				endif;
			?>
		</div>

		<div class="col-md-4">
			<?php
				if ( is_active_sidebar( 'bloggrid-footer-2' ) ) :
					dynamic_sidebar( 'bloggrid-footer-2' );
				endif;
			?>
		</div>

		<div class="col-md-4">
			<?php
				if ( is_active_sidebar( 'bloggrid-footer-3' ) ) :
					dynamic_sidebar( 'bloggrid-footer-3' );
				endif;
			?>
		</div>
	</div>
</div>