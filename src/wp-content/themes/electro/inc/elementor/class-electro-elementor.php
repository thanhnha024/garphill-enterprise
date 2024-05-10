<?php
/**
 * Electro - Elementor Compatibility
 *
 * @package electro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Electro_Elementor' ) ) {

	/**
	 * The Electro Elementor Integration class.
	 */
	class Electro_Elementor {

		/**
		 * Setup class.
		 */
		public function __construct() {
			update_option( 'elementor_onboarded', true );
		}
	}
}

return new Electro_Elementor();
