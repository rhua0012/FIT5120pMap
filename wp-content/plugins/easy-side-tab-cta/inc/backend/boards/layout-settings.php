<?php 
 defined('ABSPATH') or die('no Script');
 global $est_variables;
?>

<div class="content est-content" id="est-layout" style="display: none;">
	<div class="est-field-wrap" id="est-display-settings-wrap">
		<label><?php echo esc_attr_e( 'Tab Layout', 'easy-side-tab' ); ?></label>
		<div class="est-select-img-wrap">
			<select name="tab[layout_settings][template]" class="est-image-selector">
				<?php 
					$img_url = EST_IMAGE_DIR . "/templates/template1.jpg"; 
					foreach($est_variables['templates'] as $key=>$value){
				
					if(isset($est_settings['tab']['layout_settings']['template']) && $est_settings['tab']['layout_settings']['template'] == $value['name']){
						
						$selected = 'selected="selected"';
						$img_url = $value['img'];	
					}else{
						$selected = '';
					}
					
				?>
				<option value="<?php echo esc_attr($value['name']); ?>" <?php if(isset($est_settings['tab']['layout_settings']['template']) && $est_settings['tab']['layout_settings']['template'] == $value['name']){ ?> selected="selected"<?php } ?>  data-img="<?php echo esc_url($value['img']); ?>">
					<?php echo esc_attr($value['name']); ?>
				</option>
				<?php } ?>
			</select>
			<div class="est-image-preview-wrap">
				<div class="est-layout-template-image">
					<img src="<?php echo esc_url($img_url); ?>" height="200" width="200" alt="template image">
				</div>
			</div>
		</div>
	</div>

	<div class="est-field-wrap">	
		<label><?php _e('Display Position', 'easy-side-tab'); ?></label>
		<select name="tab[layout_settings][display_position]">
			<option value="fixed" <?php echo ( esc_attr( $est_settings['tab']['layout_settings']['display_position'] ) == 'fixed' ) ? 'selected="selected"' : ''; ?>>
				<?php _e('Fixed', 'easy-side-tab'); ?>
			</option>
			<option value="absolute" <?php echo ( esc_attr( $est_settings['tab']['layout_settings']['display_position'] )== 'absolute')  ? 'selected="selected"' : ''; ?>>
				<?php _e('Absolute', 'easy-side-tab'); ?>
			</option>
		</select><br>
	</div>

	<div class="est-field-wrap">
		<label for='est-customize_layout_select' class="est-field-label">
			<?php echo esc_attr_e( 'Customize', 'easy-side-tab' ); ?> 	
		</label>

		<label for='est-customize_layout_select' class="est-field-content">
			<input type="checkbox" name="tab[layout_settings][enable_customize]" <?php echo ( isset($est_settings['tab']['layout_settings']['enable_customize']) )?'checked="checked"':''; ?> id="est-customize_layout_select" />   
			<div class="est-checkbox-style"></div>
		</label>
	</div>

	<div id="est-customize-fields-show" style="<?php if( isset($est_settings['tab']['layout_settings']['enable_customize']) ){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">

		<div class='est-tab-dynamic-options'>
			<label><strong style="text-decoration: underline;"><?php echo _e('Tab Color Customize','easy-side-tab'); ?></strong></label>
			<div class="est-field-wrap">
				<?php 
				 $bg_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['background_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['background_color']:'';
				?>
				<label><?php echo esc_attr_e( 'Background Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][background_color]" value="<?php echo esc_attr($bg_color); ?>" class="color-field est-color-field" >
			</div>	

			<div class="est-field-wrap">
				<?php 
				 $text_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['text_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['text_color']:''; 
				?>
				<label><?php echo esc_attr_e( 'Text Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][text_color]" value="<?php echo esc_attr($text_color); ?>" class="color-field est-color-field" >
			</div>	

			<div class="est-field-wrap">
				<?php 
				 $background_hover_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['background_hover_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['background_hover_color']:''; 
				?>
				<label><?php echo esc_attr_e( 'Background Hover Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][background_hover_color]" value="<?php echo esc_attr($background_hover_color); ?>" class="color-field est-color-field" >
			</div>

			<div class="est-field-wrap">
				<?php 
				 $text_hover_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['text_hover_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['text_hover_color']:''; 
				?>
				<label><?php echo esc_attr_e( 'Text Hover Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][text_hover_color]" class="color-field est-color-field" value="<?php echo esc_attr($text_hover_color); ?>">
			</div>
		</div>

		<div class='est-content-slider-dynamic-options' style="<?php if( $est_settings['tab']['tab_settings']['tab_content']['type'] == 'content_slider'){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
			<label><strong style="text-decoration: underline;"><?php echo _e('Content Slider Color Customize','easy-side-tab'); ?></strong></label>
			<div class="est-field-wrap" >
				<?php 
				 $slider_content_bg_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['slider_content_bg_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['slider_content_bg_color']:''; 
				?>
				<label><?php echo esc_attr_e( 'Slider Content Background Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][slider_content_bg_color]" class="color-field est-color-field" value="<?php echo esc_attr($slider_content_bg_color); ?>">
			</div>	

			
			<div class="est-field-wrap">
				<?php 
				 $slider_content_text_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['slider_content_text_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['slider_content_text_color']:''; 
				?>
				<label><?php echo esc_attr_e( 'Slider Content Text Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][slider_content_text_color]" class="color-field est-color-field" value="<?php echo esc_attr($slider_content_text_color); ?>">
			</div>

			<div class="est-field-wrap">
				<?php 
				 $slider_close_button_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_color']:''; 
				?>
				<label><?php echo esc_attr_e( 'Slider Close Button Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][slider_close_button_color]" class="color-field est-color-field" value="<?php echo esc_attr($slider_close_button_color); ?>">
			</div>

			<div class="est-field-wrap">
				<?php 
				 $slider_close_button_text_color = (!empty($est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_text_color']) )?$est_settings['tab']['layout_settings']['customize_settings']['slider_close_button_text_color']:''; 
				?>
				<label><?php echo esc_attr_e( 'Slider Close Button Text Color', 'easy-side-tab' ); ?></label>
				<input type="text" name="tab[layout_settings][customize_settings][slider_close_button_text_color]" class="color-field est-color-field" value="<?php echo esc_attr($slider_close_button_text_color); ?>">
			</div>
		</div>	<!-- est-content-slider-dynamic-options -->	
	</div> <!-- customize-fields-show -->
</div>   <!-- content -->