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
	}

	$preload_images = get_field('preload_images',$term);
	
	if ($preload_images){
		echo '<link rel="preload" as="image" href="' . $preload_images . '" />';
	} else if(has_post_thumbnail()){
		$imageSrc = get_the_post_thumbnail_url($post, 'full');
		echo '<link rel="preload" as="image" href="' . $imageSrc . '" />';
	}
}

add_action('wp_head', 'preload_featured_image');