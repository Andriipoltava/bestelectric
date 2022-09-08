<?php

namespace Elementor;

class CustomWooSingleProductFrom extends Widget_Base
{
    public function get_style_depends()
    {
        return ['ber-css-single-form', 'woocommerce-general'];
    }

    public function get_script_depends()
    {
        return ['swiper', 'ber-js-single-form', 'ber-woo-scripts'];
    }

    public function get_name()
    {
        return "custom-woo-single-product-form";
    }

    public function get_title()
    {
        return "Woo Product Form";
    }

    public function get_icon()
    {
        return 'eicon-post-content';
    }

    public function get_keywords()
    {
        return ['woocommerce', 'shop', 'store', 'product',];
    }

    public function get_group_name()
    {
        return 'product';
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'capital_content_section',
            [
                'label' => __('Layout', 'bestelectric'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->end_controls_section();


    }


    protected function render()
    {

        $id = get_edit_id_page();

        global $product;

        // If the product object is not defined, we get it from the product ID
        if (!is_a($product, 'WC_Product') && get_post_type($id) === 'product') {
            $product = wc_get_product($id);
        }
        if (get_post($id)->post_type !== 'product') {
            return '';
        }

        $title = get_field('long_title_product', $id) ?: str_replace('Wifi', '<sup>wifi</sup>', get_the_title());
        ?>
        <div class="o-product-top">
            <div class="o-product-top__summary">
                <?php if (get_field('label')) : ?>
                    <span class="o-product-top__label <?php echo (get_field('product_label_color') == 'blue') ? 'o-product-top__label--blue' : null; ?>"><?php the_field('label'); ?></span>
                <?php endif; ?>
                <h1 class="o-product-top__title"><?php echo $title ?></h1>

                <?php if (get_field('top_description_new_design', $id)) { ?>

                    <div class="o-product-top__add o-product-top__new">

                        <div class="o-product-top__price">
                            <span class="o-product-top__from"><?php _e('From  '); ?></span>
                            <span class=" JS--top-product-price">
                                    <?php $this->widget_pricing($product) ?>
                                </span>
                            <span class="o-product-top__price--inc"><?php _e('inc. VAT', 'bestelectric'); ?></span>
                        </div>

                        <div class="o-product-top__trustpilot JS--tustpilot-loader">
                            <div class="o-product-top__trustpilot--loader"></div>
                            <?php the_field('top_trustpilot_code', $id); ?>
                        </div>


                    </div>

                <?php } else { ?>

                    <?php if (get_field('top_trustpilot_code')) : ?>
                        <div class="o-product-top__trustpilot JS--tustpilot-loader">
                            <div class="o-product-top__trustpilot--loader"></div>
                            <?php the_field('top_trustpilot_code'); ?>
                        </div>
                    <?php endif; ?>


                    <div class="o-product-top__add">
                        <div class="o-product-top__price">
                            <span class="o-product-top__from"><?php _e('From  '); ?></span>
                            <span class=" JS--top-product-price">
                                    <?php $this->widget_pricing($product) ?>
                                </span>

                            <span class="o-product-top__price--inc"><?php _e('inc. VAT', 'bestelectric'); ?></span>
                        </div>

                        <?php
                        $product_includes_image = get_field('product_includes_image');
                        $product_includes_tooltip_text = get_field('product_includes_tooltip_text');
                        if ($product_includes_image) : ?>
                            <div class="o-product-top__includes">
                                <div class="c-image-tooltip">
                                    <img src="<?php echo esc_url($product_includes_image['url']); ?>"
                                         alt="<?php echo esc_attr($product_includes_image['alt']); ?>"/>
                                    <?php if ($product_includes_tooltip_text) : ?>
                                        <div class="c-image-tooltip__content"><?php echo $product_includes_tooltip_text; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php }; ?>

                <?php if ($product->get_short_description()) : ?>
                <div class="o-product-top__product-description">
                    <?php echo $product->get_short_description(); ?>

                    <?php else: echo "<div>";
                    endif; ?>

                    <div class="o-product-top__product-description__bottom">
                        <?php if (get_field('description_btn_show_anchor_features', $id)): ?>
                            <a class="anchor"
                               href="#features"><?php _e('See full description', 'bestelectric'); ?>
                                <i class="fa fa-arrow-down"></i>
                            </a>
                        <?php else: ?>
                            <span></span>
                        <?php endif; ?>
                        <?php if (get_field('description_bottom_right_icon', $id)):
                            echo wp_get_attachment_image(get_field('description_bottom_right_icon', $id)['id']);
                        endif; ?>
                    </div>
                </div>


                <div class="summary entry-summary" id="woocommerce_single_product_summary">
                    <?php
                    do_action('woocommerce_single_product_summary');
                    ?>
                    <?php if (get_field('payment_logos', 'option')) { ?>

                        <div id="ppc-bottom-payment-logos" class="hide pt10">
                            <?php echo wp_get_attachment_image(get_field('payment_logos', 'option')['id'], 'full'); ?>
                        </div>
                    <?php }; ?>
                </div>
                <?php $top_icon = get_field('warranty_header_icon', $id); ?>
                <div class="product-info">


                    <div class="accordions ">

                        <?php if (get_field('warranty_body', $id)) { ?>
                            <div class="accordion__item">
                                <div class="accordion__header">
                                    <div class="accordion__header__title">
                                        <?php echo isset($top_icon['id']) ? wp_get_attachment_image($top_icon['id']) : ''; ?>

                                        <?php echo get_field('warranty_header_text', $id) ?: 'Warranty'; ?>
                                    </div>

                                    <span class="acc-plus accordion__header__plus"></span>
                                </div>
                                <div class="accordion__body">
                                    <?php echo get_field('warranty_body', $id) ?: ''; ?>
                                </div>

                            </div>
                        <?php }; ?>
                        <?php $bot_icon = get_field('delivery_header_icon', $id) ?>
                        <?php if (get_field('delivery_body', $id)) { ?>
                            <div class="accordion__item">
                                <div class="accordion__header">

                                    <div class="accordion__header__title">
                                        <?php echo isset($bot_icon['id']) ? wp_get_attachment_image($bot_icon['id']) : ''; ?>

                                        <?php echo get_field('delivery_header_text', $id) ?: 'Delivery and Returns'; ?>
                                    </div>
                                    <span class="acc-plus accordion__header__plus"></span>
                                </div>
                                <div class="accordion__body">
                                    <?php echo get_field('delivery_body', $id) ?: ''; ?>
                                </div>
                            </div>
                        <?php }; ?>

                    </div>
                    <div>
                        <?php
                        $product_features_keys = get_field('key_features_list', $id);
                        if ($product_features_keys) : ?>
                            <ul class="features-list">
                                <?php foreach ($product_features_keys as $key => $post) : ?>
                                    <li class="list__item">
                                        <div class="list__item__wrap">
                                            <?php if (get_field('feature_icon', $post->ID)) {
                                                ; ?>
                                                <span class="list__icon <?php the_field('feature_icon', $post->ID);
                                                echo ' ' . $post->ID ?>"></span>
                                            <?php }; ?>
                                            <?php echo get_the_title($post->ID); ?></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if (get_field('features_popup_btn', $id)) { ?>
                        <div class="accordions__bottom">
                            <a href="javascript:void(0);" data-popup="features"
                               class=" JS--open-popup">
                                See All Features <span class="acc-plus">+</span>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <?php
    }

    public
    function render_plain_content()
    {
    }

    public function widget_pricing($product)
    {
        if (isset($_GET['attribute_pa_wattage'])) :
            $variations = $product->get_available_variations();

            foreach ($variations as $key => $variation) :
                if (!array_key_exists('attribute_pa_el_type', $variation['attributes'])) :
                    if ($variation['attributes']['attribute_pa_wattage'] == $_GET['attribute_pa_wattage'] && $variation['attributes']['attribute_pa_colour'] == 'white') :
                        echo $variation['price_html'];
                    endif;
                else :
                    if ($variation['attributes']['attribute_pa_wattage'] == $_GET['attribute_pa_wattage'] && $variation['attributes']['attribute_pa_el_type'] == 'oil-filled') :
                        echo $variation['price_html'];
                    endif;
                endif;
            endforeach;
        else :
            echo wc_price($product->get_price());
        endif;
    }


}

global $widgets;

$widgets->register(new \Elementor\CustomWooSingleProductFrom());



