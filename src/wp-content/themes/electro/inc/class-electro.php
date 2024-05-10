<?php
/**
 * Electro Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Electro' ) ) :

	/**
	 * The main Electro class
	 */
	class Electro {

		/**
		 * Setup Class
		 */
		public function __construct() {
			add_filter( 'body_class', array( $this, 'body_classes' ) );
			add_action( 'admin_menu', array( $this, 'add_custom_css_page' ) );
			add_action( 'vc_before_init', array( $this, 'set_vc_as_theme' ) );
			add_action( 'elementor/theme/register_locations', [ $this, 'register_elementor_locations' ] );
			add_action( 'after_setup_theme', [ $this, 'setup' ] );
			add_filter( 'transient_wpforms_activation_redirect', '__return_false' );
		}

		/**
		 * Setup Electro theme.
		 *
		 * @since 3.0.5
		 */
		public function setup() {
			remove_theme_support( 'widgets-block-editor' );
		}

		/**
		 * Registers Elementor locations
		 *
		 * @param object $elementor_theme_manager The elementor theme manager.
		 */
		public function register_elementor_locations( $elementor_theme_manager ) {

			$elementor_theme_manager->register_all_core_location();

			$elementor_theme_manager->register_location(
				'sidebar',
				[
					'label' => esc_html__( 'Sidebar Blog', 'electro' ),
				]
			);

			$elementor_theme_manager->register_location(
				'sidebar-home',
				[
					'label' => esc_html__( 'Sidebar Home', 'electro' ),
				]
			);
			$elementor_theme_manager->register_location(
				'sidebar-shop',
				[
					'label' => esc_html__( 'Sidebar Shop', 'electro' ),
				]
			);
			$elementor_theme_manager->register_location(
				'sidebar-store',
				[
					'label' => esc_html__( 'Sidebar Store', 'electro' ),
				]
			);
		}

		/**
		 * Sets Visual Composer as theme.
		 */
		public function set_vc_as_theme() {
			vc_set_as_theme();
		}

		/**
		 * Add custom CSS page.
		 */
		public function add_custom_css_page() {
			if ( apply_filters( 'electro_should_add_custom_css_page', false ) ) {
				add_submenu_page( 'themes.php', 'Custom Color CSS', 'Custom Color CSS', 'manage_options', 'custom-primary-color-css-page', 'electro_custom_primary_color_page' );
			}
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			$show_breadcrumb = apply_filters( 'electro_show_breadcrumb', true );

			if ( ! $show_breadcrumb || ( ! function_exists( 'woocommerce_breadcrumb' ) && ! function_exists( 'electro_breadcrumb' ) ) ) {
				$classes[] = 'no-breadcrumb';
			}

			$layout_args = $this->get_layout_args();

			if ( isset( $layout_args['layout_name'] ) ) {
				$classes[] = $layout_args['layout_name'];
			}

			if ( isset( $layout_args['body_classes'] ) ) {
				$classes[] = $layout_args['body_classes'];
			}

			if ( ( electro_is_dark_enabled() && ! isset( $_COOKIE[ 'viewSwitcher' ] ) ) || ( isset( $_COOKIE[ 'viewSwitcher' ] ) && 'enabled' === $_COOKIE[ 'viewSwitcher' ] && 'disabled' !== $_COOKIE[ 'viewSwitcher' ] ) ) {
				$classes[] = 'electro-dark';
			}

			if ( electro_is_acf_activated() && function_exists( 'electro_acf_get_page_additional_classes' ) && ! empty( electro_acf_get_page_additional_classes() ) ) {
				$classes[] = electro_acf_get_page_additional_classes();
			}

			return $classes;
		}

		/**
		 * Get layout arguments
		 *
		 * @return array
		 */
		public function get_layout_args() {

			$args = array();

			$is_default_homepage = is_front_page() && is_home();
			$is_static_homepage  = is_front_page();

			if ( is_woocommerce_activated() && is_woocommerce() ) {

				if ( is_product() ) {
					$args['layout_name']  = electro_get_single_product_layout();
					$args['body_classes'] = electro_get_single_product_style();
				} elseif ( is_shop() || is_product_category() || is_tax( 'product_label' ) || is_tax( get_object_taxonomies( 'product' ) ) ) {
					$args['layout_name'] = electro_get_shop_layout();
				}
			} elseif ( ! $is_default_homepage && ! $is_static_homepage && is_home() ) {
				// Blog Page.
				$args['layout_name']  = electro_get_blog_layout();
				$args['body_classes'] = electro_get_blog_style();

			} elseif ( ! is_page() ) {

				$args['layout_name']  = electro_get_blog_layout();
				$args['body_classes'] = electro_get_blog_style();
			}
			return $args;
		}
	}

endif;

return new Electro();
