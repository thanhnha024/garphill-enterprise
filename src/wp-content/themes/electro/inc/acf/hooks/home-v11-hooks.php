<?php
/**
 * ACF Hooks related to Home v11 meta fields.
 */

add_filter( 'electro_home_v11_general_options', 'electro_acf_get_home_v11_general_options', 10 );
add_filter( 'electro_home_v11_slider_options', 'electro_acf_get_home_v11_slider_options', 10 );
add_filter( 'electro_home_v11_bwc_options', 'electro_acf_get_home_v11_bwc_options', 10 );
add_filter( 'electro_home_v11_bwpc_options', 'electro_acf_get_home_v11_bwpc_options', 10 );
add_filter( 'electro_home_v11_two_banners_options', 'electro_acf_get_home_v11_two_banners_options', 10 );
add_filter( 'electro_home_v11_products_carousel_options', 'electro_acf_get_home_v11_products_carousel_options', 10 );
add_filter( 'electro_home_v11_trending_products_carousel_options', 'electro_acf_get_home_v11_trending_products_carousel_options', 10 );