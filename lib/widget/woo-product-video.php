<?php

namespace Elementor;

class CustomWooProductVideo extends Widget_Base
{
    public function get_style_depends()
    {
        return ['ber-css-video'];
    }

    public function get_name()
    {
        return "custom-woo-product-video";
    }

    public function get_title()
    {
        return "Woo Video";
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

        $id =get_edit_id_page();


        $video_bg = get_field('video_bg_image', $id);
        $video_url = get_field('youtube_video_url', $id);
        $title = get_field('video_bg_title', $id);
        $product_image = get_field('video_bg_product_image', $id);
        $rm_image_id = attachment_url_to_postid($video_bg);
        ?>
        <?php if ($video_url && $video_bg) : ?>
        <section class="s-product-video">

            <?php echo wp_get_attachment_image($rm_image_id, 'full', null, ['class' => 's-product-video__bg', 'style' => 'position: absolute; left: 0;top: 0; width: 100%;  height: 100%;object-fit: cover;object-position: 30% center;']); ?>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 col-lg-7">
                        <div class="s-product-video__content">
                            <?php if ($title) : ?>
                                <h2 class="s-product-video__title">
                                    <?php echo $title; ?>
                                </h2>
                            <?php endif; ?>
                            <p class="s-product-video__button-label"><?php _e('View Video', 'bestelectric'); ?></p>
                            <a href="<?php echo $video_url; ?>" class="s-product-video__button js--open-video-popup">
                                <span class="s-product-video__icon"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($product_image) : ?>
                <div class="s-product-video__image">
                    <?php echo wp_get_attachment_image($product_image['id'],'full'); ?>
                </div>
            <?php endif; ?>
        </section>

    <?php endif; ?>
        <?php
    }

    public function render_plain_content()
    {
    }


}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductVideo());



