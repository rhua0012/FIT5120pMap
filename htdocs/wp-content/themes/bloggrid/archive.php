<?php
/**
 * The template for displaying archive pages
 *
 * @package BlogGrid
 */

get_header();
?>

<?php
	$bloggrid_content_col_class = '';
	$bloggrid_primary_cols_class = '';
	$bloggrid_sidebar_col_class = '';
	if ( get_theme_mod( 'bloggrid_archive_sidebar_position', 'hide' ) === 'hide' ) {
		$bloggrid_content_col_class = 'col-md-12';
		$bloggrid_primary_cols_class = 'row-cols-md-3';
		$bloggrid_sidebar_col_class = '';
	}
	elseif ( get_theme_mod( 'bloggrid_archive_sidebar_position', 'hide' ) === 'left' ) {
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

					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->

						<div class="row row-cols-1 row-cols-sm-2 bg-posts-row <?php echo esc_attr( $bloggrid_primary_cols_class ); ?>">
							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								?>
								<div class="col">
									<?php get_template_part( 'template-parts/content-archive', get_post_type() ); ?>
								</div>
								<?php

							endwhile;
							?>
						</div>
						
						<?php
						
						the_posts_navigation( array(
							'next_text' => '<span class="bg-post-nav-label bg-button">' . esc_html__( 'Newer Posts', 'bloggrid' ) . '<svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M10.146 4.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 8l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
									<path fill-rule="evenodd" d="M2 8a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8z"/>
								</svg>',
							'prev_text' => '<span class="bg-post-nav-label bg-button"><svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
									<path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
								</svg>' . esc_html__( 'Older Posts', 'bloggrid' ) . '</span>',
						) );

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>

				</main><!-- #main -->
			</div>

			<?php if ( get_theme_mod( 'bloggrid_archive_sidebar_position', 'hide' ) != 'hide' ) : ?>
				<div class="<?php echo esc_attr( $bloggrid_sidebar_col_class ); ?>">
					<?php get_sidebar(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
get_footer();
