<?php
/**
 * Template hooks used in header v11
 */

add_action( 'electro_header_v11', 'electro_masthead_v11', 10 );
add_action( 'electro_header_v11', 'electro_secondary_nav_menu', 20 );

/**
 * Masthead
 */
add_action( 'electro_masthead_v11', 'electro_header_logo_area',  10 );
add_action( 'electro_masthead_v11', 'electro_navbar_search',     20 );
add_action( 'electro_masthead_v11', 'electro_header_icons',      30 );