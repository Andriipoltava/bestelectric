<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

$text_align = is_rtl() ? 'right' : 'left';
$margin_side = is_rtl() ? 'left' : 'right';

foreach ($items as $item_id => $item) :
    $product = $item->get_product();
    $sku = '';
    $purchase_note = '';
    $image = '';

    if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
        continue;
    }

    if (is_object($product)) {
        $sku = $product->get_sku();
        $purchase_note = $product->get_purchase_note();
        $image = $product->get_image($image_size);
    }

    ?>
    <tr class="<?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'order_item', $item, $order)); ?>">
        <td class="td first_td" colspan="1"
            style="text-align:center; vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
            <?php

            // Show title/image etc.
            if ($show_image) {
                echo wp_kses_post(apply_filters('woocommerce_order_item_thumbnail', $image, $item));
            }
            $product_name=apply_filters('woocommerce_order_item_name', $item->get_name(), $item, false);


            ?>

        </td>
        <td class="td" colspan="2"
            style="text-align:<?php echo esc_attr($text_align); ?>; vertical-align:middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
            <div style="margin-left: 25px">
                <div>
                    <h2 class="mobile-hidden">
                        <?php
                        // Product name.
                        echo wp_kses_post($product_name); ?>
                    </h2>

                </div>

                <div>
                    <table class="product_item_detail" width="100%">
                        <tbody>
                        <tr>
                            <td>
                                <div>
                                    <?php


                                    // allow other plugins to add additional product information here.
                                    do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text);

                                 $item_meta=   wc_display_item_meta(
                                        $item,
                                        array(
                                            'autop'        => true,
                                            'echo'        => false,
                                            'label_after'  => '</strong> ',
                                            'before'       => '<div class="wc-item-meta"><div>',
                                            'after'        => '</div></div>',
                                            'separator'    => '</div><div>',
                                            'label_before' => '<strong class="wc-item-meta-label" style="    font-weight: 400;float: ' . esc_attr($text_align) . '; margin-' . esc_attr($margin_side) . ': .25em; clear: both;">',
                                        )
                                    );
                                    $item_meta=str_replace('p>','b>',$item_meta);
                                    echo $item_meta;

                                    // allow other plugins to add additional product information here.
                                    do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text); ?>
                                </div>

                                <?php
                                $qty = $item->get_quantity();
                                $refunded_qty = $order->get_qty_refunded_for_item($item_id);

                                if ($refunded_qty) {
                                    $qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
                                } else {
                                    $qty_display = esc_html($qty);
                                }
                                echo wp_kses_post(apply_filters('woocommerce_email_order_item_quantity', $qty_display, $item));
                                ?>


                            </td>
                            <td style="text-align:right; vertical-align:bottom;">
                                <?php echo wp_kses_post($order->get_formatted_line_subtotal($item)); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </td>

    </tr>


<?php endforeach; ?>
