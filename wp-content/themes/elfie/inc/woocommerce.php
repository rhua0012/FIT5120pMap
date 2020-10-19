<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Elfie
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function elfie_woocommerce_setup() {

	$args = array(
			'thumbnail_image_width' => 360,
			'gallery_thumbnail_image_width' => 150
	);

	add_theme_support( 'woocommerce', $args );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'elfie_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function elfie_woocommerce_scripts() {
	wp_enqueue_style( 'elfie-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = esc_url( WC()->plugin_url() ) . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'elfie-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'elfie_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function elfie_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'elfie_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function elfie_woocommerce_products_per_page() {

	$products = get_theme_mod( 'products_number', 12 );

	return absint( $products );
}
add_filter( 'loop_shop_per_page', 'elfie_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function elfie_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'elfie_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function elfie_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'elfie_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function elfie_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'elfie_woocommerce_related_products_args' );

if ( ! function_exists( 'elfie_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function elfie_woocommerce_product_columns_wrapper() {
		$columns = elfie_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'elfie_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'elfie_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function elfie_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'elfie_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'elfie_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function elfie_woocommerce_wrapper_before() {

		$sidebar_type = get_theme_mod( 'shop_sidebar', 'no-sidebar' );

		//Set main content area width on shop archives to consider sidebar, if there is one
		if ( !is_singular( 'product' ) && 'no-sidebar' !== $sidebar_type ) {
			$cols = 'col-md-9 ' . esc_attr( $sidebar_type );
		} else {
			$cols = 'col-md-12';
		}

		?>
		<div id="primary" class="content-area <?php echo $cols; ?>">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'elfie_woocommerce_wrapper_before' );

if ( ! function_exists( 'elfie_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function elfie_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'elfie_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'elfie_woocommerce_header_cart' ) ) {
			elfie_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'elfie_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function elfie_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		elfie_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'elfie_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'elfie_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function elfie_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'elfie' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'elfie' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'elfie_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function elfie_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php elfie_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/**
 * Remove archive titles from Woocommerce pages
 */
function elfie_remove_woocommerce_archive_titles() {
	if ( is_woocommerce() ) {
		remove_action( 'elfie_header_after', 'elfie_archive_titles' );
	}

	$sidebar_type = get_theme_mod( 'shop_sidebar', 'no-sidebar' );

	if ( is_singular( 'product' ) ) {
		//Remove sidebar from single products
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
	if ( 'no-sidebar' == $sidebar_type ) {
		//Remove sidebar from archives
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'wp', 'elfie_remove_woocommerce_archive_titles' );

/**
 * Add Bootstrap classes to product loops
 */
function elfie_product_loop_classes( $classes ) {

	$classes[] = '';

	if ( !is_singular( 'product' ) ) {
		$classes[] 	= 'col-sm-6 col-md-4 col-lg-4';
		$classes 	= array_diff( $classes, array( 'col-md-6' ) );
	}

	return $classes;
}
add_filter( 'woocommerce_post_class', 'elfie_product_loop_classes' );

/**
 * Wrap shop result count and ordering
 */
function elfie_wrap_shop_count_order_before() {
	?>
		<div class="results-order clear">
	<?php
}
add_action( 'woocommerce_before_shop_loop', 'elfie_wrap_shop_count_order_before', 19 );
function elfie_wrap_shop_count_order_after() {
	?>
		</div>
	<?php
}
add_action( 'woocommerce_before_shop_loop', 'elfie_wrap_shop_count_order_after', 31 );


/**
 * Wrap single product elements
 */

function elfie_single_product_wrap_gallery_before() {
	?>

	<div class="row">
		<div class="col-md-6">

	<?php
}
add_action( 'woocommerce_before_single_product_summary', 'elfie_single_product_wrap_gallery_before', 1 );

function elfie_single_product_wrap_gallery_after() {
	?>

		</div>
		<div class="col-md-6">
		
	<?php
}
add_action( 'woocommerce_before_single_product_summary', 'elfie_single_product_wrap_gallery_after', 31 );

function elfie_single_product_wrap_summary_after() {
	?>

		</div>
	</div>
		
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'elfie_single_product_wrap_summary_after', 1 );

/**
 * Don't print sidebar on checkout and cart pages
 */
function elfie_disable_cart_checkout_sidebar() {

	if ( is_checkout() || is_cart() ) {
		return true;
	}
	
}
add_filter( 'elfie_disable_sidebar', 'elfie_disable_cart_checkout_sidebar' );