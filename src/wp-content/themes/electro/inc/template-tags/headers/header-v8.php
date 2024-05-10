<?php
/**
 * Template functions related to Header v8
 */

if ( ! function_exists( 'electro_masthead_v4' ) ) {
	/**
	 * Display masthead v4 displayed in Header v8.
	 */
	function electro_masthead_v4() {
		?><div class="masthead row align-items-center">
		<?php
		/**
		 * Hook electro_masthead_v4.
		 *
		 * @hooked electro_header_logo_area     - 10
		 * @hooked electro_navbar_search        - 20
		 * @hooked electro_secondary_nav_menu   - 30
		 * @hooked electro_header_icons         - 40
		 */
		do_action( 'electro_masthead_v4' );
		?>
		</div>
		<?php
	}
}
