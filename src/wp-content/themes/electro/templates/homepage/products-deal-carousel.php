<?php
/**
 * Product Deals Carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_class ) ? 'deal-products-carousel' : $section_class . ' deal-products-carousel';

if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$section_id = 'deal-products-carousel-' . uniqid();

//$default_atts       = array( 'columns' => 4, 'template' => 'content-product-carousel-alt' );
//$shortcode_atts     = wp_parse_args( $default_atts, $shortcode_atts );

?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ): ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <div class="container">
        <div class="deal-products-carousel-inner row">
            <div class="deal-products-timer col-md-4 col-lg-3 text-center text-md-start mb-md-0">
                <header>
                    <?php if( ! empty( $section_title ) ) : ?>
                        <h2 class="h1 m-xl-0 flex-shrink-1"><?php echo wp_kses_post ( $section_title ); ?></h2>
                    <?php endif; ?>
                </header>
                <div class="deal-percentage fw-light">
                    <span><?php echo wp_kses_post( $deal_percentage ); ?></span>
                </div>

                <?php if( isset( $header_timer ) && $header_timer && ! empty( $timer_value ) ) :
                    $deal_end_time = strtotime( $timer_value );
                    $current_time = strtotime( 'now' );
                    $time_diff = ( $deal_end_time - $current_time );

                    if( $time_diff > 0 ) : ?>
                    <div class="deal-countdown-timer">
                        <div class="marketing-text fs-6"><?php echo wp_kses_post( $timer_title ); ?></div>
                            <span class="deal-time-diff" style="display:none;"><?php echo esc_html( $time_diff ); ?></span>
                            <div class="deal-countdown countdown d-flex justify-content-center justify-content-md-start"></div>
                        </div>
                    <?php endif;
                endif; ?>

            </div>
            <div class="deal-products col-md-8 col-lg-9">
                <?php electro_products_carousel( $args['section_args'], $args['carousel_args'] ); ?>
            </div>
        </div>
    </div>
</section>
