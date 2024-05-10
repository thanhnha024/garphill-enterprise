<?php
/**
 * Electro Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Electro_Admin class.
 */
class Electro_Admin {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'admin_menu', array( $this, 'remove_pages' ), 20 );
		if ( defined( 'RS_PLUGIN_SLUG_PATH' ) ) {
			add_filter( 'plugin_action_links_' . RS_PLUGIN_SLUG_PATH, array( $this, 'remove_plugin_action_links' ), 20 );
		}
	}

	/**
	 * Remove Submenu pages added by third-party plugins.
	 */
	public function remove_pages() {
		remove_submenu_page( 'revslider', 'revslider-buy-license' );
		remove_submenu_page( 'revslider', 'revslider-templates' );
		remove_submenu_page( 'revslider', 'revslider-ticket' );
	}

	/**
	 * Remove plugin action links.
	 *
	 * @param array $links - Action links list.
	 * @return array
	 */
	public function remove_plugin_action_links( $links ) {
		unset( $links['go_premium'] );
		return $links;
	}

	/**
	 * Include any classes we need within admin
	 */
	public function includes() {
		include_once( 'electro-admin-functions.php' );
		include_once( 'electro-meta-box-functions.php' );
		include_once( 'class-electro-admin-meta-boxes.php' );
		include_once( 'class-electro-admin-assets.php' );

		// Help Tabs
		if ( apply_filters( 'electro_enable_admin_help_tab', true ) ) {
			//include_once( 'class-wc-admin-help.php' );
		}

		$this->load_meta_boxes();
	}

	public function load_meta_boxes() {
		include_once( 'meta-boxes/class-electro-meta-box-home-v1.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v2.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v3.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v4.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v5.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v6.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v7.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v8.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-v9.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-mobile-v1.php' );
		include_once( 'meta-boxes/class-electro-meta-box-home-mobile-v2.php' );
		include_once( 'meta-boxes/class-electro-meta-box-page.php' );
	}
}

return new Electro_Admin();
