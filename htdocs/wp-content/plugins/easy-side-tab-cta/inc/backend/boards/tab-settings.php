<div class="content est-content" id="est-tab-settings">	
	<div class="est-field-wrap" id="est-tab-title">
		<label><?php _e('Tab Title', 'easy-side-tab'); ?></label>
		<input type="text" value="<?php echo ( $est_settings['tab']['tab_settings']['tab_name'] )?esc_attr( $est_settings['tab']['tab_settings']['tab_name'] ):esc_attr( $est_settings['tab']['tab_settings']['tab_name'] ); ?>" class="regular-text est-input-text" name="tab[tab_settings][tab_name]" />
	</div>

	<div class="est-field-wrap" id="est-tab-text">
		<label><?php _e('Text For Tab', 'easy-side-tab'); ?></label>
		<input type="text" value="<?php echo ($est_settings['tab']['tab_settings']['tab_title'])?esc_attr($est_settings['tab']['tab_settings']['tab_title']):$est_settings['tab']['tab_settings']['tab_title']; ?>" class="regular-text est-input-text" name="tab[tab_settings][tab_title]" />
	</div>

	<div class="est-field-wrap">	
		<label><?php _e('Tab Type', 'easy-side-tab'); ?></label>
		<div class="est-tab-type-wrap">
			<label>
				<input type="radio" class="est-link-type" name="tab[tab_settings][tab_content][type]" value="internal" <?php echo ($est_settings['tab']['tab_settings']['tab_content']['type']=='internal')?'checked':''; ?> /> <span><?php _e('Internal','easy-side-tab'); ?></span>
			</label>

			<label>
				<input type="radio" class="est-link-type" name="tab[tab_settings][tab_content][type]" value="external" <?php echo ($est_settings['tab']['tab_settings']['tab_content']['type']=='external')?'checked':''; ?> /> <span><?php _e('External','easy-side-tab'); ?></span>
			</label>

			<label>
				<input type="radio" class="est-link-type" name="tab[tab_settings][tab_content][type]" value="content_slider" <?php echo ($est_settings['tab']['tab_settings']['tab_content']['type']=='content_slider')?'checked':''; ?> /> <span><?php _e('Content Slider','easy-side-tab'); ?></span>
			</label>
		</div>
	</div>

	<div class="est-field-wrap" style="<?php if( $est_settings['tab']['tab_settings']['tab_content']['type'] == 'external'){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>" id="est-external-tab">
		<div class="est-field-wrap est-inner-field-wrap">
			<label><?php _e('Target', 'easy-side-tab'); ?></label>
			
			<select name="tab[tab_settings][tab_content][external][target]">
				<option value=""><?php _e('Select Target','easy-side-tab'); ?></option>
				<option value="_self" <?php echo ( ((esc_attr( $est_settings['tab']['tab_settings']['tab_content']['external']['target'] ))== '_self') ) ? 'selected="selected"' : ''; ?>>
					<?php _e('_self','easy-side-tab'); ?>
				</option>
				<option value="_blank" <?php echo ( ((esc_attr( $est_settings['tab']['tab_settings']['tab_content']['external']['target'] ))== '_blank') ) ? 'selected="selected"' : ''; ?>>
					<?php _e('_blank','easy-side-tab'); ?>
				</option>
			</select><br>
		</div>

		<div class="est-field-wrap est-inner-field-wrap">
			<label><?php _e('Tab URL', 'easy-side-tab'); ?></label>
			<input type="url" value="<?php echo isset($est_settings['tab']['tab_settings']['tab_content']['external']['url']) ? esc_attr( $est_settings['tab']['tab_settings']['tab_content']['external']['url'] ) : ''; ?>" class="regular-text est-input-text" name="tab[tab_settings][tab_content][external][url]" /><br>
		</div>
	</div>

	<div class="est-field-wrap" style="<?php if( $est_settings['tab']['tab_settings']['tab_content']['type'] == 'internal'){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>" id="est-internal-tab">		

		<div class="est-field-wrap est-inner-field-wrap">	
			<label><?php _e('Target', 'easy-side-tab'); ?></label>
			<select name="tab[tab_settings][tab_content][internal][target]">
				<option value="">Select Target</option>
				<option value="_self" <?php echo ( ((esc_attr( $est_settings['tab']['tab_settings']['tab_content']['internal']['target'] ))== '_self') ) ? 'selected="selected"' : ''; ?>>
					<?php _e('_self', 'easy-side-tab'); ?>
				</option>
				<option value="_blank" <?php echo ( ((esc_attr( $est_settings['tab']['tab_settings']['tab_content']['internal']['target'] ))== '_blank') ) ? 'selected="selected"' : ''; ?>>
					<?php _e('_blank', 'easy-side-tab'); ?>
				</option>
			</select><br>
		</div>

		<div class="est-field-wrap est-inner-field-wrap">
			<label><?php _e('Redirect Page', 'easy-side-tab'); ?></label>
			<select name="tab[tab_settings][tab_content][internal][page]">
				<option value=""><?php _e('Select Page','easy-side-tab'); ?></option>
				<?php foreach ($all_wp_pages as $key => $pages) {?>
				<option value="<?php echo $pages->ID; ?>" <?php echo ( ((esc_attr( $est_settings['tab']['tab_settings']['tab_content']['internal']['page'] ))== $pages->ID) ) ? 'selected="selected"' : ''; ?>><?php echo $pages->post_title; ?>
				</option>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="est-field-wrap" style="<?php if( $est_settings['tab']['tab_settings']['tab_content']['type'] == 'content_slider'){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>" id="est-contentSlider-type">

		<div class="est-field-wrap est-inner-field-wrap" id="est-tab-content">
			<label><?php echo esc_attr_e( 'Content', 'easy-side-tab' ); ?></label>
			<?php
	            if ($est_settings['tab']['tab_settings']['tab_content']['content_slider']['content'] ) 
	            {
	                $content_editor = ($est_settings['tab']['tab_settings']['tab_content']['content_slider']['content']);
	            }
	            else{
	            	$content_editor = "";
	            }
	            $settings = array(
	            			'media_buttons' => false, 
	            			'textarea_name' => 'tab[tab_settings][tab_content][content_slider][content]', 
	            			'quicktags' => array('buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close'),
	            			'editor_class' => 'est_slider_content',
	            			);

	            $editor_id = 'est_content'; //id for this editor
	            wp_editor($content_editor, $editor_id, $settings);
	        ?>
		</div>
	</div>	
		
</div> <!-- content -->