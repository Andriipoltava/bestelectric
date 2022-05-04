<?php

/*------------------------------------*\
	Show cart contents / total Ajax
\*------------------------------------*/

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    ?>
    <a class="с-cart-btn" href="<?php echo esc_url(wc_get_cart_url()); ?>"
       title="<?php _e('View your shopping basket', 'elr'); ?>">
        <span class="с-cart-btn__icon"><?php echo get_shop_cart_icon(); ?></span>
        <span class="с-cart-btn__count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    </a>
    <?php
    $fragments['a.с-cart-btn'] = ob_get_clean();
    return $fragments;
}


/* Custom Shoping Cart in the top */
function elr_mini_cart()
{
    ?>
    <div id="elr-minicart-top" class="c-cart-content__wrapper">
        <div class="widget_shopping_cart_content">
        <?php if (sizeof(WC()->cart->get_cart()) > 0) : ?>
            <ul class="elr-minicart-top-products woocommerce-mini-cart cart_list product_list_widget">
                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                    $_product = $cart_item['data'];
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    // Only display if allowed
                    if (!apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key) || !$_product->exists() || $cart_item['quantity'] == 0) continue;
                    // Get price
                    $product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
                    $product_price = apply_filters('woocommerce_cart_item_price_html', woocommerce_price($product_price), $cart_item, $cart_item_key);
                    ?>
                    <li class="elr-mini-cart-product woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
                        <?php
                        echo apply_filters(
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                esc_attr__('Remove this item', 'woocommerce'),
                                esc_attr($product_id),
                                esc_attr($cart_item_key),
                                esc_attr($_product->get_sku())
                            ),
                            $cart_item_key
                        );
                        ?>
                        <div class="elr-mini-cart-thumbnail">
                            <?php echo $_product->get_image(); ?>
                        </div>
                        <div class="elr-mini-cart-info">
                            <a class="elr-mini-cart-title"
                               href="<?php echo get_permalink($cart_item['product_id']); ?>">
                                <h4 class="elr-mini-cart-title__text">
                                    <?php
                                    $product_title = apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product );
                                    echo str_replace('Wifi', '<sup>wifi</sup>', $product_title); ?>
                                </h4>
                            </a>
                            <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="elr-mini-cart-quantity">' . __('', 'elr') . '' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key); ?>
                            <?php echo apply_filters('woocommerce_widget_cart_item_price', '<span class="elr-mini-cart-price">' . __('', 'elr') . 'x ' . $product_price . '</span>', $cart_item, $cart_item_key); ?>

                        </div>
                    </li>
                <?php endforeach; ?>
            </ul><!-- end .elr-mini-cart-products -->
        <?php else : ?>
            <p class="elr-mini-cart-product-empty"><?php _e('No products in the cart.', 'elr'); ?></p>
        <?php endif; ?>
        <?php if (sizeof(WC()->cart->get_cart()) > 0) : ?>
            <h4 class="elr-mini-cart-subtotal">
                <?php _e('Subtotal', 'elr'); ?>:
                <strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong>
            </h4>
            <div class="c-cart-content__btns">
                <a href="<?php echo wc_get_cart_url(); ?>"
                   class="c-cart-content__btn c-cart-content__btn--primary">
                    <?php _e('View Basket', 'elr'); ?>
                </a>
                <a href="<?php echo wc_get_checkout_url(); ?>"
                   class="c-cart-content__btn c-cart-content__btn--grey c-cart-content__btn--right">
                    <?php _e('Checkout', 'elr'); ?>
                </a>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <?php
}

?>