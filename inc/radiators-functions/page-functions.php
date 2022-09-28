<?php
/*---------------------------------------------------------------------------------*\
	Preload Featured Image

	Preload the fatures image as it is used in the hero sections.
\*---------------------------------------------------------------------------------*/
function preload_featured_image()
{
    global $post;

    $term = "";

    if (is_product_category()) {
        $term = get_queried_object();
        $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
    }


    if (isset($thumbnail_id)) {
        if (wp_is_mobile()) {
            echo '<link rel="preload" as="image" href="' . wp_get_attachment_image_url($thumbnail_id, 'woocommerce_thumbnail') . '" />';

        } else {
            echo '<link rel="preload" as="image" href="' . wp_get_attachment_image_url($thumbnail_id, 'woocommerce_single') . '" />';
        }
    } else if (has_post_thumbnail()) {
        global $product;

        if (is_product()) {
            $attachment_ids = $product->get_gallery_image_ids();
            if ($attachment_ids) {
                echo '<link rel="preload" as="image" href="' . wp_get_attachment_url($attachment_ids[count($attachment_ids) - 1]) . '" />';
            }

        } else {

            $imageSrc = get_the_post_thumbnail_url($post, 'medium');
            echo '<link rel="preload" as="image" href="' . $imageSrc . '" />';
        }


    }

}

add_action('wp_head', 'preload_featured_image');