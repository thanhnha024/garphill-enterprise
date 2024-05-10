<?php
/**
 * Template functions related to Header v12
 */

if ( ! function_exists( 'electro_masthead_v12' ) ) {

    function electro_masthead_v12() {
        ?><div class="masthead row align-items-center"><?php
        /**
         * @hooked electro_header_logo_area         - 10
         * @hooked electro_primary_nav_menu         - 20
         * @hooked electro_header_v12_navbar_search - 30
         * @hooked electro_header_icons             - 30
         */
        do_action( 'electro_masthead_v12' ); ?></div><?php
    }
}
