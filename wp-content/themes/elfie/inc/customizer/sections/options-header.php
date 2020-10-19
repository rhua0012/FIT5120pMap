<?php
/**
 * Header related Customizer options
 * Built for Kirki
 */

//Logo size
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'slider',
	'settings'    => 'logo_size',
	'label'       => esc_html__( 'Logo size', 'elfie' ),
	'section'  	  => 'title_tagline',
	'default'     => 120,
	'priority'    => 9,
	'choices'     => array(
		'min'  => '50',
		'max'  => '500',
		'step' => '1',
	),
	'transport' => 'auto',
	'output' => array(
		array(
			'element'  => '.custom-logo-link',
			'property' => 'max-width',
			'units'	   => 'px'
		),
	),	
) );

/* Header image */
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'radio',
	'settings'    => 'header_image_position',
	'label'       => esc_html__( 'Header image position', 'elfie' ),
	'section'  	  => 'header_image',
	'default'     => 'before_menu',
	'choices'     => array(
		'before_menu'  	=> esc_html__( 'Before menu', 'elfie' ),
		'after_menu'  	=> esc_html__( 'After menu', 'elfie' )
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'header_image_display',
	'label'       => esc_html__( 'Show the header image only on blog home?', 'elfie' ),
	'section'  	  => 'header_image',
	'default'     => 1,
	'priority'    => 10,
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'radio',
	'settings'    => 'header_image_container',
	'label'       => esc_html__( 'Container type', 'elfie' ),
	'section'  	  => 'header_image',
	'default'     => 'fullwidth',
	'choices'     => array(
		'container'  => esc_html__( 'Contained', 'elfie' ),
		'fullwidth'  => esc_html__( 'Full width', 'elfie' )
	),
) );

/* Header */
Elfie_Kirki::add_panel( 'elfie_panel_header', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Header options', 'elfie' ),
) );

//Menu bar
Elfie_Kirki::add_panel( 'elfie_panel_menu_bar', array(
    'priority'    => 10,
	'title'       => esc_html__( 'Menu bar', 'elfie' ),
	'panel'       => 'elfie_panel_header',
) );

Elfie_Kirki::add_section( 'elfie_section_menu_layout', array(
    'title'       	 => esc_html__( 'Layout', 'elfie' ),
	'panel'          => 'elfie_panel_menu_bar',
    'priority'       => 21,
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'select',
	'settings'    => 'menu_layout',
	'label'       => esc_html__( 'Menu layout', 'elfie' ),
	'section'  	  => 'elfie_section_menu_layout',
	'default'     => 'default',
	'choices'     => array(
		'default'  		=> esc_html__( 'Default', 'elfie' ),
		'centered'  	=> esc_html__( 'Centered', 'elfie' ),
		'top'  			=> esc_html__( 'Menu before', 'elfie' ),
	),	
) );

Elfie_Kirki::add_section( 'elfie_section_social', array(
    'title'       	 => esc_html__( 'Social', 'elfie' ),
    'panel'          => 'elfie_panel_header',
    'priority'       => 31,
) );
$elfie_socials = array( 
	'icon-facebook' 		=> 'Facebook',
	'icon-twitter'  		=> 'Twitter',
	'icon-linkedin'  		=> 'Linkedin',
	'icon-dribbble'  		=> 'Dribbble',
	'icon-gplus'  			=> 'Google Plus',
	'icon-xing' 			=> 'Xing',
	'icon-weibo' 			=> 'Weibo',
	'icon-vimeo-squared' 	=> 'Vimeo',
	'icon-youtube-play' 	=> 'YouTube',
	'icon-vkontakte'		=> 'VK',
	'icon-pinterest' 		=> 'Pinterest',
	'icon-instagram' 		=> 'Instagram',
	'icon-github-circled' 	=> 'GitHub',
	'icon-bandcamp' 		=> 'Bandcamp',
	'icon-behance' 			=> 'Behance',
	'icon-foursquare' 		=> 'Foursquare',
	'icon-reddit' 			=> 'Reddit',
	'icon-spotify' 			=> 'Spotify',
	'icon-soundcloud' 		=> 'Soundcloud',
);
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'show_social_menu',
	'label'       => esc_html__( 'Display your social profile?', 'elfie' ),
	'section'  	  => 'elfie_section_social',
	'default'     => 0,
	'priority'    => 10,
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'       		=> 'repeater',
	'settings'    		=> 'header_social',
	'label'       		=> esc_html__( 'Social links', 'elfie' ),
	'description'		=> esc_html__( 'Add as many links as you want. Drag and drop to rearrange', 'elfie' ),
	'section'     		=> 'elfie_section_social',
	'transport'   		=> 'refresh',
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_html__('Social network', 'elfie' ),
		'field' => 'icon',
	),
	'default'     => array(
		array(
			'icon'		=> 'icon-facebook',
			'link_url'  => 'https://facebook.com/yourprofile',
		),
	),
	'fields' => array(
		'icon' => array(
			'type'        => 'select',
			'label'       => esc_html__( 'Social network', 'elfie' ),
			'default'	  => 'icon-facebook',
			'choices'     => $elfie_socials,
		),
		'link_url' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Social profile link', 'elfie' ),
			'default'     => '',
		),
	),
) );

