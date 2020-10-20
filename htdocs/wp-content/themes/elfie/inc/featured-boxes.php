<?php
/**
 * Blog featured boxes
 *
 * @package Elfie
 */

/**
 * Featured boxes
 */

function elfie_featured_boxes() {

	if ( is_home() && !is_paged() ) : ?>
	<div id="featured-boxes" class="featured-boxes">
		<div class="container">
			<div class="row">
				<?php elfie_featured_box_1(); ?>
				<?php elfie_featured_box_2(); ?>
				<?php elfie_featured_box_3(); ?>
			</div>
		</div>
	</div>	
	<?php endif;
}
add_action( 'elfie_header', 'elfie_featured_boxes', 20 );

function elfie_featured_box_1() {

	//Settings
	$box_1_image = get_theme_mod( 'box_1_image' );
	$box_1_text  = get_theme_mod( 'box_1_text' );
	$box_1_url   = get_theme_mod( 'box_1_url' );

	if ( '' == $box_1_image ) {
		return;
	}

	?>
		<div class="col-md-4 fb1">	
			<div class="featured-box">
				<div class="featured-box-inner v-align" style="background-image: url( <?php echo esc_url( $box_1_image ); ?> );">
					<a class="v-align" href="<?php echo esc_url( $box_1_url ); ?>"><span><?php echo esc_html( $box_1_text ); ?></span></a>
				</div>
			</div>	
		</div>
	<?php
}

function elfie_featured_box_2() {

	//Settings
	$box_2_image = get_theme_mod( 'box_2_image' );
	$box_2_text  = get_theme_mod( 'box_2_text' );
	$box_2_url   = get_theme_mod( 'box_2_url' );

	if ( '' == $box_2_image ) {
		return;
	}

	?>
		<div class="col-md-4 fb2">	
			<div class="featured-box">
				<div class="featured-box-inner v-align" style="background-image: url( <?php echo esc_url( $box_2_image ); ?> );">
					<a class="v-align" href="<?php echo esc_url( $box_2_url ); ?>"><span><?php echo esc_html( $box_2_text ); ?></span></a>
				</div>
			</div>	
		</div>
	<?php
}

function elfie_featured_box_3() {

	//Settings
	$box_3_image = get_theme_mod( 'box_3_image' );
	$box_3_text  = get_theme_mod( 'box_3_text' );
	$box_3_url   = get_theme_mod( 'box_3_url' );

	if ( '' == $box_3_image ) {
		return;
	}

	?>
		<div class="col-md-4 fb3">	
			<div class="featured-box">
				<div class="featured-box-inner v-align" style="background-image: url( <?php echo esc_url( $box_3_image ); ?> );">
					<a class="v-align" href="<?php echo esc_url( $box_3_url ); ?>"><span><?php echo esc_html( $box_3_text ); ?></span></a>
				</div>
			</div>	
		</div>
	<?php
}