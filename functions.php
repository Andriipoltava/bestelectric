<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */

define('helloChildCss', get_stylesheet_directory_uri());

require_once __DIR__ . '/inc/include.php';


/*------------------------------------*\
Enqueue scripts and styles.
\*------------------------------------*/
function script_version()
{
    return '20220905';
}

function path_min()
{

    $path_min = ".min";
    if (defined('WP_DEBUG') && true === WP_DEBUG) {
        $path_min = "";
    }
    return $path_min;

}


/*------------------------------------*\
    WooCommerce Fucntions
\*------------------------------------*/
if (class_exists('WooCommerce')) {
    require_once __DIR__ . '/inc/woocommerce.php';
}


if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Header',
        'menu_title' => 'Header settings',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Product calculator Banner',
        'menu_title' => 'Product calculator Banner',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Global',
        'menu_title' => 'Global settings',
        'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title' => 'Email',
        'menu_title' => 'Email Template',
        'parent_slug' => 'theme-general-settings',
    ));


}


if (!function_exists('bestelectric_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function bestelectric_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Chiquita, use a find and replace
         * to change 'chiquita' to the name of your theme in all the template files.
         */
        load_theme_textdomain('bestelectric', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        add_theme_support('woocommerce');
        // image sizes
        //add_image_size('latest-news-thumb', 176, 176, true);

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('small-product', 60, 56, true); // Small Thumbnail
        add_image_size('product-more-slider', 309, 304, true);
        add_image_size('woocommerce_single_crop', 645, 545, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'bestelectric'),
            'el-rad-type' => esc_html__('Electric Radiators Type', 'bestelectric'),
            'el-rad-room' => esc_html__('Electric Radiators Room', 'bestelectric'),
            'el-rad-wattage' => esc_html__('Electric Radiators Wattage', 'bestelectric'),
            'el-rad-color' => esc_html__('Electric Radiators Color', 'bestelectric'),
            'el-help_advise' => esc_html__('Help & Advice', 'bestelectric'),
            'main-mobile-menu' => esc_html__('Mobile main menu', 'bestelectric'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('bestelectric_custom_background_args', array(
            'default-color' => '#ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 42,
            'width' => 198,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'bestelectric_setup');

function bestelectric_scripts()
{
    $script_version = script_version();
    $path_min = path_min();

    wp_enqueue_style('ber-css-mego-menu');
    wp_enqueue_style('ber-css-search-form');
    wp_enqueue_script('ber-scripts-preload', get_stylesheet_directory_uri() . '/assets/js/preload.js', array('jquery'), $script_version, true);

    if (!is_singular('post')) {
        wp_enqueue_script('ber-scripts', get_stylesheet_directory_uri() . '/assets/js/globalScripts' . $path_min . '.js', array('jquery'), $script_version, true);
        wp_localize_script('ber-scripts', 'my_ajax_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'pageID' => get_the_ID(),
                'is_product' => is_singular('product'),
            )
        );

    }
    if (is_search()) {
        wp_enqueue_style('ber-woo-product');
    }
    if (is_product_category() || is_front_page()) {
        wp_enqueue_style('ber-css-compare-range');
    }

    if (function_exists('is_woocommerce')) {
        if (!is_woocommerce() && !is_cart() && !is_checkout()) {
            # Styles
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('woocommerce_frontend_styles');
            wp_dequeue_style('woocommerce_fancybox_styles');
            wp_dequeue_style('wc-blocks-vendors-style');

            # Scripts
            wp_dequeue_script('wc_price_slider');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-checkout');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-cart');
            wp_dequeue_script('wc-chosen');
            wp_dequeue_script('woocommerce');
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            wp_dequeue_script('jquery-blockui');
            wp_dequeue_script('jquery-placeholder');
            wp_dequeue_script('fancybox');
            wp_dequeue_script('jqueryui');


        }
    }
    wp_dequeue_style('hello-elementor');
    wp_dequeue_style('hello-elementor-theme-style');


}

add_action('wp_enqueue_scripts', 'bestelectric_scripts', 15);

function bestelectric_enqueue_scripts()
{

    $script_version = time();
    wp_enqueue_style('bestelectric-style', get_stylesheet_directory_uri() . '/assets/css/style.min.css', [], $script_version);
    wp_enqueue_style('ber-css-woo-basket');

}

add_action('wp_enqueue_scripts', 'bestelectric_enqueue_scripts', 11);

add_action('wp_enqueue_scripts', 'remove_default_stylesheet', 20);

function remove_default_stylesheet()
{
    wp_enqueue_style('bestelectric-load', get_stylesheet_directory_uri() . '/assets/css/load.css',);
}

add_action('wp_enqueue_scripts', 'remove_variations_swiper', 999999);

function remove_variations_swiper()

{
    if (function_exists('is_product_category')) {
        if(is_singular('product')){
            wp_dequeue_script('smart-variations-images-swiper');
            wp_dequeue_style('smart-variations-images-swiper');
            wp_dequeue_style('smart-variations-images');
            wp_dequeue_script('smart-variations-images-imagesloaded');
            wp_dequeue_script('smart-variations-images-ezplus');
            wp_dequeue_script('smart-variations-images-photoswipe');
            wp_dequeue_style('smart-variations-images-photoswipe');
            wp_dequeue_script('smart-variations-images-photoswipe-ui-default');
            wp_dequeue_style('smart-variations-images-photoswipe-ui-default');
            wp_dequeue_script('smart-variations-images-manifest');
            wp_dequeue_script('smart-variations-images-vendor');
        }
        if (is_product_category()) {
            wp_dequeue_script('ezplus');
            wp_dequeue_script('smart-variations-images-swiper');
            wp_dequeue_style('smart-variations-images-swiper');
            wp_dequeue_style('smart-variations-images');
            wp_dequeue_script('smart-variations-images-imagesloaded');
            wp_dequeue_script('smart-variations-images-ezplus');
            wp_dequeue_script('smart-variations-images-photoswipe');
            wp_dequeue_style('smart-variations-images-photoswipe');
            wp_dequeue_script('smart-variations-images-photoswipe-ui-default');
            wp_dequeue_style('smart-variations-images-photoswipe-ui-default');
            wp_dequeue_script('smart-variations-images-manifest');
            wp_dequeue_script('smart-variations-images-vendor');

        }
        if (is_product_category(21)) {
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_style('wc-blocks-style');
            wp_dequeue_style('woo_discount_pro_style');
            wp_dequeue_style('smart-variations-images-photoswipe-default-skin');
            wp_dequeue_style('woo-variation-swatches-theme-override');
            wp_dequeue_style('woo-variation-swatches-tooltip');
            wp_dequeue_style('afwssv_front');
            wp_dequeue_style('wc-gateway-ppec-frontend');
            wp_dequeue_script('dynamic-conditions');
        }
    }

}

function features_post_type()
{

// Set UI labels for Custom Post Type
    $labels = array(
        'name' => _x('Features', 'Post Type General Name', 'bestelectric'),
        'singular_name' => _x('Feature', 'Post Type Singular Name', 'bestelectric'),
        'menu_name' => __('Features', 'bestelectric'),
        'parent_item_colon' => __('Parent ', 'bestelectric'),
        'all_items' => __('All Features', 'bestelectric'),
        'view_item' => __('View Feature', 'bestelectric'),
        'add_new_item' => __('Add New Feature', 'bestelectric'),
        'add_new' => __('Add New', 'bestelectric'),
        'edit_item' => __('Edit Feature', 'bestelectric'),
        'update_item' => __('Update Feature', 'bestelectric'),
        'search_items' => __('Search Features', 'bestelectric'),
        'not_found' => __('Not Found', 'bestelectric'),
        'not_found_in_trash' => __('Not found in Trash', 'bestelectric'),
    );

// Set other options for Custom Post Type

    $args = array(
        'label' => __('Features', 'bestelectric'),
        'description' => __('BER Features', 'bestelectric'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 56,
        'rewrite' => array('slug' => 'features', 'with_front' => false),
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true
    );
    // Registering your Custom Post Type
    register_post_type('features', $args);

}


add_action('init', 'features_post_type');


// Disable Gutenberg on the back end.
add_filter('use_block_editor_for_post', '__return_false');

// Disable Gutenberg for widgets.
add_filter('use_widgets_blog_editor', '__return_false');


add_action('wp_enqueue_scripts', function () {
    // Remove CSS on the front end.
    wp_dequeue_style('wp-block-library');

    // Remove Gutenberg theme.
    wp_dequeue_style('wp-block-library-theme');

    // Remove inline global CSS on the front end.
    wp_dequeue_style('global-styles');
}, 20);

add_action('wp_enqueue_scripts', function () {
    if (!is_product()) {
        return;
    }

    $product = wc_get_product(get_the_ID());
    $gallery_images = $product->get_gallery_image_ids();
    if (!empty($gallery_images)) {
        return;
    }

    $custom_css = ".woocommerce-product-gallery{ opacity: 1 !important; }";
    wp_add_inline_style('woocommerce-layout', $custom_css);
});

add_filter('rocket_delay_js_exclusions', 'bestelectric_js_exclusions');

function bestelectric_js_exclusions($exclusions)
{

    if (is_front_page() && is_product_category()) {
        $exclusions[] = '/wp-content/themes/bestelectric/assets/js/preload.js';

    }
    if (!is_front_page()) {
        $exclusions[] = '/wp-content/themes/bestelectric/assets/js/widgets/slider-icon-list.js';
        $exclusions[] = '/wp-content/themes/bestelectric/assets/js/widgets/slider-icon-list.min.js';
    }

    if (!is_product()) {

        return $exclusions;
    }
    $exclusions[] = 'widget.trustpilot.com/bootstrap';
    $exclusions[] = 'widget.trustpilot.com';
    $exclusions[] = '/wp-content/plugins/trustpilot-reviews/review/(.*)';



    $exclusions[] = '/jquery-?[0-9.](.*)(.min|.slim|.slim.min)?.js';
    $exclusions[] = '/jquery-migrate(.min)?.js';
    $exclusions[] = 'swiper-bundle.min.js';

    $exclusions[] = '/wp-content/themes/bestelectric/assets/js/widgets/product-gallery.js';
    $exclusions[] = '/wp-content/themes/bestelectric/assets/js/productScripts.js';
    $exclusions[] = '/wp-content/themes/bestelectric/assets/js/productScripts.min.js';
    $exclusions[] = '/wp-content/plugins/woo-variation-swatches/assets/js/(.*)';
    $exclusions[] = '/wp-content/themes/bestelectric/assets/js/widgets/calc-compare.js';
    $exclusions[] = '/wp-content/themes/bestelectric/assets/js/calculatorScripts.min.js';
    $exclusions[] = '/wp-content/themes/bestelectric/assets/js/calculatorScripts.js';
    $exclusions[] = '/wp-content/themes/bestelectric/assets/js/calculatorScripts.js';

    return $exclusions;
}

add_filter('woocommerce_gallery_image_size', function ($size) {

    if (wp_is_mobile()) {
        return 'medium';
    }
    return $size;
});

add_filter('woocommerce_gallery_full_size', function ($size) {

    if (wp_is_mobile()) {
        return 'medium';
    }
    return $size;
});


add_filter('wpseo_breadcrumb_single_link', function ($link, $breadcrumb) {
    $pos = strpos($link, '<a href="https://www.bestelectricradiators.co.uk/c/electric-radiators/">');
    if ($pos !== false) {
        return '';
    }
    return $link;
}, 10, 2);
