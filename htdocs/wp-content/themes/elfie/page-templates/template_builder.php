<?php
/*
Template Name: Page Builder
*/

get_header(); ?>

	<div id="primary" class="content-area">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>

	</div><!-- #primary -->

<?php get_footer(); ?>
