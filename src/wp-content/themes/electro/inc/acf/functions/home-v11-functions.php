<?php
/**
 * ACF Functions related to Home v11 meta fields.
 */

if ( ! function_exists( 'electro_acf_home_v11_get_header_style' ) ) {
	/**
	 * Header Style Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_header_style() {
		return electro_get_field( 'home_v11_header_style' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_page_content_general_options' ) ) {
	/**
	 * Page Content General Options
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_page_content_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$pc_general_options = false;
		
		foreach ( $options as $option ) {
			$pc_general_options[$option] = electro_get_field( 'home_v11_block_page_content_' . $option );
		}
	
		return $pc_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_slider_general_options' ) ) {
	/**
	 * Slider General Options
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_slider_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$slider_general_options = false;
		
		foreach ( $options as $option ) {
			$slider_general_options[$option] = electro_get_field( 'home_v11_block_slider_' . $option );
		}
	
		return $slider_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_general_options' ) ) {
	/**
	 * Brands with Categories General Options
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_bwc_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$bwc_general_options = false;
		
		foreach ( $options as $option ) {
			$bwc_general_options[$option] = electro_get_field( 'home_v11_block_bwc_' . $option );
		}
	
		return $bwc_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwpc_general_options' ) ) {
	/**
	 * Banner with Products Carousel Options
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_bwpc_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$bwpc_general_options = false;
		
		foreach ( $options as $option ) {
			$bwpc_general_options[$option] = electro_get_field( 'home_v11_block_bwpc_' . $option );
		}
	
		return $bwpc_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_banners_general_options' ) ) {
	/**
	 * Banners Options
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_banners_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$banners_general_options = false;
		
		foreach ( $options as $option ) {
			$banners_general_options[$option] = electro_get_field( 'home_v11_block_banners_' . $option );
		}
	
		return $banners_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_prc_general_options' ) ) {
	/**
	 * Products Carousel Options
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_prc_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$prc_general_options = false;
		
		foreach ( $options as $option ) {
			$prc_general_options[$option] = electro_get_field( 'home_v11_block_prc_' . $option );
		}
	
		return $prc_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_tpc_general_options' ) ) {
	/**
	 * Trending Products Carousel Options
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_tpc_general_options() {
		$options = [ 'is_enabled', 'priority', 'animation' ];
		$tpc_general_options = false;
		
		foreach ( $options as $option ) {
			$tpc_general_options[$option] = electro_get_field( 'home_v11_block_tpc_' . $option );
		}
	
		return $tpc_general_options;
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_slider_bg_image' ) ) {
	/**
	 * Slider Background Image Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_slider_bg_image() {
		return electro_get_field( 'homev11_slider_bg_image' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_slider_shortcode' ) ) {
	/**
	 * Slider Shortcode Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_slider_shortcode() {
		return electro_get_field( 'home_v11_slider_shortcode' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_brands_title' ) ) {
	/**
	 * Brand Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_brands_title() {
		return electro_get_field( 'home_v11_brands_title' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_more_brands_text' ) ) {
	/**
	 * More Brands Text Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_more_brands_text() {
		return electro_get_field( 'home_v11_brands_more_brands_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_more_brands_link' ) ) {
	/**
	 * More Brands Link Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_more_brands_link() {
		return electro_get_field( 'home_v11_brands_more_brands_url' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_brands_limit' ) ) {
	/**
	 * Brands Limit Option
	 *
	 * @return integer
	 */
	function electro_acf_home_v11_get_bwc_brands_limit() {
		return electro_get_field( 'home_v11_brands_limit' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_brands_orderby' ) ) {
	/**
	 * Brands Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_brands_orderby() {
		return electro_get_field( 'home_v11_brands_orderby' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_brands_order' ) ) {
	/**
	 * Brands Order Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_brands_order() {
		return electro_get_field( 'home_v11_brands_order' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_brands_hide_empty' ) ) {
	/**
	 * Brands Hide Empty Option
	 *
	 * @return boolean
	 */
	function electro_acf_home_v11_get_bwc_brands_hide_empty() {
		return electro_get_field( 'home_v11_brands_hide_empty' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_categories_arrow_icon' ) ) {
	/**
	 * Categories Arrow Icon Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_categories_arrow_icon() {
		return electro_get_field( 'home_v11_categories_arrow_icon' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_categories_limit' ) ) {
	/**
	 * Categories Limit Option
	 *
	 * @return integer
	 */
	function electro_acf_home_v11_get_bwc_categories_limit() {
		return electro_get_field( 'home_v11_categories_limit' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_categories_child_limit' ) ) {
	/**
	 * Categories Child Limit Option
	 *
	 * @return integer
	 */
	function electro_acf_home_v11_get_bwc_categories_child_limit() {
		return electro_get_field( 'home_v11_categories_child_limit' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_categories_orderby' ) ) {
	/**
	 * Categories Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_categories_orderby() {
		return electro_get_field( 'home_v11_categories_orderby' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_categories_order' ) ) {
	/**
	 * Categories Order Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_bwc_categories_order() {
		return electro_get_field( 'home_v11_categories_order' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_categories_hide_empty' ) ) {
	/**
	 * Categories Hide Empty Option
	 *
	 * @return boolean
	 */
	function electro_acf_home_v11_get_bwc_categories_hide_empty() {
		return electro_get_field( 'home_v11_categories_hide_empty' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_category_ids' ) ) {
	/**
	 * Category Ids Empty Option
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_bwc_category_ids() {
		return electro_get_field( 'home_v11_categories_ids' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_bwc_categories_more_child_text' ) ) {
	/**
	 * Categories More Child Text Option
	 *
	 * @return integer
	 */
	function electro_acf_home_v11_get_bwc_categories_more_child_text() {
		return electro_get_field( 'home_v11_categories_more_child_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_bg_image' ) ) {
	/**
	 * Background Image Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_bg_image() {
		return electro_get_field( 'home_v11_bwpc_bg_image' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_banner_title' ) ) {
	/**
	 * Banner Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_banner_title() {
		return electro_get_field( 'home_v11_bwpc_banner_title' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_banner_subtitle' ) ) {
	/**
	 * Banner Subtitle Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_banner_subtitle() {
		return electro_get_field( 'home_v11_bwpc_banner_subtitle' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_banner_offer_text' ) ) {
	/**
	 * Banner Offer Text Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_banner_offer_text() {
		return electro_get_field( 'home_v11_bwpc_banner_offer_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_banner_button_text' ) ) {
	/**
	 * Banner Button Text Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_banner_button_text() {
		return electro_get_field( 'home_v11_bwpc_banner_button_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_banner_button_url' ) ) {
	/**
	 * Banner Button URL Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_banner_button_url() {
		return electro_get_field( 'home_v11_bwpc_banner_button_url' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_get_products_shortcode_content') ) {
	/**
	 * Products Content Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_get_products_shortcode_content() {
		return electro_get_field( 'home_v11_bwpc_products_content' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_get_products_limit') ) {
	/**
	 * Products Limit Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_get_products_limit() {
		return electro_get_field( 'home_v11_bwpc_products_limit' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_get_products_choices') ) {
	/**
	 * Products Choices Option
	 *
	 * @return array
	 */
	function electro_acf_home_v11_bwpc_get_products_choices() {
		return electro_get_field( 'home_v11_bwpc_products_ids' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_get_products_orderby') ) {
	/**
	 * Products Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_get_products_orderby() {
		return electro_get_field( 'home_v11_bwpc_products_orderby' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_get_products_order') ) {
	/**
	 * Products Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_bwpc_get_products_order() {
		return electro_get_field( 'home_v11_bwpc_products_order' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_get_products_carousel_is_autoplay_enable') ) {
	/**
	 * Products Carousel Autoplay Option
	 *
	 * @return boolean
	 */
	function electro_acf_home_v11_bwpc_get_products_carousel_is_autoplay_enable() {
		return electro_get_field( 'home_v11_bwpc_products_carousel_autoplay' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_bwpc_get_products_carousel_slide_to_show') ) {
	/**
	 * Products Carousel Slide To Show Option
	 *
	 * @return integer
	 */
	function electro_acf_home_v11_bwpc_get_products_carousel_slide_to_show() {
		return electro_get_field( 'home_v11_bwpc_products_carousel_slide_to_show' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_two_banners_image_1') ) {
	/**
	 * Two Banners Image #1 Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_two_banners_image_1() {
		return electro_get_field( 'home_v11_two_banners_1_image' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_two_banners_action_link_1') ) {
	/**
	 * Two Banners Action Link #1 Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_two_banners_action_link_1() {
		return electro_get_field( 'home_v11_two_banners_1_action_link' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_two_banners_image_2') ) {
	/**
	 * Two Banners Image #2 Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_two_banners_image_2() {
		return electro_get_field( 'home_v11_two_banners_2_image' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_two_banners_action_link_2') ) {
	/**
	 * Two Banners Action Link #2 Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_two_banners_action_link_2() {
		return electro_get_field( 'home_v11_two_banners_2_action_link' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_section_title' ) ) {
	/**
	 * Products Carousel Section Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_products_carousel_section_title() {
		return electro_get_field( 'home_v11_products_carousel_section_title' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_action_text' ) ) {
	/**
	 * Products Carousel Action Text Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_products_carousel_action_text() {
		return electro_get_field( 'home_v11_products_carousel_action_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_action_link' ) ) {
	/**
	 * Products Carousel Action Link Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_products_carousel_action_link() {
		return electro_get_field( 'home_v11_products_carousel_action_link' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_shortcode_content') ) {
	/**
	 * Products Carousel Content Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_products_carousel_shortcode_content() {
		return electro_get_field( 'home_v11_products_carousel_content' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_limit') ) {
	/**
	 * Products Carousel Limit Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_products_carousel_limit() {
		return electro_get_field( 'home_v11_products_carousel_limit' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_choices') ) {
	/**
	 * Products Carousel Choices Option
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_products_carousel_choices() {
		return electro_get_field( 'home_v11_products_carousel_ids' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_orderby') ) {
	/**
	 * Products Carousel Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_products_carousel_orderby() {
		return electro_get_field( 'home_v11_products_carousel_orderby' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_order') ) {
	/**
	 * Products Carousel Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_products_carousel_order() {
		return electro_get_field( 'home_v11_products_carousel_order' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_is_autoplay_enable') ) {
	/**
	 * Products Carousel Autoplay Option
	 *
	 * @return boolean
	 */
	function electro_acf_home_v11_get_products_carousel_is_autoplay_enable() {
		return electro_get_field( 'home_v11_products_carousel_autoplay' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_products_carousel_slide_to_show') ) {
	/**
	 * Products Carousel Slide To Show Option
	 *
	 * @return integer
	 */
	function electro_acf_home_v11_get_products_carousel_slide_to_show() {
		return electro_get_field( 'home_v11_products_carousel_slide_to_show' );
	}
}




if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_section_title' ) ) {
	/**
	 * Trending Products Carousel Section Title Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_trending_products_carousel_section_title() {
		return electro_get_field( 'home_v11_trending_products_carousel_section_title' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_action_text' ) ) {
	/**
	 * Trending Products Carousel Action Text Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_trending_products_carousel_action_text() {
		return electro_get_field( 'home_v11_trending_products_carousel_action_text' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_action_link' ) ) {
	/**
	 * Trending Products Carousel Action Link Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_trending_products_carousel_action_link() {
		return electro_get_field( 'home_v11_trending_products_carousel_action_link' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_shortcode_content') ) {
	/**
	 * Trending Products Carousel Content Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_trending_products_carousel_shortcode_content() {
		return electro_get_field( 'home_v11_trending_products_carousel_content' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_limit') ) {
	/**
	 * Trending Products Carousel Limit Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_trending_products_carousel_limit() {
		return electro_get_field( 'home_v11_trending_products_carousel_limit' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_choices') ) {
	/**
	 * Trending Products Carousel Choices Option
	 *
	 * @return array
	 */
	function electro_acf_home_v11_get_trending_products_carousel_choices() {
		return electro_get_field( 'home_v11_trending_products_carousel_ids' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_orderby') ) {
	/**
	 * Trending Products Carousel Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_trending_products_carousel_orderby() {
		return electro_get_field( 'home_v11_trending_products_carousel_orderby' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_order') ) {
	/**
	 * Trending Products Carousel Orderby Option
	 *
	 * @return string
	 */
	function electro_acf_home_v11_get_trending_products_carousel_order() {
		return electro_get_field( 'home_v11_trending_products_carousel_order' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_is_autoplay_enable') ) {
	/**
	 * Trending Products Carousel Autoplay Option
	 *
	 * @return boolean
	 */
	function electro_acf_home_v11_get_trending_products_carousel_is_autoplay_enable() {
		return electro_get_field( 'home_v11_trending_products_carousel_autoplay' );
	}
}

if ( ! function_exists( 'electro_acf_home_v11_get_trending_products_carousel_slide_to_show') ) {
	/**
	 * Trending Products Carousel Slide To Show Option
	 *
	 * @return integer
	 */
	function electro_acf_home_v11_get_trending_products_carousel_slide_to_show() {
		return electro_get_field( 'home_v11_trending_products_carousel_slide_to_show' );
	}
}

/**
 * General Options
 */
function electro_acf_get_home_v11_general_options( $general_options ) {

	if ( electro_is_acf_activated() ) {

		$general_options = array(
			'page_content' => electro_acf_home_v11_get_page_content_general_options(),
			'slider' => electro_acf_home_v11_get_slider_general_options(),
			'bwc' => electro_acf_home_v11_get_bwc_general_options(),
			'bwpc' => electro_acf_home_v11_get_bwpc_general_options(),
			'banners' => electro_acf_home_v11_get_banners_general_options(),
			'pc' => electro_acf_home_v11_get_prc_general_options(),
			'tpc' => electro_acf_home_v11_get_tpc_general_options()
		);
	}

	return $general_options;
}

/**
 * Slider Options
 */
function electro_acf_get_home_v11_slider_options( $slider_options ) {

	if ( electro_is_acf_activated() ) {
		$slider_options = array(
			'bg_image'          => electro_acf_home_v11_get_slider_bg_image(),
			'slider_shortcode'  => electro_acf_home_v11_get_slider_shortcode(),
		);
	}

	return $slider_options;
}

/**
 * Brands with Category Options
 */
function electro_acf_get_home_v11_bwc_options( $bwc_options ) {

	if ( electro_is_acf_activated() ) {
		$bwc_options = array(
			'brands'       => array(
				'title'            => electro_acf_home_v11_get_bwc_brands_title(),
				'more_brands_text' => electro_acf_home_v11_get_bwc_more_brands_text(),
				'more_brands_link' => electro_acf_home_v11_get_bwc_more_brands_link(),
				'taxonomy_args'    => array(
					'orderby'    => electro_acf_home_v11_get_bwc_brands_orderby(),
					'order'      => electro_acf_home_v11_get_bwc_brands_order(),
					'number'     => electro_acf_home_v11_get_bwc_brands_limit(),
					'hide_empty' => electro_acf_home_v11_get_bwc_brands_hide_empty()
				)
			),
			'categories' => array(
				'arrow_icon'         => electro_acf_home_v11_get_bwc_categories_arrow_icon(),
				'cats_child_limit'   => electro_acf_home_v11_get_bwc_categories_child_limit(),
				'more_child_text'    => electro_acf_home_v11_get_bwc_categories_more_child_text(),
				'product_cats_args'  => array(
					'orderby'    => electro_acf_home_v11_get_bwc_categories_orderby(),
					'order'      => electro_acf_home_v11_get_bwc_categories_order(),
					'number'     => electro_acf_home_v11_get_bwc_categories_limit(),
					'hide_empty' => electro_acf_home_v11_get_bwc_categories_hide_empty(),
					'parent'     => 0,
					'include'    => electro_acf_home_v11_get_bwc_category_ids(),
				)
			)
		);
	}

	return $bwc_options;
}

/**
 * Banner with Products Carousel Options
 */
function electro_acf_get_home_v11_bwpc_options( $bwpc_options ) {

	if ( electro_is_acf_activated() ) {

		$product_ids = electro_acf_home_v11_bwpc_get_products_choices();
		if ( is_array( $product_ids ) ) {
			$product_ids = implode( ',', $product_ids );
		}

		$bwpc_options = array(
			'bg_image'     => electro_acf_home_v11_bwpc_bg_image(),
			'banner'       => array(
				'title'       => electro_acf_home_v11_bwpc_banner_title(),
				'subtitle'    => electro_acf_home_v11_bwpc_banner_subtitle(),
				'offer_text'  => electro_acf_home_v11_bwpc_banner_offer_text(),
				'button_text' => electro_acf_home_v11_bwpc_banner_button_text(),
				'button_url'  => electro_acf_home_v11_bwpc_banner_button_url()
			),
			'products' => array(
				'shortcode'             => electro_acf_home_v11_bwpc_get_products_shortcode_content(),
				'products_ids_skus'     => $product_ids,
				'shortcode_atts'        => array(
					'per_page' => electro_acf_home_v11_bwpc_get_products_limit(),
					'orderby'  => electro_acf_home_v11_bwpc_get_products_orderby(),
					'order'    => electro_acf_home_v11_bwpc_get_products_order()
				),
				'carousel_args' => array(
					'slideToShow' => electro_acf_home_v11_bwpc_get_products_carousel_slide_to_show(),
					'autoplay'    => electro_acf_home_v11_bwpc_get_products_carousel_is_autoplay_enable()
				)
			)
		);
	}

	return $bwpc_options;
}

/**
 * Two Banners Options
 */
function electro_acf_get_home_v11_two_banners_options( $two_banners_options ) {

	if ( electro_is_acf_activated() ) {
		$two_banners_options = array(
			'image_1' => array(
				'image_url'   => electro_acf_home_v11_get_two_banners_image_1() ? electro_acf_home_v11_get_two_banners_image_1() : 'http://placehold.it/690x151',
				'action_link' => electro_acf_home_v11_get_two_banners_action_link_1()
			),
			'image_2' => array(
				'image_url'   => electro_acf_home_v11_get_two_banners_image_2() ? electro_acf_home_v11_get_two_banners_image_2() : 'http://placehold.it/690x151',
				'action_link' => electro_acf_home_v11_get_two_banners_action_link_2()
			)
		);
	}

	return $two_banners_options;
}

/**
 * Products Carousel Options
 */
function electro_acf_get_home_v11_products_carousel_options( $products_carousel_options ) {

	if ( electro_is_acf_activated() ) {

		$product_ids = electro_acf_home_v11_get_products_carousel_choices();
		if ( is_array( $product_ids ) ) {
			$product_ids = implode( ',', $product_ids );
		}

		$products_carousel_options = array(
			'section_title'     => electro_acf_home_v11_get_products_carousel_section_title(),
			'button_text'       => electro_acf_home_v11_get_products_carousel_action_text(),
			'button_link'       => electro_acf_home_v11_get_products_carousel_action_link(),
			'products' => array(
				'shortcode'             => electro_acf_home_v11_get_products_carousel_shortcode_content(),
				'products_ids_skus'     => $product_ids,
				'shortcode_atts'        => array(
					'per_page' => electro_acf_home_v11_get_products_carousel_limit(),
					'orderby'  => electro_acf_home_v11_get_products_carousel_orderby(),
					'order'    => electro_acf_home_v11_get_products_carousel_order()
				),
				'carousel_args' => array(
					'slideToShow' => electro_acf_home_v11_get_products_carousel_slide_to_show(),
					'autoplay'    => electro_acf_home_v11_get_products_carousel_is_autoplay_enable()
				)
			)
		);
	}

	return $products_carousel_options;
}

/**
 * Trending Products Carousel Options
 */
function electro_acf_get_home_v11_trending_products_carousel_options( $trending_products_carousel_options ) {

	if ( electro_is_acf_activated() ) {

		$product_ids = electro_acf_home_v11_get_trending_products_carousel_choices();
		if ( is_array( $product_ids ) ) {
			$product_ids = implode( ',', $product_ids );
		}

		$trending_products_carousel_options = array(
			'section_title'     => electro_acf_home_v11_get_trending_products_carousel_section_title(),
			'button_text'       => electro_acf_home_v11_get_trending_products_carousel_action_text(),
			'button_link'       => electro_acf_home_v11_get_trending_products_carousel_action_link(),
			'products' => array(
				'shortcode'             => electro_acf_home_v11_get_trending_products_carousel_shortcode_content(),
				'products_ids_skus'     => $product_ids,
				'shortcode_atts'        => array(
					'per_page' => electro_acf_home_v11_get_trending_products_carousel_limit(),
					'orderby'  => electro_acf_home_v11_get_trending_products_carousel_orderby(),
					'order'    => electro_acf_home_v11_get_trending_products_carousel_order()
				),
				'carousel_args' => array(
					'slideToShow' => electro_acf_home_v11_get_trending_products_carousel_slide_to_show(),
					'autoplay'    => electro_acf_home_v11_get_trending_products_carousel_is_autoplay_enable()
				)
			)
		);
	}

	return $trending_products_carousel_options;
}