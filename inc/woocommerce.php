<?php


function custom_product_description($id)
{
    if ($id == '') {
        $id = get_the_ID();
    }
    global $product;

    // If the product object is not defined, we get it from the product ID
    if (!is_a($product, 'WC_Product') && get_post_type($id) === 'product') {
        $product = wc_get_product($id);
    }

    if (is_a($product, 'WC_Product')) {
        return $product->get_short_description();
    }
}


include "radiators-functions/woocommerce-hooks.php";

/**
 * Remove default Woocommerce Styles
 */

add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');
function jk_dequeue_styles($enqueue_styles)
{
    unset($enqueue_styles['woocommerce-general']);    // Remove the gloss
    unset($enqueue_styles['woocommerce-layout']);        // Remove the layout
    unset($enqueue_styles['woocommerce-smallscreen']);    // Remove the smallscreen optimisation
    return $enqueue_styles;
}


/**
 * Enqueue own stylesheet and JS
 */
function wp_enqueue_woocommerce_style()
{
    $script_version = '1.1.1.5';
    $path_min = ".min";
    if (defined('WP_DEBUG') && true === WP_DEBUG) {
        $path_min = "";
    }

    wp_register_script('ber-js-calc-scripts', get_stylesheet_directory_uri() . '/assets/js/calculatorScripts' . $path_min . '.js', array('ber-scripts'), $script_version, true);
    wp_register_script('ber-woo-scripts', get_stylesheet_directory_uri() . '/assets/js/productScripts' . $path_min . '.js', array('ber-scripts'), $script_version, true);
    wp_register_script('cvy_fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js', array('jquery'), null, true);
    wp_register_style('cvy_fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css');
    wp_register_script('sweet_alert', 'https://unpkg.com/sweetalert/dist/sweetalert.min.js', array('jquery'), null, true);


    // If Page had Woocommerce elements then include general CSS
    if (ber_is_woo()) {
        wp_enqueue_style('woocommerce-layout');
        wp_enqueue_style('woocommerce-general');

    }
    if (is_product() || is_cart() || is_checkout() || is_account_page()) {
        wp_enqueue_style('woocommerce-general');
    }
    if (is_page('blog') || is_singular('post')) {
        wp_enqueue_script('elementor-sticky');
    }

    // Product specific Scripts
    if (is_product()) {
        wp_enqueue_style('ber-css-single-form');
        wp_enqueue_style('ber-css-single-gallery');
        wp_enqueue_script('reel', get_stylesheet_directory_uri() . '/assets/js/jquery.reel-min.js', array('ber-scripts'), null, true);

    }


}

add_action('wp_enqueue_scripts', 'wp_enqueue_woocommerce_style');

/**
 * Check for Page with Woocommerce Elements
 */
function ber_is_woo()
{

    if (is_woocommerce() ||
        is_cart() ||
        is_checkout() ||
        is_search() ||
        is_account_page() ||
        (is_page("radiator-calculator")) ||
        (is_page("electric-central-heating")) ||
        (is_page("replacing-storage-heaters"))
    ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Retrieve GTIN value for Trustpilot
 */
function get_gtin($value, $attr_field, $product)
{
    if (class_exists('WoocommerceProductFeedsMain')) { // WooCommerce Google Product Feed plugin is active
        if ($attr_field == "gtin") {
            $gpf_data = get_post_meta($product->get_id(), '_woocommerce_gpf_data', true);
            if (!empty($gpf_data['gtin'])) {
                $value = $gpf_data['gtin'];
            }
        }
    }

    return $value;
}

add_filter('trustpilot_inventory_attribute_value', 'get_gtin', 10, 3);

add_filter('woocommerce_product_price_class', function ($class) {
    if (has_term(18, 'product_cat') || has_term(162, 'product_cat')) {
        return $class;
    }
    $class .= ' mobile-variation-price JS--mobile-price';
    return $class;
});

add_action('pre_get_posts', 'wpse223576_search_woocommerce_only');

function wpse223576_search_woocommerce_only($query)
{

    if (is_archive()) {

        $cat = get_queried_object();
        if ($query->get('tax_query') && ($cat->term_id == 117 || $cat->term_id == 116) && (empty($_GET) || $_GET['filter_colour'] == '')) {
            $query->set('tax_query', ['relation' => "AND", array("taxonomy" => "pa_colour", "field" => "slug", "terms" => $cat->slug)]);
        }

    }
    if (!is_admin() && is_search() && $query->is_main_query()) {

        $args = array(
            'post_type' => array('product', ),
            'post_status' => 'publish',
            's' =>get_search_query()
        );
        $the_query = new WP_Query( $args );
        $ids=[];
        $p_ids=[];
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $ids[]=get_the_ID();
            }
        }
        wp_reset_postdata();
        $p_args = [
            'post_status' => 'publish',
            'post_type' => array('product', 'product_variation'),
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'pa_wattage',
                    'field' => 'name',
                    'terms' => is_numeric($_GET['s']) ? $_GET['s'] . 'w' : $_GET['s'],
                ),
                ber_query_term('pa_brand'), ber_query_term('pa_dimensions'), ber_query_term('pa_control-type'), ber_query_term('pa_colour'), ber_query_term('pa_capacity'),

            ),
        ];
        $p = new WP_Query( $p_args );
        if ( $p->have_posts() ) {
            while ( $p->have_posts() ) {
                $p->the_post();
                $p_ids[]=get_the_ID();
            }
        }
        wp_reset_postdata();
        if (count($p_ids))
            $ids = array_merge($ids, $p_ids);
        $query->set('post__in', $ids);
        $query->set('s', ' ');
    }


}

