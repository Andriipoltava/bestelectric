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
                                                    <div class="trustpilot-container">
                                                        <div class="trustpilot-widget" data-locale="en-GB"
                                                             data-template-id="5406e65db0d04a09e042d5fc"
                                                             data-businessunit-id="59098a340000ff0005a1b405"
                                                             data-style-height="28px" data-style-width="100%"
                                                             data-theme="light" style="position: relative;">
                                                            <iframe frameborder="0" scrolling="no"
                                                                    title="Customer reviews powered by Trustpilot"
                                                                    src="https://widget.trustpilot.com/trustboxes/5406e65db0d04a09e042d5fc/index.html?templateId=5406e65db0d04a09e042d5fc&amp;businessunitId=59098a340000ff0005a1b405#locale=en-GB&amp;styleHeight=28px&amp;styleWidth=100%25&amp;theme=light"
                                                                    style="position: relative; height: 28px; width: 100%; border-style: none; display: block; overflow: hidden;"></iframe>
                                                        </div>
                                                    </div>
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

