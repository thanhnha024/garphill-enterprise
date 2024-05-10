<?php
/**
 * Electro ACF Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Electro_ACF' ) ) {

	/**
	 * The Electro ACF Integration class
	 */
	class Electro_ACF {

		/**
		 * Setup class.
		 */
		public function __construct() {
			$this->includes();
		}

		/**
		 * Include settings.
		 */
		public function includes() {
			if ( function_exists( 'acf_add_local_field_group' ) ) {
				$settings = [ 'home-v10', 'home-v11', 'home-v12', 'page', 'product-category', 'product-attribute' ];
				foreach ( $settings as $setting ) {
					require get_template_directory() . '/inc/acf/settings/' . $setting . '.php';
				}
			}
		}
	}
}

return new Electro_ACF();