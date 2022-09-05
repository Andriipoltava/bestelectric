/******/
(function (modules) { // webpackBootstrap
    /******/    // The module cache
    /******/
    var installedModules = {};
    /******/
    /******/    // The require function
    /******/
    function __webpack_require__(moduleId) {
        /******/
        /******/        // Check if module is in cache
        /******/
        if (installedModules[moduleId]) {
            /******/
            return installedModules[moduleId].exports;
            /******/
        }
        /******/        // Create a new module (and put it into the cache)
        /******/
        var module = installedModules[moduleId] = {
            /******/            i: moduleId,
            /******/            l: false,
            /******/            exports: {}
            /******/
        };
        /******/
        /******/        // Execute the module function
        /******/
        modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
        /******/
        /******/        // Flag the module as loaded
        /******/
        module.l = true;
        /******/
        /******/        // Return the exports of the module
        /******/
        return module.exports;
        /******/
    }

    /******/
    /******/
    /******/    // expose the modules object (__webpack_modules__)
    /******/
    __webpack_require__.m = modules;
    /******/
    /******/    // expose the module cache
    /******/
    __webpack_require__.c = installedModules;
    /******/
    /******/    // define getter function for harmony exports
    /******/
    __webpack_require__.d = function (exports, name, getter) {
        /******/
        if (!__webpack_require__.o(exports, name)) {
            /******/
            Object.defineProperty(exports, name, {
                /******/                configurable: false,
                /******/                enumerable: true,
                /******/                get: getter
                /******/
            });
            /******/
        }
        /******/
    };
    /******/
    /******/    // getDefaultExport function for compatibility with non-harmony modules
    /******/
    __webpack_require__.n = function (module) {
        /******/
        var getter = module && module.__esModule ?
            /******/            function getDefault() {
                return module['default'];
            } :
            /******/            function getModuleExports() {
                return module;
            };
        /******/
        __webpack_require__.d(getter, 'a', getter);
        /******/
        return getter;
        /******/
    };
    /******/
    /******/    // Object.prototype.hasOwnProperty.call
    /******/
    __webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/    // __webpack_public_path__
    /******/
    __webpack_require__.p = "";
    /******/
    /******/    // Load entry module and return exports
    /******/
    return __webpack_require__(__webpack_require__.s = 9);
    /******/
})
    /************************************************************************/
    /******/ ({

    /***/ 10:
    /***/ (function (module, exports, __webpack_require__) {


        jQuery(function ($) {
            Promise.resolve().then(function () {
                return __webpack_require__(11);
            }).then(function () {
                // Init on Ajax Popup :)
                $(document).on('wc_variation_form.wvs', '.variations_form', function () {
                    $(this).WooVariationSwatchesMod();
                });
            });
        }); // end of jquery main wrapper

        /***/
    }),

    /***/ 11:
    /***/ (function (module, __webpack_exports__, __webpack_require__) {

        "use strict";
        Object.defineProperty(__webpack_exports__, "__esModule", {value: true});
        var _createClass = function () {
            function defineProperties(target, props) {
                for (var i = 0; i < props.length; i++) {
                    var descriptor = props[i];
                    descriptor.enumerable = descriptor.enumerable || false;
                    descriptor.configurable = true;
                    if ("value" in descriptor) descriptor.writable = true;
                    Object.defineProperty(target, descriptor.key, descriptor);
                }
            }

            return function (Constructor, protoProps, staticProps) {
                if (protoProps) defineProperties(Constructor.prototype, protoProps);
                if (staticProps) defineProperties(Constructor, staticProps);
                return Constructor;
            };
        }();

        function _classCallCheck(instance, Constructor) {
            if (!(instance instanceof Constructor)) {
                throw new TypeError("Cannot call a class as a function");
            }
        }

// ================================================================
// WooCommerce Variation Change
// ================================================================

        var WooVariationSwatchesMod = function ($) {

            var Default = {};

            var WooVariationSwatchesMod = function () {
                function WooVariationSwatchesMod(element, config) {
                    _classCallCheck(this, WooVariationSwatchesMod);

                    // Assign
                    this._element = $(element);
                    this._config = $.extend({}, Default, config);
                    this._generated = {};
                    this._out_of_stock = {};
                    this.product_variations = this._element.data('product_variations');
                    this.is_ajax_variation = !this.product_variations;
                    this.product_id = this._element.data('product_id');
                    this.hidden_behaviour = $('body').hasClass('woo-variation-swatches-attribute-behavior-hide');
                    this.is_mobile = $('body').hasClass('woo-variation-swatches-on-mobile');

                    // Call
                    this.init(this.is_ajax_variation, this.hidden_behaviour);
                    this.loaded(this.is_ajax_variation, this.hidden_behaviour);
                    this.update(this.is_ajax_variation, this.hidden_behaviour);
                    this.reset(this.is_ajax_variation, this.hidden_behaviour);

                    // Trigger
                    $(document).trigger('woo_variation_swatches', [this._element]);
                }

                _createClass(WooVariationSwatchesMod, [{
                    key: 'init',
                    value: function init(is_ajax, hidden_behaviour) {
                        var _this3 = this;

                        var _this = this;
                        this._element.find('ul.variable-items-wrapper').each(function (i, el) {

                            var select = $(this).siblings('select.woo-variation-raw-select');
                            var li = $(this).find('li');
                            var reselect_clear = $(this).hasClass('reselect-clear');
                            var is_mobile = $('body').hasClass('woo-variation-swatches-on-mobile');
                            // let mouse_event_name = 'touchstart click';
                            var mouse_event_name = 'click';

                            //$(this).parent().addClass('woo-variation-items-wrapper');

                            if (reselect_clear) {
                                // $(this).on(mouse_event_name, 'li:not(.selected):not(.radio-variable-item):not(.woo-variation-swatches-variable-item-more)', function (e) {
                                //     e.preventDefault();
                                //     e.stopPropagation();
                                //     var value = $(this).data('value');
                                //     select.val(value).trigger('change');
                                //     select.trigger('click');

                                //     select.trigger('focusin');

                                //     if (is_mobile) {
                                //         select.trigger('touchstart');
                                //     }

                                //     $(this).trigger('focus'); // Mobile tooltip
                                //     $(this).trigger('wvs-selected-item', [value, select, _this._element]); // Custom Event for li
                                // });

                                // $(this).on(mouse_event_name, 'li.selected:not(.radio-variable-item)', function (e) {
                                //     e.preventDefault();
                                //     e.stopPropagation();

                                //     var value = $(this).val();

                                //     select.val('').trigger('change');
                                //     select.trigger('click');

                                //     select.trigger('focusin');

                                //     if (is_mobile) {
                                //         select.trigger('touchstart');
                                //     }

                                //     $(this).trigger('focus'); // Mobile tooltip

                                //     $(this).trigger('wvs-unselected-item', [value, select, _this._element]); // Custom Event for li
                                // });

                                // // RADIO
                                // $(this).on(mouse_event_name, 'input.wvs-radio-variable-item:radio', function (e) {
                                //     e.preventDefault();
                                //     e.stopPropagation();
                                //     $(this).trigger('change');
                                // });

                                // $(this).on('change', 'input.wvs-radio-variable-item:radio', function (e) {
                                //     var _this2 = this;

                                //     e.preventDefault();
                                //     e.stopPropagation();

                                //     var value = $(this).val();

                                //     if ($(this).parent('li.radio-variable-item').hasClass('selected')) {
                                //         select.val('').trigger('change');
                                //         _.delay(function () {
                                //             $(_this2).prop('checked', false);
                                //             $(_this2).parent('li.radio-variable-item').trigger('wvs-unselected-item', [value, select, _this._element]); // Custom Event for li
                                //         }, 1);
                                //     } else {
                                //         select.val(value).trigger('change');
                                //         $(this).parent('.radio-variable-item').trigger('wvs-selected-item', [value, select, _this._element]); // Custom Event for li
                                //     }

                                //     select.trigger('click');
                                //     select.trigger('focusin');
                                //     if (is_mobile) {
                                //         select.trigger('touchstart');
                                //     }
                                // });
                            } else {
                                // $(this).on(mouse_event_name, 'li:not(.radio-variable-item):not(.woo-variation-swatches-variable-item-more)', function (e) {
                                //     e.preventDefault();
                                //     e.stopPropagation();
                                //     var value = $(this).data('value');
                                //     select.val(value).trigger('change');
                                //     select.trigger('click');
                                //     select.trigger('focusin');
                                //     if (is_mobile) {
                                //         select.trigger('touchstart');
                                //     }

                                //     $(this).trigger('focus'); // Mobile tooltip

                                //     $(this).trigger('wvs-selected-item', [value, select, _this._element]); // Custom Event for li
                                // });
                            }
                        });

                        _.delay(function () {
                            _this3._element.trigger('reload_product_variations');
                            _this3._element.trigger('woo_variation_swatches_mod_init', [_this3, _this3.product_variations]);
                            $(document).trigger('woo_variation_swatches_mod_loaded', [_this3._element, _this3.product_variations]);
                        }, 1);
                    }
                }, {
                    key: 'loaded',
                    value: function loaded(is_ajax, hidden_behaviour) {
                        if (!is_ajax) {
                            this._element.on('woo_variation_swatches_mod_init', function (event, object, product_variations) {

                                //console.log('here we are');

                                object._generated = product_variations.reduce(function (obj, variation) {

                                    Object.keys(variation.attributes).map(function (attribute_name) {
                                        if (!obj[attribute_name]) {
                                            obj[attribute_name] = [];
                                        }

                                        if (variation.attributes[attribute_name]) {
                                            obj[attribute_name].push(variation.attributes[attribute_name]);
                                        }
                                    });

                                    return obj;
                                }, {});

                                //console.log(object._generated);

                                object._out_of_stock = product_variations.reduce(function (obj, variation) {

                                    Object.keys(variation.attributes).map(function (attribute_name) {
                                        if (!obj[attribute_name]) {
                                            obj[attribute_name] = [];
                                        }

                                        if (variation.attributes[attribute_name] && !variation.is_in_stock) {
                                            obj[attribute_name].push(variation.attributes[attribute_name]);
                                        }
                                    });

                                    return obj;
                                }, {});

                                //console.log(object._out_of_stock);

                                var form_data = {};

                                $.each($('.variations_form').serializeArray(), function () {
                                    form_data[this.name] = this.value;
                                });

                                //console.log(form_data);

                                $(this).find('ul.variable-items-wrapper').each(function () {
                                    var li = $(this).find('li:not(.woo-variation-swatches-variable-item-more)');
                                    var attribute = $(this).data('attribute_name');
                                    var attribute_values = object._generated[attribute];
                                    var out_of_stock_values = object._out_of_stock[attribute];

                                    //console.log(out_of_stock_values)
                                    li.each(function () {

                                        // var attribute_value = $(this).attr('data-value');
                                        var this_li = $(this);
                                        var data_attributes = this_li.data();

                                        //console.log(data_attributes);

                                        $.each(data_attributes, function () {
                                            // console.log(this);
                                        });

                                        Object.keys(data_attributes).forEach(function (item) {
                                            // console.log(item); // key
                                            // console.log(lunch[item]); // value

                                            // COULD USE _.indexOf here
                                            if (item in form_data) {
                                                if (data_attributes[item] == form_data[item]) {
                                                    //console.log('match');
                                                    this_li.removeClass('no-match');
                                                }
                                            }
                                        });

                                        // console.log('break');

                                        // if (!_.isEmpty(attribute_values) && !_.contains(attribute_values, attribute_value)){}

                                        // if attribute has values but current LI value is not in the list (i.e. not available)
                                        // if (!_.isEmpty(attribute_values) && _.indexOf(attribute_values, attribute_value) === -1) {
                                        //     $(this).removeClass('selected');
                                        //     $(this).addClass('disabled');

                                        //     // if ($(this).hasClass('radio-variable-item')) {
                                        //     //     $(this).find('input.wvs-radio-variable-item:radio').prop('disabled', true).prop('checked', false);
                                        //     // }
                                        // }
                                    });
                                });
                            });
                        }
                    }
                }, {
                    key: 'reset',
                    value: function reset(is_ajax, hidden_behaviour) {
                        // var _this = this;
                        // this._element.on('reset_data', function (event) {
                        //     $(this).find('ul.variable-items-wrapper').each(function () {
                        //         var li = $(this).find('li');
                        //         li.each(function () {
                        //             if (!is_ajax) {
                        //                 $(this).removeClass('selected disabled');

                        //                 if ($(this).hasClass('radio-variable-item')) {
                        //                     $(this).find('input.wvs-radio-variable-item:radio').prop('disabled', false).prop('checked', false);
                        //                 }
                        //             } else {
                        //                 if ($(this).hasClass('radio-variable-item')) {
                        //                     //    $(this).find('input.wvs-radio-variable-item:radio').prop('checked', false);
                        //                 }
                        //             }

                        //             $(this).trigger('wvs-unselected-item', ['', '', _this._element]); // Custom Event for li
                        //         });
                        //     });
                        // });
                    }
                }, {
                    key: 'update',
                    value: function update(is_ajax, hidden_behaviour) {
                        // this._element.on('woocommerce_variation_has_changed', function (event) {
                        //     if (is_ajax) {
                        //         $(this).find('ul.variable-items-wrapper').each(function () {
                        //             var _this4 = this;

                        //             var selected = '',
                        //                 options = $(this).siblings('select.woo-variation-raw-select').find('option'),
                        //                 current = $(this).siblings('select.woo-variation-raw-select').find('option:selected'),
                        //                 eq = $(this).siblings('select.woo-variation-raw-select').find('option').eq(1),
                        //                 li = $(this).find('li'),
                        //                 selects = [];

                        //             // For Avada FIX
                        //             if (options.length < 1) {
                        //                 options = $(this).parent().find('select.woo-variation-raw-select').find('option');
                        //                 current = $(this).parent().find('select.woo-variation-raw-select').find('option:selected');
                        //                 eq = $(this).parent().find('select.woo-variation-raw-select').find('option').eq(1);
                        //             }

                        //             options.each(function () {
                        //                 if ($(this).val() !== '') {
                        //                     selects.push($(this).val());
                        //                     selected = current ? current.val() : eq.val();
                        //                 }
                        //             });

                        //             _.delay(function () {
                        //                 li.each(function () {
                        //                     var value = $(this).attr('data-value');
                        //                     $(this).removeClass('selected disabled');

                        //                     if (value === selected) {
                        //                         $(this).addClass('selected');
                        //                         if ($(this).hasClass('radio-variable-item')) {
                        //                             $(this).find('input.wvs-radio-variable-item:radio').prop('disabled', false).prop('checked', true);
                        //                         }
                        //                     }
                        //                 });

                        //                 // Items Updated
                        //                 $(_this4).trigger('wvs-items-updated');
                        //             }, 1);
                        //         });
                        //     }
                        // });

                        // WithOut Ajax Update
                        this._element.on('woocommerce_update_variation_values', function (event) {

                            // For each UL (attribute list)
                            $(this).find('ul.variable-items-wrapper').each(function () {
                                var _this5 = this;

                                var selected = '',
                                    options = $(this).siblings('select.woo-variation-raw-select').find('option'),
                                    current = $(this).siblings('select.woo-variation-raw-select').find('option:selected'),
                                    eq = $(this).siblings('select.woo-variation-raw-select').find('option').eq(1),
                                    li = $(this).find('li:not(.woo-variation-swatches-variable-item-more)'),
                                    selects = [];

                                // Loop through attribute options and add option values to selects array
                                options.each(function () {
                                    if ($(this).val() !== '') {
                                        selects.push($(this).val());
                                        // Set selected as selected option if there is one or first option
                                        selected = current ? current.val() : eq.val();
                                    }
                                });

                                var form_data = {};

                                $.each($('.variations_form').serializeArray(), function () {
                                    form_data[this.name] = this.value;
                                });

                                //console.log(form_data);

                                _.delay(function () {
                                    li.each(function () {
                                        //var value = $(this).attr('data-value');
                                        var this_li = $(this);
                                        var data_attributes = this_li.data();

                                        //console.log(data_attributes);

                                        this_li.removeClass('no-match').addClass('no-match');
                                        let t = 0;
                                        let k = 0;
                                        Object.keys(data_attributes).forEach(function (item) {

                                            if (item.indexOf('attribute_pa_') !== -1) {
                                                k++
                                            }
                                            // console.log(item); // key
                                            // console.log(lunch[item]); // value

                                            // COULD USE _.indexOf here

                                            if (item in form_data) {
                                                if (data_attributes[item] == form_data[item]) {
                                                    // console.log(item,form_data)
                                                    //console.log('match');
                                                    t++
                                                    // console.log(2)
                                                }
                                            }
                                        });
                                        if (t == k) {
                                            this_li.removeClass('no-match');
                                        }

                                    });

                                    if(li.parent().parent()[0].swiper){
                                        li.parent().parent()[0].swiper.update()
                                    }

                                    // Items Updated
                                    $(_this5).trigger('wvs-items-updated');
                                }, 1);
                            });
                        });
                    }
                }], [{
                    key: '_jQueryInterface',
                    value: function _jQueryInterface(config) {
                        return this.each(function () {
                            new WooVariationSwatchesMod(this, config);
                        });
                    }
                }]);

                return WooVariationSwatchesMod;
            }();

            /**
             * ------------------------------------------------------------------------
             * jQuery
             * ------------------------------------------------------------------------
             */

            $.fn['WooVariationSwatchesMod'] = WooVariationSwatchesMod._jQueryInterface;
            $.fn['WooVariationSwatchesMod'].Constructor = WooVariationSwatchesMod;
            $.fn['WooVariationSwatchesMod'].noConflict = function () {
                $.fn['WooVariationSwatchesMod'] = $.fn['WooVariationSwatchesMod'];
                return WooVariationSwatchesMod._jQueryInterface;
            };

            return WooVariationSwatchesMod;
        }(jQuery);

        /* harmony default export */
        __webpack_exports__["default"] = (WooVariationSwatchesMod);

        /***/
    }),

    /***/ 9:
    /***/ (function (module, exports, __webpack_require__) {

        module.exports = __webpack_require__(10);


        /***/
    })

    /******/
});

