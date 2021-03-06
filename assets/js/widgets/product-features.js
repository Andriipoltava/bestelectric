(function ($) {
    const ProductFeatures = function ($scope, $) {

        $scope.closest('.elementor-top-section').css({overflow: 'hidden'})
        if ($scope.find('.s-product-image-slider__slider').length)
            var swiper = new Swiper($scope.find('.s-product-image-slider__slider'), {
                loop: false,
                init: true,
                slidesPerView: 1,
                slideContent: '.c-product-image-slider',
                pagination: {
                    el: '.s-product-image-slider__dots-list',
                    clickable: true,
                },
                navigation: {
                    prevEl: '.s-product-image-slider__prev',
                    nextEl: '.s-product-image-slider__next'
                },
            })


        if ($scope.find('.s-product-more-slider').length)
            var swiperMore = new Swiper($scope.find('.s-product-more-slider'), {
                loop: false,
                init: true,
                slidesPerView: 1,
                spaceBetween: 16,
                on: {

                    slideChange: function (data) {
                        $scope.find('.JS--product-slider-nav-fraction').text((this.realIndex + 1) + '/' + this.snapGrid.length)
                    },
                    resize: function () {
                        $scope.find('.JS--product-slider-nav-fraction').text((this.realIndex + 1) + '/' + this.snapGrid.length)
                    }

                },
                paginationClickable: true,
                breakpoints: {

                    662: {
                        slidesPerView: 2.5,
                        spaceBetween: 24,

                    },
                    1025: {
                        slidesPerView: 3,
                        spaceBetween: 24,

                    },
                    1400: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    },

                },
                slideContent: '.s-product-more-slider__slider',
                navigation: {
                    prevEl: '.JS--product-slider-nav-prev',
                    nextEl: '.JS--product-slider-nav-next'
                },

            })

        setTimeout(function () {

            $scope.find('.o-product-features').css({display: 'block'})

            if ($scope.find('.s-product-more-slider').length)
                swiperMore.update()
            if ($scope.find('.s-product-image-slider__slider').length){
                swiper.update()
                $scope.find('.JS--product-slider-nav-fraction').text((swiper.realIndex + 1) + '/' + swiper.snapGrid.length)
            }

        }, 300)

    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-features.default', ProductFeatures);
        elementorFrontend.hooks.addAction('frontend/element_ready/more-slider.default', ProductFeatures);
    });
})(jQuery);
