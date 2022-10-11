/**
 * Product Page Tabs.
 */

(function ($) {


    $(document).ready(function () {


        // icons list
        var productListItemBtn = $('.JS--featured-item-btn');

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


        $('.JS--open-popup').on('click', function () {
            var dataPopup = $(this).attr('data-popup');

            if (dataPopup == 'calc' ) {
                elementorProFrontend.modules.popup.showPopup( { id: 17223 } );
            }

            if (dataPopup == 'sizes' ) {
                elementorProFrontend.modules.popup.showPopup( { id: 17234 } );
            }
            if (dataPopup == 'features' ) {
                elementorProFrontend.modules.popup.showPopup( { id: 17247 } );
            }

        });


    });




})(jQuery);






