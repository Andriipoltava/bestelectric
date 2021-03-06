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
?>
<div id="table_main_order" style="margin-bottom: 40px; margin-top: 60px">
    <?php
    do_action('woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email); ?>

    <h3 style="margin-top: 50px"><?php esc_html_e('Your Items', 'woocommerce'); ?></h3>
    <table class="td" cellspacing="0" cellpadding="6"
           style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1">
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

        if ($item_totals) {
            if (isset($item_totals['shipping'])) {
                unset($item_totals['shipping']);
            }
            if (isset($item_totals['payment_method'])) {
                unset($item_totals['payment_method']);
            }
            $i = 0;
            foreach ($item_totals as $key => $total) {
                $i++;
                ?>
                <tr class="<?php echo $key; ?>">
                    <th class="td" scope="row" colspan="2"
                        style="text-align:<?php echo esc_attr($text_align); ?>; <?php echo (1 === $i) ? 'border-top-width: 4px;' : ''; ?>"><?php echo wp_kses_post($total['label']); ?></th>
                    <td class="td" colspan="1"
                        style="text-align:right; <?php echo (1 === $i) ? 'border-top-width: 4px;' : ''; ?>"><?php echo wp_kses_post($total['value']); ?></td>
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


    <?php do_action('woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email); ?>
</div>