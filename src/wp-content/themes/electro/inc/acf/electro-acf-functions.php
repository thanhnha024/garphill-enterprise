<?php
/**
 * Electro ACF Functions
 *
 * @package  electro
 */

if ( ! function_exists( 'electro_get_field' ) ) {
	/**
	 * Wrapper for ACF's get_field function.
	 *
	 * @param string   $field custom field key.
	 * @param int|bool $post_id ID of the post.
	 * @param bool     $format_value should format the meta value or not.
	 * @return mixed
	 */
	function electro_get_field( $field, $post_id = false, $format_value = true ) {
		if ( function_exists( 'get_field' ) ) {
			return get_field( $field, $post_id, $format_value );
		}

		return false;
	}
}


if ( ! function_exists( 'electro_acf_get_page_additional_classes' ) ) {
	/**
	 * Get Additional classes for page.
	 */
	function electro_acf_get_page_additional_classes() {
		return electro_get_field( 'css_classes' );
	}
}

/**
 * Get cover image for the product category.
 *
 * @param WP_Term $term Term object.
 * @return string
 */
function electro_acf_get_product_category_cover_image_url( $term ) {
	return electro_get_field( 'product_cat_cover_image', $term );
}

/**
 * Get cover image for the product attribute.
 *
 * @param WP_Term $term Term object.
 * @return string
 */
function electro_acf_get_product_attribute_cover_image_url( $term ) {
	return electro_get_field( 'product_attribute_cover_image', $term );
}

require_once get_template_directory() . '/inc/acf/functions/home-v10-functions.php';
require_once get_template_directory() . '/inc/acf/functions/home-v11-functions.php';
require_once get_template_directory() . '/inc/acf/functions/home-v12-functions.php';
