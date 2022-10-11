<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
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

if (!defined('ABSPATH')) {
    exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action('woocommerce_email_header', $email_heading, $email);

$date_paid = $order->get_date_modified();

function textReplace($text)
{
    $text = str_replace(' {site_url}', wp_parse_url(home_url(), PHP_URL_HOST), $text);
    return $text;
}


$additional_contentRad = false;
$additional_contentTow = false;
$additional_content = null;
$ComfortContro = false;
foreach ($order->get_items() as $item) {
    if ($item['product_id'] == 19422||$item['product_id'] == 94) {
        $ComfortContro = true;
    }
    if (has_term('162', 'product_cat', $item['product_id'])) {
        $additional_contentRad = true;
    }
    if (has_term('21', 'product_cat', $item['product_id'])) {
        $additional_contentTow = true;
    }

}



?>

<?php /* translators: %s: Customer first name */ ?>
    <p><?php printf(esc_html__('Dear %s,', 'woocommerce'), esc_html($order->get_billing_first_name() . ' ' . $order->get_billing_last_name())); ?></p>
<?php /* translators: %s: Order number */ ?>
    <p><?php esc_html_e('Your order number is ', 'woocommerce') ?>
        <?php echo('     <strong>#' . $order->get_order_number() . $date_paid->date(" (F j, Y)") . ' </strong>'); ?>
    </p>
    <div class="top-content">
        <p><?php echo 'Thanks for using ' . wp_parse_url(home_url(), PHP_URL_HOST); ?>!</p>

            <?php if ($ComfortContro) {
                echo '      <div class="note">'. wp_kses_post(wpautop(wptexturize(textReplace(get_field('additional_content_one_product', 'options'))))).' </div>';
            }; ?>
        <?php if ($additional_contentRad && $additional_contentTow) {

                echo '<div class="note" '.($ComfortContro?'style="margin-top:20px"':'').'>';
                echo  wp_kses_post(wpautop(wptexturize(textReplace(get_field('additional_content_multiple_product', 'options'))))).' </div>';
            }; ?>

    </div>
<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action('woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email);

/**
 * Show user-defined additional content - this is set in each email's settings.
 */


/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action('woocommerce_email_footer', $email);
