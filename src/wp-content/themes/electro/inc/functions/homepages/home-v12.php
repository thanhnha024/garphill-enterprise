<?php
/**
 * Functions used in Home v12
 */

function electro_get_home_v12_page_content_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $page_content = array(
            'is_enabled' => false,
            'priority'   => 15,
            'animation'  => '',
        );
    
        return apply_filters( 'electro_home_v12_page_content_options', $page_content, $post );
    }
}

function electro_get_home_v12_slider_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $slider_options = array(
            'is_enabled' => true,
            'priority'   => 10,
            'animation'  => '',
            'slider_shortcode'  => '[rev_slider alias="home-v12-slider"][/rev_slider]',
        );
    
        return apply_filters( 'electro_home_v12_slider_options', $slider_options, $post );
    }
}

function electro_get_home_v12_categories_options() {
    global $post;

    if ( isset( $post->ID ) ) {
        $categories_options = array(
            'categories' => array(
                'columns'    => 5,
                'orderby'    => 'menu_order',
                'order'      => 'ASC',
                'number'     => 5,
                'hide_empty' => false,
                'cat_object' => '',
            ),
            'is_enabled' => true,
            'priority'   => 20,
            'animation'  => '',
        );
        
        return apply_filters( 'electro_home_v12_categories_options', $categories_options, $post );
    }
}

function electro_get_home_v12_hot_products_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $products_options = array(
            'section_title'         => esc_html__( 'Hot Products Today', 'electro' ),
            'shortcode'             => 'recent_products',
            'products_ids_skus'     => '',
            'shortcode_atts'        => array(
                'columns'  => '6',
                'per_page' => 6,
                'orderby'  => 'date',
                'order'    => 'ASC'
            ),
            'is_enabled' => true,
            'priority'   => 30,
            'animation'  => '',
        );

		if ( electro_is_wide_enabled() ) {
			$products_options[ 'shortcode_atts' ]['columns_wide'] = '6';
		}

        return apply_filters( 'electro_home_v12_hot_products_options', $products_options, $post );
    }
}

function electro_get_home_v12_banners_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $banners_options = array(
            'banners' => array(
                'banner_1' => array(
                    'bg_image' => 'https://via.placeholder.com/690x151?text=electro',
                    'image'    => 'https://via.placeholder.com/300x300/743434/FFFFFF?text=electro',
                    'url'      => '#',
                    'desc'     => wp_kses_post( '<strong>#STAYHOME</strong> AND CATCH BIG <strong>DEALS</strong> ON THE GAMES &amp; CONSOLES' )
                ),
                'banner_2' => array(
                    'bg_image'       => 'https://via.placeholder.com/690x151?text=electro',
                    'url'            => '#',
                    'desc'           => esc_html__( 'OFFICE LAPTOPSFOR WORK', 'electro' ),
                    'price_pre_text' => esc_html__( 'FROM', 'electro' ),
                    'price_text'     => wp_kses_post( '<sup class="h5 fw-bold mb-0">$</sup>749<sup class="h5 fw-bold mb-0">99</sup>' )
                ),
                'banner_3' => array(
                    'bg_image'    => 'https://via.placeholder.com/690x151?text=electro',
                    'url'         => '#',
                    'title'       => esc_html__( 'LIMITED', 'electro' ),
                    'subtitle'    => esc_html__( 'WEEK DEAL', 'electro' ),
                    'desc'        => esc_html__( 'HURRY UP BEFORE OFFER WILL END', 'electro' ),
                )
            ),
            'is_enabled' => true,
            'priority'   => 40,
            'animation'  => '',
        );

        return apply_filters( 'electro_home_v12_banners_options', $banners_options, $post );
    }
}

function electro_get_home_v12_new_products_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $products_options = array(
            'section_title'         => esc_html__( 'New Products', 'electro' ),
            'shortcode'             => 'recent_products',
            'products_ids_skus'     => '',
            'shortcode_atts'        => array(
                'columns'  => '6',
                'per_page' => 6,
                'orderby'  => 'date',
                'order'    => 'ASC'
            ),
            'is_enabled' => true,
            'priority'   => 50,
            'animation'  => '',
        );

		if ( electro_is_wide_enabled() ) {
			$products_options[ 'shortcode_atts' ]['columns_wide'] = '6';
		}

        return apply_filters( 'electro_home_v12_new_products_options', $products_options, $post );
    }
}

