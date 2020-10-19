<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Elfie
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function elfie_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	//Blog layout
	$blog_layout 	= elfie_blog_layout();
	if ( is_home() || is_archive() ) {
		$classes[] 	= esc_attr( $blog_layout['layout'] );
	}

	//Single post layout
	global $post;
	$customizer_layout 	 = get_theme_mod( 'post_layout', 'layout-default' ); //Set from the Customizer

	if ( is_404() ) {
		$post_layout = 'layout-default';
	} else {
		$post_layout 	= get_post_meta( $post->ID, '_elfie_post_layout', true ); //Set from post metabox
	}
	
	if ( $post_layout !== '' && $post_layout !== 'customizer' ) { //Metabox layout takes priority
		$layout = $post_layout; 
	} else {
		$layout = $customizer_layout;
	}
	if ( is_single() ) {
		$classes[] 	= esc_attr( $layout );
	}	

	return $classes;
}
add_filter( 'body_class', 'elfie_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function elfie_post_classes( $classes ) {

	if ( is_home() || is_archive() ) {
		$blog_layout = elfie_blog_layout();
		$classes[] = esc_attr( $blog_layout['columns'] );
	}

	return $classes;
}
add_filter( 'post_class', 'elfie_post_classes' );



/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function elfie_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'elfie_pingback_header' );

/**
 * Same size tag cloud elements
 */
function elfie_tag_cloud_font_size( $args ) {
    $args['smallest'] 	= '13';
	$args['largest'] 	= '13';
	$args['unit']		= 'px';

    return $args;
}
add_filter('widget_tag_cloud_args', 'elfie_tag_cloud_font_size');

/**
 * Default theme colors
 */
if ( !function_exists( 'elfie_default_colors' ) ) :
	function elfie_default_colors() {

		$colors = array(
			'site_title_color' 					=> '#000',
			'site_description_color' 			=> '#404040',
			'menu_items_color'					=> '#333',
			'menu_items_color_hover'			=> '#fe7b7b',
			'submenu_background_color'			=> '#fff',
			'menu_bar_color'					=> '#fff',
			'accent_color'						=> '#fe7b7b',
			'body_text_color'					=> '#404040',
			'menu_bar_top_color'				=> '#fff',
			'menu_bar_bottom_color'				=> '#fff',
			'footer_background_color'			=> '#000',
			'footer_color'						=> '#fff',
			'footer_links_color'				=> '#fff',
			'footer_widgets_title_color'		=> '#fff',
			'top_bar_color'						=> '#fff',
			'top_menu_items_color'				=> '#000',
			'top_menu_items_color_hover'		=> '#fe7b7b',
			'submenu_items_color'				=> '#000',
			'subscribe_background_color'		=> '#f3f7ef',
			'subscribe_color'					=> '#000',			
		);

		return $colors;

	}
endif;

/**
 * Function to sanitize selects
 */
function elfie_sanitize_selects( $input, $choices ) {

	$input = sanitize_key( $input );

	return ( in_array( $input, $choices ) ? $input : '' );
}