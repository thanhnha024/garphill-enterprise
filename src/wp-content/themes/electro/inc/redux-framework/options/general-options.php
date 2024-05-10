<?php
/**
 * General Theme Options
 * 
 */

$general_options 	= apply_filters( 'electro_general_options_args', array(
	'title'		=> esc_html__( 'General', 'electro' ),
	'icon'		=> 'far fa-dot-circle',
	'fields'	=> array(

		array(
			'title'		=> esc_html__( 'Website Mode', 'electro' ),
			'subtitle'  => esc_html__( 'Choose if you want to use light mode or dark mode for your website by default', 'electro' ),
			'id'		=> 'dark_enabled',
			'type'		=> 'switch',
			'on'		=> esc_html__('Dark', 'electro'),
			'off'		=> esc_html__('Light', 'electro'),
			'default'	=> 0,
		),

		array(
            'title'     => esc_html__( 'Your Dark Logo', 'electro' ),
            'subtitle'  => esc_html__( 'Upload your dark logo image.', 'electro' ),
            'id'        => 'site_dark_logo',
            'type'      => 'media',
        ),

		array(
			'title'		=> esc_html__( 'Show mode switcher', 'electro' ),
			'subtitle'  => esc_html( 'Select if you want to show a mode switcher in your frontend', 'electro' ),
			'id'		=> 'mode_switcher_enabled',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 0,
		),
		
		array(
			'title'		=> esc_html__( 'Scroll To Top', 'electro' ),
			'id'		=> 'scrollup',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 1,
		),
		array(
			'title'		=> esc_html__( 'Register Image Size', 'electro' ),
			'subtitle'	=> esc_html__( 'Enable and regenerate thumbnails to enable theme registered image sizes.', 'electro' ),
			'id'		=> 'reg_image_size',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'electro'),
			'off'		=> esc_html__('Disabled', 'electro'),
			'default'	=> 0,
		),
		array(
			'id'		=> 'sidebar_margin_top',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Home v2 Sidebar Margin Top', 'electro' ),
			'subtitle'	=> esc_html__( 'Values in Pixels', 'electro' ),
			'default'	=> esc_html__( '268', 'electro' ),
		),
	)
) );

if ( is_child_theme() ) {
	$general_options['fields'][] = array(
		'title'   => esc_html__( 'Load child theme style.css', 'electro' ),
		'id'      => 'load_child_theme',
		'type'    => 'switch',
		'default' => 0
	);
}