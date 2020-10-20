<?php
/**
 * Colors Customizer panel
 *
 * @package Elfie
 */



$elfie_colors = elfie_default_colors();

Elfie_Kirki::add_panel( 'elfie_panel_colors', array(
    'priority'    => 10,
    'title'       => __( 'Colors', 'elfie' ),
) );


//Accent color
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'accent_color',
	'label'       => esc_html__( 'Accent color', 'elfie' ),
	'section'     => 'colors',
	'default'     => $elfie_colors['accent_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.widget_search .search-form::after,.elfie_recent_entries li::before,.tagcloud a:hover,.tags-links a:hover,.navigation.pagination .page-numbers:hover, .navigation.pagination .page-numbers.current,button, input[type="button"], input[type="reset"], input[type="submit"], .wp-block-button__link, .wp-block-file .wp-block-file__button,button:active, button:focus,input[type="button"]:active,input[type="button"]:focus,input[type="reset"]:active,input[type="reset"]:focus,input[type="submit"]:active,input[type="submit"]:focus,.wp-block-button__link:active,.wp-block-button__link:focus,.wp-block-file .wp-block-file__button:active,.wp-block-file .wp-block-file__button:focus',
			'property' => 'background-color',
		),
		array(
			'element'  => '.hero-slider .entry-meta a:hover,.comments-area .comment-reply-link,.widget a:hover,a,a:hover, a:focus, a:active,.main-navigation a:hover,blockquote::before,.is-style-outline button,.is-style-outline input[type="button"],.is-style-outline input[type="reset"],.is-style-outline input[type="submit"],.is-style-outline .wp-block-button__link,.is-style-outline .wp-block-file .wp-block-file__button',
			'property' => 'color',
		),
		array(
			'element'  => '.navigation.pagination .page-numbers:hover, .navigation.pagination .page-numbers.current',
			'property' => 'border-color',
		),				
	),	
) );

//Body
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'body_text_color',
	'label'       => esc_html__( 'Body text', 'elfie' ),
	'section'     => 'colors',
	'default'     => $elfie_colors['body_text_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => 'body',
			'property' => 'color',
		),
	),	
) );

/**
 * Header
 */
Elfie_Kirki::add_section( 'elfie_section_header_colors', array(
    'title'       	 => __( 'Header', 'elfie' ),
    'panel'          => 'elfie_panel_colors',
    'priority'       => 12,
) );
//Site title
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'site_title_color',
	'label'       => esc_html__( 'Site title', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['site_title_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-title a',
			'property' => 'color',
		),
	),	
) );

//Site desc
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'site_description_color',
	'label'       => esc_html__( 'Site description', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['site_description_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-description',
			'property' => 'color',
		),
	),	
) );

//Menu bar
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'menu_bar_color',
	'label'       => esc_html__( 'Menu bar', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['menu_bar_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-header:not(.menu-top)',
			'property' => 'background-color',
		),
	),	
	'required'  => array(
		array(
			'setting'  => 'menu_layout',
			'value'    => 'top',
			'operator' => '!=',
		),
	)		
) );

//Menu bar for top menu option
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'menu_bar_top_color',
	'label'       => esc_html__( 'Menu bar - top', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['menu_bar_top_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.menu-bar-top',
			'property' => 'background-color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'menu_layout',
			'value'    => 'top',
			'operator' => '==',
		),
	)		
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'menu_bar_bottom_color',
	'label'       => esc_html__( 'Menu bar - bottom', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['menu_bar_bottom_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.menu-bar-bottom',
			'property' => 'background-color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'menu_layout',
			'value'    => 'top',
			'operator' => '==',
		),
	)		
) );

//Menu items
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'menu_items_color',
	'label'       => esc_html__( 'Menu items', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['menu_items_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.main-navigation a, .main-navigation a:active',
			'property' => 'color',
		),
	),	
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'menu_items_color_hover',
	'label'       => esc_html__( 'Menu items (hover)', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['menu_items_color_hover'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.main-navigation a:hover, .main-navigation ul ul a:hover, .main-navigation a:active, .header-social div a:hover',
			'property' => 'color',
		),
	),	
) );

//Top bar
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'top_bar_color',
	'label'       => esc_html__( 'Top bar', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['top_bar_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.top-bar',
			'property' => 'background-color',
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'top_menu_items_color',
	'label'       => esc_html__( 'Top bar menu items', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['top_menu_items_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.top-bar #top-menu li a, .header-social div a',
			'property' => 'color',
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'top_menu_items_color_hover',
	'label'       => esc_html__( 'Top bar menu items (hover)', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['top_menu_items_color_hover'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.top-bar #top-menu li a:hover, .header-social div a:hover',
			'property' => 'color',
		),
	),	
) );


//Submenu background
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'submenu_background_color',
	'label'       => esc_html__( 'Submenu background', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['submenu_background_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.main-navigation ul ul li',
			'property' => 'background-color',
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'submenu_items_color',
	'label'       => esc_html__( 'Submenu items', 'elfie' ),
	'section'     => 'elfie_section_header_colors',
	'default'     => $elfie_colors['submenu_items_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.main-navigation ul ul li a',
			'property' => 'color',
		),
	),	
) );

/**
 * Footer
 */
Elfie_Kirki::add_section( 'elfie_section_footer_colors', array(
    'title'       	 => __( 'Footer', 'elfie' ),
    'panel'          => 'elfie_panel_colors',
    'priority'       => 12,
) );
//Footer widgets
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'footer_background_color',
	'label'       => esc_html__( 'Footer widgets background', 'elfie' ),
	'section'     => 'elfie_section_footer_colors',
	'default'     => $elfie_colors['footer_background_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer',
			'property' => 'background-color',
		),
	),	
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'footer_widgets_title_color',
	'label'       => esc_html__( 'Footer widgets title color', 'elfie' ),
	'section'     => 'elfie_section_footer_colors',
	'default'     => $elfie_colors['footer_widgets_title_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer .widget-title',
			'property' => 'color',
		),
	),	
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'footer_color',
	'label'       => esc_html__( 'Footer widgets color', 'elfie' ),
	'section'     => 'elfie_section_footer_colors',
	'default'     => $elfie_colors['footer_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer',
			'property' => 'color',
		),
	),	
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'footer_links_color',
	'label'       => esc_html__( 'Footer widget links color', 'elfie' ),
	'section'     => 'elfie_section_footer_colors',
	'default'     => $elfie_colors['footer_links_color'],
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer a',
			'property' => 'color',
		),
	),	
) );