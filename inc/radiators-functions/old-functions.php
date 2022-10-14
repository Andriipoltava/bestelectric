<?php

add_action('wp_footer', 'cvy_360');
function cvy_360()
{
    if (!is_singular('product'))
        return;

    $photos = get_field('360_view_photos', get_the_ID());
    $photo_src = $photos['photo_1'];
    if ($photos && $photo_src) {
        $photo_src = $photos['photo_1'];
        $photo_mask = str_replace("image_01", "image_##", $photo_src);
        echo '<div id="cvy_reel_image" style="display: none; max-width:600px"><img class="reel" src="' . $photo_src . '" width="600px" height="auto" data-images="' . $photo_mask . '" data-frames="36" data-shy="true"></div>';
    }
}


//add SVG to allowed file uploads
add_action('upload_mimes', 'add_file_types_to_uploads');
function add_file_types_to_uploads($file_types)
{

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);

    return $file_types;
}

add_action('woocommerce_loop_add_to_cart_link', 'product_loop_add_to_cart_button', 11);
function product_loop_add_to_cart_button($output)
{
    $patterns = [
        'href="[^"]+' => 'href="' . get_the_permalink(),
        'add_to_cart_button|ajax_add_to_cart' => '',
        '>[^<]+' => '>View'
    ];

    foreach ($patterns as $pattern => $replacement) {
        unset($patterns[$pattern]);

        $pattern = '~' . $pattern . '~ui';

        $patterns[$pattern] = $replacement;
    }

    return preg_replace(
        array_keys($patterns),
        array_values($patterns),
        $output
    );
}

add_shortcode('cvy_radiator_variation_list', 'handle_radiator_variation_list_shortcode');
function handle_radiator_variation_list_shortcode($args)
{
    if (is_admin() || !is_product())
        return;

    ob_start(); ?>

    <div id="cvy_radiator_variation_list_wrapper">
        <?php if (!empty($args['calculator']))
            get_template_part('template-parts/product_variation_list_calculator');

        get_template_part('template-parts/product_variation_list'); ?>
    </div>

    <?php $output = ob_get_contents();

    ob_end_clean();

    return $output;
}


/*function radiator_variation_list_submit() {
    global $woocommerce;

    if ( ! is_cart() || ! isset( $_POST['cvy_radiator_variation_list_submit' ] ) )
        return;

    $variations =
        ! empty( $_POST['variations'] ) ?
            $_POST['variations'] :
            [];

    foreach ( $variations as $variation_id => $data ) {
        $quantity = intval( $data['quantity'] );

        if ( $quantity <= 0 )
            continue;

        $woocommerce->cart->add_to_cart( $_POST['product_id'], $quantity, $variation_id, $data['attributes'] );
    }
}
add_action( 'wp', 'radiator_variation_list_submit' );*/

add_action('wp', 'radiator_variation_list_submit');
function radiator_variation_list_submit()
{
    global $woocommerce;

    if (!isset($_POST['cvy_radiator_variation_list_submit']))
        return;

    $variations =
        !empty($_POST['variations']) ?
            $_POST['variations'] :
            [];

    foreach ($variations as $variation_id => $data) {
        $quantity = (isset($data['quantity'])) ? intval($data['quantity']) : 0;

        if ($quantity <= 0)
            continue;

        $woocommerce->cart->add_to_cart($_POST['product_id'], $quantity, $variation_id, $data['attributes']);
        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $_POST['product_id'], $quantity);
        if ($passed_validation) {
            wc_add_to_cart_message(array($variation_id => $quantity), true);
        }

    }

}


// add_filter('eleconditions_vars', function ($custom_vars) {
//     if (is_singular('product')) {
//         global $product;

//         $acf_fields = [
//             '360_view_photos',
//             'user_guide_url',
//             'youtube_video_url',
//             'label'
//         ];

//         foreach ($acf_fields as $field_name) {
//             $custom_var_name = 'has_' . $field_name;

//             $field_value = get_field($field_name);

//             if (is_array($field_value))
//                 $field_value = array_filter($field_value);

//             $custom_vars[$custom_var_name] = !empty($field_value);
//         }

