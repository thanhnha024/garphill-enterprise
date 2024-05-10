<?php
/**
 * Template tags used in Header v4
 */

if ( ! function_exists( 'electro_header_v4_wrapper_open' ) ) {
	/**
	 * Output wrapper start for Header v4.
	 */
	function electro_header_v4_wrapper_open() {
		?><div class="full-color-background">
		<?php
	}
}

if ( ! function_exists( 'electro_header_v4_wrapper_close' ) ) {
	/**
	 * Output wrapper end for header v4.
	 */
	function electro_header_v4_wrapper_close() {
		?>
		</div><!-- /.full-color-background -->
		<?php
	}
}
