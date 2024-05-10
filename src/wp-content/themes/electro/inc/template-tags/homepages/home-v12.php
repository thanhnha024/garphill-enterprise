<?php
/**
 * Template functions hooked into the `homepage_v12` action in the homepage template
 */

if ( ! function_exists( 'electro_home_v12_body_inner_wrap_start' ) ) {
	function electro_home_v12_body_inner_wrap_start() {
		?><div class="py-4 px-4 px-xl-5 mb-5 body-inner-bg"><?php
	}
}

if ( ! function_exists( 'electro_home_v12_body_inner_wrap_end' ) ) {
	function electro_home_v12_body_inner_wrap_end() {
		?></div><?php
	}
}

if ( ! function_exists( 'electro_home_v12_page_template_content' ) ) {
	function electro_home_v12_page_template_content() {

		$home_v12_page_content_options = electro_get_home_v12_page_content_options();

		$is_enabled = $home_v12_page_content_options[ 'is_enabled' ];

		if ( ! $is_enabled ) {	
			return;
		}

		$animation = $home_v12_page_content_options[ 'animation' ];

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

if ( ! function_exists( 'electro_home_v12_slider_block' ) ) {
	function electro_home_v12_slider_block( $args = array() ) {
		
		$slider_options = electro_get_home_v12_slider_options();

		$is_enabled = $slider_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		if ( isset( $args['slider_shortcode'] ) && ! empty( $args['slider_shortcode'] )){
			$slider_options['slider_shortcode'] = $args['slider_shortcode'] ;
		}

		$shortcode = ! empty( $slider_options['slider_shortcode'] ) ? $slider_options['slider_shortcode'] : '[rev_slider alias="home-v11-slider"]';

		$animation = $slider_options[ 'animation' ];

		if ( isset( $args['animation'] ) && ! empty( $args['animation'] )){
			$animation = $args['animation'] ;
		}

		$attr = array(
			'class' => 'slider'
		);
		
		if ( isset( $args['el_class'] ) && ! empty( $args['el_class'] ) ){
			$attr['class'] .=  ' ' . $args['el_class'] ;
		}

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<?php echo apply_filters( 'electro_home_v12_slider_html', do_shortcode( $shortcode ) ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v12_categories_block' ) ) {
	function electro_home_v12_categories_block( $args = array() ) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$categories_options = electro_get_home_v12_categories_options();

		$is_enabled = $categories_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		$categories_options[ 'categories' ]['taxonomy'] = 'product_cat';

		if ( isset( $args[ 'categories' ] ) && ! empty( $args[ 'categories' ] ) ) {
			$categories_options[ 'categories' ] = $args[ 'categories' ];
		}

		$categories_options[ 'categories' ]['taxonomy'] = 'product_cat';

		$product_cats = get_terms( $categories_options[ 'categories' ] );

		if ( is_wp_error( $product_cats ) ) {
			return;
		}

		$attr = array(
			'class' => 'categories-list-card pt-xl-6'
		);

		$animation = $categories_options[ 'animation' ];

		if ( isset( $args[ 'animation' ] ) && ! empty( $args[ 'animation' ] ) ) {
			$animation = $args[ 'animation' ];
		}

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		if ( isset( $args['el_class'] ) && !empty ( $args['el_class'] ) ){
			$attr[ 'class' ] .= ' ' . $args['el_class'] ;
		}

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<div class="row row-cols-md-3 row-cols-xl-<?php echo esc_attr( $categories_options[ 'categories' ][ 'columns' ] ); ?> mb-5 mb-xl-0">
				<?php foreach( $product_cats as $product_cat ) : ?>
					<?php
						$cat_thumb_id = get_term_meta( $product_cat->term_id, 'thumbnail_id', true );
						$cat_thumb_url = wp_get_attachment_image_url( $cat_thumb_id, 'full' );
						$term_link = get_term_link( $product_cat, 'product_cat' );
					?>
					<div class="pt-7 pt-xl-0 mb-xl-5 mt-xl-4">
						<a href="<?php echo esc_url( $term_link ); ?>" class="categories-list-bg px-3 d-flex flex-column h-100 justify-content-end rounded-sm">
							<div class="border-bottom text-center pb-4">
								<img class="img-fluid mt-n5" src="<?php echo esc_url( $cat_thumb_url ? $cat_thumb_url : wc_placeholder_img_src() ); ?>" alt="<?php echo esc_attr( $product_cat->name ); ?>">
							</div>
							<div class="text-center py-3 lh-lg">
								<h6 class="fw-bold mb-0" style="font-size:15px;"><?php echo esc_html( $product_cat->name ); ?></h6>
								<p class="mb-0" style="font-size:13px;">
									<?php
										echo esc_html(
											sprintf(
												/* translators: 1: number of products, 2: product */
												esc_html( _nx( '%1$s product', '%1$s products', $product_cat->count, 'products title', 'electro' ) ),
												number_format_i18n( $product_cat->count )
											)
										);
									?>
								</p>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v12_products' ) ) {
	function electro_home_v12_products( $args ) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}
		
		$shortcode_atts = electro_get_atts_for_shortcode( $args );

		$animation = $args[ 'animation' ];

		$attr = array(
			'class' => 'w-100 mb-5 home-v12-products'
		);

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		?><section <?php echo electro_render_attributes( $attr ); ?>>
			<?php if ( isset( $args[ 'section_title' ] ) && ! empty( $args[ 'section_title' ] ) ) : ?>
				<header class="mb-0">
					<h2 class="h1"><?php echo esc_html( $args[ 'section_title' ] ); ?></h2>
				</header>
			<?php endif; ?>
			<?php echo electro_do_shortcode( $args[ 'shortcode' ], $shortcode_atts ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</section><?php
	}
}

if ( ! function_exists( 'electro_home_v12_hot_products' ) ) {
	function electro_home_v12_hot_products( $args = array()) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$product_options = electro_get_home_v12_hot_products_options();

		$is_enabled = $product_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		if ( isset( $args[ 'animation' ] ) && ! empty( $args[ 'animation' ] ) ) {
			$product_options[ 'animation' ] = $args[ 'animation' ];
		}

		electro_home_v12_products( $product_options );
	}
}

if ( ! function_exists( 'electro_home_v12_banners' ) ) {
	function electro_home_v12_banners( $args = array() ) {

		$banners_options = electro_get_home_v12_banners_options();

		$is_enabled = $banners_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		if ( isset( $args[ 'banners' ] ) && ! empty( $args[ 'banners' ] ) ) {
			$banners_options[ 'banners' ] = $args[ 'banners' ];
		}

		$attr = array(
			'class' => 'home-v12-da-block mb-5'
		);

		$animation = $banners_options[ 'animation' ];

		if ( isset( $args[ 'animation' ] ) ) {
			$animation = $args[ 'animation' ];
		}

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		if ( isset( $args['el_class'] ) && !empty( $args['el_class'] ) ){
			$attr['class'] = ' ' . $args['el_class'];
		}

		$i = 1;

		?><div <?php echo electro_render_attributes( $attr ); ?>>
			<div class="row">
				<?php foreach( $banners_options[ 'banners' ] as $key => $banner ) : ?>
					<?php
						$column_classes = 'mb-3 mb-xl-0';
						
						switch ( $i % 3 ) {
							case 1;
								$column_classes .= ' col-md-12 col-xl-6';
							break;

							case 2;
							case 0;
								$column_classes .= ' col-md-6 col-xl-3';
							break;
						}
					?>
					<div class="<?php echo esc_attr( $column_classes ); ?>">
						<div class="d-flex align-items-center p-3 position-relative rounded-sm overflow-hidden bg-cover"<?php if( isset( $banner[ 'bg_image' ] ) && ! empty( $banner[ 'bg_image' ] ) ) : ?>style="background-image:url(<?php echo esc_url( $banner[ 'bg_image' ] ); ?>);"<?php endif; ?>>
							<a class="d-md-flex align-items-center stretched-link" href="<?php echo esc_url( $banner[ 'url' ] ); ?>">
								<?php
									switch ( $i % 3 ) {
										case 1;
											if ( 'banner_1' === $key ) {
												if ( isset( $banner[ 'image' ] ) && ! empty( $banner[ 'image' ] ) ) : ?>
													<div class="media-left ms-md-n4 me-md-5 me-xxl-4 flex-shrink-0 mt-md-7 mt-xl-4 mt-xxl-7">
														<img src="<?php echo esc_url( $banner[ 'image' ] ); ?>" alt="<?php esc_attr_e( 'Banner Image', 'electro' ); ?>">
													</div>
												<?php endif; ?>
												<?php if ( isset( $banner[ 'desc' ] ) && ! empty( $banner[ 'desc' ] ) ) : ?>
													<div class="fw-light text-dark lh-sm me-xxl-4" style="font-size:20px;letter-spacing: -.7px;">
														<?php echo wp_kses_post( $banner[ 'desc' ] ); ?>
													</div>
												<?php endif;
											}
										break;
			
										case 2;
											if ( 'banner_2' === $key ) {
												?><div class="px-3 d-flex lh-sm">
													<?php if ( isset( $banner[ 'desc' ] ) && ! empty( $banner[ 'desc' ] ) ) : ?>
														<div class="fw-light text-dark" style="font-size:20px;width:104px;"><?php echo wp_kses_post( $banner[ 'desc' ] ); ?></div>
													<?php endif; ?>
													<div class="text-dark">
														<?php if ( isset( $banner[ 'price_pre_text' ] ) && ! empty( $banner[ 'price_pre_text' ] ) ) : ?>
															<div style="font-size:8px;"><?php echo esc_html( $banner[ 'price_pre_text' ] ); ?></div>
														<?php endif; ?>
														<?php if ( isset( $banner[ 'price_text' ] ) && ! empty( $banner[ 'price_text' ] ) ) : ?>
															<div class="fw-bold" style="font-size:30px;">
																<?php echo wp_kses_post( $banner[ 'price_text' ] ); ?>
															</div>
														<?php endif; ?>
													</div>
												</div><?php
											}
										break;

										case 0;
											if ( 'banner_3' === $key ) {
												?><div class="px-3 lh-1">
													<div class="text-dark" style="width:138px;">
														<?php if ( isset( $banner[ 'title' ] ) && ! empty( $banner[ 'title' ] ) ) : ?>
															<h6 class="mb-0"><?php echo esc_html( $banner[ 'title' ] ); ?></h6>
														<?php endif; ?>
														<?php if ( isset( $banner[ 'subtitle' ] ) && ! empty( $banner[ 'subtitle' ] ) ) : ?>
															<h4 class="mb-0 h3 fw-light"><?php echo esc_html( $banner[ 'subtitle' ] ); ?></h4>
														<?php endif; ?>
														<?php if ( isset( $banner[ 'desc' ] ) && ! empty( $banner[ 'desc' ] ) ) : ?>
															<span class="fw-bold d-block lh-sm" style="font-size:12px;"><?php echo esc_html( $banner[ 'desc' ] ); ?></span>
														<?php endif; ?>
													</div>
												</div><?php
											}
										break;
									}
								?>
							</a>
						</div>
					</div>
				<?php $i++; endforeach; ?>
			</div>
		</div><?php
	}
}

if ( ! function_exists( 'electro_home_v12_new_products' ) ) {
	function electro_home_v12_new_products( $args = array() ) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$product_options = electro_get_home_v12_new_products_options();

		$is_enabled = $product_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		if ( isset( $args[ 'animation' ] ) && ! empty( $args[ 'animation' ] ) ) {
			$product_options[ 'animation' ] = $args[ 'animation' ];
		}

		electro_home_v12_products( $product_options );
	}
}

if ( ! function_exists( 'electro_home_v12_recommend_products' ) ) {
	function electro_home_v12_recommend_products( $args = array() ) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$product_options = electro_get_home_v12_recommend_products_options();

		$is_enabled = $product_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		if ( isset( $args[ 'animation' ] ) && ! empty( $args[ 'animation' ] ) ) {
			$product_options[ 'animation' ] = $args[ 'animation' ];
		}

		electro_home_v12_products( $product_options );
	}
}