/**
 * Product Page.
 */

(function ($) {

    $(document).ready(function () {

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
        
        $('form.variations_form').on('show_variation', function (event, data) {
            $('.JS--product-availability').html(data.availability_html);
            $('.JS--product-availability').addClass('is-loaded');
        });

        $('body').on('click', '.cvy_tip', function (e) {
            if ($(window).width() <= 1024) {
                e.preventDefault();
                e.stopPropagation();
            }
        });


	       if ($('.product_cat-electric-towel-rails').length !== 0) {
	           var productPriceClone = $('.woocommerce-variation').clone();
	           $('.JS--quantity-minus').before(productPriceClone);
	           var wattageLabel = $(".variations tr:last-child label").attr("for", 'pa_wattage');

	           var optionsButtons = '';
	           wattageLabel.addClass('c-options-btns-label').append(optionsButtons);
	           if (wattageLabel.length !== 0) {
	               setTimeout(function () {
	                   wattageLabel.addClass('is-loaded');
	               }, 300);
	           }
	       }



        $('form.cart').on('click', '.JS--quantity-plus,.JS--quantity-minus', function (e) {
            e.preventDefault();
            e.stopPropagation();
            // Get current quantity values
            var qty = $(this).closest('form.cart').find('.qty');
            var val = parseFloat(qty.val());
            var max = parseFloat(qty.attr('max'));
            var min = parseFloat(qty.attr('min'));
            var step = parseFloat(qty.attr('step'));

            // Change the value if plus or minus
            if ($(this).is('.JS--quantity-plus')) {
                if (max && (max <= val)) {
                    qty.val(max);
                } else {
                    qty.val(val + step);
                }
            } else {
                if (min && (min >= val)) {
                    qty.val(min);
                } else if (val > 1) {
                    qty.val(val - step);
                }
            }

        });


        $('.JS--open-calculator').on('click', function () {
            $('#product-options').slideDown(300);
            setTimeout(function () {
                $('html,body').animate({
                    scrollTop: $('#product-options').offset().top
                }, 500);
                return false;
            }, 400);
        });

        $('.close-calculator').on('click', function () {
            $('#product-options').slideUp(300);
        });



        if ($('.JS--tustpilot-loader').length !== 0) {
            setTimeout(function () {
                $('.JS--tustpilot-loader').addClass('is-loaded');
            }, 50);
        }

        if ($('.product_cat-electric-radiators').length !== 0 || typeof ($('.product_cat-electric-radiators')) !== 'undefined') {
            if ($('.variations').length !== 0) {
                var rowLength = $('.variations').find('tr').length;

                setTimeout(function () {

                    if (rowLength >= 3) {
                        $('.variations tr:nth-child(3)').find('td.value').addClass('is-loaded');
                    } else {
                        $('.variations tr:nth-child(2)').find('td.value').addClass('is-loaded');
                    }

                }, 300);

                $('.product_cat-electric-radiators .variations select').on('change', function () {
                    var _this = $(this);
                    setTimeout(function () {
                        var newPrice = _this.closest('.variations_form').find('.woocommerce-variation-price .price');

                        $('.JS--top-product-price').html(newPrice.html());
                        $('.variations_button__bottom .price .woocommerce-Price-amount').html(newPrice.find('.amount').html());
                    }, 30);

                });

            }
        }

        if($('.product_upsells').length !== 0){

        }else{



            $('.product:not(.product_cat-electric-radiators) .variations select').on('change', function () {
                var _this = $(this);
                setTimeout(function () {
                    var newPrice = _this.closest('.variations_form').find('.woocommerce-variation-price .price').html();
                    //var availabilityProduct = _this.closest('.variations_form').find('.woocommerce-variation-availability').html();
                    //$('.JS--product-availability').html(availabilityProduct);
                    $('.JS--top-product-price').html(newPrice);
                    $('.JS--mobile-price').html(newPrice);
                    //$('<div class=" woocommerce-variation single_variation">'+newPrice+'</div>').insertBefore('.product-cart-inc');
                }, 30);

            });
        }



        var simpleProductPrice = $('.product-type-simple').find('.JS--top-product-price').html();
        var singleProductPriceBefore = $('.product-type-simple').find('.product-cart-inc');
        $('<div class="simple-product-mobile-price">'+simpleProductPrice+'</div>').insertBefore(singleProductPriceBefore);

        if ($('.o-product-top__img').length !== 0 && $('.gallery-thumbs').length !== 0) {
            setTimeout(function () {
                var productThumbGallery = document.querySelector('.gallery-thumbs').swiper;
                productThumbGallery.params.threshold = 100;
            }, 100);

        }

    });


    function includeSortType(currentColor, currentTypes) {
        $('.variations tr:last-child .button-variable-wrapper').not('.JS--radiators-select').find('li').each(function () {
            var dataColorType = $(this).attr('data-attribute_pa_colour');
            var dataTypes = $(this).attr('data-attribute_pa_el_type');
            if (dataTypes !== currentTypes || dataColorType !== currentColor) {
                $(this).addClass('hidden-by-type');
            } else {
                $(this).removeClass('hidden-by-type');
            }
        });
    }

    function includeSortSizeType(currentTypes) {
        $('.variations tr:last-child .button-variable-wrapper').not('.JS--radiators-select').find('li').each(function () {
            //var dataSize = $(this).attr('data-attribute_pa_size');
            var dataTypes = $(this).attr('data-attribute_pa_el_type');
            if (dataTypes !== currentTypes) {
                $(this).addClass('hidden-by-type');
            } else {
                $(this).removeClass('hidden-by-type');
            }
        });
    }

    function initSelectedItems(currentTypeVal) {
        $('.variations tr:last-child .button-variable-wrapper .cvy_variation_list_item:not([data-attribute_pa_el_type="' + currentTypeVal + '"])').removeClass('currentActive').addClass('no-match');
    }

    /*    function initSelectedTowelItems(currentTypeVal) {
            $('.variations tr:last-child .button-variable-wrapper .cvy_variation_list_item[data-attribute_pa_el_type!="' + currentTypeVal + '"]').removeClass('currentActive').addClass('no-match');
        }*/


    function insertSelectedItemClone() {
        var cloneSelectedItem = $('.variations tr:last-child .button-variable-wrapper .selected').not('.no-match').clone();
        $('.JS--radiators-select').prepend(cloneSelectedItem);
    }


})(jQuery);







