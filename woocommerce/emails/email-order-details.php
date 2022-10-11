<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

$text_align = is_rtl() ? 'right' : 'left';
?><br><br><br>
    <div id="table_main_order">
        <?php
        do_action('woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email); ?>
        <table>
            <tr>
                <td>
                    <h3 style=""><?php esc_html_e('Your Items', 'woocommerce'); ?></h3>
                    <table class="email-order-items" cellspacing="0" cellpadding="6"
                           style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;"
                           border="0">
                        <thead>

                        </thead>
                        <tbody>
                        <?php
                        echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            $order,
                            array(
                                'show_sku' => $sent_to_admin,
                                'show_image' => false,
                                'image_size' => array(32, 32),
                                'plain_text' => $plain_text,
                                'sent_to_admin' => $sent_to_admin,
                            )
                        );
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="td" scope="row" colspan="3"
                                style="padding: 20px"></th>
                        </tr>
                        <?php

                        $item_totals = $order->get_order_item_totals();
                        $shipping_total = $order->get_shipping_total();
                        $shipping_tax = $order->get_shipping_tax();
                        $currency_code = $order->get_currency();
                        $currency_symbol = get_woocommerce_currency_symbol($currency_code);

                        $item_totals['shipping'] = ['label' => 'Delivery:', 'value' => $currency_symbol . number_format(($shipping_total + $shipping_tax), 2)];

                        if ($item_totals) {

                            if (isset($item_totals['payment_method'])) {
                                unset($item_totals['payment_method']);
                            }
                            $i = 0;
                            foreach ($item_totals as $key => $total) {
                                $i++;
                                $total['value'] = str_replace('<small', '<br><small', $total['value']);
                                ?>
                                <tr class="<?php echo $key; ?>">
                                    <th class="td" scope="row" colspan="2"
                                        style="text-align:<?php echo esc_attr($text_align); ?>; <?php echo (1 === $i) ? 'border-top-width: 4px;' : ''; ?>"><?php echo wp_kses_post($total['label']); ?></th>
                                    <td class="td" colspan="1"
                                        style="text-align:right; <?php echo (1 === $i) ? 'border-top-width: 4px;' : ''; ?>">
                                        <?php echo wp_kses_post($total['value']); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        if ($order->get_customer_note()) {
                            ?>
                            <tr>
                                <th class="td" scope="row" colspan="2" align="right"
                                    style="text-align:<?php echo esc_attr($text_align); ?>;"><?php esc_html_e('Note:', 'woocommerce'); ?></th>
                                <td class="td" colspan="1" align="right"
                                    style="text-align:right"><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </table>

        <?php do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email); ?>
    </div>


    </div>
    </td>
    </tr>
    </table>
    <!-- End Content -->
<?php
$upsell = [];

foreach ($order->get_items() as $item) {
    $productID = $item['product_id'];
    if (wc_get_product($productID)->get_cross_sell_ids()) {
        foreach (wc_get_product($productID)->get_cross_sell_ids() as $upsell_id) {
            $upsell[] = $upsell_id;
        }
    }
}

$accessories = get_field('accessories_email_template', 'options');
if ($upsell) {
    $upsell= array_unique($upsell);
    ; ?>
    <div id="footer_optional_desktop" style="text-align: center ;margin: 10px 0 20px;">
        <h3 style="text-align: center;font-size: 24px;font-weight: 300">Optional
            Extras</h3>
        <table width="760" style="margin: 0 auto" class="accessories__<?php echo count($upsell); ?>">
            <tbody>
            <tr>
                <?php foreach ($upsell as $key => $post) :

                    if ($key == 3) break;; ?>
                    <td colspan="1" style="vertical-align: top; width: 240px;min-width: 230px ;    max-width: 240px;" width="240">
                        <div class="accessories__item">
                            <div class="accessories__item__image">
                                <a href="<?php echo get_the_permalink($post) ?>">
                                    <strong><span style="text-decoration:none">
                                                                            <img src="<?php echo get_the_post_thumbnail_url($post, [218, 183]) ?: ''; ?>"
                                                                                 alt="" width="218" height="181">
                                                                        </span></strong>
                                </a>
                            </div>
                            <h5 style="margin: 20px 15px; padding: 0">
                                <?php echo get_the_title($post); ?>
                            </h5>
                            <div style="text-align: center"
                                 class="accessories__item__btn">
                                <a class=""
                                   href="<?php echo get_the_permalink($post) ?>">
                                    <strong><span
                                                style="text-decoration:none"><?php _e('Shop'); ?></span></strong></a>
                            </div>

                        </div>
                    </td>
                <?php endforeach; ?>
                <?php if (count($upsell) < 3) {
                    for ($a = count($upsell); $a < 3; $a++) {
                        echo '<td colspan="1" style="width: 240px;min-width: 230px;padding: 0!important;" width="240"></td>';
                    }
                }; ?>
            </tr>
            </tbody>
        </table>
    </div>


    <?php
} ?>


<?php
