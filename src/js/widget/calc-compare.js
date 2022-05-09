(function ($) {
    const CalcCompare = function ($scope, $) {

        var compareTypeBtn = $scope.find('.JS--compare-sizes-type-btn');
        $($scope).on('click', '.cvy_input_trigger', function () {
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

        $($scope).on('click', '.JS--compare-sizes-color', function () {
            var dataCompareColor = $(this).attr('data-compare-color');
            $(this).closest('.JS--compare-size-product').find('.JS--compare-item').filter("[data-compare!=" + dataCompareColor + "]").hide();
            $(this).closest('.JS--compare-size-product').find('.JS--compare-item').filter("[data-compare=" + dataCompareColor + "]").show();

            $(this).closest('.JS--compare-size-product').find('.JS--compare-sizes-color').filter("[data-compare-color=" + dataCompareColor + "]").addClass('is-active');
            $(this).closest('.JS--compare-size-product').find('.JS--compare-sizes-color').filter("[data-compare-color!=" + dataCompareColor + "]").removeClass('is-active');
        });

        $($scope).on('click', '.JS--compare-sizes-type-btn', function () {
            var dataCompareType = $(this).attr('data-compare-type');
            $(this).closest('.JS--compare-size-product').find('.JS--compare-item').filter("[data-compare!=" + dataCompareType + "]").hide();
            $(this).closest('.JS--compare-size-product').find('.JS--compare-item').filter("[data-compare=" + dataCompareType + "]").show();

            $(this).closest('.JS--compare-size-product').find('.JS--compare-sizes-type-btn').filter("[data-compare-type=" + dataCompareType + "]").addClass('is-active');
            $(this).closest('.JS--compare-size-product').find('.JS--compare-sizes-type-btn').filter("[data-compare-type!=" + dataCompareType + "]").removeClass('is-active');
        });

        if (compareTypeBtn.length !== 0) {
            $('.JS--compare-size-product').each(function () {
                var compareItemsLength = $(this).find('.JS--compare-item').length;
                if (compareItemsLength <= 2) {
                    var availableType = $(this).find('.JS--compare-item').attr('data-compare');
                    $(this).find('.JS--compare-sizes-type-btn').filter("[data-compare-type!=" + availableType + "]").hide();
                }
            });
        }
        const swiper = new Swiper($scope.find('.JS--compare-sizes-slider'), {
            loop: false,
            init: true,
            dots: false,
            slidesPerView: 1,
            slideContent: '.swiper-wrapper',
            on: {
                init: function () {
                    const _self = this;
                    if (window.innerWidth > 1400)
                        if ($('.slider_arrow') && $scope.find('.JS--compare-sizes-slider .swiper-wrapper .swiper-slide').length <= 5) {

                            $('.slider_arrow').hide()
                            $scope.find('.JS--compare-sizes-slider .swiper-wrapper').addClass('notScroll')
                        } else {
                            $('.slider_arrow').show()
                            $scope.find('.JS--compare-sizes-slider .swiper-wrapper').removeClass('notScroll')
                        }
                    $('.s-product-compare-sizes__nav .s-product-compare-sizes__nav-arrow-fr').css({fontSize: 'inherit'})
                    $('.s-product-compare-sizes__nav .s-product-compare-sizes__nav-arrow-fr').text((_self.realIndex + sliderIndexF(_self)) + '/' + _self.slides.length)

                },
                resize: function () {
                    const _self = this;
                    c(_self, $scope)

                },
                slideChange: function () {
                    const _self = this;
                    c(_self, $scope)

                }
            },
            navigation: {
                prevEl: '.s-product-compare-sizes__nav .slider_arrow-prev',
                nextEl: '.s-product-compare-sizes__nav .slider_arrow-next'
            },

            breakpoints: {
                // when window width is >= 320px
                600: {
                    slidesPerView: 2,

                },
                // when window width is >= 480px
                992: {
                    slidesPerView: 3,

                },
                // when window width is >= 1400
                1100: {
                    slidesPerView: 4,

                },
                1400: {
                    slidesPerView: 5,

                }
            },
        })
        setTimeout(function () {


            swiper.update()

            $('.s-product-compare-sizes__nav .s-product-compare-sizes__nav-arrow-fr').text((swiper.realIndex ? swiper.realIndex : 0 + sliderIndexF(swiper)) + '/' + swiper.slides.length)


        }, 300)


    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-calculator-compare.default', CalcCompare);
    });

    function c(_self, $scope) {
        $('.s-product-compare-sizes__nav .s-product-compare-sizes__nav-arrow-fr').text((_self.realIndex + sliderIndexF(_self)) + '/' + _self.slides.length)
        $('.s-product-compare-sizes__nav .s-product-compare-sizes__nav-arrow-fr').css({fontSize: 'inherit'})
        if (window.innerWidth < 1400) {
            if ($('.slider_arrow')) {
                $('.slider_arrow').show()
                $scope.find('.JS--compare-sizes-slider .swiper-wrapper').removeClass('notScroll')
            }
        } else {
            if ($('.slider_arrow') && $scope.find('.JS--compare-sizes-slider .swiper-wrapper .swiper-slide').length <= 5) {
                $('.slider_arrow').hide()
                $scope.find('.JS--compare-sizes-slider .swiper-wrapper').addClass('notScroll')
            }
        }
    }

    function sliderIndexF($this, min = 1) {

        let l = $this.currentBreakpoint, bl
        if (l === 'max') {
            bl = min
        } else
            bl = $this.originalParams.breakpoints[l].slidesPerView
        return bl;
    }
})(jQuery);
