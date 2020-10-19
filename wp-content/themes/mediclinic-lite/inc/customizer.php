<?php    
/**
 *mediclinic-lite Theme Customizer
 *
 * @package Mediclinic Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mediclinic_lite_customize_register( $wp_customize ) {	
	
	function mediclinic_lite_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function mediclinic_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	} 
	
	function mediclinic_lite_sanitize_phone_number( $phone ) {
		// sanitize phone
		return preg_replace( '/[^\d+]/', '', $phone );
	} 
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	 //Panel for section & control
	$wp_customize->add_panel( 'mediclinic_lite_panel_section', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options Panel', 'mediclinic-lite' ),		
	) );
	
	//Site Layout Options
	$wp_customize->add_section('mediclinic_lite_layout_sections',array(
		'title' => __('Site Layout Options','mediclinic-lite'),			
		'priority' => 1,
		'panel' => 	'mediclinic_lite_panel_section',          
	));		
	
	$wp_customize->add_setting('mediclinic_lite_boxlayoutoptions',array(
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'mediclinic_lite_boxlayoutoptions', array(
    	'section'   => 'mediclinic_lite_layout_sections',    	 
		'label' => __('Check to Show Box Layout','mediclinic-lite'),
		'description' => __('If you want to show box layout please check the Box Layout Option.','mediclinic-lite'),
    	'type'      => 'checkbox'
     )); //Site Layout Options 
	
	$wp_customize->add_setting('mediclinic_lite_template_coloroptions',array(
		'default' => '#28a1df',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'mediclinic_lite_template_coloroptions',array(
			'label' => __('Color Options','mediclinic-lite'),			
			'description' => __('More color options available in PRO Version','mediclinic-lite'),
			'section' => 'colors',
			'settings' => 'mediclinic_lite_template_coloroptions'
		))
	);
	
	//Top Contact info section
	$wp_customize->add_section('mediclinic_lite_topcontact_sections',array(
		'title' => __('Top Contact Section','mediclinic-lite'),				
		'priority' => null,
		'panel' => 	'mediclinic_lite_panel_section',
	));		
	
	
	$wp_customize->add_setting('mediclinic_lite_toptelephone',array(
		'default' => null,
		'sanitize_callback' => 'mediclinic_lite_sanitize_phone_number'	
	));
	
	$wp_customize->add_control('mediclinic_lite_toptelephone',array(	
		'type' => 'text',
		'label' => __('enter phone number here','mediclinic-lite'),
		'section' => 'mediclinic_lite_topcontact_sections',
		'setting' => 'mediclinic_lite_toptelephone'
	));	
	
	$wp_customize->add_setting('mediclinic_lite_topemailinfo',array(
		'sanitize_callback' => 'sanitize_email'
	));
	
	$wp_customize->add_control('mediclinic_lite_topemailinfo',array(
		'type' => 'email',
		'label' => __('enter email id here.','mediclinic-lite'),
		'section' => 'mediclinic_lite_topcontact_sections'
	));		
		
	
	$wp_customize->add_setting('mediclinic_lite_show_topinfo_sections',array(
		'default' => false,
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'mediclinic_lite_show_topinfo_sections', array(
	   'settings' => 'mediclinic_lite_show_topinfo_sections',
	   'section'   => 'mediclinic_lite_topcontact_sections',
	   'label'     => __('Check To show This Section','mediclinic-lite'),
	   'type'      => 'checkbox'
	 ));//Show Top Contact section
	 
	 
	 //Top Social icons
	$wp_customize->add_section('mediclinic_lite_topsocial_icons_sections',array(
		'title' => __('Header social Sections','mediclinic-lite'),
		'description' => __( 'Add social icons link here to display icons in header.', 'mediclinic-lite' ),			
		'priority' => null,
		'panel' => 	'mediclinic_lite_panel_section', 
	));
	
	$wp_customize->add_setting('mediclinic_lite_facebook_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'	
	));
	
	$wp_customize->add_control('mediclinic_lite_facebook_link',array(
		'label' => __('Add facebook link here','mediclinic-lite'),
		'section' => 'mediclinic_lite_topsocial_icons_sections',
		'setting' => 'mediclinic_lite_facebook_link'
	));	
	
	$wp_customize->add_setting('mediclinic_lite_twitter_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('mediclinic_lite_twitter_link',array(
		'label' => __('Add twitter link here','mediclinic-lite'),
		'section' => 'mediclinic_lite_topsocial_icons_sections',
		'setting' => 'mediclinic_lite_twitter_link'
	));
	
	$wp_customize->add_setting('mediclinic_lite_googleplus_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('mediclinic_lite_googleplus_link',array(
		'label' => __('Add google plus link here','mediclinic-lite'),
		'section' => 'mediclinic_lite_topsocial_icons_sections',
		'setting' => 'mediclinic_lite_googleplus_link'
	));
	
	$wp_customize->add_setting('mediclinic_lite_linkedin_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('mediclinic_lite_linkedin_link',array(
		'label' => __('Add linkedin link here','mediclinic-lite'),
		'section' => 'mediclinic_lite_topsocial_icons_sections',
		'setting' => 'mediclinic_lite_linkedin_link'
	));
	
	$wp_customize->add_setting('mediclinic_lite_instagram_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('mediclinic_lite_instagram_link',array(
		'label' => __('Add instagram link here','mediclinic-lite'),
		'section' => 'mediclinic_lite_topsocial_icons_sections',
		'setting' => 'mediclinic_lite_instagram_link'
	));
	
	$wp_customize->add_setting('mediclinic_lite_show_topsocial_icons_sections',array(
		'default' => false,
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'mediclinic_lite_show_topsocial_icons_sections', array(
	   'settings' => 'mediclinic_lite_show_topsocial_icons_sections',
	   'section'   => 'mediclinic_lite_topsocial_icons_sections',
	   'label'     => __('Check To show This Section','mediclinic-lite'),
	   'type'      => 'checkbox'
	 ));//Show Header Social icons area
	 
	 
	 //Get Appointment Button
	$wp_customize->add_section('mediclinic_lite_appointment_button_sections',array(
		'title' => __('Get an Appointment Button','mediclinic-lite'),
		'description' => __( 'Add link here to display get an appointment button in header.', 'mediclinic-lite' ),			
		'priority' => null,
		'panel' => 	'mediclinic_lite_panel_section', 
	));	
	
	
	$wp_customize->add_setting('mediclinic_lite_getanappointmentbtn',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('mediclinic_lite_getanappointmentbtn',array(	
		'type' => 'text',
		'label' => __('enter slider Read more button name here','mediclinic-lite'),
		'section' => 'mediclinic_lite_appointment_button_sections',
		'setting' => 'mediclinic_lite_getanappointmentbtn'
	)); // get anappointment button text
	
	
	$wp_customize->add_setting('mediclinic_lite_appointment_link',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('mediclinic_lite_appointment_link',array(
		'label' => __('Add button link here','mediclinic-lite'),
		'section' => 'mediclinic_lite_appointment_button_sections',
		'setting' => 'mediclinic_lite_appointment_link'
	));
	
	$wp_customize->add_setting('mediclinic_lite_show_appointmentbtn_sections',array(
		'default' => false,
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'mediclinic_lite_show_appointmentbtn_sections', array(
	   'settings' => 'mediclinic_lite_show_appointmentbtn_sections',
	   'section'   => 'mediclinic_lite_appointment_button_sections',
	   'label'     => __('Check To show This Section','mediclinic-lite'),
	   'type'      => 'checkbox'
	 ));//Show Get Appointment Button
	
	
	// Front Slider Section		
	$wp_customize->add_section( 'mediclinic_lite_frontpageslider_section', array(
		'title' => __('Frontpage Slider Sections', 'mediclinic-lite'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 745 pixel.','mediclinic-lite'), 
		'panel' => 	'mediclinic_lite_panel_section',           			
    ));
	
	$wp_customize->add_setting('mediclinic_lite_frontslide1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'mediclinic_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('mediclinic_lite_frontslide1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 1:','mediclinic-lite'),
		'section' => 'mediclinic_lite_frontpageslider_section'
	));	
	
	$wp_customize->add_setting('mediclinic_lite_frontslide2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'mediclinic_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('mediclinic_lite_frontslide2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 2:','mediclinic-lite'),
		'section' => 'mediclinic_lite_frontpageslider_section'
	));	
	
	$wp_customize->add_setting('mediclinic_lite_frontslide3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'mediclinic_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('mediclinic_lite_frontslide3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slider 3:','mediclinic-lite'),
		'section' => 'mediclinic_lite_frontpageslider_section'
	));	// Homepage Slider Section
	
	$wp_customize->add_setting('mediclinic_lite_frontslidebutton',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('mediclinic_lite_frontslidebutton',array(	
		'type' => 'text',
		'label' => __('enter slider Read more button name here','mediclinic-lite'),
		'section' => 'mediclinic_lite_frontpageslider_section',
		'setting' => 'mediclinic_lite_frontslidebutton'
	)); // Home Slider Read More Button Text
	
	$wp_customize->add_setting('mediclinic_lite_show_frontpageslider_section',array(
		'default' => false,
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'mediclinic_lite_show_frontpageslider_section', array(
	    'settings' => 'mediclinic_lite_show_frontpageslider_section',
	    'section'   => 'mediclinic_lite_frontpageslider_section',
	     'label'     => __('Check To Show This Section','mediclinic-lite'),
	   'type'      => 'checkbox'
	 ));//Show Frontpage Slider Section	
	 
	 
	 //Three column Services Section
	$wp_customize->add_section('mediclinic_lite_threecolumn_services_sections', array(
		'title' => __('Three column Services Section','mediclinic-lite'),
		'description' => __('Select pages from the dropdown for 3 column services sections','mediclinic-lite'),
		'priority' => null,
		'panel' => 	'mediclinic_lite_panel_section',          
	));	
	
	
	$wp_customize->add_setting('mediclinic_lite_threecol_pgebx1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'mediclinic_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'mediclinic_lite_threecol_pgebx1',array(
		'type' => 'dropdown-pages',			
		'section' => 'mediclinic_lite_threecolumn_services_sections',
	));		
	
	$wp_customize->add_setting('mediclinic_lite_threecol_pgebx2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'mediclinic_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'mediclinic_lite_threecol_pgebx2',array(
		'type' => 'dropdown-pages',			
		'section' => 'mediclinic_lite_threecolumn_services_sections',
	));
	
	$wp_customize->add_setting('mediclinic_lite_threecol_pgebx3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'mediclinic_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'mediclinic_lite_threecol_pgebx3',array(
		'type' => 'dropdown-pages',			
		'section' => 'mediclinic_lite_threecolumn_services_sections',
	));	
	
	
	$wp_customize->add_setting('mediclinic_lite_show_threecolumn_services_sections',array(
		'default' => false,
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'mediclinic_lite_show_threecolumn_services_sections', array(
	   'settings' => 'mediclinic_lite_show_threecolumn_services_sections',
	   'section'   => 'mediclinic_lite_threecolumn_services_sections',
	   'label'     => __('Check To Show This Section','mediclinic-lite'),
	   'type'      => 'checkbox'
	 ));//Show Three column Services Section
	 
	 
	//Sidebar Settings
	$wp_customize->add_section('mediclinic_lite_sidebar_options', array(
		'title' => __('Sidebar Options','mediclinic-lite'),		
		'priority' => null,
		'panel' => 	'mediclinic_lite_panel_section',          
	));	
	
	$wp_customize->add_setting('mediclinic_lite_hidesidebar_from_homepage',array(
		'default' => false,
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'mediclinic_lite_hidesidebar_from_homepage', array(
	   'settings' => 'mediclinic_lite_hidesidebar_from_homepage',
	   'section'   => 'mediclinic_lite_sidebar_options',
	   'label'     => __('Check to hide sidebar from latest post page','mediclinic-lite'),
	   'type'      => 'checkbox'
	 ));// Hide sidebar from latest post page
	 
	 
	 $wp_customize->add_setting('mediclinic_lite_hidesidebar_singlepost',array(
		'default' => false,
		'sanitize_callback' => 'mediclinic_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'mediclinic_lite_hidesidebar_singlepost', array(
	   'settings' => 'mediclinic_lite_hidesidebar_singlepost',
	   'section'   => 'mediclinic_lite_sidebar_options',
	   'label'     => __('Check to hide sidebar from single post','mediclinic-lite'),
	   'type'      => 'checkbox'
	 ));// hide sidebar single post	 

		 
}
add_action( 'customize_register', 'mediclinic_lite_customize_register' );

function mediclinic_lite_custom_css(){ 
?>
	<style type="text/css"> 					
        a, .listview_blogstyle h2 a:hover,
        #sidebar ul li a:hover,						
        .listview_blogstyle h3 a:hover,		
        .postmeta a:hover,
		.site-navigation .menu a:hover,
		.site-navigation .menu a:focus,
		.site-navigation .menu ul a:hover,
		.site-navigation .menu ul a:focus,
		.site-navigation ul li a:hover, 
		.site-navigation ul li.current-menu-item a,
		.site-navigation ul li.current-menu-parent a.parent,
		.site-navigation ul li.current-menu-item ul.sub-menu li a:hover, 			
        .button:hover,
		.nivo-caption h2 span,
		h2.services_title span,
		.threecolumn_servicesbox:hover h3 a,		
		.blog_postmeta a:hover,		
		.site-footer ul li a:hover, 
		.site-footer ul li.current_page_item a		
            { color:<?php echo esc_html( get_theme_mod('mediclinic_lite_template_coloroptions','#28a1df')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,		
        .nivo-controlNav a.active,
		.sd-search input, .sd-top-bar-nav .sd-search input,			
		a.blogreadmore,			
		.nivo-caption .slide_morebtn,
		.learnmore:hover,		
		.copyrigh-wrapper:before,
		.infobox a.get_an_enquiry:hover,									
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,		
		.blogreadbtn,
		a.getanappointment,		
        .toggle a	
            { background-color:<?php echo esc_html( get_theme_mod('mediclinic_lite_template_coloroptions','#28a1df')); ?>;}
			
		
		.tagcloud a:hover,		
		.topsocial_icons a:hover,
		.site-footer h5::after,		
		h3.widget-title::after
            { border-color:<?php echo esc_html( get_theme_mod('mediclinic_lite_template_coloroptions','#28a1df')); ?>;}
			
		
		#sidebar .widget > ul li:first-child, 
		#sidebar .widget > ul li:hover, 
		#sidebar .widget .menu-footer-menu-container ul li:hover, 
		#sidebar .widget .menu-footer-menu-container ul li:first-child
            { border-left:4px solid <?php echo esc_html( get_theme_mod('mediclinic_lite_template_coloroptions','#28a1df')); ?>;}	
			
		 button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus,
		#templatelayout a:focus
            { outline:thin dotted <?php echo esc_html( get_theme_mod('mediclinic_lite_template_coloroptions','#28a1df')); ?>;}				
	
    </style> 
<?php                                                                               
}
         
add_action('wp_head','mediclinic_lite_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mediclinic_lite_customize_preview_js() {
	wp_enqueue_script( 'mediclinic_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '19062019', true );
}
add_action( 'customize_preview_init', 'mediclinic_lite_customize_preview_js' );