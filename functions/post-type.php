<?php 
function screen_cpt(){
	// post type slider
	$post_type = 'slider';
	$labels = array(
		'name'               => 'Slider',
		'singular_name'      => 'Slider',
		'menu_name'          => 'Slider',
		'name_admin_bar'     => 'Slider',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Slider',
		'new_item'           => 'New Slider',
		'edit_item'          => 'Edit Slider',
		'view_item'          => 'View Slider',
		'all_items'          => 'All Slider',
		'search_items'       => 'Search Slider',
		'parent_item_colon'  => 'Parent Slider:',
		'not_found'          => 'No Slider found.',
		'not_found_in_trash' => 'No Slider found in Trash.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-format-gallery',
        'description'        => __('You can add any gallery items', SCREEN_LANG),
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'slider' ),
		'capability_type'    => 'post', 
		'has_archive'        => true, 
		'hierarchical'       => false, 
		'supports'           => array( 'title', 'thumbnail' ), 
		'taxonomies'         => array('category')
	);
	// register_post_type($post_type, $args);

	// post type Product
	$post_type = 'product';
	$labels = array(
		'name'               => 'Product',
		'singular_name'      => 'Product',
		'menu_name'          => 'Product',
		'name_admin_bar'     => 'Product',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Product',
		'new_item'           => 'New Product',
		'edit_item'          => 'Edit Product',
		'view_item'          => 'View Product',
		'all_items'          => 'All Products',
		'search_items'       => 'Search Product',
		'parent_item_colon'  => 'Parent Product:',
		'not_found'          => 'No Product found.',
		'not_found_in_trash' => 'No Product found in Trash.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-awards',
        'description'        => __('You can add any Product items', SCREEN_LANG),
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'product' ),
		'capability_type'    => 'post', 
		'has_archive'        => true, 
		'hierarchical'       => false, 
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ), 
		'taxonomies'         =>array('post_tag')
	);

	register_post_type($post_type, $args);
}
add_action('init', 'screen_cpt');

function my_rewrite_flush() {
    myCustomPostType();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );