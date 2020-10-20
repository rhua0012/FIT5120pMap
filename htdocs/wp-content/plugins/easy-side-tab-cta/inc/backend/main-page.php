<?php defined('ABSPATH') or die('No Script'); 
//For Loading all the internal pages
$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => '-1'));

//load default plugin variables
global $wpdb;
$table_name = $wpdb->prefix . 'est_cta_settings';
//get the first result from database
$est_settings_from_db = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID ASC LIMIT 1");

$sidbar_name = $est_settings_from_db[0]->name;
$est_settings = maybe_unserialize( $est_settings_from_db[0]->plugin_settings, ARRAY_A);
?> 

<div class="wrap est-wrap">
	<div class="est-header-wrap">
		<h3><span class="est-admin-title"><?php esc_attr_e( 'Edit Tab', 'easy-side-tab' ); ?></span></h3>
        <div class="logo">
            <img src="<?php echo EST_IMAGE_DIR; ?>/logo.png" alt="<?php esc_attr_e('AccessPress Social Icons', 'easy-side-tab'); ?>">
        </div>
    </div>

	<div class="est-message-wrap">
		<?php 
		if(isset($_GET['message']) && $_GET['message'] =='1'){ ?>
			<div class="notice notice-success is-dismissible">
		        <p><?php _e( 'Settings saved successfully.', 'easy-side-tab' ); ?></p>
		    </div>
		<?php } 
		if(isset($_GET['message']) && $_GET['message'] == '0'){ ?>
			<div class="notice notice-error is-dismissible">
		        <p><?php _e( 'Settings save failed.', 'easy-side-tab' ); ?></p>
		    </div>
		<?php }
		if(isset($_GET['message']) && $_GET['message'] == '2'){ ?>
			<div class="notice notice-success is-dismissible">
		        <p><?php _e( 'Settings restored successfully.', 'easy-side-tab' ); ?></p>
		    </div>
		<?php }
		if(isset($_GET['message']) && $_GET['message'] == '4'){ ?>
			<div class="notice notice-error is-dismissible">
		        <p><?php _e( "Settings can't be restored.Please try again later.", 'easy-side-tab' ); ?></p>
		    </div>
		<?php } ?>
	</div>

	<div class="menu-wrap est-menu-wrap">
		<div class="nav-tab-wrapper est-nav-tab-wrapper">
			<a href="javascript:void(0)" class="nav-tab est-nav-tab est-nav-tab-active" data-tab="est-tab-settings"><?php esc_attr_e( 'Tab Setting', 'easy-side-tab' ); ?></a>
			<a href="javascript:void(0)" class="nav-tab est-nav-tab" data-tab="est-layout"><?php esc_attr_e( 'Layout', 'easy-side-tab' ); ?></a>
		</div>
	</div>
	
	<form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" id="main-form">
		<?php wp_nonce_field('est_settings_nonce', 'est_settings_nonce_field'); ?>
	    <input type="hidden" name="action" value="est_settings_save"/>
	    <input type="hidden" name="tab[tab_id]" value="<?php echo  $est_settings_from_db[0]->id; ?>">
		<?php
	        //Tab Settings Page
	        include_once('boards/tab-settings.php');
	    
	        //Layout Settings Page
	        include_once('boards/layout-settings.php');
	    ?>
		<button class="button-primary est-button-primary"><?php _e('Save Settings','easy-side-tab'); ?></button>

		<?php
		$restore_default_nonce = wp_create_nonce('restore_default_nonce');
		if(isset($_GET['id']))
		{
			$tab_id = $_GET['id']; //when user clicks on edit button from tab list page
		}else{
			$tab_id = '1'; //when user directly goes to the edit tab page from the menu(ie there is no id for get method) 
		}
		?>
	
		<a href="<?php echo admin_url('admin-post.php');?>?action=restore_default&id=<?php echo (($tab_id)?esc_attr($tab_id):''); ?>&_wpnonce_restore_default=<?php echo esc_attr($restore_default_nonce); ?>" onclick="return confirm('<?php _e("Do you really want to restore default settings?", "easy-side-tab"); ?>' )" class="button-secondary est-button-secondary">
			<?php _e('Restore Default','easy-side-tab') ?>
		</a>
	</form>
</div> <!-- .wrap -->