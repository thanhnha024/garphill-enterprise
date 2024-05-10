<?php
/**
 * Electro Child
 *
 * @package electro-child
 */

/**
 * Include all your custom code here
 */


// add custom VC element
function custom_vc_element() {
    // get list product
    $product_categories = get_categories( array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'order'   => 'ASC',
        'hide_empty' => true
    ) );

    $category_options = array();
    foreach ( $product_categories as $category ) {
        $category_options[ $category->name ] = $category->term_id;
    }

    // Add options for sort select box
    $sort_options = array(
        'Newest' => 'newest',
        'Random' => 'random',
        'Oldest' => 'oldest',
    );

    vc_map( array(
        "name" => __("Two Row Product Category", "text-domain"),
        "base" => "Two_Row_Product_Category",
        "category" => __("Content", "text-domain"),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", "text-domain"),
                "param_name" => "title",
                "value" => "",
                "description" => __("Input Title", "text-domain")
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Select Product Category", "text-domain"),
                "param_name" => "product_category",
                "value" => $category_options,
                "description" => __("Select Product Category", "text-domain")
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Sort By", "text-domain"),
                "param_name" => "sort",
                "value" => $sort_options,
                "description" => __("Sort By", "text-domain")
            ),                
        )
    ) );

    
}
add_action( 'vc_before_init', 'custom_vc_element' );

// display custom element
function custom_vc_element_output( $atts ) {
    $atts = shortcode_atts( array(
        'title' => '',
        'product_category' => '',
        'sort' => 'newest',
    ), $atts );

    $title = $atts['title'];
    $product_category = $atts['product_category'];
    $sort = $atts['sort'];
    // Kiểm tra xem danh mục đã chọn có tồn tại không
    $category = get_term_by('id', $product_category, 'product_cat');
    if (!$category) {
        return 'Danh mục sản phẩm không tồn tại.';
    }

    // Truy vấn sản phẩm thuộc danh mục đã chọn
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $product_category,
                'operator' => 'IN',
            )
        ),
        'orderby' => 'date', 
        'order' => 'DESC',

    );

    switch ($sort) {
        case 'random':
            $args['orderby'] = 'rand';
            break;
        case 'oldest':
            $args['order'] = 'ASC';
            break;
        case 'newest':
        default:
            $args['order'] = 'DESC';
            break;
    }

    $products_query = new WP_Query( $args );

    // Hiển thị tiêu đề
    $output = '<header class="mb-0 custom-header"><h2 class="h1">' . esc_html( $title ) . '</h2></header>';

    if ( $products_query->have_posts() ) {
        $output .= '<ul data-view="grid" data-bs-toggle="regular-products" class="products products list-unstyled row g-0 row-cols-2 row-cols-md-3 row-cols-lg-6 row-cols-xl-6 row-cols-xxl-6">';
        while ( $products_query->have_posts() ) {
            $products_query->the_post();
            //get id product
            $product_id = get_the_ID();
            //get name product
            $product = wc_get_product( get_the_ID() );
            //get price product
            $price = $product->get_price_html();
            //get image product
            $image = $product->get_image();
            //get category
            $categories = get_the_terms( get_the_ID(), 'product_cat' );
            $category_name = '';
            if ( $categories && ! is_wp_error( $categories ) ) {
                $category_name = $categories[0]->name; // Chỉ lấy tên của chuyên mục đầu tiên
            }
            //create button add to cart
            $add_to_cart_url = $product->add_to_cart_url();
            $add_to_cart_button = '<a href="' . esc_url( $add_to_cart_url ) . '"class="button product_type_simple add_to_cart_button ajax_add_to_cart">Add to Cart</a>';
            
            //display information product
            $output .= '<li class="product product-custom">';
            $output .= '<a href="' . get_permalink() . '">' ;
            $output .= '<span class="loop-product-categories">' . $category_name . '</span>';
            $output .= '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
            $output .= '<div class="product-thumbnail product-item__thumbnail">' . $image . '</div>';
            $output .= '<div class="product-loop-footer product-item__footer"><div class="price-add-to-cart"><span class="price">' . $price . '</span><div class="custom-button add-to-cart-wrap" data-bs-toggle="tooltip" data-bs-title="Add to cart" data-bs-original-title="" title="">' . $add_to_cart_button . '</div></div></div>';
            $output .= '<div class="yith-wcwl-add-button"><a href="?add_to_wishlist=' . $product_id .'&amp;_wpnonce=880dcfd0e9" data-product-id="' . $product_id .'" data-product-type="simple" data-original-product-id="' . $product_id . '" class="add_to_wishlist single_add_to_wishlist" data-product-type="simple" data-title="Add to wishlist" rel="nofollow"><i class="yith-wcwl-icon fa fa-heart-o"></i><span>Add to wishlist</span></a></div>';
            $output .= '</a></li>';
        }
        $output .= '</ul>';
    } else {
        $output .= 'Không có sản phẩm nào thuộc danh mục này.';
    }
    

    // Reset query
    wp_reset_postdata();

    return $output;
}
add_shortcode( 'Two_Row_Product_Category', 'custom_vc_element_output' );
