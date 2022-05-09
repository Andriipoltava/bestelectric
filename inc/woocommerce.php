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
    if (!has_term(18, 'product_cat')) {
        $class .= ' mobile-variation-price JS--mobile-price';
    }
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
        $posts = get_posts([
            'post_type' => 'product',
            'post_status' => 'publish',
            's' => $_GET['s'],
        ]);
        $ids = array_column($posts, 'ID');
        $p = get_posts([
            'post_status' => 'publish',
            'post_type' => array('product', 'product_variation'),
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'pa_wattage',
                    'field' => 'name',
                    'terms' => is_numeric($_GET['s']) ? $_GET['s'] . 'w' : $_GET['s'],
                ),
                term('pa_brand'), term('pa_dimensions'), term('pa_control-type'), term('pa_colour'), term('pa_capacity'),

            ),
        ]);
        if (count($p))
            $ids = array_merge($ids, array_column($p, 'ID'));
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