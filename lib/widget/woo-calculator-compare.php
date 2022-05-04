<?php

namespace Elementor;

class CustomWooCalcCompare extends Widget_Base
{

    public function get_style_depends()
    {
        return ['ber-css-compare', 'ber-bootstrap'];
    }

    public function get_script_depends()
    {
        return ['ber-js-calc-compare', 'swiper'];
    }

    public function get_name()
    {
        return "custom-calculator-compare";
    }

    public function get_title()
    {
        return "Woo Calculator Compare";
    }

    public function get_icon()
    {
        return 'eicon-price-list';
    }

    public function get_keywords()
    {
        return ['menu', 'nav', 'button'];
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }

    protected function render()
    {
        $id = get_edit_id_page();
        if (get_post($id)->post_type !== 'product') {
            return '';
        }
        ?>
        <div class="container s-product-compare-sizes__container">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="s-product-compare-sizes__grid">
                        <div class="s-product-compare-sizes__aside">
                            <?php $this->sizes_aside(); ?>
                        </div>
                        <div class="s-product-compare-sizes__slider-wrapper">

                            <?php if (has_term(21, 'product_cat', $id)) : ?>
                                <?php $this->sizes_tower(); ?>
                            <?php else : ?>
                                <?php $this->sizes() ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function sizes_aside()
    {
        $id = get_edit_id_page();
        ?>
        <div class="c-compare-sizes-aside">
        <div class="c-compare-sizes-aside__header">
            <h4 class="c-compare-sizes-aside__title">Radiator</h4>
        </div>
        <?php if (!has_term(21, 'product_cat', $id)) : ?>
            <div class="c-compare-sizes-aside__room-sizes">
                <h4 class="c-compare-sizes-aside__title">Room Sizes</h4>
                <ul class="c-compare-sizes-aside__list">
                    <li class="c-compare-sizes-aside__item">High/New Insulation</li>
                    <li class="c-compare-sizes-aside__item">Low/Old Insulation</li>
                </ul>
            </div>
        <?php endif; ?>

        <div class="c-compare-sizes-aside__dimensions">
            <h4 class="c-compare-sizes-aside__title">Dimensions</h4>
            <ul class="c-compare-sizes-aside__list">
                <li class="c-compare-sizes-aside__item">Width</li>
                <li class="c-compare-sizes-aside__item">Height</li>
                <li class="c-compare-sizes-aside__item">Depth</li>
                <li class="c-compare-sizes-aside__item">Weight</li>
            </ul>
        </div>
        </div><?php
    }


    public function sizes()
    {

        $current_product_id = get_edit_id_page();

        $product = new \WC_Product_Variable($current_product_id);
        $variations = $product->get_available_variations();
        if (!$variations = $product->get_available_variations())
            return '';
        $color_terms = get_the_terms($product->get_id(), 'pa_colour');
        $type_terms = get_the_terms($product->get_id(), 'pa_el_type');
        ?>

        <?php if ($product->is_type('variable')) :

        usort($variations, function ($a, $b) {
            return $a["attributes"]['attribute_pa_wattage'] - $b["attributes"]['attribute_pa_wattage'];
        });
        $all_wattage_array = array();
        foreach ($variations as $variation) {
            $all_wattage_array[] = $variation["attributes"]['attribute_pa_wattage'];
        }
        $unique_wattage = array_unique($all_wattage_array);

        $filtered_variations = array();

        foreach ($unique_wattage as $wattage) {
            $filtered_variations[] = array_filter($variations, function ($element) use ($wattage) {
                return ($element["attributes"]['attribute_pa_wattage'] == $wattage);
            });
        }

        ?>

        <div class="c-compare-sizes JS--compare-sizes-slider swiper-custom">
            <div class="c-compare-sizes__slider swiper-wrapper">


                <?php foreach ($filtered_variations as $filtered_variation) : ?>
                    <div class="c-compare-sizes__slide  swiper-slide">
                        <div class="c-compare-sizes-product ">
                            <?php foreach ($filtered_variation as $var_product) :
                                $variation_id = $var_product['variation_id'];
                                $first_element = reset($filtered_variation);

                                ?>
                                <?php if (!isset($var_product['attributes']['attribute_pa_el_type'])): ?>
                                <div class="c-compare-sizes-product__wrap JS--compare-item <?php echo ($first_element == $var_product) ? 'is-visible' : null; ?>"
                                     data-compare="<?php echo $var_product['attributes']['attribute_pa_colour'] ?: ''; ?>">
                                    <div class="c-compare-sizes-product__thumb">
                                        <a data-fancybox="gallery"
                                           href="<?php echo $var_product['image']['full_src']; ?>">
                                            <img src="<?php echo $var_product["image"]["thumb_src"]; ?>"
                                                 title="<?php echo $var_product['image']['title']; ?>"
                                                 srcset="<?php echo $var_product["image"]["srcset"]; ?>"
                                                 alt="<?php echo $var_product["image"]["alt"]; ?>">
                                        </a>
                                    </div>
                                    <div class="c-compare-sizes-product__wattage">
                                        <?php echo $var_product["attributes"]["attribute_pa_wattage"] ?: ''; ?>W
                                    </div>
                                    <?php if ($color_terms) : ?>
                                        <h4 class="c-compare-sizes-product__colors-label">Select Colour:</h4>
                                        <div class="c-compare-sizes-product__colors">

                                            <?php foreach ($color_terms as $term) :
                                                $product_color = get_term_meta($term->term_id);
                                                ?>

                                                <span class="c-compare-sizes-product__color-btn JS--compare-sizes-color <?php echo ($first_element['attributes']['attribute_pa_colour'] == $term->slug) ? 'is-active' : null; ?>"
                                                      data-compare-color="<?php echo $term->slug; ?>"
                                                      style="background-color: <?php echo $product_color['product_attribute_color'][0]; ?>"></span>


                                            <?php endforeach; ?>

                                        </div>
                                    <?php endif; ?>

                                    <div class="c-compare-sizes-form">
                                        <form method="post"
                                              action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                                              class="c-compare-sizes-form__form cart">
                                            <div class="c-compare-sizes-form__row">
                                                <div class="c-compare-sizes-form__column">
                                                    <div class="c-compare-sizes-form__price">
                                                        <?php echo $var_product["price_html"]; ?>
                                                    </div>
                                                </div>
                                                <div class="c-compare-sizes-form__column">
                                                    <div class="cvy_quantity cvy_property_quantity">
                                                        <?php if ($var_product['is_in_stock']): ?>
                                                            <span class="cvy_minus_trigger cvy_input_trigger">&ndash;</span>

                                                            <input type="text"
                                                                   name="quantity"
                                                                   readonly="readonly" value="1" data-min="1"
                                                                   data-max="<?php echo $var_product['max_qty']; ?>"
                                                                   data-step="1">

                                                            <span class="cvy_plus_trigger cvy_input_trigger">+</span>
                                                        <?php else: ?>
                                                            <?php echo $var_product['availability_html']; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="product_id"
                                                   value="<?php echo $product->get_id(); ?>">
                                            <?php foreach ($var_product['attributes'] as $key => $value) : ?>
                                                <input type="hidden"
                                                       name="variations[<?php echo $variation_id; ?>][attributes][<?php echo $key; ?>]"
                                                       value="<?php echo $value; ?>">
                                            <?php endforeach; ?>
                                            <?php foreach ($var_product['attributes'] as $key => $value) : ?>
                                                <input type="hidden"
                                                       name="<?php echo $key; ?>"
                                                       value="<?php echo $value; ?>">
                                            <?php endforeach; ?>
                                            <input type="hidden" name="add-to-cart"
                                                   value="<?php echo $product->get_id(); ?>">
                                            <input type="hidden" name="variation_id"
                                                   value="<?php echo $variation_id; ?>">
                                            <?php if ($var_product['backorders_allowed']) : ?>
                                                <?php echo $var_product['availability_html']; ?>
                                            <?php endif; ?>
                                            <button type="submit" name="cvy_radiator_variation_list_submit"
                                                    class="c-compare-sizes-form__submit single_add_to_cart_button">
                                                Buy Now
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="c-compare-sizes-product__details  JS--compare-item <?php echo ($first_element == $var_product) ? 'is-visible' : null; ?>"
                                     data-compare="<?php echo $var_product['attributes']['attribute_pa_colour']?:''; ?>">
                                    <div class="c-compare-sizes-product__insulation">
                                        <?php
                                        $area = get_post_meta($variation_id, '_cvy_area', true);
                                        $low_area = get_post_meta($variation_id, '_cvy_area_low', true);

                                        if (!empty($area)) :
                                            ?>
                                            <h4 class="c-compare-sizes-product__list-title">Room Sizes</h4>
                                            <ul class="c-compare-sizes-product__list">
                                                <li>
                                                    <span class="c-compare-sizes-product__list--mobile-info">High/New Insulation</span>
                                                    <?php echo $area; ?>m2
                                                </li>
                                                <li>
                                                    <span class="c-compare-sizes-product__list--mobile-info">Low/Old Insulation</span>
                                                    <?php if (!empty($low_area)) : ?>
                                                        <?php echo $low_area; ?>m2
                                                    <?php endif; ?>
                                                </li>
                                            </ul>

                                        <?php endif; ?>
                                    </div>

                                    <div class="c-compare-sizes-product__dimensions">
                                        <h4 class="c-compare-sizes-product__list-title">Dimensions</h4>
                                        <ul class="c-compare-sizes-product__list">
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Width</span>
                                                <?php echo $var_product['dimensions']['length']; ?>mm
                                            </li>
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Height</span>
                                                <?php echo $var_product['dimensions']['height']; ?>mm
                                            </li>
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Depth</span>
                                                <?php echo $var_product['dimensions']['width']; ?>mm
                                            </li>
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Weight</span>
                                                <?php echo $var_product['weight_html']; ?>
                                            </li>
                                        </ul>
                                    </div>


                                </div>
                            <?php else : ?>

                                <div class="c-compare-sizes-product__wrap c-compare-sizes-product__wrap--types  JS--compare-item <?php echo ($first_element == $var_product) ? 'is-visible' : null; ?>"
                                     data-compare="<?php echo $var_product['attributes']['attribute_pa_el_type']; ?>">
                                    <div class="c-compare-sizes-product__thumb">
                                        <a data-fancybox="gallery"
                                           href="<?php echo $var_product['image']['full_src']; ?>">
                                            <img
                                                    src="<?php echo $var_product["image"]["thumb_src"]; ?>"
                                                    title="<?php echo $var_product['image']['title']; ?>"
                                                    caption="<?php echo $var_product['image']['caption']; ?>"
                                                    srcset="<?php echo $var_product["image"]["srcset"]; ?>"
                                                    alt="<?php echo $var_product["image"]["alt"]; ?>">
                                        </a>
                                    </div>
                                    <div class="c-compare-sizes-product__wattage">
                                        <?php echo $var_product["attributes"]["attribute_pa_wattage"]; ?>W
                                    </div>
                                    <h4 class="c-compare-sizes-product__colors-label">Select Colour:</h4>
                                    <div class="c-compare-sizes-product__colors">

                                        <?php foreach ($color_terms as $term) :
                                            $product_color = get_term_meta($term->term_id);
                                            ?>

                                            <span class="c-compare-sizes-product__color-btn  <?php echo ($first_element['attributes']['attribute_pa_colour'] == $term->slug) ? 'is-active' : null; ?>"
                                                  data-compare-color="<?php echo $term->slug; ?>"
                                                  style="background-color: <?php echo $product_color['product_attribute_color'][0]; ?>"></span>


                                        <?php endforeach; ?>

                                    </div>
                                    <div class="c-compare-sizes-product__types">
                                        <?php foreach ($type_terms as $type) : ?>

                                            <span class="c-compare-sizes-product__type-btn JS--compare-sizes-type-btn  <?php echo ($first_element['attributes']['attribute_pa_el_type'] == $type->slug) ? 'is-active' : null; ?>"
                                                  data-compare-type="<?php echo $type->slug; ?>"
                                            ><?php echo $type->name; ?></span>

                                        <?php endforeach; ?>
                                    </div>
                                    <div class="c-compare-sizes-form">
                                        <form method="post"
                                              action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                                              class="c-compare-sizes-form__form">
                                            <div class="c-compare-sizes-form__row">
                                                <div class="c-compare-sizes-form__column">
                                                    <div class="c-compare-sizes-form__price">
                                                        <?php echo $var_product["price_html"]; ?>
                                                    </div>
                                                </div>
                                                <div class="c-compare-sizes-form__column">
                                                    <div class="cvy_quantity cvy_property_quantity">
                                                        <?php if ($var_product['is_in_stock']): ?>
                                                            <span class="cvy_minus_trigger cvy_input_trigger">&ndash;</span>

                                                            <input type="text"
                                                                   name="quantity"
                                                                   readonly="readonly" value="1" data-min="1"
                                                                   data-max="<?php echo $var_product['max_qty']; ?>"
                                                                   data-step="1">

                                                            <span class="cvy_plus_trigger cvy_input_trigger">+</span>
                                                        <?php else: ?>
                                                            <?php echo $var_product['availability_html']; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                            </div>

                                            <input type="hidden" name="product_id"
                                                   value="<?php echo $product->get_id(); ?>">
                                            <?php foreach ($var_product['attributes'] as $key => $value) : ?>
                                                <input type="hidden"
                                                       name="variations[<?php echo $variation_id; ?>][attributes][<?php echo $key; ?>]"
                                                       value="<?php echo $value; ?>">
                                            <?php endforeach; ?>
                                            <?php foreach ($var_product['attributes'] as $key => $value) : ?>
                                                <input type="hidden"
                                                       name="<?php echo $key; ?>"
                                                       value="<?php echo $value; ?>">
                                            <?php endforeach; ?>
                                            <input type="hidden" name="add-to-cart"
                                                   value="<?php echo $product->get_id(); ?>">
                                            <input type="hidden" name="variation_id"
                                                   value="<?php echo $variation_id; ?>">
                                            <?php if ($var_product['backorders_allowed']) : ?>
                                                <?php echo $var_product['availability_html']; ?>
                                            <?php endif; ?>
                                            <button type="submit" name="cvy_radiator_variation_list_submit"
                                                    class="c-compare-sizes-form__submit">
                                                Buy Now
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="c-compare-sizes-product__details  JS--compare-item <?php echo ($first_element == $var_product) ? 'is-visible' : null; ?>"
                                     data-compare="<?php echo $var_product['attributes']['attribute_pa_el_type']; ?>">
                                    <div class="c-compare-sizes-product__insulation">
                                        <?php
                                        $area = get_post_meta($variation_id, '_cvy_area', true);
                                        $low_area = get_post_meta($variation_id, '_cvy_area_low', true);

                                        if (!empty($area)) :
                                            ?>
                                            <h4 class="c-compare-sizes-product__list-title">Room Sizes</h4>
                                            <ul class="c-compare-sizes-product__list">
                                                <li>
                                                    <span class="c-compare-sizes-product__list--mobile-info">High/New Insulation</span>
                                                    <?php echo $area; ?>m2
                                                </li>
                                                <li>
                                                    <span class="c-compare-sizes-product__list--mobile-info">Low/Old Insulation</span>
                                                    <?php if (!empty($low_area)) : ?>
                                                        <?php echo $low_area; ?>m2
                                                    <?php endif; ?>
                                                </li>
                                            </ul>

                                        <?php endif; ?>
                                    </div>

                                    <div class="c-compare-sizes-product__dimensions">
                                        <h4 class="c-compare-sizes-product__list-title">Dimensions</h4>
                                        <ul class="c-compare-sizes-product__list">
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Width</span>
                                                <?php echo $var_product['dimensions']['length']; ?>mm
                                            </li>
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Height</span>
                                                <?php echo $var_product['dimensions']['height']; ?>mm
                                            </li>
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Depth</span>
                                                <?php echo $var_product['dimensions']['width']; ?>mm
                                            </li>
                                            <li>
                                                <span class="c-compare-sizes-product__list--mobile-info">Weight</span>
                                                <?php echo $var_product['weight_html']; ?>
                                            </li>
                                        </ul>
                                    </div>


                                </div>

                            <?php endif; ?>


                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    <?php endif;
    }

    public function sizes_tower()
    {

        $current_product_id = get_edit_id_page();
        $product = new \WC_Product_Variable($current_product_id);
        $variations = $product->get_available_variations();
        $control_terms = get_the_terms($product->get_id(), 'pa_control-type');
        ?>

        <?php if ($product->is_type('variable')) : ?>

        <div class="c-compare-sizes towel-rails JS--compare-sizes-slider swiper-custom">
            <div class="c-compare-sizes__slider  swiper-wrapper ">
                <?php foreach ($variations as $var_product) :
                    $variation_id = $var_product['variation_id'];
                    ?>
                    <div class="c-compare-sizes__slide swiper-slide">
                        <div class="c-compare-sizes-product JS--compare-size-product">

                            <div class="c-compare-sizes-product__wrap JS--compare-item is-visible">
                                <div class="c-compare-sizes-product__thumb">
                                    <a data-fancybox="gallery" href="<?php echo $var_product['image']['full_src']; ?>">
                                        <img
                                                src="<?php echo $var_product["image"]["thumb_src"]; ?>"
                                                title="<?php echo $var_product['image']['title']; ?>"
                                                caption="<?php echo $var_product['image']['caption']; ?>"
                                                srcset="<?php echo $var_product["image"]["srcset"]; ?>"
                                                alt="<?php echo $var_product["image"]["alt"]; ?>">
                                    </a>
                                </div>
                                <div class="c-compare-sizes-product__wattage">
                                    <?php echo $var_product["attributes"]["attribute_pa_wattage"]; ?>W
                                </div>
                                <?php if ($control_terms) :
                                    $product_control_type = get_term_by('slug', $var_product["attributes"]["attribute_pa_control-type"], 'pa_control-type');
                                    ?>
                                    <h4 class="c-compare-sizes-product__colors-label">
                                        <span>Type:</span> <?php echo $product_control_type->name; ?></h4>
                                <?php endif; ?>

                                <div class="c-compare-sizes-form">
                                    <form method="post" action="<?php echo wc_get_cart_url(); ?>"
                                          class="c-compare-sizes-form__form">
                                        <div class="c-compare-sizes-form__row">
                                            <div class="c-compare-sizes-form__column">
                                                <div class="c-compare-sizes-form__price">
                                                    <?php echo $var_product["price_html"]; ?>
                                                </div>
                                            </div>
                                            <div class="c-compare-sizes-form__column">
                                                <div class="cvy_quantity cvy_property_quantity">
                                                    <?php if ($var_product['is_in_stock']): ?>
                                                        <span class="cvy_minus_trigger cvy_input_trigger">&ndash;</span>

                                                        <input type="text"
                                                               name="variations[<?php echo $variation_id; ?>][quantity]"
                                                               readonly="readonly" value="1" data-min="1"
                                                               data-max="<?php echo $var_product['max_qty']; ?>"
                                                               data-step="1">

                                                        <span class="cvy_plus_trigger cvy_input_trigger">+</span>
                                                    <?php else: ?>
                                                        <?php echo $var_product['availability_html']; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </div>

                                        <input type="hidden" name="product_id"
                                               value="<?php echo $product->get_id(); ?>">
                                        <?php foreach ($var_product['attributes'] as $key => $value) : ?>
                                            <input type="hidden"
                                                   name="variations[<?php echo $variation_id; ?>][attributes][<?php echo $key; ?>]"
                                                   value="<?php echo $value; ?>">
                                        <?php endforeach; ?>
                                        <?php if ($var_product['backorders_allowed']) : ?>
                                            <?php echo $var_product['availability_html']; ?>
                                        <?php endif; ?>
                                        <button type="submit" name="cvy_radiator_variation_list_submit"
                                                class="c-compare-sizes-form__submit">
                                            <?php _e('Buy Now', 'bestelectric'); ?>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="c-compare-sizes-product__details JS--compare-item is-visible"
                                 data-compare="<?php echo $var_product['attributes']['attribute_pa_colour']?:''; ?>">
                                <br>

                                <div class="c-compare-sizes-product__dimensions">
                                    <h4 class="c-compare-sizes-product__list-title"><?php _e('Dimensions', 'bestelectric'); ?></h4>
                                    <ul class="c-compare-sizes-product__list">
                                        <li>
                                            <span class="c-compare-sizes-product__list--mobile-info"><?php _e('Width', 'bestelectric'); ?></span>
                                            <?php echo $var_product['dimensions']['length']; ?>mm
                                        </li>
                                        <li>
                                            <span class="c-compare-sizes-product__list--mobile-info"><?php _e('Height', 'bestelectric'); ?></span>
                                            <?php echo $var_product['dimensions']['height']; ?>mm
                                        </li>
                                        <li>
                                            <span class="c-compare-sizes-product__list--mobile-info"><?php _e('Depth', 'bestelectric'); ?></span>
                                            <?php echo $var_product['dimensions']['width']; ?>mm
                                        </li>
                                        <li>
                                            <span class="c-compare-sizes-product__list--mobile-info"><?php _e('Weight', 'bestelectric'); ?></span>
                                            <?php echo $var_product['weight_html']; ?>
                                        </li>
                                    </ul>
                                </div>


                            </div>


                            <?php //endforeach;
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    <?php endif;
    }

    public function render_plain_content()
    {
    }

}

global $widgets;

$widgets->register(new \Elementor\CustomWooCalcCompare());

