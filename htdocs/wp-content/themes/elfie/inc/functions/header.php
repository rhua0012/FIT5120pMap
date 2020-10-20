<?php
/**
 * Header related functions
 *
 * @package Elfie
 */

/**
 * Main container
 */
function elfie_main_container_start() {
	if ( !is_page_template( 'page-templates/template_builder.php') ) {
		echo '<div class="container">';
		echo 	'<div class="row">';
	}
}
add_action( 'elfie_main_container_start', 'elfie_main_container_start', 1 );

function elfie_main_container_end() {

	if ( !is_page_template( 'page-templates/template_builder.php') ) {
		echo 	'</div>';
		echo '</div>';
	}
}
add_action( 'elfie_main_container_end', 'elfie_main_container_end', 99 );

 /**
  * Main navigation file
  */
function elfie_site_navigation() {

	$layout = get_theme_mod( 'menu_layout', 'default' );
	?>

	<header id="masthead" class="site-header menu-<?php echo esc_attr( $layout ); ?>">
		<?php get_template_part( 'template-parts/header/menu-bar', $layout ); ?>
	</header>

	<?php
}
add_action( 'elfie_header', 'elfie_site_navigation', 10 );

/**
 * Header image
 */
function elfie_header_image() {
	
	$container = get_theme_mod( 'header_image_container', 'fullwidth' );
	
	?>
	<div class="header-image">
		<div class="<?php echo esc_attr( $container ); ?>">
			<?php the_header_image_tag(); ?>
		</div>
	</div>
	<?php
}

/**
 * Position for the header image
 */
function elfie_header_image_position() {

	$position 	= get_theme_mod( 'header_image_position', 'before_menu' );
	$display	= get_theme_mod( 'header_image_display', 1 );

	if ( $display && !is_home() ) {
		return;
	}

	if ( $position == 'before_menu' ) {
		add_action( 'elfie_header', 'elfie_header_image', 9 );
	} else {
		add_action( 'elfie_header', 'elfie_header_image', 11 );
	}
}
add_action( 'wp', 'elfie_header_image_position' );

/**
 * Header social
 */
function elfie_header_social() {
	$socials = get_theme_mod( 'header_social' );

	if ( !$socials ) {
		return;
	}

	foreach( $socials as $social ) {
		echo '<div class="social-item"><a target="_blank" href="' . esc_url( $social['link_url'] ) . '"><i class="' . esc_attr( $social['icon'] ) . '"></i></a></div>';
	}
}

/**
 * Subscribe header section
 */
if ( !function_exists( 'elfie_subscribe_section' ) ) {
	function elfie_subscribe_section() {

		$shortcode 	= get_theme_mod( 'subscribe_shortcode' );
		$text		= get_theme_mod( 'subscribe_text', sprintf( '<h3>%1s</h3><p>%2s</p>', esc_html__( 'Subscribe to my newsletter', 'elfie' ), esc_html__( 'Get the news in your inbox.', 'elfie' ) ) );
		$container	= get_theme_mod( 'subscribe_container', 'container' );

		if ( '' == $shortcode ) {
			return;
		}
		?>
		
		<div class="subscribe-section">
			<div class="<?php echo esc_attr( $container ); ?>">
				<div class="inner-subscribe-section">
					<div class="container">
						<div class="row v-align">
							<div class="col-md-6">
								<?php echo wp_kses_post( $text ); ?>
							</div>
							<div class="col-md-6">
								<?php echo do_shortcode( wp_kses_post( $shortcode ) ); ?>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

/**
 * Position for the subscribe form: header, footer or both
 */
function elfie_subscribe_section_position() {

	$position 	= get_theme_mod( 'subscribe_position', 'header' );
	$display	= get_theme_mod( 'subscribe_display', 1 );

	if ( $display && !is_home() ) {
		return;
	}

	if ( $position == 'header' ) {
		add_action( 'elfie_header_after', 'elfie_subscribe_section' );
	} elseif ( $position == 'footer' ) {
		add_action( 'elfie_footer_before', 'elfie_subscribe_section' );
	} else {
		add_action( 'elfie_header_after', 'elfie_subscribe_section' );
		add_action( 'elfie_footer_before', 'elfie_subscribe_section' );
	}
}
add_action( 'wp', 'elfie_subscribe_section_position' );

/**
 * Archives and search titles
 */
function elfie_archive_titles() { 
	
	if ( is_archive() ) : ?>
	<header class="page-header">
		<div class="container">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>		
		</div>
	</header><!-- .page-header -->
	<?php elseif ( is_search() ) : ?>
	<header class="page-header">
		<h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'elfie' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
	</header><!-- .page-header -->
	<?php
	endif;
}
add_action( 'elfie_header_after', 'elfie_archive_titles' );

/**
 * Page banner for single pages using template_banner.php template
 */
function elfie_page_banner() {

	if ( !is_page_template( 'page-templates/template_banner.php' ) ) {
		return; //This function applies to the template_banner.php template
	}

	?>

	<div class="page-banner" style="background-image:url(<?php the_post_thumbnail_url( array( 1920, 500 ) ); ?>)"></div>

	<?php
}
add_action( 'elfie_header_after', 'elfie_page_banner' );

/**
 * Post banner
 */
function elfie_post_banner() {

	global $post;

	//Get the layout for single posts
	$customizer_layout 	 = get_theme_mod( 'post_layout', 'layout-default' ); //Set from the Customizer
	
	if ( is_404() ) {
		$post_layout = 'layout-default';
	} else {
		$post_layout = get_post_meta( $post->ID, '_elfie_post_layout', true ); //Set from post metabox
	}

	if ( $post_layout !== '' && $post_layout !== 'customizer' ) { //Metabox layout takes priority
		$layout = $post_layout; 
	} else {
		$layout = $customizer_layout;
	}

	if ( !is_single() || ( $layout == 'layout-default' ) ) {
		return;
	}

	?>

	<div class="page-banner" style="background-image:url(<?php the_post_thumbnail_url( array( 1920, 500 ) ); ?>)">
		<?php if ( $layout == 'layout-featuredbanner2' ) : ?>
		<header class="entry-header post-header">
			
			<div class="post-cats"><?php elfie_post_cats(); ?></div>
			
			<?php the_title( '<h1 class="entry-title">', '</h1>' );

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					elfie_posted_by();
					elfie_posted_on();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<?php endif; ?>		
	</div>

	<?php
}
add_action( 'elfie_header_after', 'elfie_post_banner' );


/**
 * Top bar
 */
function elfie_top_bar() {

	$show_social = get_theme_mod( 'show_social_menu', 0 );

	if ( !$show_social && !has_nav_menu( 'top' ) ) {
		return;
	}

	?>
		<div class="top-bar">
			<div class="container">
				<div class="row v-align">
					<div class="col-md-8">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'top',
								'menu_id'        => 'top-menu',
								'fallback_cb'	 => false,
								'menu_class'      => 'menu clear',
								'depth'			 => '1'
							) );
						?>
					</div>
					<?php if ( $show_social ) : ?>			
					<div class="col-md-4">
						<div class="header-social">
							<?php elfie_header_social(); ?>
						</div>	
					</div>	
					<?php endif; ?>	
				</div>		
			</div>
		</div>
	<?php
}
add_action( 'elfie_header_before', 'elfie_top_bar' );