<?php 
defined('ABSPATH') or die('No Script '); 

//Get General Settings
$est_general_settings = get_option( 'est_general_settings' );
$est_general_settings = maybe_unserialize( $est_general_settings );
$selected_tab_general_settings_id = $est_general_settings['general_settings']['selected_tab_id'];

//Tab Settings and layout Settings
global $wpdb;
$table_name = $wpdb->prefix . 'est_cta_settings';
$est_lists = $wpdb->get_row("SELECT * FROM $table_name WHERE ID =$selected_tab_general_settings_id");
$est_settings = unserialize($est_lists->plugin_settings);

//Set or unset the tab for mobile devices
$mobile_enable = isset($est_general_settings['general_settings']['mobile_enable']) ?'est-mobile-display-on':'';

if( isset( $est_general_settings['general_settings']['sidetab_enable'] ) )
{ 
	if( ( esc_attr($est_general_settings['general_settings']['display_page']) == 'all_pages') || ( ( esc_attr($est_general_settings['general_settings']['display_page']) =='homepage') && is_front_page()) )
	{
		
if( esc_attr($est_general_settings['general_settings']['tab_position']) == 'left'){
	$position = 'est-left';

}elseif ( esc_attr($est_general_settings['general_settings']['tab_position']) == 'right') {
	$position = 'est-right';
}
else{
	$position = '';
}


// get color if customize enabled
if( isset($est_settings['tab']['layout_settings']['enable_customize']) ){
	if( esc_attr($est_settings['tab']['layout_settings']['customize_settings']['background_color']) )
	{
		$background_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['background_color']);
	}
	if ( esc_attr($est_settings['tab']['layout_settings']['customize_settings']['text_color']) )
	{
		$text_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['text_color']); 
	}
	if( esc_attr($est_settings['tab']['layout_settings']['customize_settings']['background_hover_color']) )
	{
		$background_hover_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['background_hover_color']);
	}
	if( esc_attr($est_settings['tab']['layout_settings']['customize_settings']['text_hover_color']) )
	{
		$text_hover_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['text_hover_color']);
	}
	if( esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_content_bg_color']) )
	{
		$slider_content_bg_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_content_bg_color']);
	}
	if( esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_content_text_color']) )
	{
		$slider_content_text_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_content_text_color']);
	}
	if( esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_color']))
	{
		$slider_close_button_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_color']);
	}
	if(esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_text_color']))
	{
		$slider_close_button_text_color = esc_attr($est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_text_color']);
	}
}
	//For display Position
	if(esc_attr($est_settings['tab']['layout_settings']['display_position']))
	{
		$display_position = ( esc_attr($est_settings['tab']['layout_settings']['display_position']) == 'fixed')?'est-fixed':( (esc_attr($est_settings['tab']['layout_settings']['display_position']) == 'absolute')?'est-absolute':'' );
	}

//selected template
if(isset($est_settings['tab']['layout_settings']['template']))
{
	$selected_template =  ( esc_attr($est_settings['tab']['layout_settings']['template']) == 'Template 1')?'template-1':( ( esc_attr($est_settings['tab']['layout_settings']['template']) == 'Template 2')?'template-2' : '') ;
	$selected_template = 'est-'.$selected_template;
}else{
	$selected_template = '';
}


//offset position from top for tab
if(isset($est_general_settings['general_settings']['enable_offset']))
{
	if(isset($est_general_settings['general_settings']['offset_from_top']))
	{
	?>
	<style>
		.est-frontend-display-wrap.<?php echo $selected_template; ?>
		{
			top: <?php echo esc_attr($est_general_settings['general_settings']['offset_from_top']).'%'; ?>;
			margin-top: 2%;
		}
	</style>
	<?php

	}
}
?>




<div class='est-frontend-display-wrap <?php echo esc_attr($position); ?> <?php echo esc_attr($selected_template); ?> <?php echo esc_attr($display_position); ?> <?php echo esc_attr($mobile_enable); ?>' id="est-front-display-wrap" >	
	
	<?php 
	switch (esc_attr($est_settings['tab']['tab_settings']['tab_content']['type'])) 
	{
		case 'internal':
		$page_link = esc_attr($est_settings['tab']['tab_settings']['tab_content']['internal']['page']);
	?>

	<!-- internal style for internal tab link when customize enabled -->
	<?php if(isset($est_settings['tab']['layout_settings']['enable_customize'])){ ?>
	<style>
		.est-frontend-display-wrap.<?php echo esc_attr($selected_template); ?> a.est-tab-link{
			background-color: <?php echo esc_attr($background_color); ?>;
			color: <?php echo esc_attr($text_color); ?>;
		}
		.est-frontend-display-wrap.<?php echo esc_attr($selected_template); ?> a.est-internal-link:hover{
			background: <?php echo esc_attr($background_hover_color); ?>;
			color: <?php echo esc_attr($text_hover_color); ?>;
		}
	</style>
	<?php } ?>


	<div class="est-internal est-tab-type">
		
		<a href="<?php echo get_page_link($page_link); ?>" target="<?php echo (esc_attr($est_settings['tab']['tab_settings']['tab_content']['internal']['target']))?esc_attr($est_settings['tab']['tab_settings']['tab_content']['internal']['target']):''; ?>" class="est-internal-link est-tab-link">
			<?php echo esc_attr($est_settings['tab']['tab_settings']['tab_title']); ?>
		</a>
		
	</div>
	<?php
			break;
		case 'external':
		$link = esc_attr($est_settings['tab']['tab_settings']['tab_content']['external']['url']);
	?>
	
	<!-- internal style for external tab link when customize enabled -->
	<?php if(isset($est_settings['tab']['layout_settings']['enable_customize'])){ ?>
	<style>
		.est-frontend-display-wrap.<?php echo esc_attr($selected_template); ?> a.est-external-link{
			background-color: <?php echo esc_attr($background_color); ?>;
			color: <?php echo esc_attr($text_color); ?>;
		}
		.est-frontend-display-wrap.<?php echo $selected_template; ?> a.est-external-link:hover{
			background: <?php echo esc_attr($background_hover_color); ?>;
			color: <?php echo esc_attr($text_hover_color); ?>;
		}
	</style>
	<?php } ?>

	<div class="est-external est-tab-type">
		<div class="">
			<a href="<?php echo esc_url($est_settings['tab']['tab_settings']['tab_content']['external']['url']); ?>" target="<?php echo ($est_settings['tab']['tab_settings']['tab_content']['external']['target'])?esc_attr($est_settings['tab']['tab_settings']['tab_content']['external']['target']):''; ?>" class="est-external-link est-tab-link">
				<?php echo esc_attr($est_settings['tab']['tab_settings']['tab_title']) ?>
			</a>
		</div>
	</div>			
	<?php
			break;

		case 'content_slider':
	?>

	<!-- internal link for contentSlider when customize is enabled -->
	<?php if(isset($est_settings['tab']['layout_settings']['enable_customize'])){ ?>
	<style>
	.est-frontend-display-wrap.<?php echo esc_attr($position); ?> .est-slider-content.est-content-show{
		color: <?php echo esc_attr($slider_content_text_color); ?>;
		background-color: <?php echo esc_attr($slider_content_bg_color); ?>
	}
	.est-frontend-display-wrap.<?php echo esc_attr($selected_template); ?> .est-content-slider-title h2
	{
		background-color: <?php echo esc_attr($background_color); ?>;
		color: <?php echo esc_attr($text_color); ?>;
	}
	.est-frontend-display-wrap.<?php echo esc_attr($selected_template); ?> .est-content-slider-title h2:hover{
		background-color: <?php echo esc_attr($background_hover_color); ?>;
		color: <?php echo esc_attr($text_hover_color); ?>;
	}
	.est-frontend-display-wrap.<?php echo esc_attr($selected_template); ?> .est-close-slider-content{
		background-color: <?php echo esc_attr($slider_close_button_color); ?>;
		color:<?php echo esc_attr($slider_close_button_text_color); ?>;
	}

	</style>
	<?php } ?>

	<div class="est-content-slider est-tab-type">
		<div class="est-content-slider-title">
			<h2><?php echo esc_attr($est_settings['tab']['tab_settings']['tab_title']); ?></h2>
		</div>
		<div class="est-slider-content est-content-hidden">
			<div class="est-slider-content-inner-wrap">
				<?php echo do_shortcode( wpautop($est_settings['tab']['tab_settings']['tab_content']['content_slider']['content'], true) ); ?>
			</div>
			<span class="est-close-slider-content">x</span>
		</div>
	</div>
	<?php	
			break;

		default:
			return false;	
			break;
	}
	?>
</div>
<?php } } ?>

