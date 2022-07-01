<?php

namespace Elementor;

class CustomMoreSlider extends Widget_Base
{
    public function get_script_depends()
    {
        return ['swiper', 'ber-js-product-features'];
    }

    public function get_style_depends()
    {
        return ['ber-css-more'];
    }

    public function get_name()
    {
        return "more-slider";
    }

    public function get_title()
    {
        return "More Slider";
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


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__('Title', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('List Title', 'plugin-name'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__('Choose Image', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__('Content', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('List Content', 'plugin-name'),
                'show_label' => false,
            ]
        );


        $this->add_control(
            'list',
            [
                'label' => esc_html__('Repeater List', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),

                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();


        $this->end_controls_section();


    }


    protected function render()
    {

        $id = get_edit_id_page();
        ?>

        <?php $this->more_slider(); ?>
        <?php


    }

    public function more_slider()
    {
        $id = get_edit_id_page();
        $settings = $this->get_settings_for_display();

        if ($settings['list']): ?>
            <section class="o-product-featuresr ">
                <section class="s-product-more-slider ">
                    <div class="s-more-slider__intro">
                        <h2 class="s-product-more-slider__title">
                        </h2>
                        <div class="s-product-more-slider__nav">
                            <div class="s-product-more-slider__nav-arrow JS--product-slider-nav-prev">
                                <?php echo get_slider_prev_arrow(); ?>
                            </div>
                            <div class="s-product-more-slider__nav-arrow-fr JS--product-slider-nav-fraction"></div>
                            <div class="s-product-more-slider__nav-arrow JS--product-slider-nav-next">
                                <?php echo get_slider_next_arrow(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="s-product-more-slider__slider swiper-wrapper">
                        <?php
                        foreach ($settings['list'] as $item) {
                            $image = $item['list_image'];

                            $title = $item['list_title'];
                            $content = $item['list_content'];
                            $image_id = $image['id'];
                            $size = 'product-more-slider';
                            ?>
                            <div class="s-product-more-slider__slide swiper-slide">
                                <div class="s-product-more-slider__box">
                                    <?php if ($image) : ?>
                                        <div class="s-product-more-slider__img">
                                            <?php echo wp_get_attachment_image($image_id, $size); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="s-product-more-slider__content">
                                        <h3 class="s-product-more-slider__subtitle"><?php echo $title; ?></h3>
                                        <div class="s-product-more-slider__description">
                                            <?php echo $content; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }; ?>

                    </div>


                </section>
            </section>
        <?php endif;
    }


}

global $widgets;

$widgets->register(new \Elementor\CustomMoreSlider());