if ( ! function_exists( 'electro_home_v12_blog_posts' ) ) {
	function electro_home_v12_blog_posts( $args = array() ) {

		$blog_posts_options = electro_get_home_v12_blog_posts_options();

		$is_enabled = $blog_posts_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		if ( isset( $args ) && ! empty( $args ) ){
			$blog_posts_options = $args;
		}

		$posts_query = new Wp_Query( $blog_posts_options );

		$attr = array(
			'class' => 'w-100 mb-5 home-v12-blog-posts'
		);

		$animation = $blog_posts_options[ 'animation' ];

		if ( isset( $args[ 'animation' ] ) ) {
			$animation = $args[ 'animation' ];
		}

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		if ( isset( $args['el_class'] ) && !empty( $args['el_class'] ) ){
			$attr['class'] .= ' ' . $args['el_class'];
		}

		?><section <?php echo electro_render_attributes( $attr ); ?>>
			<?php if ( isset( $blog_posts_options[ 'section_title' ] ) && ! empty( $blog_posts_options[ 'section_title' ] ) ) : ?>
				<header class="mb-3">
					<h2 class="h1"><?php echo esc_html( $blog_posts_options[ 'section_title' ] ); ?></h2>
				</header>
			<?php endif; ?>
			<?php if ( $posts_query->have_posts() ) : ?>
				<div class="row row-cols-lg-<?php echo esc_attr( $blog_posts_options[ 'columns' ] ); ?> gy-3">
					<?php while( $posts_query->have_posts() ) : $posts_query->the_post(); ?>
						<div class="shadow-hover rounded-sm py-3">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php $post_thumnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
								<div class="rounded-sm overflow-hidden">
									<a href="<?php the_permalink(); ?>" class="d-block">
										<img class="img-fluid w-100" src="<?php echo esc_url( $post_thumnail_url ); ?>" alt="<?php esc_attr_e( 'Post Image', 'electro' ); ?>" style="height285px;object-fit: cover;">
									</a>
								</div>
							<?php endif; ?>
							<?php
								$post_categories = get_the_category();
								$separator = apply_filters( 'electro_home_v12_blog_posts_cat_separator', ', ' );
							?>
							<div class="px-md-3 px-2 pt-4 pb-3">
								<?php if ( $post_categories ) : ?>
									<?php foreach( $post_categories as $key => $category ) :?>
										<a href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>" class="mb-3 fw-bold d-inline-block"><?php echo esc_html( $category->name ); ?></a>
										<?php if( count( $post_categories ) !== $key + 1 ) : ?>
											<?php echo esc_html( $separator ); ?>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
								<h4 class="mb-3" style="font-size:20px;">
									<a href="<?php the_permalink(); ?>" class="d-block fw-bold"><?php the_title(); ?></a>
								</h4>
								<?php if ( has_excerpt() ) : ?>
									<p class="mb-0" style="color:#878787;letter-spacing: .1px;"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			<?php else: ?>
				<div class="alert alert-info mb-0 p-4">
					<div class="fw-bold text-center">
						<i class="fi-alert-circle me-2 mt-0 fs-1"></i>
						<h4 class="mb-0 mt-2 text-info" style="font-weight: 700;"><?php esc_html_e( 'Posts Not Found', 'electro' ); ?></h4>
					</div>
				</div>
			<?php endif; ?>
		</section><?php
	}
}

