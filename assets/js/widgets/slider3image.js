(function ($) {
    const Slider3Image = function ($scope, $) {
            const swiper = new Swiper($scope.find('.slider-3-image'), {
                loop: true,
                init: true,
                dots: false,
                slidesPerView: 1,
                slideContent: '.slider-3-image__wrap',
                pagination: {
                    el: '.slider-3-image__pagination',
                    clickable: true,
                },
            })


    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/slider-3-image.default', Slider3Image);
    });
})(jQuery);
