(function ($) {
    const ProductGallery = function ($scope, $) {
        setTimeout(function () {
            if ($scope.find('.svi-gallery-top') ) {
                $scope.find('.svi-gallery-top .swiper-wrapper').css({height: 'auto'})
                $scope.css('--swiper-navigation-color', '#333333')
            }

        }, 500)
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-single-slider.default', ProductGallery);
    });
})(jQuery);