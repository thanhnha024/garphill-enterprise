<?php
/**
 * Template functions used in header v5
 */

if ( ! function_exists( 'electro_navigation_v5' ) ) {
	/**
	 * Display Header v5 navigation
	 */
	function electro_navigation_v5() {
		?><div class="electro-navigation-v5">
			<div class="container">
				<div class="electro-navigation row">
					<?php
					/**
					 * Hook Electro navigation v5.
					 *
					 * @hooked electro_departments_menu_v2 - 10
					 * @hooked electro_secondary_nav_menu  - 20
					 */
					do_action( 'electro_navigation_v5' );
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
