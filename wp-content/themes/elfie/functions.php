<?php
/**
 * Elfie functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elfie
 */

if ( ! function_exists( 'elfie_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function elfie_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Elfie, use a find and replace
		 * to change 'elfie' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'elfie', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'elfie-900x9999', 900, 9999 );
		add_image_size( 'elfie-400x9999', 400, 9999 );
		add_image_size( 'elfie-400x400', 400, 400, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'elfie' ),
			'top' 		=> esc_html__( 'Top bar menu (hidden on mobiles)', 'elfie' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'elfie_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Gutenberg support
		 */

		//add_theme_support( 'editor-styles' );

		//Wide and full alignments
		add_theme_support( 'align-wide' );

		//Responsive embeds	
		add_theme_support( 'responsive-embeds' );

		/*
		* Adds `async` and `defer` support for scripts registered or enqueued
		* by the theme.
		*/		
		$loader = new Elfie_Script_Loader();
		add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );
	}
endif;
add_action( 'after_setup_theme', 'elfie_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elfie_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'elfie_content_width', 825 );
}
add_action( 'after_setup_theme', 'elfie_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elfie_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'elfie' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'elfie' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/* Footer widget areas */
	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'elfie' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}	

	register_widget( 'Elfie_Recent_Posts' );
	register_widget( 'Elfie_Author' );
}
add_action( 'widgets_init', 'elfie_widgets_init' );

/**
 * Widgets
 */
require get_template_directory() . '/widgets/class-elfie-recent-posts.php';
require get_template_directory() . '/widgets/class-elfie-author.php';

/**
 * Enqueue scripts and styles.
 */
function elfie_scripts() {
	wp_enqueue_style( 'elfie-style', get_stylesheet_uri() );

	if ( !class_exists( 'Kirki_Fonts' ) ) {
		wp_enqueue_style( 'elfie-fonts', '//fonts.googleapis.com/css?family=Karla:400,400i,700,700i|Playfair+Display:400,400i,700,700i&display=swap', array(), null );
	}	

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), '20191222', true );

	wp_enqueue_script( 'elfie-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery', 'slick' ), '20200815', true );
	wp_script_add_data( 'elfie-custom', 'async', true );

	wp_enqueue_script( 'elfie-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elfie_scripts' );

/**
 * Gutenberg assets
 */
function elfie_block_editor_styles() {
	// Enqueue the editor styles.
	wp_enqueue_style( 'elfie-block-editor-styles', get_template_directory_uri() . '/assets/css/editor-styles.css', '', '20200120', '' );

	if ( !class_exists( 'Kirki_Fonts' ) ) {
		wp_enqueue_style( 'elfie-fonts', '//fonts.googleapis.com/css?family=Karla:400,400i,700,700i|Playfair+Display:400,400i,700,700i&display=swap', array(), null );
	}	

}
add_action( 'enqueue_block_editor_assets', 'elfie_block_editor_styles' );

 /**
 * Enqueue Bootstrap
 */
function elfie_enqueue_bootstrap() {
	wp_enqueue_style( 'elfie-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'elfie_enqueue_bootstrap', 9 );

/**
 * Disable Elementor global color schemes and typography
 */
function elfie_disable_elementor_globals () {
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
}
add_action( 'after_switch_theme', 'elfie_disable_elementor_globals' );

/**
 * Check if WooCommerce is activated
 */
function elfie_is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) {
		 return true; 
	} else {
		 return false;
	}
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions to handle various aspects of the theme
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/functions/header.php';
require get_template_directory() . '/inc/functions/blog.php';
require get_template_directory() . '/inc/functions/footer.php';
require get_template_directory() . '/inc/slider.php';
require get_template_directory() . '/inc/featured-boxes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( elfie_is_woocommerce_active() ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Classes
 */
require get_template_directory() . '/inc/class_elfie_loop_post.php';
require get_template_directory() . '/inc/class_elfie_script_loader.php';
require get_template_directory() . '/inc/class_elfie_post_metabox.php';

/**
 * TGMPA
 */
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

function elfie_register_required_plugins() {

	$plugins = array(
		array(
			'name'      => __( 'Theme options', 'elfie' ),
			'slug'      => 'kirki',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'elfie',
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => false,
		'is_automatic' => true,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'elfie_register_required_plugins' );