add_filter('get_search_query', function ($query) {
    return isset($_GET) && isset($_GET['s']) && !is_admin() && is_search() ? $_GET['s'] : $query;
});

add_filter('woocommerce_loop_add_to_cart_link', function ($arg) {


    if (strrpos($arg, 'View') !== false) {
        $arg = str_replace('View', 'Shop', $arg);
    }
    return $arg;
}, 11);

function ber_query_term($name)
{
    return array(
        'taxonomy' => $name,
        'field' => 'name',
        'terms' => $_GET['s'],
    );
}

add_action('woocommerce_email', function ($email_class) {
    remove_action('woocommerce_email_customer_details', array($email_class, 'customer_details'), 10, 3);
    remove_action('woocommerce_email_customer_details', array($email_class, 'email_addresses'), 20, 3);
    add_action('woocommerce_email_before_order_table', array($email_class, 'customer_details'), 7, 3);
    add_action('woocommerce_email_before_order_table', array($email_class, 'email_addresses'), 8, 3);
});
add_filter('woocommerce_email_order_item_quantity', function ($quantity) {

    return esc_html('Quantity: ', 'woocommerce'). $quantity;
});

add_filter( 'woocommerce_email_order_items_args', function ( $args ) {
    $args['show_image'] = true;
    $args['image_size'] = array( 115, 115 );
    return $args;
} );

add_action('woocommerce_email_header', 'add_css_to_email');

function add_css_to_email() {
    echo '
 <style type="text/css">
 /* Put CSS here */
 @font-face {
   font-family: "Lato", sans-serif;
   src: url("https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap");
 }


 </style>';
}


add_action('wc_ajax_custom_add_to_cart', 'custom_add_to_cart_handler');
add_action('wc_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart_handler');
function custom_add_to_cart_handler()
{
    if (isset($_POST['product_id']) && isset($_POST['form_data'])) {
        $product_id = $_POST['product_id'];

        $variation = $cart_item_data = $custom_data = array(); // Initializing
        $variation_id = 0; // Initializing
        $cart_item_data = (array)apply_filters('woocommerce_add_cart_item_data', $cart_item_data, $product_id, $variation_id, $quantity, $custom_data);
        $cart = WC()->instance()->cart;
        $products = [];
        foreach ($_POST['form_data'] as $values) {
            if (strpos($values['name'], 'attributes_') !== false) {
                $variation[$values['name']] = $values['value'];
            } elseif ($values['name'] === 'quantity') {
                $quantity = $values['value'];
            } elseif ($values['name'] === 'variation_id') {
                $variation_id = $values['value'];
            } elseif ($values['name'] !== 'add_to_cart') {
                $custom_data[$values['name']] = esc_attr($values['value']);
            }
            if ($values['name'] == 'upsells[]') {
                $cart_item_key = WC()->cart->add_to_cart(esc_attr($values['value']));
                $_product = wc_get_product($values['value']);
                $products[] = $_product->get_name();

            }

        }

        $product = wc_get_product($variation_id ? $variation_id : $product_id);

        // Allow product custom fields to be added as custom cart item data from $custom_data additional array variable

        // Add to cart
        $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data);

        $products[] = $product->get_name();
        $st = '';
        if ($cart_item_key) {
            $st .= sprintf(
                '<a href="%s" class="button wc-forward">%s</a>',
                wc_get_cart_url(),
                __("View cart", "woocommerce")
            );
            foreach ($products as $item) {
                // Add to cart successful notice
                $st .= $item.
                    __(" has been added to your basket.", "woocommerce"). '</br>';

            }
            wc_add_notice($st);
        }


        wc_print_notices(); // Return printed notices to jQuery response.
        wp_die();
    }
}
