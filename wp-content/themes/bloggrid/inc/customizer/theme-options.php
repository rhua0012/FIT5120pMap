<?php
// Logo Height
$wp_customize->add_setting( 'bloggrid_logo_height', array(
	'default'           => 40,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bloggrid_logo_height', array(
	'label'    => __( 'Enter logo height (in px)', 'bloggrid' ),
	'type'     => 'number',
	'section'  => 'title_tagline',
	'setting'  => 'bloggrid_logo_height',
	'priority' => '9',
) );




// Section => General Theme Settings
$wp_customize->add_section( 'bloggrid_general_options_panel', array(
	'title'    => __( 'General Theme Options', 'bloggrid' ),
	'priority' => 50,
) );

$wp_customize->get_control( 'background_color' )->section = 'bloggrid_general_options_panel';
$wp_customize->get_control( 'background_color' )->priority = 99;

// Select Primary Color
$wp_customize->add_setting( 'bloggrid_primary_color', array(
	'default'           => 'default',
	'sanitize_callback' => 'bloggrid_sanitize_select',
) );
$wp_customize->add_control( 'bloggrid_primary_color', array(
	'label'   => __( 'Select Primary Color', 'bloggrid' ),
	'type'    => 'select',
	'section' => 'bloggrid_general_options_panel',
	'setting' => 'bloggrid_primary_color',
	'choices' => array(
		'default' => esc_html__('Default (Indigo)','bloggrid'),
		'green'   => esc_html__('Green','bloggrid'),
		'pink'    => esc_html__('Pink','bloggrid'),
		'teal'    => esc_html__('Teal','bloggrid'),
		'red'     => esc_html__('Red','bloggrid'),
	)
) );

// Select Font Family
$wp_customize->add_setting( 'bloggrid_font_family', array(
	'default'           => 'default',
	'sanitize_callback' => 'bloggrid_sanitize_select',
) );
$wp_customize->add_control( 'bloggrid_font_family', array(
	'label'   => __( 'Select Font Family', 'bloggrid' ),
	'type'    => 'select',
	'section' => 'bloggrid_general_options_panel',
	'setting' => 'bloggrid_font_family',
	'choices' => array(
		'default'   => esc_html__('Theme Default Font','bloggrid'),
		'roboto'    => esc_html__('Roboto','bloggrid'),
		'open-sans' => esc_html__('Open Sans','bloggrid'),
		'native'    => esc_html__('Native Font Stack (OS Defaults)','bloggrid'),
	)
) );

// Enable Font Smoothing
$wp_customize->add_setting( 'bloggrid_enable_font_smoothing', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_enable_font_smoothing', array(
	'label'           => __( 'Enable Font Smoothing', 'bloggrid' ),
	'type'            => 'checkbox',
	'section'         => 'bloggrid_general_options_panel',
	'setting'         => 'bloggrid_enable_font_smoothing',
	'description'     => esc_html__( 'Check this setting if you want to enable font smoothing using grayscale antialiasing on supported browsers.', 'bloggrid' ),
) );

// Use Serif font family for post title
$wp_customize->add_setting( 'bloggrid_use_serif_title', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_use_serif_title', array(
	'label'   => __( 'Use Serif Font for Post Title', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_general_options_panel',
	'setting' => 'bloggrid_use_serif_title',
) );

// Display Go to Top button
$wp_customize->add_setting( 'bloggrid_display_go_top', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_go_top', array(
	'label'       => __( 'Display \'Go to Top\' Button ', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_general_options_panel',
	'setting'     => 'bloggrid_display_go_top',
	'description' => esc_html__( 'Check this setting if you want to display a button at bottom right corner when user scrolls down.', 'bloggrid' ),
) );





// PANEL => Blog Home Page
$wp_customize->add_panel( 'bloggrid_blog_home_panel', array(
	'title'    => __( 'Blog Homepage Options', 'bloggrid' ),
	'priority' => 51,
) );


// SECTION => Cover Section
$wp_customize->add_section( 'bloggrid_cover_section', array(
	'title' => __( 'Cover Section', 'bloggrid' ),
	'panel' => 'bloggrid_blog_home_panel',
) );

// Display Cover Section
$wp_customize->add_setting( 'bloggrid_display_cover_section', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_cover_section', array(
	'label'       => __( 'Display Cover Section on Homepage', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_cover_section',
	'setting'     => 'bloggrid_display_cover_section',
	'description' => esc_html__( 'Uncheck this setting if you want to hide cover section shown on the blog homepage.', 'bloggrid' ),
) );

