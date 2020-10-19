<?php
/**
 * Blog related functions
 *
 * @package Elfie
 */

/**
 * Get the first category of the post
 */
function elfie_first_category() {
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
	    echo '<a class="first-cat post-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
	}
}

/**
 * Excerpt length
 */
function elfie_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'excerpt_length', '15' );

	return $length;
}
add_filter( 'excerpt_length', 'elfie_excerpt_length', 999 );

/**
 * Blog layout
 *
 */
function elfie_blog_layout() {

	if ( elfie_is_woocommerce_active() && is_woocommerce() ) {
		return;
	}

	$layout = get_theme_mod( 'blog_layout', 'layout-mixed' );

	if ( $layout == 'layout-mixed' || $layout == 'layout-classic' ) {
		$columns 	= 'col-md-12';
	} elseif ( $layout == 'layout-3cols' ) {
		$columns 	= 'col-md-4';
	} elseif ( $layout == 'layout-2cols-sb' ) {
		$columns 	= 'col-md-6';
	} 

	$layout = array(
		'layout' 	=> $layout,
		'columns'	=> $columns
	);

	return $layout;
}


/** 
 * Single post author bio template part
 */
function elfie_add_author_bio() {
	$enable_author_bio = get_theme_mod( 'enable_author_bio', 1 );

	if ( !$enable_author_bio ) {
		return;
	}

	get_template_part( 'template-parts/bio-author' );
}
add_action( 'elfie_after_single_content', 'elfie_add_author_bio', 12 );

/**
 * Single post navigation template part
 */
function elfie_add_post_navigation() {
	get_template_part( 'template-parts/post-navigation' );
}
add_action( 'elfie_after_single_content', 'elfie_add_post_navigation', 14 );