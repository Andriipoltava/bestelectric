(function ($) {

    $(document).ready(function () {

        const WidgetWooBasket = function ($scope, $) {

            $('body').on('click', '.с-cart-btn', function (e) {
                e.preventDefault();
                const parent = $(this).parent()
                if (!parent.hasClass('open')) {
                    $(this).next('.c-cart-content').fadeToggle(300);
                    parent.addClass('open');
                    if ($('.JS--open-mobile-menu-btn').hasClass('open')) {
                        $('.JS--open-mobile-menu-btn').removeClass('open');
                    }
                    setTimeout(function () {
                        parent.removeClass('open');
                    },350)

                }

            });

            $(document).click(function (e) {
                if (!$('.c-cart-content').is(e.target) && !$('.с-cart-btn').is(e.target) && $('.c-cart-content').has(e.target).length === 0 && $('.с-cart-btn').has(e.target).length === 0) {
                    if ($('.c-cart-content').is(':visible')) {
                        $('.c-cart-content').fadeOut(300);
                    }
                }
            });


        };
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-basket.default', WidgetWooBasket);
        });
    });

})(jQuery);