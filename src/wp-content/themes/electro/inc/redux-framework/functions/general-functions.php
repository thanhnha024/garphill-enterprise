<?php
/**
 * Filter functions for General Section of Theme Options
 */

if( ! function_exists( 'redux_toggle_scrollup' ) ) {
    function redux_toggle_scrollup() {
        global $electro_options;

        if( isset( $electro_options['scrollup'] ) && $electro_options['scrollup'] == '1' ) {
            $scrollup = true;
        } else {
            $scrollup = false;
        }

        return $scrollup;
    }
}

if( ! function_exists( 'redux_toggle_register_image_size' ) ) {
    function redux_toggle_register_image_size() {
        global $electro_options;

        if( isset( $electro_options['reg_image_size'] ) && $electro_options['reg_image_size'] == '1' ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists( 'redux_toggle_electro_child_style' ) ) {
    function redux_toggle_electro_child_style() {
        global $electro_options;

        if ( isset( $electro_options['load_child_theme'] ) && $electro_options['load_child_theme'] == '1' ) {
            $load = true;
        } else {
            $load = false;
        }

        return $load;
    }
}

if ( ! function_exists( 'redux_apply_home_sidebar_margin_top' ) ) {
    function redux_apply_home_sidebar_margin_top( $sidebar_margin_top ) {
        global $electro_options;

        if( isset( $electro_options['sidebar_margin_top'] ) ) {
            $sidebar_margin_top = $electro_options['sidebar_margin_top'];
        }

        return $sidebar_margin_top;
    }
}

if( ! function_exists( 'redux_wide_enabled' ) ) {
    function redux_wide_enabled() {
        global $electro_options;

        return true;
    }
}


if( ! function_exists( 'redux_dark_enabled' ) ) {
    function redux_dark_enabled() {
        global $electro_options;

        if( isset( $electro_options['dark_enabled'] ) && $electro_options['dark_enabled'] == '1' ) {
            $dark_enabled = true;
        } else {
            $dark_enabled = false;
        }

        return $dark_enabled;
    }
}

if( ! function_exists( 'redux_mode_switcher_enabled' ) ) {
    function redux_mode_switcher_enabled() {
        global $electro_options;

        if( isset( $electro_options['mode_switcher_enabled'] ) && $electro_options['mode_switcher_enabled'] == '1' ) {
            $mode_switcher_enabled = true;
        } else {
            $mode_switcher_enabled = false;
        }

        return $mode_switcher_enabled;
    }
}

if ( ! function_exists( 'redux_apply_dark_logo_image_attr' ) ) {
	function redux_apply_dark_logo_image_attr( $dark_logo_image_attr ) {

		global $electro_options;

		if ( ! empty( $electro_options['site_dark_logo']['url'] ) ) {
			$dark_logo_image_attr = $electro_options['site_dark_logo'];

			if ( is_ssl() ) {
				$dark_logo_image_attr['url'] = str_replace( 'http:', 'https:', $electro_options['site_dark_logo']['url'] );
			}
		}

		return $dark_logo_image_attr;
	}
}
