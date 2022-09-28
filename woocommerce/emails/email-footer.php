<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
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
?>
</div>
</td>
</tr>
</table>
<!-- End Content -->
</td>
</tr>
</table>
<!-- End Body -->
</td>
</tr>
</table>
</td>
</tr>
<tr>
    <td align="center" valign="top">
        <!-- Footer -->
        <table border="0" cellpadding="10" cellspacing="0" width="760" id="template_footer">
            <tr>
                <td valign="top">
                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                        <tr>
                            <td colspan="2" valign="middle" id="credit">
                                <?php
                                $accessories = get_field('accessories_email_template', 'options');
                                if ($accessories) {
                                    ; ?>
                                    <div id="footer_optional_desktop" style="text-align: center ;margin: 10px 0 50px;">
                                        <h3 style="text-align: center;font-size: 24px;font-weight: 300">Optional
                                            Extras</h3>
                                        <table width="100%" class="accessories__<?php echo count($accessories); ?>">
                                            <tbody>
                                            <tr>
                                                <?php foreach ($accessories as $post) :; ?>
                                                    <td colspan="1" style="vertical-align: top;">
                                                        <div class="accessories__item">
                                                            <div class="accessories__item__image">
                                                                <a href="<?php echo get_the_permalink($post->ID) ?>">
                                                                    <strong><span style="text-decoration:none">
                                                                            <img src="<?php echo get_the_post_thumbnail_url($post->ID,[218,183]) ?: ''; ?>"
                                                                                 alt="" width="218" height="181">
                                                                        </span></strong>
                                                                </a>
                                                            </div>
                                                            <h5 style="margin: 20px 15px; padding: 0">
                                                                <?php echo get_the_title($post->ID); ?>
                                                            </h5>
                                                            <div style="text-align: center" class="accessories__item__btn">
                                                            <a class="" href="<?php echo get_the_permalink($post->ID) ?>">
                                                                <strong><span style="text-decoration:none"><?php _e('Shop'); ?></span></strong></a>
                                                            </div>

                                                        </div>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                    <?php
                                } ?>


                                <?php
                                $accessories = get_field('category_email_template', 'options');
                                if ($accessories) {
                                    ; ?>
                                    <div>
                                        <table id="category_email_template">
                                            <tbody>
                                            <tr>
                                                <?php while (have_rows('category_email_template', 'options')): the_row();
                                                    $image = get_sub_field('image');
                                                    $link = get_sub_field('link');
                                                    $link_url = $link['url'];
                                                    $link_title = $link['title'];
                                                    $link_target = $link['target'] ?: '_self';
                                                    ?>
                                                    <td>
                                                        <a href="<?php echo $link_url ?>"
                                                           target="<?php echo esc_attr($link_target); ?>"
                                                           title="<?php echo esc_html($link_title); ?>">
                                                            <img src="<?php echo $image['url'] ?>"
                                                                 alt=" <?php echo $image['alt'] ?>" width="231"
                                                                 height="147">
                                                        </a>
                                                    </td>
                                                <?php endwhile; ?>

                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                <?php }; ?>
                                <div>
                                    <?php echo get_field('trustpilot_email_template', 'options') ?: ""; ?>
                                </div>


                                <div class="footer__content" style="text-align: center;color: #707070; ">
                                    <?php echo wp_kses_post(wpautop(wptexturize(apply_filters('woocommerce_email_footer_text', get_option('woocommerce_email_footer_text'))))); ?>
                                </div>
                                <?php if (have_rows('social_email_template', 'options')): ?>
                                    <p style=" padding-top: 50px;">
                                        <?php while (have_rows('social_email_template', 'options')): the_row();
                                            $image = get_sub_field('icon');
                                            $link = get_sub_field('link');
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a href="<?php echo $link_url ?>" style="margin: 0 2px"
                                               target="<?php echo esc_attr($link_target); ?>"
                                               title="<?php echo esc_html($link_title); ?>">

                                                <?php
                                                if (isset($image['subtype']) && $image['subtype'] == 'svg+xml') {
                                                    $svg_file = file_get_contents($image['url']);

                                                    $find_string = '<svg';
                                                    $position = strpos($svg_file, $find_string);

                                                    $svg_file_new = substr($svg_file, $position);
                                                    echo $svg_file_new;
                                                } else {
                                                    ?>
                                                    <img src="<?php echo $image['url'] ?>"
                                                         alt=" <?php echo $image['alt'] ?>" width="36" height="36">
                                                <?php }; ?>
                                            </a>
                                        <?php endwhile; ?>
                                    </p>
                                <?php endif; ?>

                                <p style="text-align: center;font-size: 16px">
                                    <a class="link-site" href="<?php echo home_url() ?>">
                                        <strong><span style="text-decoration:none">
                                                www.bestelectricradiators.co.uk</span></strong>
                                    </a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- End Footer -->
    </td>
</tr>
</table>
</div>
</body>
</html>
