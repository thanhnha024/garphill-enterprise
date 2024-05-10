<?php
/**
 * Template functions related to Header v11
 */

if ( ! function_exists( 'electro_masthead_v11' ) ) {

    function electro_masthead_v11() {
        ?><div class="masthead row align-items-center"><?php
        /**
         * @hooked electro_header_logo_area     - 10
         * @hooked electro_navbar_search        - 20
         * @hooked electro_header_icons         - 30
         */
        do_action( 'electro_masthead_v11' ); ?></div><?php
    }
}
