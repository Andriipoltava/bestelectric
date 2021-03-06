(function ($) {
    const ProductForm = function ($scope, $) {
        $scope.find('.product_upsells h3').on('click', function () {
            $(this).next().toggleClass('ac_open')
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
            $(this).parent().toggleClass('show')
        })
        if ($scope.find('.variable-items-wrapper').length) {
            $scope.find('.variable-items-wrapper').each(function () {
                if ($(this).data('attribute_name') === 'attribute_pa_wattage' && $(this).closest('.variations-item').hasClass('var_slider_wattage')) {
                    const lists = $(this)
                    lists.find('li').addClass('swiper-slide')
                    lists.addClass('swiper-wrapper')
                    lists.closest('.variations-item').addClass('variations-item__slider')
                    const swiper = new Swiper(lists.parent(), {
                        loop: false,
                        init: true,
                        dots: false,
                        spaceBetween: 20,
                        slidesPerView: 1,
                        on: {
                            init: function (data) {
                                $scope.find('.var-slider__nav').css({display: 'block'})
                                let count = jQuery('.woo-variation-items-wrapper li.cvy_variation_list_item:not(.no-match)')
                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + count.length)
                            },
                            slideChange: function (data) {
                                let count = jQuery('.woo-variation-items-wrapper li.cvy_variation_list_item:not(.no-match)')

                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + count.length)

                            },
                            resize: function () {
                                $scope.find('.variations-item__slider').css({width: $scope.find('.variations_form').width()})
                                let count = jQuery('.woo-variation-items-wrapper li.cvy_variation_list_item:not(.no-match)')
                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + count.length)

                            },
                            update: function () {
                                let count = jQuery('.woo-variation-items-wrapper li.cvy_variation_list_item:not(.no-match)')
                                $scope.find('.var-slider__nav-arrow-fr').text((this.realIndex + sliderIndexF(this)) + '/' + count.length)

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

                    setTimeout(function () {
                        jQuery('.variations_form').WooVariationSwatchesMod()
                        $scope.find('.variations-item__slider').css({width: $scope.find('.variations_form').width()})
                        swiper.update()
                        let count = jQuery('.woo-variation-items-wrapper li.cvy_variation_list_item:not(.no-match)')

                        $scope.find('.var-slider__nav-arrow-fr').text((swiper.realIndex + sliderIndexF(swiper)) + '/' + count.length)
                        if ($('.JS--gallery-loader').length !== 0) {
                            $('.JS--gallery-loader').hide();
                        }
                        let index = 0
                        swiper.slides.each(function (i) {
                            if ($(this).hasClass('selected') && !$(this).hasClass('no-match')) {
                                index = i;
                            }
                        })
                        if ($scope.find('.cvy_variation_list_item.selected:not(.no-match)'))
                            swiper.slideTo(index)
                        $('.variations_form').change(function () {
                            setTimeout(function () {
                                swiper.update()
                            }, 100)
                        })
                        jQuery('.cvy_variation_list_item:not(.no-match)').each(function (i) {
                            if ($(this).hasClass('selected') ) {
                                index = i;
                            }
                        })
                        setTimeout(function () {
                            swiper.update()
                            swiper.slideTo(index)
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