// Cover Image
$wp_customize->add_setting('bloggrid_cover_img', array(
    'default'           => get_template_directory_uri() . '/assets/images/cover-img.jpg',
	'sanitize_callback' => 'bloggrid_sanitize_image',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'bloggrid_cover_img', array(
    'label'           => __('Cover Section Image', 'bloggrid'),
    'section'         => 'bloggrid_cover_section',
    'setting'         => 'bloggrid_cover_img',
	'active_callback' => function() { return get_theme_mod( 'bloggrid_display_cover_section', true ); },
)));

// Cover Title
$wp_customize->add_setting( 'bloggrid_cover_title', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bloggrid_cover_title', array(
	'label'           => __( 'Title on Cover Section', 'bloggrid' ),
	'type'            => 'text',
	'section'         => 'bloggrid_cover_section',
	'setting'         => 'bloggrid_cover_title',
	'active_callback' => function() { return get_theme_mod( 'bloggrid_display_cover_section', true ); },
) );
$wp_customize->get_setting( 'bloggrid_cover_title' )->transport = 'postMessage';

// Cover Sub Title
$wp_customize->add_setting( 'bloggrid_cover_subtitle', array(
	'default'           => '',
	'sanitize_callback' => 'sanitize_textarea_field',
) );
$wp_customize->add_control( 'bloggrid_cover_subtitle', array(
	'label'           => __( 'Sub-title on Cover Section', 'bloggrid' ),
	'type'            => 'textarea',
	'section'         => 'bloggrid_cover_section',
	'setting'         => 'bloggrid_cover_subtitle',
	'active_callback' => function() { return get_theme_mod( 'bloggrid_display_cover_section', true ); },
) );
$wp_customize->get_setting( 'bloggrid_cover_subtitle' )->transport = 'postMessage';

// Remove Image Overlay
$wp_customize->add_setting( 'bloggrid_remove_img_overlay', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_remove_img_overlay', array(
	'label'           => __( 'Remove Image Overlay', 'bloggrid' ),
	'type'            => 'checkbox',
	'section'         => 'bloggrid_cover_section',
	'setting'         => 'bloggrid_remove_img_overlay',
	'active_callback' => function() { return get_theme_mod( 'bloggrid_display_cover_section', true ); },
	'description'     => esc_html__( 'Check this setting if you want to remove the overlay color from cover image.', 'bloggrid' ),
) );



// SECTION => Content Section
$wp_customize->add_section( 'bloggrid_home_content_section', array(
	'title' => __( 'Content Section', 'bloggrid' ),
	'panel' => 'bloggrid_blog_home_panel',
) );

// Select Sidebar Position on Blog Home Page
$wp_customize->add_setting( 'bloggrid_home_sidebar_position', array(
	'default'           => 'hide',
	'sanitize_callback' => 'bloggrid_sanitize_radio',
) );
$wp_customize->add_control( 'bloggrid_home_sidebar_position', array(
	'label'    => __( 'Sidebar Position on Blog Homepage', 'bloggrid' ),
	'type'     => 'radio',
	'section'  => 'bloggrid_home_content_section',
	'setting'  => 'bloggrid_home_sidebar_position',
	'choices'  => array(
		'hide' => esc_html__('Hide Sidebar','bloggrid'),
		'right'  => esc_html__('Right Sidebar','bloggrid'),
		'left'  => esc_html__('Left Sidebar','bloggrid'),
	)
) );

// Display post thumbnail on home
$wp_customize->add_setting( 'bloggrid_display_post_thumbnail_home', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_thumbnail_home', array(
	'label'       => __( 'Display Post Thumbnail', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_home_content_section',
	'setting'     => 'bloggrid_display_post_thumbnail_home',
) );

// Display post categories on home
$wp_customize->add_setting( 'bloggrid_display_post_cats_home', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_cats_home', array(
	'label'       => __( 'Display Post Categories', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_home_content_section',
	'setting'     => 'bloggrid_display_post_cats_home',
) );

// Display post excerpt on home
$wp_customize->add_setting( 'bloggrid_display_post_excerpt_home', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_excerpt_home', array(
	'label'       => __( 'Display Post Excerpt', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_home_content_section',
	'setting'     => 'bloggrid_display_post_excerpt_home',
) );

// Display post date on home
$wp_customize->add_setting( 'bloggrid_display_post_date_home', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_date_home', array(
	'label'   => __( 'Display Post Date', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_home_content_section',
	'setting' => 'bloggrid_display_post_date_home',
) );

// Display post author on home
$wp_customize->add_setting( 'bloggrid_display_post_author_home', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_author_home', array(
	'label'   => __( 'Display Post Author', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_home_content_section',
	'setting' => 'bloggrid_display_post_author_home',
) );

