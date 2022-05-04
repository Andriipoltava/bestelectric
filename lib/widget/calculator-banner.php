<?php

namespace Elementor;

class CustomCalcBanner extends Widget_Base
{

    public function get_style_depends()
    {
        return ['ber-css-calc-banner'];
    }


    public function get_name()
    {
        return "custom-calculator-banner.php";
    }

    public function get_title()
    {
        return "Custom Calculator Banner";
    }

    public function get_icon()
    {
        return 'eicon-site-search';
    }

    public function get_keywords()
    {
        return ['menu', 'nav', 'button', 'search'];
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }


    protected function render()
    {
        $id = get_the_ID();

        global $product;

        // If the product object is not defined, we get it from the product ID
        if (!is_a($product, 'WC_Product') && get_post_type($id) === 'product') {
            $product = wc_get_product($id);
        }

        $settings = $this->get_settings_for_display();

        $title = get_field('calc_banner_title', 'options');
        $description = get_field('calc_banner_description', 'options');
        $image = get_field('calc_banner_image', 'options');
        $is_product = is_product();
        if ($is_product && !has_term(18, 'product_cat'))
            return '';

        ?>
        <?php if ($title || $image) : ?>
        <section class="s-calc-banner">
            <div class="s-calc-banner__container">
                <div class="s-calc-banner__content">
                    <div class="s-calc-banner__text">
                        <?php if ($title) : ?>
                            <div class="s-calc-banner__title"><?php echo $title; ?></div>
                        <?php endif; ?>
                        <?php if ($description) : ?>
                            <div class="s-calc-banner__description">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="s-calc-banner__button">
                        <?php if ($is_product) { ?>
                            <a href="javascript:void(0);" class="JS--open-popup s-calc-banner__btn"
                               data-popup="calc"><?php _e('Use calculator', 'elr'); ?></a>
                        <?php } else { ?>
                            <a href="<?php echo get_permalink(11676); ?>"
                               class="s-calc-banner__btn"><?php _e('Use calculator', 'elr'); ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="s-calc-banner__image">
                    <?php echo wp_get_attachment_image($image['id'], 'full'); ?>
                </div>
            </div>
        </section>
    <?php endif;
    }
}
global $widgets;

$widgets->register(new \Elementor\CustomCalcBanner());

