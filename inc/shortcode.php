<?php

add_shortcode('mobile_btn', function () {
    ob_start();
    ?>
    <div class="c-mobile-header__button JS--open-mobile-menu">
        <div class="c-mobile-header__btn JS--open-mobile-menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <?php
    return ob_get_clean();
});

add_shortcode('partners_footer', function () {
    $title = get_field('partners_logos_title', 'option');
    ?>
    <div class="c-partners-logos__grid">
        <div class="c-partners-logos__item c-partners-logos__item--title">
            <div class="c-partners-logos__title"><?php echo $title; ?></div>
        </div>
        <?php while (have_rows('partners_logos', 'option')): the_row();
            // vars
            $logo = get_sub_field('logo');
            $link = get_sub_field('link');
            ?>
            <div class="c-partners-logos__item">
                <?php if ($link) { ?>
                    <a href="<?php echo $link; ?>" class="c-partners-logos__link" target="_blank" rel="nofollow">
                        <?php echo wp_get_attachment_image($logo['id']); ?>
                    </a>
                <?php } else { ?>
                    <?php echo wp_get_attachment_image($logo['id']); ?>
                <?php } ?>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
});

//arrows slider
add_shortcode('slider_arrow', function () {
    ?>
    <div class="s-product-compare-sizes__nav slider_arrow">
        <div class="s-product-more-slider__nav-arrow slider_arrow-prev">
            <?php echo get_slider_prev_arrow(); ?>
        </div>
        <div class="s-product-compare-sizes__nav-arrow-fr slider_arrow-fraction"></div>
        <div class="s-product-more-slider__nav-arrow slider_arrow-next">
            <?php echo get_slider_next_arrow(); ?>
        </div>
    </div>
    <?php
});

// menu
function print_menu_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array('name' => null, 'class' => null), $atts));
    return wp_nav_menu(array('menu' => $name, 'echo' => false));
}

add_shortcode('menu', 'print_menu_shortcode');


add_shortcode('product_list', 'sh_product_list');

// product compare ranges
function sh_section_ksps()
{
    ob_start();
    if (have_rows('ksps_blocks', 'option')):
        ?>
        <section class="s-ksps">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="s-ksps__slider JS--ksps-slider">
                            <?php while (have_rows('ksps_blocks', 'option')): the_row();
                                $image = get_sub_field('ksps_blocks_icon');
                                $title = get_sub_field('ksps_blocks_title');
                                $content = get_sub_field('ksps_blocks_description');
                                ?>
                                <div class="s-ksps__slider__slide">
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
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;

    return ob_end_clean();
}

add_shortcode('the_term_thumbnail', function () {
    ob_start();
    global $post;

    $term = "";

    if (is_product_category()) {
        $term = get_queried_object();
        $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
    }

    if (isset($thumbnail_id)) {
        echo wp_get_attachment_image($thumbnail_id,'woocommerce_single',null,['style'=>'height: 100%;object-fit: cover; max-height: 379px; width: 100%;','class'=>' no-lazy remove-lazy attachment-full size-full ext-hidden tablet:ext-block']);
        echo wp_get_attachment_image($thumbnail_id,'woocommerce_thumbnail',null,['style'=>'height: 100%;object-fit: cover; max-height: 379px; width: 100%;','class'=>' no-lazy remove-lazy attachment-full size-full  tablet:ext-hidden ']);
    } else if (has_post_thumbnail()) {
        echo get_the_post_thumbnail($post, 'medium');
    }
    return ob_get_clean();
});