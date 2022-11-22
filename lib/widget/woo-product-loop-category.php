<?php

namespace Elementor;

class CustomWooProductLoopCategory extends Widget_Base
{

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        add_action('wp_head', function () {
            wp_enqueue_style('ber-css-product-loop-category', get_stylesheet_directory_uri() . '/assets/css/widgets/woo-product-loop-category.css', array(), $script_version);

        });

    }


    public function get_script_depends()
    {
        return ['ber-js-product-loop-category'];
    }

    public function get_style_depends()
    {
        return ['ber-css-product-loop-category'];
    }

    public function get_name()
    {
        return "custom-woo-product-loop-category";
    }

    public function get_title()
    {
        return "Woo Product Loop Category";
    }

    public function get_icon()
    {
        return 'eicon-post-content';
    }

    public function get_keywords()
    {
        return ['woocommerce', 'shop', 'store', 'product',];
    }

    public function get_group_name()
    {
        return 'product';
    }

    public function get_categories()
    {
        return ['hello-elementor-theme'];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            'capital_content_section',
            [
                'label' => __('Layout', 'bestelectric'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'ids',
            [
                'label' => esc_html__('Term Id', 'bestelectric'),
                'placeholder' => esc_html__('18', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::TEXT,

            ]
        );
        $this->add_control(
            'sale-badge',
            [
                'label' => esc_html__('Sale Badge', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'False', 'elementor' ),
                    'true' => esc_html__( 'True', 'elementor' ),

                ],

            ]
        );
        $this->add_control(
            'sale-badge-image',
            [
                'label' => esc_html__('Sale Badge Image', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::MEDIA,


            ]
        );


        $this->end_controls_section();


    }

    public function renderTemplate()
    {
        $cat_args = '';


    }

    protected function renderTemplateItemHtml($args)
    {

        get_template_part('template-parts/block/woo-product-loop-category',null,$args);

    }

    protected function fixArrayKey($str)
    {
        $str = str_replace(" ", "_", $str);
        return str_replace(" ", "_", $str);
    }


    protected function render()
    {

        $id = get_edit_id_page();
        $setting = $this->get_settings();;


        global $product;

        $cat = get_queried_object();
        $parent_category [] = $cat->term_id ?: $setting['ids'];
        // If the product object is not defined, we get it from the product ID
        if (!is_a($product, 'WC_Product') && get_post_type($id) === 'product') {
            $product = wc_get_product($id);
        }


        if ($product && !is_tax()) {
            $cat = get_the_terms($product->get_id(), 'product_cat');
            foreach ($cat as $categoria) {
                if ($categoria->parent == 0) {
                    $parent_category[] = $categoria->term_taxonomy_id;
                }
            }
        }


        if ($setting['ids'])
            $parent_category[] = $setting['ids'];


        $cat_args = array(
            'product_cat' => array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $parent_category,
                'operator' => 'IN',
                'include_children' => false
            ),
            'relation' => 'AND',
            'product_visibility' => array(
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'exclude-from-catalog',
                'operator' => 'NOT IN',
            ),
        );

        $query_args = array(
            'status' => 'publish',
            'limit' => -1,
            'category' => $parent_category,
        );

        $data = [];
        foreach (wc_get_products($query_args) as $product) {
            foreach ($product->get_attributes() as $taxonomy => $attribute) {
                $attribute_name = wc_attribute_label($taxonomy); // Attribute name
                // Or: $attribute_name = get_taxonomy( $taxonomy )->labels->singular_name;

                foreach ($attribute->get_terms() as $term) {
                    $data[$taxonomy][$term->term_id]['name'] = $term->name;
                    $data[$taxonomy][$term->term_id]['slug'] = $term->slug;

                }
            }
        }
        $getParams = false;
        if (isset($_GET)) {
            foreach ($_GET as $key => $item) {
                if (array_key_exists($key, $data)) {
                    $getParams = true;

                }
            }
        }


        $products_args = array(
            'post_type' => 'any',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'asc',
            'tax_query' => $cat_args
        );
        wp_localize_script('ber-js-product-loop-category', 'CustomCustomWooProductLoopCategoryObjectObject', array(
            'cat_args' => $cat_args,
            'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        ));


        $data = [];
        $newTerm=[];
        foreach( wc_get_attribute_taxonomies() as $values ) {
            // Get the array of term names for each product attribute
            $term_names = get_terms( array('taxonomy' => 'pa_' . $values->attribute_name) );
            foreach ($term_names as $term){
                $data[$term->taxonomy][$term->term_id]=[];
            }
        }
        $products_loop = new \WP_Query($products_args);
        if ($products_loop->have_posts()) :
            while ($products_loop->have_posts()) : $products_loop->the_post();
                $product = wc_get_product(get_the_ID());
                foreach ($product->get_attributes() as $taxonomy => $attribute) {
                    $attribute_name = wc_attribute_label($taxonomy); // Attribute name
                    // Or: $attribute_name = get_taxonomy( $taxonomy )->labels->singular_name;
                    foreach ($attribute->get_terms() as $term) {
                        $data[$taxonomy][$term->term_id]['name'] = $term->name;
                        $data[$taxonomy][$term->term_id]['slug'] = $term->slug;
                        $data[$taxonomy][$term->term_id]['id'] = $term->term_id;
                    }
                }
            endwhile;
        endif;

        $icon_filter_html = Icons_Manager::render_font_icon(
            array("value" => "fas fa-filter",
                "library" => "fa-solid"
            ),
            array("aria-hidden" =>
                "true"
            ),
            "svg ");
        $icon_dropdown_html = Icons_Manager::render_font_icon(
            array("value" => "fas fa-chevron-down",
                "library" => "fa-solid"
            ),
            array("aria-hidden" =>
                "true"
            ),
            "svg ");

        ?>
        <style>
            .product_cat_electricRadiators__main .product_cat_electricRadiators {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                box-shadow: 0px 3px 35px #0000000D;
                margin-bottom: 50px;
            }

            .product_cat_electricRadiators .product_col__image {
                max-width: 27%;
                width: 100%;
                padding: 30px 20px 30px 40px;
                display: flex;
                flex-direction: column;
                align-items: center;
                position: relative;

            }

            .product_cat_electricRadiators .product_col__main {
                max-width: calc(47% - 30px);
                width: 100%;
                padding: 30px 0 20px 10px;
                margin-right: 30px;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
            }

            .product_cat_electricRadiators .product_col__price {
                max-width: 26%;
                width: 100%;
                background: #f2f2f2;
                padding: 30px 0 0;
                display: flex;
                flex-direction: column;
                justify-content: space-between;

            }

            .product_cat_electricRadiators__main .product__price .save {
                text-transform: none;
                font-size: 14px;
                line-height: 15px;
                color: #D9182B;
                margin-left: 5px;
                font-weight: 700;
                display: flex;
                flex-direction: column-reverse;
                text-align: start;
            }

            .product_cat_electricRadiators__main .product__price {
                text-align: center;
                padding-bottom: 16px;
                font-size: 16px;
                font-weight: 300;
                display: flex;
                align-items: baseline;
                justify-content: center;
                flex-wrap: wrap;
                text-transform: lowercase;
            }

            .product_cat_electricRadiators__main .product__price del {
                font-size: 14px;
                line-height: 15px;
                font-weight: 400;
                color: #333333;
                opacity: 0.5;

            }
            .product_cat_electricRadiators__main .product__price> del:first-child {
                display: none;
            }


            .product_cat_electricRadiators__main ins {
                text-decoration: none;
                margin-left: 5px;
            }


            .product_cat_electricRadiators__main .product-price__from {
                line-height: 24px;
                font-weight: 300;
                font-size: 20px;
                color: #333333;
            }

            .product_cat_electricRadiators__main .swiper {
                overflow: hidden;
                padding: 15px 5px 20px;
                position: relative;
                width: 100%;
            }

            .product_cat_electricRadiators__main .variable {
                max-width: 75px;
                width: 100%;
                box-shadow: 0px 8px 20px #00000029;
                background: #FFFFFF;
                margin: 4px;
                padding: 4px;
                max-height: 129px;
                overflow: visible;
                will-change: auto;
            }

            .product_cat_electricRadiators__main .cvy_product_thumbnail {
                min-height: 67px;
                max-width: 67px;
                max-height: 67px;
            }


            .product_cat_electricRadiators__main .product__variations .cvy_field_groups {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .product_cat_electricRadiators__main .product__variations {
                display: flex;
            }


            .product_cat_electricRadiators__main .cvy_tip {
                display: inline-block;
                position: relative;
            }

            .product_cat_electricRadiators__main .cvy_property_field {
                display: flex;
                align-items: flex-start;
            }

            .product_cat_electricRadiators__main .cvy_field_groups {
                padding-bottom: 5px;
            }

            .product_cat_electricRadiators__main .product_col__main.no-label .product__reviews {
                width: 100%;
            }

            .product_cat_electricRadiators__main .product__reviews {
                max-width: 150px;
                margin-bottom: 10px;
            }

            .product_cat_electricRadiators__main .product__wrapPopupWarrant .product__Popup {
                margin-top: 0;
            }

            .product_cat_electricRadiators__main .product__wrapPopupWarrant {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding-right: 20px;
                margin: 0 0 0;
            }

            .product_cat_electricRadiators__main .product__features-list {
                column-count: 2;
                padding: 0 0;
                width: 100%;
            }

            .product_col__main.no-label {
                justify-content: flex-end;
            }

            .product_cat_electricRadiators__main .product_title:hover {
                text-decoration: underline;
            }

            .product_cat_electricRadiators__main .product_title {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 10px;
                display: block;
                color: #333;
                width: 100%;
            }

            .product_cat_electricRadiators__main .product__reviews {
                max-width: 200px;
                background: #F7F7F7;
                padding-top: 10px;
                padding-right: 10px;
                position: relative;
            }

            .product_cat_electricRadiators__main .product__reviews__link {
                position: absolute;
                width: 100%;
                height: 100%;
                left: 0;
                top: 0;
                z-index: 1111;
            }

            .product_cat_electricRadiators__main .product__label {

                margin-bottom: 10px;

                border-radius: 30px;
                text-align: center;
                letter-spacing: 0px;
                color: #FFFFFF;
                background-color: #FC9E4E;
                padding: 7px 17px;
                font-size: 14px;
                line-height: 1;
                font-weight: 400;
                width: auto;
                display: inline-block;
            }

            .product_cat_electricRadiators__main .product__label.cvy_label--blue {
                background: #21A1BC;
            }

            .product_cat_electricRadiators__main li.list__item {
                list-style: disc;
                padding: 5px 0;
                margin-left: 20px;
                font-size: 13px;
                line-height: 18px;
            }

            .product_cat_electricRadiators__main .cvy_insulation_info {
                width: 12px;
                height: 12px;
                font-size: 8px;
                background: #e5e5e5;
                display: flex;
                position: relative;
                font-style: italic;
                color: #585858;
                font-weight: 700;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
            }

            .product_cat_electricRadiators__main .cvy_tip_content {
                visibility: hidden;
                padding: 15px;
                background: #E5E5E5;
                border-radius: 0;
                box-shadow: none;
                left: calc(50% - 116px);
                width: 222px;
                font-size: 14px;
                position: absolute;
                bottom: calc(100% + 18px);
                z-index: 0;
                opacity: 0;
                transition: .5s;
                text-align: center;
            }

            .product_cat_electricRadiators__main .cvy_area {
                font-size: 14px;
                color: #707070;
                line-height: 1;
            }

            .product_cat_electricRadiators__main .cvy_wattage {
                font-weight: bold;
                font-size: 16px;
                color: #707070;
                letter-spacing: 0px;
            }

            .product_cat_electricRadiators__main .product__lot20 {
                padding-top: 10px;
            }

            .product_cat_electricRadiators__main .product__payLater {
                font-size: 14px;
                line-height: 16px;
                color: #333333;
                text-align: center;
                max-width: 200px;
                margin: 0 auto 5px;
                font-weight: 600;
            }

            .product_cat_electricRadiators__main .product__payLater__icons {
                display: flex;
                justify-content: center;
            }

            .product_cat_electricRadiators__main .product__payLater__icons svg {
                margin: 0 5px;
            }

            .product_cat_electricRadiators__main .product__deliveryFooter svg {
                max-width: 30px;
                margin-right: 10px;
            }
            .product_cat_electricRadiators__main .product__deliveryFooter p{
                margin-bottom: 0;
            }

            .product_cat_electricRadiators__main .product__deliveryFooter {
                display: flex;
                align-items: center;
                justify-content: center;
                background: #F0F5D9;
                padding: 2px 5px;
                width: 100%;
                color: #77A464;
                font-size: 14px;
            }

            .product_cat_electricRadiators__main .product__delivery {
                font-size: 16px;
                font-weight: bold;
                line-height: 22px;
                text-align: center;
                margin: 10px 10px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .product_cat_electricRadiators__main .product__delivery_white {
                margin: 10px 25px;
                padding: 10px;
                background: white;
                color: #333333;
                line-height: 20px;
                font-size: 15px;
                text-align: center;
            }

            .product_cat_electricRadiators__main .product__button {
                display: block;
                margin: 10px 25px 8px;
                background: #B8D048;
                text-align: center;
                padding: 10px;
                font-weight: bold;
                font-size: 14px;
                text-transform: uppercase;
                color: white;
            }

            .product_cat_electricRadiators__main .product__learnMore:hover {
                color: white;
                background-color: #333333;;
            }

            .product_cat_electricRadiators__main .product__learnMore {
                display: block;
                padding: 10px;
                border: 1px solid #333333;
                margin: 8px 25px 20px;
                color: #333333;
                text-transform: uppercase;
                font-weight: bold;
                font-size: 12px;
                text-align: center;
                transition: all .5s;
            }

            .product_cat_electricRadiators__main .product__button:hover {
                background: rgba(184, 208, 72, 0.85);
            }

            .product_cat_electricRadiators__main .product_titleMob {
                display: none;
            }

            .product_cat_electricRadiators__main {
                display: flex;
                flex-wrap: wrap;
            }

            .product_cat_electricRadiators__main .product_cat_electricRadiators__filter {
                max-width: 15%;
                width: 100%;
                padding-right: 30px;
            }

            .product_cat_electricRadiators__wrap {
                max-width: 84.9%;
                width: 100%;
            }

            .product_cat_electricRadiators__main .product__filters__selects {
                display: flex;
                flex-direction: column;
            }

            .product_cat_electricRadiators__main .product__filters_top {
                display: flex;
                align-items: center;
                padding-bottom: 20px;
                font-size: 12px;
            }

            .product_cat_electricRadiators__main .filter_mobile svg,
            .product_cat_electricRadiators__main .product__delivery svg {
                width: 1rem;
                height: 1rem;
                margin-right: 5px;
            }

            .product_cat_electricRadiators__main .product__filters_top svg {
                width: 0.75rem;
                height: 0.75rem;
                margin-right: 5px;

            }

            .product_cat_electricRadiators__main .filter_mobile {
                cursor: pointer;
            }

            .product_cat_electricRadiators__main .filter_mobile,
            .product_cat_electricRadiators__main .product__flex {
                display: flex;
                align-items: center;


            }

            .product_cat_electricRadiators__main .product__filters_topMobile .woocommerce-ordering {
                margin: 0;
            }

            .product_cat_electricRadiators__main .product__filters_topMobile__order,
            .product_cat_electricRadiators__main .product__filters__select {
                margin-bottom: 20px;
                border: none;
                border-radius: 0;
                font-size: 16px;
                font-weight: bold;
                padding: 4px 0;
                background-color: white;
                -webkit-appearance: menulist;
            }

            .product_cat_electricRadiators__main .product__lot20__wrap {
                display: flex;
                align-items: center;
                font-size: 20px;
                line-height: 24px;
                color: #707070;
                font-weight: bold;
            }

            .product_cat_electricRadiators__main .product__lot20__desc {
                color: #707070;
                font-size: 10px;
                line-height: 12px;

            }

            .product_cat_electricRadiators__main .product__lot20__title {
                margin-left: 5px;
            }

            .product_cat_electricRadiators__main .product_col__price_col {
                display: flex;
                flex-direction: column;
                height: 100%;
                justify-content: space-between;
            }

            .product_cat_electricRadiators__main .product__filters_topMobile {
                display: none;
            }

            .product_cat_electricRadiators__main .swiper-container-initialized .swiper-button-next svg, .swiper-container-initialized .swiper-button-prev svg {
                width: 1rem;
                height: 1rem;
            }

            .product_cat_electricRadiators__main .swiper-container-initialized .swiper-button-next, .swiper-container-initialized .swiper-button-prev {
                position: absolute;

                width: 50px;
                height: 100%;
                margin-top: 0;
                z-index: 10;
                cursor: pointer;
                background-color: white;
                right: 0;
                top: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background-image: none;
                padding: 10px;
                font-size: 10px;
            }

            .product_cat_electricRadiators__wrap .swiper:not(.slider-desktop) .swiper-button-prev,
            .product_cat_electricRadiators__wrap .swiper:not(.slider-desktop) .swiper-button-next {
                display: none;
            }

            .product_cat_electricRadiators__main .swiper-button-prev, .product_cat_electricRadiators__main .swiper-container-rtl .swiper-button-next {
                left: 0;
                right: auto;
            }

            .product_cat_electricRadiators__main
            .swiper-button-next.swiper-button-disabled, .product_cat_electricRadiators__main .swiper-button-prev.swiper-button-disabled {
                opacity: 0;
                z-index: -1;
                visibility: hidden;

            }

            .product_cat_electricRadiators__main .reset {
                cursor: pointer;
            }

            .product_cat_electricRadiators__main .cvy_insulation_info:hover ~ .cvy_tip_content {
                visibility: visible;
                opacity: 1;
                text-align: center;
                font-size: 14px;
                z-index: 111;
            }


            .product__filters__checkbox {
                display: flex;
                flex-direction: column;
                margin-bottom: 20px;
            }

            .product__filters__checkbox label input {
                visibility: hidden;
                opacity: 0;
                height: 0;
                width: 0;
                margin: 0;
                display: none;
            }

            .product__Popup {
                margin-top: 10px;
                cursor: pointer;
            }


            .product__filters__checkbox label {
                display: none;
                margin: 5px 0;
                cursor: pointer;
            }

            .product__filters__checkbox label span {
                display: flex;
                align-items: center;
                color: #707070;
            }

            .product__filters__checkbox label span:before {
                content: '';
                position: relative;

                width: 21px;
                height: 21px;

                border: 1px solid #707070;
                background-color: white;
                display: inline-block;
                margin-right: 10px;
            }

            .product__filters__checkbox input:checked ~ span:before {
                background-image: url("<?php echo home_url()?>/wp-content/themes/bestelectric/img/icons/black-checkbox-icon.svg");
                background-size: auto;
                background-position: center;
                background-repeat: no-repeat;

            }

            .product__filters__checkbox h5 svg {
                height: 1.2rem;
                width: 1.2rem;
                margin-left: 10px;
            }

            .product__filters__checkbox h5 {
                display: flex;
                align-items: center;
                font-size: 16px;
                color: #707070;
                line-height: 19px;
                font-weight: 400;
                margin-bottom: 10px;
                cursor: pointer;
            }

            .product__filters__checkbox h5.show ~ label {
                display: block;
            }

            .product__filters__checkbox h5.show svg {
                transform: rotate(180deg);
            }

            .product_cat_electricRadiatorsMobileModal.show {
                left: 0;
            }

            .buttons {
                display: flex;
                align-items: center;
                justify-content: space-between;

            }

            .btn-reset {
                padding: 3px 15px;
                border: 1px solid #333333;
                color: #333333;
                font-size: 12px;
                line-height: 22px;
                cursor: pointer;
            }

            .checkboxs {
                padding-top: 30px;
            }

            .btn-find {
                background: #B8D048;
                color: white;
                font-size: 15px;
                line-height: 40px;
                padding: 3px 15px;
                cursor: pointer;
            }

            .product__filters__checkbox label.hidden {
                opacity: 0.6;
                pointer-events: none;
            }

            .btn-reset.hide {
                opacity: 0;
                visibility: hidden;
            }

            body.product_cat_electricRadiatorsMobileModalShow:before {
                content: '';
                position: fixed;
                width: 100%;
                height: 100%;
                background: #0000008f;
                z-index: 1111;
                left: 0;
                top: 0;
            }

            .product_cat_electricRadiatorsMobileModal .close {
                display: flex;
                width: 25px;
                height: 25px;
                border: 1px solid;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
                font-size: 25px;
                line-height: 1;
                float: right;
                cursor: pointer;
            }

            .product_cat_electricRadiatorsMobileModal h4 {
                padding-top: 40px;
            }

            .btn-find.hide {
                display: none;
            }


            .loading.product_cat_electricRadiators__wrap {
                opacity: .4;
            }

            a.product__reviews__link:before {
                content: '';
                width: 23px;
                background: #F7F7F7;
                position: absolute;
                right: 0;
                top: 0;
                height: 100%;
            }
            .product_featured__image .bl-fr{
                position: absolute;
                right: 30px;
                top: 40px;
                max-width: 70px;
            }

            @keyframes bg-pulse {
                0%, 100% {
                    transform: scale(1);
                }
                50% {
                    transform: scale(1.02);
                }
            }


            @media screen and (max-width: 1325px)  and (min-width: 1025px) {
                .product_cat_electricRadiators__main .product_cat_electricRadiators__wrap {
                    max-width: 79.9%;
                    padding: 0 15px;
                }

                .product_cat_electricRadiators__main .product_col__main {
                    overflow: hidden;
                }

                .product_cat_electricRadiators__main .product_cat_electricRadiators__filter {
                    max-width: 20%;
                    padding: 0 15px;
                }
            }
            .product__price >.woocommerce-Price-amount:first-child{
                margin-left: 5px;
            }
            @media screen and (min-width: 1025px) {


                .product_col__main .swiper:not(.slider-desktop) .product__variations.swiper-wrapper {
                    transform: translate3d(0px, 0px, 0px) !important;
                }


                .product_cat_electricRadiatorsMobileModal {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-end;
                }

                .product_cat_electricRadiatorsMobileModal .main {
                    width: 100%;
                }

                .product_cat_electricRadiatorsMobileModal .top {
                    display: none;
                }

                .product_cat_electricRadiatorsMobileModal .btn-reset {
                    margin-bottom: 10px;
                }

                .product__filters__checkbox h5 {
                    justify-content: space-between;
                }

                .product_cat_electricRadiatorsMobileModal .buttons {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-end;
                }

                .product_cat_electricRadiatorsMobileModal .checkboxs {
                    padding-top: 10px;
                }
            }

            @media screen and (max-width: 1024px) {

                .product_cat_electricRadiatorsMobileModal .checkboxs {
                    overflow: auto;
                    max-height: calc(100vh - 189px);
                }

                .product_cat_electricRadiatorsMobileModal {
                    position: fixed;
                    width: 280px;
                    padding: 28px;
                    left: -350px;
                    height: 100%;
                    background: white;
                    z-index: 111111;
                    top: 0;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    transition: all 0.3s;
                }

                .product_cat_electricRadiators__main .product_col__image {
                    max-width: 39.9%;
                }

                .product_cat_electricRadiators__main .product_col__main {
                    max-width: calc(59.9% - 30px);
                }

                .product_cat_electricRadiators__main .product_col__price {
                    max-width: 100%;
                    flex-direction: row;
                    flex-wrap: wrap;
                    padding-top: 10px;
                }

                .product_cat_electricRadiators__main .product_col__price_col-1, .product_cat_electricRadiators__main .product_col__price_col-2 {
                    max-width: 49.9%;
                    padding: 0 5px;
                    width: 100%;
                }

                .product_cat_electricRadiators__main .product_col__price_col {
                    max-width: 100%;
                    flex-direction: row;
                    flex-wrap: wrap;
                    width: 100%;
                    height: auto;
                }

                .product_cat_electricRadiators__main .product_cat_electricRadiators__filter,
                .product_cat_electricRadiators__main .product_cat_electricRadiators__wrap {
                    max-width: 100%;
                }

                .product_cat_electricRadiators__main .product__filters_topDest {
                    display: none;
                }

                .product_cat_electricRadiators__main .product__filters_topMobile {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .product_cat_electricRadiators__filter_modal .product__filters__selects {
                    display: flex;
                }

                .product_cat_electricRadiators__main .product_cat_electricRadiators__filter {
                    padding: 10px;
                    margin-bottom: 10px;

                }

                .product_cat_electricRadiators__main .product__filters_topMobile__order {
                    font-weight: 400;
                    margin-bottom: 0;
                }

                .
            }


            @media screen and (min-width: 756px) {
                .product_cat_electricRadiators__main ins .amount,
                .product_cat_electricRadiators__main .product__price > .amount {
                    font-weight: bold;
                    font-size: 30px;
                    line-height: 36px;
                    color: #333333;

                }
            }

            @media screen and (max-width: 756px) {
                .product_featured__image .bl-fr{

                    right: 20px;
                    top: 20px;
                }
                .product_cat_electricRadiators__wrap .swiper:not(.slider-desktop) .swiper-button-next {
                    display: flex;
                }

                .product_cat_electricRadiators__main .product__price {
                    text-align: left;
                    padding-left: 8px;
                    margin-bottom: 5px;
                    flex-wrap: nowrap;
                    justify-content: flex-start;

                }

                .product_cat_electricRadiators__main .product_title {
                    margin-bottom: 0;
                }

                a.product__reviews__link:before {
                    right: calc(50% + -110px);
                }

                .product_cat_electricRadiators__main .product__label,
                .product_cat_electricRadiators__main .product_titleMob {
                    order: 0;
                }

                .product_cat_electricRadiators__main .product__reviews {
                    order: 1;
                }

                .product_cat_electricRadiators__main .cvy_tip_content {
                    display: none;
                }

                .product_cat_electricRadiators__main .variable {
                    min-width: 75px;
                    max-height: 120px;
                    box-shadow: 0 4px 10px #00000029;
                }

                .product_cat_electricRadiators__main .cvy_property_field a {
                    line-height: 1;
                }

                .product_cat_electricRadiators__main .product__delivery {
                    font-size: 12px;
                    line-height: 17px;
                    margin: 3px;
                }

                .product_cat_electricRadiators__main .product__delivery_white {
                    font-size: 10px;
                    line-height: 13px;
                    margin: 7px 15px 7px 5px;
                    padding: 4px 18px;
                }

                .product_cat_electricRadiators__main .product__learnMore {
                    font-size: 10px;
                    line-height: 10px;
                    font-weight: 400;

                    margin: 4px 15px 4px 5px;
                    padding: 8px;
                }

                .product_cat_electricRadiators__main.product__button {
                    font-size: 12px;
                    line-height: 13px;
                    font-weight: 400;
                    margin-bottom: 4px;
                    padding: 8px;
                }

                .product_cat_electricRadiators__main .product_col__price_col-2 {
                    max-width: 53.9%;
                }

                .product_cat_electricRadiators__main .product_col__price_col-1 {
                    max-width: 45.9%;
                }

                .product_cat_electricRadiators__main .product__variations {
                    order: 1;
                    padding: 10px 0 5px;
                }

                .product_cat_electricRadiators .swiper.swiper-container-initialized {
                    overflow: hidden;
                    display: flex;
                    position: relative;
                    order: 1;
                    padding: 5px 5px 10px;
                }

                .product_cat_electricRadiators .swiper.swiper-container-initialized .swiper-wrapper {
                    height: auto;
                }

                .product_cat_electricRadiators__main .product__features-list {
                    order: 2;
                    column-count: 1;
                    display: flex;
                    justify-content: center;
                    flex-wrap: wrap;
                    padding: 10px 0 10px 0;
                }

                .product_cat_electricRadiators__main li.list__item {
                    padding: 0;
                    margin-left: 30px;
                    font-size: 12px;
                    line-height: 18px;
                }

                .product_cat_electricRadiators__main .product__Popup {
                    margin-top: 0;
                }

                .product_cat_electricRadiators__main .product-price__from {
                    line-height: 1;
                    font-size: 14px;
                }

                .product_cat_electricRadiators__main .product__button {
                    margin: 8px 15px 8px 5px;
                    padding: 10px;
                    font-size: 12px;
                    line-height: 10px;
                }

                .product_cat_electricRadiators__main .product__Popup svg {
                    margin-bottom: 10px !important;
                    z-index: 11;
                    position: relative;
                    background: white;
                    max-width: 149px;
                }

                .product_cat_electricRadiators__main .product__wrapPopupWarrant {
                    order: 3;
                    justify-content: center;
                    margin: 0;
                    padding-right: 0;
                }

                .product_cat_electricRadiators__main .product_titleDes {
                    display: none;
                }


                .product_cat_electricRadiators__main .product_featured__image img {
                    max-height: 295px;
                    object-fit: cover;
                }

                .product_cat_electricRadiators__main .product_titleMob {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    padding-top: 15px;
                    padding-bottom: 10px;
                }

                .product_cat_electricRadiators__main .amount {
                    font-size: 18px;
                    line-height: 22px;
                    font-weight: bold;
                }

                .product_cat_electricRadiators__main .product__price del,
                .product_cat_electricRadiators__main .product__price del .amount {
                    font-size: 12px;
                    line-height: 12px;
                    height: 14px;
                }

                .product_cat_electricRadiators__main .product__price .save {
                    font-size: 12px;
                    line-height: 12px;
                }

                .product_cat_electricRadiators__main .product__price del {
                    margin: 0 5px 0 0;
                }


                .product_cat_electricRadiators__main .product__payLater {
                    font-size: 12px;
                    line-height: 14px;
                    margin: 6px 0;
                    text-align: left;
                    padding-left: 8px;
                }

                .product_cat_electricRadiators .product_col__main {
                    max-width: 100%;
                    display: flex;
                    flex-direction: column;
                    padding: 30px 15px 0;
                    overflow: hidden;
                    margin-right: 0;
                }

                .product_titleMob .product__wrapPopupWarrant__Warrant {
                    min-width: 95px;
                    margin-left: 10px;
                }

                .product_cat_electricRadiators .product_col__image {
                    max-width: 100%;
                    padding: 0;

                }

                .product_cat_electricRadiators__main .product__label {
                    margin: -15px auto 0;
                    font-size: 13px;
                }

                .product__wrapPopupWarrant .product__wrapPopupWarrant__Warrant {
                    display: none;
                }

                .product_cat_electricRadiators__main .product__reviews {
                    max-width: 100%;
                    padding-bottom: 5px;
                    margin-bottom: 0;
                }

                .product_cat_electricRadiators__main .product__lot20 {
                    display: none;
                }

                .product_cat_electricRadiators__main .product_cat_electricRadiators {
                    margin-bottom: 20px;
                }

            }

            @media screen and (max-width: 567px) {
                .product__payLater__icons svg {
                    max-height: 30px;

                }

                .product_cat_electricRadiators__wrap .swiper .swiper-button-prev,
                .product_cat_electricRadiators__wrap .swiper .swiper-button-next {
                    display: flex;
                }
            }

        </style>

        <div class="product_cat_electricRadiators__main">
            <div class="product_cat_electricRadiators__filter">
                <div class="product_cat_electricRadiators__filter__sticky">
                    <div class="product__filters_top product__filters_topDest">
                        <div class="product__flex">
                            <?php echo $icon_filter_html; ?>
                            Filters
                        </div>
                        <span style="color: #E3E3E3;margin: 0 10px;"> | </span>
                        <div><span class="count"><?php echo $products_loop->post_count ?></span> Results</div>
                    </div>
                    <div class="product__filters_topMobile">
                        <div class="filter_mobile">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="23.012" viewBox="0 0 25 23.012">
                                <g transform="translate(-38.5 -967)">
                                    <g transform="translate(38.5 967)">
                                        <line x2="25" transform="translate(0 2.983)" fill="none" stroke="#333"
                                              stroke-width="1"/>
                                        <line x2="25" transform="translate(0 11.506)" fill="none" stroke="#333"
                                              stroke-width="1"/>
                                        <line x2="25" transform="translate(0 20.029)" fill="none" stroke="#333"
                                              stroke-width="1"/>
                                        <g transform="translate(2.131)" fill="#fff" stroke="#333" stroke-width="1">
                                            <circle cx="2.983" cy="2.983" r="2.983" stroke="none"/>
                                            <circle cx="2.983" cy="2.983" r="2.483" fill="none"/>
                                        </g>
                                        <g transform="translate(2.131 17.046)" fill="#fff" stroke="#333"
                                           stroke-width="1">
                                            <circle cx="2.983" cy="2.983" r="2.983" stroke="none"/>
                                            <circle cx="2.983" cy="2.983" r="2.483" fill="none"/>
                                        </g>
                                        <g transform="translate(15.768 8.523)" fill="#fff" stroke="#333"
                                           stroke-width="1">
                                            <circle cx="2.983" cy="2.983" r="2.983" stroke="none"/>
                                            <circle cx="2.983" cy="2.983" r="2.483" fill="none"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            Filters
                        </div>


                    </div>
                    <div class="product__filters__selects">
                        <div class="product_cat_electricRadiatorsMobileModal ">

                            <div class="main">
                                <div class="top">
                                    <div class="close">&times;</div>
                                    <h4><?php _e('Refine'); ?></h4>
                                </div>

                                <div class="checkboxs">
                                    <?php
                                    unset($data['pa_brand']);

                                    foreach ($data as $keyD => $datum) {


                                        foreach ($datum as $termID => $term) {
                                            if(empty($term['name'])){
                                                unset($datum[$termID]);
                                            }
                                        }

                                        if (count($datum) >= 1) {
                                            echo '<div class="product__filters__checkbox dropdown_layered_nav_' . esc_attr($keyD) . '" name="' . esc_attr($keyD) . '">';
                                            echo '<h5 class="show">' . esc_html(str_replace(':', '', wc_attribute_label($keyD))) . $icon_dropdown_html . '</h5>';
                                            foreach ($datum as $termID => $term) {
                                                $checked = isset($_GET[$keyD]) && in_array($term['name'], explode(',', $_GET[$keyD])) ? 'checked' : ' ';
                                                echo '<label><input type="checkbox" ' . $checked . '  name="' . esc_attr($keyD) . '" data-value="' . urlencode($term['name']) . '" value="' . esc_attr(urldecode($term['id'])) . '" id="' . esc_html($term['name']) . '_' . esc_attr(urldecode($term['id'])) . '" /><span> ' . esc_html($term['name']) . '</span> </label>';
                                            }
                                            echo '</div>';;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="buttons">
                                <div class="btn-reset hide">
                                    <?php _e('Clear All'); ?>
                                </div>
                                <div class="btn-find hide">
                                    View <span class="count"><?php echo $products_loop->post_count ?></span> Results
                                    <?php _e(''); ?>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="product_cat_electricRadiators__wrap <?php echo $getParams ? ' loading ' : ' ' ?>">
                <?php if ($products_loop->have_posts()) :
                    while ($products_loop->have_posts()) : $products_loop->the_post();

                        $this->renderTemplateItemHtml($setting);
                    endwhile;endif;

                wp_reset_postdata();; ?>
            </div>

        </div>


        <?php
    }


    public function render_plain_content()
    {
        if (isset($_GET['orderby'])) {
            switch ($_GET['orderby']) {
                case 'price':
                    $products_args['orderby'] = 'meta_value_num';
                    $products_args['meta_key'] = '_price';
                    $products_args['order'] = 'asc';
                    break;
                case 'date':
                    $products_args['orderby'] = 'date';
                    break;

                case 'price-desc':
                    $products_args['orderby'] = 'meta_value_num';
                    $products_args['meta_key'] = '_price';
                    $products_args['order'] = 'desc';
                    break;

                case 'rating':
                    $products_args['orderby'] = 'meta_value_num';
                    $products_args['meta_key'] = '_wc_average_rating';
                    $products_args['order'] = 'desc';
                    break;

                case 'popularity':
                    $products_args['orderby'] = 'meta_value_num';
                    $products_args['meta_key'] = 'total_sales';
                    $products_args['order'] = 'desc';
                    break;
            }
        }
        ?>
        <div>
            <?php
            $Sort =
                array(
                    'popularity' => __('Sort by popularity', 'woocommerce'),
                    'rating' => __('Sort by average rating', 'woocommerce'),
                    'date' => __('Sort by latest', 'woocommerce'),
                    'price' => __('Sort by price: low to high', 'woocommerce'),
                    'price-desc' => __('Sort by price: high to low', 'woocommerce'),
                ); // Defined product attribute taxonomies.


            echo '<select class="product__filters_topMobile__order product__filters__select" name="orderby">';
            echo '<option hidden value="">Recommended</option>';
            foreach ($Sort as $orderSlug => $orderName) {
                $option_is_set = false;
                if (isset($_GET)) {
                    $option_is_set = in_array($orderSlug, $_GET, true);
                }
                echo '<option value="' . esc_attr(urldecode($orderSlug)) . '" ' . selected($option_is_set, true, false) . '>' . esc_html($orderName) . '</option>';
            }

            echo '</select>';;

            ?>
        </div>
        <?php
    }
}

global $widgets;
$loopCategory = new \Elementor\CustomWooProductLoopCategory();

$widgets->register($loopCategory);
