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

	<?php do_action( 'elfie_post_item_before' ); ?>

	<div class="row v-align">
		<div class="col-md-4 col-sm-4 col-12">
			<?php elfie_post_thumbnail( 'elfie-400x400' ); ?>
		</div>	
		<div class="col-md-8 col-sm-8 col-12">
			<div class="content-list">
				<?php do_action( 'elfie_post_item_content', $layout_type = 'is-list' ); ?>
			</div>
		</div>
	</div>

	<?php do_action( 'elfie_post_item_after' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->