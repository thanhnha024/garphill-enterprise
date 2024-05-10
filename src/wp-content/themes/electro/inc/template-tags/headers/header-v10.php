<?php
/**
 * Template functions related to Header v10
 */

if ( ! function_exists( 'electro_masthead_v10' ) ) {
	/**
	 * Display masthead
	 *
	 * @since 2.0
	 */
	function electro_masthead_v10() {
		?><div class="masthead row align-items-center">
		<?php
		/**
		 * Electro Masthead v10.
		 *
		 * @hooked electro_header_logo_area - 10
		 * @hooked electro_primary_nav_menu - 20
		 * @hooked electro_header_support   - 30
		 */
		do_action( 'electro_masthead_v10' );
		?>
		</div>
		<?php
	}
}