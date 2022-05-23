<?php

namespace Elementor;

class CustomWooProductCompareRange extends Widget_Base
{
    public function get_script_depends()
    {
        return ['swiper', 'ber-js-product-compare-range'];
    }

    public function get_style_depends()
    {
        return ['ber-css-compare-range'];
    }

    public function get_name()
    {
        return "custom-woo-compare-range";
    }

    public function get_title()
    {
        return "Woo Compare Range";
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
            'widget_title',
            [
                'label' => esc_html__('Title', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Compare Ranges', 'bestelectric'),
                'placeholder' => esc_html__('Type your title here', 'bestelectric'),
            ]
        );
        $this->add_control(
            'ids',
            [
                'label' => esc_html__('Term Id', 'bestelectric'),
                'placeholder' => esc_html__('18', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::TEXT,

            ]
        );


        $this->end_controls_section();


    }


    protected function render()
    {

        $id = get_edit_id_page();
        $setting = $this->get_settings();


        global $product;

        $cat = get_queried_object();
        $parent_category = $cat->term_id ?: $setting['ids'];
        // If the product object is not defined, we get it from the product ID
        if (!is_a($product, 'WC_Product') && get_post_type($id) === 'product' ) {
            $product = wc_get_product($id);
        }


        if ($product && !is_tax()) {
            $cat = get_the_terms($product->get_id(), 'product_cat');
            foreach ($cat as $categoria) {
                if ($categoria->parent == 0) {
                    $parent_category = $categoria->term_taxonomy_id;
                }
            }
        }



        if ($setting['ids'])
            $parent_category = $setting['ids'];




        $products_args = array(
            'post_type' => 'any',
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $parent_category,
                    'operator' => 'IN',
                    'include_children' => false
                )
            )
        );

        $products_loop = new \WP_Query($products_args);
        ?>
        <?php if ($products_loop->have_posts()) : ?>
        <section class="s-compare-ranges ">


            <div class="JS-compare-ranges-slider swiper-custom" style="display: none">


                <div class="s-compare-ranges__intro <?php if (!$setting['widget_title']) echo 's-compare-ranges__notitle' ?>">
                    <?php if ($setting['widget_title']) {?>
                        <h2 class="s-compare-ranges__title"><?php echo $setting['widget_title']; ?></h2>
                    <?php } ?>
                    <div class="s-compare-ranges__nav">
                        <div class="s-compare-ranges__nav-arrow s-compare-ranges__nav-arrow-prev JS--compare-ranges-nav-prev">
                            <?php echo get_slider_prev_arrow(); ?>
                        </div>
                        <div class="s-compare-ranges__nav-arrow-fr JS--compare-ranges-nav-fraction"></div>
                        <div class="s-compare-ranges__nav-arrow  s-compare-ranges__nav-arrow-next JS--compare-ranges-nav-next">
                            <?php echo get_slider_next_arrow(); ?>
                        </div>
                    </div>
                </div>

                <div class="s-compare-ranges__slider swiper-wrapper">
                    <?php
                    $this->style_list_2($products_loop);

                    ?>
                </div>


            </div>

        </section>

