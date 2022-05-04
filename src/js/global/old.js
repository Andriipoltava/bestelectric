/////////////////////////// COMMON /////////////////////////////////
jQuery(document).ready(function ($) {
    $('div.elementor-802').attr('id', 'side_menu');

    $("#custom_menu-icon").click(function () {
        $("#side_menu").toggleClass("active");
    });

    $("#custom_menu-icon").click(function () {
        $("#page").toggleClass("hfeed hfeed-opened");
    });

    $('#buy_now-btn').click(function (e) {
        e.preventDefault();

        var scrollTop = $($(this).attr('href')).offset().top,
            menu1 = $('#sticky_menu1').eq(0),
            menu2 = $('#sticky_menu2').eq(0);

        $([document.documentElement, document.body]).animate(
            {
                scrollTop: scrollTop / 5 * 4
            },
            400,
            function () {
                var stickyHeight =
                    menu1.css('display') !== 'none' ?
                        menu1.height() + menu2.height() :
                        0;

                $([document.documentElement, document.body]).animate({
                    scrollTop: scrollTop - stickyHeight
                }, 100);
            }
        );

        return false;
    });



    $('body').on('submit','.cvy_add_to_basket_form',function(e){
        var quantityFields = $(this).find('.cvy_quantity input'),
            preventSubmit = true;

        quantityFields.each(function () {
            if ($(this).val() > 0)
                preventSubmit = false;
        });

        if (preventSubmit) {
            e.preventDefault();
            swal('Please Select Quantity', 'Please set quantity of 1 or above for selected radiator(s)');
        }
    });
});
