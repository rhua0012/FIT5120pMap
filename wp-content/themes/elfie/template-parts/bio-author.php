<?php
/**
 * The template for displaying the author bio
 *
 * @package Elfie
 */
?>

<div class="author-bio clear">
	<div class="author-avatar vcard">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>
	</div>

	<div class="author-description">
		<h2 class="author-name">
			<?php
				printf(
					/* translators: %s: Author name */
					__( 'By %s', 'elfie' ),
					esc_html( get_the_author() )
				);
			?>
		</h2>		
		<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php
				printf(
					/* translators: %s: Author name */
					__( 'See all posts by %s <span aria-hidden="true">&rarr;</span>', 'elfie' ),
					esc_html( get_the_author() )
				);
			?>
		</a>
	</div><!-- .author-description -->
</div><!-- .author-bio -->