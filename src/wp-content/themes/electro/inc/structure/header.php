<?php
/**
 * Functions and template tags used in theme header
 */

if ( ! function_exists( 'electro_enqueue_styles' ) ) {
	/**
	 * Enqueues all styles used by the theme
	 */
	function electro_enequeue_styles() {

		global $electro_version;

		if ( apply_filters( 'electro_load_default_fonts', true ) ) {
			wp_enqueue_style( 'electro-fonts', electro_fonts_url(), array(), null ); //phpcs:ignore
		}

		$css_vendors = apply_filters(
			'electro_css_vendors',
			array(
				'font-electro' => 'font-electro.css',
			)
		);

		foreach ( $css_vendors as $handle => $css_file ) {
			wp_enqueue_style( $handle, get_template_directory_uri() . '/assets/css/' . $css_file, '', $electro_version );
		}

		// FontAwesome.
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/vendor/fontawesome/css/all.min.css', '', $electro_version );

		// Animate.css.
		wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/assets/vendor/animate.css/animate.min.css', '', $electro_version );

		if ( is_rtl() ) {
			wp_enqueue_style( 'electro-rtl-style', get_template_directory_uri() . '/style-rtl.min.css', '', $electro_version );
		} else {
			wp_enqueue_style( 'electro-style', get_template_directory_uri() . '/style.min.css', '', $electro_version );
		}

		if ( is_child_theme() && apply_filters( 'electro_load_child_theme', true ) ) {
			wp_enqueue_style( 'electro-child-style', get_stylesheet_uri(), '', $electro_version );
		}

		if ( apply_filters( 'electro_use_predefined_colors', true ) ) {
			$color_css_file = apply_filters( 'electro_primary_color', 'yellow' );
			wp_enqueue_style( 'electro-color', get_template_directory_uri() . '/assets/css/colors/' . $color_css_file . '.min.css', '', $electro_version );
		}

		if ( is_elementor_activated() ) {
			wp_enqueue_style( 'electro-elementor-style', get_template_directory_uri() . '/elementor.css', '', $electro_version );
		}

		wp_dequeue_style( 'wcqi-css' );
	}
}

if ( ! function_exists( 'electro_enqueue_scripts' ) ) {
	/**
	 * Enqueues all scripts used by the theme
	 */
	function electro_enqueue_scripts() {

		global $electro_version;

		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), $electro_version, true );

		$waypoints_js_handler = function_exists( 'is_elementor_activated' ) && is_elementor_activated() ? 'elementor-waypoints' : 'waypoints-js';
		wp_enqueue_script( $waypoints_js_handler, get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array( 'jquery' ), $electro_version, true );

		if ( apply_filters( 'electro_enable_sticky_header', true ) || apply_filters( 'electro_enable_hh_sticky_header', false ) ) {
			wp_enqueue_script( 'waypoints-sticky-js', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array( 'jquery' ), $electro_version, true );
		}

		if ( apply_filters( 'electro_enable_live_search', false ) ) {
			wp_enqueue_script( 'typeahead', get_template_directory_uri() . '/assets/js/typeahead.bundle.min.js', array( 'jquery' ), $electro_version, true );
			wp_enqueue_script( 'handlebars', get_template_directory_uri() . '/assets/js/handlebars.min.js', array( 'typeahead' ), $electro_version, true );
		}

		wp_enqueue_script( 'electro-js', get_template_directory_uri() . '/assets/js/electro.min.js', array( 'jquery', 'bootstrap-js' ), $electro_version, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), $electro_version, true );

		$admin_ajax_url = admin_url( 'admin-ajax.php' );
		$current_lang   = apply_filters( 'wpml_current_language', null );

		if ( $current_lang ) {
			$admin_ajax_url = add_query_arg( 'lang', $current_lang, $admin_ajax_url );
		}

		$electro_options = apply_filters(
			'electro_localize_script_data',
			array(
				'rtl'                     => is_rtl() ? '1' : '0',
				'ajax_url'                => $admin_ajax_url,
				'ajax_loader_url'         => get_template_directory_uri() . '/assets/images/ajax-loader.gif',
				'enable_sticky_header'    => apply_filters( 'electro_enable_sticky_header', true ),
				'enable_hh_sticky_header' => apply_filters( 'electro_enable_hh_sticky_header', false ),
				'enable_live_search'      => apply_filters( 'electro_enable_live_search', false ),
				'live_search_limit'       => apply_filters( 'electro_live_search_limit', 10 ),
				'live_search_template'    => apply_filters( 'electro_live_search_template', '<a href="{{url}}" class="media live-search-media"><img src="{{image}}" class="media-left media-object flip float-start" height="60" width="60"><div class="media-body"><p>{{{value}}}</p></div></a>' ),
				'live_search_empty_msg'   => apply_filters( 'electro_live_search_empty_msg', esc_html__( 'Unable to find any products that match the current query', 'electro' ) ),
				'deal_countdown_text'     => apply_filters(
					'electro_deal_countdown_timer_clock_text',
					array(
						'days_text'  => esc_html__( 'Days', 'electro' ),
						'hours_text' => esc_html__( 'Hours', 'electro' ),
						'mins_text'  => esc_html__( 'Mins', 'electro' ),
						'secs_text'  => esc_html__( 'Secs', 'electro' ),
					)
				),
				'typeahead_options'       => array(
					'hint'      => false,
					'highlight' => true,
				),
				'offcanvas_mcs_options'   => array(
					'axis'               => 'y',
					'theme'              => 'minimal-dark',
					'contentTouchScroll' => 100,
					'scrollInertia'      => 1500,
				),
			)
		);

		wp_localize_script( 'electro-js', 'electro_options', $electro_options );
	}
}

