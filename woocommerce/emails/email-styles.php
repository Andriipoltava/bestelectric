<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load colors.
$bg = get_option('woocommerce_email_background_color');
$body = get_option('woocommerce_email_body_background_color');
$base = get_option('woocommerce_email_base_color');
$base_text = wc_light_or_dark($base, '#202020', '#ffffff');
$text = get_option('woocommerce_email_text_color');

// Pick a contrasting color for links.
$link_color = wc_hex_is_light($base) ? $base : $base_text;

if (wc_hex_is_light($body)) {
    $link_color = wc_hex_is_light($base) ? $base_text : $base;
}

$bg_darker_10 = wc_hex_darker($bg, 10);
$body_darker_10 = wc_hex_darker($body, 10);
$base_lighter_20 = wc_hex_lighter($base, 20);
$base_lighter_40 = wc_hex_lighter($base, 40);
$text_lighter_20 = wc_hex_lighter($text, 20);
$text_lighter_40 = wc_hex_lighter($text, 40);

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>
    body {
    padding: 0;
    font-family: "Lato", "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif!;
    }
    table  tr{
    font-family: "Lato", "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif!important;
    }

    #wrapper {

    margin: 0;
    padding: 70px 0;
    -webkit-text-size-adjust: none !important;
    width: 100%;
    }

    #template_container {
    background-color: <?php echo esc_attr($body); ?>;
    border:0;
    border-top: 1px solid <?php echo esc_attr($bg_darker_10); ?>;
    border-radius:0 !important;
    }
    #table_main_order{

    background-color: <?php echo esc_attr($bg); ?>;
    padding: 30px 30px 20px;
    }


    #template_header {
    text-align: center;
    border-radius: 3px 3px 0 0 !important;
    color: <?php echo esc_attr($base_text); ?>;
    font-size: 50px;
    border-bottom: 0;
    font-weight: bold;
    line-height: 100%;
    vertical-align: middle;
    }

    #template_header h1,
    #template_header h1 a {
    color: <?php echo esc_attr($base_text); ?>;
    background-color: inherit;
    }

    #template_header_image img {
    margin-left: 0;
    margin-right: 0;
    }

    #template_footer td {
    padding: 0;

    }

    #template_footer #credit {
    border: 0;
    color: <?php echo esc_attr($text_lighter_40); ?>;
    font-size: 12px;
    line-height: 150%;
    text-align: center;
    padding: 24px 0;
    }

    #template_footer #credit p {
    margin: 0 0 16px;
    }

    #body_content {
    background-color: <?php echo esc_attr($body); ?>;
    }

    #body_content table td {
    padding: 48px 0 32px;
    color: #707070;
    }

    #body_content table td td {
    padding: 12px;
    color: #707070;
    }

    #body_content table td th {
    padding: 12px;
    color: #707070;
    }

    #body_content td ul.wc-item-meta {
    font-size: small;
    margin: 0 0 0.5em;
    padding: 0;
    list-style: none;
    }

    #body_content td ul.wc-item-meta li {
    margin: 0.5em 0 0;

    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    padding: 0;
    }

    #body_content td ul.wc-item-meta li p {
    margin: 0;
    }

    #body_content p {
    margin: 0 0 16px;
    }

    #body_content_inner {
    color: <?php echo esc_attr($text_lighter_20); ?>;
    font-size: 14px;
    line-height: 150%;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
    }

    .td {
    color: <?php echo esc_attr($text_lighter_20); ?>;
    border:0;
    vertical-align: middle;
    }
    .order_item img{
    margin-right: 0;
    }

    .address {

    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    font-style: normal;
    letter-spacing: 0px;
    color: #707070;
    }
    .address a{
    color: #707070;
    }

    .text {
    color: <?php echo esc_attr($text); ?>;
    }

    .link {
    color: <?php echo esc_attr($link_color); ?>;

    }

    #header_wrapper {
    padding: 36px 0;
    display: block;
    }

    h1 {
    color: <?php echo esc_attr($base); ?>;
    font-size: 50px;
    font-weight: 900;
    line-height: 150%;
    margin: 0;
    text-align:center;
    }

    h2 {
    color: #333333;
    display: block;

    font-family: "Lato", sans-serif;
    font-size: 30px;
    font-weight: 300;
    line-height: 20px;
    line-height: 130%;
    margin:0 ;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;

    }

    h3 {

    display: block;
    font-family: "Lato", sans-serif;
    font-size: 22px;
    font-weight: 500;
    line-height: 20px;
    color: #333333;
    line-height: 130%;
    margin: 10px 0 18px;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
    }

    a {
    color: <?php echo esc_attr($link_color); ?>;
    font-weight: bold;
    text-decoration: unset;
    }

    img {
    border: none;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    height: auto;
    outline: none;
    text-decoration: none;
    text-transform: capitalize;
    vertical-align: middle;
    margin-<?php echo is_rtl() ? 'left' : 'right'; ?>: 10px;
    max-width: 100%;
    height: auto;
    }
    .top_header{
    padding-top:30px;
    }
    .top_header_link{
    font-size: 16px;
    color: #707070;
    text-transform: uppercase;
    padding: 0 15px;
    text-decoration: unset;
    }
    .table_main_order_item{
    margin-bottom: 30px;
    }
    .first_td{
    min-width: 117px;
    padding: 0!important;
    }
    .product_item_detail td{
    padding: 0!important;
    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    }
    .includes_tax{
    display: block;

    font-family: "Lato", sans-serif;
    font-size: 12px;
    font-weight: 500;
    line-height: 24px;
    letter-spacing: 0px;
    color: #707070;
    }
    .order_total  td>span.woocommerce-Price-amount.amount{
    font-family: "Lato", sans-serif;
    font-size: 20px;
    font-weight: 700;
    line-height: 24px;
    letter-spacing: 0px;
    color: #707070;
    }
    .order_total th{
    font-family: "Lato", sans-serif;
    font-size: 20px;
    font-weight: 700;
    line-height: 24px;
    letter-spacing: 0px;
    color: #707070;
    }


    #body_content_inner p,
    #body_content_inner tfoot tr{
    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    color: #333333;

    }
    .note{
    border: 1px solid #707070;
    padding:21px 50px;
    margin:60px 0!important;
    font-family: "Lato", sans-serif;
    font-size: 14px!important;
    color: #333333;
    }
    .footer__content{
    padding-top:30px;
    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    }
    .accessories__item{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 35px #0000000D;
    border: 1px solid #fafafa;
    padding-bottom: 15px;
    }
    .accessories__item h5{
    font-size: 13px;
    color: #333333;
    }
    .accessories__item a.accessories__item__btn{
    padding:5px 30px;
    margin:10px;
    color: #FFFFFF;
    text-transform: uppercase;
    font-size: 13px;
    background: #B8D048 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 6px #00000029;
    border: 1px solid #B8D048;
    display: inline-block;
    }
    #template_footer table td{
    padding:15px
    }
    #template_footer .accessories__3  td {
    width: 213px;

    }
    #template_footer  .accessories__4  td {
    width: 150px;
    padding: 5px;

    }

    .accessories__item__image img{
    margin: 0;
    max-height: 183px;
    object-fit: contain;
    }

<?php
