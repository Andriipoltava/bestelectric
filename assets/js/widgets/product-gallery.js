(function ($) {
        const ProductGallery = function ($scope, $) {
            if ($scope.find('.svi-gallery-top')) {
                $scope.find('.svi-gallery-top .swiper-wrapper').css({height: 'auto'})
                $scope.find('.c-gallery-loader__thumb--big').remove()
                $scope.css('--swiper-navigation-color', '#333333')

            }
        };

        if ($('.elementor-widget-custom-woo-single-slider').length) {

            const h = $('.c-gallery-loader.JS--gallery-loader .loading-svg-thumb').height()
            $('.c-gallery__wrap').css('min-height', h + 50)
            $(window).resize(function () {
                const h = $('.c-gallery-loader.JS--gallery-loader .loading-svg-thumb').height()
                $('.c-gallery__wrap').css('min-height', h + 50)
            })
            $('.elementor-widget-custom-woo-single-slider').each(function (item) {
                const _self = $(this)
                setTimeout(sliderInit, 1000)

                function sliderInit() {
                    if (_self.find('.svi-gallery-top')[0].swiper) {

                        setTimeout(function () {
                            ProductGallery(_self, $)
                        }, 500)
                    } else {
                        setTimeout(sliderInit, 1000)
                    }
                }

            })
        } else {
            $(document).ready(function () {
                if ($('.elementor-widget-custom-woo-single-slider').length) {
                    $('.elementor-widget-custom-woo-single-slider').each(function (item) {
                        const _self = $(this)
                        $('.svi-gallery-top')
                        ProductGallery(_self, $)
                    });
                } else {
                    $(window).on('elementor/frontend/init', function () {
                        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-single-slider.default', ProductGallery);
                    });
                }


            })
        }
    }
)
(jQuery);