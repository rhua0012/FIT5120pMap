<?php  defined('ABSPATH') or die('no script');

	$est_general_settings = get_option( 'est_general_settings' );
	$est_general_settings = maybe_unserialize( $est_general_settings );

	global $wpdb;
	$table_name = $wpdb->prefix . 'est_cta_settings';
	//get all the row from the database
	$est_lists = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID ASC");
?>

<div class="wrap est-wrap">
	<div class="est-header-wrap">
		<h3><span class="est-admin-title"><?php esc_attr_e( 'Sidebar Settings', 'easy-side-tab' ); ?></span></h3>
        <div class="logo">
            <img src="<?php echo EST_IMAGE_DIR; ?>/logo.png" alt="<?php esc_attr_e('AccessPress Social Icons', 'easy-side-tab'); ?>">
        </div>
    </div>

	<div class="est-message-wrap">
		<?php 
		if(isset($_GET['message']) && $_GET['message'] =='1'){ ?>
			<div class="notice notice-success is-dismissible">
		        <p><?php _e( 'General Settings saved successfully.', 'easy-side-tab' ); ?></p>
		    </div>
		<?php } ?>
	</div>

	<div class="est-message-wrap">
		<?php 
		if(isset($_GET['message']) && $_GET['message'] == '0'){ ?>
			<div class="notice notice-error is-dismissible">
		        <p><?php _e( 'General Settings save failed.', 'easy-side-tab' ); ?></p>
		    </div>
		<?php } ?>
	</div>

	<div class="content est-main-settings-content">
		<form action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
		<?php wp_nonce_field('est_general_settings_nonce', 'est_general_settings_nonce_field'); ?>
    	<input type="hidden" name="action" value="est_general_settings_save"/>

		<div class="est-field-wrap"> 
			<label for="est-enable-side-tab-chkbx" class="est-field-label">
				<?php _e('Enable Side Tab', 'easy-side-tab'); ?>
			</label>

			<label for='est-enable-side-tab-chkbx' class="est-field-content">
				<input type="checkbox"  name="general_settings[sidetab_enable]" id='est-enable-side-tab-chkbx' <?php echo ( isset($est_general_settings['general_settings']['sidetab_enable']) )?'checked="checked"':''; ?> >   
				<div class="est-checkbox-style"></div>
			</label>
		</div>

		<div class="est-field-wrap"> 
			
			<label for="est-enable-side-tab-mbl-chkbx" class="est-field-label">
				<?php _e('Enable Side Tab For Mobile', 'easy-side-tab'); ?>
			</label>

			<label for='est-enable-side-tab-mbl-chkbx' class="est-field-content">
				<input type="checkbox"  name="general_settings[mobile_enable]" id='est-enable-side-tab-mbl-chkbx' <?php echo ( isset($est_general_settings['general_settings']['mobile_enable']) )?'checked="checked"':''; ?> >   
				<div class="est-checkbox-style"></div>
			</label>

		</div>	

		<div class="est-field-wrap">
			<label><?php _e('Tab Position', 'easy-side-tab'); ?></label>
			<select name="general_settings[tab_position]" class="est-enable-offset">
				<option value="" disabled="disabled"><?php _e('Select Position','easu-side-tab'); ?></option>
				<option value="right" <?php echo ((esc_attr( $est_general_settings['general_settings']['tab_position'] ))== 'right')?'selected="selected"':''; ?>><?php _e('Right','easy-side-tab'); ?></option>
				<option value="left" <?php echo ((esc_attr( $est_general_settings['general_settings']['tab_position'] ))== 'left')?'selected="selected"':''; ?>><?php _e('Left','easy-side-tab'); ?></option>
			</select>
		</div>

		<div class="est-field-wrap" for='est-enable-offset'>
			
			<label class="est-field-label" >
				<?php _e('Enable Offset', 'easy-side-tab'); ?>
			</label>

			<label class="est-field-content">
				<input type="checkbox" name="general_settings[enable_offset]" id="est-enable-offset"  <?php echo isset($est_general_settings['general_settings']['enable_offset']) ? 'checked="checked"' : ''; ?> >
				<div class="est-checkbox-style"></div>
			</label>
		</div>

		<div class="est-field-wrap" style="<?php if( isset($est_general_settings['general_settings']['enable_offset']) ){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
			
			<label><?php _e('Position From Top (%)', 'easy-side-tab'); ?></label>
	
			<input type="number" name="general_settings[offset_from_top]" value="<?php echo isset($est_general_settings['general_settings']['offset_from_top'])?esc_attr($est_general_settings['general_settings']['offset_from_top']):NULL; ?>" min='0'>
		</div>

		<div class="est-field-wrap">
			<label><?php _e('Display Page', 'easy-side-tab'); ?></label>
			<select name="general_settings[display_page]">
				<option value="" disabled="disabled"><?php _e('Select Display Page','easy-side-tab'); ?></option>
				<option value="all_pages"<?php echo ((esc_attr( $est_general_settings['general_settings']['display_page'] ))== 'all_pages')?'selected="selected"':''; ?>><?php _e('Show On All Pages','easy-side-tab'); ?></option>
				<option value="homepage" <?php echo ((esc_attr( $est_general_settings['general_settings']['display_page'] ))== 'homepage')?'selected="selected"':''; ?>><?php _e('Show Only On Homepage','easy-side-tab'); ?></option>
			</select>
		</div>	

		<div class="est-field-wrap">
			<label><?php _e('Selected Tab', 'easy-side-tab'); ?></label>
			<select name="general_settings[selected_tab_id]">
				<?php foreach ($est_lists as $est_list) { ?>
				<option value="<?php echo $est_list->id; ?>" <?php echo ((esc_attr( $est_general_settings['general_settings']['selected_tab_id'] ))==$est_list->name)?'selected="selected"':''; ?>>
					<?php echo esc_attr($est_list->name); ?>
				</option>
				<?php } ?>
				
			</select>
		</div>	
		<button class="button-primary est-button-primary"><?php _e('Save Settings', 'easy-side-tab'); ?></button>
		</form>
	</div>	
</div>	