<?php defined('ABSPATH') or die("No script kiddies please!");
/**
 * Plugin Name: Easy Side Tab - CTA plugin for WordPress 
 * Plugin URI: https://accesspressthemes.com/wordpress-plugins/easy-side-tab/
 * Description: A simple side tab for easy Link
 * Version: 1.0.6
 * Author: AccessPress Themes 
 * Author URI: http://accesspressthemes.com
 * Text Domain: easy-side-tab
 * Domain Path: /languages/
 * License: GPL2
 */

/**
* Plugin Main Class Initialization
*/

if(!class_exists('EST_Class')){
	
	class EST_Class {
		

		function __construct()
		{
			add_action( 'init', array( $this, 'define_constants') );
			add_action( 'init', array( $this, 'est_plugin_variables'));
			register_activation_hook( __FILE__, array( $this, 'load_default_settings' ) );//loads default settings for the plugin while activating the plugin
			add_action( 'plugins_loaded',array( $this, 'est_text_domain' ));
			add_action('admin_menu' , array($this, 'est_add_plugin_menu'));
			add_action('admin_enqueue_scripts', array($this, 'est_register_backend_assets'));
			add_action( 'wp_enqueue_scripts', array($this, 'est_register_frontend_assets') );
			add_action('admin_post_est_settings_save', array($this, 'est_settings_action'));
			add_action('admin_post_est_general_settings_save',array($this,'est_general_settings_save'));
			add_action('admin_post_restore_default', array($this, 'est_restore_default'));
			add_action('wp_footer' , array($this, 'est_display_front') );
		}

		/**
		 * Function for the constant declaration of the plugins.
		 */
		function define_constants(){
			defined('EST_PLUGIN_ROOT_DIR') or define('EST_PLUGIN_ROOT_DIR', plugin_dir_path( __FILE__ ));
			defined('EST_PLUGIN_DIR') or define('EST_PLUGIN_DIR', plugin_dir_url( __FILE__ ));
		    defined('EST_VERSION') or define( 'EST_VERSION' , '1.0.6' );
		    defined('EST_CSS_DIR') or define( 'EST_CSS_DIR' , EST_PLUGIN_DIR . 'css');
		    defined('EST_IMAGE_DIR') or define( 'EST_IMAGE_DIR' , EST_PLUGIN_DIR . 'images');
		    defined('EST_JS_DIR') or define( 'EST_JS_DIR' , EST_PLUGIN_DIR . 'js');
		    defined('EST_LANG_DIR') or define('EST_LANG_DIR',EST_PLUGIN_DIR.'languages');
		}

		/**
		 * Function to add  plugin's necessary CSS and JS files for backend
		 */
 	 	function est_register_backend_assets(){
 	 		wp_enqueue_script( 'wp-color-picker' );
 	 		wp_enqueue_style( 'wp-color-picker');
 	 		wp_enqueue_script('est-admin-js', EST_JS_DIR. '/est-backend.js', array('jquery', 'wp-color-picker'), EST_VERSION);
 	 		wp_enqueue_style( 'est-admin-css', EST_CSS_DIR. '/est-backend.css', '', EST_VERSION );
 	 		wp_enqueue_style('font-awesome-v5.0.4', EST_CSS_DIR . '/font-awesome/fontawesome.min.css', false, EST_VERSION);
 	 	}

 	 	/**
		 * Function to add  plugin's necessary CSS and JS files for frontend
		 */
 	 	function est_register_frontend_assets(){
 	 		wp_enqueue_script( 'est-frontend-js', EST_JS_DIR.'/frontend/est-frontend.js', array('jquery'), EST_VERSION );
 	 		wp_enqueue_style( 'est-frontend-css', EST_CSS_DIR. '/frontend/est-frontend.css', '', EST_VERSION );
 	 		wp_enqueue_style( 'est-frontend-scrollbar-css', EST_CSS_DIR. '/jquery.mCustomScrollbar.css','', EST_VERSION);
 	 		wp_enqueue_script( 'est-frontend-scrollbar-js', EST_JS_DIR. '/jquery.mCustomScrollbar.concat.min.js', array( 'jquery' ), EST_VERSION );
 	 	}


		/**
		 * Function to load the plugin text domain for plugin translation
		 * @return type
		 */
		function est_text_domain(){
			load_plugin_textdomain( 'easy-side-tab', False, plugin_dir_url( __FILE__ ).'languages' );
		}

		/**
         * Plugin Variables
         * @since 1.0.0
         */
		public function est_plugin_variables(){
			global $est_variables;
			$est_variables['templates'] = array(
                                array(
                                    'name' => sprintf(__('Template %s', 'easy-side-tab'), '1'),
                                    'value' => 'template-1',
                                    'img' => EST_IMAGE_DIR . '/templates/template1.jpg'
                                ),
                                array(
                                    'name' => sprintf(__('Template %s', 'easy-side-tab'), '2'),
                                    'value' => 'template-2',
                                    'img' => EST_IMAGE_DIR . '/templates/template2.jpg'
                                )
                            );
			$est_variables['est_defaults'] = array(
							'tab' => array(
										'tab_settings' => array(
													'tab_name' => 'Tab 1',
											  		'tab_title' => 'Title',
											  		'tab_content' => array(
											  								'type' => 'external',
											  								'internal' => array(
											  												'page' =>'',
											  												'target'=>'',
											  												),
											  								'external' => array(
											  												'url' =>'',
											  												'target'=>'_blank',
											  												),
											  								'content_slider' => array(
											  														'content' => '',
											  														),
											  								)
											  	    			),
										'layout_settings' =>array(
																'template' => 'Template 1',
																'display_position' => 'fixed',
																'enable_customize' => null,
																'customize_settings' => array(
																						'background_color' => '#b5b5b5',
																						'text_color' =>'#000000',
																						'background_hover_color' => '#dd4d4d',
																						'text_hover_color' => '#cccccc',
																						'slider_content_bg_color' =>'#b5b5b5',
																						'slider_content_text_color' => '#212121',
																						'slider_close_button_color' => '#dd4d4d',
																						'slider_close_button_text_color' => '#ffffff',
																						),

															),	
									)	  		
							);
			
		}

		/**
         * Load Default Settings When Plugin is Activated
         * @since 1.0.0
         */
		function load_default_settings(){
			$est_defaults = array();
			$est_defaults = array(
							'tab' => array(
										'tab_settings' => array(
													'tab_name' => 'Tab 1',
											  		'tab_title' => 'Title',
											  		'tab_content' => array(
											  								'type' => 'external',
											  								'internal' => array(
											  												'page' =>'',
											  												'target'=>'',
											  												),
											  								'external' => array(
											  												'url' =>'',
											  												'target'=>'_blank',
											  												),
											  								'content_slider' => array(
											  														'content' => '',
											  														),
											  								)
											  	),
										'layout_settings' =>array(		
																'template' => 'Template 1',
																'display_position' => 'fixed',
																'enable_customize' => null,
																'customize_settings' => array(
																						'background_color' => '#b5b5b5',
																						'text_color' =>'#000000',
																						'background_hover_color' => '#dd4d4d',
																						'text_hover_color' => '#cccccc',
																						'slider_content_bg_color' =>'#b5b5b5',
																						'slider_content_text_color' => '#212121',
																						'slider_close_button_color' => '#dd4d4d',
																						'slider_close_button_text_color' => '#ffffff',
																						),
																),	
									)	  		
							);

			$est_defaults_serialized = maybe_serialize( $est_defaults );
			
			global $wpdb;
			$old_table_name = $wpdb->prefix . 'est_settings';
			//$est_settings_from_db = $wpdb->get_results("SELECT * FROM $old_table_name ORDER BY ID ASC LIMIT 1");

			//check if est_settings table is set or not 
			if(isset($est_settings_from_db[0]))
			{
				//If Set then, first create new table
				$charset_collate = $wpdb->get_charset_collate();
			    $new_table_name = $wpdb->prefix . 'est_cta_settings';
			    $sql_1 = "CREATE TABLE $new_table_name (
			            id bigint(9) unsigned NOT NULL AUTO_INCREMENT,
			            name varchar(255) NOT NULL,
			            plugin_settings longtext NOT NULL,
			            PRIMARY KEY (id)
			          ) $charset_collate;";

			    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			    dbDelta($sql_1);

			    //migrate data from previous table to current
			    $rows = $wpdb->get_var('SELECT COUNT(*) FROM '.$new_table_name); //count no of rows in that "new table"
			    
			    if (!$rows) // No rows in "new table" (ie. empty)
				{
					//copy data into the new table from old
			    	$insert_status = $wpdb->insert($new_table_name, 
											array(
												'name'=> $est_settings_from_db[0]->name,
												'plugin_settings'=> $est_settings_from_db[0]->plugin_settings,
												),
											array('%s','%s','%s') 
									);

			    	//if data is copied into new table then delete the "old Table"
			    	if($insert_status)
			    	{
			    		$wpdb->query( "DROP TABLE IF EXISTS $old_table_name" );
			    	}
			    }
			}
			else
			{
				//Cr8 db to Insert The Serialized data into the new database table
				global $wpdb;
			    $charset_collate = $wpdb->get_charset_collate();
			    $new_table_name = $wpdb->prefix . 'est_cta_settings';
			    $sql = "CREATE TABLE $new_table_name (
			            id bigint(9) unsigned NOT NULL AUTO_INCREMENT,
			            name varchar(255) NOT NULL,
			            plugin_settings longtext NOT NULL,
			            PRIMARY KEY (id)
			          ) $charset_collate;";

			    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			    dbDelta($sql);

			    //Insert The Serialized data into the new database table if DB is empty
			    $rows = $wpdb->get_var('SELECT COUNT(*) FROM '.$new_table_name);
			    if (!$rows) // No rows ie empty
				{
					
					$insert_status = $wpdb->insert($new_table_name, 
								array(
									'name'=> $est_defaults['tab']['tab_settings']['tab_name'],
									'plugin_settings'=> $est_defaults_serialized,
									),
								array('%s','%s','%s') 
					);

					if($insert_status)
					{
						$last_insert_id = $wpdb->insert_id;
						$default_general_settings = array(
													'general_settings' => array(
																		'sidetab_enable' => '1',
																		'tab_position' => 'left',
																		'display_page' => 'all_pages',
																		'selected_tab_id' => $last_insert_id,
																		));
						//Strip Slashes Deep Inside The array
						$est_general_settings = stripslashes_deep($this->sanitize_array($default_general_settings));


						//Serialize The Array
						$est_general_settings = maybe_serialize($est_general_settings);

						update_option('est_general_settings',$est_general_settings);
					}
					else
					{
						return False;
					}
				}
				else
				{
					// Fetch the rows
					return false;
				}

			}
		}

		/**
		* Add Plugin Menu in admin Panel
		*/
		function est_add_plugin_menu(){
			

			add_menu_page('Easy Side Tab', 'Easy Side Tab', 'manage_options', 'est-tabs-list', array($this, 'est_show_tabs_list'), 'dashicons-id');
	        add_submenu_page( 'est-tabs-list', 'All Tabs', 'All Tabs', 'manage_options', 'est-tabs-list', array($this, 'est_show_tabs_list') );
	        
	        add_submenu_page( '', 'Edit Tab', 'Edit Tab', 'manage_options', 'est-admin', array($this, 'est_mainpage') );
	        add_submenu_page( 'est-tabs-list', 'Side Tab Settings', 'Side Tab Settings', 'manage_options', 'est-settings', array($this, 'est_main_settings') );
	        add_submenu_page( 'est-tabs-list', 'More WordPress Stuffs', 'More WordPress Stuffs', 'manage_options', 'est-about', array($this,'est_about') );
	        add_submenu_page( 'est-tabs-list', 'How to use', 'How to use', 'manage_options', 'est_how_to_use', array($this,'est_how_to_use') );
		}

		/**
		* Landing Page For Main Menu
		*/
		function est_mainpage(){
			include(EST_PLUGIN_ROOT_DIR.'inc/backend/main-page.php');
		}

		/**
		*  Display Tab Settings and Layout Settings
		*/
		function est_main_settings(){
			include(EST_PLUGIN_ROOT_DIR.'inc/backend/main-settings.php');
		}

		/**
         * Tab Listing Page Display
         * @since 1.0.0
         */
		function est_show_tabs_list(){
			include(EST_PLUGIN_ROOT_DIR.'inc/backend/all-tabs-listing.php');	
		}

		/**
         * Save Tab Settings and Layout Settings
         * @since 1.0.0
         */
		function est_settings_action(){
			if(current_user_can('manage_options')){
					include(EST_PLUGIN_ROOT_DIR. 'inc/backend/save-settings.php');
			}
				
		}

		/**
         * Sanitizes Multi-Dimensional Array
         * @param array $array
         * @param array $sanitize_rule
         * @return array
         *
         * @since 1.0.0
         */
        static function sanitize_array($array = array(), $sanitize_rule = array()) {
            if (!is_array($array) || count($array) == 0) {
                return array();
            }

            foreach ($array as $k => $v) {
                if (!is_array($v)) {
                    $default_sanitize_rule = (is_numeric($k)) ? 'html' : 'text';
                    $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
                    $array[$k] = self:: sanitize_value($v, $sanitize_type);
                }

                if (is_array($v)) {
                    $array[$k] = self:: sanitize_array($v, $sanitize_rule);
                }
            }

            return $array;
        }

        /**
         * Sanitizes Value
         *
         * @param type $value
         * @param type $sanitize_type
         * @return string
         *
         * @since 1.0.0
         */
        static function sanitize_value($value = '', $sanitize_type = 'html') {
            switch ($sanitize_type) {
                case 'text':
                    $allowed_html = wp_kses_allowed_html('post');
                    // var_dump($allowed_html);
                    $allowed_html['iframe'] = array(
												'class'=>1,
												'height'=>1,
												'width'=>1,
												'style'=>1,
												'id'=>1,
												'type'=>1,
												'src'=>1,
												'frameborder'=>1,
												'allowfullscreen'=>1,
												'allow'=>1,
												'data-src'=>1,
												'webkitallowfullscreen'=>1,
												'mozallowfullscreen'=>1,
												'scrolling' => true,
												'marginwidth' => true,
    											'marginheight' => true,
    											'name' => true,
    											'align' => true,
												);
                    return wp_kses($value, $allowed_html);
                    break;
                default:
                    return sanitize_text_field($value);
                    break;
            }
        }

        /**
         * Save Tabs General Settings
         * @since 1.0.0
         */
        function est_general_settings_save(){
        	
        	if(current_user_can('manage_options')){
	        	include(EST_PLUGIN_ROOT_DIR. 'inc/backend/save-general-settings.php');
	        }
        }

        /**
         * Display Frontend 
         * @since 1.0.0
         */
        function est_display_front(){
			include(EST_PLUGIN_ROOT_DIR."inc/frontend/frontend-element.php");				
        }

        /**
         * About Page 
         * @since 1.0.0
         */
        function est_about()
        {
        	include(EST_PLUGIN_ROOT_DIR."inc/backend/about.php");
        }

        /**
         * Load How to use page
         * @since 1.0.0
         */
        function est_how_to_use()
        {
        	include(EST_PLUGIN_ROOT_DIR."inc/backend/how-to-use.php");
        }

        /**
         * Restore the default settings for the tab
         * @since 1.0.0
         */
        function est_restore_default()
        {
        	if(current_user_can('manage_options')){
	            include_once (EST_PLUGIN_ROOT_DIR.'inc/backend/restore-default-settings.php');
	        }
        }
		
	}

	$obj = new EST_Class();
}