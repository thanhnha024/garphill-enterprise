<?php
/**
 * Redux Framework functions
 *
 * @package Electro/ReduxFramework
 */

/**
 * Setup functions for theme options
 */

/**
 * Enqueues font awesome for Redux Theme Options
 *
 * @return void
 */
function redux_queue_font_awesome() {
	wp_register_style(
		'redux-font-awesome',
		get_template_directory_uri() . '/assets/vendor/fontawesome/css/all.min.css',
		array(),
		time(),
		'all'
	);
	wp_enqueue_style( 'redux-font-awesome' );
}

/**
 * Disables Demo mode of Redux Framework
 *
 * @return void
 */
function redux_remove_demo_mode() { // Be sure to rename this function to something more unique
	if ( class_exists( 'Redux_Framework_Plugin' ) ) {
		$instance = Redux_Framework_Plugin::get_instance();
		remove_filter( 'plugin_row_meta', array( $instance, 'plugin_metalinks'), null, 2 );
		remove_action( 'admin_notices', array( $instance, 'admin_notices' ) );
		remove_filter( 'network_admin_plugin_action_links', array( $instance, 'add_settings_link' ), 1, 2 );
		remove_filter( 'plugin_action_links', array( $instance, 'add_settings_link' ), 1, 2 );
	}
}

/**
 * Modifies hooks in Redux
 */
function redux_modify_hooks() {
	if ( class_exists( 'Redux_Connection_Banner' ) ) {
		$instance = Redux_Connection_Banner::init();
		remove_action( 'admin_notices', array( $instance, 'render_banner' ) ); // Remove Extendify Banner.
	}
}

/**
 * Gets product attribute taxonomies
 * 
 * @return array
 */
function redux_get_product_attr_taxonomies() {

	$product_attr_taxonomies = array();

	if ( function_exists( 'electro_get_product_attr_taxonomies' ) ) {
		$product_attr_taxonomies = electro_get_product_attr_taxonomies();
	}

	return $product_attr_taxonomies;
}

require_once get_template_directory() . '/inc/redux-framework/functions/general-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/blog-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/header-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/footer-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/mobile-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/shop-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/navigation-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/style-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/typography-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/custom-code-functions.php';
