<?php
/**
 * Functions used in Header v3
 */

if ( ! function_exists( 'electro_header_v12_navbar_search' ) ) {
	/**
	 * Displays search box in navbar
	 */
	function electro_header_v12_navbar_search() {
		
		add_filter( 'electro_enable_search_categories_filter', '__return_false' );

        ?><div class="col-auto d-xl-none d-xxl-block" style="max-width:256px;"><?php
            electro_navbar_search();
        ?></div><?php
	}
}
