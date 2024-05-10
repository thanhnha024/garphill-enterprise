<?php
/**
 * Template functions related to Header v13
 */

if ( ! function_exists( 'electro_masthead_v13' ) ) {
	/**
	 * Electro Masthead v13
	 */
	function electro_masthead_v13() {
		?><div class="masthead row align-items-center">
		<?php
		/**
		 * Functions hooked into electro_masthead_v13 action
		 *
		 * @hooked electro_header_logo_area         - 10
		 * @hooked electro_primary_nav_menu         - 20
		 * @hooked electro_header_icons             - 30
		 */
		do_action( 'electro_masthead_v13' );
		?>
		</div>
		<?php
	}
}
