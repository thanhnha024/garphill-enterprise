<?php
/**
 * Custom Settings for Product Category
 */

acf_add_local_field_group(array(
    'key' => 'group_615ea59f7d67b',
    'title' => esc_html__( 'Category Options', 'electro' ),
    'fields' => array(
        array(
            'key' => 'field_615ea626aba16',
            'label' => esc_html__( 'Cover Image', 'electro' ),
            'name' => 'product_cat_cover_image',
            'type' => 'image',
            'instructions' => esc_html__( 'Upload Category Cover Image', 'electro' ),
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
                'value' => 'product_cat',
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
