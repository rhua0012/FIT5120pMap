<?php 
defined('ABSPATH') or die('No Script Kiddies');
if(!empty($_POST) && wp_verify_nonce( $_POST['est_settings_nonce_field'], 'est_settings_nonce' ))
{
	$est_settings = array();

	$est_settings['tab'] = stripslashes_deep($this->sanitize_array($_POST['tab']));
	$est_settings_serialized = maybe_serialize($est_settings);
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'est_cta_settings';
	$data = array(
		'id' => $est_settings['tab']['tab_id'],
		'name'=>$est_settings['tab']['tab_settings']['tab_name'],
		'plugin_settings' => $est_settings_serialized,
		);
	$format = array(
		'%d',
		'%s',
		'%s'
	);
	$status = $wpdb->replace( 
		$table_name, 
		$data, 
		$format
	);
	if($status){
		wp_redirect(admin_url().'admin.php?page=est-admin&message=1');
	}
	else{
		wp_redirect(admin_url().'admin.php?page=est-admin&message=0');	
	}
}