if ( ! function_exists( 'electro_fonts_url' ) ) {
	/**
	 * Register Google Fonts for Electro
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function electro_fonts_url() {

		$fonts_url = '';

		if ( apply_filters( 'electro/enable_inter', true ) ) {
			$fonts_url = 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap';
		} else {
			$fonts_url = 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap';
		}

		$fonts_url = apply_filters( 'electro_google_fonts', $fonts_url );

		return $fonts_url;
	}
}

if ( ! function_exists( 'electro_scripts' ) ) {
	/**
	 * Enqueues styles and scripts used by the theme
	 */
	function electro_scripts() {

		// Enqueue styles.
		electro_enequeue_styles();

		// Enqueue scripts.
		electro_enqueue_scripts();
	}
}

if ( ! function_exists( 'electro_remove_locale_stylesheet' ) ) {
	/**
	 * Dequeue locale styles
	 */
	function electro_remove_locale_stylesheet() {
		remove_action( 'wp_head', 'locale_stylesheet' );
	}
}

if ( ! function_exists( 'electro_get_header' ) ) {
	/**
	 * Get Electro Header.
	 *
	 * @param string $header header.
	 */
	function electro_get_header( $header = '' ) {
		$header_style = apply_filters( 'electro_header_style', 'v1' );

		if ( ! empty( $header ) ) {
			$header_style = $header;
		}

		get_header( $header_style );
	}
}

if ( ! function_exists( 'electro_mode_switcher' ) ) {
	/**
	 * Electro Mode Switcher.
	 */
	function electro_mode_switcher() {
		if ( apply_filters( 'electro_enable_mode_switcher', true ) ) :
			?><div class="electro-mode-switcher">
			<a class="data-block electro-mode-switcher-item dark" href="#dark" data-mode="dark">
				<span class="d-block electro-mode-switcher-item-state"><?php echo esc_html__( 'Dark', 'electro' ); ?></span>
			</a>
			<a class="d-block electro-mode-switcher-item light" href="#light" data-mode="light">
				<span class="d-block electro-mode-switcher-item-state"><?php echo esc_html__( 'Light', 'electro' ); ?></span>
			</a>
		</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_skip_links' ) ) {
	/**
	 * Skip Links
	 */
	function electro_skip_links() {
		?>
		<a class="skip-link screen-reader-text visually-hidden" href="#site-navigation"><?php _e( 'Skip to navigation', 'electro' ); //phpcs:ignore?></a>
		<a class="skip-link screen-reader-text visually-hidden" href="#content"><?php _e( 'Skip to content', 'electro' ); //phpcs:ignore?></a>
		<?php
	}
}

if ( ! function_exists( 'has_electro_mobile_header' ) ) {
	/**
	 * Load Different Header for Mobile
	 */
	function has_electro_mobile_header() {
		return apply_filters( 'has_electro_mobile_header', true );
	}
}

if ( ! function_exists( 'electro_top_bar' ) ) {
	/**
	 * Displays Top Bar
	 */
	function electro_top_bar() {

		if ( is_page_template( 'template-homepage-v5.php' ) ) {
			$top_bar_classes = 'top-bar top-bar-v1';
		} else {
			$top_bar_classes = 'top-bar';
		}

		if ( apply_filters( 'electro_enable_top_bar', true ) ) :
			?>

			<?php

			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}

			?>

		<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
			<div class="container clearfix">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'topbar-left',
						'container'      => false,
						'depth'          => 2,
						'menu_class'     => 'nav nav-inline float-start electro-animate-dropdown flip',
						'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
						'walker'         => new wp_bootstrap_navwalker(),
					)
				);

				wp_nav_menu(
					array(
						'theme_location' => 'topbar-right',
						'container'      => false,
						'depth'          => 2,
						'menu_class'     => 'nav nav-inline float-end electro-animate-dropdown flip',
						'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
						'walker'         => new wp_bootstrap_navwalker(),
					)
				);
			?>
			</div>
		</div><!-- /.top-bar -->

			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_top_bar_center' ) ) {
	/**
	 * Displays Top Bar Center
	 */
	function electro_top_bar_center() {

		$top_bar_classes = 'top-bar top-bar-center';

		if ( apply_filters( 'electro_enable_top_bar', true ) ) {

			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}
			?>

			<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
				<div class="container clearfix">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'topbar-center',
							'container'      => false,
							'depth'          => 2,
							'menu_class'     => 'nav nav-inline',
							'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
							'walker'         => new wp_bootstrap_navwalker(),
						)
					);
				?>
				</div>
			</div><!-- /.top-bar -->

			<?php
		}
	}
}