    <?php endif; ?>
        <?php

    }

    public function style_list_1($products_loop)
    {
        ?>
        <?php while ($products_loop->have_posts()) : $products_loop->the_post();
        $product = wc_get_product();
        $product_label = get_field('label');
        $label_color = get_field('product_label_color');
        $id = $product->get_id();
        $color_terms = wp_get_post_terms($id, 'pa_colour');
        $product_image_gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
        $product_images_ids = explode(',', $product_image_gallery);
        $short_description = get_field('loop_short_description');

        ?>
        <div class="s-compare-ranges__slide swiper-slide">
            <div class="c-compare-ranges JS--compare-ranges-item">
                <div class="c-compare-ranges__thumb">
                    <a href="<?php the_permalink(); ?>" class="c-compare-ranges__thumb-link">
                        <?php if ($product_label) : ?>
                            <span class="c-compare-ranges__label <?php echo ($label_color == 'blue') ? 'c-compare-ranges__label--blue' : null; ?>"><?php echo $product_label; ?></span>
                        <?php endif; ?>
                        <div class="c-compare-ranges__thumb--main">
                            <?php echo wp_get_attachment_image(get_post_thumbnail_id($id), 'full'); ?>
                        </div>
                        <div class="c-compare-ranges__thumb--secondary JS--compare-ranges-thumb-secondary">
                            <?php echo wp_get_attachment_image($product_images_ids[0], 'full'); ?>
                        </div>
                    </a>
                </div>
                <div class="c-compare-ranges__body">
                    <h2 class="c-compare-ranges__title"><?php echo str_replace('Wifi', '<sup>wifi</sup>', get_the_title()); ?></h2>
                    <div class="c-compare-ranges__description">
                        <?php
                        echo $short_description; ?>
                    </div>
                    <?php if (have_rows('product_ksps_list')): ?>
                        <ul class="c-compare-ranges__ksp">
                            <?php while (have_rows('product_ksps_list')): the_row();
                                $ksp_item = get_sub_field('product_ksps_list_item');
                                ?>
                                <li class="c-compare-ranges__ksp-item">
                                    <?php echo $ksp_item; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="c-compare-ranges__footer">
                        <?php if ($color_terms) : ?>
                            <span class="c-compare-ranges__colors-label">Colours</span>
                            <div class="c-compare-ranges__colors 'c-compare-ranges__colors--reverses <?php //echo ($current_product_post_id == $id) ? 'c-compare-ranges__colors--reverse' : null; ?>">
                                <?php foreach ($color_terms as $term) :
                                    $product_color = get_term_meta($term->term_id);

                                    ?>

                                    <a href="<?php the_permalink(); ?>?attribute_pa_colour=<?php echo $term->slug; ?>"
                                       data-colour="<?php echo $term->slug; ?>"
                                       class="c-compare-ranges__color-btn JS--compare-ranges-color"
                                       style="background-color: <?php echo $product_color['product_attribute_color'][0]; ?>"></a>


                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="c-compare-ranges__price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        <div class="c-compare-ranges__btn">
                            <a href="<?php the_permalink(); ?>"
                               class="c-compare-ranges__product-link"><?php _e('Shop', 'bestelectric'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile;
        wp_reset_query(); ?>
        <?php
    }

    public function style_list_2($products_loop)
    {
        ?>
        <?php while ($products_loop->have_posts()) : $products_loop->the_post();
        $product = wc_get_product();
        $product_label = get_field('label');
        $label_color = get_field('product_label_color');
        $id = $product->get_id();
        $color_terms = wp_get_post_terms($id, 'pa_colour');
        $product_image_gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
        $product_images_ids = explode(',', $product_image_gallery);
        $short_description = get_field('loop_short_description');
        $variations = $product->get_available_variations();
        ?>
        <div class="s-compare-ranges__slide swiper-slide">
            <div class="c-compare-ranges JS--compare-ranges-item">
                <div class="c-compare-ranges__thumb">

                    <?php if ($color_terms) : ?>
                        <div class="c-compare-ranges-terms">
                            <div class="c-compare-ranges__colors 'c-compare-ranges__colors--reverses <?php //echo ($current_product_post_id == $id) ? 'c-compare-ranges__colors--reverse' : null; ?>">
                                <?php foreach ($color_terms as $term) :
                                    $product_color = get_term_meta($term->term_id);

                                    ?>

                                    <a href="<?php the_permalink(); ?>?attribute_pa_colour=<?php echo $term->slug; ?>"
                                       data-colour="<?php echo $term->slug; ?>"
                                       class="c-compare-ranges__color-btn JS--compare-ranges-color"
                                       style="background-color: <?php echo $product_color['product_attribute_color'][0]; ?>"></a>


                                <?php endforeach; ?>
                            </div>
                            <div class="c-compare-ranges__colors-label">Colours</div>
                        </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" class="c-compare-ranges__thumb-link">
                        <?php if ($product_label) : ?>
                            <span class="c-compare-ranges__label <?php echo ($label_color == 'blue') ? 'c-compare-ranges__label--blue' : null; ?>"><?php echo $product_label; ?></span>
                        <?php endif; ?>
                        <div class="c-compare-ranges__thumb--main">
                            <?php echo twl_lazy_image(get_post_thumbnail_id($id), 'woocommerce_thumbnail'); ?>
                        </div>
                        <div class="c-compare-ranges__thumb--secondary JS--compare-ranges-thumb-secondary">
                            <?php echo twl_lazy_image($product_images_ids[0], 'woocommerce_thumbnail'); ?>
                        </div>
                    </a>
                </div>
                <div class="c-compare-ranges__body">
                    <div class="c-compare-ranges__title"><?php echo str_replace('Wifi', '<sup>wifi</sup>', get_the_title()); ?></div>
                    <div class="c-compare-ranges__description">
                        <?php
                        echo $short_description; ?>
                    </div>
                    <?php if (have_rows('product_ksps_list')): ?>
                        <ul class="c-compare-ranges__ksp">
                            <?php while (have_rows('product_ksps_list')): the_row();
                                $ksp_item = get_sub_field('product_ksps_list_item');
                                ?>
                                <li class="c-compare-ranges__ksp-item">
                                    <?php echo $ksp_item; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="c-compare-ranges__recommended" style="display: none">
                        <p class="c-compare-ranges__recommended-label">Recommended Size</p>
                        <span class="c-compare-ranges__recommended-wattage JS--wattage-multiplier"></span><span class="c-compare-ranges__recommended-wattage JS--ranges-recommended-wattage"></span>
                    </div>

                    <div class="c-compare-ranges__footer">
                        <div class="c-compare-ranges__price JS--compare-ranges-price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        <div class="c-compare-ranges__btn">
                            <a href="<?php the_permalink(); ?>" data-link="<?php the_permalink(); ?>"
                               class="c-compare-ranges__product-link JS--recommended-product-link">Shop</a>
                        </div>
                    </div>
                </div>
                <?php foreach ($variations as $key => $variation) : ?>
                    <span class="c-compare-ranges__wattages JS--compare-ranges-wattages"
                          data-attribute_pa_wattage="<?php echo $variation['attributes']['attribute_pa_wattage']; ?>"
                          data-price="<?php echo strip_tags($variation['price_html']); ?>"
                          style="display: none;"></span>
                <?php endforeach; ?>
            </div>
        </div>


    <?php endwhile;
        wp_reset_query(); ?>
        <?php
    }


    public function render_plain_content()
    {
    }
}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductCompareRange());

