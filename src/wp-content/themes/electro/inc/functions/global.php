<?php
/**
 * Functions used globally across the theme.
 */

 /**
  * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
  * Non-scalar values are ignored.
  *
  * @param string|array $var Data to sanitize.
  * @return string|array
  */
function ec_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'ec_clean', $var );
	} else {
		return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
	}
}

/**
 * Renders attributes.
 *
 * @param array $attr array of attributes to be rendered.
 */
function electro_render_attributes( $attr ) {
	$attributes = electro_get_render_attributes( $attr );
	echo $attributes; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Gets attributes rendered as a string.
 *
 * @param  array $attr array of attributes to be rendered.
 * @return string
 */
function electro_get_render_attributes( $attr ) {
	$rendered_attr = [];

	foreach ( $attr as $key => $val ) {
		if ( is_array( $val ) ) {
			$val = implode( ' ', $val );
		}

		$rendered_attr[] = sprintf( '%1$s="%2$s"', $key, esc_attr( $val ) );
	}

	return implode( ' ', $rendered_attr );
}