if ( ! function_exists( 'electro_top_bar_v2' ) ) {
	/**
	 * Displays Top Bar v2
	 */
	function electro_top_bar_v2() {

		$top_bar_classes = 'top-bar top-bar-v2';

		if ( apply_filters( 'electro_enable_top_bar', true ) ) :
			?>

			<?php

			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}

			?>

		<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
			<div class="container clearfix">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'header-support',
						'container'      => false,
						'depth'          => 2,
						'menu_class'     => 'nav nav-inline float-start electro-animate-dropdown flip',
						'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
						'walker'         => new wp_bootstrap_navwalker(),
					)
				);

				wp_nav_menu(
					array(
						'theme_location' => 'topbar-right',
						'container'      => false,
						'depth'          => 2,
						'menu_class'     => 'nav nav-inline float-end electro-animate-dropdown flip',
						'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
						'walker'         => new wp_bootstrap_navwalker(),
					)
				);
			?>
			</div>
		</div><!-- /.top-bar-v2 -->

			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_top_bar_v3' ) ) {
	/**
	 * Displays Top Bar v3
	 */
	function electro_top_bar_v3() {

		$top_bar_classes = 'top-bar top-bar-v3';

		if ( apply_filters( 'electro_enable_top_bar', true ) ) :
			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}

			$enable_topbar_additional_links = apply_filters( 'electro_enable_top_bar_v3_additional_links', true );
			?>
			<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
				<div class="container clearfix position-relative">
					<?php
					if ( $enable_topbar_additional_links ) {
						$topbar_additional_links_title = apply_filters( 'electro_top_bar_v3_additional_links_title', __( 'Two Shops<br>One Shipment', 'electro' ) );

						$topbar_additional_link_1_text  = apply_filters( 'electro_top_bar_v3_additional_link_1_text', esc_html__( 'Electronics', 'electro' ) );
						$topbar_additional_link_1_url   = apply_filters( 'electro_top_bar_v3_additional_link_1_url', '#' );
						$topbar_additional_link_1_image = apply_filters( 'electro_top_bar_v3_additional_link_1_image', '' );

						$topbar_additional_link_2_text  = apply_filters( 'electro_top_bar_v3_additional_link_2_text', esc_html__( 'Power Tools', 'electro' ) );
						$topbar_additional_link_2_url   = apply_filters( 'electro_top_bar_v3_additional_link_2_url', '#' );
						$topbar_additional_link_2_image = apply_filters( 'electro_top_bar_v3_additional_link_2_image', '' );

						if ( ! empty( $topbar_additional_links_title ) ) {
							?>
							<span class="additional-links-label position-absolute r-100 text-end d-flex align-items-center"><?php echo wp_kses_post( $topbar_additional_links_title ); ?></span>
							<?php
						}
						if ( ( ! empty( $topbar_additional_link_1_text ) && ! empty( $topbar_additional_link_1_url ) ) || ( ! empty( $topbar_additional_link_2_text ) && ! empty( $topbar_additional_link_2_url ) ) ) {
							?>
							<ul class="additional-links float-start list-unstyled mb-0 d-flex align-items-center position-relative">
							<?php
							if ( ( ! empty( $topbar_additional_link_1_text ) && ! empty( $topbar_additional_link_1_url ) ) ) {
								?>
									<li class="additional-item">
										<a class="additional-item-link d-flex align-items-center" href="<?php echo esc_attr( $topbar_additional_link_1_url ); ?>">
								<?php
								if ( ! empty( $topbar_additional_link_1_image ) && $topbar_additional_link_1_image > 0 ) {
									echo wp_get_attachment_image( $topbar_additional_link_1_image, array( '30', '30' ), false, array( 'class' => 'img-fluid' ) );
								}
								?>
											<span class="additional-item-label"><?php echo wp_kses_post( $topbar_additional_link_1_text ); ?></span>
										</a>
									</li>
																<?php
							}

							if ( ( ! empty( $topbar_additional_link_2_text ) && ! empty( $topbar_additional_link_2_url ) ) ) {
								?>
									<li class="additional-item">
										<a class="additional-item-link d-flex align-items-center" href="<?php echo esc_attr( $topbar_additional_link_2_url ); ?>">
								<?php
								if ( ! empty( $topbar_additional_link_2_image ) && $topbar_additional_link_2_image > 0 ) {
									echo wp_get_attachment_image( $topbar_additional_link_2_image, array( '30', '30' ), false, array( 'class' => 'img-fluid' ) );
								}
								?>
											<span class="additional-item-label"><?php echo wp_kses_post( $topbar_additional_link_2_text ); ?></span>
										</a>
									</li>
																<?php
							}
							?>
							</ul>
							<?php
						}
					}
					?>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'header-support',
							'container'      => false,
							'depth'          => 2,
							'menu_class'     => 'nav nav-inline float-start electro-animate-dropdown flip',
							'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
							'walker'         => new wp_bootstrap_navwalker(),
						)
					);
					?>

					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'topbar-right',
							'container'      => false,
							'depth'          => 2,
							'menu_class'     => 'nav nav-inline float-end electro-animate-dropdown flip',
							'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
							'walker'         => new wp_bootstrap_navwalker(),
						)
					);
					?>
				</div>
			</div><!-- /.top-bar-v3 -->

			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_top_bar_v4' ) ) {
	/**
	 * Displays Top Bar v4
	 */
	function electro_top_bar_v4() {

		$top_bar_classes = 'top-bar top-bar-v4 bg-light border-0';

		if ( apply_filters( 'electro_enable_top_bar', true ) ) :

			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}

			?>
			<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
				<div class="container clearfix">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'topbar-left',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-start electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);

						wp_nav_menu(
							array(
								'theme_location' => 'topbar-right',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-end electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);
					?>
				</div>
			</div><!-- /.top-bar-v2 -->
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_top_bar_v5' ) ) {
	/**
	 * Displays Top Bar v5
	 */
	function electro_top_bar_v5() {

		$top_bar_classes = 'top-bar top-bar-v5 bg-transparent border-0';

		if ( apply_filters( 'electro_enable_top_bar', true ) ) :

			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}

			?>
			<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
				<div class="container clearfix">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'topbar-left',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-start electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);

						wp_nav_menu(
							array(
								'theme_location' => 'topbar-right',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-end electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);
					?>
				</div>
			</div><!-- /.top-bar-v2 -->
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_top_bar_v6' ) ) {
	/**
	 * Displays Top Bar v6
	 */
	function electro_top_bar_v6() {

		$top_bar_classes = 'top-bar top-bar-v6 border-bottom-0';

		if ( apply_filters( 'electro_enable_top_bar', true ) ) :

			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}

			?>
			<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
				<div class="container clearfix">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'topbar-left',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-start electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);

						wp_nav_menu(
							array(
								'theme_location' => 'topbar-right',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-end electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);
					?>
				</div>
			</div><!-- /.top-bar-v2 -->
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_top_bar_v7' ) ) {
	/**
	 * Displays Top Bar v6
	 */
	function electro_top_bar_v7() {

		$top_bar_classes = 'top-bar top-bar-v7 border-bottom-0';

		if ( apply_filters( 'electro_enable_top_bar', true ) ) :

			if ( has_electro_mobile_header() ) {
				if ( apply_filters( 'electro_hide_top_bar_in_mobile', true ) ) {
					$top_bar_classes .= ' hidden-lg-down d-none d-xl-block';
				}
			}

			?>
			<div class="<?php echo esc_attr( $top_bar_classes ); ?>">
				<div class="container clearfix">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'topbar-left',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-start electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);

						wp_nav_menu(
							array(
								'theme_location' => 'topbar-right',
								'container'      => false,
								'depth'          => 2,
								'menu_class'     => 'nav nav-inline float-end electro-animate-dropdown flip',
								'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
								'walker'         => new wp_bootstrap_navwalker(),
							)
						);
					?>
				</div>
			</div><!-- /.top-bar-v2 -->
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_container_wrap_start' ) ) {
	/**
	 * Prints Electro container wrapper
	 */
	function electro_container_wrap_start() {
		?>
		<div class="container">
		<?php
	}
}