if ( ! function_exists( 'electro_home_v12_brands_block' ) ) {
	function electro_home_v12_brands_block( $args = array()) {

		if ( ! is_woocommerce_activated() ) {
			return;
		}

		$brands_options = electro_get_home_v12_brands_options();

		$is_enabled = $brands_options[ 'is_enabled' ];

		if ( isset( $args[ 'is_enabled' ] ) && ! empty( $args[ 'is_enabled' ] ) ) {
			$is_enabled = $args[ 'is_enabled' ];
		}

		if ( ! $is_enabled ) {	
			return;
		}

		if ( isset( $args ) && ! empty( $args ) ) {
			$brands_options = $args;
		}

		$brand_taxonomy = electro_get_brands_taxonomy();
		$brand          = get_taxonomy( $brand_taxonomy );

		if ( empty( $brand_taxonomy ) ) {
			return;
		}

		$brands_options[ 'taxonomy' ] = $brand_taxonomy;

		$terms = get_terms( $brands_options );

		$attr = array(
			'class' => 'w-100 mb-5 home-v12-brands'
		);

		$animation = $brands_options[ 'animation' ];

		if ( isset( $args[ 'animation' ] ) ) {
			$animation = $args[ 'animation' ];
		}

		if ( $animation ) {
			$attr[ 'class' ] .= ' animate-in-view';
			$attr[ 'data-animation' ] = $animation;
		}

		if ( isset( $args['el_class'] ) && !empty( $args['el_class'] ) ){
			$attr['class'] = ' ' . $args['el_class'];
		}

		?><section <?php echo electro_render_attributes( $attr ); ?>>
			<?php if ( ! empty( $brands_options[ 'section_title' ] ) ) : ?>
				<header class="mb-4">
					<h2 class="h1"><?php echo esc_html( $brands_options[ 'section_title' ] ); ?></h2>
				</header>
			<?php endif; ?>
			<div class="row row-cols-md-2 row-cols-lg-<?php echo esc_attr( $brands_options[ 'columns' ] ); ?> gy-6 pt-2">
				<?php foreach ( $terms as $term ) :	?>
					<div class="brand-card-list">
						<?php if ( $brand->public ) : ?>
							<a href="<?php echo esc_url( apply_filters( 'ec_brand_link', get_term_link( $term ), $term ) ); ?>" class="mme-xl-4 rounded-sm px-4 py-4 position-relative h-100 d-block">
						<?php else: ?>
							<div class="mme-xl-4 rounded-sm px-4 py-4 position-relative h-100">
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

							$cover_image_url = electro_acf_get_product_attribute_cover_image_url( $term );
						?>
							<img class="img-fluid mb-3" src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" width="<?php echo esc_attr( $image_width ); ?>" height="<?php echo esc_attr( $image_height ); ?>">
							<?php if ( $term->description ) : ?>
								<p class="me-xl-4 me-xxl-7" style="color:#878787;letter-spacing: .1px;"><?php echo esc_html( $term->description ); ?></p>
							<?php endif; ?>
							<?php if ( $cover_image_url && ! empty( $cover_image_url ) ) : ?>
								<img class="img-fluid ms-n4 ms-xl-n2 ms-xxl-n4 mt-n2 mt-lg-n4 position-absolute top-100 start-100 translate-middle" src="<?php echo esc_url( $cover_image_url ); ?>" alt="<?php esc_attr_e( 'Attribute Image', 'electro' ); ?>">
							<?php endif; ?>
						<?php if ( $brand->public ) : ?>
							</a>
						<?php else: ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</section><?php
	}
}
