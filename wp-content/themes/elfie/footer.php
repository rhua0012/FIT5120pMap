<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elfie
 */

?>

			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->

	<?php do_action( 'elfie_footer_before' ); ?>

	<footer id="colophon" class="site-footer">
		<?php do_action( 'elfie_footer' ); ?>
	</footer><!-- #colophon -->
	
	<?php do_action( 'elfie_footer_after' ); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
