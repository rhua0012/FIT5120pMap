<?php
/**
 * Template part for displaying results in search pages
 *
 * @package BlogGrid
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post-card' ); ?>>

	<div class="card-body">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>

	<?php if ( 'post' === get_post_type() ) : ?>
		<footer class="entry-footer mt-auto">
			<div class="entry-meta d-flex justify-content-between">
				<?php 
				bloggrid_posted_on(); 
				bloggrid_posted_by();
				?>
			</div>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