if ( ! function_exists( 'electro_container_wrap_end' ) ) {
	/**
	 * Closes container wrapper
	 */
	function electro_container_wrap_end() {
		?>
		</div><!-- /.container -->
		<?php
	}
}

if ( ! function_exists( 'electro_header_dark_logo' ) ) {
	/**
	 * Displays theme dark logo.
	 *
	 * @param string $anchor_classes anchor classes.
	 */
	function electro_header_dark_logo( $anchor_classes = '' ) {

		$dark_logo_attr = apply_filters( 'electro_dark_logo_attr', '' );

		if ( isset( $dark_logo_attr['url'] ) && ! empty( $dark_logo_attr['url'] ) ) {

			$img_attr = array(
				'class' => 'img-header-logo',
				'src'   => $dark_logo_attr['url'],
				'alt'   => get_bloginfo( 'name' ),
			);

			if ( isset( $dark_logo_attr['width'] ) && ! empty( $dark_logo_attr['width'] ) ) {
				$img_attr['width'] = $dark_logo_attr['width'];
			}

			if ( isset( $dark_logo_attr['height'] ) && ! empty( $dark_logo_attr['height'] ) ) {
				$img_attr['height'] = $dark_logo_attr['height'];
			}

			$logo_anchor_classes = 'd-none site-dark-logo header-logo-link';

			if ( ! empty( $anchor_classes ) ) {
				$logo_anchor_classes .= ' ' . $anchor_classes;
			}

			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php echo esc_attr( $logo_anchor_classes ); ?>">
				<img <?php echo electro_render_attributes( $img_attr ); //phpcs:ignore ?> />
			</a>
			<?php
		}
	}
}

