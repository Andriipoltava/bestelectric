(function ($) {

    const CompareRange = function ($scope, $) {
        const compareRangesColorBtn = $scope.find('.JS--compare-ranges-color');
        if (compareRangesColorBtn.length !== 0) {
            compareRangesColorBtn.mouseover(function () {
                var dataColor = jQuery(this).attr('data-colour');
                if (dataColor == 'anthracite') {
                    jQuery(this).closest(".JS--compare-ranges-item").find('.JS--compare-ranges-thumb-secondary').addClass('visible-thumb ');
                }
            }).mouseout(function () {
                jQuery(this).closest(".JS--compare-ranges-item").find('.JS--compare-ranges-thumb-secondary').removeClass('visible-thumb ');
            });
        }
        if ($('.put_down_js')) {
            $scope.find('.s-compare-ranges__intro').append(jQuery('.put_down_js'))
        }
    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-compare-range.default', CompareRange);
    });


})(jQuery);

