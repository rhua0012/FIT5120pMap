<?php
/**
 *
 * @package Elfie
 */
?>
	<div class="col-md-4">
		<div class="widgets-column">
			<?php dynamic_sidebar( 'footer-1'); ?>
		</div>		
	</div>
	<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
	<div class="col-md-4">
		<div class="widgets-column">
			<?php dynamic_sidebar( 'footer-2'); ?>
		</div>
	</div>
	<?php endif; ?>	
	<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
	<div class="col-md-4">
		<div class="widgets-column">
			<?php dynamic_sidebar( 'footer-3'); ?>
		</div>
	</div>
	<?php endif; ?>