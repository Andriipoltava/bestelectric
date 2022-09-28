<?php

namespace Elementor;

class CustomWooSingleSlider extends Widget_Base
{
    public function get_style_depends()
    {
        return ['ber-css-single-gallery', 'cvy_fancybox'];
    }

    public function get_script_depends()
    {
        return ['ber-woo-scripts', 'jquery', 'ber-js-product-gallery', 'sweet_alert', 'cvy_fancybox', 'jquery-ui-core', 'smart-variations-images-premium'];
    }

    public function get_name()
    {
        return "custom-woo-single-slider";
    }

    public function get_title()
    {
        return "Woo Gallery";
    }

    public function get_icon()
    {
        return 'eicon-product-images';
    }

    public function get_keywords()
    {
        return ['woocommerce', 'shop', 'store', 'image', 'product', 'gallery', 'lightbox'];
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
        ?>
        <div class="o-product-top">
            <div class="o-product-top__img">
                <div class="c-gallery-loader JS--gallery-loader">
                    <div class="c-gallery-loader__thumb c-gallery-loader__thumb--big" style="position: absolute;
    z-index: 11;">
                        <?php echo get_big_loader_square(); ?>
                    </div>
                </div>
                <?php if (get_field('lot20_compliant', $id)): ?>
                    <div class="lot20"><a href="javascript:void(0);" class="JS--open-popup c-options-btns__item--lot20"
                                          data-popup="lot20"><?php echo '<img class="lot20__img" src="' . get_stylesheet_directory_uri() . '/img/lot20.svg" alt="LOT20" width="141" height="82" loading="lazy" />'; ?></a>
                    </div>
                <?php endif; ?>
                <div class="c-gallery__wrap">
                    <div class="gallery-vertical">
                        <div class="swiper-button-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.84" height="11.819"
                                 viewBox="0 0 19.84 11.819">
                                <g id="arrow" transform="translate(0.617 0.561)">
                                    <path id="arrow-2" data-name="arrow"
                                          d="M17.871.3a.51.51,0,0,0-.722,0L10.561,6.887l-1.008,1L1.763.3a.51.51,0,0,0-.722,0L.2,1.14a.51.51,0,0,0,0,.722l8.9,8.9a.51.51,0,0,0,.722,0l8.9-8.9Z"
                                          transform="translate(18.712 10.906) rotate(180)" fill="#707070"
                                          stroke="rgba(0,0,0,0)" stroke-width="1"/>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <div class="swiper gallery-swiper-vertical" id="gallery-swiper-vertical">
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <?php echo get_the_post_thumbnail($product->get_id(), 'woocommerce_gallery_thumbnail',[' loading'=>'lazy']); ?>
                                    </div>
                                    <?php $attachment_ids = $product->get_gallery_image_ids();

                                    foreach ($attachment_ids as $attachment_id) {
                                        ?>
                                        <div class="swiper-slide">

                                            <?php
                                            echo wp_get_attachment_image($attachment_id, 'woocommerce_gallery_thumbnail',null,[' loading'=>'lazy']); ?>
                                        </div>
                                    <?php }; ?>
                                </div>

                            </div>
                        </div>
                        <div class="swiper-button-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.84" height="11.819"
                                 viewBox="0 0 19.84 11.819">
                                <g id="arrow" transform="rotate(180) translate(-20 -10)">
                                    <path id="arrow-2" data-name="arrow"
                                          d="M17.871.3a.51.51,0,0,0-.722,0L10.561,6.887l-1.008,1L1.763.3a.51.51,0,0,0-.722,0L.2,1.14a.51.51,0,0,0,0,.722l8.9,8.9a.51.51,0,0,0,.722,0l8.9-8.9Z"
                                          transform="translate(18.712 10.906) rotate(180)" fill="#707070"
                                          stroke="rgba(0,0,0,0)" stroke-width="1"/>
                                </g>
                            </svg>
                        </div>
                    </div>


                    <div class="swiper gallery-swiper-main" id="gallery-swiper-main">
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide fancybox-trigger" data-id="0">
                                <?php echo get_the_post_thumbnail($product->get_id(), 'woocommerce_single',[' loading'=>'lazy']); ?>
                            </div>
                            <?php $attachment_ids = $product->get_gallery_image_ids();

                            foreach ($attachment_ids as $key=> $attachment_id) {
                                ?>
                                <div class="swiper-slide fancybox-trigger" data-id="<?php echo $key + 1 ?>">

                                    <?php
                                    echo wp_get_attachment_image($attachment_id, 'woocommerce_single',null,[' loading'=>'lazy']); ?>
                                </div>
                            <?php }; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <?php $this->btb_list(); ?>
            </div>
        </div>
        <div id="lightbox" style="display:none;">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-id="0">
                        <?php echo get_the_post_thumbnail($product->get_id(), 'full',[' loading'=>'lazy']); ?>
                    </div>
                    <?php $attachment_ids = $product->get_gallery_image_ids();
                    foreach ($attachment_ids as $key => $attachment_id) {
                        ?>
                        <div class="swiper-slide" data-id="<?php echo $key + 1 ?>">
                            <?php
                            echo wp_get_attachment_image($attachment_id, 'full',null ,[' loading'=>'lazy']); ?>
                        </div>
                    <?php }; ?>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
        </div>
        <?php
    }

    public
    function btb_list()
    {
        $id = get_edit_id_page();

        $guide = get_field('user_guide_url', $id);
        $video = get_field('youtube_video_url', $id);

        $views = get_field('360_view_photos', $id);
        ?>

        <?php if ($guide || $video || $views['photo_1']) : ?>

        <div class="c-product-buttons">

            <div class="c-product-buttons__grid">

                <?php if ($views['photo_1']) : ?>
                    <div class="c-product-buttons__column">
                        <div class="c-product-buttons__btn">
                            <a href="#cvy_reel_image" id="view_360" class="c-product-buttons__link">
                                <span class="c-product-buttons__icon">
                                    <img width="60" height="59"
                                         src="<?php echo get_stylesheet_directory_uri() ?>/img/360-view.png"
                                         alt="<?php _e('View 360', 'bestelectric'); ?>">
                                </span>
                                <span class="c-product-buttons__text ml-5"><?php _e('View 360', 'bestelectric'); ?></span>

                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($video) : ?>
                    <div class="c-product-buttons__column">
                        <div class="c-product-buttons__btn">
                            <a href="<?php echo $video; ?>" class="c-product-buttons__link js--open-video-popup ">
                            <span class="c-product-buttons__icon">
                                    <img width="58" height="42"
                                         src="<?php echo get_stylesheet_directory_uri() ?>/img/watch-video.png"
                                         alt="<?php _e('Watch Video', 'bestelectric'); ?>">
                            </span>

                                <span class="c-product-buttons__text ml-lg-22 ml-11"> <?php _e('Watch Video', 'bestelectric'); ?></span>

                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    <?php endif;
    }



}

global $widgets;

$widgets->register(new \Elementor\CustomWooSingleSlider());

