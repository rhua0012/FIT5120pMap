<?php
/**
 * Elfie Theme Customizer
 *
 * @package Elfie
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elfie_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor' ); 
    $wp_customize->get_section( 'colors' )->title = esc_attr__( 'General', 'elfie' );
    $wp_customize->get_section( 'colors' )->panel = 'elfie_panel_colors';
    $wp_customize->get_section( 'colors' )->priority = '10';
	$wp_customize->get_section( 'header_image' )->panel = 'elfie_panel_header';
	$wp_customize->get_section( 'title_tagline' )->panel = 'elfie_panel_menu_bar';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'elfie_customize_partial_blogname',
		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'elfie_customize_partial_blogdescription',
		) );

		$wp_customize->selective_refresh->add_partial( 'carousel_posts', array(
			'selector'        => '.hero-slider',
		) );
	}
}
add_action( 'customize_register', 'elfie_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function elfie_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function elfie_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function elfie_customize_preview_js() {
	wp_enqueue_script( 'elfie-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20181112', true );
}
add_action( 'customize_preview_init', 'elfie_customize_preview_js' );

/**
 * Kirki files
 */
require get_template_directory() . '/inc/customizer/kirki/include-kirki.php';
require get_template_directory() . '/inc/customizer/kirki/class-elfie-kirki.php';

/**
 * Config
 */
elfie_Kirki::add_config( 'elfie', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/**
 * Load customizer options files
 */
if ( class_exists( 'Kirki' ) ) {
	require get_template_directory() . '/inc/customizer/sections/options-header.php';
	require get_template_directory() . '/inc/customizer/sections/options-fonts.php';
	require get_template_directory() . '/inc/customizer/sections/options-blog.php';
	require get_template_directory() . '/inc/customizer/sections/options-colors.php';
	require get_template_directory() . '/inc/customizer/sections/options-footer.php';
	require get_template_directory() . '/inc/customizer/sections/options-shop.php';
}

/**
 * Disable Kirki telemetry
 */
add_filter( 'kirki_telemetry', '__return_false' );

/**
 * Customizer styling
 */
function elfie_customizer_styling() {
	?>
	<style>
		.customize-control:not(.customize-control-code_editor) {
			background: rgba(255,255,255,0.8);
			padding: 15px;
			box-sizing: border-box;
			margin-bottom: 18px;
			border: 1px solid #e4e4e4;
		}
		.customize-control-title {
			margin-bottom: 15px;
		}
		.customize-control-kirki-toggle .customize-control-title {
			margin: 0;
		}
		#input_shop_sidebar {
			overflow: hidden;
			margin: 0 -5px;
		}
		#input_shop_sidebar label {
			float: left;
			width: 33.3333%;
			padding: 0 5px;
			box-sizing: border-box;
		}

	</style>	
	<?php
}
add_action( 'customize_controls_print_styles', 'elfie_customizer_styling' );