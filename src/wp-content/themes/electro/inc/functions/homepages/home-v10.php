<?php
/**
 * Functions used in Home v10
 */

function electro_get_home_v10_general_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $general_options = array(
            'page_content' => array(
                'is_enabled' => false,
                'priority'   => 5,
                'animation'  => ''
            ),
            'swadb'        => array(
                'is_enabled' => true,
                'priority'   => 10,
                'animation'  => ''
            ),
            'swpb'        => array(
                'is_enabled' => true,
                'priority'   => 20,
                'animation'  => ''
            )
        );

        return apply_filters( 'electro_home_v10_general_options', $general_options, $post );
    }
}

function electro_get_home_v10_swadb_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $swadb_options = array(
            'bg_image'          => 'https://via.placeholder.com/1920x703?text=electro',
            'slider_shortcode'  => '[rev_slider alias="home-v10-slider"]',
            'adb'               => array(
                array(
                    'title'       => wp_kses_post( __( 'Catch Big <strong>Deals</strong> on<br>The Consoles', 'electro' ) ),
                    'action_text' => esc_html__( 'Shop now', 'electro' ),
                    'image'       => '',
                    'url'         => '#'
                ),
                array(
                    'title'       => wp_kses_post( __( 'SHOP THE <strong>HOTTEST</strong><br>PRODUCTS', 'electro' ) ),
                    'action_text' => esc_html__( 'Shop now', 'electro' ),
                    'image'       => '',
                    'url'         => '#'
                )
            )
        );
    
        return apply_filters( 'electro_home_v10_swadb_options', $swadb_options, $post );
    }
}

function electro_get_home_v10_swpb_options() {
    global $post;

    if ( isset( $post->ID ) ) {

        $swpb_options = array(
            'enable_sidebar'        => true,
            'sidebar_menu_title'    => esc_html__( 'Assortment', 'electro' ),
            'section_title'         => esc_html__( 'Hot Products Today', 'electro' ),
            'paginate'              => true,
            'shortcode'             => 'recent_products',
            'products_ids_skus'     => '',
            'shortcode_atts'        => array(
                'columns'  => '5',
                'per_page' => 15,
                'orderby'  => 'date',
                'order'    => 'ASC'
            ),
        );

		if ( electro_is_wide_enabled() ) {
			$swpb_options[ 'shortcode_atts' ]['columns_wide'] = '5';
		}

        return apply_filters( 'electro_home_v10_swpb_options', $swpb_options, $post );
    }
}

if( ! function_exists( 'electro_home_v10_hook_control' ) ) {
    function electro_home_v10_hook_control() {
        if( is_page_template( array( 'template-homepage-v10.php' ) ) ) {
            remove_all_actions( 'homepage_v10' );

            $home_v10_general_options = electro_get_home_v10_general_options();

            $is_page_content_enabled = $home_v10_general_options[ 'page_content' ][ 'is_enabled' ];
            if ( $is_page_content_enabled ) {
                add_action( 'homepage_v10', 'electro_home_v10_page_template_content', $home_v10_general_options[ 'page_content' ][ 'priority' ] );
            }

            add_action( 'homepage_v10', 'electro_home_v10_slider_with_ads_block', $home_v10_general_options[ 'swadb' ][ 'priority' ] );
            add_action( 'homepage_v10', 'electro_home_v10_sidebar_with_products', $home_v10_general_options[ 'swpb' ][ 'priority' ] );
        }
    }
}