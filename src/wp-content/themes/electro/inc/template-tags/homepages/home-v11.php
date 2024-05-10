<?php
/**
 * Template functions hooked into the `homepage_v11` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v11_page_template_content' ) ) {
	function electro_home_v11_page_template_content() {

		$home_v11_general_options = electro_get_home_v11_general_options();

		$animation = $home_v11_general_options[ 'page_content' ][ 'animation' ];

		$attr = array(
			'class' => 'page-content'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<?php electro_page_template_content(); ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v11_slider_block' ) ) {
	function electro_home_v11_slider_block( $args = array() ) {

		$home_v11_general_options = electro_get_home_v11_general_options();
		
		if ( ! $home_v11_general_options[ 'slider' ][ 'is_enabled' ] ) {	
			return;
		}
		
		$slider_options = electro_get_home_v11_slider_options();

		if( isset( $args['slider_shortcode'] ) && !empty( $args['slider_shortcode'] )){
			$slider_options['slider_shortcode'] = $args['slider_shortcode'] ;
		}

		if( isset( $args['bg_image'] ) && !empty( $args['bg_image'] )){
			$slider_options['bg_image'] = $args['bg_image'] ;
		}

		$shortcode = ! empty( $slider_options['slider_shortcode'] ) ? $slider_options['slider_shortcode'] : '[rev_slider alias="home-v11-slider"]';

		$animation = $home_v11_general_options[ 'slider' ][ 'animation' ];

		$attr = array(
			'class' => 'stretch-full-width slider-block'
		);
		
		if( isset( $args['el_class'] ) && !empty( $args['el_class'] )){
			$attr['class'] .=  ' ' . $args['el_class'] ;
		}

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		if ( isset( $slider_options[ 'bg_image' ] ) && ! empty( $slider_options[ 'bg_image' ] ) ) {
			$attr[ 'style' ] = 'background-image:url(' . esc_url( $slider_options[ 'bg_image' ] ) . '); background-position: bottom;';
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<div class="container">
				<div class="pt-6">
					<?php echo apply_filters( 'electro_home_v11_slider_html', do_shortcode( $shortcode ) ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</div>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v11_brands_block' ) ) {
	function electro_home_v11_brands_block( $args = array()) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$brands_options = electro_get_home_v11_bwc_options();

		if ( isset( $args[ 'brands' ] ) && ! empty( $args[ 'brands' ] ) ) {
			$brands_options = $args;
		}

		$brand_taxonomy = electro_get_brands_taxonomy();
		$brand          = get_taxonomy( $brand_taxonomy );

		if ( empty( $brand_taxonomy ) ) {
			return;
		}

		$brands_options[ 'brands' ][ 'taxonomy_args' ][ 'taxonomy' ] = $brand_taxonomy;

		$terms = get_terms( $brands_options[ 'brands' ][ 'taxonomy_args' ] );

		?><div class="px-5 py-4 d-md-flex align-items-center flex-wrap brands">
			<?php if ( ! empty( $brands_options[ 'brands' ][ 'title' ] ) ) : ?>
				<h6 class="me-2 mb-0 my-2 fw-bold"><?php echo esc_html( $brands_options[ 'brands' ][ 'title' ] ); ?></h6>
			<?php endif; ?>
			<?php foreach ( $terms as $term ) :	?>
				<?php if ( $brand->public ) : ?>
					<a href="<?php echo esc_url( apply_filters( 'ec_brand_link', get_term_link( $term ), $term ) ); ?>" class="me-4 mx-xl-4 my-2 my-xl-0">
				<?php else: ?>
					<div class="me-4 mx-xl-4 my-2 my-xl-0">
				<?php endif; ?>
				<?php 
					$thumbnail_id 	  = defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.6', '<' ) ? get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) : get_term_meta( $term->term_id, 'thumbnail_id', true );
					$image_attributes = '';

					if ( $thumbnail_id ) {
						
						$image_attributes = wp_get_attachment_image_src( $thumbnail_id, 'full' );
						
						if( $image_attributes ) {
							$image_src    = $image_attributes[0];
							$image_width  = $image_attributes[1];
							$image_height = $image_attributes[2];
						}
					}
					
					if ( empty( $image_attributes ) ) {
						$dimensions   = wc_get_image_size( 'shop_thumbnail' );
						$image_src    = wc_placeholder_img_src();
						$image_width  = $dimensions['width'];
						$image_height = $dimensions['height'];
					}

					$image_src = str_replace( ' ', '%20', $image_src ); 
				?>
					<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" width="<?php echo esc_attr( $image_width ); ?>" height="<?php echo esc_attr( $image_height ); ?>" class="img-fluid m-auto">
				<?php if ( $brand->public ) : ?>
					</a>
				<?php else: ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php if ( ! empty( $brands_options[ 'brands' ][ 'more_brands_text' ] ) ) : ?>
				<a href="<?php echo esc_url( $brands_options[ 'brands' ][ 'more_brands_link' ] ); ?>" class="ms-auto"><?php echo esc_html( $brands_options[ 'brands' ][ 'more_brands_text' ] ); ?></a>
			<?php endif; ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v11_categories_block' ) ) {
	function electro_home_v11_categories_block( $args = array() ) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$categories_options = electro_get_home_v11_bwc_options();

		if ( isset( $args[ 'categories' ] ) && ! empty( $args[ 'categories' ] ) ) {
			$categories_options = $args;
		}

		$categories_options[ 'categories' ][ 'product_cats_args' ]['taxonomy'] = 'product_cat';

		$product_cats = get_terms( $categories_options[ 'categories' ][ 'product_cats_args' ] );

		if ( is_wp_error( $product_cats ) ) {
			return;
		}

		?><div class="row g-0 row-cols-md-2 row-cols-xl-4 categories">
			<?php foreach( $product_cats as $product_cat ) : ?>
				<?php
					$cat_thumb_id = get_term_meta( $product_cat->term_id, 'thumbnail_id', true );
					$cat_thumb_url = wp_get_attachment_image_url( $cat_thumb_id, 'full' );
					$cat_cover_url = electro_acf_get_product_category_cover_image_url( $product_cat );
					
					if ( $cat_cover_url ) {
						$cat_thumb_url = $cat_cover_url;
					}

					$term_link = get_term_link( $product_cat, 'product_cat' );
				?>
				<div class="col d-flex flex-column">
					<img class="img-fluid h" src="<?php echo esc_url( $cat_thumb_url ? $cat_thumb_url : wc_placeholder_img_src() ); ?>" alt="<?php echo esc_attr( $product_cat->name ); ?>">
					<div class="px-6 py-4 position-relative col border-end">
						<?php if ( ! empty( $categories_options[ 'categories' ][ 'arrow_icon' ] ) ) : ?>
							<a href="<?php echo esc_url( $term_link ); ?>" class="position-absolute view-all end-0 me-3 bg-white rounded-circle align-items-center d-flex justify-content-center">
								<i class="<?php echo esc_attr( $categories_options[ 'categories' ][ 'arrow_icon' ] ); ?>"></i>
							</a>
						<?php endif; ?>
						<h6 class="fw-bold mb-4"><?php echo esc_html( $product_cat->name ); ?></h6>
						<?php
							$product_child_cats_args = array(
								'taxonomy'   => 'product_cat',
								'orderby'    => 'menu_order',
								'order'      => 'ASC',
								'number'     => $categories_options[ 'categories' ][ 'cats_child_limit' ],
								'hide_empty' => false,
								'child_of'   => $product_cat->term_id
							);

							$product_child_cats = get_terms( $product_child_cats_args );
						?>
						<?php if ( ! is_wp_error( $product_child_cats ) && $product_child_cats ) : ?>
							<ul class="mb-0 list-unstyled">
								<?php foreach( $product_child_cats as $product_child_cat ) : ?>
									<li>
										<a href="<?php echo esc_url( get_term_link( $product_child_cat, 'product_cat' ) ); ?>"><?php echo esc_html( $product_child_cat->name ); ?></a>
									</li>
								<?php endforeach; ?>
								<?php if ( ! empty( $categories_options[ 'categories' ][ 'more_child_text' ] ) ) : ?>
									<li>
										<a href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $categories_options[ 'categories' ][ 'more_child_text' ] ); ?></a>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v11_brands_with_category_block' ) ) {
	function electro_home_v11_brands_with_category_block( $args = array(), $class = '' ) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$home_v11_general_options = electro_get_home_v11_general_options();
		
		if ( isset( $args[ 'is_enabled' ] ) ) {
			$home_v11_general_options[ 'bwc' ][ 'is_enabled' ] = $args[ 'is_enabled' ];
		}
		
		if ( ! $home_v11_general_options[ 'bwc' ][ 'is_enabled' ] ) {	
			return;
		}

		$animation = $home_v11_general_options[ 'bwc' ][ 'animation' ];

		if ( isset( $args[ 'animation' ] ) ) {
			$animation = $args[ 'animation' ];
		}

		$attr = array(
			'class' => 'brand-with-category bg-white'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		if ( isset( $args['el_class'] ) && ! empty( $args['el_class']) ) {
			$attr['class'] .= ' ' . $args['el_class'];
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<?php electro_home_v11_brands_block( $args ); ?>
			<?php electro_home_v11_categories_block( $args ); ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v11_banner_with_products_carousel' ) ) {
	function electro_home_v11_banner_with_products_carousel( $args = array() ) {
		
		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$home_v11_general_options = electro_get_home_v11_general_options();

		if ( isset( $args[ 'is_enabled' ] ) ) {
			$home_v11_general_options[ 'bwpc' ][ 'is_enabled' ] = $args[ 'is_enabled' ];
		}
		
		if ( ! $home_v11_general_options[ 'bwpc' ][ 'is_enabled' ] ) {	
			return;
		}

		$bwpc_options = electro_get_home_v11_bwpc_options();

		if ( isset( $args ) && ! empty( $args ) ) {
			$bwpc_options = $args;
		}

		$carousel_id = 'products-carousel-' . uniqid();

		$carousel_args = array(
			'nav'             => true,
			'slideSpeed'      => 300,
			'dots'            => false,
			'rtl'             => is_rtl() ? true : false,
			'paginationSpeed' => 400,
			'navText'         => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
			'margin'          => 0,
			'touchDrag'       => true,
			'responsive'      => array(
				'0'    => array( 'items' => 2 ),
				'480'  => array( 'items' => 2 ),
				'768'  => array( 'items' => 2 ),
				'992'  => array( 'items' => 4 ),
				'1200' => array( 'items' => $bwpc_options[ 'products' ][ 'carousel_args' ][ 'slideToShow' ] ),
			),
			'autoplay' => $bwpc_options[ 'products' ][ 'carousel_args' ][ 'autoplay' ]
		);

		$shortcode_atts = electro_get_atts_for_shortcode( $bwpc_options[ 'products' ] );

		$products_html = electro_do_shortcode( $bwpc_options[ 'products' ][ 'shortcode' ], $shortcode_atts );

		$animation = $home_v11_general_options[ 'bwpc' ][ 'animation' ];

		if ( isset( $args[ 'animation' ] ) ) {
			$animation = $args[ 'animation' ];
		}

		$attr = array(
			'class' => 'stretch-full-width banner-with-products-carousel mb-5'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}	
		
		if ( isset( $args['el_class'] ) && ! empty( $args['el_class']) ) {
			$attr['class'] .= ' ' . $args['el_class'];
		}

		if ( $bwpc_options[ 'bg_image' ] ) {
			$attr[ 'style' ] = 'background-image:url(' . esc_url( $bwpc_options[ 'bg_image' ] ) . ');background-position: bottom;background-repeat: no-repeat;
			background-size: cover;';
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<div class="container banner-with-products-carousel-inner">
				<div class="row align-items-center pt-5 pt-xl-0">
					<div class="col-md-4 col-lg-3 mb-6 mb-xl-0 banner">
						<?php if ( isset( $bwpc_options[ 'banner' ][ 'title' ] ) && ! empty( $bwpc_options[ 'banner' ][ 'title' ] ) ) : ?>
							<h1 class="mb-3 fw-light banner-title">
								<?php echo wp_kses_post( $bwpc_options[ 'banner' ][ 'title' ] ); ?>
							</h1>
						<?php endif; ?>
						<div class="mb-4 banner-tag">
							<?php if ( isset( $bwpc_options[ 'banner' ][ 'subtitle' ] ) && ! empty( $bwpc_options[ 'banner' ][ 'subtitle' ] ) ) : ?>
								<span class="banner-sub-title"><?php echo esc_html( $bwpc_options[ 'banner' ][ 'subtitle' ] ); ?></span>
							<?php endif; ?>
								<?php if ( isset( $bwpc_options[ 'banner' ][ 'offer_text' ] ) && ! empty( $bwpc_options[ 'banner' ][ 'offer_text' ] ) ) : ?>
								<span class="font-size-sl-48 font-weight-bold text-lh-45 banner-offer-text">
									<?php echo wp_kses_post( $bwpc_options[ 'banner' ][ 'offer_text' ] ); ?>
								</span>
							<?php endif; ?>
						</div>
						<?php if ( isset( $bwpc_options[ 'banner' ][ 'button_text' ] ) && ! empty( $bwpc_options[ 'banner' ][ 'button_text' ] ) && isset( $bwpc_options[ 'banner' ][ 'button_url' ] ) && ! empty( $bwpc_options[ 'banner' ][ 'button_url' ] ) ) : ?>
							<a href="<?php echo esc_url( $bwpc_options[ 'banner' ][ 'button_url' ] ); ?>" class="btn btn-primary transition-3d-hover rounded-lg font-weight-normal py-2 px-md-4 px-3">
								<?php echo esc_html( $bwpc_options[ 'banner' ][ 'button_text' ] ); ?>
							</a>
						<?php endif; ?>
					</div>
					<div class="col-md-8 col-lg-9">
						<section class="section-products-carousel">
							<div id="<?php echo esc_attr( $carousel_id ); ?>" data-ride="owl-carousel" data-replace-active-class="true" data-carousel-selector=".products-carousel" data-carousel-options="<?php echo esc_attr( wp_json_encode( $carousel_args ) ); ?>">
								<?php
									$search        = array( '<ul', '<li', '</li>', '</ul>', 'class="products' );
									$replace       = array( '<div', '<div', '</div>', '</div>', 'class="products owl-carousel products-carousel' );
									$products_html = str_replace( $search, $replace, $products_html );
									echo apply_filters( 'electro_products_carousel_html', $products_html ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								?>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v11_banners_block' ) ) {
	function electro_home_v11_banners_block() {

		$home_v11_general_options = electro_get_home_v11_general_options();
		
		if ( ! $home_v11_general_options[ 'banners' ][ 'is_enabled' ] ) {	
			return;
		}

		$two_banners_options = electro_get_home_v11_two_banners_options();

		$args = apply_filters( 'electro_home_v6_two_banners_args', array(
			array(
				'image'         => $two_banners_options[ 'image_1' ][ 'image_url' ],
				'action_link'   => $two_banners_options[ 'image_1' ][ 'action_link' ],
			),
			array(
				'image'         => $two_banners_options[ 'image_2' ][ 'image_url' ],
				'action_link'   => $two_banners_options[ 'image_2' ][ 'action_link' ],
			)
		) );

		ob_start();

		electro_two_banners( $args );

		$ads_html = ob_get_clean();

		$animation = $home_v11_general_options[ 'banners' ][ 'animation' ];

		$attr = array(
			'class' => 'home-two-banners'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<?php echo wp_kses_post( $ads_html ); ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v11_products_carousel' ) ) {
	function electro_home_v11_products_carousel() {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$home_v11_general_options = electro_get_home_v11_general_options();
		
		if ( ! $home_v11_general_options[ 'pc' ][ 'is_enabled' ] ) {	
			return;
		}

		$products_carousel_options = electro_get_home_v11_products_carousel_options();
		$products_carousel_options[ 'section_class' ] = 'section-products-carousel';
		$products_carousel_options[ 'animation' ] = $home_v11_general_options[ 'pc' ][ 'animation' ];

		$carousel_args = array(
			'dots'              => true,
			'nav'               => true,
			'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
			'autoplay'          => false,
			'responsive'        => array(
				'0'     => array( 'items' => 2 ),
				'576'   => array( 'items' => 3 ),
				'768'   => array( 'items' => 3 ),
				'992'   => array( 'items' => 4 ),
				'1200'  => array( 'items' => $products_carousel_options[ 'products' ][ 'carousel_args' ][ 'slideToShow' ] )
			),
			'autoplay' => $products_carousel_options[ 'products' ][ 'carousel_args' ][ 'autoplay' ]
		);

		$shortcode_atts = electro_get_atts_for_shortcode( $products_carousel_options[ 'products' ] );

		$products = electro_do_shortcode( $products_carousel_options[ 'products' ][ 'shortcode' ], $shortcode_atts );

        $products_carousel_options['products_html'] = $products;
		
		electro_products_carousel_v5( $products_carousel_options, $carousel_args );
	}
}

if ( ! function_exists( 'electro_home_v11_trending_products_carousel' ) ) {
	function electro_home_v11_trending_products_carousel() {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$home_v11_general_options = electro_get_home_v11_general_options();
		
		if ( ! $home_v11_general_options[ 'tpc' ][ 'is_enabled' ] ) {	
			return;
		}

		$trending_products_carousel_options = electro_get_home_v11_trending_products_carousel_options();
		$trending_products_carousel_options[ 'section_class' ] = 'section-products-carousel';
		$trending_products_carousel_options[ 'animation' ] = $home_v11_general_options[ 'tpc' ][ 'animation' ];;

		$carousel_args = array(
			'dots'              => true,
			'nav'               => true,
			'navText'           => is_rtl() ? array( '<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>' ) : array( '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ),
			'autoplay'          => false,
			'responsive'        => array(
				'0'     => array( 'items' => 2 ),
				'576'   => array( 'items' => 3 ),
				'768'   => array( 'items' => 3 ),
				'992'   => array( 'items' => 4 ),
				'1200'  => array( 'items' => $trending_products_carousel_options[ 'products' ][ 'carousel_args' ][ 'slideToShow' ] )
			),
			'autoplay' => $trending_products_carousel_options[ 'products' ][ 'carousel_args' ][ 'autoplay' ]
		);

		$shortcode_atts = electro_get_atts_for_shortcode( $trending_products_carousel_options[ 'products' ] );

		$products = electro_do_shortcode( $trending_products_carousel_options[ 'products' ][ 'shortcode' ], $shortcode_atts );

        $trending_products_carousel_options['products_html'] = $products;
		
		electro_products_carousel_v5( $trending_products_carousel_options, $carousel_args );
	}
}