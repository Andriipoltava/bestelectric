<?php
//Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

//Remove Elementor Font Awesome
add_action('elementor/frontend/after_register_styles',function() {
    // if( !is_singular( 'post' ) ){
        foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
            wp_deregister_style( 'elementor-icons-fa-' . $style );
        }
    // }
}, 20 );

// add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 ); 
// function remove_default_stylesheet() { 
//         wp_deregister_style( 'elementor-icons' ); 
// }