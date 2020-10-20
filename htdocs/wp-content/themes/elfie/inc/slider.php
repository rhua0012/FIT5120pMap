<?php
/**
 * Slider template file
 *
 * @package Elfie
 */

/**
 * Slider template
 */
function elfie_slider_template() {

	$show_slider = get_theme_mod( 'show_slider', 1 );

	if ( !$show_slider ) {
		return;
	}

	if ( !is_home() || is_paged() ) { //The slider should show only on the first page of blog loop
		return;
	}

	//Settings
	$ids 				= get_theme_mod( 'carousel_posts' );
	$autoplay_speed 	= get_theme_mod( 'autoplay_speed', '3000' );
	$container			= get_theme_mod( 'slider_container', 'fullwidth' );
	$carousel_layout 	= get_theme_mod( 'carousel_layout', 'columns1' );

	//Layout
	switch ( $carousel_layout ) {
		case 'columns1':
			$layout 	= '"slidesToShow": 1';
			$image_size = 'full';
			break;
		case 'columns2':
			$layout 	= '"slidesToShow": 2, "responsive": [{ "breakpoint": 600, "settings": { "slidesToShow": 1 } }]';
			$image_size = 'large';
			break;
		case 'columns3':
			$layout 	= '"slidesToShow": 3, "responsive": [{ "breakpoint": 1024, "settings": { "slidesToShow": 2 } },{ "breakpoint": 600, "settings": { "slidesToShow": 1 } }]';
			$image_size = 'elfie-900x9999';
			break;
		case 'columns4':
			$layout 	= '"slidesToShow": 4, "responsive": [{ "breakpoint": 1300, "settings": { "slidesToShow": 3 } },{ "breakpoint": 1024, "settings": { "slidesToShow": 2 } },{ "breakpoint": 600, "settings": { "slidesToShow": 1 } }]';
			$image_size = 'elfie-900x9999';
			break;								
		default:
			$layout 	= '"slidesToShow": 1, "centerMode": true, "centerPadding": "20%", "responsive": [{ "breakpoint": 600, "settings": { "centerMode": false } }]';
			$image_size = 'elfie-900x9999';
			break;
	}

	//Query
	$args = array(
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> 6
	);

	if ( is_array( $ids ) && array_filter( $ids ) ) {
		$postids 	= array( 'post__in' => $ids );
		$args 		= array_merge( $args, $postids );
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) { ?>
		<div class="hero-slider">
			<div class="<?php echo esc_attr( $container ); ?> <?php echo esc_attr( $carousel_layout ); ?>">
				<div class="slider-inner" data-slick='{<?php echo $layout; ?>, "adaptiveHeight": true, "arrows": false, "infinite": true, "autoplay": true, "autoplaySpeed": <?php echo absint( $autoplay_speed ) ?>}'>
				<?php
				while ( $query->have_posts() ) : $query->the_post(); ?>	
					<?php
					global $post;
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), $image_size );
					?>
					
					<?php if ( has_post_thumbnail() ) : ?>	
						<?php $slide_style = "background-image:url(" . esc_url( $image[0] ) . ")"; ?>
					<?php else : ?>
						<?php $slide_style = "background-color: #333;"; //set a bg color for the slide item if there is no image ?>
					<?php endif; ?>
					
					<div class="slide v-align" style="<?php echo $slide_style; ?>">
						<div class="slide-content">
							<div class="content-inner">
								<div class="post-cats"><?php elfie_first_category(); ?></div>
								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								<span class="entry-meta">
									<?php elfie_posted_by(); ?>
									<?php elfie_posted_on(); ?>
								</span>
							</div>
						</div>
					</div>				
				<?php endwhile; ?>	
				</div>
			</div>	
		</div>

	<?php
	}
	wp_reset_postdata();
}
add_action( 'elfie_header', 'elfie_slider_template', 15 );

/**
 * Modify the main query to exclude carousel posts from the loop
 */
function elfie_exclude_carousel_posts( $query ) {

	$exclude_posts 	= get_theme_mod( 'exclude_carousel_posts' );
	$carousel_posts = get_theme_mod( 'carousel_posts' );

	//Return if we don't need to exclude posts
	if ( !$exclude_posts ) {
		return;
	}
	
	//Exclude the posts
	if ( $query->is_home() && $query->is_main_query() && !is_admin() ) {
		$query->set( 'post__not_in', $carousel_posts );
	}
}
add_action( 'pre_get_posts', 'elfie_exclude_carousel_posts' );