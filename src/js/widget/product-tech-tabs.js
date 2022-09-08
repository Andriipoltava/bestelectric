(function ($) {
    const ProductTechTabs = function ($scope, $) {
        const productTechSpecTabsNav = $scope.find('.JS--product-tech-tab-nav');
        const productTechSpecTabsContent = $scope.find('.JS--product-specs-tab');
        const accordionInstallerSlider = $scope.find('.c-product-tech-accordion__installer');
        if (accordionInstallerSlider.length) {
            var swiperMore = new Swiper(accordionInstallerSlider, {
                loop: false,
                init: true,
                slidesPerView: 1,
                spaceBetween: 24,
                paginationClickable: true,
                breakpoints: {
                    662: {
                        slidesPerView: 2,
                    },
                    800: {
                        slidesPerView: 3,
                    },
                    1025: {
                        slidesPerView: 4,
                    },
                    1400: {
                        slidesPerView: 5,
                    },
                },
                pagination: {
                    el: '.c-product-tech-accordion__installer__pagination',
                    clickable: true,
                },
                slideContent: '.c-product-tech-accordion__installer__wrapper',


            })
        }
        if (productTechSpecTabsNav.length !== 0) {
            productTechSpecTabsNav.on('click', function () {
                var dataSpec = $(this).attr('data-spec-tab');
                productTechSpecTabsNav.filter("[data-spec-tab!=" + dataSpec + "]").removeClass('is-active');
                $(this).addClass('is-active');
                productTechSpecTabsContent.filter("[data-spec-tab!=" + dataSpec + "]").hide();
                productTechSpecTabsContent.filter("[data-spec-tab=" + dataSpec + "]").fadeIn(300);

                var currentTarger = productTechSpecTabsContent.filter("[data-spec-tab=" + dataSpec + "]");
                if (productTechSpecTabsContent.find('.c-product-tech-accordion__installer').length && productTechSpecTabsContent.find('.c-product-tech-accordion__installer')[0].swiper) {
                    productTechSpecTabsContent.find('.c-product-tech-accordion__installer')[0].swiper.update()
                }
                if ($(window).width() < 768) {
                    $('html, body').animate({
                        scrollTop: currentTarger.offset().top - 20
                    }, 700);
                }
            });
        }

    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-tech-specs.default', ProductTechTabs);
    });
})(jQuery);
