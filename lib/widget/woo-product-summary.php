<?php

namespace Elementor;

class CustomWooProductSummary extends Widget_Base
{
    public function get_style_depends()
    {
        return ['ber-css-summary', 'ber-bootstrap', 'ber-icon'];
    }

    public function get_name()
    {
        return "custom-woo-product-summary";
    }

    public function get_title()
    {
        return "Woo Summary";
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

        $product_overview = get_field('product_overview', $id);
        $key_features_list = get_field('key_features_list', $id);
        if (get_field('top_description_new_design', $id)) return ''

        ?>

        <?php if ($product_overview || $key_features_list) : ?>
        <section class="s-product-summary">
            <div class="container">
                <div class="row">
                    <?php if ($product_overview) : ?>
                        <div class="col-lg-4">
                            <div class="s-product-summary__overview">
                                <h2 class="s-product-summary__title"><?php _e('Product Overview', 'bestelectric'); ?></h2>
                                <div class="s-product-summary__overview-content">
                                    <?php echo $product_overview; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($key_features_list) : ?>
                        <div class="col-lg-8">
                            <div class="s-product-summary__features">
                                <h2 class="s-product-summary__title"><?php _e('Key Features', 'bestelectric'); ?></h2>
                                <?php
                                $product_features_keys = get_field('key_features_list', $id);
                                if ($product_features_keys) : ?>
                                    <ul class="c-key-features-list">
                                        <?php foreach ($product_features_keys as $post) : ?>
                                            <li class="c-key-features-list__item"><?php echo get_the_title($post->ID); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="s-product-summary__btn">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="javascript:void(0);" data-popup="features"
                               class="c-product-tabs-nav__item c-product-tabs-nav__item--default c-product-tabs-nav__item--small JS--open-popup">
                            <span class="c-product-tabs-nav__text">
                                  <span class="c-product-tabs-nav__icon icon-see-all-features"></span>
                                <?php _e('See All Features', 'bestelectric'); ?>
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
        <?php
    }

    public function render_plain_content()
    {
    }


}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductSummary());



