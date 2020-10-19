<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elfie
 */

get_header();

$blog_layout = elfie_blog_layout();
?>

	<div id="primary" class="content-area col-lg-9">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<div class="posts-loop">
				<div class="row">
				<?php
				/* Start the Loop */
				$counter 	= 0;
				$is_paged 	= is_paged();

				while ( have_posts() ) :
					the_post();

					if ( $blog_layout['layout'] === 'layout-mixed' ) {
						if ( $counter == 0 && !$is_paged ) {
							get_template_part( 'template-parts/content', 'large' );
						} else {
							get_template_part( 'template-parts/content', 'list' );
						}
					} else {
						get_template_part( 'template-parts/content', 'large' );
					}

				$counter++;
				endwhile;
				?>
				</div>
			</div>
			<?php

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ( $blog_layout['layout'] !== 'layout-3cols' ) {
	get_sidebar();
}
get_footer();
