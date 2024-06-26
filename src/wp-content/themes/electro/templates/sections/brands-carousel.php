<?php
/**
 * Brands Carousel
 *
 * @author 		MadrasThemes
 * @package 	Electro/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img_classes = apply_filters( 'electro_bc_should_desaturate', true ) ? 'img-responsive desaturate' : 'img-responsive'; ?>
<section class="brands-carousel">
	<h2 class="sr-only"><?php echo esc_html__( 'Brands Carousel', 'electro' ); ?></h2>
	<div class="container">
		<div id="owl-brands" class="owl-brands owl-carousel electro-owl-carousel owl-outer-nav" data-ride="owl-carousel" data-carousel-selector="self" data-carousel-options="<?php echo esc_attr( json_encode( $carousel_args ) ); ?>">
		
			<?php foreach ( $terms as $term ) :	?>
			
			<div class="item">
				<?php if ( $brand->public ) : ?>
				<a href="<?php echo esc_url( apply_filters( 'ec_brand_link', get_term_link( $term ), $term ) ); ?>">
				<?php endif; ?>
				<figure>
					<figcaption class="text-overlay">
						<div class="info">
							<h4><?php echo esc_html( $term->name ); ?></h4>
						</div><!-- /.info -->
					</figcaption>
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
					<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $term->name ); ?>" width="<?php echo esc_attr( $image_width ); ?>" height="<?php echo esc_attr( $image_height ); ?>" class="<?php echo esc_attr( $img_classes ); ?>">
				</figure>
				<?php if ( $brand->public ) : ?>
				</a>
				<?php endif; ?>
			</div><!-- /.item -->

			<?php endforeach; ?>
			
		</div><!-- /.owl-carousel -->
	</div>
</section>