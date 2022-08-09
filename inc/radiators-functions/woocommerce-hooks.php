<?php

// Wrap the default Woo product loop
add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_wrapper_start', 5);
function woocommerce_template_loop_product_wrapper_start()
{
    $product = wc_get_product(get_the_ID());
    if (is_product_category('electric-radiators') && $product->get_parent_id()) {
        echo '<div class="с-product-loop-block c-electric-radiators">';

        $parent_id = $product->get_parent_id();
        $product_label = get_field('label', $parent_id);
        if ($product_label) :
            echo '<div class="c-compare-ranges__thumb">';
        endif;

    } else {
        echo '<div class="с-product-loop-block">';
    }
}

// For reference
// add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 ); 

// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );


// Add product label after thumbnail
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_content', 15);
function woocommerce_template_loop_product_content()
{
    $label = get_field('label');
    $label_color = get_field('product_label_color');
    if ($label) {
        echo '<div class="cvy_label ' . __($label_color == 'blue' ? 'cvy_label--blue' : null) . '">' . $label . '</div>';
    }
}

// Move the link close to before the Title (after the thumbnail and label)
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close');

// For Reference
// add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// Remove the default Loop Title
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

// Add the new Title and short description
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_description', 5);
function woocommerce_template_description()
{
    $product = wc_get_product(get_the_ID());
    if (is_product_category('electric-radiators') && $product->get_parent_id()) {

        $parent_id = $product->get_parent_id();
        $product_label = get_field('label', $parent_id);
        $label_color = get_field('product_label_color', $parent_id);

        $color_terms = wp_get_post_terms($product->get_id(), 'pa_colour');

        if ($product_label) :
            echo '<div class="c-compare-ranges-terms "><div class="c-compare-ranges__colors ">';
            foreach ($color_terms as $term) :
                $product_color = get_term_meta($term->term_id);
                echo '<a href="' . get_the_permalink($product->get_id()) . '"
                                       data-colour="' . $term->slug . '"
                                       class="c-compare-ranges__color-btn JS--compare-ranges-color"
                                       style="background-color:' . $product_color['product_attribute_color'][0] . '"></a>';
            endforeach;
            echo '</div></div>';
            echo ' <span class="c-compare-ranges__label ' . (($label_color == 'blue') ? 'c-compare-ranges__label--blue' : "") . ' ">' . $product_label . '</span> ';

            echo '</div>';
        endif;
        echo '<div class="c-product-loop-content">';


        echo '
                <div class="c-product-loop-title"><a href="' . get_the_permalink() . '">' . str_replace('Wifi', '<sup>wifi</sup>', get_the_title($parent_id)) . '</a></div>
                <div class="c-product-loop-wattage"> ' . $product->get_attribute('pa_wattage') . '</div>
                <div class="c-product-loop-price"> ' . $product->get_price_html() . '</div>
                
                ';
    } else {
        echo '<div class="c-product-loop-content">';

        echo '<div class="c-product-loop-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
    }


    $short_description = get_field('loop_short_description');

    if ($short_description) {
        echo '<div class="c-product-loop-description">' . $short_description . '</div>';
    }
    echo '<div class="c-product-loop-footer">';
}

// For reference
// add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
// add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 ); <-- Removed
// add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Close all the open nodes
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_wrapper_end', 10);
function woocommerce_template_loop_product_wrapper_end()
{
    //echo '<a class="button" href="' . get_the_permalink() . '">View</a>';
    echo '</div>'; // Close .c-product-loop-footer
    echo '</div>'; // Close .c-product-loop-content
    echo '</div>'; // Close .с-product-loop-block
}


add_action('woocommerce_after_add_to_cart_quantity', 'elr_display_quantity_plus');
function elr_display_quantity_plus()
{
    echo '<button type="button" class="c-quantity-btn c-quantity-btn--plus JS--quantity-plus" >+</button>';
}


add_action('woocommerce_before_add_to_cart_quantity', 'elr_display_quantity_minus');
function elr_display_quantity_minus()
{
    echo '<span class="product-cart-inc">inc. VAT</span>';
    echo '<button type="button" class="c-quantity-btn c-quantity-btn--minus JS--quantity-minus" >&ndash;</button>';
}


/*add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' );
function woocommerce_custom_single_add_to_cart_text() {
    global $product;
    $product_availability = $product->get_availability();
    echo 'Add to basket <span class="product-availability">'.$product_availability["availability"].'</span>';
}*/


add_action('woocommerce_before_add_to_cart_quantity', 'add_to_btn_product_availability');
function add_to_btn_product_availability()
{
    global $product;
    $product_availability = $product->get_availability();

    echo '<span class="product-availability JS--product-availability">' . $product_availability["availability"] . '</span>';
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

//add_filter( 'woocommerce_short_description', 'add_text_after_excerpt_single_product', 20, 1 );
/*function add_text_after_excerpt_single_product( $post_excerpt ){

    $trustpilot_code = get_field('top_trustpilot_code');
    if ( ! $post_excerpt )
        return;

    if($trustpilot_code){
        $post_excerpt = '<div class="o-product-top__trustpilot JS--tustpilot-loader"><div class="o-product-top__trustpilot--loader"></div>'.$trustpilot_code.'</div>';
    }

    return $post_excerpt;
}*/

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_filter('wpseo_breadcrumb_single_link', 'remove_shop', 10, 2);
function remove_shop($link_output, $link)
{
    if ($link['text'] == 'Shop') {
        $link_output = '';
    }
    return $link_output;
}

add_action('woocommerce_after_add_to_cart_form', function () {
    if (get_field('payment_logos', 'option')) {
        ?>
        <div id="ppc-top-title"  class="hide" >
            <?php _e('or checkout with'); ?>
        </div>
        <?php
    }
});
