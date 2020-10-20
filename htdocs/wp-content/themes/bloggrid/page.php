<?php
/**
 * The template for displaying all pages
 *
 * @package BlogGrid
 */

get_header();
?>

<?php
	$bloggrid_content_col_class = '';
	$bloggrid_primary_cols_class = '';
	$bloggrid_sidebar_col_class = '';
	if ( get_theme_mod( 'bloggrid_page_sidebar_position', 'hide' ) === 'hide' ) {
		$bloggrid_content_col_class = 'col-md-12';
		$bloggrid_primary_cols_class = 'row-cols-md-3';
		$bloggrid_sidebar_col_class = '';
	}
	elseif ( get_theme_mod( 'bloggrid_page_sidebar_position', 'hide' ) === 'left' ) {
		$bloggrid_content_col_class = 'col-md-8 order-md-2';
		$bloggrid_primary_cols_class = 'row-cols-md-2';
		$bloggrid_sidebar_col_class = 'col-md-4 order-md-1';
	}
	else {
		$bloggrid_content_col_class = 'col-md-8';
		$bloggrid_primary_cols_class = 'row-cols-md-2';
		$bloggrid_sidebar_col_class = 'col-md-4';
	}
?>

<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr( $bloggrid_content_col_class ); ?>">
				<main id="primary" class="site-main">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div>

			<?php if ( get_theme_mod( 'bloggrid_page_sidebar_position', 'hide' ) != 'hide' ) : ?>
				<div class="<?php echo esc_attr( $bloggrid_sidebar_col_class ); ?>">
					<?php 
					if ( get_theme_mod( 'bloggrid_use_separate_sidebar_page', false ) ) {
						get_sidebar( 'page' ); 
					}
					else {
						get_sidebar(); 
					}
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
get_footer();