if ( ! function_exists( 'electro_header_logo' ) ) {
	/**
	 * Displays theme logo
	 */
	function electro_header_logo() {

		electro_header_dark_logo();

		$header_logo_src = apply_filters( 'electro_header_logo_src', get_template_directory_uri() . '/assets/images/logo.png' );

		if ( ! empty( $header_logo_src ) ) {

			ob_start();

			if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<div class="
				<?php
				if ( current_filter() !== 'electro_header_logo_area' ) :
					?>
					header-logo
					<?php
					else :
						?>
									header-site-branding<?php endif; ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-link">
						<?php electro_get_template( 'global/logo-svg.php' ); ?>
					</a>
				</div>
				<?php
			}
			echo apply_filters( 'electro_header_logo_html', ob_get_clean() ); //phpcs:ignore
		}
	}
}

if ( ! function_exists( 'electro_primary_nav' ) ) {
	/**
	 * Displays Primary Navigation
	 */
	function electro_primary_nav() {
		?>
		<div class="primary-nav animate-dropdown">
			<div class="clearfix">
				 <button class="navbar-toggler hidden-sm-up float-end flip" type="button" data-bs-toggle="collapse" data-bs-target="#default-header">
						&#9776;
				 </button>
			 </div>

			<div class="collapse navbar-toggleable-xs" id="default-header">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary-nav',
							'container'      => false,
							'menu_class'     => 'nav nav-inline yamm',
							'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
							'walker'         => new wp_bootstrap_navwalker(),
						)
					);
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_get_handheld_header_version' ) ) {
	/**
	 * Electro get handheld header version.
	 */
	function electro_get_handheld_header_version() {
		return apply_filters( 'electro_get_handheld_header_version', 'handheld-v2' );
	}
}

