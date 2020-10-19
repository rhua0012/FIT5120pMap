<?php
/**
 * Fonts Customizer panel
 *
 * @package Elfie
 */


/**
 * Fonts
 */

Elfie_Kirki::add_panel( 'elfie_panel_typography', array(
    'priority'    => 10,
	'title'       => __( 'Typography', 'elfie' ),
) );


/**
 * Families
 */
Elfie_Kirki::add_section( 'elfie_section_typography_families', array(
	'title'       	 => esc_html__( 'Font families', 'elfie' ),
    'panel'          => 'elfie_panel_typography',
    'priority'       => 12,
) );

//Body family
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'body_font',
	'label'       => esc_html__( 'Body', 'elfie' ),
	'section'     => 'elfie_section_typography_families',
	'default'     => array(
		'font-family'    => 'Karla',
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'body,#order_review_heading, #customer_details h3, .cart-collaterals h2, .single-product section > h2, .woocommerce-tabs h2, .widget .widget-title',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'700',
		),
	),		
) );


//Headings family
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'headings_font',
	'label'       => esc_html__( 'Headings', 'elfie' ),
	'section'     => 'elfie_section_typography_families',
	'default'     => array(
		'font-family'    => 'Playfair Display',
		'variant'		 => '400',		
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,.site-title',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'700',
		),
	),	
) );

/**
 * Sizes
 */
Elfie_Kirki::add_section( 'elfie_section_typography_sizes', array(
	'title'       	 => esc_html__( 'Sizes', 'elfie' ),
    'panel'          => 'elfie_panel_typography',
    'priority'       => 12,
) );

//Site title
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'typography_site_title',
	'label'       => esc_html__( 'Site title, H1 headings', 'elfie' ),
	'section'     => 'elfie_section_typography_sizes',
	'default'     => array(
		'text-transform' => 'none',
		'letter-spacing' => '0px',
		'line-height'    => '1.2',
		'font-size'      => '40px',
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.site-title',
			'media_query' => '@media (min-width: 1024px)',
		),
	),
) );

//Site description
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'typography_site_description',
	'label'       => esc_html__( 'Site description', 'elfie' ),
	'section'     => 'elfie_section_typography_sizes',
	'default'     => array(
		'text-transform' => 'none',
		'letter-spacing' => '0px',
		'line-height'    => '1.8',
		'font-size'      => '16px',
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.site-description',
		),
	),
) );

//Menu
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'typography_menu_items',
	'label'       => esc_html__( 'Menu items', 'elfie' ),
	'section'     => 'elfie_section_typography_sizes',
	'default'     => array(
		'text-transform' => 'none',
		'letter-spacing' => '0px',
		'line-height'    => '1.8',
		'font-size'      => '14px',
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.main-navigation li',
		),
	),
) );

//Blog index post titles
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'typography_index_post_titles',
	'label'       => esc_html__( 'Large archive post titles, H2 headings', 'elfie' ),
	'section'     => 'elfie_section_typography_sizes',
	'default'     => array(
		'text-transform' => 'initial',
		'letter-spacing' => '0px',
		'line-height'    => '1.2',
		'font-size'      => '32px',
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.posts-loop .entry-title, h2',
			'media_query' => '@media (min-width: 1024px)',
		),
	),
) );

//Blog index post titles
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'typography_index_small_post_titles',
	'label'       => esc_html__( 'Small archive post titles', 'elfie' ),
	'section'     => 'elfie_section_typography_sizes',
	'default'     => array(
		'text-transform' => 'initial',
		'letter-spacing' => '0px',
		'line-height'    => '1.2',
		'font-size'      => '24px',
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.content-list .entry-header .entry-title, .layout-3cols .posts-loop .entry-title, .layout-2cols-sb .posts-loop .entry-title',
			'media_query' => '@media (min-width: 1024px)',
		),
	),
) );

//Single post titles
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'typography_single_post_titles',
	'label'       => esc_html__( 'Single post titles', 'elfie' ),
	'section'     => 'elfie_section_typography_sizes',
	'default'     => array(
		'text-transform' => 'none',
		'letter-spacing' => '0px',
		'line-height'    => '1.2',
		'font-size'      => '32px',
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.single .entry-title',
			'media_query' => '@media (min-width: 1024px)',
		),
	),
) );

//Body
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'typography',
	'settings'    => 'typography_body',
	'label'       => esc_html__( 'Body', 'elfie' ),
	'section'     => 'elfie_section_typography_sizes',
	'default'     => array(
		'text-transform' => 'none',
		'letter-spacing' => '0px',
		'line-height'    => '1.8',
		'font-size'      => '16px',
	),
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) ); 