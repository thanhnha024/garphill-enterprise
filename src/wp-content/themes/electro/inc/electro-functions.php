<?php
/**
 * Functions used in Electro
 *
 * @since 2.0
 */

require_once get_template_directory() . '/inc/functions/header.php';
require_once get_template_directory() . '/inc/functions/home.php';

if ( ! function_exists( 'electro_handheld_header_responsive_class' ) ) {
	function electro_handheld_header_responsive_class() {
		return apply_filters( 'electro_handheld_header_responsive_class', 'hidden-xl-up d-xl-none' );
	}
}

if ( ! function_exists( 'electro_desktop_header_responsive_class' ) ) {
	function electro_desktop_header_responsive_class() {
		return apply_filters( 'electro_desktop_header_responsive_class', 'hidden-lg-down d-none d-xl-block' );
	}
}

if ( ! function_exists( 'electro_is_acf_activated' ) ) {
	/**
	 * Query ACF activation
	 */
	function electro_is_acf_activated() {
		return function_exists( 'get_field' ) ? true : false;
	}
}

if ( ! function_exists( 'electro_is_elementor_activated' ) ) {
	/**
	 * Query Elementor activation.
	 */
	function electro_is_elementor_activated() {
		return class_exists( 'Elementor' );
	}
}


function enqueue_wc_cart_fragments() { 
	wp_enqueue_script( 'wc-cart-fragments' ); 
}

add_action( 'wp_enqueue_scripts', 'enqueue_wc_cart_fragments' );