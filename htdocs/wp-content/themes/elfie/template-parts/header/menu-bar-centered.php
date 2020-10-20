<?php
/**
 * Template part for the site navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elfie
 */

?>

<div class="site-header-inner">
	<div class="container">
		<div class="site-branding">
			<?php
			if ( has_custom_logo() ) :
				the_custom_logo();
			endif;
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$elfie_description = get_bloginfo( 'description', 'display' );
			if ( $elfie_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $elfie_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<button class="menu-toggle" tabindex="0" aria-controls="primary-menu" aria-expanded="false"><i class="icon-menu"></i></button>
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-close-button" tabindex="0" aria-controls="primary-menu" aria-expanded="false"><i class="icon-cancel"></i></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'	 => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</div>		
</div>