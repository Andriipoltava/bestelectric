<?php

namespace Elementor;

class CustomWooProductHeader extends Widget_Base
{
    public function get_style_depends()
    {
        return ['ber-css-woo-header'];
    }

    public function get_script_depends()
    {
        return ['ber-js-product-header'];
    }

    public function get_name()
    {
        return "custom-woo-product-header";
    }

    public function get_title()
    {
        return "Woo Single  Header";
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
        $repeater = new Repeater();

        $repeater->start_controls_tabs('menu_repeater');


        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'bestelectric'),
            ]);

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Second Image Link', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::URL,

            ]
        );


        $repeater->end_controls_tabs();

        $this->add_control(
            'menu',
            [
                'label' => esc_html__('Menu', 'bestelectric'),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'fields' => $repeater->get_controls(),

            ]
        );


        $this->end_controls_section();


    }


    protected function render()
    {

        $id = get_edit_id_page();
        global $product;
        // If the product object is not defined, we get it from the product ID
        if (!is_a($product, 'WC_Product') && get_post_type($id) === 'product') {
            $product = wc_get_product($id);
        }
        if (get_post($id)->post_type !== 'product') {
            return '';
        }

        $settings = $this->get_settings();
        ?>
        <div id="singleWooHeader" class="singleWooHeader__wrap" style="opacity: 0;display: none">
            <div class="singleWooHeader__item">
                <?php if (isset($settings['menu']) && count($settings['menu'])) { ?>
                    <ul class="singleWooHeader__item__menu">
                        <?php foreach ($settings['menu'] as $item) {
                            ?>
                            <li><a href="<?php echo $item['link']['url']?:'' ?>"
                                   title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a></li>
                        <?php }; ?>
                    </ul>
                    <div>
                        <select name="" id="" class="singleWooHeader__item__select">
                            <?php foreach ($settings['menu'] as $item) {
                                ?>
                                <option value="<?php echo $item['link']['url']?:'' ?>"><?php echo $item['title'] ?></option>
                            <?php }; ?>
                        </select>
                    </div>
                <?php } ?>
            </div>
            <div class="singleWooHeader__item">
                <div class="singleWooHeader__item__price">
                    <span class="o-product-top__from"><?php _e('From  '); ?></span>
                    <span class="price"><?php $this->widget_pricing($product); ?>               </span>
                    <span class="o-product-top__price--inc"><?php _e('inc. VAT', 'bestelectric'); ?></span>


                </div>

                <a href="#woocommerce_single_product_summary" class="singleWooHeader__item__buy">
                    BUY <span>NOW</span>
                </a>
            </div>

        </div>
        <?php
    }

    public
    function widget_pricing($product)
    {
        if (isset($_GET['attribute_pa_wattage'])) :
            $variations = $product->get_available_variations();

            foreach ($variations as $key => $variation) :
                if (!array_key_exists('attribute_pa_el_type', $variation['attributes'])) :
                    if ($variation['attributes']['attribute_pa_wattage'] == $_GET['attribute_pa_wattage'] && $variation['attributes']['attribute_pa_colour'] == 'white') :
                        echo $variation['price_html'];
                    endif;
                else :
                    if ($variation['attributes']['attribute_pa_wattage'] == $_GET['attribute_pa_wattage'] && $variation['attributes']['attribute_pa_el_type'] == 'oil-filled') :
                        echo $variation['price_html'];
                    endif;
                endif;
            endforeach;
        else :
            echo wc_price($product->get_price());
        endif;
    }

    public
    function render_plain_content()
    {
    }


}

global $widgets;

$widgets->register(new \Elementor\CustomWooProductHeader());



