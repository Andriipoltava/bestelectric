/////////////////////////// PRODUCT VARTIATIONS LIST & CALCULATOR /////////////////////////////////


(function ($) {

    $(document).ready(function () {
        const CalcFrom = function ($scope, $) {


            $('body').on('click', '.cvy_input_trigger', function () {
                var input = $(this).parent().find('input'),
                    value = +$(input).val(),
                    step = +$(input).data('step'),
                    max = +$(input).data('max'),
                    min = +$(input).data('min');

                if ($(this).hasClass('cvy_minus_trigger'))
                    value -= step;
                else
                    value += step;

                if (value < min || (max && value >= max))
                    return;

                $(input).val(value);
            });

            //////////////////////////////////////////////////////


            $('body').on('click', '.reset_calculator, .close-calculator,.o-popup[data-popup="calc"] .JS--close-popup', function () {
                resetCalculator();
                resizable(document.getElementById('input-area'), inputAreaFactor);
                return false;
            });

            /*   $('#grouped-calculator .calculator-show, #grouped-calculator .close-calculator').on('click', function () {
                   //toggleCalculator();
               });*/


            $('body').on('change', '#grouped-calculator [name="units"]', function () {
                if ($(this).is(":checked")) {
                    $('#grouped-calculator .input.area .JS--input-area span').html('ft<sup>2</sup>');
                } else {
                    $('#grouped-calculator .input.area .JS--input-area span').html('m<sup>2</sup>');
                }
            });

            $('#grouped-calculator input, #grouped-calculator select').bind('change', function () {
                $('#super-product-table tr').show();
                $('#super-product-table tbody .qty').val(0);
            });


            $('body').on('click', '.JS--input-area-manual', function () {
                $(this).closest('.JS--input-area').find('input').removeClass('validate-area--disabled').focus();
            });


            var select = $('[name="insulation"]');


            $('body').on('keyup', '#grouped-calculator [name=\'area\']', function () {
                $('#grouped-calculator [name=\'height\'], #grouped-calculator [name=\'width\']').val('');
            });


            $('body').on('keyup', '#grouped-calculator [name=\'height\'],#grouped-calculator [name=\'width\']', function () {
                if (val('width') && val('height')) {
                    var y = val('width') * val('height');
                    $('#grouped-calculator [name=\'area\']').val(y);
                }
            });


            var inputAreaFactor = 11;
            if ($(window).width() < 768) {
                inputAreaFactor = 9;
            }

            if ($('#input-area').length !== 0) {
                resizable(document.getElementById('input-area'), inputAreaFactor);
            }


            $('body').on('focus', '#input-area', function () {
                $(this).parent().addClass('input-area__holder--focused');
            });


            $('body').on('focusout', '#input-area', function () {
                $(this).parent().removeClass('input-area__holder--focused');
            });

            $('body').on('click', '#grouped-calculator .increase', function () {
                var value = +$(this).parent().find('input').val();
                $(this).parent().find('input').val(value + 0.5);
                $(this).parent().find('input').trigger('keyup');
                resizable(document.getElementById('input-area'), inputAreaFactor);
            });


            $('body').on('click', '#grouped-calculator .decrease', function () {
                var value = +$(this).parent().find('input').val();
                if (value > 0) {
                    $(this).parent().find('input').val(value - 0.5);
                }
                $(this).parent().find('input').trigger('keyup');
                resizable(document.getElementById('input-area'), inputAreaFactor);
            });


            $('body').on('change', '#grouped-calculator [name="room_type"]', function () {
                $('#grouped-calculator [name="north_facing"]').closest('.input').show();
                $('#grouped-calculator [name="ext_walls"]').removeAttr('disabled');
                //$('#grouped-calculator [name="ext_walls"]').next().children().show();

                if ($(this).val() == 'conservatory' || $(this).val() == 'attic') {
                    $('#grouped-calculator [name="ext_walls"]').attr('disabled', 'disabled');
                    //$('#grouped-calculator [name="ext_walls"]').next().children().hide();
                    $('#grouped-calculator [name="north_facing"]').closest('.input').hide();
                }
            });


            $('body').on('click', '.cvy_radiator_variation_list_footer .cvy_show_all', function () {
                jQuery('.cvy_options_field[data-key="attribute_pa_wattage"] .cvy_filter_option[data-value="all"]').click();
                jQuery('.cvy_radiator_variation_list_footer .cvy_show_all_wrapper').removeClass('cvy_visible');
            });


            $('body').on('click', '.cvy_filter .cvy_filter_option', function () {
                $(this).closest('.cvy_options_field').find('.cvy_filter_option').removeClass('cvy_active');

                $(this).addClass('cvy_active');

                applyVariationListFilter();
            });

            function scrollToResults() {
                let addScroll=0;
                if ($('.elementor-location-popup').length) {
                    var scrollContainer = $('.dialog-lightbox-widget-content .dialog-message');
                    addScroll+=120
                } else {
                    var scrollContainer = $('html');
                    addScroll=-50
                }
                var element = $('#grouped-calculator .cvy_best_matches_message');

                scrollContainer.animate({
                    scrollTop: element.offset().top + addScroll,
                }, 300);

            }

            function scrollAfterReset() {
                var scrollContainer = $('.o-popup');
                var element = $('.o-popup__content');

                scrollContainer.animate({
                    scrollTop: $('.o-popup__content').offset().top - scrollContainer.offset().top + scrollContainer.scrollTop() - 30,
                }, 300);
            }


            function applyVariationListFilter() {
                var activeFilters = false;

                $('.cvy_variation_list_item').removeClass('cvy_filtered');

                $('.cvy_filter .cvy_options_field').each(function () {
                    var optionKey = $(this).data('key'),
                        filterOptionValue = $(this).find('.cvy_filter_option.cvy_active').data('value');

                    if (filterOptionValue !== 'all') {
                        $('.cvy_variation_list_item').each(function () {
                            var itemOptionValue = $(this).data(optionKey);

                            if (itemOptionValue && itemOptionValue !== filterOptionValue)
                                $(this).addClass('cvy_filtered');
                        });

                        activeFilters = true;
                    }
                });
            }

            function resetVariationListFilter() {
                $('.cvy_filter .cvy_filter_option[data-value="all"]').click();
            }

            function resetCalculator() {
                var calculator = jQuery('#grouped-calculator');

                var toggler = jQuery('.yn-toggler.on');
                if (toggler) {
                    toggler.trigger('click');
                }

                calculator.find('input[type="number"]').val('');

                calculator.find('[name="north_facing"]').closest('.input').show();

                var currentWallsVal = calculator.find('[name="ext_walls"]:checked').val();
                if (currentWallsVal !== 2) {
                    calculator.find('[name="ext_walls"]').prop('checked', false).prop('disabled', false);
                    calculator.find('[name="ext_walls"]').filter('[value="2"]').prop('checked', true);
                }

                var currentHeightVal = calculator.find('[name="height_2"]:checked').val();
                if (currentHeightVal !== 'h2') {
                    calculator.find('[name="height_2"]').prop('checked', false);
                    calculator.find('[name="height_2"]').filter('[value="h2"]').prop('checked', true);
                }

                var currentRoomTypeVal = calculator.find('[name="room_type"]:checked').val();
                if (currentRoomTypeVal !== 'general_living_space') {
                    calculator.find('[name="room_type"]').prop('checked', false);
                    calculator.find('[name="room_type"]').filter('[value="general_living_space"]').prop('checked', true);
                }

                //calculator.find('[name="insulation"]');
                if (calculator.find('[name="insulation"]:checked').length == 0) {
                    calculator.find('[name="insulation"]').prop('checked', true);
                }

                if (calculator.find('[name="has_stairs"]:checked').length !== 0) {
                    calculator.find('[name="has_stairs"]').prop('checked', false);
                }

                if (calculator.find('[name="north_facing"]:checked').length !== 0) {
                    calculator.find('[name="north_facing"]').prop('checked', false);
                }

                if (calculator.find('[name="units"]:checked').length !== 0) {
                    calculator.find('[name="units"]').prop('checked', false);
                    $('#grouped-calculator .input.area .JS--input-area span').html('m<sup>2</sup>');
                }

                $('.JS--input-area').find('input').addClass('validate-area--disabled');

                /*      calculator.find('select').each(function () {
                          var defaultOption = jQuery(this).find('option[selected="selected"]'),
                              value = defaultOption.length ? defaultOption.val() : '';

                          $(this).val(value);
                      });*/

                //calculator.find('select[name="insulation"]').val('high');
                /*      jQuery('#insulation-slider').slider({
                          value: 1,
                      });
                      jQuery('#insulation-slider').find('span').removeClass('low average').addClass('good');*/

                jQuery('#super-product-table tbody tr').show();
                jQuery('#super-product-table tbody tr').find('.qty').val(0);

                jQuery('.cvy_best_matches_message').removeClass('cvy_visible');

                jQuery('.cvy_variation_list_item').removeClass('cvy_highlighted');
                jQuery('.cvy_options_field[data-key="attribute_pa_wattage"] .cvy_filter_option[data-value="all"]').click();

                jQuery('.cvy_radiator_variation_list_footer .cvy_show_all_wrapper').removeClass('cvy_visible');
                $('.s-product-calculator__help').removeClass('is-active');
                $('.JS--calculator-results').hide();
                resetVariationListFilter();
                scrollAfterReset();
            }

            function toggleCalculator() {

                var form = jQuery('#grouped-calculator form');

                if (form.hasClass('visible') === false) {
                    form.slideDown(200);
                    form.addClass('visible');
                    jQuery('#grouped-calculator .calculator-show').hide();
                } else {
                    form.slideUp(200, function () {
                        form.removeClass('visible');
                        jQuery('#grouped-calculator .calculator-show').show();
                    });

                }

            }

            function val(name) {
                var values = jQuery('#grouped-calculator form').serializeArray();
                for (var i = 0; i < values.length; i++) {

                    if (name == values[i].name) {
                        return values[i].value;
                    }
                }
                return 0;
            }

            function calculateAndApplyWattage() {

                //1.Length * Width = Area
                var area = val('area');
                if (area == 0) {
                    area = val('width') * val('height');
                }

                //Convert area from feet to metres
                if (val('units') == '1') {
                    area = area / 10.764;
                }

                //console.log(area);

                //2. Area * 100 = Y
                var y = area * 100;

                //3. Height
                if (val('has_stairs') == '0') {
                    var height_2 = val('height_2');

                    if (height_2 == 'h1') {
                        y = (90 / 100) * y;
                    }


                    if (height_2 == 'h2') {
                        y = (y / 100) * 100;
                    }

                    if (height_2 == 'h3') {
                        y = y + (y / 100) * 20;
                    }

                    if (height_2 == 'h4') {
                        y = y + (y / 100) * 30;
                    }
                    // end of height
                }

                // 4. If has stairs
                if (val('has_stairs') == '1') {
                    y = y + (y / 100) * 50;
                }

                // 5. if Poor Insulation
                if (val('insulation') == '0') {
                    y = y + (y / 100) * 20;
                }

                if (['conservatory', 'attic'].indexOf(val('room_type')) >= 0) {
                } else {
                    // 6. If Outside wall >= 2
                    if (parseInt(val('ext_walls')) > 2) {
                        y = y + (y / 100) * 10;
                    }
                }

                // 7. If North Facing
                if (['conservatory', 'attic'].indexOf(val('room_type')) >= 0) {
                } else {
                    if (val('north_facing') == '1') {
                        y = y + (y / 100) * 10;
                    }
                }

                // 7. If Room Type = Conservatory OR Attic
                if (['conservatory', 'garden_office', 'attic'].indexOf(val('room_type')) >= 0) {
                    y = y + (y / 100) * 25;
                }

                // 7. If Room Type = living room
                if (val('room_type') == 'livingroom') {
                    y = y + (y / 100) * 10;
                }

                var wattage = y;

                // console.log('wattage', wattage);

                if (wattage < 1) {
                    return false;
                }

                jQuery('.cvy_radiator_variation_list .cvy_quantity input').val(0);

                /**
                 * found min wattage
                 */

                //Create array of wattages

                if ($('body').hasClass('single-product')) {
                    var wattages = [];
                    jQuery('.cvy_variation_list_item').each(function () {
                        var dataWattage = jQuery(this).data('attribute_pa_wattage');
                        if (dataWattage) {
                            wattages.push(parseInt(jQuery(this).data('attribute_pa_wattage')));
                        }
                    });
                    //var init_wattage = wattage;

                    var min_wattage = Math.min.apply(null, wattages);
                    var max_wattage = Math.max.apply(null, wattages);

                    //console.log(wattages);
                    // console.log('max', max_wattage);
                    // console.log('min', min_wattage);

                    //Find quantity of radiators by checking wattage required against max wattage
                    var qty = Math.ceil(wattage / max_wattage);

                    //Set the wattage required per radiator by dividing total wattage reg by qty of radiators
                    var watt_req_per_rad = wattage / qty;
                    // console.log('wattages', wattages);

                    var wattage_option = max_wattage;

                    wattages.forEach(function (data_wattage) {
                        if ((data_wattage >= watt_req_per_rad) && (data_wattage < wattage_option)) {
                            wattage_option = data_wattage;
                        }
                    });
                    jQuery('#grouped-calculator .cvy_best_matches_message .cvy_wattage_option').text(wattage_option);
                    jQuery('#grouped-calculator .cvy_best_matches_message .cvy_quantity').text(qty);
                } else {
                    var calculatedWattage = [];
                    var calculatedQuantity = [];
                    $('.JS--compare-ranges-item').each(function () {

                        var wattages = [];

                        $(this).find('.JS--compare-ranges-wattages').each(function () {
                            var dataWattage = jQuery(this).data('attribute_pa_wattage');
                            if (dataWattage) {
                                wattages.push(parseInt(jQuery(this).data('attribute_pa_wattage')));
                            }

                        });

                        var min_wattage = Math.min.apply(null, wattages);
                        var max_wattage = Math.max.apply(null, wattages);


                        //Find quantity of radiators by checking wattage required against max wattage
                        var qty = Math.ceil(wattage / max_wattage);

                        //Set the wattage required per radiator by dividing total wattage reg by qty of radiators
                        var watt_req_per_rad = wattage / qty;

                        var wattage_option = max_wattage;

                        wattages.forEach(function (data_wattage) {
                            if ((data_wattage >= watt_req_per_rad) && (data_wattage < wattage_option)) {
                                wattage_option = data_wattage;
                            }
                        });

                        $(this).find('.JS--ranges-recommended-wattage').text(wattage_option + 'W').parent().show()

                        var defaultFullProductUrl = $(this).find('.JS--recommended-product-link').attr('data-link');


                        if (wattage_option) {
                            if (wattage_option == '1800') {
                                $(this).find('.c-compare-ranges__thumb-link').attr('href', defaultFullProductUrl + '?attribute_pa_wattage=' + wattage_option + '&attribute_pa_el_type=ceramic');
                                $(this).find('.JS--recommended-product-link').attr('href', defaultFullProductUrl + '?attribute_pa_wattage=' + wattage_option + '&attribute_pa_el_type=ceramic');
                            } else {
                                $(this).find('.c-compare-ranges__thumb-link').attr('href', defaultFullProductUrl + '?attribute_pa_wattage=' + wattage_option);
                                $(this).find('.JS--recommended-product-link').attr('href', defaultFullProductUrl + '?attribute_pa_wattage=' + wattage_option);
                            }

                        } else {
                            $(this).find('.c-compare-ranges__thumb-link').attr('href', defaultFullProductUrl);
                            $(this).find('.JS--recommended-product-link').attr('href', defaultFullProductUrl);
                        }

                        if (qty > 1) {
                            $(this).find('.JS--wattage-multiplier').text(qty + ' x ');
                        } else {
                            $(this).find('.JS--wattage-multiplier').text('');
                        }

                        var currentVariationPrice = $(this).find('.JS--compare-ranges-wattages[data-attribute_pa_wattage=' + wattage_option + ']').attr('data-price');
                        $(this).find('.JS--compare-ranges-price').html('From: <span class="woocommerce-Price-amount amount">' + currentVariationPrice + '</span>');

                        calculatedWattage.push(wattage_option);
                        calculatedQuantity.push(qty);


                    });


                    //console.log(calculatedQuantity);
                    jQuery('#grouped-calculator .cvy_best_matches_message .cvy_quantity').text(calculatedQuantity[0]);
                    jQuery('#grouped-calculator .cvy_best_matches_message .cvy_wattage_option').text(calculatedWattage[0]);
                }


                //jQuery('#grouped-calculator .cvy_best_matches_message .cvy_quantity').text(qty);
                //jQuery('#grouped-calculator .cvy_best_matches_message .cvy_wattage_option').text(wattage_option);
                jQuery('#grouped-calculator .cvy_best_matches_message .cvy_wattage_total').text(
                    Math.ceil(wattage)
                );
                jQuery('#grouped-calculator .cvy_best_matches_message .cvy_room_area').text(
                    val('area')
                );
                jQuery('#grouped-calculator .cvy_best_matches_message .cvy_room_area_units').text(
                    val('units') === '1' ? 'ft' : 'm'
                );
                /*   jQuery('#grouped-calculator .cvy_best_matches_message .cvy_room_type').text(
                       jQuery('#room-type option:selected').text()
                   );*/
                jQuery('#grouped-calculator .cvy_best_matches_message .cvy_room_type').text(
                    jQuery('#grouped-calculator [name="room_type"]:checked').parent().find('.c-radio__title').text()
                );
                jQuery('#grouped-calculator .cvy_best_matches_message').addClass('cvy_visible');

                jQuery('.cvy_options_field[data-key="attribute_pa_wattage"] .cvy_filter_option[data-value="' + wattage_option + '"]').click();

                jQuery('.cvy_variation_list_item[data-attribute_pa_wattage="' + wattage_option + '"]').addClass('cvy_highlighted');

                jQuery('.cvy_radiator_variation_list_footer .cvy_show_all_wrapper').addClass('cvy_visible');

                scrollToResults();
            }


            if (jQuery().fancybox) {

                $('.js--open-video-popup').fancybox({
                    // youtube : {
                    //     controls : 0,
                    //     showinfo : 0
                    // }
                });
                $('#view_360').fancybox({
                    touch: false,
                    afterShow: function (instance, slide) {

                        $('.reel').click();

                    }
                });

            }


            $('body').on('submit', '#grouped-calculator form', function (e) {
                e.preventDefault();
                $('.cvy_best_matches_message').addClass('.cvy_visible');
                calculateAndApplyWattage();
                $('.JS--calculator-results').fadeIn(300);
                if (jQuery('.JS-compare-ranges-slider')) {
                    jQuery('.JS-compare-ranges-slider')[0].swiper.update()
                }

                return false;
            });

        };
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/custom-calculator-form.default', CalcFrom);
        });

    });

    function sliderIndexF($this, min = 1) {

        let l = $this.currentBreakpoint, bl
        if (l === 'max') {
            bl = min
        } else
            bl = $this.originalParams.breakpoints[l].slidesPerView
        return bl;
    }

})(jQuery);


