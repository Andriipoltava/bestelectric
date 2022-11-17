<?php

namespace Elementor;

class CustomWooSingleProductFrom extends Widget_Base
{
    public function get_style_depends()
    {
        return ['ber-css-single-form', 'woocommerce-general'];
    }

    public function get_script_depends()
    {
        return ['swiper', 'ber-js-single-form', 'ber-woo-scripts'];
    }

    public function get_name()
    {
        return "custom-woo-single-product-form";
    }

    public function get_title()
    {
        return "Woo Product Form";
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

        $title = get_field('long_title_product', $id) ?: str_replace('Wifi', '<sup>wifi</sup>', get_the_title());
        ?>
        <div class="o-product-top">
            <div class="o-product-top__summary     <?php if (get_field('top_description_new_design', $id)) { ?> top_description_new_design <?php } ?>">


                <?php if (get_field('label')) : ?>
                    <span class="o-product-top__label <?php echo (get_field('product_label_color') == 'blue') ? 'o-product-top__label--blue' : null; ?>"><?php the_field('label'); ?></span>
                <?php endif; ?>
                <h1 class="o-product-top__title">
                    <?php echo $title ?>
                </h1>

                <?php if (get_field('top_description_new_design', $id)) { ?>


                    <div class="o-product-top__price">
                        <span class="o-product-top__from"><?php _e('From  '); ?></span>
                        <span class=" JS--top-product-price">
                                    <?php $this->widget_pricing($product) ?>
                        </span>
                    </div>

                    <div class="o-product-top__trustpilot JS--tustpilot-loader">
                        <div class="o-product-top__trustpilot--loader"></div>
                        <?php the_field('top_trustpilot_code', $id); ?>
                    </div>


                <?php } else { ?>

                    <?php if (get_field('top_trustpilot_code')) : ?>
                        <div class="o-product-top__trustpilot JS--tustpilot-loader">
                            <div class="o-product-top__trustpilot--loader"></div>
                            <?php the_field('top_trustpilot_code'); ?>
                        </div>
                    <?php endif; ?>


                    <div class="o-product-top__add">
                        <div class="o-product-top__price">
                            <span class="o-product-top__from"><?php _e('From  '); ?></span>
                            <span class=" JS--top-product-price">
                                    <?php $this->widget_pricing($product) ?>
                            </span>

                        </div>

                        <?php
                        $product_includes_image = get_field('product_includes_image');
                        $product_includes_tooltip_text = get_field('product_includes_tooltip_text');
                        if ($product_includes_image) : ?>
                            <div class="o-product-top__includes">
                                <div class="c-image-tooltip">
                                    <img src="<?php echo esc_url($product_includes_image['url']); ?>"
                                         alt="<?php echo esc_attr($product_includes_image['alt']); ?>"/>
                                    <?php if ($product_includes_tooltip_text) : ?>
                                        <div class="c-image-tooltip__content"><?php echo $product_includes_tooltip_text; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php }; ?>

                <?php
                $priceLater = (float)$product->get_price() / 3;
                $priceLater = number_format((float)$priceLater, 2, '.', '');
                $priceLater = get_woocommerce_currency_symbol() . '<span class="priceLater">' . $priceLater . '</span>';
                ?>

                <div class="o-product-top__paymentLater">
                    <div class="o-product-top__paymentLater__content"> <?php echo __('Pay in 3 interest-free payments of ') . $priceLater; ?>
                        .
                    </div>
                    <div class="o-product-top__paymentLater__icons">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 45 25" height="45"
                             width="80">
                            <g fill="none" fill-rule="evenodd">
                                <g transform="translate(4.4136 8.4)" fill="#0A0B09">
                                    <path d="m36.38 6.2463c-0.58875 0-1.066 0.48158-1.066 1.0757 0 0.594 0.47725 1.0757 1.066 1.0757 0.58874 0 1.0661-0.48167 1.0661-1.0757 0-0.59416-0.47734-1.0757-1.0661-1.0757zm-3.5073-0.83166c0-0.81338-0.68897-1.4726-1.5389-1.4726s-1.539 0.65925-1.539 1.4726c0 0.81339 0.68898 1.4728 1.539 1.4728s1.5389-0.65941 1.5389-1.4728zm0.0057148-2.8622h1.6984v5.7242h-1.6984v-0.36584c-0.47982 0.3302-1.059 0.52431-1.6837 0.52431-1.6531 0-2.9933-1.3523-2.9933-3.0205s1.3402-3.0204 2.9933-3.0204c0.6247 0 1.2039 0.1941 1.6837 0.5244v-0.36619zm-13.592 0.74562v-0.74554h-1.7389v5.7241h1.7428v-2.6725c0-0.90167 0.96849-1.3863 1.6405-1.3863 0.0068818 0 0.013306 6.6771e-4 0.020188 7.527e-4v-1.6656c-0.68973 0-1.3241 0.298-1.6646 0.7452zm-4.3316 2.1166c0-0.81338-0.68905-1.4726-1.539-1.4726-0.84991 0-1.539 0.65925-1.539 1.4726 0 0.81339 0.68905 1.4728 1.539 1.4728 0.84998 0 1.539-0.65941 1.539-1.4728zm0.0056186-2.8622h1.6985v5.7242h-1.6985v-0.36584c-0.47982 0.3302-1.059 0.52431-1.6836 0.52431-1.6532 0-2.9934-1.3523-2.9934-3.0205s1.3402-3.0204 2.9934-3.0204c0.62464 0 1.2038 0.1941 1.6836 0.5244v-0.36619zm10.223-0.15396c-0.67846 0-1.3206 0.21255-1.7499 0.79895v-0.64465h-1.6911v5.7239h1.7119v-3.0081c0-0.87046 0.57847-1.2967 1.275-1.2967 0.74646 0 1.1756 0.44996 1.1756 1.2849v3.0199h1.6964v-3.6401c0-1.3321-1.0496-2.238-2.4179-2.238zm-17.374 5.8782h1.7777v-8.2751h-1.7777v8.2751zm-7.8091 0.0022581h1.8824v-8.2789h-1.8824v8.2789zm6.584-8.2789c0 1.7923-0.69219 3.4596-1.9256 4.6989l2.602 3.5803h-2.325l-2.8278-3.891 0.72981-0.55152c1.2103-0.91484 1.9045-2.3132 1.9045-3.8367h1.8421z"/>
                                </g>
                            </g>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70"
                             height="40" viewBox="0 0 452.51 151.93" version="1.1">
                            <defs>
                                <clipPath id="clip1">
                                    <path d="M 0 0 L 129 0 L 129 151.929688 L 0 151.929688 Z M 0 0 "/>
                                </clipPath>
                                <clipPath id="clip2">
                                    <path d="M 404 76 L 452.511719 76 L 452.511719 144 L 404 144 Z M 404 76 "/>
                                </clipPath>
                            </defs>
                            <g id="surface1">
                                <g clip-path="url(#clip1)" clip-rule="nonzero">
                                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(8.198547%,60.798645%,84.298706%);fill-opacity:1;"
                                          d="M 116.03125 38.601563 C 117.882813 26.78125 116.015625 18.742188 109.625 11.457031 C 102.585938 3.4375 89.871094 0.00390625 73.605469 0.00390625 L 26.386719 0.00390625 C 23.0625 0.00390625 20.230469 2.421875 19.714844 5.703125 L 0.0507813 130.386719 C -0.335938 132.847656 1.5625 135.074219 4.054688 135.074219 L 33.207031 135.074219 L 31.195313 147.832031 C 30.855469 149.984375 32.515625 151.929688 34.695313 151.929688 L 59.265625 151.929688 C 62.175781 151.929688 64.652344 149.8125 65.105469 146.941406 L 65.34375 145.691406 L 69.972656 116.339844 L 70.273438 114.71875 C 70.726563 111.84375 73.203125 109.730469 76.109375 109.730469 L 79.785156 109.730469 C 103.589844 109.730469 122.230469 100.058594 127.675781 72.089844 C 129.949219 60.402344 128.773438 50.648438 122.757813 43.789063 C 120.9375 41.714844 118.671875 40 116.03125 38.601563 "/>
                                </g>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(13.299561%,17.298889%,39.599609%);fill-opacity:1;"
                                      d="M 116.03125 38.601563 C 117.882813 26.78125 116.015625 18.742188 109.625 11.457031 C 102.585938 3.4375 89.871094 0.00390625 73.605469 0.00390625 L 26.386719 0.00390625 C 23.0625 0.00390625 20.230469 2.421875 19.714844 5.703125 L 0.0507813 130.386719 C -0.335938 132.847656 1.5625 135.074219 4.054688 135.074219 L 33.207031 135.074219 L 40.527344 88.640625 L 40.300781 90.09375 C 40.820313 86.8125 43.625 84.390625 46.949219 84.390625 L 60.804688 84.390625 C 88.015625 84.390625 109.320313 73.335938 115.546875 41.367188 C 115.730469 40.421875 115.890625 39.503906 116.03125 38.601563 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 48.394531 38.757813 C 48.707031 36.78125 49.972656 35.164063 51.679688 34.347656 C 52.457031 33.976563 53.324219 33.769531 54.230469 33.769531 L 91.246094 33.769531 C 95.632813 33.769531 99.71875 34.054688 103.457031 34.65625 C 104.523438 34.828125 105.566406 35.027344 106.574219 35.253906 C 107.585938 35.476563 108.5625 35.726563 109.511719 36.003906 C 109.988281 36.140625 110.453125 36.289063 110.914063 36.441406 C 112.75 37.050781 114.457031 37.769531 116.03125 38.601563 C 117.882813 26.78125 116.015625 18.742188 109.625 11.457031 C 102.585938 3.4375 89.871094 0.00390625 73.605469 0.00390625 L 26.386719 0.00390625 C 23.0625 0.00390625 20.230469 2.421875 19.714844 5.703125 L 0.0507813 130.386719 C -0.335938 132.847656 1.5625 135.074219 4.054688 135.074219 L 33.207031 135.074219 L 40.527344 88.640625 L 48.394531 38.757813 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 328.316406 128.632813 L 332.253906 128.632813 C 342.726563 128.632813 352.570313 122.90625 354.71875 109.75 C 356.597656 97.664063 349.707031 90.863281 338.429688 90.863281 L 335.539063 90.863281 C 334.832031 90.863281 334.230469 91.378906 334.121094 92.074219 Z M 318.769531 78.082031 C 318.960938 76.886719 319.988281 76.003906 321.203125 76.003906 L 343.980469 76.003906 C 362.773438 76.003906 375.929688 90.773438 372.976563 109.75 C 369.933594 128.722656 352.035156 143.492188 333.328125 143.492188 L 310.128906 143.492188 C 309.246094 143.492188 308.570313 142.703125 308.710938 141.832031 L 318.769531 78.082031 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 289.273438 92.941406 L 287.8125 102.140625 L 305.914063 102.140625 C 306.796875 102.140625 307.46875 102.929688 307.332031 103.800781 L 305.59375 114.917969 C 305.40625 116.117188 304.371094 117 303.160156 117 L 287.582031 117 C 286.375 117 285.34375 117.875 285.152344 119.066406 L 283.609375 128.632813 L 302.78125 128.632813 C 303.664063 128.632813 304.335938 129.421875 304.199219 130.292969 L 302.460938 141.410156 C 302.273438 142.609375 301.238281 143.492188 300.027344 143.492188 L 265.417969 143.492188 C 264.535156 143.492188 263.863281 142.703125 264 141.832031 L 274.0625 78.082031 C 274.25 76.886719 275.28125 76.003906 276.492188 76.003906 L 311.105469 76.003906 C 311.988281 76.003906 312.660156 76.792969 312.523438 77.664063 L 310.78125 88.78125 C 310.597656 89.980469 309.5625 90.863281 308.351563 90.863281 L 291.707031 90.863281 C 290.496094 90.863281 289.464844 91.742188 289.273438 92.941406 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 388.292969 143.492188 L 374.535156 143.492188 C 373.652344 143.492188 372.980469 142.703125 373.117188 141.832031 L 383.179688 78.082031 C 383.367188 76.886719 384.398438 76.003906 385.609375 76.003906 L 399.367188 76.003906 C 400.25 76.003906 400.925781 76.792969 400.785156 77.664063 L 390.726563 141.414063 C 390.535156 142.609375 389.507813 143.492188 388.292969 143.492188 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 229.09375 106.257813 L 230.792969 106.257813 C 236.519531 106.257813 243.109375 105.179688 244.308594 97.84375 C 245.503906 90.507813 241.683594 89.453125 235.5625 89.429688 L 233.078125 89.429688 C 232.328125 89.429688 231.691406 89.976563 231.574219 90.714844 Z M 259.203125 143.492188 L 241.175781 143.492188 C 240.410156 143.492188 239.710938 143.050781 239.378906 142.359375 L 227.480469 117.535156 L 227.304688 117.535156 L 223.453125 141.8125 C 223.300781 142.777344 222.464844 143.492188 221.484375 143.492188 L 207.324219 143.492188 C 206.441406 143.492188 205.769531 142.703125 205.90625 141.832031 L 216.027344 77.6875 C 216.179688 76.71875 217.015625 76.003906 217.996094 76.003906 L 242.515625 76.003906 C 255.851563 76.003906 264.980469 82.359375 262.742188 96.769531 C 261.222656 106.078125 254.777344 114.132813 244.933594 115.835938 L 260.433594 141.308594 C 261.015625 142.265625 260.324219 143.492188 259.203125 143.492188 "/>
                                <g clip-path="url(#clip2)" clip-rule="nonzero">
                                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                          d="M 425.503906 143.492188 L 411.746094 143.492188 C 410.863281 143.492188 410.191406 142.703125 410.328125 141.832031 L 418.386719 90.863281 L 405.566406 90.863281 C 404.6875 90.863281 404.011719 90.078125 404.148438 89.207031 L 405.890625 78.085938 C 406.078125 76.886719 407.109375 76.003906 408.324219 76.003906 L 451.078125 76.003906 C 451.960938 76.003906 452.632813 76.792969 452.496094 77.664063 L 450.753906 88.78125 C 450.566406 89.980469 449.535156 90.863281 448.324219 90.863281 L 435.929688 90.863281 L 427.933594 141.414063 C 427.746094 142.609375 426.714844 143.492188 425.503906 143.492188 "/>
                                </g>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 206.800781 95.183594 C 206.597656 96.433594 205.066406 96.886719 204.179688 95.976563 C 201.175781 92.898438 196.765625 91.269531 192.015625 91.269531 C 181.285156 91.269531 172.789063 99.496094 171.09375 109.957031 C 169.480469 120.601563 175.5625 128.289063 186.472656 128.289063 C 190.96875 128.289063 195.742188 126.578125 199.707031 123.71875 C 200.800781 122.929688 202.304688 123.875 202.085938 125.207031 L 199.589844 140.648438 C 199.441406 141.570313 198.777344 142.320313 197.882813 142.582031 C 192.539063 144.152344 188.4375 145.28125 183.433594 145.28125 C 154.34375 145.28125 149.691406 120.433594 151.1875 109.867188 C 155.390625 80.25 179.425781 73.460938 194.160156 74.28125 C 198.910156 74.542969 203.160156 75.171875 207.328125 76.738281 C 208.675781 77.246094 209.476563 78.632813 209.246094 80.054688 L 206.800781 95.183594 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(8.198547%,60.798645%,84.298706%);fill-opacity:1;"
                                      d="M 295.9375 22.671875 C 295.109375 28.128906 290.941406 28.128906 286.910156 28.128906 L 284.621094 28.128906 L 286.226563 17.945313 C 286.324219 17.328125 286.855469 16.875 287.480469 16.875 L 288.53125 16.875 C 291.273438 16.875 293.863281 16.875 295.199219 18.4375 C 296 19.371094 296.242188 20.757813 295.9375 22.671875 Z M 294.183594 8.441406 L 278.988281 8.441406 C 277.949219 8.441406 277.066406 9.199219 276.902344 10.226563 L 270.757813 49.1875 C 270.636719 49.957031 271.230469 50.652344 272.007813 50.652344 L 279.804688 50.652344 C 280.53125 50.652344 281.152344 50.125 281.265625 49.40625 L 283.007813 38.359375 C 283.171875 37.332031 284.054688 36.578125 285.09375 36.578125 L 289.902344 36.578125 C 299.910156 36.578125 305.6875 31.734375 307.199219 22.132813 C 307.878906 17.933594 307.226563 14.632813 305.261719 12.324219 C 303.097656 9.785156 299.269531 8.441406 294.183594 8.441406 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 187.550781 22.671875 C 186.722656 28.128906 182.554688 28.128906 178.527344 28.128906 L 176.234375 28.128906 L 177.839844 17.945313 C 177.9375 17.328125 178.46875 16.875 179.09375 16.875 L 180.144531 16.875 C 182.886719 16.875 185.476563 16.875 186.8125 18.4375 C 187.613281 19.371094 187.855469 20.757813 187.550781 22.671875 Z M 185.796875 8.441406 L 170.601563 8.441406 C 169.5625 8.441406 168.679688 9.199219 168.515625 10.226563 L 162.371094 49.1875 C 162.25 49.957031 162.84375 50.652344 163.621094 50.652344 L 170.878906 50.652344 C 171.917969 50.652344 172.800781 49.898438 172.964844 48.871094 L 174.621094 38.359375 C 174.785156 37.332031 175.667969 36.578125 176.707031 36.578125 L 181.515625 36.578125 C 191.523438 36.578125 197.300781 31.734375 198.8125 22.132813 C 199.492188 17.933594 198.839844 14.632813 196.875 12.324219 C 194.710938 9.785156 190.882813 8.441406 185.796875 8.441406 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 221.078125 36.660156 C 220.375 40.820313 217.074219 43.609375 212.863281 43.609375 C 210.753906 43.609375 209.0625 42.933594 207.976563 41.644531 C 206.902344 40.371094 206.496094 38.558594 206.839844 36.535156 C 207.492188 32.414063 210.847656 29.535156 214.992188 29.535156 C 217.058594 29.535156 218.738281 30.21875 219.84375 31.515625 C 220.960938 32.824219 221.398438 34.648438 221.078125 36.660156 Z M 231.21875 22.5 L 223.941406 22.5 C 223.320313 22.5 222.789063 22.953125 222.691406 23.566406 L 222.371094 25.601563 L 221.863281 24.867188 C 220.285156 22.578125 216.773438 21.8125 213.265625 21.8125 C 205.226563 21.8125 198.359375 27.90625 197.023438 36.449219 C 196.328125 40.714844 197.316406 44.785156 199.734375 47.628906 C 201.953125 50.242188 205.121094 51.328125 208.898438 51.328125 C 215.378906 51.328125 218.972656 47.164063 218.972656 47.164063 L 218.644531 49.1875 C 218.523438 49.957031 219.117188 50.652344 219.898438 50.652344 L 226.449219 50.652344 C 227.488281 50.652344 228.375 49.898438 228.535156 48.871094 L 232.46875 23.960938 C 232.589844 23.195313 231.996094 22.5 231.21875 22.5 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(8.198547%,60.798645%,84.298706%);fill-opacity:1;"
                                      d="M 329.464844 36.660156 C 328.761719 40.820313 325.460938 43.609375 321.25 43.609375 C 319.140625 43.609375 317.449219 42.933594 316.363281 41.644531 C 315.289063 40.371094 314.882813 38.558594 315.226563 36.535156 C 315.878906 32.414063 319.234375 29.535156 323.378906 29.535156 C 325.445313 29.535156 327.125 30.21875 328.230469 31.515625 C 329.34375 32.824219 329.785156 34.648438 329.464844 36.660156 Z M 339.605469 22.5 L 332.328125 22.5 C 331.703125 22.5 331.175781 22.953125 331.078125 23.566406 L 330.757813 25.601563 L 330.25 24.867188 C 328.671875 22.578125 325.160156 21.8125 321.652344 21.8125 C 313.613281 21.8125 306.746094 27.90625 305.410156 36.449219 C 304.714844 40.714844 305.703125 44.785156 308.117188 47.628906 C 310.339844 50.242188 313.507813 51.328125 317.285156 51.328125 C 323.765625 51.328125 327.359375 47.164063 327.359375 47.164063 L 327.03125 49.1875 C 326.910156 49.957031 327.507813 50.652344 328.285156 50.652344 L 334.835938 50.652344 C 335.875 50.652344 336.761719 49.898438 336.921875 48.871094 L 340.855469 23.960938 C 340.976563 23.195313 340.382813 22.5 339.605469 22.5 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(14.498901%,23.098755%,50.19989%);fill-opacity:1;"
                                      d="M 269.976563 22.5 L 262.660156 22.5 C 261.960938 22.5 261.308594 22.847656 260.914063 23.425781 L 250.824219 38.285156 L 246.550781 24.003906 C 246.28125 23.113281 245.460938 22.5 244.527344 22.5 L 237.335938 22.5 C 236.46875 22.5 235.859375 23.351563 236.136719 24.175781 L 244.191406 47.8125 L 236.617188 58.5 C 236.023438 59.339844 236.621094 60.5 237.648438 60.5 L 244.957031 60.5 C 245.648438 60.5 246.296875 60.160156 246.691406 59.589844 L 271.015625 24.488281 C 271.597656 23.648438 270.996094 22.5 269.976563 22.5 "/>
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(8.198547%,60.798645%,84.298706%);fill-opacity:1;"
                                      d="M 348.183594 9.511719 L 341.945313 49.191406 C 341.824219 49.960938 342.417969 50.652344 343.195313 50.652344 L 349.46875 50.652344 C 350.507813 50.652344 351.394531 49.898438 351.554688 48.871094 L 357.703125 9.90625 C 357.824219 9.136719 357.230469 8.441406 356.453125 8.441406 L 349.433594 8.441406 C 348.808594 8.441406 348.277344 8.894531 348.183594 9.511719 "/>
                            </g>
                        </svg>
                    </div>

                </div>
                <?php if (get_field('gold_standard_banner', $id)) { ?>
                    <div class="gold_standard__Popup">
                        <?php echo get_gold_standard(); ?>
                    </div>
                <?php }; ?>


                <?php if ($product->get_short_description()) : ?>
                <div class="o-product-top__product-description">
                    <?php echo $product->get_short_description(); ?>

                    <?php else: echo "<div>";
                    endif; ?>

                    <div class="o-product-top__product-description__bottom">
                        <?php if (get_field('description_btn_show_anchor_features', $id)): ?>
                            <a class="anchor"
                               href="#features"><?php _e('See full description', 'bestelectric'); ?>
                                <i class="fa fa-arrow-down"></i>
                            </a>
                        <?php else: ?>
                            <span></span>
                        <?php endif; ?>
                        <?php if (get_field('description_bottom_right_icon', $id)):
                            echo wp_get_attachment_image(get_field('description_bottom_right_icon', $id)['id']);
                        endif; ?>
                    </div>
                </div>


                <div class="summary entry-summary" id="woocommerce_single_product_summary">
                    <?php
                    do_action('woocommerce_single_product_summary');
                    ?>
                    <?php if (get_field('payment_logos', 'option')) { ?>

                        <div id="ppc-bottom-payment-logos" class="hide pt10">
                            <?php echo wp_get_attachment_image(get_field('payment_logos', 'option')['id'], 'full'); ?>
                        </div>
                    <?php }; ?>
                </div>
                <?php $top_icon = get_field('warranty_header_icon', $id); ?>
                <div class="product-info">


                    <div class="accordions ">

                        <?php if (get_field('warranty_body', $id)) { ?>
                            <div class="accordion__item">
                                <div class="accordion__header <?php if (get_field('warranty_header_sub_text', $id)) { ?> warranty  <?php }; ?>">
                                    <div class="accordion__header__title">
                                        <?php echo isset($top_icon['id']) ? wp_get_attachment_image($top_icon['id']) : ''; ?>
                                        <div class="wrap">
                                            <span class="text"><?php echo get_field('warranty_header_text', $id) ?: 'Warranty'; ?></span>
                                            <?php if (get_field('warranty_header_sub_text', $id)) { ?>
                                                <span class="sub_text">
                                                    <?php echo get_field('warranty_header_sub_text', $id); ?>
                                                </span>
                                            <?php }; ?>
                                        </div>
                                    </div>

                                    <span class="acc-plus accordion__header__plus"></span>
                                </div>
                                <div class="accordion__body">
                                    <?php echo get_field('warranty_body', $id) ?: ''; ?>
                                </div>

                            </div>
                        <?php }; ?>
                        <?php $bot_icon = get_field('delivery_header_icon', $id) ?>
                        <?php if (get_field('delivery_body', $id)) { ?>
                            <div class="accordion__item">
                                <div class="accordion__header">

                                    <div class="accordion__header__title">
                                        <?php echo isset($bot_icon['id']) ? wp_get_attachment_image($bot_icon['id']) : ''; ?>

                                        <?php echo get_field('delivery_header_text', $id) ?: 'Delivery and Returns'; ?>
                                    </div>
                                    <span class="acc-plus accordion__header__plus"></span>
                                </div>
                                <div class="accordion__body">
                                    <?php echo get_field('delivery_body', $id) ?: ''; ?>
                                </div>
                            </div>
                        <?php }; ?>
                        <?php $bot_icon = get_field('returns_header_icon', $id) ?>
                        <?php if (get_field('returns_body', $id)) { ?>
                            <div class="accordion__item returns_body">
                                <div class="accordion__header">

                                    <div class="accordion__header__title">
                                        <?php echo isset($bot_icon['id']) ? wp_get_attachment_image($bot_icon['id']) : ''; ?>

                                        <?php echo get_field('returns_header_text', $id) ?: '30 Day Returns'; ?>
                                    </div>
                                    <span class="acc-plus accordion__header__plus"></span>
                                </div>
                                <div class="accordion__body">
                                    <?php echo get_field('returns_body', $id) ?: ''; ?>
                                </div>
                            </div>
                        <?php }; ?>

                    </div>
                    <div>
                        <?php
                        $product_features_keys = get_field('key_features_list', $id);
                        if ($product_features_keys) : ?>
                            <ul class="features-list">
                                <?php foreach ($product_features_keys as $key => $post) : ?>
                                    <li class="list__item">
                                        <div class="list__item__wrap">
                                            <?php if (get_field('feature_icon', $post->ID)) {
                                                ; ?>
                                                <span class="list__icon <?php the_field('feature_icon', $post->ID);
                                                echo ' ' . $post->ID ?>"></span>
                                            <?php }; ?>
                                            <?php echo get_the_title($post->ID); ?></div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <?php if (get_field('features_popup_btn', $id)) { ?>
                        <div class="accordions__bottom">
                            <a href="javascript:void(0);" data-popup="features"
                               class=" JS--open-popup">
                                See All Features <span class="acc-plus">+</span>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <?php
    }

    public
    function render_plain_content()
    {
    }

    public function widget_pricing($product)
    {
        $price = floatval($product->get_regular_price());
        $sale_price = floatval($product->get_sale_price());


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
            echo str_replace('From:', '', $product->get_price_html());;
        endif;
    }


}

global $widgets;

$widgets->register(new \Elementor\CustomWooSingleProductFrom());



