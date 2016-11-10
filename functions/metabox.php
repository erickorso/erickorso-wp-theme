<?php
add_action( 'cmb2_admin_init', 'tax_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function tax_register_taxonomy_metabox() {
	$prefix = 'cat';
	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box( array(
		'id'               => $prefix . '-edit',
		'title'            => __( 'Category Metabox', LANG ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array('category'), // Tells CMB2 which taxonomies should have these fields
		// 'new_term_section' => true, // Will display in the "Add New Category" section
	) );
	$cmb_term->add_field( array(
		'name' => __( 'Tag Color', LANG ),
		'id'   => $prefix . '-color',
		'type' => 'colorpicker',
	) );
	$cmb_term->add_field( array(
		'name' => __( 'Tag Img', LANG ),
		'id'   => $prefix . '-img',
		'type' => 'file',
	) );
}
function metaboxPageShow($page) {

    $post_id = 0;

    if ( isset( $_GET['post'] ) ) {
        $post_id = $_GET['post'];
    } elseif ( isset( $_POST['post_ID'] ) ) {
        $post_id = $_POST['post_ID'];
    }

    $slug = get_post( $post_id )->post_name;

    if ($page == $slug) {
    	return true;
    }else{
    	return false;
    }
}

add_action( 'cmb2_admin_init', 'screen_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function screen_register_demo_metabox() {
	$prefix = 'post';
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . '-group',
		'title'         => __( 'News Options', 'cmb2' ),
		'object_types'  => array( 'post', ), // Post type
		'closed'     => true, // true to keep the metabox closed by default
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'side',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'classes'    => 'ui-state-highlight ui-corner-all', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );
	$cmb->add_field( array(
	    'id'   => 'title',
		'name' =>__('Noticia destacada', LANG),
	    'type' => 'title',
	    'desc' =>'Mostrar en el Head de Noticias',
	) );
	$cmb->add_field( array(
	    'id'   => 'featured',
		'name' =>__('Noticia destacada', LANG),
	    'type' => 'checkbox',
	    'desc' =>'Featured',
	) );
	$cmb->add_field( array(
	    'name'      => 'Categoria a Mostrar en el Head de Noticias',
	    'desc'      => 'Featured Cat',
	    'id'        => 'featured-cat',
	    'taxonomy'  => 'category', // Enter Taxonomy Slug
	    'type'      => 'taxonomy_radio',
	    // Optional :
	    'text'      => array(
	        'no_terms_text' => 'Sorry, no terms could be found.' // Change default text. Default: "No terms"
	    ),
	) );

	$prefix = 'banner';
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . '-group',
		'title'         => __( 'Banner Options', 'cmb2' ),
		'object_types'  => array( 'product', ), // Post type
		'closed'     => true, // true to keep the metabox closed by default
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );
	$group_field_id = $cmb->add_field( array(
	    'id'          => $prefix . '-group',
	    'type'        => 'group',
	    'description' => $desc,
	    // 'repeatable'  => false, // use false if you want non-repeatable group
	    'options'     => array(
	        'group_title'   => __( 'Banner Options', LANG ), // {#} gets replaced by row number
			'add_button'    => __( '<span class="hide-clone"></span>', LANG ),
			'remove_button' => false,
			'sortable'      => false,
			'remove_button' => __( '<span class="hide-remove"></span>', LANG ),
	        // 'sortable'      => true, // beta
	        // 'closed'     => true, // true to have the groups closed by default
	    ),
	) );


	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'banner-product-bg',
		'name' =>__('Banner Background', LANG),
	    'type' => 'file',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'banner-product-logo',
		'name' =>__('Banner Logo', LANG),
	    'type' => 'file',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'banner-product',
		'name' => 'Banner Product Name ',	
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'banner-title',
		'name' => 'Banner Title ',	
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'banner-subtitle',
		'name' => 'Banner Subtitle',	
		'type' => 'text',
	) );

	$prefix = 'benefits';
	$cmb = new_cmb2_box( array(
		'id'            => $prefix . '-group',
		'title'         => __( 'Product Characteristics', 'cmb2' ),
		'object_types'  => array( 'product', ), // Post type
		'closed'     => true, 
	) );
	$cmb->add_field( array(
	    'name' => 'Background Image',
	    'id'   => 'bg',
	    'type' => 'file',
	) );
	$cmb->add_field( array(
	    'name' => 'Background Color',
	    'id'   => 'bg-color',
	    'type' => 'colorpicker',
	) );
	$cmb->add_field( array(
	    'name' => 'Background Color Opacity',
	    'id'   => 'bg-opacity',
	    'type' => 'text',
	    'desc' => 'Must be a number between 0 and 100',
	) );
	$cmb->add_field( array(
	    'name' => 'Image',
	    'id'   => 'img',
	    'type' => 'file',
	) );
	$cmb->add_field( array(
	    'name' => 'Title',
	    'id'   => 'title',
	    'type' => 'text',
	) );
	$cmb->add_field( array(
	    'name' => 'Font Color',
	    'id'   => 'font-color',
	    'type' => 'colorpicker',
	) );
	$group_field_id = $cmb->add_field( array(
	    'id'          => $prefix . '-group-fields',
	    'type'        => 'group',
	    'description' => $desc,
	    // 'repeatable'  => false, // use false if you want non-repeatable group
	    'options'     => array(
	        'group_title'   => __( 'Product Characteristics Item {#}', LANG ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Characteristics', LANG ),
			'remove_button' => false,
			'sortable'      => false,
			'remove_button' => __( 'Remove Characteristics', LANG ),
	        'sortable'      => true, // beta
	        'closed'     => true, // true to have the groups closed by default
	    ),
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'item-icon',
		'name' =>__('Item Icon', LANG),
	    'type' => 'file',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'item-title',
		'name' =>__('Item Title', LANG),
	    'type' => 'text',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'item-content',
		'name' =>__('Item Content', LANG),
	    'type' => 'text',
	) );
	$group_field_id = $cmb->add_field( array(
	    'id'          => $prefix . '-group-extra-fields',
	    'type'        => 'group',
	    'description' => $desc,
	    // 'repeatable'  => false, // use false if you want non-repeatable group
	    'options'     => array(
	        'group_title'   => __( 'Extra Product Characteristics Item {#}', LANG ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Extra Characteristics', LANG ),
			'remove_button' => false,
			'sortable'      => false,
			'remove_button' => __( 'Remove Extra Characteristics', LANG ),
	        'sortable'      => true, // beta
	        'closed'     => true, // true to have the groups closed by default
	    ),
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'item-icon',
		'name' =>__('Item Icon', LANG),
	    'type' => 'file',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'item-title',
		'name' =>__('Item Title', LANG),
	    'type' => 'text',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'item-subtitle',
		'name' =>__('Item Subtitle', LANG),
	    'type' => 'text',
	) );
	$cmb->add_group_field( $group_field_id, array(
	    'id'   => 'item-content',
		'name' =>__('Item Content', LANG),
	    'type' => 'wysiwyg',
	) );
}

