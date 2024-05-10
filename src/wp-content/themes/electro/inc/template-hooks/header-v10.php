<?php
/**
 * Template hooks used in header v10
 */

add_action( 'electro_header_v10', 'electro_masthead_v10', 10 );
add_action( 'electro_header_v10', 'electro_secondary_nav_menu', 20 );

add_action( 'electro_masthead_v10', 'electro_header_logo_area',      10 );
add_action( 'electro_masthead_v10', 'electro_navbar_search',         20 );
add_action( 'electro_masthead_v10', 'electro_header_icons',          30 );