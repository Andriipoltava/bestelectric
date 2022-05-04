/**
 * Product Page.
 */

(function ($) {

    $(document).ready(function () {

        if (jQuery().fancybox) {

            $('.js--open-video-popup').fancybox({
                // youtube : {
                //     controls : 0,
                //     showinfo : 0
                // }
            });
            $('#view_360').fancybox({
                touch: false,
                afterShow: function (instance, slide) {
                    $('.reel').click();
                }
            });



        }
        
        $('form.variations_form').on('show_variation', function (event, data) {
            $('.JS--product-availability').html(data.availability_html);
            $('.JS--product-availability').addClass('is-loaded');
        });

        $('body').on('click', '.cvy_tip', function (e) {
            if ($(window).width() <= 1024) {
                e.preventDefault();
                e.stopPropagation();
            }
        });


	       if ($('.product_cat-electric-towel-rails').length !== 0) {
	           var productPriceClone = $('.woocommerce-variation').clone();
	           $('.JS--quantity-minus').before(productPriceClone);
	           var wattageLabel = $(".variations tr:last-child label").attr("for", 'pa_wattage');

	           var optionsButtons = '';
	           wattageLabel.addClass('c-options-btns-label').append(optionsButtons);
	           if (wattageLabel.length !== 0) {
	               setTimeout(function () {
	                   wattageLabel.addClass('is-loaded');
	               }, 300);
	           }
	       }



        $('form.cart').on('click', '.JS--quantity-plus,.JS--quantity-minus', function (e) {
            e.preventDefault();
            e.stopPropagation();
            // Get current quantity values
            var qty = $(this).closest('form.cart').find('.qty');
            var val = parseFloat(qty.val());
            var max = parseFloat(qty.attr('max'));
            var min = parseFloat(qty.attr('min'));
            var step = parseFloat(qty.attr('step'));

            // Change the value if plus or minus
            if ($(this).is('.JS--quantity-plus')) {
                if (max && (max <= val)) {
                    qty.val(max);
                } else {
                    qty.val(val + step);
                }
            } else {
                if (min && (min >= val)) {
                    qty.val(min);
                } else if (val > 1) {
                    qty.val(val - step);
                }
            }

        });


        $('.JS--open-calculator').on('click', function () {
            $('#product-options').slideDown(300);
            setTimeout(function () {
                $('html,body').animate({
                    scrollTop: $('#product-options').offset().top
                }, 500);
                return false;
            }, 400);
        });

        $('.close-calculator').on('click', function () {
            $('#product-options').slideUp(300);
        });



        if ($('.JS--tustpilot-loader').length !== 0) {
            setTimeout(function () {
                $('.JS--tustpilot-loader').addClass('is-loaded');
            }, 50);
        }

        if ($('.product_cat-electric-radiators').length !== 0 || typeof ($('.product_cat-electric-radiators')) !== 'undefined') {
            if ($('.variations').length !== 0) {
                var rowLength = $('.variations').find('tr').length;

                setTimeout(function () {

                    if (rowLength >= 3) {
                        $('.variations tr:nth-child(3)').find('td.value').addClass('is-loaded');
                    } else {
                        $('.variations tr:nth-child(2)').find('td.value').addClass('is-loaded');
                    }

                }, 300);

                $('.product_cat-electric-radiators .variations select').on('change', function () {
                    var _this = $(this);
                    setTimeout(function () {
                        var newPrice = _this.closest('.variations_form').find('.woocommerce-variation-price .price').html();
                        //var availabilityProduct = _this.closest('.variations_form').find('.woocommerce-variation-availability').html();
                        //$('.JS--product-availability').html(availabilityProduct);
                        $('.JS--top-product-price').html(newPrice);
                        $('.variations_button__bottom .price .woocommerce-Price-amount').html(newPrice);
                    }, 30);

                });

            }
        }

        if($('.product_upsells').length !== 0){

        }else{



            $('.product:not(.product_cat-electric-radiators) .variations select').on('change', function () {
                var _this = $(this);
                setTimeout(function () {
                    var newPrice = _this.closest('.variations_form').find('.woocommerce-variation-price .price').html();
                    //var availabilityProduct = _this.closest('.variations_form').find('.woocommerce-variation-availability').html();
                    //$('.JS--product-availability').html(availabilityProduct);
                    $('.JS--top-product-price').html(newPrice);
                    $('.JS--mobile-price').html(newPrice);
                    //$('<div class=" woocommerce-variation single_variation">'+newPrice+'</div>').insertBefore('.product-cart-inc');
                }, 30);

            });
        }



        var simpleProductPrice = $('.product-type-simple').find('.JS--top-product-price').html();
        var singleProductPriceBefore = $('.product-type-simple').find('.product-cart-inc');
        $('<div class="simple-product-mobile-price">'+simpleProductPrice+'</div>').insertBefore(singleProductPriceBefore);

        if ($('.o-product-top__img').length !== 0 && $('.gallery-thumbs').length !== 0) {
            setTimeout(function () {
                var productThumbGallery = document.querySelector('.gallery-thumbs').swiper;
                productThumbGallery.params.threshold = 100;
            }, 100);

        }

    });


    function includeSortType(currentColor, currentTypes) {
        $('.variations tr:last-child .button-variable-wrapper').not('.JS--radiators-select').find('li').each(function () {
            var dataColorType = $(this).attr('data-attribute_pa_colour');
            var dataTypes = $(this).attr('data-attribute_pa_el_type');
            if (dataTypes !== currentTypes || dataColorType !== currentColor) {
                $(this).addClass('hidden-by-type');
            } else {
                $(this).removeClass('hidden-by-type');
            }
        });
    }

    function includeSortSizeType(currentTypes) {
        $('.variations tr:last-child .button-variable-wrapper').not('.JS--radiators-select').find('li').each(function () {
            //var dataSize = $(this).attr('data-attribute_pa_size');
            var dataTypes = $(this).attr('data-attribute_pa_el_type');
            if (dataTypes !== currentTypes) {
                $(this).addClass('hidden-by-type');
            } else {
                $(this).removeClass('hidden-by-type');
            }
        });
    }

    function initSelectedItems(currentTypeVal) {
        $('.variations tr:last-child .button-variable-wrapper .cvy_variation_list_item:not([data-attribute_pa_el_type="' + currentTypeVal + '"])').removeClass('currentActive').addClass('no-match');
    }

    /*    function initSelectedTowelItems(currentTypeVal) {
            $('.variations tr:last-child .button-variable-wrapper .cvy_variation_list_item[data-attribute_pa_el_type!="' + currentTypeVal + '"]').removeClass('currentActive').addClass('no-match');
        }*/


    function insertSelectedItemClone() {
        var cloneSelectedItem = $('.variations tr:last-child .button-variable-wrapper .selected').not('.no-match').clone();
        $('.JS--radiators-select').prepend(cloneSelectedItem);
    }


})(jQuery);






