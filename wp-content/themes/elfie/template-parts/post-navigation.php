<?php
/**
 * Template part for single post navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elfie
 */

?>

<?php
	//Get previous and next posts and their respective thumbnails
	$elfie_previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$elfie_next     = get_adjacent_post( false, '', false );

	if ( ! $elfie_next && ! $elfie_previous ) {
		return;
	}

	$elfie_prev_post = get_previous_post();
	if ( $elfie_prev_post ) {
		$elfie_prev_thumbnail = get_the_post_thumbnail( $elfie_prev_post->ID, 'thumbnail' );
	} else {
		$elfie_prev_thumbnail = '';
	}
	$elfie_next_post = get_next_post();
	if ( $elfie_next_post ) {
		$elfie_next_thumbnail = get_the_post_thumbnail( $elfie_next_post->ID, 'thumbnail' );
	} else {
		$elfie_next_thumbnail ='';
	}
	if ( $elfie_prev_thumbnail ) {
		$elfie_has_prev_thumb = 'has-thumb';
	} else {
		$elfie_has_prev_thumb = '';
	}
	if ( $elfie_next_thumbnail ) {
		$elfie_has_next_thmb = 'has-thumb';
	} else {
		$elfie_has_next_thmb = '';
	}
?>

<nav class="navigation post-navigation" role="navigation">
	<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'elfie' ); ?></h2>
	<div class="nav-links">
		<?php	
			if ( get_previous_post() ) {
				echo '<div class="nav-previous ' . $elfie_has_prev_thumb . '">';
					echo '<div class="post-nav-label">' . esc_html__( 'Previous article', 'elfie' ) . '</div>';
					echo '<div class="v-align">';
					if ( $elfie_prev_thumbnail ) {
						echo $elfie_prev_thumbnail;
					}
					previous_post_link( '%link', '<h4>%title</h4>' );
					echo '</div>';
				echo '</div>';
			}
			if ( get_next_post() ) {
				echo '<div class="nav-next ' . $elfie_has_next_thmb . '">';
					echo '<div class="post-nav-label">' . esc_html__( 'Next article', 'elfie' ) . '</div>';
					echo '<div class="v-align">';
					next_post_link( '%link', '<h4>%title</h4>' );
					if ( $elfie_next_thumbnail ) {
						echo $elfie_next_thumbnail;
					}
					echo '</div>';
				echo '</div>';
			}
		?>
	</div><!-- .nav-links -->
</nav><!-- .navigation -->