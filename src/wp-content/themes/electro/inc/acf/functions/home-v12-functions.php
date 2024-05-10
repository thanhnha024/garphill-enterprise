<?php
/**
 * ACF Functions related to Home v12 meta fields.
 */

if ( ! function_exists( 'electro_acf_home_v12_get_header_style' ) ) {
	/**
	 * Header Style Option
	 *
	 * @return string
	 */
	function electro_acf_home_v12_get_header_style() {
		return electro_get_field( 'home_v12_header_style' );
	}
}

/**
 * Page Content Options
 */
function electro_acf_get_home_v12_page_content_options( $page_content_options ) {

	if ( electro_is_acf_activated() ) {

		$page_content_fields = array(
			'is_enabled'        => 'is_enabled',
            'priority'          => 'priority',
            'animation'         => 'animation',
		);

		foreach( $page_content_fields as $key => $field ) {
			$page_content_options[$key] = electro_get_field( 'home_v12_block_page_content_' . $field );
		}
	}

	return $page_content_options;
}

/**
 * Slider Options
 */
function electro_acf_get_home_v12_slider_options( $slider_options ) {

	if ( electro_is_acf_activated() ) {

		$slider_options_fields = array(
			'is_enabled'        => 'home_v12_block_slider_is_enabled',
            'priority'          => 'home_v12_block_slider_priority',
            'animation'         => 'home_v12_block_slider_animation',
			'slider_shortcode'  => 'home_v12_slider_shortcode',
		);

		foreach( $slider_options_fields as $key => $field ) {
			$slider_options[$key] = electro_get_field( $field );
		}
	}

	return $slider_options;
}

/**
 * Categories Options
 */
function electro_acf_get_home_v12_categories_options( $categories_options ) {

	if ( electro_is_acf_activated() ) {

		$categories_options_fields = array( 
			'columns'    => 'column',
			'orderby'    => 'orderby',
			'order'      => 'order',
			'number'     => 'limit',
			'hide_empty' => 'hide_empty',
			'cat_object' => 'object',
		);

		foreach( $categories_options_fields as $key => $field ) {
			if ( 'cat_object' === $key ) {
				$cat_objs = electro_get_field( 'home_v12_categories_' . $field );

				$categories_options[ 'categories' ][ 'slug' ] = [];

				if ( isset( $cat_objs ) && is_array( $cat_objs ) && ! empty( $cat_objs ) ) {
					foreach( $cat_objs as $cat_obj ) {
						if ( isset( $cat_obj->slug ) ) {
							$categories_options[ 'categories' ][ 'slug' ][] = $cat_obj->slug;
						}
					}
				}
			} else {
				$categories_options[ 'categories' ][$key] = electro_get_field( 'home_v12_categories_' . $field );
			}
		}

		$categories_general_fields = array( 
			'is_enabled' => 'is_enabled',
            'priority'   => 'priority',
            'animation'  => 'animation',
		);

		foreach( $categories_general_fields as $key => $field ) {
			$categories_options[$key] = electro_get_field( 'home_v12_block_categories_' . $field );
		}
	}

	return $categories_options;
}

/**
 * Hot Products Options
 */
function electro_acf_get_home_v12_hot_products_options( $product_options ) {

	if ( electro_is_acf_activated() ) {

		$product_options_fields = array(
			'section_title'         => 'section_title',
            'shortcode'             => 'content',
            'shortcode_atts'        => array(
                'columns'      => 'column',
                'per_page'     => 'limit',
                'orderby'      => 'orderby',
                'order'        => 'order',
            ),
		);

		foreach( $product_options_fields as $key => $field ) {
			if ( 'shortcode_atts' === $key ) {

				$shortcode_atts_fields = $field;

				foreach( $shortcode_atts_fields as $key => $shortcode_atts_field ) {
					$product_options['shortcode_atts'][$key] = electro_get_field( 'home_v12_hot_products_' . $shortcode_atts_field );
				}
			} else {
				$product_options[$key] = electro_get_field( 'home_v12_hot_products_' . $field );
			}
		}

		if ( electro_is_wide_enabled() ) {
			$product_options[ 'shortcode_atts' ]['columns_wide'] = electro_get_field( 'home_v12_hot_products_wide_column' );
		}

		$product_ids = electro_get_field( 'home_v12_hot_products_ids' );
		if ( is_array( $product_ids ) ) {
			$product_ids = implode( ',', $product_ids );

			$product_options[ 'products_ids_skus' ] = $product_ids;
		}

		$product_general_fields = array( 
			'is_enabled' => 'is_enabled',
            'priority'   => 'priority',
            'animation'  => 'animation',
		);

		foreach( $product_general_fields as $key => $field ) {
			$product_options[$key] = electro_get_field( 'home_v12_block_hot_products_' . $field );
		}
	}

	return $product_options;
}

