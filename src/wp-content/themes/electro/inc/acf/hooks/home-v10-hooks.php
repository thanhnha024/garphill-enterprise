<?php
/**
 * ACF Hooks related to Home v10 meta fields.
 */

add_filter( 'electro_home_v10_general_options', 'electro_acf_get_home_v10_general_options', 10 );
add_filter( 'electro_home_v10_swadb_options', 'electro_acf_get_home_v10_swadb_options', 10 );
add_filter( 'electro_home_v10_swpb_options', 'electro_acf_get_home_v10_swpb_options', 10 );