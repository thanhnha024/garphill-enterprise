<?php
/**
 * Template functions hooked into the `homepage_v10` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v10_page_template_content' ) ) {
	function electro_home_v10_page_template_content() {

		$home_v10_general_options = electro_get_home_v10_general_options();

		$animation = $home_v10_general_options[ 'page_content' ][ 'animation' ];

		$attr = array(
			'class' => 'page-content'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		?><div <?php electro_render_attributes( $attr ); ?>>
			<?php electro_page_template_content(); ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v10_slider_block' ) ) {
	function electro_home_v10_slider_block( $slider_shortcode = '' ) {
		$slider_options = electro_get_home_v10_swadb_options();

		if ( isset( $slider_shortcode ) && ! empty( $slider_shortcode ) ) {
			$slider_options['slider_shortcode'] = $slider_shortcode;
		}

		$shortcode = ! empty( $slider_options['slider_shortcode'] ) ? $slider_options['slider_shortcode'] : '[rev_slider alias="home-v10-slider"]';
		echo apply_filters( 'electro_home_v10_slider_html', do_shortcode( $shortcode ) ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
	}
}

if ( ! function_exists( 'electro_home_v10_ads_block' ) ) {
	/**
	 * Display Home v10 ads block.
	 */
	function electro_home_v10_ads_block( $args = array() ) {
		$ads_options = electro_get_home_v10_swadb_options();

		if ( is_array( $args ) && ! empty( $args ) ) {
			$ads_options[ 'adb' ] = $args;
		}

		?><div class="da-block pt-xl-5 mt-2 pb-xl-4">
			<?php $ads = $ads_options[ 'adb' ]; foreach( $ads as $key => $ad ) : ?>
				<div class="da">
					<div class="da-inner px-3 py-4 position-relative">
						<a class="da-media d-flex stretched-link" href="<?php echo esc_url( $ad[ 'url' ] ); ?>">
							<?php if ( $ad[ 'image' ] ) : ?>
								<div class="da-media-left me-3">
									<img width="140" height="140" src="<?php echo esc_url( $ad[ 'image' ] ); ?>" class="attachment-thumbnail size-thumbnail" alt="" loading="lazy">
								</div>
							<?php endif; ?>
							<div class="da-media-body">
								<?php if ( $ad[ 'title' ] ) : ?>
									<div class="da-text mb-3">
										<?php echo wp_kses_post( $ad[ 'title' ] ); ?>
									</div>
								<?php endif; ?>
								<?php if ( $ad[ 'action_text' ] ) : ?>
									<div class="da-action">
										<?php echo esc_html( $ad[ 'action_text' ] ); ?>
									</div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v10_slider_with_ads_block' ) ) {
	/**
	 * Display Home v10 slider with ads block.
	 */
	function electro_home_v10_slider_with_ads_block() {
		$home_v10_general_options = electro_get_home_v10_general_options();

		if ( ! $home_v10_general_options[ 'swadb' ][ 'is_enabled' ] ) {	
			return;
		}

		$swadb_options = electro_get_home_v10_swadb_options();

		$animation = $home_v10_general_options[ 'swadb' ][ 'animation' ];

		$attr = array(
			'class' => 'stretch-full-width slider-with-das mb-5'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		if ( $swadb_options[ 'bg_image' ] ) {
			$attr[ 'style' ] = 'background-image:url(' . esc_url( $swadb_options[ 'bg_image' ] ) . ');';
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<div class="container">
				<div class="row">
					<div class="col-lg">
						<?php electro_home_v10_slider_block(); ?>
					</div>
					<div class="col-lg-auto">
						<?php electro_home_v10_ads_block(); ?>
					</div>
				</div>
			</div>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v10_sidebar' ) ) {
	function electro_home_v10_sidebar( $sidebar_enable, $sidebar_title ) { 

		if ( $sidebar_enable && ( has_nav_menu( 'all-departments-menu' ) || is_active_sidebar( 'home-v10-sidebar-widgets' ) ) ) : ?>
			<div class="d-none d-xl-block col-xl-auto mb-6 mb-md-0">
				<?php if ( has_nav_menu( 'all-departments-menu' ) ) : ?>
					<div class="categories-list-menu bg-white">
						<div class="departments-menu-v2">
							<div class="dropdown show-dropdown">
								<div class="departments-menu-v2-title">
									<?php if ( $sidebar_title ) : ?>
										<section class="w-100 mb-0">
											<header class="mb-0">
												<h2 class="h1 fw-bold"><?php echo esc_html( $sidebar_title ); ?></h2>
											</header>
										</section>
									<?php endif; ?>
								</div>
								<?php
									wp_nav_menu(
										apply_filters( 'electro_home_v10_sidebar_menu_args',
											array(
												'theme_location' => 'all-departments-menu',
												'container'      => false,
												'menu_class'     => 'dropdown-menu yamm',
												'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
												'walker'         => new WP_Bootstrap_Navwalker(),
											)
										)
									);
								?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php dynamic_sidebar( 'home-v10-sidebar-widgets' ); ?>
			</div>
		<?php endif;

	}
}

if ( ! function_exists( 'electro_home_v10_sidebar_with_products' ) ) {
	function electro_home_v10_sidebar_with_products() {
		$home_v10_general_options = electro_get_home_v10_general_options();

		if ( ! $home_v10_general_options[ 'swpb' ][ 'is_enabled' ] ) {
			return;
		}
		
		$swpb_options = electro_get_home_v10_swpb_options();
		$shortcode_atts = electro_get_atts_for_shortcode( $swpb_options );
		$shortcode_atts[ 'paginate' ] = $swpb_options[ 'paginate' ];

		$animation = $home_v10_general_options[ 'swpb' ][ 'animation' ];

		$attr = array(
			'class' => 'row categories-with-product'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		$is_sidebar_enabled = $swpb_options[ 'enable_sidebar' ];

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<?php electro_home_v10_sidebar( $is_sidebar_enabled, $swpb_options[ 'sidebar_menu_title' ] ); ?>
			<?php if ( is_woocommerce_activated() ) : ?>
				<div class="col">
					<section class="w-100 mb-0">
						<?php if ( isset( $swpb_options[ 'section_title' ] ) && ! empty( $swpb_options[ 'section_title' ] ) ) : ?>
							<header class="mb-0">
								<h2 class="h1"><?php echo esc_html( $swpb_options[ 'section_title' ] ); ?></h2>
							</header>
						<?php endif; ?>
						<?php echo electro_do_shortcode( $swpb_options[ 'shortcode' ], $shortcode_atts ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</section>
				</div>
			<?php endif; ?>
		</div><?php
	}
}