/**
 * Banners Options
 */
function electro_acf_get_home_v12_banners_options( $banners_options ) {

	if ( electro_is_acf_activated() ) {
		$banners_options_fields = array(
            'banners' => array(
                'banner_1' => array(
                    'bg_image' => 'background_image',
                    'image'    => 'image',
                    'url'      => 'url',
                    'desc'     => 'desc'
                ),
                'banner_2' => array(
                    'bg_image'       => 'background_image',
                    'url'            => 'url',
                    'desc'           => 'desc',
                    'price_pre_text' => 'price_pre_text',
                    'price_text'     => 'price_text'
                ),
                'banner_3' => array(
                    'bg_image'    => 'background_image',
                    'url'         => 'url',
                    'title'       => 'title',
                    'subtitle'    => 'subtitle',
                    'desc'        => 'desc',
                )
            )
        );

		foreach( $banners_options_fields[ 'banners' ][ 'banner_1' ] as $key => $field ) {
			$banners_options[ 'banners' ][ 'banner_1' ][$key] = electro_get_field( 'home_v12_banners_1_' . $field );
		}

		foreach( $banners_options_fields[ 'banners' ][ 'banner_2' ] as $key => $field ) {
			$banners_options[ 'banners' ][ 'banner_2' ][$key] = electro_get_field( 'home_v12_banners_2_' . $field );
		}

		foreach( $banners_options_fields[ 'banners' ][ 'banner_3' ] as $key => $field ) {
			$banners_options[ 'banners' ][ 'banner_3' ][$key] = electro_get_field( 'home_v12_banners_3_' . $field );
		}

		$banners_general_fields = array( 
			'is_enabled' => 'is_enabled',
            'priority'   => 'priority',
            'animation'  => 'animation',
		);

		foreach( $banners_general_fields as $key => $field ) {
			$banners_options[$key] = electro_get_field( 'home_v12_block_banners_' . $field );
		}
	}

	return $banners_options;
}

/**
 * New Products Options
 */
function electro_acf_get_home_v12_new_products_options( $product_options ) {

	if ( electro_is_acf_activated() ) {

		$product_options_fields = array(
			'section_title'         => 'section_title',
            'shortcode'             => 'content',
            'shortcode_atts'        => array(
                'columns'      => 'column',
                'per_page'     => 'limit',
                'orderby'      => 'orderby',
                'order'        => 'order',
            ),
		);

		foreach( $product_options_fields as $key => $field ) {
			if ( 'shortcode_atts' === $key ) {

				$shortcode_atts_fields = $field;

				foreach( $shortcode_atts_fields as $key => $shortcode_atts_field ) {
					$product_options['shortcode_atts'][$key] = electro_get_field( 'home_v12_new_products_' . $shortcode_atts_field );
				}
			} else {
				$product_options[$key] = electro_get_field( 'home_v12_new_products_' . $field );
			}
		}

		if ( electro_is_wide_enabled() ) {
			$product_options[ 'shortcode_atts' ]['columns_wide'] = electro_get_field( 'home_v12_new_products_wide_column' );
		}

		$product_ids = electro_get_field( 'home_v12_new_products_ids' );
		if ( is_array( $product_ids ) ) {
			$product_ids = implode( ',', $product_ids );

			$product_options[ 'products_ids_skus' ] = $product_ids;
		}

		$product_general_fields = array( 
			'is_enabled' => 'is_enabled',
            'priority'   => 'priority',
            'animation'  => 'animation',
		);

		foreach( $product_general_fields as $key => $field ) {
			$product_options[$key] = electro_get_field( 'home_v12_block_new_products_' . $field );
		}
	}

	return $product_options;
}

