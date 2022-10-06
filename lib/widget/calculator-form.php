<?php

namespace Elementor;

class CustomCalcForm extends Widget_Base
{

    public function get_style_depends()
    {
        return ['ber-css-calculator', 'ber-bootstrap', 'ber-icon'];
    }


    public function get_script_depends()
    {
        return ['ber-js-calc-scripts'];
    }

    public function get_name()
    {
        return "custom-calculator-form";
    }

    public function get_title()
    {
        return "Woo Calculator Form";
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
        $id = get_the_ID();

        global $product;

        // If the product object is not defined, we get it from the product ID
        if (!is_a($product, 'WC_Product') && get_post_type($id) === 'product') {
            $product = wc_get_product($id);
        }

        $pageType = get_post($id)->post_type == 'product';
        $pageID = $id;
        ?>

        <div id="cvy_radiator_variation_list_wrapper">

            <div class="o-popup__calculator ">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div id="cvy_radiator_variation_list_wrapper">
                                <div id="grouped-calculator">

                                    <form id="radiator_calculator_form">
                                        <ul id="cvy_calculator_rows">
                                            <li class="form-row type-row">
                                                <label><?php _e('Room Type', 'bestelectric'); ?></label>

                                                <div class="inputs">
                                                    <div class="inputs-row cvy_1_field">
                                                        <div class="input">
                                                            <div class="c-radio-grid">
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               checked="checked"
                                                                               value="general_living_space"
                                                                               class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon  icon-general-living-space"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('General Living Space', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="hallway" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-hallway"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Hallway', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="livingroom"
                                                                               class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-living-room"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Living Room', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="bathroom" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-toilet-bathroom"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Bathroom /Toilet', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="conservatory"
                                                                               class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-conservatory"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Conservatory', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="kitchen" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-kitchen"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Kitchen', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="bedroom" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-bedroom"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Bedroom', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="garden_office"
                                                                               class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-garden-office"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Garden Office', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="attic" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-attic-room"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"><?php _e('Attic room', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="dinning" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-dining-room"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"> <?php _e('Dining Room', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="room_type"
                                                                               value="porch" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon icon-porch"></span>
                                                                            <span class="c-radio__title c-radio__title--lower"> <?php _e('Porch', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>


                                            <li class="form-row">
                                                <label>Room Size</label>

                                                <div class="inputs">
                                                    <div class="inputs-row">
                                                        <div class="input units">
                                                            <label>Units</label>
                                                            <div class="c-checkbox">
                                                                <input type="checkbox" name="units" value="1"
                                                                       class="c-checkbox__input">
                                                                <div class="c-checkbox__knobs">
                                                                    <span><?php _e('Metres', 'bestelectric'); ?></span>
                                                                    <span><?php _e('Feet', 'bestelectric'); ?></span>
                                                                </div>
                                                                <div class="c-checkbox__layer"></div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                            </li>

                                            <li class="form-row">
                                                <label class="empty-label"></label>
                                                <div class="inputs">
                                                    <div class="inputs-row">
                                                        <div class="area_formula">

                                                            <div class="input width">
                                                                <label>Width</label>
                                                                <div class="input--actions">
                                                                    <div class="decrease">&ndash;</div>
                                                                    <input type="number" name="width" placeholder="0"
                                                                           step="0.01"
                                                                           min="0.01"/>
                                                                    <div class="increase">+</div>
                                                                </div>
                                                            </div>
                                                            <div class="input height">
                                                                <label>Length</label>
                                                                <div class="input--actions">
                                                                    <div class="decrease">&ndash;</div>
                                                                    <input type="number" name="height" placeholder="0"
                                                                           step="0.01"
                                                                           min="0.01"/>
                                                                    <div class="increase">+</div>
                                                                </div>
                                                            </div>
                                                            <div class="input area">

                                                                <label>Area</label>
                                                                <div class="input-area__block JS--input-area">
                                                                    <div class="input-area__holder">
                                                                        <input type="number" id="input-area"
                                                                               class="validate-area validate-area--disabled required-entry"
                                                                               name="area" min="0.01" placeholder="0"
                                                                               step="0.01"
                                                                               required="true"/>
                                                                        <span>m<sup>2</sup></span>
                                                                    </div>
                                                                    <a href="javascript:void(0);"
                                                                       class="input-area__manual JS--input-area-manual">
                                                                        <?php _e('Add Area Manually', 'bestelectric'); ?></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="form-row height-row">
                                                <label class="empty-label"></label>
                                                <div class="inputs">
                                                    <div class="inputs-row cvy_1_fields">

                                                        <div class="input">
                                                            <label class="height-label"> <?php _e('Height', 'bestelectric'); ?></label>

                                                            <div class="c-radio-grid">

                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="height_2"
                                                                               value="h1" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon c-radio__icon--small icon-height-low"></span>
                                                                            <span class="c-radio__title"> <?php _e('Low', 'bestelectric'); ?></span>
                                                                            <span class="c-radio__desc"> <?php _e('Up to 2.4m', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="height_2"
                                                                               checked="checked"
                                                                               value="h2" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon c-radio__icon--small icon-height-standard"></span>
                                                                            <span class="c-radio__title"> <?php _e('Standard', 'bestelectric'); ?></span>
                                                                            <span class="c-radio__desc"> <?php _e('2.4m - 2.64m', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="height_2"
                                                                               value="h3" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon c-radio__icon--small icon-height-high"></span>
                                                                            <span class="c-radio__title"> <?php _e('High', 'bestelectric'); ?></span>
                                                                            <span class="c-radio__desc"> <?php _e('2.65m - 2.88m', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="height_2"
                                                                               value="h4" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--icon">
                                                                            <span class="c-radio__icon c-radio__icon--small icon-height-extra-high"></span>
                                                                            <span class="c-radio__title"> <?php _e('Extra High', 'bestelectric'); ?></span>
                                                                            <span class="c-radio__desc"><?php _e('2.89m - 3.12m ', 'bestelectric'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>
                                            </li>


                                            <li class="form-row features">
                                                <label> <?php _e('Room Features', 'bestelectric'); ?></label>
                                                <div class="inputs">
                                                    <div class="inputs-row cvy_1_fields">


                                                        <div class="input">
                                                            <label> <?php _e('Num. external walls', 'bestelectric'); ?></label>

                                                            <div class="c-radio-grid">
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="ext_walls"
                                                                               value="1" class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--number">
                                                                            <span>1</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="ext_walls" value="2"
                                                                               checked="checked"
                                                                               class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--number">
                                                                            <span>2</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="ext_walls" value="3"
                                                                               class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--number">
                                                                            <span>3</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="c-radio-grid__item">
                                                                    <div class="c-radio">
                                                                        <input type="radio" name="ext_walls" value="4"
                                                                               class="c-radio__input">
                                                                        <div class="c-radio__knobs c-radio__knobs--number">
                                                                            <span>4+</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="form-row">
                                                <label class="empty-label"></label>
                                                <div class="inputs">
                                                    <div class="inputs-row cvy_2_fields">
                                                        <div class="input">
                                                            <label><?php _e('Has Stairs?', 'bestelectric'); ?></label>
                                                            <div class="c-checkbox">
                                                                <input type="checkbox" name="has_stairs" value="1"
                                                                       class="c-checkbox__input">
                                                                <div class="c-checkbox__knobs">
                                                                    <span><?php _e('No', 'bestelectric'); ?></span>
                                                                    <span><?php _e('Yes', 'bestelectric'); ?></span>
                                                                </div>
                                                                <div class="c-checkbox__layer"></div>
                                                            </div>

                                                        </div>

                                                        <div class="input">
                                                            <label><?php _e('North Facing?', 'bestelectric'); ?></label>
                                                            <div class="c-checkbox">
                                                                <input type="checkbox" name="north_facing" value="1"
                                                                       class="c-checkbox__input">
                                                                <div class="c-checkbox__knobs">
                                                                    <span><?php _e('No', 'bestelectric'); ?></span>
                                                                    <span><?php _e('Yes', 'bestelectric'); ?></span>
                                                                </div>
                                                                <div class="c-checkbox__layer"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="form-row insulation">
                                                <label><?php _e('Insulation', 'bestelectric'); ?>
                                                    <div class="cvy_tip">
                                                        <a href="javascript:void(0);" class="cvy_insulation_info"
                                                           title="Room Size">i</a>
                                                        <div class="cvy_tip_content">
                                                            <h4><?php _e('Insulation', 'bestelectric'); ?></h4>
                                                            <p>
                                                                <?php _e('Examples of low insulation include single glazed windows or poor roof insulation, typically found in properties built more than 30 years ago.', 'bestelectric'); ?>
                                                            </p>
                                                            <p>
                                                                <?php _e(' High insulation is generally double glazed windows, good insulation fitted, or a property built within the last 30 years.', 'bestelectric'); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </label>
                                                <div class="inputs">
                                                    <div class="inputs-row cvy_1_field">
                                                        <div class="c-checkbox">
                                                            <input type="checkbox" checked="checked" name="insulation"
                                                                   value="1"
                                                                   class="c-checkbox__input">
                                                            <div class="c-checkbox__knobs">
                                                                <span><?php _e('Low', 'bestelectric'); ?></span>
                                                                <span><?php _e('High', 'bestelectric'); ?></span>
                                                            </div>
                                                            <div class="c-checkbox__layer"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>

                                            <li class="form-row form-row--block">
                                                <div class="inputs submit-input">
                                                    <button type="submit"
                                                            class="cvy_button-calc"><?php _e('Calculate', 'bestelectric'); ?></button>

                                                    <a href="javascript:void(0);" class="reset_calculator">
                                                        <i class="fas fa-redo"></i>
                                                        <?php _e('Reset Calculator', 'bestelectric'); ?>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="cvy_best_matches_message ">

                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.jpg"
                                                 alt="Best Electric Radiators">

                                            <div class="cvy_message_content">
                                                <?php _e('To heat your', 'bestelectric'); ?>
                                                <span class="cvy_highlighted_text">
					<span class="cvy_room_area"></span><span class="cvy_room_area_units"></span>2 <span
                                                            class="cvy_room_type"></span>,</span>
                                                <?php _e('you need a minimum wattage of', 'bestelectric'); ?>
                                                <span class="cvy_highlighted_text">
					<span class="cvy_wattage_total"></span>w.
				</span>
                                                <?php if ($pageType) : ?>
                                                    <br> <?php _e('We recommend', 'bestelectric'); ?>
                                                    <span class="cvy_highlighted_text">
					<span class="cvy_quantity"></span> x <span class="cvy_wattage_option"></span><?php _e('w radiator', 'bestelectric'); ?></span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <?php if ($pageType) : ?>
                                    <div class="o-popup__calculator-products JS--calculator-results">
                                        <?php $product = wc_get_product($pageID);

                                        if (!$product->is_type('variable'))
                                            return;

                                        $variations = $product->get_available_variations();

                                        $product_tooltip = get_field('product_tooltip_content', 'option');
                                        // var_dump($variations);
                                        // wc_get_cart_url();
                                        //esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) )
                                        ?>

                                        <form method="post"
                                              action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                                              class="cvy_add_to_basket_form">
                                            <div class="cvy_radiator_variation_list_header">
                                                <div class="cvy_filter">
                                                    <div class="cvy_filter_title">
                                                        <i class="fa fas fa-filter"></i>

                                                        FILTER BY:
                                                    </div>

                                                    <div class="cvy_filter_fields">
                                                        <?php $variation_attrs = wp_list_pluck($variations, 'attributes');
                                                        $filter_attrs = [];

                                                        foreach ($variation_attrs as $single_variation_attrs) {
                                                            foreach ($single_variation_attrs as $key => $value) {
                                                                if (empty($value))
                                                                    continue;
                                                                else if (empty($filter_attrs[$key]))
                                                                    $filter_attrs[$key] = [$value];
                                                                else if (!in_array($value, $filter_attrs[$key]))
                                                                    $filter_attrs[$key][] = $value;
                                                            }
                                                        }

                                                        $i = 0;

                                                        foreach ($filter_attrs as $attr_key => $values) {
                                                            $tax_name = str_replace('attribute_', '', $attr_key);
                                                            $taxonomy = get_taxonomy($tax_name); ?>

                                                            <div class="cvy_filter_field <?php echo $i > 0 ? 'cvy_hidden' : ''; ?>">
                                                                <div class="cvy_field_title">
                                                                    <?php echo $taxonomy->labels->singular_name; ?>:
                                                                </div>

                                                                <div class="cvy_options_field"
                                                                     data-key="<?php echo $attr_key; ?>">
                                                                    <div class="cvy_filter_option cvy_active"
                                                                         data-value="all">All
                                                                    </div>

                                                                    <?php foreach ($values as $attr_slug) {
                                                                        $term = get_term_by('slug', $attr_slug, $tax_name); ?>

                                                                        <div class="cvy_filter_option"
                                                                             data-value="<?php echo $attr_slug; ?>">
                                                                            <?php echo $term->name; ?>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <?php $i++;
                                                        } ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <ul class="cvy_radiator_variation_list">
                                                <?php foreach ($variations as $key => $variation) {
                                                    $variation_id = $variation['variation_id'];

                                                    $js_attrs_string = '';

                                                    foreach ($variation['attributes'] as $key => $value)
                                                        $js_attrs_string .= 'data-' . $key . '="' . $value . '" ';

                                                    $area = get_post_meta($variation_id, '_cvy_area', true); ?>

                                                    <li class="cvy_variation_list_item" <?php echo $js_attrs_string; ?>>
                                                        <a data-fancybox="gallery"
                                                           href="<?php echo $variation['image']['full_src']; ?>">
                                                            <img
                                                                    class="cvy_product_thumbnail"
                                                                    src="<?php echo $variation['image']['thumb_src']; ?>"
                                                                    title="<?php echo $variation['image']['title']; ?>"
                                                                    caption="<?php echo $variation['image']['caption']; ?>"
                                                                    alt="<?php echo $variation['image']['alt']; ?>"
                                                                    srcset="<?php echo $variation['image']['srcset']; ?>"
                                                            >
                                                        </a>

                                                        <div class="cvy_field_groups">
                                                            <div class="cvy_property_field">
						<span class="cvy_type">
							<?php foreach ($variation['attributes'] as $attr_tax => $attr_slug) {
                                $attr_tax = str_replace('attribute_', '', $attr_tax);
                                $term = get_term_by('slug', $attr_slug, $attr_tax);

                                echo $term->name;

                                break;
                            } ?>
						</span>

                                                                <span class="cvy_wattage">
							<?php echo $variation['attributes']['attribute_pa_wattage']; ?>W
						</span>
                                                            </div>

                                                            <?php if (!empty($area)) { ?>
                                                                <div class="cvy_property_field_wrapper cvy_property_area">
                                                                    <div class="cvy_property_field">
								<span class="cvy_area_label">
									UP TO
								</span>

                                                                        <span class="cvy_area">
									<?php echo $area; ?>m2
								</span>
                                                                    </div>
                                                                    <?php if ($product_tooltip) : ?>
                                                                        <div class="cvy_tip">
                                                                            <a href="javascript:void(0);"
                                                                               class="cvy_insulation_info"
                                                                               title="Room Size">i</a>

                                                                            <div class="cvy_tip_content">
                                                                                <?php echo $product_tooltip; ?>
                                                                            </div>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php } ?>

                                                            <div class="cvy_property_field cvy_dimensions">
						<span>
							<?php echo
                                'W: ' . $variation['dimensions']['length'] . 'mm x ' .
                                'H: ' . $variation['dimensions']['height'] . 'mm  x ' .
                                'D: ' . $variation['dimensions']['width'] . 'mm'; ?>
						</span>

                                                                <span>
							<?php echo $variation['weight_html']; ?>
						</span>
                                                            </div>

                                                            <div class="cvy_price">
                                                                <?php echo $variation['price_html']; ?>
                                                                <?php if ($variation['backorders_allowed']) : ?>
                                                                    <?php echo $variation['availability_html']; ?>
                                                                <?php endif; ?>
                                                            </div>

                                                            <div class="cvy_quantity cvy_property_quantity">
                                                                <?php if ($variation['is_in_stock']): ?>
                                                                    <span class="cvy_minus_trigger cvy_input_trigger">-</span>

                                                                    <input type="text"
                                                                           name="variations[<?php echo $variation_id; ?>][quantity]"
                                                                           readonly="readonly" value="0" data-min="0"
                                                                           data-max="<?php echo $variation['max_qty']; ?>"
                                                                           data-step="1">

                                                                    <span class="cvy_plus_trigger cvy_input_trigger">+</span>
                                                                <?php else: ?>
                                                                    <?php echo $variation['availability_html']; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="product_id"
                                                               value="<?php echo $product->get_id(); ?>">
                                                        <?php foreach ($variation['attributes'] as $key => $value) { ?>
                                                            <input type="hidden"
                                                                   name="variations[<?php echo $variation_id; ?>][attributes][<?php echo $key; ?>]"
                                                                   value="<?php echo $value; ?>">
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>
                                            </ul>

                                            <div class="cvy_radiator_variation_list_footer">
                                                <div class="cvy_show_all_wrapper">
                                                    <span class="cvy_show_all">SHOW ALL RADIATORS</span>
                                                </div>
                                                <div class="cvy_radiator_variation_list_footer_actions">
                                                    <a href="https://uk.trustpilot.com/review/www.bestelectricradiators.co.uk"
                                                       target="_blank" id='trstModal'>
                                                        <svg id="trLogo" xmlns="http://www.w3.org/2000/svg"
                                                             aria-labelledby="trustpilotLogo"
                                                             viewBox="0 0 126 31"><title
                                                                    id="trustpilotLogo">Trustpilot</title>
                                                            <path class="tp-logo__text"
                                                                  d="M33.074774 11.07005H45.81806v2.364196h-5.010656v13.290316h-2.755306V13.434246h-4.988435V11.07005h.01111zm12.198892 4.319629h2.355341v2.187433h.04444c.077771-.309334.222203-.60762.433295-.894859.211092-.287239.466624-.56343.766597-.79543.299972-.243048.633276-.430858.999909-.585525.366633-.14362.744377-.220953 1.12212-.220953.288863 0 .499955.011047.611056.022095.1111.011048.222202.033143.344413.04419v2.408387c-.177762-.033143-.355523-.055238-.544395-.077333-.188872-.022096-.366633-.033143-.544395-.033143-.422184 0-.822148.08838-1.199891.254096-.377744.165714-.699936.41981-.977689.740192-.277753.331429-.499955.729144-.666606 1.21524-.166652.486097-.244422 1.03848-.244422 1.668195v5.39125h-2.510883V15.38968h.01111zm18.220567 11.334883H61.02779v-1.579813h-.04444c-.311083.574477-.766597 1.02743-1.377653 1.369908-.611055.342477-1.233221.51924-1.866497.51924-1.499864 0-2.588654-.364573-3.25526-1.104765-.666606-.740193-.999909-1.856005-.999909-3.347437V15.38968h2.510883v6.948968c0 .994288.188872 1.701337.577725 2.1101.377744.408763.922139.618668 1.610965.618668.533285 0 .96658-.077333 1.322102-.243048.355524-.165714.644386-.37562.855478-.65181.222202-.265144.377744-.596574.477735-.972194.09999-.37562.144431-.784382.144431-1.226288v-6.573349h2.510883v11.323836zm4.27739-3.634675c.07777.729144.355522 1.237336.833257 1.535623.488844.287238 1.06657.441905 1.744286.441905.233312 0 .499954-.022095.799927-.055238.299973-.033143.588836-.110476.844368-.209905.266642-.099429.477734-.254096.655496-.452954.166652-.198857.244422-.452953.233312-.773335-.01111-.320381-.133321-.585525-.355523-.784382-.222202-.209906-.499955-.364573-.844368-.497144-.344413-.121525-.733267-.232-1.17767-.320382-.444405-.088381-.888809-.18781-1.344323-.287239-.466624-.099429-.922138-.232-1.355432-.37562-.433294-.14362-.822148-.342477-1.166561-.596573-.344413-.243048-.622166-.56343-.822148-.950097-.211092-.386668-.311083-.861716-.311083-1.436194 0-.618668.155542-1.12686.455515-1.54667.299972-.41981.688826-.75124 1.14434-1.005336.466624-.254095.97769-.430858 1.544304-.541334.566615-.099429 1.11101-.154667 1.622075-.154667.588836 0 1.15545.066286 1.688736.18781.533285.121524 1.02213.320381 1.455423.60762.433294.276191.788817.640764 1.07768 1.08267.288863.441905.466624.98324.544395 1.612955h-2.621984c-.122211-.596572-.388854-1.005335-.822148-1.204193-.433294-.209905-.933248-.309334-1.488753-.309334-.177762 0-.388854.011048-.633276.04419-.244422.033144-.466624.088382-.688826.165715-.211092.077334-.388854.198858-.544395.353525-.144432.154667-.222203.353525-.222203.60762 0 .309335.111101.552383.322193.740193.211092.18781.488845.342477.833258.475048.344413.121524.733267.232 1.177671.320382.444404.088381.899918.18781 1.366542.287239.455515.099429.899919.232 1.344323.37562.444404.14362.833257.342477 1.17767.596573.344414.254095.622166.56343.833258.93905.211092.37562.322193.850668.322193 1.40305 0 .673906-.155541 1.237336-.466624 1.712385-.311083.464001-.711047.850669-1.199891 1.137907-.488845.28724-1.04435.508192-1.644295.640764-.599946.132572-1.199891.198857-1.788727.198857-.722156 0-1.388762-.077333-1.999818-.243048-.611056-.165714-1.14434-.408763-1.588745-.729144-.444404-.33143-.799927-.740192-1.05546-1.226289-.255532-.486096-.388853-1.071621-.411073-1.745528h2.533103v-.022095zm8.288135-7.700208h1.899828v-3.402675h2.510883v3.402675h2.26646v1.867052h-2.26646v6.054109c0 .265143.01111.486096.03333.684954.02222.18781.07777.353524.155542.486096.07777.132572.199981.232.366633.298287.166651.066285.377743.099428.666606.099428.177762 0 .355523 0 .533285-.011047.177762-.011048.355523-.033143.533285-.077334v1.933338c-.277753.033143-.555505.055238-.811038.088381-.266642.033143-.533285.04419-.811037.04419-.666606 0-1.199891-.066285-1.599855-.18781-.399963-.121523-.722156-.309333-.944358-.552381-.233313-.243049-.377744-.541335-.466625-.905907-.07777-.364573-.13332-.784383-.144431-1.248384v-6.683825h-1.899827v-1.889147h-.02222zm8.454788 0h2.377562V16.9253h.04444c.355523-.662858.844368-1.12686 1.477644-1.414098.633276-.287239 1.310992-.430858 2.055369-.430858.899918 0 1.677625.154667 2.344231.475048.666606.309335 1.222111.740193 1.666515 1.292575.444405.552382.766597 1.193145.9888 1.92229.222202.729145.333303 1.513527.333303 2.3421 0 .762288-.099991 1.50248-.299973 2.20953-.199982.718096-.499955 1.347812-.899918 1.900194-.399964.552383-.911029.98324-1.533194 1.31467-.622166.33143-1.344323.497144-2.18869.497144-.366634 0-.733267-.033143-1.0999-.099429-.366634-.066286-.722157-.176762-1.05546-.320381-.333303-.14362-.655496-.33143-.933249-.56343-.288863-.232-.522175-.497144-.722157-.79543h-.04444v5.656393h-2.510883V15.38968zm8.77698 5.67849c0-.508193-.06666-1.005337-.199981-1.491433-.133321-.486096-.333303-.905907-.599946-1.281527-.266642-.37562-.599945-.673906-.988799-.894859-.399963-.220953-.855478-.342477-1.366542-.342477-1.05546 0-1.855387.364572-2.388672 1.093717-.533285.729144-.799928 1.701337-.799928 2.916578 0 .574478.066661 1.104764.211092 1.59086.144432.486097.344414.905908.633276 1.259432.277753.353525.611056.629716.99991.828574.388853.209905.844367.309334 1.355432.309334.577725 0 1.05546-.121524 1.455423-.353525.399964-.232.722157-.541335.97769-.905907.255531-.37562.444403-.79543.555504-1.270479.099991-.475049.155542-.961145.155542-1.458289zm4.432931-9.99812h2.510883v2.364197h-2.510883V11.07005zm0 4.31963h2.510883v11.334883h-2.510883V15.389679zm4.755124-4.31963h2.510883v15.654513h-2.510883V11.07005zm10.210184 15.963847c-.911029 0-1.722066-.154667-2.433113-.452953-.711046-.298287-1.310992-.718097-1.810946-1.237337-.488845-.530287-.866588-1.160002-1.12212-1.889147-.255533-.729144-.388854-1.535622-.388854-2.408386 0-.861716.133321-1.657147.388853-2.386291.255533-.729145.633276-1.35886 1.12212-1.889148.488845-.530287 1.0999-.93905 1.810947-1.237336.711047-.298286 1.522084-.452953 2.433113-.452953.911028 0 1.722066.154667 2.433112.452953.711047.298287 1.310992.718097 1.810947 1.237336.488844.530287.866588 1.160003 1.12212 1.889148.255532.729144.388854 1.524575.388854 2.38629 0 .872765-.133322 1.679243-.388854 2.408387-.255532.729145-.633276 1.35886-1.12212 1.889147-.488845.530287-1.0999.93905-1.810947 1.237337-.711046.298286-1.522084.452953-2.433112.452953zm0-1.977528c.555505 0 1.04435-.121524 1.455423-.353525.411074-.232.744377-.541335 1.01102-.916954.266642-.37562.455513-.806478.588835-1.281527.12221-.475049.188872-.961145.188872-1.45829 0-.486096-.066661-.961144-.188872-1.44724-.122211-.486097-.322193-.905907-.588836-1.281527-.266642-.37562-.599945-.673907-1.011019-.905907-.411074-.232-.899918-.353525-1.455423-.353525-.555505 0-1.04435.121524-1.455424.353525-.411073.232-.744376.541334-1.011019.905907-.266642.37562-.455514.79543-.588835 1.281526-.122211.486097-.188872.961145-.188872 1.447242 0 .497144.06666.98324.188872 1.458289.12221.475049.322193.905907.588835 1.281527.266643.37562.599946.684954 1.01102.916954.411073.243048.899918.353525 1.455423.353525zm6.4883-9.66669h1.899827v-3.402674h2.510883v3.402675h2.26646v1.867052h-2.26646v6.054109c0 .265143.01111.486096.03333.684954.02222.18781.07777.353524.155541.486096.077771.132572.199982.232.366634.298287.166651.066285.377743.099428.666606.099428.177762 0 .355523 0 .533285-.011047.177762-.011048.355523-.033143.533285-.077334v1.933338c-.277753.033143-.555505.055238-.811038.088381-.266642.033143-.533285.04419-.811037.04419-.666606 0-1.199891-.066285-1.599855-.18781-.399963-.121523-.722156-.309333-.944358-.552381-.233313-.243049-.377744-.541335-.466625-.905907-.07777-.364573-.133321-.784383-.144431-1.248384v-6.683825h-1.899827v-1.889147h-.02222z"
                                                                  fill="#191919"/>
                                                            <path class="tp-logo__star" fill="#00B67A"
                                                                  d="M30.141707 11.07005H18.63164L15.076408.177071l-3.566342 10.892977L0 11.059002l9.321376 6.739063-3.566343 10.88193 9.321375-6.728016 9.310266 6.728016-3.555233-10.88193 9.310266-6.728016z"/>
                                                            <path class="tp-logo__star-notch" fill="#005128"
                                                                  d="M21.631369 20.26169l-.799928-2.463625-5.755033 4.153914z"/>
                                                        </svg>
                                                        <svg id="trStars" xmlns="http://www.w3.org/2000/svg"
                                                             aria-labelledby="starRating"
                                                             viewBox="0 0 251 46"><title
                                                                    id="starRating">4.8 out of five star rating on
                                                                Trustpilot</title>
                                                            <g class="tp-star">
                                                                <path class="tp-star__canvas" fill="#00b67a"
                                                                      d="M0 46.330002h46.375586V0H0z"/>
                                                                <path class="tp-star__shape"
                                                                      d="M39.533936 19.711433L13.230239 38.80065l3.838216-11.797827L7.02115 19.711433h12.418975l3.837417-11.798624 3.837418 11.798624h12.418975zM23.2785 31.510075l7.183595-1.509576 2.862114 8.800152L23.2785 31.510075z"
                                                                      fill="#FFF"/>
                                                            </g>
                                                            <g class="tp-star">
                                                                <path class="tp-star__canvas" fill="#00b67a"
                                                                      d="M51.24816 46.330002h46.375587V0H51.248161z"/>
                                                                <path class="tp-star__canvas--half" fill="#00b67a"
                                                                      d="M51.24816 46.330002h23.187793V0H51.248161z"/>
                                                                <path class="tp-star__shape"
                                                                      d="M74.990978 31.32991L81.150908 30 84 39l-9.660206-7.202786L64.30279 39l3.895636-11.840666L58 19.841466h12.605577L74.499595 8l3.895637 11.841466H91L74.990978 31.329909z"
                                                                      fill="#FFF"/>
                                                            </g>
                                                            <g class="tp-star">
                                                                <path class="tp-star__canvas" fill="#00b67a"
                                                                      d="M102.532209 46.330002h46.375586V0h-46.375586z"/>
                                                                <path class="tp-star__canvas--half" fill="#00b67a"
                                                                      d="M102.532209 46.330002h23.187793V0h-23.187793z"/>
                                                                <path class="tp-star__shape"
                                                                      d="M142.066994 19.711433L115.763298 38.80065l3.838215-11.797827-10.047304-7.291391h12.418975l3.837418-11.798624 3.837417 11.798624h12.418975zM125.81156 31.510075l7.183595-1.509576 2.862113 8.800152-10.045708-7.290576z"
                                                                      fill="#FFF"/>
                                                            </g>
                                                            <g class="tp-star">
                                                                <path class="tp-star__canvas" fill="#00b67a"
                                                                      d="M153.815458 46.330002h46.375586V0h-46.375586z"/>
                                                                <path class="tp-star__canvas--half" fill="#00b67a"
                                                                      d="M153.815458 46.330002h23.187793V0h-23.187793z"/>
                                                                <path class="tp-star__shape"
                                                                      d="M193.348355 19.711433L167.045457 38.80065l3.837417-11.797827-10.047303-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418974zM177.09292 31.510075l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z"
                                                                      fill="#FFF"/>
                                                            </g>
                                                            <g class="tp-star">
                                                                <path class="tp-star__canvas" fill="#00b67a"
                                                                      d="M205.064416 46.330002h46.375587V0h-46.375587z"/>
                                                                <path class="tp-star__canvas--half" fill="#00b67a"
                                                                      d="M205.064416 46.330002h23.187793V0h-23.187793z"/>
                                                                <path class="tp-star__shape"
                                                                      d="M244.597022 19.711433l-26.3029 19.089218 3.837419-11.797827-10.047304-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418975zm-16.255436 11.798642l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z"
                                                                      fill="#FFF"/>
                                                            </g>
                                                        </svg>

                                                        <p>
                                                            <?php echo get_field('trustpilot_modal_calculator', 'option')?:'Rated 4.8 out of 5 Based on <b>1000+ Reviews</b>'; ?>
                                                        </p>
                                                    </a>

                                                    <button type="submit" name="cvy_radiator_variation_list_submit"
                                                            class="cvy_button cvy_submit">
                                                        Add to basket
                                                    </button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
}

global $widgets;

$widgets->register(new \Elementor\CustomCalcForm());

