<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Elfie
 */

if ( ! function_exists( 'elfie_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function elfie_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'elfie_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function elfie_posted_by() {
		global $post;
		$author_id = $post->post_author;

		$byline = '<span class="author vcard">' . get_avatar( get_the_author_meta( 'email', $author_id ) , 24 ) . '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>';
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'elfie_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function elfie_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				echo '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'elfie' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'elfie' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'elfie_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function elfie_post_thumbnail( $size ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( $size, array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'elfie_post_cats' ) ) :
	/**
	 * Prints HTML with meta information for the categories
	 */
	function elfie_post_cats() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'elfie' ) );
			if ( $categories_list ) {
				echo '<span class="cat-links">' . $categories_list . '</span>';
			}
		}
	}
endif;

if ( ! function_exists( 'has_blocks' ) ) :
	/**
	 * Backwards compatibility for the has_blocks() function. Will be removed in the future
	 */
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
	function has_blocks( $post = null ) {
		if ( ! is_string( $post ) ) {
			$wp_post = get_post( $post );
			if ( $wp_post instanceof WP_Post ) {
				$post = $wp_post->post_content;
			}
		}
	
		return false !== strpos( (string) $post, '<!-- wp:' );
	}

endif;

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for wp_body_open() function
	 */
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
	function wp_body_open() {
		// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		do_action( 'wp_body_open' );
	}
}