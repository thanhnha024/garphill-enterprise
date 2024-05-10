<?php
/**
 * Custom Settings for Product Attribute
 */

if( function_exists( 'electro_get_brands_taxonomy' ) && electro_get_brands_taxonomy() ) {

    acf_add_local_field_group(array(
        'key' => 'group_61801c9dd144f',
        'title' => esc_html__( 'Attribute Options', 'electro' ),
        'fields' => array(
            array(
                'key' => 'field_61801cc39035a',
                'label' => esc_html__( 'Cover Image', 'electro' ),
                'name' => 'product_attribute_cover_image',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => electro_get_brands_taxonomy(),
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    )); 
}