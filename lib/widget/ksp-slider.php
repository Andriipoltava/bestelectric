<?php

namespace Elementor;

class CustomSliderIconList extends Widget_Base
{

    public function get_style_depends()
    {
        return ['ber-css-slider-ksp'];
    }

    public function get_script_depends()
    {
        return ['swiper', 'ber-js-slider-ksp'];
    }

    public function get_name()
    {
        return "slider-icon-list";
    }

    public function get_title()
    {
        return "KSP Slide";
    }

    public function get_icon()
    {
        return 'eicon-rating';
    }

    public function get_keywords()
    {
        return ['slider', 'image'];
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            'section_slides',
            [
                'label' => esc_html__('Slides', 'bestelectric'),
            ]
        );
        $this->add_control(
            'type_slider',
            [
                'label' => esc_html__('Type Content', 'bestelectric'),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon_text',
                'options' => [
                    'icon_text' => esc_html__('Icon Title', 'bestelectric'),
                    'icon_text_contant' => esc_html__('Icon Title Contant', 'bestelectric'),

                ]


            ]
        );
        $this->add_control(
            'dots_slider',
            [
                'label' => esc_html__('Dots', 'bestelectric'),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__('Yes', 'bestelectric'),
                    'no' => esc_html__('No', 'bestelectric'),
                ]
            ]
        );
        $this->add_control(
            'link_slider',
            [
                'label' => esc_html__('Link', 'bestelectric'),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__('Yes', 'bestelectric'),
                    'no' => esc_html__('No', 'bestelectric'),
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => esc_html__('Navigation', 'bestelectric'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );


        $this->add_control(
            'dots_size',
            [
                'label' => esc_html__('Size', 'bestelectric'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 15,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .slider-3-image__pagination' => 'min-height: {{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_control(
            'dots_color_inactive',
            [
                'label' => esc_html__('Color', 'bestelectric'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // The opacity property will override the default inactive dot color which is opacity 0.2.
                    '{{WRAPPER}} .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background-color: {{VALUE}}; opacity: 1;',
                ],

            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => esc_html__('Active Color', 'bestelectric'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'bestelectric' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
            ]
        );
        $this->add_control(
            'border_active_color',
            [
                'label' => esc_html__('Active Color', 'bestelectric'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow Active ', 'bestelectric' ),
                'selector' => '{{WRAPPER}} .swiper-pagination-bullet-active',
            ]
        );

        $this->end_controls_section();

        $this->end_controls_section();


    }


    protected function render()
    {


        $settings = $this->get_settings();
        if (have_rows('ksps_blocks', 'option')):
            if ($settings['type_slider'] == 'icon_text_contant') {
                $this->slider_content();
            } else {
                $this->slider_small();
            }

            ?>


        <?php endif;
    }

    public function slider_content()
    {
        $settings = $this->get_settings();
        ?>
        <section class="s-ksps <?php echo $settings['type_slider']?>" style="display: none">
            <div class="slider-icon-list swiper-custom">
                <div class="s-ksps__slider swiper-wrapper c-ksp-icon-list__slider">
                    <?php while (have_rows('ksps_blocks', 'option')): the_row();
                        $image = get_sub_field('ksps_blocks_icon');
                        $title = get_sub_field('ksps_blocks_title');
                        $content = get_sub_field('ksps_blocks_description');
                        $link = get_sub_field('ksps_blocks_link');
                        ?>
                        <div class="s-ksps__slider__slide swiper-slide">
                            <?php if ($settings['link_slider'] == 'yes' && $link) {
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                echo "<a href='{$link_url}'  target='{$link_target}' title='{$link_title}' >";
                            } ?>
                            <div class="s-ksps__slider__box">
                                <div class="s-ksps__slider__img">
                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                                </div>
                                <div class="s-ksps__slider__content">
                                    <?php if ($title) : ?>
                                        <h3 class="s-ksps__slider__title"><?php echo $title; ?></h3>
                                    <?php endif; ?>
                                    <?php if ($content) : ?>
                                        <div class="s-ksps__slider__desc">
                                            <?php echo $content; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ($settings['link_slider'] == 'yes' && $link) {
                                echo "</a>";
                            } ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php if (isset($settings['dots_slider']) && $settings['dots_slider'] == 'yes') { ?>
                    <div class="slider-icon-list__pagination swiper-pagination"></div>
                <?php }; ?>
            </div>
        </section>
        <?php

    }

    public function slider_small()
    {
        $hide_ksps = get_field('global_hide_ksps');
        $settings = $this->get_settings();
        ?>
        <div class="c-ksp-icon-list <?php echo (!is_front_page() && !is_tax('product_cat', 'electric-radiators') && !$hide_ksps) ? 'c-ksp-icon-list--top' : null; ?>"
             style="display: none">


            <div class="slider-icon-list swiper-custom" style="overflow: hidden">
                <div class="slider-icon-list__wrap swiper-wrapper c-ksp-icon-list__slider ">
                    <?php while (have_rows('ksps_blocks', 'option')): the_row();
                        $image = get_sub_field('ksps_blocks_icon');
                        $title = get_sub_field('ksps_blocks_title');
                        $link = get_sub_field('ksps_blocks_link');
                        ?>
                        <div class="c-ksp-icon-list__slide  swiper-slide ">
                            <?php if ($settings['link_slider'] == 'yes' && $link) {
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ?: '_self';
                                echo "<a href='{$link_url}'  target='{$link_target}' title='{$link_title}' >";
                            } ?>
                            <div class="c-ksp-icon-list__box">
                                <div class="c-ksp-icon-list__icon">
                                    <?php echo wp_get_attachment_image($image['id']); ?>
                                </div>
                                <div class="c-ksp-icon-list__content">
                                    <div class="c-ksp-icon-list__title"><?php echo $title; ?></div>
                                </div>
                            </div>
                            <?php if ($settings['link_slider'] == 'yes' && $link) {
                                echo "</a>";
                            } ?>
                        </div>
                    <?php endwhile; ?>

                </div>
                <?php if (isset($settings['dots_slider']) && $settings['dots_slider'] == 'yes') { ?>
                    <div class="slider-icon-list__pagination swiper-pagination"></div>
                <?php }; ?>
            </div>
        </div>
        <?php
    }

    public function list()
    {
        $settings = $this->get_settings();
        ?>
        <?php while (have_rows('ksps_blocks', 'option')): the_row();
        $image = get_sub_field('ksps_blocks_icon');
        $title = get_sub_field('ksps_blocks_title');
        $link = get_sub_field('ksps_blocks_link');

        ?>
        <div class="c-ksp-icon-list__slide  swiper-slide ">
            <div class="c-ksp-icon-list__box">
                <?php if ($settings['link_slider'] == 'yes' && $link) {
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ?: '_self';
                    echo "<a href='{$link_url}'  target='{$link_target}' title='{$link_title}' >";
                } ?>
                <div class="c-ksp-icon-list__icon">
                    <?php echo wp_get_attachment_image($image['id']); ?>
                </div>
                <div class="c-ksp-icon-list__content">
                    <div class="c-ksp-icon-list__title"><?php echo $title; ?></div>
                </div>
                <?php if (isset($settings['dots_slider']) && $settings['dots_slider'] == 'yes') { ?>
                    <div class="slider-icon-list__pagination swiper-pagination"></div>
                <?php }; ?>
            </div>
        </div>
    <?php endwhile; ?>


        <?php
    }

}

global $widgets;

$widgets->register(new \Elementor\CustomSliderIconList());

