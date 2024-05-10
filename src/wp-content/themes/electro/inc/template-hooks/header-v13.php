<?php
/**
 * Template hooks used in header v13
 */

add_action( 'electro_header_v13', 'electro_masthead_v13', 10 );

/**
 * Masthead
 */
add_action( 'electro_masthead_v13', 'electro_header_logo_area', 10 );
add_action( 'electro_masthead_v13', 'electro_primary_nav_menu', 20 );
add_action( 'electro_masthead_v13', 'electro_header_icons', 30 );
