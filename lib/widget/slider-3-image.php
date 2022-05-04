<?php

namespace Elementor;

class CustomSlider3Image extends Widget_Base
{

    public function get_style_depends()
    {
        return ['bestelectric-style'];
    }

    public function get_script_depends()
    {
        return ['swiper', 'ber-js-slider-3-image'];
    }

    public function get_name()
    {
        return "slider-3-image";
    }

    public function get_title()
    {
        return "Slide 3 Image";
    }

    public function get_icon()
    {
        return 'eicon-slides';
    }

    public function get_keywords()
    {
        return ['slider', 'image'];
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }

    public static function get_button_sizes()
    {
        return [
            'xs' => esc_html__('Extra Small', 'bestelectric'),
            'sm' => esc_html__('Small', 'bestelectric'),
            'md' => esc_html__('Medium', 'bestelectric'),
            'lg' => esc_html__('Large', 'bestelectric'),
            'xl' => esc_html__('Extra Large', 'bestelectric'),
        ];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            'section_slides',
            [
                'label' => esc_html__('Slides', 'bestelectric'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('slides_repeater');

        $repeater->add_control(
            'main-image',
            [
                'label' => __('Main Image', 'bestelectric'),
                'type' => Controls_Manager::MEDIA,

            ]
        );
        $repeater->add_responsive_control(
            'main-image_max_width',
            [
                'label' => esc_html__('Main Image Max Width', 'bestelectric'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px'],

                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}} .main-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_control(
            '1st-image',
            [
                'label' => __('Image ', 'bestelectric'),
                'type' => Controls_Manager::MEDIA,

            ]
        );
        $repeater->add_control(
            '1st-image-link',
            [
                'label' => esc_html__('First Imag Link', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_responsive_control(
            '1st-image_max_width',
            [
                'label' => esc_html__('First Image Max Width', 'bestelectric'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px'],

                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}} .first-st-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            '1st-image-position',
            [
                'label' => esc_html__('Padding', 'bestelectric'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}} .first-st-image' => 'top: {{TOP}}{{UNIT}}; left: {{LEFT}}{{UNIT}}; right: {{RIGHT}}{{UNIT}};bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_control(
            '2st-image',
            [
                'label' => __('Second Image', 'bestelectric'),
                'type' => Controls_Manager::MEDIA,

            ]
        );
        $repeater->add_control(
            '2st-image-link',
            [
                'label' => esc_html__('Second Image Link', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '/c/electric-radiators/',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );
        $repeater->add_responsive_control(
            '2st-image_max_width',
            [
                'label' => esc_html__('Second Image Max Width', 'bestelectric'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'size_units' => ['px'],

                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}} .second-st-image img' => 'max-width: {{SIZE}}{{UNIT}};width:100%',
                ],
            ]
        );


        $repeater->add_responsive_control(
            '2st-image-position',
            [
                'label' => esc_html__('Padding', 'bestelectric'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}} .second-st-image' => 'top: {{TOP}}{{UNIT}}; left: {{LEFT}}{{UNIT}}; right: {{RIGHT}}{{UNIT}};bottom: {{BOTTOM}}{{UNIT}};',
                ],

            ]
        );

        $repeater->add_control(
            'main_horizontal_position',
            [
                'label' => esc_html__('Horizontal Position', 'bestelectric'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'bestelectric'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'bestelectric'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'bestelectric'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .main-image' => 'justify-content: {{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left' => 'flex-start',
                    'center' => 'center',
                    'right' => 'flex-end',
                ],

            ]
        );

        $repeater->add_control(
            'main_vertical_position',
            [
                'label' => esc_html__('Vertical Position', 'bestelectric'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'middle',
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'bestelectric'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__('Middle', 'bestelectric'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'bestelectric'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .main-image' => 'align-items: {{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'top' => 'flex-start',
                    'middle' => 'center',
                    'bottom' => 'flex-end',
                ],

            ]
        );

        $repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'bestelectric'),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'fields' => $repeater->get_controls(),

            ]
        );


        $this->add_responsive_control(
            'slides_height',
            [
                'label' => esc_html__('Height', 'bestelectric'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 400,
                ],
                'size_units' => ['px', 'vh', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-3-image__wrap .main-image' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slider-3-image__wrap .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slider-3-image__wrap' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
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

        $this->end_controls_section();


    }

    protected function render()
    {


        $settings = $this->get_settings();

        if (empty($settings['slides'])) {
            return;
        }


//        $this->add_render_attribute( '_wrapper', 'class','elementor-widget-slides animated fadeInDown' );


        $slides = [];
        $slide_count = 0;

        foreach ($settings['slides'] as $slide) {
            $slide_html = '';
            $slide_attributes = '';
            if (empty($slide['main-image']))
                continue;

            $slide_html .= '<div class="swiper-slide-inner " ' . $slide_attributes . '>';
            $slide_html .= '<div class="slide-body" >';


            $slide_html .= '<div class="main-image">';
            $slide_html .= wp_get_attachment_image($slide['main-image']['id'], 'full');
            $slide_html .= '</div>';

            if (isset($slide['1st-image']) && $slide['1st-image']['id']) {
                if (isset($slide['1st-image-link'])&&isset($slide['1st-image-link']['url']) && $slide['1st-image-link']['url'] != '') {
                    $slide_html .= ' <a href="' . $slide['1st-image-link']['url'] . '">';
                }
                $slide_html .= '<div class="first-st-image second-image">';
                $slide_html .= wp_get_attachment_image($slide['1st-image']['id'], 'full');
                $slide_html .= '</div>';
                if (isset($slide['1st-image-link'])&&isset($slide['1st-image-link']['url']) && $slide['1st-image-link']['url'] != '') {
                    $slide_html .= ' </a>';
                }
            }
            if (isset($slide['2st-image']) && $slide['2st-image']['id']) {
                if (isset($slide['2st-image-link'])&&isset($slide['2st-image-link']['url']) && $slide['2st-image-link']['url'] != '') {
                    $slide_html .= ' <a href="' . $slide['2st-image-link']['url'] . '">';
                }
                $slide_html .= '<div class="second-st-image second-image">';
                $slide_html .= wp_get_attachment_image($slide['2st-image']['id'], 'full');
                $slide_html .= '</div>';
                if (isset($slide['2st-image-link'])&&isset($slide['2st-image-link']['url']) && $slide['2st-image-link']['url'] != '') {
                    $slide_html .= ' </a>';
                }

            }
            $slide_html .= '</div>';

            $slide_html .= '</div>';


            $slides[] = '<div class="elementor-repeater-item-' . $slide['_id'] . ' swiper-slide">' . $slide_html . '</div>';
            $slide_count++;
        }


        $slides_count = count($settings['slides']);
        ?>

        <div class="slider-3-image swiper-custom" style="overflow: hidden">
            <div class="slider-3-image__wrap swiper-wrapper">
                         <?php echo implode('', $slides);
                ?>
            </div>
            <?php if (1 < $slides_count) : ?>

                <div class="slider-3-image__pagination swiper-pagination"></div>

            <?php endif; ?>
        </div>

        <?php
    }

    /**
     * Render Slides widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 2.9.0
     * @access protected
     */
    protected function content_template__test()
    {
        ?>
        <#
        var direction        = elementorFrontend.config.is_rtl ? 'rtl' : 'ltr',
        next             = elementorFrontend.config.is_rtl ? 'left' : 'right',
        prev             = elementorFrontend.config.is_rtl ? 'right' : 'left',
        navi             = settings.navigation,
        showDots         = ( 'dots' === navi || 'both' === navi ),
        showArrows       = ( 'arrows' === navi || 'both' === navi ),
        buttonSize       = settings.button_size;
        console.log(settings,elementorFrontend);
        #>

        <div class="slider-3-image swiper-custom" dir="{{ direction }}"
             data-animation="{{ settings.content_animation }}"
             data-setting="{autoplay_speed:{{settings.autoplay_speed}}}">
            <div class="slider-3-image__wrap swiper-wrapper ">
                <# jQuery.each( settings.slides, function( index, slide ) { #>
                <div class="elementor-repeater-item-{{ slide._id }} swiper-slide">
                    <div class="swiper-slide-inner">
                        <div class="slide-body">
                            <# console.log(slide);#>

                        </div>
                    </div>
                </div>
                <# } ); #>
            </div>
            <# if ( 1 < settings.slides.length ) { #>

            <div class="slider-3-image__pagination swiper-pagination"></div>

            <# } #>
        </div>

        <?php
    }

}

global $widgets;
$widgets->register(new \Elementor\CustomSlider3Image());



