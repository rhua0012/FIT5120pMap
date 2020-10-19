<?php
/**
 * Blog related Customizer options
 * Built for Kirki
 */

Elfie_Kirki::add_panel( 'elfie_panel_blog', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Blog options', 'elfie' ),
) );

//Blog index
Elfie_Kirki::add_section( 'elfie_section_blog_index', array(
    'title'       	 => esc_html__( 'Index and archives', 'elfie' ),
    'panel'          => 'elfie_panel_blog',
    'priority'       => 12,
) );


Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'radio',
	'settings'    => 'blog_layout',
	'label'       => __( 'Blog layout', 'elfie' ),
	'section'     => 'elfie_section_blog_index',
	'default'     => 'layout-mixed',
	'choices'     => array(
		'layout-mixed' 			=> esc_html__( 'Mixed - Large post then list', 'elfie' ),
		'layout-classic' 		=> esc_html__( 'Classic', 'elfie' ),
		'layout-3cols'			=> esc_html__( 'Grid - 3 columns', 'elfie' ),
		'layout-2cols-sb' 		=> esc_html__( 'Grid - 2 columns and sidebar', 'elfie' ),
	),
	'priority'    => 10,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'show_full_content',
	'label'       => esc_html__( 'Show full post content?', 'elfie' ),
	'section'     => 'elfie_section_blog_index',
	'default'     => '',
	'priority'    => 10,	
	'active_callback'  => array(
		array(
			'setting'  => 'blog_layout',
			'operator' => '===',
			'value'    => 'layout-classic',
		),
	)	
) );

//Post elements
Elfie_Kirki::add_field( 'elfie', [
	'type'        => 'sortable',
	'settings'    => 'post_item_elements',
	'label'       => esc_html__( 'Post elements', 'elfie' ),
	'description' => esc_html__( 'Drag and drop to rearrange. Click the eye icon to enable/disable', 'elfie' ),
	'section'     => 'elfie_section_blog_index',
	'default'     => array( 'loop_category', 'loop_post_title', 'loop_post_meta', 'loop_image', 'loop_post_excerpt' ),
	'choices'     => array(
		'loop_category' 	=> esc_html__( 'Category', 'elfie' ),
		'loop_post_title' 	=> esc_html__( 'Post title', 'elfie' ),
		'loop_post_meta' 	=> esc_html__( 'Author&amp;date', 'elfie' ),
		'loop_image' 		=> esc_html__( 'Featured image', 'elfie' ),
		'loop_post_excerpt' => esc_html__( 'Excerpt', 'elfie' ),
	),
	'priority'    => 10,	
] );

Elfie_Kirki::add_field( 'elfie', [
	'type'        => 'number',
	'settings'    => 'excerpt_length',
	'label'       => esc_html__( 'Excerpt length', 'elfie' ),
	'section'     => 'elfie_section_blog_index',
	'default'     => 15,
	'choices'     => [
		'min'  => 0,
		'max'  => 120,
		'step' => 1,
	],
] );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'text',
	'settings'    => 'read_more_text',
	'label'       => esc_html__( 'Continue reading text', 'elfie' ),
	'section'  	  => 'elfie_section_blog_index',
	'default'     => esc_html__( 'Continue reading', 'elfie' ),
	'priority'    => 10,
) );

//Single posts
Elfie_Kirki::add_section( 'elfie_section_blog_singles', array(
    'title'       	 => esc_html__( 'Single posts', 'elfie' ),
    'panel'          => 'elfie_panel_blog',
    'priority'       => 12,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'select',
	'settings'    => 'post_layout',
	'label'       => esc_html__( 'Posts layout', 'elfie' ),
	'description' => esc_html__( 'Layout type for all your single posts. Please note: you can change the layout individually for each post by editing the post you want.', 'elfie' ),
	'section'     => 'elfie_section_blog_singles',
	'default'     => 'layout-default',
	'choices'     => array(
		'layout-default' 			=> esc_html__( 'Style 1 (default)', 'elfie' ),
		'layout-featuredbanner'		=> esc_html__( 'Style 2 (featured banner)', 'elfie' ),
		'layout-featuredbanner2'	=> esc_html__( 'Style 3 (featured banner with post title)', 'elfie' ),
	),
	'priority'    => 10,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'disable_single_sidebar',
	'label'       => esc_html__( 'Disable sidebar on single posts?', 'elfie' ),
	'section'     => 'elfie_section_blog_singles',
	'default'     => '',
	'priority'    => 10,	
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'hide_post_cats',
	'label'       => esc_html__( 'Hide categories?', 'elfie' ),
	'section'     => 'elfie_section_blog_singles',
	'default'     => '',
	'priority'    => 10,
	'transport'	=> 'auto',
	'output' => array(
		array(
			'element'       => '.single-post .post-cats',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),
	),		
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'hide_post_date',
	'label'       => esc_html__( 'Hide date?', 'elfie' ),
	'section'     => 'elfie_section_blog_singles',
	'default'     => '',
	'priority'    => 10,
	'transport'	=> 'auto',
	'output' => array(
		array(
			'element'       => '.single-post .posted-on',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),
		array(
			'element'       => '.single-post .byline',
			'property'      => 'margin-right',
			'value_pattern' => '0',
			'exclude'       => array( false ),
		),			
		array(
			'element'       => '.single-post .byline:after',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),		
	),		
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'hide_post_author',
	'label'       => esc_html__( 'Hide author?', 'elfie' ),
	'section'     => 'elfie_section_blog_singles',
	'default'     => '',
	'priority'    => 10,
	'transport'	=> 'auto',
	'output' => array(
		array(
			'element'       => '.single-post .byline',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),
		array(
			'element'       => '.single-post .byline:after',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		),
	),		
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'hide_post_tags',
	'label'       => esc_html__( 'Hide tags?', 'elfie' ),
	'section'     => 'elfie_section_blog_singles',
	'default'     => '',
	'priority'    => 10,
	'transport'	=> 'auto',
	'output' => array(
		array(
			'element'       => '.single-post .entry-footer',
			'property'      => 'display',
			'value_pattern' => 'none',
			'exclude'       => array( false ),
		)	
	),		
) );