// Display post comments link on home
$wp_customize->add_setting( 'bloggrid_display_post_comment_home', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_comment_home', array(
	'label'   => __( 'Display Post Comments Link', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_home_content_section',
	'setting' => 'bloggrid_display_post_comment_home',
) );

// Display post tags on home
$wp_customize->add_setting( 'bloggrid_display_post_tags_home', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_tags_home', array(
	'label'   => __( 'Display Post Tags', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_home_content_section',
	'setting' => 'bloggrid_display_post_tags_home',
) );




// SECTION => Single Post Options
$wp_customize->add_section( 'bloggrid_single_content_section', array(
	'title' => __( 'Single Post Options', 'bloggrid' ),
	'priority' => 52,
) );

// Select Sidebar Position on Single Post
$wp_customize->add_setting( 'bloggrid_single_sidebar_position', array(
	'default'           => 'hide',
	'sanitize_callback' => 'bloggrid_sanitize_radio',
) );
$wp_customize->add_control( 'bloggrid_single_sidebar_position', array(
	'label'    => __( 'Sidebar Position on Single Post', 'bloggrid' ),
	'type'     => 'radio',
	'section'  => 'bloggrid_single_content_section',
	'setting'  => 'bloggrid_single_sidebar_position',
	'choices'  => array(
		'hide' => esc_html__('Hide Sidebar','bloggrid'),
		'right'  => esc_html__('Right Sidebar','bloggrid'),
		'left'  => esc_html__('Left Sidebar','bloggrid'),
	)
) );

// Display Featured Image on single
$wp_customize->add_setting( 'bloggrid_display_post_thumbnail_single', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_thumbnail_single', array(
	'label'       => __( 'Display Featured Image', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_single_content_section',
	'setting'     => 'bloggrid_display_post_thumbnail_single',
) );

// Display post categories on single
$wp_customize->add_setting( 'bloggrid_display_post_cats_single', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_cats_single', array(
	'label'       => __( 'Display Post Categories', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_single_content_section',
	'setting'     => 'bloggrid_display_post_cats_single',
) );

// Display post date on single
$wp_customize->add_setting( 'bloggrid_display_post_date_single', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_date_single', array(
	'label'   => __( 'Display Post Date', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_single_content_section',
	'setting' => 'bloggrid_display_post_date_single',
) );

// Display post author on single
$wp_customize->add_setting( 'bloggrid_display_post_author_single', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_author_single', array(
	'label'   => __( 'Display Post Author', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_single_content_section',
	'setting' => 'bloggrid_display_post_author_single',
) );

// Display post tags on single
$wp_customize->add_setting( 'bloggrid_display_post_tags_single', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_tags_single', array(
	'label'   => __( 'Display Post Tags', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_single_content_section',
	'setting' => 'bloggrid_display_post_tags_single',
) );

// Display similar posts on single
$wp_customize->add_setting( 'bloggrid_display_similar_posts_single', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_similar_posts_single', array(
	'label'   => __( 'Display Similar Posts', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_single_content_section',
	'setting' => 'bloggrid_display_similar_posts_single',
) );

// Display post navigation
$wp_customize->add_setting( 'bloggrid_display_post_nav_single', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_nav_single', array(
	'label'   => __( 'Display Post Navigation', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_single_content_section',
	'setting' => 'bloggrid_display_post_nav_single',
) );





// SECTION => Page Options
$wp_customize->add_section( 'bloggrid_page_content_section', array(
	'title' => __( 'Page Options', 'bloggrid' ),
	'priority' => 53,
) );

// Select Sidebar Position on Page
$wp_customize->add_setting( 'bloggrid_page_sidebar_position', array(
	'default'           => 'hide',
	'sanitize_callback' => 'bloggrid_sanitize_radio',
) );
$wp_customize->add_control( 'bloggrid_page_sidebar_position', array(
	'label'    => __( 'Page Sidebar', 'bloggrid' ),
	'type'     => 'radio',
	'section'  => 'bloggrid_page_content_section',
	'setting'  => 'bloggrid_page_sidebar_position',
	'choices'  => array(
		'hide' => esc_html__('Hide Sidebar','bloggrid'),
		'right'  => esc_html__('Right Sidebar','bloggrid'),
		'left'  => esc_html__('Left Sidebar','bloggrid'),
	)
) );

// Display Featured Image on Page
$wp_customize->add_setting( 'bloggrid_display_post_thumbnail_page', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_thumbnail_page', array(
	'label'       => __( 'Display Featured Image', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_page_content_section',
	'setting'     => 'bloggrid_display_post_thumbnail_page',
) );

