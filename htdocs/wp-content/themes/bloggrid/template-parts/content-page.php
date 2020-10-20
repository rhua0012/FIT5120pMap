<?php
/**
 * Template part for displaying page content in page.php
 *
 * @package BlogGrid
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-card' ); ?>>

	<?php 
	if ( get_theme_mod( 'bloggrid_display_post_thumbnail_page', true ) ) {
		bloggrid_post_thumbnail(); 
	}
	?>

	<div class="card-body">
		<?php if ( get_theme_mod( 'bloggrid_display_page_title_page', true ) ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php endif; ?>

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bloggrid' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>
	
	
</article><!-- #post-<?php the_ID(); ?> -->
