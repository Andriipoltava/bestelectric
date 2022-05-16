<?php
/**
 * Email Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 5.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$text_align = is_rtl() ? 'right' : 'left';
$address = $order->get_formatted_billing_address();
$address = preg_replace('/^(<br\s*?\/?>)+|(<br\s*\/?>)+$/', '', $address);

$shipping = $order->get_formatted_shipping_address();

?>
<div>
    <div class="table_main_order_item">
        <h3><?php esc_html_e('Billing address', 'woocommerce'); ?></h3>

        <address class="address">

            <?php echo $order->billing_first_name; ?>  <?php echo $order->billing_last_name; ?>,
            <br> <?php echo $order->billing_address_1; ?>, <?php echo $order->billing_address_2; ?>
            , <?php echo $order->billing_city; ?>, <?php echo $order->billing_state; ?>,
            <?php echo $order->billing_postcode; ?>, <?php echo $order->billing_country; ?>
            <?php if ($order->get_billing_phone()) : ?>
                <br/><?php echo wc_make_phone_clickable($order->get_billing_phone()); ?>
            <?php endif; ?>
            <?php if ($order->get_billing_email()) : ?>
                <br/><a href="mailto:<?php echo esc_html($order->get_billing_email()); ?>">
                    <?php echo esc_html($order->get_billing_email()); ?>
                </a>
            <?php endif; ?>
        </address>
    </div>
    <div class="table_main_order_item">
        <?php if (!wc_ship_to_billing_address_only() && $order->needs_shipping_address() && $shipping) : ?>

            <h3><?php esc_html_e('Shipping address', 'woocommerce'); ?></h3>

            <address class="address">
                <?php echo $order->shipping_first_name; ?>  <?php echo $order->shipping_last_name; ?>,
                <br> <?php echo $order->billing_address_1; ?>, <?php echo $order->shipping_address_2; ?>
                , <?php echo $order->shipping_city; ?>, <?php echo $order->shipping_state; ?>,
                <?php echo $order->shipping_postcode; ?>, <?php echo $order->shipping_country; ?>

                <?php if ($order->get_shipping_phone()) : ?>
                    <br/><?php echo wc_make_phone_clickable($order->get_shipping_phone()); ?>
                <?php endif; ?>
            </address>

        <?php endif; ?>
    </div>
    <?php $item_totals = $order->get_order_item_totals();

    if ($item_totals) {
        foreach ($item_totals as $key => $total) {
            if ($key == 'shipping' || $key == 'payment_method') {
                $total['label']=str_replace(':','',$total['label']);
                ?>
                <div class="table_main_order_item">
                    <h3><?php echo wp_kses_post($total['label']); ?></h3>
                    <div class="address"><?php echo wp_kses_post($total['value']); ?></div>
                </div>
                <?php
            }
        }
    } ?>


</div>