function electro_get_home_v12_recommend_products_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $products_options = array(
            'section_title'         => esc_html__( 'Recommendations', 'electro' ),
            'shortcode'             => 'recent_products',
            'products_ids_skus'     => '',
            'shortcode_atts'        => array(
                'columns'  => '6',
                'per_page' => 6,
                'orderby'  => 'date',
                'order'    => 'ASC'
            ),
            'is_enabled' => true,
            'priority'   => 60,
            'animation'  => '',
        );

		if ( electro_is_wide_enabled() ) {
			$products_options[ 'shortcode_atts' ]['columns_wide'] = '6';
		}

        return apply_filters( 'electro_home_v12_recommend_products_options', $products_options, $post );
    }
}

function electro_get_home_v12_blog_posts_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $blog_posts_options = array(
            'section_title'  => esc_html__( 'Tips & Inspirations', 'electro' ),
            'posts_per_page' => 2,
            'columns'        => 2,
            'post__in'       => array(),
            'orderby'        => 'date',
            'order'          => 'ASC',
            'is_enabled'     => true,
            'priority'       => 70,
            'animation'      => '',
        );

        return apply_filters( 'electro_home_v12_blog_posts_options', $blog_posts_options, $post );
    }
}

function electro_get_home_v12_brands_options() {
    global $post;

    if ( isset( $post->ID ) ) {
        $brands_options = array(
            'section_title' => esc_html__( 'Known Brands', 'electro' ),
            'columns'       => 3,
            'orderby'       => 'name',
            'order'         => 'ASC',
            'number'        => 6,
            'hide_empty'    => false,
            'is_enabled'    => true,
            'priority'      => 80,
            'animation'     => '',
        );
        
        return apply_filters( 'electro_home_v12_brands_options', $brands_options, $post );
    }
}

if( ! function_exists( 'electro_home_v12_hook_control' ) ) {
    function electro_home_v12_hook_control() {
        if( is_page_template( array( 'template-homepage-v12.php' ) ) ) {
            remove_all_actions( 'homepage_v12' );

            $page_content      = electro_get_home_v12_page_content_options();
            $slider            = electro_get_home_v12_slider_options();
            $categories        = electro_get_home_v12_categories_options();
            $hot_product       = electro_get_home_v12_hot_products_options();
            $banners           = electro_get_home_v12_banners_options();
            $new_product       = electro_get_home_v12_new_products_options();
            $recommend_product = electro_get_home_v12_recommend_products_options();
            $blog_posts        = electro_get_home_v12_blog_posts_options();
            $brands            = electro_get_home_v12_brands_options();

            $priorities = array();

            if ( $page_content[ 'is_enabled' ] ) {
                $priorities[] = $page_content[ 'priority' ];
            }

            if ( $slider[ 'is_enabled' ] ) {
                $priorities[] = $slider[ 'priority' ];
            }

            if ( $slider[ 'is_enabled' ] ) {
                $priorities[] = $slider[ 'priority' ];
            }

            if ( $categories[ 'is_enabled' ] ) {
                $priorities[] = $categories[ 'priority' ];
            }

            if ( $banners[ 'is_enabled' ] ) {
                $priorities[] = $banners[ 'priority' ];
            }

            if ( $new_product[ 'is_enabled' ] ) {
                $priorities[] = $new_product[ 'priority' ];
            }

            if ( $recommend_product[ 'is_enabled' ] ) {
                $priorities[] = $recommend_product[ 'priority' ];
            }

            if ( $blog_posts[ 'is_enabled' ] ) {
                $priorities[] = $blog_posts[ 'priority' ];
            }

            if ( $brands[ 'is_enabled' ] ) {
                $priorities[] = $brands[ 'priority' ];
            }

            $wrapper_start_priority = 20;

            if ( is_array( $priorities ) && ! empty( $priorities ) ) {
                $wrapper_start_priority = min( $priorities );
            }
            
            add_action( 'homepage_v12', 'electro_home_v12_slider_block',           $slider[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_page_template_content',  $page_content[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_categories_block',       $categories[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_hot_products',           $hot_product[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_banners',                $banners[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_new_products',           $new_product[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_recommend_products',     $recommend_product[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_blog_posts',             $blog_posts[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_brands_block',           $brands[ 'priority' ] );
            add_action( 'homepage_v12', 'electro_home_v12_body_inner_wrap_start',  $wrapper_start_priority );
            add_action( 'homepage_v12', 'electro_home_v12_body_inner_wrap_end',    PHP_INT_MAX );
        }
    }
}
