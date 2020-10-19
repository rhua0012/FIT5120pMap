<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elfie
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		do_action( 'elfie_post_item_before' );

		do_action( 'elfie_post_item_content', $layout_type = 'is-large' );
		
		do_action( 'elfie_post_item_after' );
	?>

</article><!-- #post-<?php the_ID(); ?> -->
