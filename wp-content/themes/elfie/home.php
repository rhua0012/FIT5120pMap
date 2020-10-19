<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif; ?>
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
			the_posts_pagination( 
				array( 
					'mid_size' => 1,
					'prev_text' => '&lt;',
					'next_text' => '&gt;', 
				)
			);

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
