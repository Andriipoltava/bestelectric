<?php

function cvy_sanitize_variation_attrs( $attrs ) {
	foreach ( $attrs as $key => $value ) {
		$value = strtolower( $value );
		$value = preg_replace( '~[^\w]~u', '_', $value );

		$attrs[ $key ] = $value;
	}

	return $attrs;
}

function curl_get_file_contents($URL)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    curl_close($c);

    if ($contents) return $contents;
    else return FALSE;
}


/*---------------------------------------------------------------------------------*\
	Get template part
\*---------------------------------------------------------------------------------*/
function load_template_part($template_name, $part_name = null)
{
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}


function twl_lazy_image($image_id,$size = 'full'){
    $img_html = wp_get_attachment_image($image_id,$size);
    $img_html = apply_filters( 'bj_lazy_load_html', $img_html );
    return $img_html;
}

?>