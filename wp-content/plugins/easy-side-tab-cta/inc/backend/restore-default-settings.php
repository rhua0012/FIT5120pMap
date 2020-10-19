<?php 
defined('ABSPATH') or die('No Script');
if (isset($_GET['_wpnonce_restore_default']) && wp_verify_nonce($_GET['_wpnonce_restore_default'],'restore_default_nonce'))
{
	global $wpdb;
	global $est_variables;

	if($_GET['id'])
	{
		$tab_id = $_GET['id'];
	}

	$est_plugin_defaults = stripslashes_deep($this->sanitize_array($est_variables['est_defaults']));
	//serialized plugin_default_settings
	$est_plugin_defaults = maybe_serialize( $est_variables['est_defaults'] );

	$table_name = $wpdb->prefix . 'est_cta_settings';
	$data = array(
		'id' => $tab_id,
		'name' => 'Tab 1',
		'plugin_settings' => $est_plugin_defaults,
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
		wp_redirect(admin_url().'admin.php?page=est-admin&message=2');
	}
	else{
		wp_redirect(admin_url().'admin.php?page=est-admin&message=4');	
	}
}
