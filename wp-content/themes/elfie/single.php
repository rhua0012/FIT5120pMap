<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Elfie
 */

get_header();

$disable_sidebar 	= get_theme_mod( 'disable_single_sidebar' );
$nosidebar 			= $disable_sidebar ? 'nosidebar' : '';
?>

	<div id="primary" class="content-area col-lg-9 <?php echo $nosidebar; ?>">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			do_action( 'elfie_after_single_content' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( !$disable_sidebar ) {
	get_sidebar();
}
get_footer();