//         $custom_vars['is_variable_product'] = $product->is_type('variable');
//     }
//     if (is_product_category()) {
//         $category_description = category_description();
//         $category_descripton_len = strlen($category_description);
//         $custom_vars['cat_has_description'] = $category_descripton_len > 0 ? 1 : 0;
//     }
//     return $custom_vars;
// });


function iconic_variable_price_format($price, $product)
{

    $prefix = sprintf('%s: ', __('From', 'iconic'));

    $min_price_regular = $product->get_variation_regular_price('min', true);
    $min_price_sale = $product->get_variation_sale_price('min', true);
    $max_price = $product->get_variation_price('max', true);
    $min_price = $product->get_variation_price('min', true);

    $price = ($min_price_sale == $min_price_regular) ?
        wc_price($min_price_regular) :
        '<del>' . wc_price($min_price_regular) . '</del>' . '<ins>' . wc_price($min_price_sale) . '</ins>';

    return ($min_price == $max_price) ?
        $price :
        sprintf('%s%s', $prefix, $price);

}

add_filter('woocommerce_variable_sale_price_html', 'iconic_variable_price_format', 10, 2);
add_filter('woocommerce_variable_price_html', 'iconic_variable_price_format', 10, 2);


add_filter('wpseo_breadcrumb_single_link', 'wpseo_remove_breadcrumb_link', 10, 2);
function wpseo_remove_breadcrumb_link($link_output, $link)
{
    $text_to_remove = 'Products';

    if ($link['text'] == $text_to_remove) {
        $link_output = '';
    }

    return $link_output;
}


// Add fields for variation
function variation_settings_fields($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => '_cvy_area[' . $variation->ID . ']',
            'label' => 'Area<br>',
            'desc_tip' => 'true',
            'description' => '',
            'value' => get_post_meta($variation->ID, '_cvy_area', true),
            'custom_attributes' => array(
                'step' => '0.5',
                'min' => '0',
                'type' => 'number'
            )
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => '_cvy_area_low[' . $variation->ID . ']',
            'label' => 'Low insulation<br>',
            'desc_tip' => 'true',
            'description' => '',
            'value' => get_post_meta($variation->ID, '_cvy_area_low', true),
            'custom_attributes' => array(
                'step' => '0.5',
                'min' => '0',
                'type' => 'number'
            )
        )
    );
}

