(function ($) {
    const SliderIconList = function ($scope, $) {
        $scope.find('.s-ksps ').css({display: 'block'})
        $scope.find('.c-ksp-icon-list ').css({display: 'block'})
        $scope.find('.c-ksp-icon-list ').css({opacity: 0})
        $scope.find('.slider-icon-list').parent().css({overflow: 'hidden'})
        const swiper = new Swiper($scope.find('.slider-icon-list'), {
            loop: false,
            init: true,
            autoplay: {
                delay: 5000,
            },
            slidesPerView: 1,
            slideContent: '.slider-icon-list__wrap',
            pagination: {
                el: '.slider-icon-list__pagination',
                clickable: true,
            },
            on:{
                init: function (data) {
                    $scope.find('.c-ksp-icon-list ').css({opacity: 1})
                },
            },
            breakpoints: {
                // when window width is >= 320px
                470: {
                    slidesPerView: 2,

                },
                600: {
                    slidesPerView: 3,

                },
                // when window width is >= 480px
                992: {
                    slidesPerView: 4,

                },
                // when window width is >= 1400
                1400: {
                    slidesPerView: 5,

                }
            },
        })

    };
    $(document).ready(function () {
        if ($('.elementor-widget-slider-icon-list')) {
            $('.elementor-widget-slider-icon-list').each(function (item) {
                const _self = $(this)
                SliderIconList(_self, $)
            })
        } else {
            $(window).on('elementor/frontend/init', function () {
                elementorFrontend.hooks.addAction('frontend/element_ready/slider-icon-list.default', SliderIconList);
            });
        }
    })
})(jQuery);
