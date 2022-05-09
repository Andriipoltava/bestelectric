<?php

add_action('elementor/widgets/register', 'themes_widgets_registered');

function themes_widgets_registered($widgets_manager)
{
    if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {

        global $widgets;

        $widgets = $widgets_manager;
        foreach (glob(get_stylesheet_directory() . "/lib/widget/*.php") as $filename) {
            include $filename;
        }


    }
}

add_action('elementor/frontend/after_register_scripts', function () {
    $script_version = time();
    $path_min = ".min";
    if (defined('WP_DEBUG') && true === WP_DEBUG) {
        $path_min = "";
    }
    wp_register_script('swiper', ELEMENTOR_ASSETS_URL . '/lib/swiper/swiper.min.js', array('jquery'), ELEMENTOR_VERSION, true);
    wp_register_script('elementor-sticky', ELEMENTOR_PRO_URL . 'assets/lib/sticky/jquery.sticky'. $path_min . '.js', array('jquery'), ELEMENTOR_VERSION, true);
    wp_register_script('ber-js-mego-menu', get_stylesheet_directory_uri() . '/assets/js/widgets/mega-menu' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-slider-3-image', get_stylesheet_directory_uri() . '/assets/js/widgets/slider3image' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-slider-ksp', get_stylesheet_directory_uri() . '/assets/js/widgets/slider-icon-list' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-product-features', get_stylesheet_directory_uri() . '/assets/js/widgets/product-features' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-product-features-lists', get_stylesheet_directory_uri() . '/assets/js/widgets/product-features-list' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-product-compare-range', get_stylesheet_directory_uri() . '/assets/js/widgets/product-compare-range' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-product-tech-tabs', get_stylesheet_directory_uri() . '/assets/js/widgets/product-tech-tabs' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-calc-compare', get_stylesheet_directory_uri() . '/assets/js/widgets/calc-compare' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);
    wp_register_script('ber-js-woo-basket', get_stylesheet_directory_uri() . '/assets/js/widgets/woo-basket' . $path_min . '.js', array('jquery'), $script_version, true);
    wp_register_script('ber-js-search-form', get_stylesheet_directory_uri() . '/assets/js/widgets/search-form' . $path_min . '.js', array('jquery'), $script_version, true);
    wp_register_script('ber-js-product-gallery', get_stylesheet_directory_uri() . '/assets/js/widgets/product-gallery' . $path_min . '.js', array('jquery'), $script_version, true);
    wp_register_script('ber-js-calc-scripts', get_stylesheet_directory_uri() . '/assets/js/calculatorScripts' . $path_min . '.js', array('ber-scripts'), $script_version, true);
    wp_register_script('ber-js-single-form', get_stylesheet_directory_uri() . '/assets/js/widgets/product-single-form' . $path_min . '.js', array('jquery', 'swiper'), $script_version, true);

});


add_action('elementor/frontend/after_register_styles', function () {

    $script_version = time();
    $path_min = ".min";
    if (defined('WP_DEBUG') && true === WP_DEBUG) {
        $script_version = time();
        $path_min = "";
    }
    wp_register_style('ber-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap' . $path_min . '.css', [], $script_version);
    wp_register_style('ber-icon', get_stylesheet_directory_uri() . '/fonts/fontello/css/ber-icons.css', [], $script_version);
    wp_register_style('woocommerce-layout', get_stylesheet_directory_uri() . '/assets/css/woocommerce-layout' . $path_min . '.css', array(), $script_version);
    wp_register_style('woocommerce-general', get_stylesheet_directory_uri() . '/assets/css/woocommerce-general' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-calculator', get_stylesheet_directory_uri() . '/assets/css/calculator' . $path_min . '.css', $script_version);
    wp_register_style('ber-css-mego-menu', get_stylesheet_directory_uri() . '/assets/css/widgets/mega-menu' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-woo-basket', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-basket' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-swiper', get_stylesheet_directory_uri() . '/assets/css/widgets/swiper' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-search-form', get_stylesheet_directory_uri() . '/assets/css/widgets/search-form' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-slider-ksp', get_stylesheet_directory_uri() . '/assets/css/widgets/slider-ksp' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-calc-banner', get_stylesheet_directory_uri() . '/assets/css/widgets/calc-banner' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-single-form', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-single-form' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-more', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-single-more' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-single-gallery', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-single-gallery' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-single-tech-tabs', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-single-tech-tabs' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-summary', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-summary' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-features-lists', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-features-lists' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-features-columns', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-features-columns' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-video', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-video' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-compare-range', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-compare-range' . $path_min . '.css', array(), $script_version);
    wp_register_style('ber-css-compare', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-compare' . $path_min . '.css', array(), $script_version);

});


function add_elementor_widget_categories($elements_manager)
{

    $elements_manager->add_category(
        'hello-elementor-theme',
        [
            'title' => __('Theme', 'hello-elementor'),
            'icon' => 'fa fa-plug',
        ]
    );
}

add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');

function get_edit_id_page()
{
    $id = get_the_ID();
    if (isset($_GET['action']) && $_GET['action'] == 'elementor' && isset($_GET['post'])) {
        $id = 98;
    }
    return $id;

}

add_action( 'elementor/widget/render_content', function( $content, $widget ) {
    if ( 'custom-woo-single-slider' === $widget->get_name() ) {
        // Run the hooks without outputting the code that `do_action` will want to do
        ob_start();
        do_action('woocommerce_before_main_content');
        $beforeMainContent = ob_get_contents();
        ob_clean();
        do_action('woocommerce_after_main_content');
        $afterMainContent = ob_get_contents();
        ob_end_clean();
        // Attach the output from the two hooks before and after the content generated by Elementor
        $content = $beforeMainContent . $content . $afterMainContent;
    }

    return $content;
}, 10, 2 );


