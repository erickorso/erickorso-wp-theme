<?php 
// debug_template2();
function debug_template2() {
	add_filter('template_include', function ($template) {
	global $wp_query;
	var_dump($template);
	var_dump($wp_query);
	die();
	}, 99);
}

function limpiar($str){
	$cadena = str_replace(' ', '', $str); // quitar espacios vacios
	$cadena = str_replace('-', '', $cadena); // quitar guiones
	$cadena = preg_replace('/[^0-9\-]/', '', $cadena);// quitar todo lo q no sea numero
	return $cadena;
}

function hextorgb($hex) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
	  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
	  $r = hexdec(substr($hex,0,2));
	  $g = hexdec(substr($hex,2,2));
	  $b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	//return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}

////MAS VISTOS
remove_action('wp_head','adjacent_posts_rel_link_wp_head', 10, 0);
function wpb_set_post_views($postid) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postid, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postid, $count_key);
        add_post_meta($postid, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postid, $count_key, $count);
    }
}

add_action('wp_head','wpb_track_post_views');
function wpb_track_post_views($postid){
    if (!is_single()){
	return;
	}else if(empty($postid)){
        global $post;
        $postid = $post->ID;   
    }
    wpb_set_post_views($postid);
}

function wpb_get_post_views($postid){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postid, $count_key, true);
    if($count==''){
        delete_post_meta($postid, $count_key);
        add_post_meta($postid, $count_key, '0');
        return 0;
    }
    return $count;
}