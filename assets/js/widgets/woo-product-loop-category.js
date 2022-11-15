jQuery(document).ready(function ($) {
    const getUriWithParam = (baseUrl, params, value) => {
        const Url = new URL(baseUrl);
        const urlParams = new URLSearchParams(Url.search);
        urlParams.set(params, value);
        Url.search = urlParams.toString();
        return Url.toString();
    };
    const sliderUpdate = () => {
        jQuery('.product_cat_electricRadiators .swiper-container-initialized').each(function () {
            if($(this)[0].swiper){
                $(this)[0].swiper.update()
            }
        })
    }
    $('.product__wrapPopupWarrant .product__Popup').on('click', function (e) {
        e.preventDefault()
        elementorProFrontend.modules.popup.showPopup({id: 19816});
    })
    if( $('.date_delivery_24').length){
        const months = ['Jan', 'Feb', 'Mar','Apr' ,'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        function getOrdinalNum(n) {
            return n + (n > 0 ? ['th', 'st', 'nd', 'rd'][(n > 3 && n < 21) || n % 10 > 3 ? 0 : n % 10] : '');
        }

        function changeTimezone(date, ianatz) {
            var invdate = new Date(date.toLocaleString('en-US', {
                timeZone: ianatz
            }));
            var diff = date.getTime() - invdate.getTime();
            return new Date(date.getTime() - diff); // needs to substract
        }

        let date_delivery_24 = new Date();
        date_delivery_24 = changeTimezone(date_delivery_24, "Europe/London");
        let day_24 = 'tomorrow';


        if (date_delivery_24.getHours() >= 11 ) {
            date_delivery_24.setDate(date_delivery_24.getDate() + 2);
            if (date_delivery_24.getDay() == 1) {
                date_delivery_24.setDate(date_delivery_24.getDate() + 1);
            }
            day_24 = days[date_delivery_24.getDay()];

        } else {
            date_delivery_24.setDate(date_delivery_24.getDate() + 1);

        }

        if (date_delivery_24.getDay() == 6) {
            date_delivery_24.setDate(date_delivery_24.getDate() + 2);
            day_24 = days[date_delivery_24.getDay()];
        } else if (date_delivery_24.getDay() == 0) {
            date_delivery_24.setDate(date_delivery_24.getDate() + 2);
            day_24 = days[date_delivery_24.getDay()];
        } else if (date_delivery_24.getDay() == 1) {
            date_delivery_24.setDate(date_delivery_24.getDate() + 1);
            day_24 = days[date_delivery_24.getDay()];

        }
        date_delivery_24 =  day_24+', '+ getOrdinalNum(date_delivery_24.getDate()) + ' ' + months[date_delivery_24.getMonth()]
        $('.date_delivery_24').text(date_delivery_24)
    }
    $(".product__filters__select").change(function () {
        let baseUrl = window.location.origin
        var count = 0;
        $('.product_cat_electricRadiators').hide()
        var objectTerm = {}
        var objectTermUrl = {}
        var newSelect = {}
        $('.product__filters__selects select').each(function () {
            if ($(this).find(':selected').val()) {
                objectTerm[$(this).attr('name')] = $(this).find(':selected').val()
                objectTermUrl[$(this).attr('name')] = $(this).find(':selected').data('value')

            }
            newSelect[$(this).attr('name')] = [];

        })

        $('.product_cat_electricRadiators').each(function () {
            const item = $(this);
            let test = 0
            for (let key in objectTerm) {
                baseUrl = getUriWithParam(baseUrl, key, objectTerm[key])
                if (item.attr(key) && item.attr(key).split(',').includes(objectTerm[key])) {
                    test++
                }
            }
            if (test === Object.keys(objectTerm).length) {
                item.show()
                for (let key in newSelect) {
                    let chars = [...newSelect[key], ...item.attr(key).split(',')]
                    newSelect[key] = chars.filter((c, index) => {
                        return chars.indexOf(c) === index;
                    })
                }
                count++
            }


        })
        if (Object.keys(newSelect).length) {
            for (let key in newSelect) {
                $(".product__filters__selects select[name=" + key + "] option").each(function () {
                    let option = $(this)
                    if (!newSelect[key].includes(option.val())) {
                        option.attr('hidden', 'hidden')
                    }
                })
            }


        }
        console.log(baseUrl)

        $('.product_cat_electricRadiators__main .count').text(count)
        $('.product_cat_electricRadiators__main .reset').show()


    });
    const priceHandler = () => {

        $(`.product_cat_electricRadiators`).each(function () {
            let first = $(this).find('.product__variations .variable.active').length ? $(this).find('.product__variations .variable.active') : $(this).find('.product__variations .variable'),
                price = first.first().data('price')
            if (first && price) {
                $(this).find('.product__price .amount bdi').text('£' + first.first().data('price'))
                $(this).find('.product__payLater .priceLater').text((first.first().data('price') / 3).toFixed(2))
            }
        })
    }
    if($('.product__filters__checkbox input:checked').length){
        checkboxMobileFilter(true)
    }

    function checkboxMobileFilter(show = false) {

        var count = 0;
        var objectTerm = {}
        var objectTermUrl = {}
        var newSelect = {}
        var checkTrue = false
        let baseUrl = window.location.href.replace(window.location.search,'')

        $('.product__filters__checkbox input:checked').each(function () {
            objectTerm[$(this).attr('name')] = objectTerm[$(this).attr('name')] ? objectTerm[$(this).attr('name')] + ',' + $(this).val() : $(this).val()
            objectTermUrl[$(this).attr('name')] = objectTermUrl[$(this).attr('name')] ? objectTermUrl[$(this).attr('name')] + ',' + $(this).data('value') : $(this).data('value')
            checkTrue = true;
        })
        $('.product__filters__checkbox input').each(function () {
            newSelect[$(this).attr('name')] = [];
        })
        if (show) {
            $('.product_cat_electricRadiators').hide();
            $('.product_cat_electricRadiators__wrap').addClass('loading')

        }

        $('.product_cat_electricRadiators').each(function () {
            const item = $(this);
            let test = 0
            for (let key in objectTerm) {
                if (item.attr(key)) {
                    let value = objectTerm[key].split(','), valueCount = 0;
                    value.forEach(function (value, index, array) {
                        if (item.attr(key).split(',').includes(value)) {
                            valueCount++
                        }
                    })
                    if (value.length === valueCount) {
                        test++
                    }

                }
            }
            if (test === Object.keys(objectTerm).length) {
                if (show) {
                    item.show()
                }
                for (let key in newSelect) {
                    let chars = [...newSelect[key], ...item.attr(key).split(',')]
                    newSelect[key] = chars.filter((c, index) => {
                        return chars.indexOf(c) === index;
                    })
                }
                count++
            }
        })
        for (let key in objectTermUrl) {
            baseUrl = getUriWithParam(baseUrl, key, objectTermUrl[key])
        }
        history.pushState({}, null, baseUrl);

        if (Object.keys(newSelect).length) {
            if (show) {
                if (objectTerm.pa_wattage) {
                    $('.swiper-slide.variable').hide()
                    objectTerm.pa_wattage.split(',').forEach((value, index) => {
                        $(`.product__variations .swiper-slide.variable[data-pa_wattage=${value}]`).show().addClass('active')
                    })
                } else {
                    $(`.product__variations .swiper-slide.variable`).show().removeClass('active')
                }
            }
            priceHandler()

            for (let key in newSelect) {
                $(".product__filters__checkbox input[name=" + key + "]").each(function () {
                    let option = $(this)
                    if (!newSelect[key].includes(option.val())) {
                        option.parent().addClass('hidden')
                    } else {
                        option.parent().removeClass('hidden')
                    }
                })

            }
        }

        if (count == 0) {
            $('.btn-find .count').hide()
        } else {
            $('.btn-find .count').show()
            $('.btn-find .count').text(count)
            if (checkTrue) {
                $('.product_cat_electricRadiatorsMobileModal .btn-reset').removeClass('hide')
                $('.product_cat_electricRadiatorsMobileModal .btn-find').removeClass('hide')

            }
            if (show) {
                $('.product_cat_electricRadiators__main .count').text(count)
                $('.product_cat_electricRadiatorsMobileModal').removeClass('show')
                $('body').removeClass('product_cat_electricRadiatorsMobileModalShow')
                sliderUpdate()
                setTimeout(function () {
                    $('.product_cat_electricRadiators__wrap').removeClass('loading')

                },200)
            }
        }
        if (Object.keys(objectTerm).length === 0) {
            $('.product_cat_electricRadiatorsMobileModal .btn-reset').addClass('hide')

        }


    }


    $(document).click(function (event) {
        if ($('body').hasClass('product_cat_electricRadiatorsMobileModalShow') && !$(event.target).closest(".product_cat_electricRadiatorsMobileModal,.product__filters_topMobile").length) {
            closeMobileModal()
        }
    });
    $(".elementor-widget-custom-woo-product-loop-category .product__filters__checkbox input").change(function () {
        checkboxMobileFilter()
    })
    $(".elementor-widget-custom-woo-product-loop-category .btn-find").click(function (e) {
        e.preventDefault()
        checkboxMobileFilter(true)

        closeMobileModal()
    })
    $('.product_cat_electricRadiatorsMobileModal .close').click(function (e) {
        e.preventDefault()
        closeMobileModal()
    })
    $(".elementor-widget-custom-woo-product-loop-category .reset,.elementor-widget-custom-woo-product-loop-category .btn-reset").click(function (e) {
        e.preventDefault()
        priceHandler()
        sliderUpdate()

        $('.product_cat_electricRadiators').show()
        $('.product_cat_electricRadiators__main .reset').hide()
        $('.btn-find .count').text($('.product_cat_electricRadiators__wrap .product_cat_electricRadiators').length)

        $('.product_cat_electricRadiatorsMobileModal .btn-reset').addClass('hide')

        $(".product__filters__checkbox input").each(function () {
            $(this).prop('checked', false)
            $(this).parent().removeClass('hidden')
        })
        $(`.product__variations .swiper-slide.variable`).show().removeClass('active')

        history.pushState({}, null, window.location.href.replace(window.location.search,''));


    });
    $(".product__filters__checkbox h5").click(function () {
        $(this).toggleClass('show')
    })
    if(window.innerWidth<1024){
        $(".product__filters__checkbox h5").removeClass('show')
    }
    const closeMobileModal = () => {
        $('.product_cat_electricRadiatorsMobileModal').removeClass('show')
        $('body').removeClass('product_cat_electricRadiatorsMobileModalShow')
    }
    const openMobileModal = () => {
        $('.product_cat_electricRadiatorsMobileModal').addClass('show')
        $('body').addClass('product_cat_electricRadiatorsMobileModalShow')

    }
    $(".filter_mobile").click(function () {
        openMobileModal()
        if ($('.product__filters__checkbox h5.show')) {
            $('.product__filters__checkbox:first-child h5').addClass('show')
        }

    });
    var init = false;

    function sliderMain() {
        if (window.innerWidth <= 1225) {
            if (!init) {
                init = true;
                $('.product_cat_electricRadiators .swiper').each(function () {
                    const swiper = new Swiper($(this), {
                        loop: false,
                        init: true,
                        dots: false,
                        spaceBetween: 5,
                        slidesPerView: 'auto',
                        navigation: {
                            prevEl: $(this).find('.swiper-button-prev'),
                            nextEl: $(this).find('.swiper-button-next')
                        },
                        slideContent: '.swiper-wrapper',

                    })
                    setTimeout(function () {
                        swiper.update()
                    }, 1000)
                })

            }
        } else {
            $('.product_cat_electricRadiators .swiper').each(function () {
                $(this)
                if ($(this)[0].swiper) {
                    $(this)[0].swiper.destroy()
                    init = false;
                }
            })
        }
    }

    sliderMain();
    window.addEventListener("resize", sliderMain);


});

