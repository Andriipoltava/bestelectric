(function ($) {
    const ProductTechTabs = function ($scope, $) {
        const productTechSpecTabsNav = $scope.find('.JS--product-tech-tab-nav');
        const productTechSpecTabsContent = $scope.find('.JS--product-specs-tab');

        if(productTechSpecTabsNav.length !== 0){
            productTechSpecTabsNav.on('click',function(){
                var dataSpec = $(this).attr('data-spec-tab');
                productTechSpecTabsNav.filter("[data-spec-tab!=" + dataSpec + "]").removeClass('is-active');
                $(this).addClass('is-active');
                productTechSpecTabsContent.filter("[data-spec-tab!=" + dataSpec + "]").hide();
                productTechSpecTabsContent.filter("[data-spec-tab=" + dataSpec + "]").fadeIn(300);

                var currentTarger = productTechSpecTabsContent.filter("[data-spec-tab=" + dataSpec + "]");
                if($(window).width() < 768){
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
