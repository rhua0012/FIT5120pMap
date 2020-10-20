<?php
/**
 * Footer related functions
 *
 * @package Elfie
 */

/**
 * Footer widgets
 */
function elfie_footer_widgets() {
	if ( is_active_sidebar( 'footer-1' ) ) { ?>
		<div class="footer-widgets">
			<div class="container">
				<div class="row">
					<?php get_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	<?php }
}
add_action( 'elfie_footer', 'elfie_footer_widgets' );

/**
 * Footer widgets
 */
function elfie_footer_credits() {
	?>
	<div class="site-info">
		<div class="container">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'elfie' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'elfie' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'elfie' ), '<a rel="nofollow" href="https://elfwp.com/themes/elfie/">Elfie</a>', 'elfWP' );
				?>
		</div>
	</div><!-- .site-info -->
	<?php
}
add_action( 'elfie_footer', 'elfie_footer_credits' );

 /**
 * Instagram footer section
 */
function elfie_instagram_section() {

	$shortcode = get_theme_mod( 'instagram_shortcode' );

	if ( '' === $shortcode ) {
		return;
	}

	echo '<div class="instagram-section">';
	echo 	do_shortcode( wp_kses_post( $shortcode ) );
	echo '</div>';
}
add_action( 'elfie_footer_before', 'elfie_instagram_section', 19 );

/**
 * Back to top button
 */
function elfie_back_to_top() {
	?>
		<div class="back-to-top">
			<i class="icon-up-open"></i>
		</div>
	<?php
}
add_action( 'elfie_footer_after', 'elfie_back_to_top' );