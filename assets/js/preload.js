console.log('DOMContentLoaded')

function anchors(btn, block) {
    jQuery(btn).on('click touchstart', function (e) {
        console.log('jQuery')
        e.preventDefault()
        jQuery(btn).closest()
        const x = jQuery(block).offset().top - 60;
        jQuery('html,body').animate({scrollTop: x}, 400);

    })

    jQuery('.elementor-widget-theme-site-logo a').on('click touchstart', function (e) {
        e.preventDefault
        window.location.href=jQuery(this).attr('href')
    })

}


anchors('#shop-now-link a', '#shop-now')
anchors('#shop-category a', '#shop-now')
anchors('#learn-category a', '#learn')