/**
 * Recommend Products Options
 */
function electro_acf_get_home_v12_recommend_products_options( $product_options ) {

	if ( electro_is_acf_activated() ) {

		$product_options_fields = array(
			'section_title'         => 'section_title',
            'shortcode'             => 'content',
            'shortcode_atts'        => array(
                'columns'      => 'column',
                'per_page'     => 'limit',
                'orderby'      => 'orderby',
                'order'        => 'order',
            ),
		);

		foreach( $product_options_fields as $key => $field ) {
			if ( 'shortcode_atts' === $key ) {

				$shortcode_atts_fields = $field;

				foreach( $shortcode_atts_fields as $key => $shortcode_atts_field ) {
					$product_options['shortcode_atts'][$key] = electro_get_field( 'home_v12_recommend_products_' . $shortcode_atts_field );
				}
			} else {
				$product_options[$key] = electro_get_field( 'home_v12_recommend_products_' . $field );
			}
		}

		if ( electro_is_wide_enabled() ) {
			$product_options[ 'shortcode_atts' ]['columns_wide'] = electro_get_field( 'home_v12_recommend_products_wide_column' );
		}

		$product_ids = electro_get_field( 'home_v12_recommend_products_ids' );
		if ( is_array( $product_ids ) ) {
			$product_ids = implode( ',', $product_ids );

			$product_options[ 'products_ids_skus' ] = $product_ids;
		}

		$product_general_fields = array( 
			'is_enabled' => 'is_enabled',
            'priority'   => 'priority',
            'animation'  => 'animation',
		);

		foreach( $product_general_fields as $key => $field ) {
			$product_options[$key] = electro_get_field( 'home_v12_block_recommend_products_' . $field );
		}
	}

	return $product_options;
}

/**
 * Blog Post Options
 */
function electro_acf_get_home_v12_blog_post_options( $blog_post_options ) {

	if ( electro_is_acf_activated() ) {

		$blog_post_options_fields = array(
			'section_title'  => 'section_title',
			'posts_per_page' => 'limit',
			'columns'        => 'column',
			'post__in'       => 'ids',
			'orderby'        => 'orderby',
			'order'          => 'order',
		);

		foreach( $blog_post_options_fields as $key => $field ) {
			$blog_post_options[$key] = electro_get_field( 'home_v12_blog_posts_' . $field );
		}

		$blog_post_general_fields = array( 
			'is_enabled' => 'is_enabled',
            'priority'   => 'priority',
            'animation'  => 'animation',
		);

		foreach( $blog_post_general_fields as $key => $field ) {
			$blog_post_options[$key] = electro_get_field( 'home_v12_block_blog_posts_' . $field );
		}
	}

	return $blog_post_options;
}

/**
 * Brands Options
 */
function electro_acf_get_home_v11_brands_options( $brands_options ) {

	if ( electro_is_acf_activated() ) {
		$brands_options_fields = array(
			'section_title' => 'section_title',
            'columns'       => 'columns',
            'orderby'       => 'orderby',
            'order'         => 'order',
            'number'        => 'limit',
            'hide_empty'    => 'hide_empty'
		);

		foreach( $brands_options_fields as $key => $field ) {
			$brands_options[$key] = electro_get_field( 'home_v12_brands_' . $field );
		}

		$brands_general_fields = array( 
			'is_enabled' => 'is_enabled',
            'priority'   => 'priority',
            'animation'  => 'animation',
		);

		foreach( $brands_general_fields as $key => $field ) {
			$brands_options[$key] = electro_get_field( 'home_v12_block_brands_' . $field );
		}
	}

	return $brands_options;
}
