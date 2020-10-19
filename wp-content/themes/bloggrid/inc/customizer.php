<?php
/**
 * BlogGrid Theme Customizer
 *
 * @package BlogGrid
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bloggrid_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'bloggrid_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'bloggrid_customize_partial_blogdescription',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'bloggrid_cover_title',
			array(
				'selector'        => '.cover-title',
				'render_callback' => 'bloggrid_customize_partial_cover_title',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'bloggrid_cover_subtitle',
			array(
				'selector'        => '.cover-description',
				'render_callback' => 'bloggrid_customize_partial_cover_subtitle',
			)
		);
	}

	include get_template_directory() . '/inc/customizer/theme-options.php';
}
add_action( 'customize_register', 'bloggrid_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bloggrid_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bloggrid_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function bloggrid_customize_partial_cover_title() {
	echo esc_html( get_theme_mod( 'bloggrid_cover_title' ) );
}
function bloggrid_customize_partial_cover_subtitle() {
	echo esc_html( get_theme_mod( 'bloggrid_cover_subtitle' ) );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bloggrid_customize_preview_js() {
	wp_enqueue_script( 'bloggrid-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), BLOGGRID_VERSION, true );
}
add_action( 'customize_preview_init', 'bloggrid_customize_preview_js' );

/**
 * Add Styles to the Customizer
 */
function bloggrid_customizer_css()
{
	wp_enqueue_style( 'bloggrid-customizer-css', get_template_directory_uri() . '/inc/customizer/customizer.css' );
}
add_action( 'customize_controls_print_styles', 'bloggrid_customizer_css' );


// Custom CSS output for theme options
function bloggrid_custom_css_output() { ?>
	<style type="text/css" id="custom-theme-css">
		.custom-logo { height: <?php echo esc_html( get_theme_mod( 'bloggrid_logo_height', '40' ) ); ?>px; width: auto; }
		body.custom-background .bg-similar-posts { background-color: #<?php echo esc_html( get_theme_mod( 'background_color', 'EDF2F7' ) ); ?> }
		<?php if ( get_theme_mod( 'bloggrid_font_family', 'default' ) === 'native' ) : ?>
			body, button, input, select, optgroup, textarea { font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"; }
			<?php if ( get_theme_mod( 'bloggrid_use_serif_title', true ) ) : ?>
				.entry-title,
				.navigation.post-navigation .nav-title { font-family: Iowan Old Style, Apple Garamond, Baskerville, Times New Roman, Droid Serif, Times, Source Serif Pro, serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol; font-weight: 700; }
			<?php else : ?>
				.entry-title,
				.navigation.post-navigation .nav-title { font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"; font-weight: 700; }
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'bloggrid_font_family', 'default' ) === 'roboto' ) : ?>
			body, button, input, select, optgroup, textarea { font-family: 'Roboto', sans-serif; }
			<?php if ( get_theme_mod( 'bloggrid_use_serif_title', true ) ) : ?>
				.entry-title,
				.navigation.post-navigation .nav-title { font-family: 'PT Serif', sans-serif; font-weight: 700; }
			<?php else : ?>
				.entry-title,
				.navigation.post-navigation .nav-title { font-family: 'Roboto', sans-serif; font-weight: 700; }
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'bloggrid_font_family', 'default' ) === 'open-sans' ) : ?>
			body, button, input, select, optgroup, textarea { font-family: 'Open Sans', sans-serif; }
			.cat-links a, .main-navigation a { font-weight: 600; }
			<?php if ( get_theme_mod( 'bloggrid_use_serif_title', true ) ) : ?>
				.entry-title,
				.navigation.post-navigation .nav-title { font-family: 'Noto Serif', sans-serif; font-weight: 700; }
			<?php else : ?>
				.entry-title,
				.navigation.post-navigation .nav-title { font-family: 'Open Sans', sans-serif; font-weight: 700; }
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( get_theme_mod( 'bloggrid_font_family', 'default' ) === 'default' ) : ?>
			<?php if ( ! get_theme_mod( 'bloggrid_use_serif_title', true ) ) : ?>
				.entry-title,
				.navigation.post-navigation .nav-title { font-family: 'Inter', sans-serif; font-weight: 700; }
			<?php endif; ?>
		<?php endif; ?>
	</style>
	<?php
}
add_action( 'wp_head', 'bloggrid_custom_css_output');