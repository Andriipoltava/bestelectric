(function ($) {

    const CompareRange = function ($scope, $) {
        if ($('.put_down_js')) {
            $scope.find('.s-compare-ranges__intro').append(jQuery('.put_down_js'))
        }
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-compare-range.default', CompareRange);
    });


})(jQuery);