/**
 * Product Page Tabs.
 */

(function ($) {


    $(document).ready(function () {


        // icons list
        var productListItemBtn = $('.JS--featured-item-btn');

        if (productListItemBtn.length !== 0) {
            productListItemBtn.on('click', function () {
                $('.JS--featured-item-btn').not($(this)).removeClass('is-active').closest('.JS--featured-list-item').find('.JS--featured-item-description').slideUp(300);
                $(this).toggleClass('is-active');
                if ($(this).hasClass('is-active')) {
                    $(this).closest('.JS--featured-list-item').find('.JS--featured-item-description').slideDown(300);
                } else {
                    $(this).closest('.JS--featured-list-item').find('.JS--featured-item-description').slideUp(300);
                }
            });
        }


        $('.JS--open-popup').on('click', function () {
            var dataPopup = $(this).attr('data-popup');

            if (dataPopup == 'calc' ) {
                elementorProFrontend.modules.popup.showPopup( { id: 17223 } );
            }

            if (dataPopup == 'sizes' ) {
                elementorProFrontend.modules.popup.showPopup( { id: 17234 } );
            }
            if (dataPopup == 'features' ) {
                elementorProFrontend.modules.popup.showPopup( { id: 17247 } );
            }

            if (dataPopup == 'lot20') {
                elementorProFrontend.modules.popup.showPopup( { id: 17250 } );
            }

        });


    });




})(jQuery);






