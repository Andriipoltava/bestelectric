if (!window.elementorProFrontend) {
    // alert( jQuery('#home_anhor a').length)
    document.addEventListener("DOMContentLoaded", function (event) {
        jQuery('#home_anhor a').on('click', function (e) {
            e.preventDefault()
            var x = jQuery('#shop-now').offset().top - 60;
            jQuery('html,body').animate({scrollTop: x}, 400);

        })
        jQuery('#modal-video-home a').on('click', function (e) {
            e.preventDefault()
            if (!window.elementorProFrontend) {
                setTimeout(function () {
                    if (window.elementorProFrontend) {
                        window.elementorProFrontend.modules.popup.showPopup({id: 18383});
                    }
                }, 1000)
            } else {
                window.elementorProFrontend.modules.popup.showPopup({id: 18383});
            }
        })
    });

}
