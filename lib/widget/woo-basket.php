<?php


namespace Elementor;

class CustomBasketWoo extends Widget_Base
{

    public function get_style_depends()
    {
        return ['ber-css-woo-basket'];
    }

    public function get_script_depends()
    {
        return ['jquery', 'ber-js-woo-basket'];
    }

    public function get_name()
    {
        return "custom-woo-basket";
    }

    public function get_title()
    {
        return "Custom Woo Basket";
    }

    public function get_icon()
    {
        return 'eicon-cart';
    }

    public function get_keywords()
    {
        return ['menu', 'nav', 'button', 'woo'];
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
            'title_color',
            [
                'label' => esc_html__('Icon Color', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .с-cart-btn__icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'counter_color',
            [
                'label' => esc_html__('Counter Color', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .с-cart-btn__count' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Modal', 'bestelectric'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .c-cart-content__wrapper' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


    }

    protected function render()
    {

        $items_count    = 0; // Initializing

        if(isset( WC()->cart)) {
            // Loop through cart items
            foreach (WC()->cart->get_cart() as $item) {
                // Excluding some product category from the count
                $items_count += $item['quantity'];

            }
        }


        $settings = $this->get_settings_for_display();
        ?>
        <div class="o-header__cart">
            <a class="с-cart-btn" href="<?php echo function_exists('wc_get_cart_url')?wc_get_cart_url():'' ?>"
               title="<?php _e('View your shopping basket'); ?>">
                <span class="с-cart-btn__icon">
                    <svg width="22" height="20" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 20.4 17.3" style="enable-background:new 0 0 20.4 17.3;" xml:space="preserve">
                        <path fill="#706f6f" d="M7.9,15.7c0-0.9-0.7-1.6-1.6-1.6c-0.9,0-1.6,0.7-1.6,1.6c0,0.9,0.7,1.6,1.6,1.6
                            C7.2,17.3,7.9,16.6,7.9,15.7z M18.9,15.7c0-0.9-0.7-1.6-1.6-1.6c-0.9,0-1.6,0.7-1.6,1.6c0,0.9,0.7,1.6,1.6,1.6
                            C18.2,17.3,18.9,16.6,18.9,15.7L18.9,15.7z M20.4,2.4c0-0.4-0.4-0.8-0.8-0.8H4.9C4.8,1,4.8,0,3.9,0H0.8C0.4,0,0,0.4,0,0.8
                            c0,0.4,0.4,0.8,0.8,0.8h2.5l2.2,10.1c-0.3,0.5-0.6,1.1-0.7,1.7c0,0.4,0.4,0.8,0.8,0.8h12.6c0.4,0,0.8-0.4,0.8-0.8
                            c0-0.4-0.4-0.8-0.8-0.8c0,0,0,0,0,0H6.8c0.2-0.2,0.3-0.5,0.3-0.8c0-0.3-0.1-0.6-0.2-0.9l12.8-1.5c0.4-0.1,0.7-0.4,0.7-0.8L20.4,2.4z
                            " />
                    </svg>
                </span>
                <span class="с-cart-btn__count"><?php echo $items_count; ?></span>

            </a>
            <?php if (function_exists('is_cart')&&!is_cart()) : ?>
                <div class="c-cart-content" style="display: none;">
                    <div class="c-cart-content__wrapper">
                        <div class="widget_shopping_cart_content">
                            <?php woocommerce_mini_cart(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php
    }
}

global $widgets;
$widgets->register(new \Elementor\CustomBasketWoo());



