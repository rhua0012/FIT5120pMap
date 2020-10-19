<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package BlogGrid
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bloggrid_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	if ( is_singular() && get_theme_mod( 'bloggrid_single_sidebar_position', 'hide' ) === 'hide' ) {
		$classes[] = 'no-sidebar-single';
	}

	if ( get_theme_mod( 'bloggrid_enable_font_smoothing', false ) ) {
		$classes[] = 'antialiased';
	}

	return $classes;
}
add_filter( 'body_class', 'bloggrid_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function bloggrid_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'bloggrid_pingback_header' );



if ( ! function_exists( 'bloggrid_similar_posts' ) ) :
	function bloggrid_similar_posts() {

		global $post;

		$related_post_args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => 2,
		);
	
		$current_cats = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
		$related_post_args['category__in'] = $current_cats;
	
		$related_post_query = new WP_Query( $related_post_args );
	
		if ( $related_post_query->have_posts() ) :
			?>
			<div class="clearfix"></div>

			<div class="bg-similar-posts">
				<h4><?php esc_html_e( 'Similar Posts', 'bloggrid' ); ?></h4>

				<div class="row row-cols-1 row-cols-sm-2 bg-posts-row">
					<?php
					while ( $related_post_query->have_posts() ) :
						$related_post_query->the_post();
						?>
						<div class="col">
							<article class="archive-post-card">
								<?php 
								if ( get_theme_mod( 'bloggrid_display_post_thumbnail_archive', true ) && has_post_thumbnail() ) { ?>
									<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
										<?php
											the_post_thumbnail(
												'bloggrid-medium-image',
												array(
													'alt' => the_title_attribute(
														array(
															'echo' => false,
														)
													),
												)
											);
										?>
									</a>
								<?php } ?>

								<div class="card-body">
									<header class="entry-header">
										<?php
										the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
										?>
										<div class="entry-meta">
											<?php
											if ( get_theme_mod( 'bloggrid_display_post_date_archive', true ) ) {
												bloggrid_posted_on();
											}
											if ( get_theme_mod( 'bloggrid_display_post_author_archive', true ) ) {
												bloggrid_posted_by();
											}
											if ( get_theme_mod( 'bloggrid_display_post_tags_archive', false ) ) { ?>
												<span class="tag-links"><?php the_tags( '', '&nbsp;', '' ); ?></span>
											<?php }
											?>
										</div><!-- .entry-meta -->
									</header><!-- .entry-header -->
								</div>
							</article>
						</div>
						<?php
					endwhile;
					?>
				</div>
			</div>

		<?php
		endif;
		wp_reset_postdata();
	}
endif;
