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
		<div class="row">
			<div class="v-align">
				<div class="col-md-4">
					<div class="site-branding">
						<div class="row">
						<?php
							if ( has_custom_logo() ) :
								echo '<div class="col-md-5">';
									the_custom_logo();
								echo '</div>';

								$elfie_branding_cols = 'col-md-7';
							else :
								$elfie_branding_cols = 'col-md-12';
							endif;


							echo '<div class="' . $elfie_branding_cols . '">';
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
							<?php endif;

							echo '</div>';
							?>
						</div>
					</div><!-- .site-branding -->
				</div>
				
				<div class="col-md-8">
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
		</div>			
	</div>
</div>