//Slider 
Elfie_Kirki::add_section( 'elfie_section_hero_area', array(
    'title'       	 => esc_html__( 'Carousel', 'elfie' ),
    'panel'          => 'elfie_panel_header',
    'priority'       => 10,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'show_slider',
	'label'       => esc_html__( 'Display the slider', 'elfie' ),
	'section'  	  => 'elfie_section_hero_area',
	'default'     => 1,
	'priority'    => 9,
) );

if ( class_exists( 'Kirki_Helper' ) ) {
	Elfie_Kirki::add_field( 'elfie', array(
		'type'     => 'select',
		'settings' => 'carousel_posts',
		'label'    		=> esc_html__( 'Carousel posts', 'elfie' ),
		'description'	=> esc_html__( 'Pick the posts you want to display in the carousel. You can also start typing to search the posts you want. Please note: if you do not pick any posts, the latest 6 posts will be displayed.', 'elfie' ),
		'section'  => 'elfie_section_hero_area',
		'default'  => '',
		'priority' => 10,
		'multiple' => 20,
		'choices'  => Kirki_Helper::get_posts(
			array(
				'posts_per_page' => -1,
				'post_type'      => 'post'
			)
		),			
	) );
}

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'exclude_carousel_posts',
	'label'       => esc_html__( 'Exclude carousel posts from posts list?', 'elfie' ),
	'description' => esc_html__( 'Switching this option on will prevent carousel posts from being duplicated in the posts list', 'elfie' ),
	'section'  => 'elfie_section_hero_area',
	'default'     => '0',
	'priority'    => 10,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'slider',
	'settings'    => 'autoplay_speed',
	'label'       => esc_html__( 'Autoplay speed', 'elfie' ),
	'section'  	  => 'elfie_section_hero_area',
	'default'     => 2000,
	'choices'     => array(
		'min'  => '0',
		'max'  => '8000',
		'step' => '500',
	),
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'select',
	'settings'    => 'slider_container',
	'label'       => esc_html__( 'Container type', 'elfie' ),
	'section'  	  => 'elfie_section_hero_area',
	'default'     => 'fullwidth',
	'choices'     => array(
		'container'  => esc_html__( 'Contained', 'elfie' ),
		'fullwidth'  => esc_html__( 'Full width', 'elfie' )
	),
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'select',
	'settings'    => 'carousel_layout',
	'label'       => esc_html__( 'Carousel layout', 'elfie' ),
	'section'  	  => 'elfie_section_hero_area',
	'default'     => 'columns1',
	'choices'     => array(
		'centermode'  	=> esc_html__( 'Center mode', 'elfie' ),
		'columns1'  	=> esc_html__( '1 Column', 'elfie' ),
		'columns2'  	=> esc_html__( '2 Columns', 'elfie' ),
		'columns3'  	=> esc_html__( '3 Columns', 'elfie' ),
		'columns4'  	=> esc_html__( '4 Columns', 'elfie' ),
	),	
) );

