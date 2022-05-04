(function ($) {

    $(document).ready(function () {
        const WidgetSearchFrom = function ($scope, $) {
            const mobileSearchBtn = $('.JS--mobile-search');
            const mobileSearchForm = $scope.find('.JS--mobile-search-form');
            $(document).on('click','.JS--mobile-search', function () {
                mobileSearchForm.fadeToggle(300);
                if ($('.JS--open-mobile-menu-btn').hasClass('open')) {
                    $('.JS--open-mobile-menu-btn').removeClass('open');
                    $('.c-header-nav').slideUp(300);
                }
            });
            $(document).on('click', function (e) {
                if (!mobileSearchForm.is(e.target) && !mobileSearchBtn.is(e.target) && mobileSearchForm.has(e.target).length === 0 && mobileSearchBtn.has(e.target).length === 0) {
                    if (mobileSearchForm.is(':visible') && $(window).width() < 1025) {
                        mobileSearchForm.fadeOut(300);
                    }
                }
            });
        };
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/custom-search-form.default', WidgetSearchFrom);
        });
    });

})(jQuery);