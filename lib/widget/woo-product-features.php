<?php

namespace Elementor;

class CustomWooProductFeature extends Widget_Base
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
        return "custom-woo-features";
    }

    public function get_title()
    {
        return "Woo Features";
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


        ?>
        <div class="o-product-features" style="display: none">

            <?php if (has_term(18, 'product_cat', $id)) : ?>
                <?php $this->tabs_nav(); ?>
            <?php endif; ?>

            <?php $this->image_slider(); ?>

            <?php $this->more_slider(); ?>

        </div>
        <?php


    }

    public function more_slider()
    {
        $id =get_edit_id_page();
        if (have_rows('product_more_slider', $id)): ?>
            <section class="s-product-more-slider ">

                <div class="s-more-slider__intro">
                    <h2 class="s-product-more-slider__title">
                        More to <span>love</span>

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

                    <?php while (have_rows('product_more_slider')): the_row();
                        $image = get_sub_field('product_more_slider_image');
                        $title = get_sub_field('product_more_slider_title');
                        $content = get_sub_field('product_more_slider_description');

                        $image_id = $image['ID'];
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
                    <?php endwhile; ?>

                </div>


            </section>
        <?php endif;
    }

    public function tabs_nav()
    {
        ?>
        <div class="c-product-tabs-nav">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="c-product-tabs-nav__buttons">
                            <div class="c-product-tabs-nav__btn">
                                <a href="javascript:void(0);" data-popup="features"
                                   class="c-product-tabs-nav__item c-product-tabs-nav__item--default JS--open-popup">
                            <span class="c-product-tabs-nav__text">
                                  <span class="c-product-tabs-nav__icon icon-see-all-features"></span>
                                <?php _e('See All Features', 'elr'); ?>
                            </span>
                                </a>
                            </div>
                            <div class="c-product-tabs-nav__btn">
                                <a href="javascript:void(0);" data-popup="sizes"
                                   class="c-product-tabs-nav__item c-product-tabs-nav__item--dark JS--open-popup">
                            <span class="c-product-tabs-nav__text">
                                 <span class="c-product-tabs-nav__icon icon-compare-sizes"></span>
                                <?php _e('Compare Sizes', 'elr'); ?>
                            </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    }

    public function image_slider()
    {
        $id = get_edit_id_page();
        $section_title = get_field('product_image_slider_title', $id);
        $section_description = get_field('product_image_slider_description', $id);
        ?>

        <?php if (have_rows('product_image_slider', $id)): ?>
        <section class="s-product-image-slider ">
            <?php if ($section_title || $section_description) : ?>
                <div class="s-product-image-slider__intro">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-9 col-lg-7">
                                <?php if ($section_title) : ?>
                                    <h2 class="s-product-image-slider__title"><?php echo $section_title; ?></h2>
                                <?php endif; ?>
                                <?php if ($section_description) : ?>
                                    <div class="s-product-image-slider__description">
                                        <?php echo $section_description; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="s-product-image-slider__slider swiper-custom">

                <div class="s-product-image-slider__arrow s-product-image-slider__prev "><?php echo get_slider_prev_arrow(); ?></div>
                <div class="c-product-image-slider swiper-wrapper">
                    <?php while (have_rows('product_image_slider', $id)): the_row();
                        $image = get_sub_field('image');
                        ?>
                        <?php if ($image) : ?>
                            <div class="c-product-image-slider__slide swiper-slide">
                                <div class="c-product-image-slider__img">
                                    <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <div class="s-product-image-slider__arrow s-product-image-slider__next"><?php echo get_slider_next_arrow(); ?></div>

                <div class="s-product-image-slider__dots">

                    <div class="s-product-image-slider__dots-list JS--product-image-slider-dots">

                    </div>

                </div>
            </div>


        </section>
    <?php endif;


    }

}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductFeature());



