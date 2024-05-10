<?php
/**
 * Custom Settings for Page
 */

acf_add_local_field_group(array(
	'key' => 'group_61655fa45ada0',
	'title' => esc_html__( 'Page Options', 'electro' ),
	'fields' => array(
		array(
			'key' => 'field_61655fafa9087',
			'label' => esc_html__( 'Css Classes', 'electro' ),
			'name' => 'css_classes',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));
