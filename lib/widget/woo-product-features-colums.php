<?php

namespace Elementor;

class CustomWooProductFeatureColumns extends Widget_Base
{

    public function get_style_depends()
    {
        return ['ber-css-features-columns','ber-icon'];
    }
    public function get_name()
    {
        return "custom-woo-features-columns";
    }

    public function get_title()
    {
        return "Woo Features Columns";
    }

    public function get_icon()
    {
        return 'eicon-post-content';
    }
    public function get_categories()
    {
        return ['hello-elementor-theme'];
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


        $slider_main_title = get_field('slider_main_title', $id);

        if (have_rows('product_features_slider', $id)):
            ?>

            <section class="s-product-features-columns" id="features">
                <?php if ($slider_main_title) : ?>
                    <div class="s-product-features-columns__intro">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="s-product-features-columns__title"><?php echo $slider_main_title; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="container">
                    <?php
                    $features_counter = 1;
                    while (have_rows('product_features_slider', $id)): the_row();
                        $image = get_sub_field('slide_image');
                        $icon = get_sub_field('icon');
                        $subtitle = get_sub_field('subtitle');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');
                        ?>
                        <div class="row align-items-center s-product-features-columns__row">
                            <div class="col-md-6 col-xl-5 order-2 <?php echo ($features_counter % 2 == 0) ? 'order-md-2' : 'order-md-1'; ?>">
                                <div class="c-features-slide <?php echo ($features_counter % 2 == 0) ? 'c-features-slide--right' : null; ?>">
                                    <div class="c-features-slide__header">
                                        <div class="c-features-slide__icon">
                                            <span class="<?php echo $icon; ?>"></span>
                                        </div>
                                        <span class="c-features-slide__subtitle"><?php echo $subtitle; ?></span>
                                    </div>

                                    <div class="c-features-slide__body">
                                        <span class="c-features-slide__title"><?php echo $title; ?></span>
                                        <div class="c-features-slide__description">
                                            <?php echo $description; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-7 order-1 <?php echo ($features_counter % 2 == 0) ? 'order-md-1' : 'order-md-2'; ?>">
                                <div class="s-product-features-columns__image <?php echo ($features_counter % 2 == 0) ? 's-product-features-columns__image--left' : null; ?>">
                                    <?php
                                    if ($image) {
                                        echo wp_get_attachment_image($image['ID'], 'full');
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php $features_counter++; endwhile; ?>
                </div>
            </section>
        <?php endif; ?>
        <?php
    }

}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductFeatureColumns());



