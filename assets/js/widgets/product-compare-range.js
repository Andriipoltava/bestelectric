(function ($) {

    const CompareRange = function ($scope, $) {


        const compareRangesColorBtn = $scope.find('.JS--compare-ranges-color');

        if (compareRangesColorBtn.length !== 0) {

            compareRangesColorBtn.mouseover(function () {
                var dataColor = jQuery(this).attr('data-colour');
                if (dataColor == 'anthracite') {
                    jQuery(this).closest(".JS--compare-ranges-item").find('.JS--compare-ranges-thumb-secondary').addClass('visible-thumb ');
                }
            }).mouseout(function () {
                jQuery(this).closest(".JS--compare-ranges-item").find('.JS--compare-ranges-thumb-secondary').removeClass('visible-thumb ');

            });
        }
        if ($('.put_down_js')) {
            $scope.find('.s-compare-ranges__intro').append(jQuery('.put_down_js'))

        }
        const swiper = new Swiper($scope.find('.JS-compare-ranges-slider'), {
            loop: false,
            init: true,
            dots: false,
            slidesPerView: 1,
            on: {

                slideChange: function (data) {

                    $scope.find('.JS--compare-ranges-nav-fraction').text((this.realIndex + sliderIndexF(this)) + '/' + this.slides.length)
                },
                resize: function () {
                    $scope.find('.JS--compare-ranges-nav-fraction').text((this.realIndex + sliderIndexF(this)) + '/' + this.slides.length)
                },
                update: function () {
                    let l= $scope.find('.swiper-wrapper .swiper-slide')?$scope.find('.swiper-wrapper .swiper-slide'):this.slides.length

                    console.log()
                    $scope.find('.JS--compare-ranges-nav-fraction').text((this.realIndex + sliderIndexF(this)) + '/' + l.length)
                },


            },
            slideContent: '.s-compare-ranges__slider',
            navigation: {
                prevEl: '.s-compare-ranges__nav-arrow-prev',
                nextEl: '.s-compare-ranges__nav-arrow-next '
            },
            breakpoints: {
                // when window width is >= 320px
                767: {
                    slidesPerView: 2,

                },
                // when window width is >= 480px
                992: {
                    slidesPerView: 3,

                },
                1440: {
                    slidesPerView: 4,
                },

            },

        })
        setTimeout(function () {
            $scope.find('.JS-compare-ranges-slider').css({display: 'block'})
                swiper.update()
            $scope.find('.JS--compare-ranges-nav-fraction').text((swiper.realIndex + sliderIndexF(swiper)) + '/' + swiper.slides.length)
        }, 300)


    };
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/custom-woo-compare-range.default', CompareRange);
    });
    function sliderIndexF($this, min = 1) {

        let l = $this.currentBreakpoint, bl
        if (l === 'max') {
            bl = min
        } else{
            bl = $this.originalParams.breakpoints[l].slidesPerView

        }
        if (bl > $this.slides.length) {
            bl = $this.slides.length
        }

        return bl;
    }
})(jQuery);