//Featured boxes
Elfie_Kirki::add_section( 'elfie_section_hot_topics', array(
    'title'       	 => esc_html__( 'Featured boxes', 'elfie' ),
    'panel'          => 'elfie_panel_header',
    'priority'       => 11,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'image',
	'settings'    => 'box_1_image',
	'label'       => esc_html__( 'Box 1 image', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,	
	'partial_refresh'    => array(
		'fb1i' => array(
			'selector'        => '.fb1',
			'render_callback' => 'elfie_featured_box_1',
			'container_inclusive' => true
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'text',
	'settings'    => 'box_1_text',
	'label'       => esc_html__( 'Box 1 text', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb1t' => array(
			'selector'        => '.fb1',
			'render_callback' => 'elfie_featured_box_1',
			'container_inclusive' => true
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'url',
	'settings'    => 'box_1_url',
	'label'       => esc_html__( 'Box 1 url', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb1u' => array(
			'selector'        => '.fb1',
			'render_callback' => 'elfie_featured_box_1',
			'container_inclusive' => true
		),
	),	
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'image',
	'settings'    => 'box_2_image',
	'label'       => esc_html__( 'Box 2 image', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb2i' => array(
			'selector'        => '.fb2',
			'render_callback' => 'elfie_featured_box_2',
			'container_inclusive' => true
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'text',
	'settings'    => 'box_2_text',
	'label'       => esc_html__( 'Box 2 text', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb2t' => array(
			'selector'        => '.fb2',
			'render_callback' => 'elfie_featured_box_2',
			'container_inclusive' => true
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'url',
	'settings'    => 'box_2_url',
	'label'       => esc_html__( 'Box 2 url', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb2u' => array(
			'selector'        => '.fb2',
			'render_callback' => 'elfie_featured_box_2',
			'container_inclusive' => true
		),
	),	
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'image',
	'settings'    => 'box_3_image',
	'label'       => esc_html__( 'Box 3 image', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb3i' => array(
			'selector'        => '.fb3',
			'render_callback' => 'elfie_featured_box_3',
			'container_inclusive' => true
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'text',
	'settings'    => 'box_3_text',
	'label'       => esc_html__( 'Box 3 text', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb3t' => array(
			'selector'        => '.fb3',
			'render_callback' => 'elfie_featured_box_3',
			'container_inclusive' => true
		),
	),		
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'url',
	'settings'    => 'box_3_url',
	'label'       => esc_html__( 'Box 3 url', 'elfie' ),
	'section'  => 'elfie_section_hot_topics',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'fb3u' => array(
			'selector'        => '.fb3',
			'render_callback' => 'elfie_featured_box_3',
			'container_inclusive' => true
		),
	),		
) );

Elfie_Kirki::add_section( 'elfie_section_subscribe', array(
    'title'       	 => esc_html__( 'Subscribe section', 'elfie' ),
	'panel'          => 'elfie_panel_header',
    'priority'       => 12,
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'text',
	'settings'    => 'subscribe_shortcode',
	'label'       => esc_html__( 'Subscribe shortcode', 'elfie' ),
	'description' => sprintf( esc_html__( 'Paste a shortcode for your newsletter subscribe plugin. We recommend you use the %s plugin for this section.', 'elfie' ), '<a target="_blank" href="https://wordpress.org/plugins/mailchimp-for-wp/">Mailchimp for WP</a>' ),
	'section'  	  => 'elfie_section_subscribe',
	'default'     => '',
	'priority'    => 10,
	'partial_refresh'    => array(
		'sub1' => array(
			'selector'        => '.subscribe-section',
			'render_callback' => 'elfie_subscribe_section',
			'container_inclusive' => true
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'editor',
	'settings'    => 'subscribe_text',
	'label'       => esc_html__( 'Subscribe text', 'elfie' ),
	'description' => esc_html__( 'Add some text to show up next to your form', 'elfie' ),
	'section'  	  => 'elfie_section_subscribe',
	'default'     => sprintf( '<h3>%1s</h3><p>%2s</p>', esc_html__( 'Subscribe to my newsletter', 'elfie' ), esc_html__( 'Get the news in your inbox.', 'elfie' ) ),
	'priority'    => 10,
	'partial_refresh'    => array(
		'sub2' => array(
			'selector'        => '.subscribe-section',
			'render_callback' => 'elfie_subscribe_section',
			'container_inclusive' => true
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'select',
	'settings'    => 'subscribe_position',
	'label'       => esc_html__( 'Subscribe section position', 'elfie' ),
	'section'  	  => 'elfie_section_subscribe',
	'default'     => 'header',
	'choices'     => array(
		'header'  	=> esc_html__( 'Header', 'elfie' ),
		'footer'  	=> esc_html__( 'Footer', 'elfie' ),
		'both'  	=> esc_html__( 'Both', 'elfie' ),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'toggle',
	'settings'    => 'subscribe_display',
	'label'       => esc_html__( 'Show subscribe section only on blog home?', 'elfie' ),
	'section'  	  => 'elfie_section_subscribe',
	'default'     => 1,
	'priority'    => 10,
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'select',
	'settings'    => 'subscribe_container',
	'label'       => esc_html__( 'Subscribe section position', 'elfie' ),
	'section'  	  => 'elfie_section_subscribe',
	'default'     => 'container',
	'choices'     => array(
		'container'  	=> esc_html__( 'Contained', 'elfie' ),
		'fullwidth'  	=> esc_html__( 'Full width', 'elfie' ),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'subscribe_background_color',
	'label'       => esc_html__( 'Background color', 'elfie' ),
	'section'     => 'elfie_section_subscribe',
	'default'     => '#f7f7f7',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.subscribe-section .inner-subscribe-section',
			'property' => 'background-color',
		),
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'color',
	'settings'    => 'subscribe_color',
	'label'       => esc_html__( 'Text color', 'elfie' ),
	'section'     => 'elfie_section_subscribe',
	'default'     => '#000',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.subscribe-section .inner-subscribe-section, .subscribe-section .inner-subscribe-section h1, .subscribe-section .inner-subscribe-section h2, .subscribe-section .inner-subscribe-section h3, .subscribe-section .inner-subscribe-section h4, .subscribe-section .inner-subscribe-section h5',
			'property' => 'color',
		),	
	),	
) );
Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'dimensions',
	'settings'    => 'subscribe_section_margins',
	'label'       => esc_html__( 'Margins', 'elfie' ),
	'section'     => 'elfie_section_subscribe',
	'transport'	  => 'auto',
	'default'     => [
		'margin-top'  	=> '30px',
		'margin-bottom' => '30px',
	],
	'choices'     => [
		'labels' => [
			'margin-top'  		=> esc_html__( 'Margin top', 'elfie' ),
			'margin-bottom'  	=> esc_html__( 'Margin bottom', 'elfie' ),
		],
	],	
	'output'    => array(
		array(
		  'choice'      => 'margin-top',
		  'element'     => '.subscribe-section',
		  'property'    => 'margin-top',
		),
		array(
			'choice'      => 'margin-bottom',
			'element'     => '.subscribe-section',
			'property'    => 'margin-bottom',
		),
	),
) );