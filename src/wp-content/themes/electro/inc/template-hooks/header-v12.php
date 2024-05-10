<?php
/**
 * Template hooks used in header v12
 */

add_action( 'electro_header_v12', 'electro_masthead_v12', 10 );

/**
 * Masthead
 */
add_action( 'electro_masthead_v12', 'electro_header_logo_area',         10 );
add_action( 'electro_masthead_v12', 'electro_primary_nav_menu',         20 );
add_action( 'electro_masthead_v12', 'electro_header_v12_navbar_search', 30 );
add_action( 'electro_masthead_v12', 'electro_header_icons',             40 );
