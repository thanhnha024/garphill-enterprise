<?php
/**
 * ACF Hooks related to Home v12 meta fields.
 */

add_filter( 'electro_home_v12_page_content_options', 'electro_acf_get_home_v12_page_content_options',             10 );
add_filter( 'electro_home_v12_slider_options', 'electro_acf_get_home_v12_slider_options',                         10 );
add_filter( 'electro_home_v12_categories_options', 'electro_acf_get_home_v12_categories_options',                 10 );
add_filter( 'electro_home_v12_hot_products_options', 'electro_acf_get_home_v12_hot_products_options',             10 );
add_filter( 'electro_home_v12_banners_options', 'electro_acf_get_home_v12_banners_options',                       10 );
add_filter( 'electro_home_v12_new_products_options', 'electro_acf_get_home_v12_new_products_options',             10 );
add_filter( 'electro_home_v12_recommend_products_options', 'electro_acf_get_home_v12_recommend_products_options', 10 );
add_filter( 'electro_home_v12_blog_posts_options', 'electro_acf_get_home_v12_blog_post_options',                  10 );
add_filter( 'electro_home_v12_brands_options', 'electro_acf_get_home_v11_brands_options',                         10 );