add_action('woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3);

function save_variation_settings_fields($post_id)
{
    $area = intval($_POST['_cvy_area'][$post_id]);
    $area_low = intval($_POST['_cvy_area_low'][$post_id]);

    if (!empty($area)) {
        update_post_meta($post_id, '_cvy_area', esc_attr($area));
    }

    if (!empty($area_low)) {
        update_post_meta($post_id, '_cvy_area_low', esc_attr($area_low));
    }

}

add_action('woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2);

// add_filter('woocommerce_gallery_thumbnail_size', 'custom_woocommerce_gallery_thumbnail_size');

// function custom_woocommerce_gallery_thumbnail_size()
// {
//     return 'thumbnail';
// }


// Hook in
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields($fields)
{
    $fields['billing']['billing_phone']['label'] = 'Mobile Number (Receive a 1 hour delivery slot SMS)';
    return $fields;
}


add_filter('woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability($availability, $_product)
{

    // Change In Stock Text
   if ($_product->is_in_stock() && $availability["class"] !== 'available-on-backorder') {
       if(get_field('product_in_stock_message')){
           $custom_in_stock_message = get_field('product_in_stock_message');
           $availability['availability'] = $custom_in_stock_message;
       }else{
           $availability['availability'] = __('<strong>24 hr Delivery</strong> | Order before 11am for delivery ' . date_delivery_24() . '</br><strong>FREE 48 hr Delivery </strong > | Order before 11am for delivery ' . date_delivery_48(), 'woocommerce');

       }
    }
    if ( $_product->managing_stock() && $availability["class"] == 'available-on-backorder') {
        $back_order_message = get_field('product_backorder_message','option');
        $availability['availability'] = $back_order_message;
    }

    return $availability;
}

function woocommerce_custom_cart_item_name( $_product_title, $cart_item, $cart_item_key ) {
    $altmessage = get_field('product_backorder_message','option');
    if ( $cart_item['data']->backorders_require_notification() && $cart_item['data']->is_on_backorder( $cart_item['quantity'] ) ) {
        $_product_title .=  __( '<p class="backorder_notification custom-backorder_notification">'. $altmessage, 'woocommerce'.'</p>' ) ;
    }
    return $_product_title;
}
add_filter( 'woocommerce_cart_item_name', 'woocommerce_custom_cart_item_name', 10, 3);

add_action('wp_footer', function ($content) {

    if (class_exists('WooCommerce') && is_product()) {
        $wc_sd = new \WC_Structured_Data();
        $wc_sd->generate_product_data();
    }

    return $content;
}, 0);

add_filter('woocommerce_loop_add_to_cart_args', 'remove_rel', 10, 2);
function remove_rel($args, $product)
{
    unset($args['attributes']['rel']);

    return $args;
}


// Add Google Optimise.
function twl_google_optimise($content)
{
    return $content . "ga('require', 'GTM-TQZ7RS8');";
}

add_filter('woocommerce_ga_snippet_require', 'twl_google_optimise');


/*
* Removes image from woocomerce category list
*/
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);


/**
 * Hide category product count in product archives
 */
add_filter('woocommerce_subcategory_count_html', '__return_false');
function date_delivery_24()
{

    $datetime = new DateTime('now');
    $data = 'tomorrow, ' . date("jS M", strtotime("+1 day"));
    if ($datetime->format('l') == 'Friday') {
        $data = date("l, jS M", strtotime("+3 day"));
    } elseif ($datetime->format('l') == 'Saturday') {
        $data = date("l, jS M", strtotime("+3 day"));
    } elseif ($datetime->format('l') == 'Sunday') {
        $data = date("l, jS M", strtotime("+2 day"));
    }

    return '<span class="date_delivery_24">'.$data.'</span>';
}

;
function date_delivery_48()
{

    $datetime = new DateTime('now');
    $data = date("l, jS M", strtotime("+2 day"));

    if ($datetime->format('l') == 'Thursday') {
        $data = date("l, jS M", strtotime("+4 day"));
    } elseif ($datetime->format('l') == 'Friday') {
        $data = date("l, jS M", strtotime("+4 day"));
    } elseif ($datetime->format('l') == 'Saturday') {
        $data = date("l, jS M", strtotime("+4 day"));
    } elseif ($datetime->format('l') == 'Sunday') {
        $data = date("l, jS M", strtotime("+3 day"));
    }

    return '<span class="date_delivery_48">'.$data.'</span>';
}


add_filter('nav_menu_item_title', function ($title, $menu_item, $args, $depth) {

    if ($args->container_id=='thumbnailCats') {
        $thumbnail_id = get_term_meta($menu_item->object_id, 'thumbnail_id', true);
        $image = wp_get_attachment_image($thumbnail_id, 'full');
        $svg='<svg class="main-svg" xmlns="http://www.w3.org/2000/svg" width="16.351" height="40.83" viewBox="0 0 16.351 40.83"><path d="M182.2,413.638l16.351-12.207v-6.223L182.2,407.415Z" transform="translate(-182.197 -372.808)" fill="#fff"/><path d="M182.2,341.733v6.223l16.351-12.207v-6.223Z" transform="translate(-182.197 -318.325)" fill="#fff"/><path d="M182.2,282.273l16.351-12.207v-6.223L182.2,276.05Z" transform="translate(-182.197 -263.843)" fill="#fff"/></svg>';
        $title = "<div class='nav-thumbnail__wrap'>$image <div class='nav-thumbnail__wrap'>$svg<p class='title'>$title</p><span class='shop'>Shop Now <svg aria-hidden='true' class='e-font-icon-svg e-fas-chevron-down'><use xlink:href='#fas-chevron-right'></use></svg></span></div></div>";
    }
    return $title;
}, 10, 4);

add_filter('elementor/widgets/wordpress/widget_args', function ($default_widget_args, $class) {
    if ($class->get_settings('_element_id')) {
        $default_widget_args['thumbnailCat'] = $class->get_settings('_element_id');
    }

    return $default_widget_args;
}, 10, 2);

add_filter('widget_nav_menu_args', function ($nav_menu_args, $nav_menu, $args, $instance) {
    if (isset($args['thumbnailCat'])) {
        $nav_menu_args['container_id']=$args['thumbnailCat'].'s';
    }

    return $nav_menu_args;

}, 10, 4);