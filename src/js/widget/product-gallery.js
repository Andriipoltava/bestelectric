(function ($) {
        const ProductGallery = function ($scope, $) {
            if ($scope.find('.svi-gallery-top')) {
                $scope.find('.svi-gallery-top .swiper-wrapper').css({height: 'auto'})
                $scope.find('.c-gallery-loader__thumb--big').remove()
                $scope.css('--swiper-navigation-color', '#333333')

            }
            const swiperVertical = new Swiper($scope.find('#gallery-swiper-vertical'), {
                loop: false,
                init: true,
                dots: false,
                slidesPerView: 4,
                autoHeight: true,
                watchOverflow: true,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                freeMode: true,
                mousewheel: {
                    releaseOnEdges: true,
                },
                lazy: true,
                spaceBetween: 10,
                navigation: {
                    prevEl: '.gallery-vertical .swiper-button-prev',
                    nextEl: '.gallery-vertical .swiper-button-next'
                },

                breakpoints: {
                    // when window width is >= 320px
                    567: {
                        direction: 'vertical',
                        spaceBetween: 10,
                    },

                    1260: {
                        direction: 'vertical',
                        spaceBetween: 20,
                    },
                    1360: {
                        direction: 'vertical',
                        spaceBetween: 25,
                    },

                },

            })

            document.querySelector('.gallery-vertical').addEventListener('wheel', preventScroll, {passive: false});
            function preventScroll(e){
                e.preventDefault();
                e.stopPropagation();

                return false;
            }


            const swiperMain = new Swiper($scope.find('#gallery-swiper-main'), {
                loop: false,
                init: true,
                dots: true,
                autoHeight: true,
                // If we need pagination
                spaceBetween: 1,
                preloadImages: false,
                lazy: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                slidesPerView: 1,

                fadeEffect: {
                    crossFade: true
                },
                thumbs: {
                    swiper: swiperVertical
                },
                slideContent: $scope.find('#gallery-swiper-main .swiper-wrapper'),

            })
            var mySwiper = new Swiper('#lightbox .swiper-container', {
                init: false,
                navigation: {
                    prevEl: '#lightbox  .swiper-button-prev',
                    nextEl: '#lightbox  .swiper-button-next'
                },

            })

            if (jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').length && jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('src').length > 4) {
                let src = jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('src')
                let full_src = jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('full_src') ? jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('full_src') : src
                let thumb_src = jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('thumb_src') ? jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('thumb_src') : src
                jQuery('#gallery-swiper-main .swiper-slide:first-child').before(`<div class="swiper-slide variation fancybox-trigger"><img src="${src}" width="645" height="545" alt=""></div>`)
                jQuery('#gallery-swiper-vertical .swiper-slide:first-child').before(`<div class="swiper-slide variation "><img src="${thumb_src}" width="80" height="80" alt=""></div>`)
                jQuery('#lightbox .swiper-slide:first-child').before(`<div class="swiper-slide variation"><img src="${full_src}"  alt=""></div>`)
                swiperMain.update();
                swiperVertical.update();
                mySwiper.update();
                swiperMain.slideTo(0);
                swiperVertical.slideTo(0);
                swiperMain.update();

            }
            if (jQuery('.var_slider_wattage').length) {
                $(".variations_form").on("woocommerce_variation_select_change", function (e) {
                    const oldSrc = jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('src')
                    console.log(jQuery('.variable-items-wrapper .cvy_variation_list_item.selected'))

                    setTimeout(function () {
                        let src = jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('src')
                        let full_src = jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('full_src') ? jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('full_src') : src
                        let thumb_src = jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('thumb_src') ? jQuery('.variable-items-wrapper .cvy_variation_list_item.selected').data('thumb_src') : src
                        if (oldSrc !== src) {
                            jQuery('#gallery-swiper-main .swiper-slide.variation').remove()
                            jQuery('#gallery-swiper-vertical .swiper-slide.variation').remove()
                            jQuery('#lightbox .swiper-slide.variation').remove()
                            jQuery('#gallery-swiper-main .swiper-slide:first-child').before(`<div class="swiper-slide variation fancybox-trigger"><img src="${src}" width="645" height="545" alt=""></div>`)
                            jQuery('#gallery-swiper-vertical .swiper-slide:first-child').before(`<div class="swiper-slide variation"><img src="${thumb_src}" width="80" height="80" alt=""></div>`)
                            jQuery('#lightbox .swiper-slide:first-child').before(`<div class="swiper-slide variation"><img src="${full_src}"  alt=""></div>`)
                            swiperMain.update();
                            swiperVertical.update();
                            mySwiper.update();
                            swiperMain.slideTo(0);
                            swiperVertical.slideTo(0);
                            swiperMain.update();
                        }

                    }, 300)

                });

            }

            $scope.find('.galleryPopup').fancybox({});

            swiperMain.on('click', function (swiper, event) {
                $(swiper.target).closest('.fancybox-trigger')
                fancyboxHandler($(swiper.target).closest('.fancybox-trigger'))


            });
            // $(document).on('click', '.fancybox-trigger', fancyboxHandler);

            function fancyboxHandler(item) {

                jQuery('#lightbox .swiper-slide').each(function (index) {
                    jQuery(this).attr('data-id', index)
                })
                jQuery('#gallery-swiper-main .swiper-slide').each(function (index) {
                    jQuery(this).attr('data-id', index)
                })
                var thisTarget = $(item).attr('data-id');

                $.fancybox.open({
                    src: "#lightbox",
                    type: 'inline',
                    opts: {
                        toolbar: false,
                        defaultType: 'inline',
                        autoFocus: true,
                        touch: false,
                        afterLoad: function () {
                            mySwiper.init();
                            mySwiper.slideTo(thisTarget)
                            mySwiper.update()

                        }
                    }
                })

            }

        };

        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-single-slider.default', ProductGallery);
        });
    }
)
(jQuery);