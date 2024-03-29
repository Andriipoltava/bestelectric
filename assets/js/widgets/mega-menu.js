(function ($) {

    $(document).ready(function () {
        const WidgetMegaMenu = function ($scope, $) {

            $scope.find('.o-header__megamenu-holder').css({display: 'block'})
            var mobileMenuBtn = $('.JS--open-mobile-menu');
            var mobileMenu = $('.c-header-nav');

            $('[class^="c-header-nav__primary"]').find('.menu-item-has-children').each(function () {
                $('<span class="c-mobile-menu__toggle JS--children-menu-toggle"></span>').appendTo(this);
            });

            $('[class^="c-header-nav__primary"]').find('.JS--mega-menu-item').each(function () {
                $('<span class="c-mobile-menu__toggle JS--children-mega-menu-toggle"></span>').appendTo(this);
            });

            mobileMenuBtn.on('click touchstart', function (e) {
                e.preventDefault();
                $(this).find('.JS--open-mobile-menu-btn').toggleClass('open');
                //mobileMenu.fadeToggle(400);
                mobileMenu.slideToggle(300);
                $('body').toggleClass('menuOpenMobil')
                setTimeout(function () {
                    $('body').toggleClass('menuOpenMobil')
                },300)
            });

            $('.JS--children-menu-toggle').on('click', function () {
                $(this).closest('.menu-item-has-children').toggleClass('is-active');
                if ($(this).closest('.menu-item-has-children').hasClass('is-active')) {
                    $(this).closest('.menu-item-has-children').find('.sub-menu').slideDown();
                } else {
                    $(this).closest('.menu-item-has-children').find('.sub-menu').slideUp();
                }

            });

            $('.JS--children-mega-menu-toggle').on('click', function () {
                $(this).closest('.JS--mega-menu-item').toggleClass('is-active');
                if ($(this).closest('.JS--mega-menu-item').hasClass('is-active')) {
                    $(this).closest('.JS--mega-menu-item').find('.o-header__megamenu-holder').slideDown();
                } else {
                    $(this).closest('.JS--mega-menu-item').find('.o-header__megamenu-holder').slideUp();
                }

            });


            $('.JS--mega-menu-item > a,.menu-item-has-children > a').on('click', function (e) {
                if ($(window).width() <= 1024) {
                    e.preventDefault();
                    if ($(this).parent().find('.JS--children-mega-menu-toggle').length !== 0) {
                        $(this).parent().find('.JS--children-mega-menu-toggle').trigger('click');
                    }

                    if ($(this).parent().find('.JS--children-menu-toggle').length !== 0) {
                        $(this).parent().find('.JS--children-menu-toggle').trigger('click');
                    }

                }
            });


            $('.c-header-nav .c-mega-sub-menu__header').on('click', function () {
                $(this).toggleClass('is-active');
                $(this).next('.c-mega-sub-menu__body').slideToggle(300);
            });


            $(document).on("click", function (event) {

                if ( !$('body').hasClass('menuOpenMobil') && mobileMenu !== event.target && !mobileMenu.has(event.target).length && !mobileMenuBtn.has(event.target).length && mobileMenuBtn !== event.target && !$('.o-header__top').has(event.target).length && $('.o-header__top .col') !== event.target && !$('.o-header__ranges-slider .slick-dots').has(event.target).length && $('.o-header__ranges-slider .slick-dots') !== event.target) {
                    mobileMenuBtn.removeClass('open');
                    if (mobileMenu.is(':visible') && $(window).width() <= 1024) {
                        mobileMenu.slideUp(300);
                    }
                    if ($('.JS--open-mobile-menu-btn').hasClass('open') ) {
                        $('.JS--open-mobile-menu-btn').removeClass('open');
                    }
                }
            });

            const swiper = new Swiper($scope.find('.JS--menu-ranges-slider'), {
                loop: false,
                init: true,
                observer: true,
                observeParents: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                slidesPerView: 1,
                slideContent: '.swiper-wrapper',
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    // when window width is >= 320px
                    600: {
                        slidesPerView: 2,

                    },
                    // when window width is >= 480px
                    992: {
                        slidesPerView: 3,

                    },
                    // when window width is >= 640px
                    1400: {
                        slidesPerView: 4,

                    }
                },

            })
            $scope.find('.o-header__megamenu-holder').attr('style','')
        };
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/custom-mega-menu.default', WidgetMegaMenu);
        });

    });
    function sliderIndexF($this, min = 1) {

        let l = $this.currentBreakpoint, bl
        if (l === 'max') {
            bl = min
        } else
            bl = $this.originalParams.breakpoints[l].slidesPerView
        return bl;
    }
})(jQuery);

