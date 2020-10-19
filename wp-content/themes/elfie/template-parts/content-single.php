<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elfie
 */


//Get the layout for single posts
$customizer_layout 	 = get_theme_mod( 'post_layout', 'layout-default' ); //Set from the Customizer
$post_layout 		 = get_post_meta( $post->ID, '_elfie_post_layout', true ); //Set from post metabox

if ( $post_layout !== '' && $post_layout !== 'customizer' ) { //Metabox layout takes priority
	$layout = $post_layout; 
} else {
	$layout = $customizer_layout;
}

//Options
$hide_post_cats = get_theme_mod( 'hide_post_cats' );
$hide_post_date = get_theme_mod( 'hide_post_date' );
$hide_post_author = get_theme_mod( 'hide_post_author' );
$hide_post_tags = get_theme_mod( 'hide_post_tags' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( $layout !== 'layout-featuredbanner2' ) : ?>
	<header class="entry-header post-header">
		
		<?php if ( !$hide_post_cats ) : ?>
		<div class="post-cats"><?php elfie_post_cats(); ?></div>
		<?php endif; ?>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				if ( !$hide_post_author ) {
					elfie_posted_by();
				}
				if ( !$hide_post_date ) {
					elfie_posted_on();
				}
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<?php endif; ?>


	<?php if ( $layout == 'layout-default' && has_post_thumbnail() ) : ?>
		<div class="post-thumbnail single-thumbnail">
			<?php the_post_thumbnail( 'elfie-900x9999', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) ); ?>
		</div>
	<?php endif; ?>


	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'elfie' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'elfie' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( $hide_post_tags ) : ?>
	<footer class="entry-footer">
		<?php elfie_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
