(function ($) {
    const Slider3Image = function ($scope, $) {
        const swiper = new Swiper($scope.find('.slider-3-image'), {
            loop: true,
            init: true,
            dots: false,
            slidesPerView: 1,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            slideContent: '.slider-3-image__wrap',
            pagination: {
                el: '.slider-3-image__pagination',
                clickable: true,
            },
        })

    };


    $(document).ready(function () {

        if ($('.elementor-widget-slider-3-image')) {
            $('.elementor-widget-slider-3-image').each(function (item) {
                const _self=$(this)
                setTimeout(function () {
                    Slider3Image(_self, $)
                })
            })

        } else {
            $(window).on('elementor/frontend/init', function () {
                elementorFrontend.hooks.addAction('frontend/element_ready/slider-3-image.default', Slider3Image);
            });
        }


    })
})(jQuery);
