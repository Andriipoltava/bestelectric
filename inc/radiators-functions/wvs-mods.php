<?php

//-------------------------------------------------------------------------------
// Modify Variation attribute type for Wattage
//-------------------------------------------------------------------------------
if (!function_exists('wvs_variation_attribute_options_args_filter')):
    function wvs_variation_attribute_options_args_filter($args)
    {

        $terms = get_terms("pa_wattage");

        foreach ($terms as $term) {
            $args['assigned'][$term->slug]['type'] = 'default';
            $args['assigned'][$term->slug]['image_id'] = true;
        }

        return $args;
    }
    // add_filter( 'wvs_variation_attribute_options_args', 'wvs_variation_attribute_options_args_filter' );
endif;

//-------------------------------------------------------------------------------
// Modify Variation item content for Wattage
//-------------------------------------------------------------------------------
if (!function_exists('wvs_variable_default_item_content_filter')):
    function wvs_variable_default_item_content_filter($content, $term, $args, $saved_attribute)
    {

        //return json_encode($args) . json_encode($saved_attribute);
        return $args['product']->get_id();
    }
    // add_filter( 'wvs_variable_default_item_content', 'wvs_variable_default_item_content_filter', 10, 4 );
endif;

//-------------------------------------------------------------------------------
// Modify Variation variable item
//-------------------------------------------------------------------------------


