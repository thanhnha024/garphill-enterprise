<?php
/**
 * Layout related functions
 *
 * @package Electro/Structure
 */
if ( ! function_exists( 'electro_get_page_layout_args' ) ) {
	function electro_get_page_layout_args() {

		$args = array();

		if ( is_woocommerce_activated() && is_product() ) {
			$args['layout_name'] = electro_get_single_product_layout();
		}

		return $args;
	}
}

if ( ! function_exists( 'electro_content_wrapper_start' ) ) {
	/**
	 * Display electro content wrapper
	 *
	 */
	function electro_content_wrapper_start() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
		<?php
	}
}

if ( ! function_exists( 'electro_content_wrapper_end' ) ) {
	/**
	 * Display electro content wrapper
	 *
	 */
	function electro_content_wrapper_end() {

		$layout 	= electro_get_blog_layout();
		$sidebar 	= electro_get_sidebar_area();
	?>
		</main>
	</div><!-- /#primary -->

	<?php
		if ( 'left-sidebar' === $layout || 'right-sidebar' === $layout ) {
			do_action( 'electro_sidebar', $sidebar );
		}
	}
}

if ( ! function_exists( 'electro_get_sidebar_area' ) ) {
	function electro_get_sidebar_area() {
		return apply_filters( 'electro_sidebar_area', 'blog' );
	}
}

if ( ! function_exists( 'electro_get_blog_layout' ) ) {
	function electro_get_blog_layout() {
		if ( is_single() ) {
			return electro_get_single_post_layout();
		} else {
			return apply_filters( 'electro_blog_layout', 'right-sidebar' );
		}
	}
}

if ( ! function_exists( 'electro_get_blog_style' ) ) {
	function electro_get_blog_style() {
		return apply_filters( 'electro_blog_style', 'blog-default' );
	}
}

if ( ! function_exists( 'electro_get_single_post_layout' ) ) {
	function electro_get_single_post_layout() {
		return apply_filters( 'electro_single_post_layout', 'right-sidebar' );
	}
}

if ( ! function_exists( 'electro_get_sidebar' ) ) {
	/**
	 * Display electro sidebar
	 * @uses get_sidebar()
	 *
	 */
	function electro_get_sidebar( $name = null ) {
		get_sidebar( $name );
	}
}

if ( ! function_exists( 'electro_is_wide_enabled' ) ) {
	/**
	 * Option to toggle wide
	 */
	function electro_is_wide_enabled() {
		return apply_filters( 'electro_is_wide_enabled', true );
	}
}

if ( ! function_exists( 'electro_is_dark_enabled' ) ) {
	/**
	 * Option to toggle dark
	 */
	function electro_is_dark_enabled() {
		return apply_filters( 'electro_is_dark_enabled', true );
	}
}