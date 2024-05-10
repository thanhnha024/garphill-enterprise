<?php
/**
 * ACF Functions related to Home v10 meta fields.
 */

if ( ! function_exists( 'electro_acf_home_v10_get_header_style' ) ) {
	/**
	 * Header Style Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_header_style() {
		return electro_get_field( 'home_v10_header_style' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_page_content_general_options' ) ) {
	/**
	 * Page Content General Options
	 *
	 * @return array
	 */
	function electro_acf_home_v10_get_page_content_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$pc_general_options = false;
		
		foreach ( $options as $option ) {
			$pc_general_options[$option] = electro_get_field( 'home_v10_block_page_content_' . $option );
		}
	
		return $pc_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_slider_with_ads_general_options' ) ) {
	/**
	 * Slider With Ads General Options
	 *
	 * @return array
	 */
	function electro_acf_home_v10_get_slider_with_ads_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$swa_general_options = false;
		
		foreach ( $options as $option ) {
			$swa_general_options[$option] = electro_get_field( 'home_v10_block_slider_with_ads_' . $option );
		}

		return $swa_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_sidebar_with_products_general_options' ) ) {
	/**
	 * Sidebar With Products General Options
	 *
	 * @return array
	 */
	function electro_acf_home_v10_get_sidebar_with_products_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$swp_general_options = false;
		
		foreach ( $options as $option ) {
			$swp_general_options[$option] = electro_get_field( 'home_v10_block_sidebar_with_products_' . $option );
		}
	
		return $swp_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_swadb_bg_image' ) ) {
	/**
	 * Slider With Ads Background Image Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_swadb_bg_image() {
		return electro_get_field( 'homev10_slider_with_ads_bg_image' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_slider_shortcode' ) ) {
	/**
	 * Slider With Ads Slider Shortcode Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_slider_shortcode() {
		return electro_get_field( 'home_v10_slider_shortcode' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_1_text' ) ) {
	/**
	 * Slider With Ads Ad Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_1_text() {
		return electro_get_field( 'home_v10_ads_1_title' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_1_action_text' ) ) {
	/**
	 * Slider With Ads Ad Action Text Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_1_action_text() {
		return electro_get_field( 'home_v10_ads_1_action_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_1_image' ) ) {
	/**
	 * Slider With Ads Ad Image Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_1_image() {
		return electro_get_field( 'home_v10_ads_1_image' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_1_url' ) ) {
	/**
	 * Slider With Ads Ad URL Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_1_url() {
		return electro_get_field( 'home_v10_ads_1_url' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_2_text' ) ) {
	/**
	 * Slider With Ads Ad Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_2_text() {
		return electro_get_field( 'home_v10_ads_2_title' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_2_action_text' ) ) {
	/**
	 * Slider With Ads Ad Action Text Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_2_action_text() {
		return electro_get_field( 'home_v10_ads_2_action_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_2_image' ) ) {
	/**
	 * Slider With Ads Ad Image Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_2_image() {
		return electro_get_field( 'home_v10_ads_2_image' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_ads_2_url' ) ) {
	/**
	 * Slider With Ads Ad URL Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_ads_2_url() {
		return electro_get_field( 'home_v10_ads_2_url' );
	}	
}

if ( ! function_exists( 'electro_acf_home_v10_get_is_sidebar_enabled' ) ) {
	/**
	 * Sidebar Enable / Disable Option
	 *
	 * @return boolean
	 */
	function electro_acf_home_v10_get_is_sidebar_enabled() {
		return electro_get_field( 'home_v10_sidebar_is_enabled' );
	}	
}

