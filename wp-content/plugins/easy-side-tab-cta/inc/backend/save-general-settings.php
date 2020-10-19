<?php 
defined('ABSPATH') or die('no script');

if(!empty($_POST) && wp_verify_nonce( $_POST['est_general_settings_nonce_field'], 'est_general_settings_nonce' ))
{	
	$est_general_settings = array();

	//Remove Unnecessary Fields From The Array
	if(isset($_POST['est_general_settings_nonce_field'])){
		unset($_POST['est_general_settings_nonce_field']);
	}
	if(isset($_POST['_wp_http_referer'])){
		unset($_POST['_wp_http_referer']);
	}
	if(isset($_POST['action'])){
		unset($_POST['action']);
	}

	//Strip Slashes Deep Inside The array
	$est_general_settings = stripslashes_deep($this->sanitize_array($_POST));

	//Serialize The Array
	$est_general_settings = maybe_serialize($est_general_settings);

	update_option('est_general_settings',$est_general_settings);
	wp_redirect(admin_url().'admin.php?page=est-settings&message=1');
}