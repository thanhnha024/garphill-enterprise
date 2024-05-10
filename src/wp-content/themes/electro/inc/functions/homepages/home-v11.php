<?php
/**
 * Functions used in Home v11
 */

function electro_get_home_v11_general_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $general_options = array(
            'page_content' => array(
                'is_enabled' => false,
                'priority'   => 5,
                'animation'  => ''
            ),
            'slider' => array(
                'is_enabled' => true,
                'priority'   => 10,
                'animation'  => ''
            ),
            'bwc' => array(
                'is_enabled' => true,
                'priority'   => 20,
                'animation'  => ''
            ),
            'bwpc' => array(
                'is_enabled' => true,
                'priority'   => 30,
                'animation'  => ''
            ),
            'banners' => array(
                'is_enabled' => true,
                'priority'   => 40,
                'animation'  => ''
            ),
            'pc' => array(
                'is_enabled' => true,
                'priority'   => 50,
                'animation'  => ''
            ),
            'tpc' => array(
                'is_enabled' => true,
                'priority'   => 60,
                'animation'  => ''
            )
        );

        return apply_filters( 'electro_home_v11_general_options', $general_options, $post );
    }
}

function electro_get_home_v11_slider_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $slider_options = array(
            'bg_image'          => 'https://via.placeholder.com/1920x703?text=electro',
            'slider_shortcode'  => '[rev_slider alias="home-v11-slider"]',
        );
    
        return apply_filters( 'electro_home_v11_slider_options', $slider_options, $post );
    }
}

function electro_get_home_v11_bwc_options() {
    global $post;

    if ( isset( $post->ID ) ) {
        $bwc_options = array(
            'brands'       => array(
                'title'            => esc_html__( 'Brands:', 'electro' ),
                'more_brands_text' => esc_html__( '+ More Brands', 'electro' ),
                'more_brands_link' => '#',
                'taxonomy_args'    => array(
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'number'     => 6,
                    'hide_empty' => false
                )
            ),
            'categories' => array(
                'arrow_icon'         => 'fas fa-chevron-right',
                'cats_child_limit'   => 5,
                'more_child_text'    => '...',
                'product_cats_args'  => array(
                    'orderby'    => 'menu_order',
                    'order'      => 'ASC',
                    'number'     => 8,
                    'hide_empty' => false,
                    'parent'     => 0,
                    'object_ids' => '',
                )
            )
        );
        
        return apply_filters( 'electro_home_v11_bwc_options', $bwc_options, $post );
    }
}

function electro_get_home_v11_bwpc_options() {
    global $post;

    if ( isset( $post->ID ) ) {
        $bwpc_options = array(
            'bg_image'     => 'https://via.placeholder.com/1920x703?text=electro',
            'banner'       => array(
                'title'       => wp_kses_post( 'OUTLET DEALS <span class="d-block">CLEARANCE</span>' ),
                'subtitle'    => esc_html__( 'SAVE UP TO', 'electro' ),
                'offer_text'  => wp_kses_post( '70<sup class="font-size-36">%</sup><sub class="font-size-16">OFF!</sub>' ),
                'button_text' => esc_html__( 'Start Buying', 'electro' ),
                'button_url'  => '#'
            ),
            'products' => array(
                'shortcode'         => 'recent_products',
                'products_ids_skus' => '',
                'shortcode_atts'    => array(
                    'per_page' => 10,
                    'orderby'  => 'date',
                    'order'    => 'ASC'
                ),
                'carousel_args' => array(
                    'slideToShow' => 5,
                    'autoplay'    => false
                )
            )
        );

        return apply_filters( 'electro_home_v11_bwpc_options', $bwpc_options, $post );
    }
}

function electro_get_home_v11_two_banners_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $two_banners_options = array(
            'image_1' => array(
                'image_url'   => 'https://via.placeholder.com/690x151?text=electro',
                'action_link' => '#'
            ),
            'image_2' => array(
                'image_url'   => 'https://via.placeholder.com/690x151?text=electro',
                'action_link' => '#'
            )
        );

        return apply_filters( 'electro_home_v11_two_banners_options', $two_banners_options, $post );
    }
}

function electro_get_home_v11_products_carousel_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $products_carousel_options = array(
			'section_title'     => esc_html__( 'Price Deals', 'electro' ),
			'button_text'       => esc_html__( 'Go to Daily Deals Section', 'electro' ),
			'button_link'       => '#',
            'products' => array(
                'shortcode'         => 'recent_products',
                'products_ids_skus' => '',
                'shortcode_atts'    => array(
                    'per_page' => 10,
                    'orderby'  => 'date',
                    'order'    => 'ASC'
                ),
                'carousel_args' => array(
                    'slideToShow' => 7,
                    'autoplay'    => false
                )
            )
		);
        
        return apply_filters( 'electro_home_v11_products_carousel_options', $products_carousel_options, $post );
    }
}

function electro_get_home_v11_trending_products_carousel_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $trending_products_carousel_options = array(
			'section_title'     => esc_html__( 'Trending products', 'electro' ),
			'button_text'       => esc_html__( 'Go to Trending products', 'electro' ),
			'button_link'       => '#',
            'products' => array(
                'shortcode'         => 'recent_products',
                'products_ids_skus' => '',
                'shortcode_atts'    => array(
                    'per_page' => 10,
                    'orderby'  => 'date',
                    'order'    => 'ASC'
                ),
                'carousel_args' => array(
                    'slideToShow' => 7,
                    'autoplay'    => false
                )
            )
		);
        
        return apply_filters( 'electro_home_v11_trending_products_carousel_options', $trending_products_carousel_options, $post );
    }
}

if( ! function_exists( 'electro_home_v11_hook_control' ) ) {
    function electro_home_v11_hook_control() {
        if( is_page_template( array( 'template-homepage-v11.php' ) ) ) {
            remove_all_actions( 'homepage_v11' );

            $home_v11_general_options = electro_get_home_v11_general_options();

            $is_page_content_enabled = $home_v11_general_options[ 'page_content' ][ 'is_enabled' ];
            if ( $is_page_content_enabled ) {
                add_action( 'homepage_v11', 'electro_home_v11_page_template_content', $home_v11_general_options[ 'page_content' ][ 'priority' ] );
            }

            add_action( 'homepage_v11', 'electro_home_v11_slider_block', $home_v11_general_options[ 'slider' ][ 'priority' ] );
            add_action( 'homepage_v11', 'electro_home_v11_brands_with_category_block',$home_v11_general_options[ 'bwc' ][ 'priority' ] );
            add_action( 'homepage_v11', 'electro_home_v11_banner_with_products_carousel', $home_v11_general_options[ 'bwpc' ][ 'priority' ] );
            add_action( 'homepage_v11', 'electro_home_v11_banners_block', $home_v11_general_options[ 'banners' ][ 'priority' ] );
            add_action( 'homepage_v11', 'electro_home_v11_products_carousel', $home_v11_general_options[ 'pc' ][ 'priority' ] );
            add_action( 'homepage_v11', 'electro_home_v11_trending_products_carousel', $home_v11_general_options[ 'tpc' ][ 'priority' ] );
        }
    }
}