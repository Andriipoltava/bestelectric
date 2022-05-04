<?php
/**
 * Shop breadcrumb
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($breadcrumb) {


    echo $wrap_before;
    $new_b = [];
    foreach ($breadcrumb as $key => $crumb) {
        if ($crumb[0] === get_the_title() || get_term_by('name', $crumb[0], 'product_cat') && get_term_by('name', $crumb[0], 'product_cat')->parent !== 0 && $key !== 0) {
            continue;
        }
        $new_b[] = $crumb;
    }
    foreach ($new_b as $key => $crumb) {


        echo $before;

        echo '<a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a>';

        echo $after;


        if (sizeof($new_b) !== $key + 1) {
            echo ' ' . $delimiter . ' ';
        }
    }
    echo $wrap_after;
}