if ( ! function_exists( 'electro_acf_home_v10_get_sidebar_menu_title' ) ) {
	/**
	 * Sidebar Menu Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_sidebar_menu_title() {
		return electro_get_field( 'home_v10_sidebar_menu_title' );
	}	
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_section_title' ) ) {
	/**
	 * Products Section Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_products_section_title() {
		return electro_get_field( 'home_v10_products_section_title' );
	}	
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_shortcode_content') ) {
	/**
	 * Products Content Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_products_shortcode_content() {
		return electro_get_field( 'home_v10_products_content' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_limit') ) {
	/**
	 * Products Limit Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_products_limit() {
		return electro_get_field( 'home_v10_products_limit' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_wide_column') ) {
	/**
	 * Products Wide Columns Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_products_wide_column() {
		return electro_get_field( 'home_v10_products_wide_column' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_columns') ) {
	/**
	 * Products Columns Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_products_columns() {
		return electro_get_field( 'home_v10_products_columns' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_choices') ) {
	/**
	 * Products Choices Option
	 *
	 * @return array
	 */
	function electro_acf_home_v10_get_products_choices() {
		return electro_get_field( 'home_v10_products_ids' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_orderby') ) {
	/**
	 * Products Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_products_orderby() {
		return electro_get_field( 'home_v10_products_orderby' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_products_order') ) {
	/**
	 * Products Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v10_get_products_order() {
		return electro_get_field( 'home_v10_products_order' );
	}
}

if ( ! function_exists( 'electro_acf_home_v10_get_is_products_pagination_enabled') ) {
	/**
	 * Products Orderby Option
	 *
	 * @return boolean
	 */
	function electro_acf_home_v10_get_is_products_pagination_enabled() {
		return electro_get_field( 'home_v10_products_is_pagination_enabled' );
	}
}

/**
 * General Options
 */
function electro_acf_get_home_v10_general_options( $general_options ) {

	if ( electro_is_acf_activated() ) {
		$general_options = array(
			'page_content' => electro_acf_home_v10_get_page_content_general_options(),
			'swadb'        => electro_acf_home_v10_get_slider_with_ads_general_options(),
			'swpb'         => electro_acf_home_v10_get_sidebar_with_products_general_options()
		);
	}

	return $general_options;
}

/**
 * Slider with Ads Options
 */
function electro_acf_get_home_v10_swadb_options( $swadb_options ) {

	if ( electro_is_acf_activated() ) {
		$swadb_options = array(
			'bg_image'          => electro_acf_home_v10_get_swadb_bg_image(),
			'slider_shortcode'  => electro_acf_home_v10_get_slider_shortcode(),
			'adb'               => array(
				array(
					'title'       => electro_acf_home_v10_get_ads_1_text(),
					'action_text' => electro_acf_home_v10_get_ads_1_action_text(),
					'image'       => electro_acf_home_v10_get_ads_1_image(),
					'url'         => electro_acf_home_v10_get_ads_1_url()
				),
				array(
					'title'       => electro_acf_home_v10_get_ads_2_text(),
					'action_text' => electro_acf_home_v10_get_ads_2_action_text(),
					'image'       => electro_acf_home_v10_get_ads_2_image(),
					'url'         => electro_acf_home_v10_get_ads_2_url()
				)
			)
		);
	}

	return $swadb_options;
}

/**
 * Sidebar with Products Options
 */
function electro_acf_get_home_v10_swpb_options( $swpb_options ) {

	if ( electro_is_acf_activated() ) {

		$product_ids = electro_acf_home_v10_get_products_choices();
		if ( is_array( $product_ids ) ) {
			$product_ids = implode( ',', $product_ids );
		}

		$swpb_options = array(
			'enable_sidebar'        => electro_acf_home_v10_get_is_sidebar_enabled(),
			'sidebar_menu_title'    => electro_acf_home_v10_get_sidebar_menu_title(),
			'section_title'         => electro_acf_home_v10_get_products_section_title(),
			'paginate'              => electro_acf_home_v10_get_is_products_pagination_enabled(),
			'shortcode'             => electro_acf_home_v10_get_products_shortcode_content(),
			'products_ids_skus'     => $product_ids,
			'shortcode_atts'        => array(
				'columns'  => electro_acf_home_v10_get_products_columns(),
				'per_page' => electro_acf_home_v10_get_products_limit(),
				'orderby'  => electro_acf_home_v10_get_products_orderby(),
				'order'    => electro_acf_home_v10_get_products_order()
			)
		);

		if ( electro_is_wide_enabled() ) {
			$swpb_options[ 'shortcode_atts' ]['columns_wide'] = electro_acf_home_v10_get_products_wide_column();
		}
	}

	return $swpb_options;
}