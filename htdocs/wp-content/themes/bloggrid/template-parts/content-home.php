<?php
/**
 * Template part for displaying posts on blog home page
 *
 * @package BlogGrid
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post-card' ); ?>>

	<?php 
	if ( get_theme_mod( 'bloggrid_display_post_thumbnail_home', true ) ) {
		bloggrid_post_thumbnail( 'medium' ); 
	}
	?>

	<div class="card-body">

		<?php if ( 'post' === get_post_type() && get_the_category() && get_theme_mod( 'bloggrid_display_post_cats_home', true ) ) : ?>
			<span class="cat-links"><?php the_category( '&nbsp;' ); ?></span>
		<?php endif; ?>

		<header class="entry-header">
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header><!-- .entry-header -->

		<?php if ( get_theme_mod( 'bloggrid_display_post_excerpt_home', true ) ) : ?>
		<div class="entry-summary">
			<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
		</div><!-- .entry-summary -->
		<?php endif; ?>

		<?php if ( get_theme_mod( 'bloggrid_display_post_tags_home', false ) ) { ?>
			<span class="tag-links"><?php the_tags( '', '&nbsp;', '' ); ?></span>
		<?php } ?>

		<?php if ( get_theme_mod( 'bloggrid_display_post_comment_home', false ) ) { ?>
			<span class="entry-meta">
				<?php bloggrid_comments_link(); ?>
			</span>
		<?php } ?>
	</div>

	<footer class="entry-footer mt-auto">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta d-flex justify-content-between">
				<?php 
				if ( get_theme_mod( 'bloggrid_display_post_date_home', true ) ) {
					bloggrid_posted_on();
				}
				if ( get_theme_mod( 'bloggrid_display_post_author_home', true ) ) {
					bloggrid_posted_by();
				}
				?>
			</div>
		<?php endif; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
