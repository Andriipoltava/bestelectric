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
    padding: 48px 0 82px;
    color: #707070;
    }

    #body_content table td td {
    padding: 12px 20px;
    color: #707070;
    }


    #body_content table td th {
    padding: 12px 20px;
    color: #707070;
    }

    .email-order-items  tr td ,.email-order-items  tr th {
    padding: 12px 0!important;
    }
    .email-order-items .order_item .td{

    }

    #body_content td .wc-item-meta {
    font-size: small;
    margin: 0 0 0.5em;
    padding: 0;
    list-style: none;
    }
    a{
    text-decoration:none !important;
    text-decoration:none;

    }

    #body_content td .wc-item-meta div {
    margin: 0.5em 0 0;

    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    padding: 0;
    }

    #body_content td .wc-item-meta div  p {
    margin: 0;
    display: inline;
    }

    #body_content p {
    margin: 0 0 16px;
    }

    #body_content_inner {
    color: < ? php echo esc_attr($ text_lighter_20);
    ? >;
    font-size: 14px;
    line-height: 150%;
    text-align: < ? php echo is_rtl() ? 'right': 'left';
    ? >;
    }

    .td {
    color: < ? php echo esc_attr($ text_lighter_20);
    ? >;
    border: 0;
    vertical-align: middle;
    }

    .order_item img {
    margin-right: 0;
    }

    .address {
    background-color: #f2f2f2;
    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    font-style: normal;
    letter-spacing: 0px;
    color: #707070;
    border:none;
    }

    .address a {
    color: #707070;
    }

    .text {
    color: < ? php echo esc_attr($ text);
    ? >;
    }

    .link {
    color: < ? php echo esc_attr($ link_color);
    ? >;

    }

    #header_wrapper {
    padding: 36px 0;
    display: block;
    }

    h1 {
    color: < ? php echo esc_attr($ base);
    ? >;
    font-size: 50px;
    font-weight: 900;
    line-height: 150%;
    margin: 0;
    text-align: center;
    }

    h2 {
    color: #333333;
    display: block;

    font-family: "Lato", sans-serif;
    font-size: 30px;
    font-weight: 300;
    line-height: 20px;
    line-height: 130%;
    margin: 0;
    text-align: < ? php echo is_rtl() ? 'right': 'left';
    ? >;

    }

    h3 {
    display: block;
    font-family: "Lato", sans-serif;
    font-size: 22px;
    font-weight: 500;
    color: #333333;
    line-height: 130%;
    margin:0!important;
    text-align: < ? php echo is_rtl() ? 'right': 'left';
    ? >;
    }

    a {
    color: < ? php echo esc_attr($ link_color);
    ? >;
    font-weight: bold;
    text-decoration: none;
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
    margin- < ? php echo is_rtl() ? 'left': 'right';
    ? >: 10px;
    max-width: 100%;
    height: auto;
    }

    ul{
    padding: 0;
    list-style: none;
    }
    li {
    text-indent: 0;
    list-style-type: none;
    }

    .top_header {
    padding-top: 30px;
    }

    .top_header_link {
    font-size: 16px;
    color: #707070;
    text-transform: uppercase;
    text-decoration: none;
    }

    .table_main_order_item {
    background-color: #f2f2f2;
    }

    .first_td {
    min-width: 117px;
    max-width: 117px;
    padding: 0 !important;
    }

    .product_item_detail td {
    padding: 0 !important;
    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    }

    #table_main_order>*{
    background-color: #f2f2f2;
    }
    #table_main_order td,
    #table_main_order tr,
    #table_main_order th{
    background-color: #f2f2f2;
    }


    .includes_tax {
    display: block;
    font-family: "Lato", sans-serif;
    font-size: 12px;
    font-weight: 500;
    line-height: 24px;
    letter-spacing: 0px;
    color: #707070;
    }

    .order_total td > span.woocommerce-Price-amount.amount {
    font-family: "Lato", sans-serif;
    font-size: 20px;
    font-weight: 700;
    line-height: 24px;
    letter-spacing: 0px;
    color: #707070;
    }

    .order_total th {
    font-family: "Lato", sans-serif;
    font-size: 20px;
    font-weight: 700;
    line-height: 24px;
    letter-spacing: 0px;
    color: #707070;
    }


    #body_content_inner p,
    #body_content_inner tfoot tr {
    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 24px;
    color: #333333;

    }

    .note {
    border: 1px solid #707070;
    padding: 41px 50px;
    font-family: "Lato", sans-serif;
    font-size: 14px !important;
    color: #333333;
    }

    .footer__content {
    padding-top: 30px;
    font-family: "Lato", sans-serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    }

    .accessories__item {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 3px 35px #0000000D;
    border: 1px solid #fafafa;
    margin: 15px;
    max-width: 230px;
    }

    .accessories__item h5 {
    font-size: 13px;
    color: #333333;
    }

    .accessories__item .accessories__item__btn {

    margin:10px 72px;
    color: #FFFFFF;
    text-transform: uppercase;
    font-size: 13px;
    background: #B8D048;
    background-color: #B8D048;
    box-shadow: 0px 3px 6px #00000029;
    display: block;
    max-width: 80px;
    width: 80px;
    padding: 5px 0;
    text-align:center;
    }
    .accessories__item .accessories__item__btn a{
    color:white;
    text-transform: uppercase;
    text-decoration: none;
    width: 80px;
    padding:5px;
    text-align:center;
    }

    #template_footer table td {
    padding: 15px
    }

    #template_footer .accessories__3 td {
    width: 213px;

    }

    #template_footer .accessories__4 td {
    width: 150px;
    padding: 5px;

    }

    .accessories__item__image img {
    margin: 0;
    max-height: 183px;
    object-fit: contain;
    }

    .accessories__item h5 {
    text-align: center;
    padding: 0 10px;
    }


    .desktop-hidden {
    opacity: 0;
    height: 0;
    }

    .top-content .note p{
        margin-bottom:0!important;
    }
    .link-site,.top-content a{
    color:#B8CF40;
    text-decoration: none;
    }

    @media screen and (max-device-width: 767px), screen and (max-width: 767px) {

    .first_td {

    max-width: 100% !important;
    }

    .product_item_detail tr > td:last-child {
    text-align: left !important;
    }

    .order_item img {
    float: left;
    margin-right: 10px !important;
    }

    .desktop-hidden {
    opacity: 1 !important;
    height: auto !important;
    }

    .top_header_link {

    display: block;
    padding: 10px 15px !important;
    }

    #template_container, #template_container table, #template_footer {
    max-width: 730px;
    width: 100% !important;
    }

    #header_wrapper h1 {
    font-size: 28px !important;
    }

    #template_body {
    padding: 10px;
    }

    .order_item div {
    margin-left: 0 !important;
    }

    .order_item {
    padding-bottom: 15px;
    }

    .order_item .td:not(.first_td) {
    padding:0 0 15px!important;
    }

    #table_main_order {
    padding-bottom:40px!important;
    }

    #template_footer {
    padding: 0 15px;
    }

    .note {
    padding: 21px !important;
    }

    .order_item h2 {
    font-size: 21px !important;
    }

    #category_email_template, #footer_optional_desktop {
    width: 100%;
    }

    #category_email_template tr, #footer_optional_desktop tr, #table_main_order tr {
    display: block !important;
    }
    .product_item_detail  td:last-child{
    padding-top:10px!important;
    }

    .product_item_detail  td{
    display: block !important;
    margin: 0 auto;
    }

    #category_email_template tr td, #footer_optional_desktop tr td{
    display: block !important;
    margin: 0 auto;
    padding-bottom:0!important;
    padding-top:20px!important;

    }
    .accessories__item__btn{
    margin: 10px 69px!important;
    }

    .product_item_detail tr td {
    text-align: start !important;
    padding-bottom: 0!important;
    }

    #table_main_order table tfoot th {
    vertical-align: top !important;
    width: 100%;
    }

    #table_main_order table tfoot td {
    display: table-cell !important;
    width: 50%;
    min-width: 150px
    }

    }
    @media screen and (max-device-width: 567px), screen and (max-width: 567px) {
    .first_td {
    max-width: 70px!important;
    min-width: 70px!important;
    padding-right: 15px!important;
    padding-top: 15px!important;
    vertical-align: top!important;
    }
    }

<?php
