<?php
/**
 * The template for displaying the footer
 *
 * @package BlogGrid
 */

?>

	<footer id="colophon" class="site-footer">
		
		<?php get_sidebar( 'footer' ); ?>
	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="site-info">
						<?php esc_html_e( 'WordPress Theme: ', 'bloggrid' ); ?>
						<a href="<?php echo esc_url( 'https://wp-points.com/themes/bloggrid/' ); ?>"><?php esc_html_e( 'BlogGrid', 'bloggrid' ); ?></a>
						<?php esc_html_e( ' by TwoPoints.', 'bloggrid' ); ?>
					</div><!-- .site-info -->
				</div>
			</div>
		</div>

		<?php if ( get_theme_mod( 'bloggrid_display_go_top', true ) ) : ?>
		<div id="bg-to-top" title="<?php esc_attr_e( 'Go to Top', 'bloggrid' ); ?>">
			<svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-up-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 8.354a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 6.207V11a.5.5 0 0 1-1 0V6.207L5.354 8.354z"/>
			</svg>
		</div>
		<?php endif; ?>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
