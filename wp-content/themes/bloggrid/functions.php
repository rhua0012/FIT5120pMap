<?php
/**
 * BlogGrid functions and definitions
 *
 * @package BlogGrid
 */

if ( ! defined( 'BLOGGRID_VERSION' ) ) {
	$bloggrid_theme = wp_get_theme();
	define( 'BLOGGRID_VERSION', $bloggrid_theme->get( 'Version' ) );
}

if ( ! function_exists( 'bloggrid_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function bloggrid_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'bloggrid', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		// Add thumbnail sizes for optimized images
		add_image_size( 'bloggrid-medium-image', 400, 260, true );
		add_image_size( 'bloggrid-small-image', 180, 120, true );
		add_image_size( 'bloggrid-regular-image', 1500, 800, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'bloggrid' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'bloggrid_custom_background_args',
				array(
					'default-color' => 'EDF2F7',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		/**
		 * Add support for core custom logo.
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'bloggrid_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function bloggrid_content_width() {
	// This variable is intended to be overruled from themes.
	$GLOBALS['content_width'] = apply_filters( 'bloggrid_content_width', 640 );
}
add_action( 'after_setup_theme', 'bloggrid_content_width', 0 );



/**
 * Register widget area.
 */
function bloggrid_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bloggrid' ),
			'id'            => 'bloggrid-sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bloggrid' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'bloggrid' ),
			'id'            => 'bloggrid-footer-1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'bloggrid' ),
			'id'            => 'bloggrid-footer-2',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'bloggrid' ),
			'id'            => 'bloggrid-footer-3',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	if ( get_theme_mod( 'bloggrid_use_separate_sidebar_page', false ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Page Sidebar', 'bloggrid' ),
				'id'            => 'bloggrid-page-sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'bloggrid' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}
}
add_action( 'widgets_init', 'bloggrid_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function bloggrid_scripts() {
	wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array(), 'v4.5.0', 'all' );
	wp_enqueue_style( 'bloggrid-font-inter', '//fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap', array(), BLOGGRID_VERSION );
	wp_enqueue_style( 'bloggrid-font-dm-serif', '//fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap', array(), BLOGGRID_VERSION );
	if ( get_theme_mod( 'bloggrid_font_family', 'default' ) === 'roboto' ) {
		wp_dequeue_style( 'bloggrid-font-inter' );
		wp_dequeue_style( 'bloggrid-font-dm-serif' );
		wp_enqueue_style( 'bloggrid-font-roboto', '//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap' );
		wp_enqueue_style( 'bloggrid-font-pt-serif', '//fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap', array(), BLOGGRID_VERSION );
	}
	if ( get_theme_mod( 'bloggrid_font_family', 'default' ) === 'open-sans' ) {
		wp_dequeue_style( 'bloggrid-font-inter' );
		wp_dequeue_style( 'bloggrid-font-dm-serif' );
		wp_enqueue_style( 'bloggrid-font-roboto', '//fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap' );
		wp_enqueue_style( 'bloggrid-font-noto-serif', '//fonts.googleapis.com/css2?family=Noto+Serif:wght@700&display=swap', array(), BLOGGRID_VERSION );
	}
	if ( get_theme_mod( 'bloggrid_font_family', 'default' ) === 'native' ) {
		wp_dequeue_style( 'bloggrid-font-inter' );
		wp_dequeue_style( 'bloggrid-font-dm-serif' );
	}
	wp_enqueue_style( 'bloggrid-style', get_stylesheet_uri(), array(), BLOGGRID_VERSION );
	wp_style_add_data( 'bloggrid-style', 'rtl', 'replace' );

	if ( get_theme_mod( 'bloggrid_primary_color', 'default' ) === 'green' ) {
		wp_enqueue_style( 'bloggrid-color-theme', get_template_directory_uri()  . '/assets/css/green-theme.css', array(), BLOGGRID_VERSION );
	}
	if ( get_theme_mod( 'bloggrid_primary_color', 'default' ) === 'teal' ) {
		wp_enqueue_style( 'bloggrid-color-theme', get_template_directory_uri()  . '/assets/css/teal-theme.css', array(), BLOGGRID_VERSION );
	}
	if ( get_theme_mod( 'bloggrid_primary_color', 'default' ) === 'pink' ) {
		wp_enqueue_style( 'bloggrid-color-theme', get_template_directory_uri()  . '/assets/css/pink-theme.css', array(), BLOGGRID_VERSION );
	}
	if ( get_theme_mod( 'bloggrid_primary_color', 'default' ) === 'red' ) {
		wp_enqueue_style( 'bloggrid-color-theme', get_template_directory_uri()  . '/assets/css/red-theme.css', array(), BLOGGRID_VERSION );
	}

	wp_enqueue_script( 'bloggrid-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), BLOGGRID_VERSION, true );
	wp_enqueue_script( 'bloggrid-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), BLOGGRID_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bloggrid_scripts' );




/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