// Display Page Title on Page
$wp_customize->add_setting( 'bloggrid_display_page_title_page', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_page_title_page', array(
	'label'   => __( 'Display Page Title', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_page_content_section',
	'setting' => 'bloggrid_display_page_title_page',
) );

// Use a Separate Sidebar on Page
$wp_customize->add_setting( 'bloggrid_use_separate_sidebar_page', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_use_separate_sidebar_page', array(
	'label'           => __( 'Use a Different Sidebar on Pages', 'bloggrid' ),
	'type'            => 'checkbox',
	'section'         => 'bloggrid_page_content_section',
	'setting'         => 'bloggrid_use_separate_sidebar_page',
	'description'     => esc_html__( 'Check this setting if you don\'t want to use default sidebar on pages.', 'bloggrid' ),
	'active_callback' => function() { if ( get_theme_mod( 'bloggrid_page_sidebar_position', 'hide' ) != 'hide' ) return true; return false; },
) );





// SECTION => Archives Options
$wp_customize->add_section( 'bloggrid_archive_content_section', array(
	'title' => __( 'Archives Options', 'bloggrid' ),
	'priority' => 54,
) );

// Select Sidebar Position on Archives
$wp_customize->add_setting( 'bloggrid_archive_sidebar_position', array(
	'default'           => 'hide',
	'sanitize_callback' => 'bloggrid_sanitize_radio',
) );
$wp_customize->add_control( 'bloggrid_archive_sidebar_position', array(
	'label'    => __( 'Sidebar Position on Single Post', 'bloggrid' ),
	'type'     => 'radio',
	'section'  => 'bloggrid_archive_content_section',
	'setting'  => 'bloggrid_archive_sidebar_position',
	'choices'  => array(
		'hide'  => esc_html__('Hide Sidebar','bloggrid'),
		'right' => esc_html__('Right Sidebar','bloggrid'),
		'left'  => esc_html__('Left Sidebar','bloggrid'),
	)
) );

// Display Featured Image on Archives
$wp_customize->add_setting( 'bloggrid_display_post_thumbnail_archive', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_thumbnail_archive', array(
	'label'       => __( 'Display Featured Image', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_archive_content_section',
	'setting'     => 'bloggrid_display_post_thumbnail_archive',
) );

// Display post categories on Archives
$wp_customize->add_setting( 'bloggrid_display_post_cats_archive', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_cats_archive', array(
	'label'       => __( 'Display Post Categories', 'bloggrid' ),
	'type'        => 'checkbox',
	'section'     => 'bloggrid_archive_content_section',
	'setting'     => 'bloggrid_display_post_cats_archive',
) );

// Display post date on Archives
$wp_customize->add_setting( 'bloggrid_display_post_date_archive', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_date_archive', array(
	'label'   => __( 'Display Post Date', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_archive_content_section',
	'setting' => 'bloggrid_display_post_date_archive',
) );

// Display post author on Archives
$wp_customize->add_setting( 'bloggrid_display_post_author_archive', array(
	'default'           => true,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_author_archive', array(
	'label'   => __( 'Display Post Author', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_archive_content_section',
	'setting' => 'bloggrid_display_post_author_archive',
) );

// Display post comments link on Archive
$wp_customize->add_setting( 'bloggrid_display_post_comment_archive', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_comment_archive', array(
	'label'   => __( 'Display Post Comments Link', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_archive_content_section',
	'setting' => 'bloggrid_display_post_comment_archive',
) );

// Display post tags on Archive
$wp_customize->add_setting( 'bloggrid_display_post_tags_archive', array(
	'default'           => false,
	'sanitize_callback' => 'bloggrid_sanitize_checkbox',
) );
$wp_customize->add_control( 'bloggrid_display_post_tags_archive', array(
	'label'   => __( 'Display Post Tags', 'bloggrid' ),
	'type'    => 'checkbox',
	'section' => 'bloggrid_archive_content_section',
	'setting' => 'bloggrid_display_post_tags_archive',
) );





/**
 * SANITIZATION FUNCTIONS
 */

 // Sanitize Image
function bloggrid_sanitize_image( $image, $setting ) {
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

// Sanitize select
function bloggrid_sanitize_select( $input, $setting ){

	//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key($input);

	//get the list of possible select options
	$choices = $setting->manager->get_control( $setting->id )->choices;

	//return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

// Sanitize checkbox
function bloggrid_sanitize_checkbox( $checked ){

	//returns true if checkbox is checked
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

// Sanitize radio
function bloggrid_sanitize_radio( $input, $setting ){

	// input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key($input);

	// get the list of possible radio box options
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}