<?php

namespace Elementor;

class CustomWooProductTechSpecs extends Widget_Base
{
    public function get_script_depends()
    {
        return ['ber-js-product-tech-tabs'];
    }
    public function get_style_depends()
    {
        return ['ber-css-single-tech-tabs','ber-bootstrap'];
    }

    public function get_name()
    {
        return "custom-woo-tech-specs";
    }

    public function get_title()
    {
        return "Woo Tech Specs";
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

        $this->add_control(
            'background',
            [
                'label' => esc_html__('Background', 'bestelectric'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // The opacity property will override the default inactive dot color which is opacity 0.2.
                    '{{WRAPPER}} .s-product-tech-specs' => 'background-color: {{VALUE}}; ',
                ],

            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'label' => esc_html__( 'Padding', 'bestelectric' ),
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .s-product-tech-specs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


    }


    protected function render()
    {

        $id = get_edit_id_page();


        $product_specification_title = get_field('product_specifications_title',$id);

        if (have_rows('product_technical_specs',$id) || have_rows('tech_specs_boxes',$id)): ?>
            <section class="s-product-tech-specs">
                <div class="s-product-tech-specs__nav">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="c-product-tech-tabs-nav">
                                    <ul class="c-product-tech-tabs-nav__list">
                                        <?php if ($product_specification_title) : ?>
                                            <li class="c-product-tech-tabs-nav__item JS--product-tech-tab-nav is-active"
                                                data-spec-tab="1">
                                        <span class="c-product-tech-tabs-nav__item-title"
                                              title="<?php echo $product_specification_title; ?>"><?php echo $product_specification_title; ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php
                                        $counter_tab = 2;
                                        while (have_rows('product_technical_specs',$id)): the_row();
                                            $title = get_sub_field('product_technical_specs_title');
                                            ?>
                                            <li class="c-product-tech-tabs-nav__item JS--product-tech-tab-nav <?php echo (!$product_specification_title && $counter_tab == 2) ? 'is-active' : null;  ?>"
                                                data-spec-tab="<?php echo $counter_tab; ?>">

                                        <span class="c-product-tech-tabs-nav__item-title"
                                              title="<?php echo $title; ?>"><?php echo $title; ?></span>
                                            </li>

                                            <?php $counter_tab++; endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="s-product-tech-specs__tabs">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="s-product-tech-specs__accordion">
                                    <div class="c-product-tech-accordion">
                                        <?php if (have_rows('tech_specs_boxes',$id)) : ?>
                                            <div class="c-product-tech-accordion__content c-product-tech-accordion__content--full JS--product-specs-tab is-active"
                                                 data-spec-tab="1">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6 col-md-4">
                                                        <?php
                                                        while (have_rows('tech_specs_boxes',$id)):
                                                        the_row();
                                                        $content_title = get_sub_field('tech_specs_title');
                                                        $content_spec = get_sub_field('tech_specs_content');
                                                        $last_item = get_sub_field('last_item');
                                                        ?>
                                                        <div class="c-product-tech-specs__item">
                                                            <div class="c-product-tech-box">
                                                                <?php if ($content_title) : ?>
                                                                    <h3 class="c-product-tech-box__title">
                                                                        <?php echo $content_title; ?>
                                                                    </h3>
                                                                <?php endif; ?>
                                                                <?php if ($content_spec) : ?>
                                                                    <div class="c-product-tech-box__content">
                                                                        <?php echo $content_spec; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <?php if ($last_item): ?>
                                                    </div>
                                                    <div class="col-12 col-sm-6 col-md-4">
                                                        <?php endif; ?>
                                                        <?php endwhile; ?>
                                                    </div>

                                                </div>
                                            </div>

                                        <?php endif; ?>

                                        <?php
                                        $counter = 2;
                                        while (have_rows('product_technical_specs',$id)): the_row();

                                            $content = get_sub_field('product_technical_specs_content');
                                            ?>
                                            <div class="c-product-tech-accordion__content JS--product-specs-tab <?php echo (!$product_specification_title && $counter == 2) ? 'is-active' : null;  ?>"
                                                 data-spec-tab="<?php echo $counter; ?>">
                                                <?= $content; ?>
                                            </div>

                                            <?php $counter++; endwhile; ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        <?php endif;


    }



}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductTechSpecs());



