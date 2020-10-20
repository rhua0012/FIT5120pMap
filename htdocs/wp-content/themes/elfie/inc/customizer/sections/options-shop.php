<?php
/**
 * Shop related Customizer options
 * Built for Kirki
 */



Elfie_Kirki::add_section( 'elfie_section_shop_archives', array(
    'title'       	 => esc_html__( 'Elfie: Shop archives', 'elfie' ),
    'panel'          => 'woocommerce',
    'priority'       => 21,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'select',
	'settings'    => 'shop_sidebar',
	'label'       => __( 'Shop archives sidebar', 'elfie' ),
	'section'     => 'elfie_section_shop_archives',
	'default'     => 'no-sidebar',
	'choices'     => array(
		'no-sidebar' 			=> esc_html__( 'No sidebar', 'elfie' ),
		'shop-sidebar-left' 	=> esc_html__( 'Left sidebar', 'elfie' ),
		'shop-sidebar-right'	=> esc_html__( 'Right sidebar', 'elfie' ),
	),
	'priority'    => 10,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'slider',
	'settings'    => 'products_number',
	'label'       => __( 'Products per page', 'elfie' ),
	'section'     => 'elfie_section_shop_archives',
	'default'     => 12,
	'choices'     => [
		'min'  => 0,
		'max'  => 22,
		'step' => 1,
	],
	'priority'    => 10,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'disable_shop_archive_price',
	'label'       => esc_html__( 'Hide price', 'elfie' ),
	'section'     => 'elfie_section_shop_archives',
	'default'     => '',
	'priority'    => 10,	
	'transport'	=> 'auto',
	'output' => array(
		array(
			'element'       => '.products .price',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),
	),		
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'disable_shop_archive_button',
	'label'       => esc_html__( 'Hide add to cart button', 'elfie' ),
	'section'     => 'elfie_section_shop_archives',
	'default'     => '',
	'priority'    => 10,	
	'transport'	=> 'auto',
	'output' => array(
		array(
			'element'       => '.products .button',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),
	),		
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'disable_shop_archive_title_center',
	'label'       => esc_html__( 'Center product contents', 'elfie' ),
	'section'     => 'elfie_section_shop_archives',
	'default'     => '',
	'priority'    => 10,	
	'transport'	=> 'auto',
	'output' => array(
		array(
			'element'       => '.products .product',
			'property'      => 'text-align',
			'value_pattern' => 'center',
			'exclude'       => array( false ),
		),
		array(
			'element'       => '.products li.product .price, .products li.product .button',
			'property'      => 'float',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),	
		array(
			'element'       => '.products li.product .price, .products li.product .button',
			'property'      => 'display',
			'value_pattern' => 'block',
			'exclude'       => array( false ),
		),	
		array(
			'element'       => '.products li.product .price, .products li.product .button',
			'property'      => 'padding',
			'value_pattern' => '0',
			'exclude'       => array( false ),
		),	
		array(
			'element'       => '.products li.product .star-rating',
			'property'      => 'margin',
			'value_pattern' => '-5px auto 10px',
			'exclude'       => array( false ),
		),					
	),		
) );