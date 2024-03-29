(function ($) {
    const ProductHeader = function ($scope, $) {
        $scope.find('.singleWooHeader__item__menu li').each(function () {
            const i = $(this), l = $(this).find('a'),
                a = $(l.attr('href'));

            if (!a.length) {
                i.remove()
                return;
            }
            l.click(function (e) {
                e.preventDefault()
                if (!$(this).hasClass('active'))
                    $('html,body').animate({
                        scrollTop: a.offset().top,
                    }, 300);
            })
        })
        $scope.find('.singleWooHeader__item__select option').each(function () {
            const i = $(this),
                a = $(i.attr('value'));

            if (!a.length) {
                i.remove()
                return;
            }

        })
        $scope.find('.singleWooHeader__item__select').on('change', function () {
            const i = $(this)
            $('html,body').animate({
                scrollTop:$(i.val()).offset().top-40,
            }, 300);
        })
        $(document).on("scroll", onScroll);


        function onScroll(event) {
            var scrollPos = $(document).scrollTop();
            $('.singleWooHeader__item__menu li a').each(function () {
                var currLink = $(this);
                var refElement = $(currLink.attr("href"));
                if (refElement.offset().top - 80 <= scrollPos && refElement.offset().top + refElement.height() - 80 > scrollPos) {
                    currLink.addClass("active");
                } else {
                    currLink.removeClass("active");
                }
            });
        }

        $('.singleWooHeader__item__buy').on('click', function (e) {
            e.preventDefault()
            const i = $(this);
            $('html,body').animate({
                scrollTop:$(i.attr('href')).offset().top-40,
            }, 300);
        })

        $('.product .variations select').on('change', function () {
            setTimeout(function () {
                var newPrice = $('.variations_form .price').html();
                $('.singleWooHeader__item__price .price').html(newPrice);

            }, 30);
        })
        $(document).ready(function () {
            setTimeout(function () {
                $('#singleWooHeader').css({opacity:1,display:'flex'})
            },1000)
        })


    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-product-header.default', ProductHeader);
    });
})(jQuery);