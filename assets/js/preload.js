if (!window.elementorProFrontend) {
    // alert( jQuery('#home_anhor a').length)
    jQuery(document).on('click', '#home_anhor a', function (e) {
        e.preventDefault()
        var scrollTop = jQuery('#shop-now').offset().top - 60;
        jQuery('html,body').animate({scrollTop}, 400);
        alert('click')
    })
    jQuery(document).on('click', '#modal-video-home a', function (e) {
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


}
