<?php
/**
 * Template part for displaying posts
 *
 * @package BlogGrid
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-card' ); ?>>

	<?php 
	if ( get_theme_mod( 'bloggrid_display_post_thumbnail_single', true ) ) {
		bloggrid_post_thumbnail(); 
	}
	?>

	<div class="card-body">

		<?php if ( 'post' === get_post_type() && get_the_category() && get_theme_mod( 'bloggrid_display_post_cats_single', true ) ) : ?>
			<span class="cat-links"><?php the_category( '&nbsp;' ); ?></span>
		<?php endif; ?>

		<header class="entry-header">
			<?php
			the_title( '<h1 class="entry-title">', '</h1>' );

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					if ( get_theme_mod( 'bloggrid_display_post_date_single', true ) ) {
						bloggrid_posted_on();
					}
					if ( get_theme_mod( 'bloggrid_display_post_author_single', true ) ) {
						bloggrid_posted_by();
					}
					if ( get_theme_mod( 'bloggrid_display_post_tags_single', false ) ) { ?>
						<span class="tag-links"><?php the_tags( '', '&nbsp;', '' ); ?></span>
					<?php }
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bloggrid' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bloggrid' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

		<?php
		if ( get_theme_mod( 'bloggrid_display_similar_posts_single', true ) ) {
			bloggrid_similar_posts();
		}
		?>

		<div class="clearfix"></div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
