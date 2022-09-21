(function ($) {
    jQuery('.o-product-top__trustpilot').on('click', function () {
        jQuery("html, body").animate({
            scrollTop: jQuery('#reviews-section').offset().top,
        }, 300);
    })

    if($('.date_delivery_48').length|| $('.date_delivery_24').length){
        const months = ['Jan', 'Feb', 'Mar','Apr' ,'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        function getOrdinalNum(n) {
            return n + (n > 0 ? ['th', 'st', 'nd', 'rd'][(n > 3 && n < 21) || n % 10 > 3 ? 0 : n % 10] : '');
        }
        let date_delivery_48 = new Date();
        let date_delivery_24 = new Date();
        date_delivery_48.setDate(date_delivery_48.getDate() + 2);
        if(date_delivery_48.getDay()==6){
            date_delivery_48.setDate(date_delivery_48.getDate() + 2);
        }else if (date_delivery_48.getDay()==0){
            date_delivery_48.setDate(date_delivery_48.getDate() + 2);
        }else if (date_delivery_48.getDay()==1){
            date_delivery_48.setDate(date_delivery_48.getDate() + 2);
        }else if (date_delivery_48.getDay()==2){
            date_delivery_48.setDate(date_delivery_48.getDate() + 1);
        }

        date_delivery_24.setDate(date_delivery_24.getDate() + 1);
        let day_24 = 'tomorrow';
        if(date_delivery_24.getDay()==6){
            date_delivery_24.setDate(date_delivery_24.getDate() + 2);
            day_24 = days[ date_delivery_24.getDay() ];
        }else if (date_delivery_24.getDay()==0){
            date_delivery_24.setDate(date_delivery_24.getDate() + 2);
            day_24 = days[ date_delivery_24.getDay() ];
        }else if (date_delivery_24.getDay()==1){
            day_24 = days[ date_delivery_24.getDay() ];
            date_delivery_24.setDate(date_delivery_24.getDate() + 1);
        }
        date_delivery_24 =  day_24+', '+ getOrdinalNum(date_delivery_24.getDate()) + ' ' + months[date_delivery_24.getMonth()]
        date_delivery_48 =  days[ date_delivery_48.getDay() ]+', '+ getOrdinalNum(date_delivery_48.getDate()) + ' ' + months[date_delivery_48.getMonth()]
        $('.date_delivery_48').text(date_delivery_48)
        $('.date_delivery_24').text(date_delivery_24)
    }

    function upsell_options(upsellPrice, update = false) {
        const oldPrice = document.querySelector('.variations_form .price').textContent.replace('£', '')
        setTimeout(function () {
            let newPrice = parseFloat(upsellPrice) + parseFloat(oldPrice),
                newHtml = document.querySelector('.variations_form .price .amount').innerHTML.replace(oldPrice, newPrice.toFixed(2));
            document.querySelector('.variations_form .price .amount').innerHTML = newHtml
            document.querySelector('.single_variation_wrap .variations_button__bottom  .price .amount').innerHTML = newHtml
            document.querySelector('.singleWooHeader__item__price .price .amount').innerHTML = newHtml
            document.querySelector('.o-product-top__price .JS--top-product-price .amount').innerHTML = newHtml

        }, 10);
    }

    jQuery('.o-product-top .upsell_options input').on('change', function (e) {
        jQuery('.summary select').first().trigger('change').trigger('select.fs');
    })

    jQuery(".single_variation_wrap").on("show_variation", function (event, variation) {
        setTimeout(function () {
            let upsellPrice = 0
            jQuery('.o-product-top .upsell_options input:checked').each(function (index, item) {
                upsellPrice += parseFloat(jQuery(this).closest('li').find('.price-box .amount').text().replace('£', ''));
            })
            upsell_options(upsellPrice, true)
        }, 30);
    })




    $('form.cart').on('submit', function (e) {
        e.preventDefault();

        var form = $(this),
            mainId = form.find('.single_add_to_cart_button').val(),
            fData = form.serializeArray();

        form.block({message: null, overlayCSS: {background: '#fff', opacity: 0.6}});

        if (mainId === '') {
            mainId = form.find('input[name="product_id"]').val();
        }

        if (typeof wc_add_to_cart_params === 'undefined')
            return false;

        $.ajax({
            type: 'POST',
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'custom_add_to_cart'),
            data: {
                'product_id': mainId,
                'form_data': fData
            },
            success: function (response) {
                $(document.body).trigger("wc_fragment_refresh");
                $('.woocommerce-error,.woocommerce-message').remove();
                $('input[name="quantity"]').val(1);
                $('.woocommerce-notices-wrapper').append(response);
                form.unblock();
                jQuery("html, body").animate({
                    scrollTop: 0,
                }, 300);

            },
            error: function (error) {
                form.unblock();
                // console.log(error);
            }
        });
    });
    $(".variations_form").on("woocommerce_variation_select_change", function () {
        // Fires whenever variation selects are changed
        $('#ppc-top-title').addClass('hide')
        $('#ppc-bottom-payment-logos').addClass('hide')
    });

    $(".single_variation_wrap").on("show_variation", function (event, variation) {
        // Fired when the user selects all the required dropdowns / attributes
        // and a final variation is selected / shown
        $('#ppc-top-title').removeClass('hide')
        $('#ppc-bottom-payment-logos').removeClass('hide')
    });
    const ProductForm = function ($scope, $) {
        $scope.find('.variation-dropdown-specification').on('click', function (e) {
            e.preventDefault()
            if (!$scope.find('.variation-dropdown-specification').hasClass('time')) {
                $scope.find('.variation-dropdown-specification').toggleClass('active')
                $scope.find('.variation-dropdown-specification').addClass('time')
                $scope.find('.variation-dropdown-specification__bottom').toggleClass('show')
            }
            setTimeout(function () {
                $scope.find('.variation-dropdown-specification').removeClass('time')
            }, 200)


        })

        $scope.find('.accordion__header').on('click', function () {
            const _self = $(this)
            if (!_self.parent().hasClass('time')) {
                _self.parent().addClass('time')
                _self.parent().toggleClass('show')
            }
            setTimeout(function () {
                _self.parent().removeClass('time')
            }, 200)
        })

        $scope.find('.anchor').on('click', function (e) {
            e.preventDefault();
            let id = $(this).attr('href')
            if ($(id).length)
                $("html, body").animate({
                    scrollTop: $(id).offset().top,
                }, 300);
        })
        $scope.find('.JS-cvy_image_groups').fancybox({});

        $scope.find('.accordion__header').on('click', function () {
            const _self = $(this)
            if (!_self.parent().hasClass('time')) {
                _self.parent().addClass('time')
                _self.parent().toggleClass('show')
            }
            setTimeout(function () {
                _self.parent().removeClass('time')
            }, 200)
        })
        if ($scope.find('.variable-items-wrapper').length) {
            $scope.find('.variable-items-wrapper').each(function () {
                if ($(this).data('attribute_name') === 'attribute_pa_wattage' && $(this).closest('.variations-item').hasClass('var_slider_wattage')) {
                    const lists = $(this)
                    lists.find('li').addClass('swiper-slide')
                    lists.addClass('swiper-wrapper')
                    lists.closest('.variations-item').addClass('variations-item__slider')
                    lists.parent().show()
                    const swiper = new Swiper(lists.parent(), {
                        loop: false,
                        init: true,
                        dots: false,
                        spaceBetween: 20,
                        slidesPerView: 1,
                        on: {
                            init: function (data) {
                                $scope.find('.var-slider__nav').css({display: 'block'})
                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + this.slides.length)
                            },
                            slideChange: function (data) {
                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + this.slides.length)
                            },
                            resize: function () {
                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + this.slides.length)
                            },
                            update: function () {
                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + this.slides.length)
                            }
                        },
                        breakpoints: {
                            // when window width is >= 320px
                            460: {
                                slidesPerView: 2,
                            },
                        },
                        navigation: {
                            prevEl: '.var-slider__nav-arrow-prev',
                            nextEl: '.var-slider__nav-arrow-next'
                        },
                        slideContent: '.swiper-wrapper',

                    })
                    $scope.find('.variations-item__slider').css({width: $scope.find('.variations_form').width()})
                    $(window).on('resize', function(){
                        $scope.find('.variations-item__slider').css({width: $scope.find('.variations_form').width()})
                    });
                    setTimeout(function () {
                        jQuery('.variations_form').WooVariationSwatchesMod()
                        $scope.find('.variations-item__slider').css({width: $scope.find('.variations_form').width()})
                        swiper.update()
                        if ($('.JS--gallery-loader').length !== 0) {
                            $('.JS--gallery-loader').hide();
                        }
                        setTimeout(function () {
                            $scope.find('.variations-item.var_slider_wattage').addClass('is-loaded')
                        }, 500)

                    }, 500)
                } else {
                    setTimeout(function () {
                        if ($('.JS--gallery-loader').length !== 0) {
                            $('.JS--gallery-loader').hide();
                        }
                    }, 500)
                }
            })
        } else {
            setTimeout(function () {
                if ($('.JS--gallery-loader').length !== 0) {
                    $('.JS--gallery-loader').hide();
                }
            }, 500)
        }


    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-single-product-form.default', ProductForm);
        console.log('frontend/element_ready/custom-woo-single-product-form.default')

    });

    function sliderIndexF($this, min = 1) {

        let l = $this.currentBreakpoint, bl
        if (l === 'max') {
            bl = min
        } else
            bl = $this.originalParams.breakpoints[l].slidesPerView

        if (bl > $this.slides.length) {
            bl = $this.slides.length
        }
        return bl;
    }
})(jQuery);
