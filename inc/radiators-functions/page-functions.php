<?php
/*---------------------------------------------------------------------------------*\
	Preload Featured Image

	Preload the fatures image as it is used in the hero sections.
\*---------------------------------------------------------------------------------*/
function preload_featured_image(){
	global $post;

	$term = "";

	if (is_product_category()){
		$term = get_queried_object();
        $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
    }

	
	if ($thumbnail_id){
		echo '<link rel="preload" as="image" href="' . wp_get_attachment_image_url($thumbnail_id,'full') . '" />';
	} else if(has_post_thumbnail()){
		$imageSrc = get_the_post_thumbnail_url($post, 'full');
		echo '<link rel="preload" as="image" href="' . $imageSrc . '" />';
	}

}

add_action('wp_head', 'preload_featured_image');