if (!function_exists('wvs_default_variable_item_filter')):
    function wvs_default_variable_item_filter($data, $type, $options, $args, $saved_attribute)
    {

        $product = $args['product'];
        $attribute = $args['attribute'];
        $assigned = $args['assigned'];
        $product_tooltip = get_field('product_tooltip_content', 'option');
        $is_archive = (isset($args['is_archive']) && $args['is_archive']);
        $show_archive_tooltip = (bool)woo_variation_swatches()->get_option('show_tooltip_on_archive');

        if (!empty($options)) {
            if ($product && taxonomy_exists($attribute) && !$product->get_attribute('pa_control-type')) {


                if ($attribute == "pa_wattage") {

                    $data = '';

                    $variations = $product->get_available_variations();

                    foreach ($variations as $key => $variation) {

                        $variation_id = $variation['variation_id'];

                        $js_attrs_string = '';

                        foreach ($variation['attributes'] as $key => $value) {
                            $js_attrs_string .= 'data-' . $key . '="' . $value . '" ';
                        }


                        $selected_class = (sanitize_title($args['selected']) == $variation['attributes']['attribute_pa_wattage']) ? 'selected' : '';


                        $area = get_post_meta($variation_id, '_cvy_area', true);


                        if (isset($variation['attributes']["attribute_pa_el_type"])) {

                            $data .= sprintf('<li class="cvy_variation_list_item variable-item dropdown-variable-item dropdown-variable-item-%3$s %4$s no-match out-stock-%8$s" title="%5$s" data-value="%3$s" data-attribute_pa_colour="%6$s" data-attribute_pa_el_type="%7$s"  role="button" tabindex="0">', '', '', $variation['attributes']['attribute_pa_wattage'], esc_attr($selected_class), $variation['attributes']['attribute_pa_wattage'], $variation['attributes']['attribute_pa_colour'], $variation['attributes']["attribute_pa_el_type"], (!$variation["is_in_stock"]) ? 'yes' : 'no');

                        } else if (isset($variation['attributes']["attribute_pa_control-type"])) {

                            $data .= sprintf('<li class="cvy_variation_list_item variable-item dropdown-variable-item dropdown-variable-item-%3$s %4$s no-match out-stock-%8$s" title="%5$s" data-value="%3$s" data-attribute_pa_size="%6$s" data-attribute_pa_el_type="%7$s"  role="button" tabindex="0">', '', '', $variation['attributes']['attribute_pa_wattage'], esc_attr($selected_class), $variation['attributes']['attribute_pa_wattage'], $variation['attributes']['attribute_pa_size'], $variation['attributes']["attribute_pa_control-type"], (!$variation["is_in_stock"]) ? 'yes' : 'no');

                        } else {

                            $data .= sprintf('<li class="cvy_variation_list_item variable-item dropdown-variable-item dropdown-variable-item-%3$s %4$s no-match out-stock-%7$s" title="%5$s" data-value="%3$s" data-attribute_pa_colour="%6$s"  role="button" tabindex="0">', '', '', $variation['attributes']['attribute_pa_wattage'], esc_attr($selected_class), $variation['attributes']['attribute_pa_wattage'], $variation['attributes']['attribute_pa_colour'], (!$variation["is_in_stock"]) ? 'yes' : 'no');

                        }

                        $data .= '<div class="cvy_image_groups">
						 		<img class="cvy_product_thumbnail"
						 			src="' . $variation['image']['thumb_src'] . '"
						 			title="' . $variation['image']['title'] . '"
						 			caption="' . $variation['image']['caption'] . '"
						 			alt="' . $variation['image']['alt'] . '"
						 			srcset="' . $variation['image']['srcset'] . '"
						 		/><a class="cvy_image_groups__zoom JS-cvy_image_groups"  href="' . $variation['image']['full_src'] . '"></a></div>
						 	';
                        $data .= '<div class="cvy_field_groups">';
                        $data .= '<div class="cvy_property_field">';
                        $data .= '<span class="cvy_wattage">' . $variation['attributes']['attribute_pa_wattage'] . 'w</span>';
                        $data .= '</div>';

                        $data .= '<div class="variation-dropdown-price">' . get_woocommerce_currency_symbol() . $variation["display_price"] . '</div>';


                        ?>
                        <?php
                        $area = get_post_meta($variation_id, '_cvy_area', true);
                        $low_area = get_post_meta($variation_id, '_cvy_area_low', true);


                        if (!empty($area)) {

                            $data .= '<div class="cvy_property_field_wrapper cvy_property_area">
										<div class="cvy_property_field"><span class="cvy_area">
												' . $area . 'm<sup>2</sup>
											</span>
										</div><div class="cvy_tip">
								<a href="javascript:void(0);" class="cvy_insulation_info" title="Room Size">i</a><div class="cvy_tip_content">
								' . $product_tooltip . '
								</div></div>';

                            $data .= '</div>';
                        }

                        $data .= '<div class="cvy_property_field cvy_dimensions">
									<span>
										' .
                            $variation['dimensions']['length'] . 'mm x ' .
                            $variation['dimensions']['height'] . 'mm  x ' .
                            $variation['dimensions']['width'] . 'mm' . '
									</span>
									</div>';
                        $data .= '</div>';
                        $data .= '<div class="variation-dropdown-specification"><span>Specification</span></div>';
                        $data .= '<div class="variation-dropdown-specification__bottom">';
                        ob_start();
                        if (!empty($area)) :
                            ?>
                            <h4 class="variation-dropdown-specification__bottom-title">Room Sizes</h4>
                            <div class="variation-dropdown-specification__bottom__list">
                                <div>
                                    <span class="variation-dropdown-specification__bottom__list--info">High/New Insulation</span>
                                    <span>
                                           <?php echo $area; ?>m2
                                        <div class="cvy_tip">
								<a href="javascript:void(0);" class="cvy_insulation_info" title="High/New">i</a>
                                            <div class="cvy_tip_content">
							<?php echo $product_tooltip?>
								</div>
                                        </div>
                                    </span>

                                </div>
                                <div>
                                    <span class="variation-dropdown-specification__bottom__list--info">Low/Old Insulation</span>
                                    <?php if (!empty($low_area)) : ?>

                                        <span>
                                              <?php echo $low_area; ?>m2
                                        <div class="cvy_tip">
								<a href="javascript:void(0);" class="cvy_insulation_info" title="Low/Old">i</a>
                                                <div class="cvy_tip_content">
                                                <?php echo $product_tooltip?>
                                            </div>
                                        </div>
                                    </span>

                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php endif; ?>
                        <h4 class="variation-dropdown-specification__bottom-title">Dimensions</h4>

                        <div class="variation-dropdown-specification__bottom__list">
                            <div>
                                <span class="variation-dropdown-specification__bottom__list--info">Width</span>
                                <?php echo $variation['dimensions']['length']; ?>mm
                            </div>
                            <div>
                                <span class="variation-dropdown-specification__bottom__list--info">Height</span>
                                <?php echo $variation['dimensions']['height']; ?>mm
                            </div>
                            <div>
                                <span class="variation-dropdown-specification__bottom__list--info">Depth</span>
                                <?php echo $variation['dimensions']['width']; ?>mm
                            </div>
                            <div>
                                <span class="variation-dropdown-specification__bottom__list--info">Weight</span>
                                <?php echo $variation['weight_html']; ?>
                            </div>
                        </div>
                        <?php
                        $data .= ob_get_clean();
                        $data .= '</div>';


                        $data .= '</li>';
                    }

                }
            }
        }

        return $data;
    }

    add_filter('wvs_default_variable_item', 'wvs_default_variable_item_filter', 10, 5);
endif;

