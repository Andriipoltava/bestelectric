<?php

namespace Elementor;

class CustomWooProductFeaturesLIst extends Widget_Base
{
    public function get_style_depends()
    {
        return ['ber-css-features-lists', 'ber-bootstrap', 'ber-icon'];
    }

    public function get_script_depends()
    {
        return ['ber-js-product-features-lists'];
    }

    public function get_name()
    {
        return "custom-woo-product-features-list";
    }

    public function get_title()
    {
        return "Woo Features List";
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

        ?>

        <div class="s-product-all-features__lists">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php
                        $this->features_list('Product unique', 'product_unique_features','c-features-list--unique'); ?>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <?php
                        $this->features_list('Energy Saving', 'energy_saving_features'); ?>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <?php
                        $this->features_list('Design & Build', 'design_build_features'); ?>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <?php
                        $this->features_list('Usability', 'usability_features'); ?>
                    </div>
                </div>
            </div>


        </div>
        <?php
    }

    public function features_list($title, $field, $class = '')
    {
        $id = get_edit_id_page();
        $featured_types = get_field($field, $id);
        ?>
        <?php if ($featured_types) : ?>
        <div class="c-features-list <?php echo ($class) ?: null; ?>">
            <?php if ($title) : ?>
                <h3 class="c-product-features-list__title"><?php echo $title; ?></h3>
            <?php endif; ?>
            <ul class="c-product-features-list__items">
                <?php foreach ($featured_types as $post): ?>
                    <li class="c-product-features-list__item JS--featured-list-item">
                        <div class="c-product-features-list__header JS--featured-item-btn">
                            <span class="c-product-features-list__icon <?php the_field('feature_icon', $post->ID); ?>"></span>
                            <span class="c-product-features-list__name"><?php echo $post->post_title; ?></span>
                        </div>
                        <div class="c-product-features-list__description JS--featured-item-description">
                            <?php the_field('feature_short_description', $post->ID); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>

    <?php endif;
    }


}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductFeaturesLIst());



