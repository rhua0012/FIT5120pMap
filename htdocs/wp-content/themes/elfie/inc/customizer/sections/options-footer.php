<?php
/**
 * Footer related Customizer options
 * Built for Kirki
 */

Elfie_Kirki::add_section( 'elfie_section_footer', array(
    'title'       	 => esc_html__( 'Footer', 'elfie' ),
    'priority'       => 31,
) );

Elfie_Kirki::add_field( 'elfie', array(
	'type'        => 'text',
	'settings'    => 'instagram_shortcode',
	'label'       => esc_html__( 'Instagram section', 'elfie' ),
	'description' => sprintf( esc_html__( 'We recommend you use the %s plugin for this section. Simply copy the shortcode and paste it here.', 'elfie' ), '<a target="_blank" href="https://wordpress.org/plugins/instagram-feed/">Instagram Feed</a>' ),
	'section'  	  => 'elfie_section_footer',
	'default'     => '',
	'priority'    => 10,
) );