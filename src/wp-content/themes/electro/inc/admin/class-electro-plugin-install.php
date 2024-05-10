<?php
/**
 * Electro Plugin Install Class
 *
 * @package  electro
 * @since    2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Electro_Plugin_Install' ) ) :
	/**
	 * The Electro plugin install class
	 */
	class Electro_Plugin_Install {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'plugin_install_scripts' ) );
			add_action( 'tgmpa_register', [ $this, 'register_required_plugins' ] );
		}

		/**
		 * Wrapper around the core WP get_plugins function, making sure it's actually available.
		 *
		 * @since 2.5.0
		 *
		 * @param string $plugin_folder Optional. Relative path to single plugin folder.
		 * @return array Array of installed plugins with plugin information.
		 */
		public function get_plugins( $plugin_folder = '' ) {
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			return get_plugins( $plugin_folder );
		}

		/**
		 * Helper function to extract the file path of the plugin file from the
		 * plugin slug, if the plugin is installed.
		 *
		 * @since 2.0.0
		 *
		 * @param string $slug Plugin slug (typically folder name) as provided by the developer.
		 * @return string Either file path for plugin if installed, or just the plugin slug.
		 */
		protected function get_plugin_basename_from_slug( $slug ) {
			$keys = array_keys( $this->get_plugins() );

			foreach ( $keys as $key ) {
				if ( preg_match( '|^' . $slug . '/|', $key ) ) {
					return $key;
				}
			}

			return $slug;
		}

		/**
		 * Check if all plugins profile are installed
		 *
		 * @param array $plugins Array of plugins and profiles.
		 * @return bool
		 */
		public function requires_install_plugins( $plugins ) {
			$requires = false;

			foreach ( $plugins as $plugin ) {
				$plugin['file_path']   = $this->get_plugin_basename_from_slug( $plugin['slug'] );
				$plugin['is_callable'] = '';

				if ( ! TGM_Plugin_Activation::is_active( $plugin ) ) {
					$requires = true;
					break;
				}
			}

			return $requires;
		}

		/**
		 * Load plugin install scripts
		 *
		 * @param string $hook_suffix the current page hook suffix.
		 * @return void
		 * @since  1.4.4
		 */
		public function plugin_install_scripts( $hook_suffix ) {
			global $electro, $electro_version;

			wp_enqueue_script( 'electro-plugin-install', get_template_directory_uri() . '/assets/js/admin/plugin-install.js', array( 'jquery', 'updates' ), $electro_version, 'all' );

			$params = [
				'tgmpa_url'   => admin_url( add_query_arg( 'page', 'install-required-plugins', 'themes.php' ) ),
				'txt_install' => esc_html__( 'Install Plugins', 'electro' ),
				'profiles'    => $this->get_profile_params(),
			];

			if ( is_ocdi_activated() ) {
				$params['file_args'] = $electro->ocdi;
			}
			wp_localize_script( 'electro-plugin-install', 'ocdi_params', $params );
			wp_enqueue_script( 'electro-plugin-install' );

			wp_enqueue_style( 'electro-plugin-install', get_template_directory_uri() . '/assets/css/admin/plugin-install.css', array(), $electro_version, 'all' );
		}

		/**
		 * Determines whether a plugin is active.
		 *
		 * Only plugins installed in the plugins/ folder can be active.
		 *
		 * Plugins in the mu-plugins/ folder can't be "activated," so this function will
		 * return false for those plugins.
		 *
		 * For more information on this and similar theme functions, check out
		 * the {@link https://developer.wordpress.org/themes/basics/conditional-tags/
		 * Conditional Tags} article in the Theme Developer Handbook.
		 *
		 * @param string $plugin Path to the plugin file relative to the plugins directory.
		 * @return bool True, if in the active plugins list. False, not in the list.
		 */
		public static function is_active_plugin( $plugin ) {
			return in_array( $plugin, (array) get_option( 'active_plugins', array() ), true ) || is_plugin_active_for_network( $plugin );
		}

		/**
		 * Output a button that will install or activate a plugin if it doesn't exist, or display a disabled button if the
		 * plugin is already activated.
		 *
		 * @param string $plugin_slug The plugin slug.
		 * @param string $plugin_file The plugin file.
		 * @param string $plugin_name The plugin name.
		 * @param string $classes CSS classes.
		 * @param string $activated Button activated text.
		 * @param string $activate Button activate text.
		 * @param string $install Button install text.
		 */
		public static function install_plugin_button( $plugin_slug, $plugin_file, $plugin_name, $classes = array(), $activated = '', $activate = '', $install = '' ) {
			if ( current_user_can( 'install_plugins' ) && current_user_can( 'activate_plugins' ) ) {
				if ( self::is_active_plugin( $plugin_slug . '/' . $plugin_file ) ) {
					// The plugin is already active.
					$button = array(
						'message' => esc_attr__( 'Activated', 'electro' ),
						'url'     => '#',
						'classes' => array( 'electro-button', 'disabled' ),
					);

					if ( '' !== $activated ) {
						$button['message'] = esc_attr( $activated );
					}
				} elseif ( self::is_plugin_installed( $plugin_slug ) ) {
					$url = self::is_plugin_installed( $plugin_slug );

					// The plugin exists but isn't activated yet.
					$button = array(
						'message' => esc_attr__( 'Activate', 'electro' ),
						'url'     => $url,
						'classes' => array( 'activate-now' ),
					);

					if ( '' !== $activate ) {
						$button['message'] = esc_attr( $activate );
					}
				} else {
					// The plugin doesn't exist.
					$url    = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $plugin_slug,
							),
							self_admin_url( 'update.php' )
						),
						'install-plugin_' . $plugin_slug
					);
					$button = array(
						'message' => esc_attr__( 'Install now', 'electro' ),
						'url'     => $url,
						'classes' => array( 'sf-install-now', 'install-now', 'install-' . $plugin_slug ),
					);

					if ( '' !== $install ) {
						$button['message'] = esc_attr( $install );
					}
				}

				if ( ! empty( $classes ) ) {
					$button['classes'] = array_merge( $button['classes'], $classes );
				}

				$button['classes'] = implode( ' ', $button['classes'] );

				?>
				<span class="plugin-card-<?php echo esc_attr( $plugin_slug ); ?>">
					<a href="<?php echo esc_url( $button['url'] ); ?>" class="<?php echo esc_attr( $button['classes'] ); ?>" data-originaltext="<?php echo esc_attr( $button['message'] ); ?>" data-name="<?php echo esc_attr( $plugin_name ); ?>" data-slug="<?php echo esc_attr( $plugin_slug ); ?>" aria-label="<?php echo esc_attr( $button['message'] ); ?>"><?php echo esc_html( $button['message'] ); ?></a>
				</span> <?php echo /* translators: conjunction of two alternative options user can choose (in missing plugin admin notice). */ esc_html__( 'or', 'electro' ); ?>
				<a href="https://wordpress.org/plugins/<?php echo esc_attr( $plugin_slug ); ?>" target="_blank"><?php esc_html_e( 'learn more', 'electro' ); ?></a>
				<?php
			}
		}

		/**
		 * Check if a plugin is installed and return the url to activate it if so.
		 *
		 * @param string $plugin_slug The plugin slug.
		 */
		private static function is_plugin_installed( $plugin_slug ) {
			if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug ) ) {
				$plugins = get_plugins( '/' . $plugin_slug );
				if ( ! empty( $plugins ) ) {
					$keys        = array_keys( $plugins );
					$plugin_file = $plugin_slug . '/' . $keys[0];
					$url         = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'activate',
								'plugin' => $plugin_file,
							),
							admin_url( 'plugins.php' )
						),
						'activate-plugin_' . $plugin_file
					);
					return $url;
				}
			}
			return false;
		}

		/**
		 * Get profile parameters.
		 *
		 * @return array
		 */
		public function get_profile_params() {
			$profiles = $this->get_demo_profiles();
			$params   = [];
			foreach ( $profiles as $key => $profile ) {
				$plugins                            = $this->get_demo_plugins( $key );
				$params[ $key ]['requires_install'] = $this->requires_install_plugins( $plugins );
				if ( $params[ $key ]['requires_install'] ) {
					$params['all']['requires_install'] = true;
				}
			}
			return $params;
		}

		/**
		 * Get Demo Profiles
		 *
		 * @return array
		 */
		public function get_demo_profiles() {
			global $electro_version;
			return array(
				'default'   => array(
					array(
						'name'               => 'Electro Extensions',
						'slug'               => 'electro-extensions',
						'source'             => 'https://transvelo.github.io/electro/assets/plugins/electro-extensions.zip',
						'required'           => false,
						'version'            => $electro_version,
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'Envato Market',
						'slug'               => 'envato-market',
						'source'             => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
						'required'           => false,
						'version'            => '2.0.7',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'MAS Brands for WooCommerce',
						'slug'               => 'mas-woocommerce-brands',
						'required'           => false,
						'version'            => '1.0.5',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'MAS Static Content',
						'slug'               => 'mas-static-content',
						'required'           => false,
						'version'            => '1.0.4',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'One Click Demo Import',
						'slug'               => 'one-click-demo-import',
						'required'           => false,
						'version'            => '3.1.1',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'Redux Framework',
						'slug'               => 'redux-framework',
						'required'           => false,
						'version'            => '4.3.14',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'Revolution Slider',
						'slug'               => 'revslider',
						'source'             => 'https://transvelo.github.io/included-plugins/revslider.zip',
						'required'           => false,
						'version'            => '6.6.13',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'WooCommerce',
						'slug'               => 'woocommerce',
						'required'           => false,
						'version'            => '6.5.1',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'WPBakery Page Builder',
						'slug'               => 'js_composer',
						'source'             => 'https://transvelo.github.io/included-plugins/js_composer.zip',
						'required'           => false,
						'version'            => '6.9.0',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'WPForms Lite',
						'slug'               => 'wpforms-lite',
						'required'           => false,
						'version'            => '1.7.4.2',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
					array(
						'name'               => 'YITH Woocommerce Compare',
						'slug'               => 'yith-woocommerce-compare',
						'required'           => false,
						'version'            => '2.14.0',
						'force_activation'   => false,
						'force_deactivation' => false,
						'is_callable'        => array( 'YITH_Woocompare', 'is_frontend' ),
						'external_url'       => '',
					),
					array(
						'name'               => 'YITH WooCommerce Wishlist',
						'slug'               => 'yith-woocommerce-wishlist',
						'required'           => false,
						'version'            => '3.9.0',
						'force_activation'   => false,
						'force_deactivation' => false,
						'is_callable'        => array( 'YITH_WCWL', 'get_instance' ),
						'external_url'       => '',
					),
					array(
						'name'               => 'Advanced Custom Fields',
						'slug'               => 'advanced-custom-fields',
						'required'           => false,
						'version'            => '5.12.2',
						'force_activation'   => false,
						'force_deactivation' => false,
					),
				),
				'elementor' => array(
					array(
						'name'               => 'Elementor',
						'slug'               => 'elementor',
						'required'           => true,
						'version'            => '3.6.5',
						'force_activation'   => false,
						'force_deactivation' => false,
						'external_url'       => '',
					),
				),

				'mas-elementor' => array(
					array(
						'name'        => 'Elementor',
						'slug'        => 'elementor',
						'required'    => true,
						'description' => esc_html__( 'Import Electro Elementor demo content easily with just one click.', 'electro' ),
					),
					array(
						'name'     => 'MAS Elementor',
						'slug'     => 'mas-addons-for-elementor',
						'required' => true,
					),
				),

				'recommended_plugins'   => array(
					array(
						'name'               => 'HubSpot All-In-One Marketing - Forms, Popups, Live Chat',
						'slug'               => 'leadin',
						'required'           => false,
					),
				),
			);
		}

		/**
		 * Get plugins list for a given profile.
		 *
		 * @param string $demo The demo profile.
		 * @return array
		 */
		public function get_demo_plugins( $demo = 'default' ) {
			$profiles = $this->get_demo_profiles();
			$plugins  = [];

			foreach ( $profiles as $key => $profile ) {
				if ( 'all' === $demo || 'default' === $key || $key === $demo ) {
					$plugins = array_merge( $plugins, $profile );
				}
			}

			return $plugins;
		}

		/**
		 * Register the required plugins for this theme.
		 *
		 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
		 */
		public function register_required_plugins() {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */

			$profile = isset( $_GET['demo'] ) ? sanitize_text_field( wp_unslash( $_GET['demo'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$plugins = $this->get_demo_plugins( $profile );

			$config = apply_filters( 'ec_tgmpa_config',
				array(
					'domain'       => 'electro',
					'default_path' => '',
					'parent_slug'  => 'themes.php',
					'menu'         => 'install-required-plugins',
					'has_notices'  => true,
					'is_automatic' => false,
					'message'      => '',
					'strings'      => array(
						'page_title'                      => esc_html__( 'Install Required Plugins', 'electro' ),
						'menu_title'                      => esc_html__( 'Install Plugins', 'electro' ),
						'installing'                      => esc_html__( 'Installing Plugin: %s', 'electro' ),
						'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'electro' ),
						'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'electro' ),
						'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'electro' ),
						'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'electro' ),
						'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'electro' ),
						'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'electro' ),
						'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'electro' ),
						'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'electro' ),
						'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'electro' ),
						'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'electro'  ),
						'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'electro'  ),
						'return'                          => esc_html__( 'Return to Required Plugins Installer', 'electro' ),
						'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'electro' ),
						'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'electro' ),
						'nag_type'                        => 'updated',
					),
				)
			);

			tgmpa( $plugins, $config );
		}
	}

endif;

return new Electro_Plugin_Install();