if ( ! function_exists( 'electro_handheld_header' ) ) {
	/**
	 * Displays HandHeld Header
	 */
	function electro_handheld_header() {
		$version = electro_get_handheld_header_version();
		switch ( $version ) {
			case 'handheld-v1':
				electro_handheld_header_v1();
				break;

			case 'handheld-v2':
				electro_handheld_header_v2();
				break;

			case 'mobile-v1':
				electro_mobile_header_v1();
				break;

			case 'mobile-v2':
				electro_mobile_header_v2();
				break;

			default:
				electro_handheld_header_v2();
				break;
		}
	}
}

if ( ! function_exists( 'electro_handheld_header_v1' ) ) {
	/**
	 * Displays HandHeld Header
	 */
	function electro_handheld_header_v1() {
		if ( has_electro_mobile_header() ) :
			?>
			<div class="handheld-header-wrap container <?php echo esc_attr( electro_handheld_header_responsive_class() ); ?>">
				<div class="handheld-header">
					<?php
					/**
					 * Electro Header Handheld.
					 *
					 * @hooked electro_header_logo - 10
					 * @hooked electro_handheld_nav - 20
					 */
					do_action( 'electro_header_handheld' );
					?>
				</div>
			</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_handheld_header_v2' ) ) {
	/**
	 * Displays HandHeld Header
	 */
	function electro_handheld_header_v2() {
		if ( has_electro_mobile_header() ) :
			$classes = '';
			if ( apply_filters( 'electro_handheld_header_v2_light_bg', false ) ) {
				$classes = 'light';
			}
			?>
			<div class="handheld-header-wrap container <?php echo esc_attr( electro_handheld_header_responsive_class() ); ?>">
				<div class="handheld-header-v2 row align-items-center handheld-stick-this <?php echo esc_attr( $classes ); ?>">
					<?php
					/**
					 * Electro Header v2 Handheld.
					 *
					 * @hooked electro_off_canvas_nav - 10
					 * @hooked electro_header_logo - 20
					 * @hooked electro_handheld_header_links - 30
					 */
					do_action( 'electro_handheld_header_v2' );
					?>
				</div>
			</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_mobile_header_v1' ) ) {
	/**
	 * Displays Mobile Header v1
	 */
	function electro_mobile_header_v1() {
		if ( has_electro_mobile_header() ) :
			?>
			<div class="container <?php echo esc_attr( electro_handheld_header_responsive_class() ); ?>">
				<div class="mobile-header-v1 row align-items-center handheld-stick-this">
					<?php
					/**
					 * Electro mobile Header v1.
					 *
					 * @hooked electro_off_canvas_nav - 10
					 * @hooked electro_header_logo - 20
					 * @hooked electro_handheld_header_links - 30
					 */
					do_action( 'electro_mobile_header_v1' );
					?>
				</div>
			</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_mobile_header_v2' ) ) {
	/**
	 * Displays HandHeld Header v4
	 */
	function electro_mobile_header_v2() {
		if ( has_electro_mobile_header() ) :
			?>
			<div class="mobile-header-v2 handheld-stick-this">
				<div class="container <?php echo esc_attr( electro_handheld_header_responsive_class() ); ?>">
					<div class="mobile-header-v2-inner row align-items-center">
						<?php
						/**
						 * Electro mobile Header v2.
						 *
						 * @hooked electro_off_canvas_nav - 10
						 * @hooked electro_header_logo - 20
						 * @hooked electro_handheld_header_links - 30
						 */
						do_action( 'electro_mobile_header_v2' );
						?>
					</div>
				</div>
			</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_handheld_header_logo' ) ) {
	/**
	 * Displays theme handheld header logo
	 *
	 * @since 2.0.0
	 */
	function electro_handheld_header_logo() {

		electro_header_dark_logo( 'header-logo' );

		ob_start();
		?>
		<div class="header-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-link">
				<?php electro_get_template( 'global/logo-svg.php' ); ?>
			</a>
		</div>
		<?php
		echo apply_filters( 'electro_handheld_header_logo_html', ob_get_clean() ); //phpcs:ignore
	}
}

if ( ! function_exists( 'electro_handheld_nav' ) ) {
	/**
	 * Displays HandHeld Navigation
	 */
	function electro_handheld_nav() {
		?>
		<div class="handheld-navigation-wrapper">
			<div class="handheld-navbar-toggle-buttons clearfix">
				<button class="navbar-toggler navbar-toggle-hamburger hidden-lg-up float-end flip" type="button">
					<i class="ec ec-menu"></i>
				</button>
				<button class="navbar-toggler navbar-toggle-close hidden-lg-up float-end flip" type="button">
					<i class="ec ec-close-remove"></i>
				</button>
			</div>

			<div class="handheld-navigation hidden-lg-up" id="default-hh-header">
				<span class="ehm-close"><?php _e( 'Close', 'electro' ); //phpcs:ignore ?></span>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'hand-held-nav',
							'container'      => false,
							'menu_class'     => 'nav nav-inline yamm',
							'fallback_cb'    => 'electro_handheld_nav_fallback',
							'walker'         => new wp_bootstrap_navwalker(),
						)
					);
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_mobile_handheld_department' ) ) {
	/**
	 * Displays HandHeld Navigation v4
	 */
	function electro_mobile_handheld_department() {
		?>
		<div class="mobile-handheld-department">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'mobile-handheld-department',
						'container'      => false,
						'depth'          => 1,
						'menu_class'     => 'nav',
						'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
						'walker'         => new wp_bootstrap_navwalker(),
					)
				);
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_off_canvas_nav' ) ) {
	/**
	 * Displays Off Canvas Navigation
	 */
	function electro_off_canvas_nav() {
		$classes = '';
		if ( apply_filters( 'electro_off_canvas_nav_hide_in_desktop', false ) ) {
			$classes = 'off-canvas-hide-in-desktop d-xl-none';
		}
		?>
		<div class="off-canvas-navigation-wrapper <?php echo esc_attr( $classes ); ?>">
			<div class="off-canvas-navbar-toggle-buttons clearfix">
				<button class="navbar-toggler navbar-toggle-hamburger " type="button">
					<i class="ec ec-menu"></i>
				</button>
				<button class="navbar-toggler navbar-toggle-close " type="button">
					<i class="ec ec-close-remove"></i>
				</button>
			</div>

			<div class="off-canvas-navigation
			<?php
			if ( ! electro_is_dark_enabled() ) :
				?>
				 light<?php endif; ?>" id="default-oc-header">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'hand-held-nav',
							'container'      => false,
							'menu_class'     => 'nav nav-inline yamm',
							'fallback_cb'    => 'electro_handheld_nav_fallback',
							'walker'         => new wp_bootstrap_navwalker(),
						)
					);
				?>
			</div>
		</div>
		<?php
	}
}


