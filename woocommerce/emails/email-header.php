<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
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
    exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>"/>
    <title><?php echo get_bloginfo('name', 'display'); ?></title>
    <!--[if gte mso 9]>
    <style>
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            text-indent: -50px;
            list-style-type: none;
        }
    </style>
    <![endif]-->
</head>
<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="
0">
<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" valign="top">
                <div id="template_header_image">
                    <?php
                    if ($img = get_option('woocommerce_email_header_image')) {
                        echo '<a href="' . home_url() . '"><img src="' . esc_url($img) . '" alt="' . get_bloginfo('name', 'display') . '" /></a>';
                    }
                    ?>

                    <?php
                    $accessories = get_field('category_email_template', 'options');
                    if ($accessories) {
                        ; ?>
                        <p class="top_header">
                            <?php while (have_rows('category_email_template', 'options')): the_row();
                                $image = get_sub_field('image');
                                $link = get_sub_field('link');
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                ?>

                                <a class="top_header_link" href="<?php echo $link_url ?>"
                                   target="<?php echo esc_attr($link_target); ?>"
                                   title="<?php echo esc_html($link_title); ?>">
                                    <strong><span style="text-decoration:none">
                                    <?php echo esc_html('&nbsp;' . $link_title . '&nbsp;'); ?>
                                                </span><strong>
                                </a>

                            <?php endwhile; ?>


                        </p>

                    <?php }; ?>


                </div>
                <table border="0" cellpadding="0" cellspacing="0" width="730" id="template_container">
                    <tr>
                        <td align="center" valign="top">
                            <!-- Header -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header">
                                <tr>
                                    <td id="header_wrapper">
                                        <h1><?php echo $email_heading; ?></h1>
                                    </td>
                                </tr>
                            </table>
                            <!-- End Header -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- Body -->
                            <table border="0" cellpadding="0" cellspacing="0" width="730" id="template_body">
                                <tr>
                                    <td valign="top" id="body_content">
                                        <!-- Content -->
                                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                            <tr>
                                                <td valign="top">
                                                    <div id="body_content_inner">
