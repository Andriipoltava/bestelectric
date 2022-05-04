(function ($) {
    const ProductFeaturesLists = function ($scope, $) {
        let productListItemBtn = $scope.find('.JS--featured-item-btn');

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
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-product-features-list.default', ProductFeaturesLists);
    });
})(jQuery);