if ( ! function_exists( 'electro_handheld_nav_fallback' ) ) {
	/**
	 * Displays HandHeld Navigation Fallback
	 */
	function electro_handheld_nav_fallback() {
		wp_nav_menu(
			array(
				'theme_location' => 'all-departments-menu',
				'container'      => false,
				'menu_class'     => 'nav nav-inline yamm',
				'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
				'walker'         => new wp_bootstrap_navwalker(),
			)
		);
	}
}

if ( ! function_exists( 'electro_handheld_header_links' ) ) {
	/**
	 * Display a menu intended for use on handheld devices
	 *
	 * @since 1.0.0
	 */
	function electro_handheld_header_links() {
		$links = array(
			'search'     => array(
				'priority' => 10,
				'callback' => 'electro_handheld_header_search_link',
			),
			'my-account' => array(
				'priority' => 20,
				'callback' => 'electro_handheld_footer_bar_account_link',
			),
			'cart'       => array(
				'priority' => 30,
				'callback' => 'electro_handheld_footer_bar_cart_link',
			),
		);

		if ( ! function_exists( 'wc_get_page_id' ) || wc_get_page_id( 'myaccount' ) === -1 ) {
			unset( $links['my-account'] );
		}

		if ( ! function_exists( 'wc_get_page_id' ) || wc_get_page_id( 'cart' ) === -1 || electro_get_shop_catalog_mode() == true ) {
			unset( $links['cart'] );
		}

		$links = apply_filters( 'electro_handheld_header_links', $links );
		?>
		<div class="handheld-header-links">
			<ul class="columns-<?php echo count( $links ); ?>">
				<?php foreach ( $links as $key => $link ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>">
						<?php
						if ( $link['callback'] ) {
							call_user_func( $link['callback'], $key, $link );
						}
						?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}
}

if ( ! function_exists( 'electro_handheld_header_search_link' ) ) {
	/**
	 * The search callback function for the handheld header bar
	 *
	 * @since 2.0.0
	 */
	function electro_handheld_header_search_link() {
		echo '<a href="">' . esc_attr__( 'Search', 'electro' ) . '</a>';
		electro_handheld_header_search();
	}
}

if ( ! function_exists( 'electro_handheld_header_search' ) ) {
	/**
	 * The search callback function for the handheld header bar
	 *
	 * @since 2.0.0
	 */
	function electro_handheld_header_search() {
		if ( is_woocommerce_activated() ) {
			electro_product_search();
		} else {
			electro_blog_search();
		}
	}
}

if ( ! function_exists( 'electro_header_support_info' ) ) {
	/**
	 * Displays header support info
	 */
	function electro_header_support_info() {

		$support_number = apply_filters( 'electro_header_support_number', '<strong>Support</strong> (+800) 856 800 604' );
		$support_email  = apply_filters( 'electro_header_support_email', 'Email: info@electro.com' );
		$support_icon   = apply_filters( 'electro_header_support_icon', 'ec ec-support' );

		if ( apply_filters( 'electro_show_header_support_info', true ) ) :
			?>
		<div class="header-support-info">
			<div class="media">
				<span class="media-left support-icon media-middle"><i class="<?php echo esc_attr( $support_icon ); ?>"></i></span>
				<div class="media-body">
					<span class="support-number"><?php echo wp_kses_post( $support_number ); ?></span><br/>
					<span class="support-email"><?php echo wp_kses_post( $support_email ); ?></span>
				</div>
			</div>
		</div>
			<?php
		endif;
	}
}

if ( ! function_exists( 'electro_header_search_box' ) ) {
	/**
	 * Displays search box at the header
	 */
	function electro_header_search_box() {

	}
}

if ( ! function_exists( 'electro_breadcrumb' ) ) {
	/**
	 * Electro Breadcrumb.
	 *
	 * @param array $args arguments.
	 */
	function electro_breadcrumb( $args = array() ) {

		if ( apply_filters( 'electro_show_breadcrumb', true ) ) {

			if ( is_woocommerce_activated() ) {
				woocommerce_breadcrumb();
			} else {

				require get_template_directory() . '/inc/classes/class-electro-breadcrumb.php';

				$args = wp_parse_args(
					$args,
					apply_filters(
						'woocommerce_breadcrumb_defaults',
						array(
							'delimiter'   => '<span class="delimiter"><i class="fa fa-angle-right"></i></span>',
							'wrap_before' => '<nav class="woocommerce-breadcrumb">',
							'wrap_after'  => '</nav>',
							'before'      => '',
							'after'       => '',
							'home'        => _x( 'Home', 'breadcrumb', 'electro' ),
						)
					)
				);

				$breadcrumbs = new Electro_Breadcrumb();

				if ( $args['home'] ) {
					$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
				}

				$args['breadcrumb'] = $breadcrumbs->generate();

				electro_get_template( 'global/breadcrumb.php', $args );
			}
		}
	}
}

if ( ! function_exists( 'electro_jumbotron' ) ) {
	/**
	 * Electro Jumbotron.
	 *
	 * @param array $args arguments.
	 */
	function electro_jumbotron( $args = array() ) {
		electro_get_template( 'sections/jumbotron.php', $args );
	}
}

if ( ! function_exists( 'electro_add_data_hover_attribute' ) ) {
	/**
	 * Electro Add Data Hover Attribute.
	 *
	 * @param array $atts attributes.
	 * @param array $item item.
	 * @param array $args arguments.
	 * @param int   $depth depth.
	 */
	function electro_add_data_hover_attribute( $atts, $item, $args, $depth ) {

		if ( 'all-departments-menu' == $args->theme_location || 'departments-menu' == $args->theme_location ) {
			return $atts;
		}

		if ( isset( $args->has_children ) && $args->has_children && 0 === $depth && 'hand-held-nav' !== $args->theme_location ) {

			$dropdown_trigger = apply_filters( 'electro_' . $args->theme_location . '_dropdown_trigger', 'hover', $args->theme_location );

			if ( 'hover' == $dropdown_trigger ) {
				$atts['data-hover'] = 'dropdown';

				if ( isset( $atts['data-bs-toggle'] ) ) {
					unset( $atts['data-bs-toggle'] );
				}
			}
		}

		return $atts;
	}
}
