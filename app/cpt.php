<?php
// Register Custom Post Type
// Register Custom Post Type
function training_post_type() {

	$labels = array(
		'name'                  => _x( 'Szkolenia', 'Post Type General Name', 'produktywni' ),
		'singular_name'         => _x( 'Szkolenie', 'Post Type Singular Name', 'produktywni' ),
		'menu_name'             => __( 'Szkolenia', 'produktywni' ),
		'name_admin_bar'        => __( 'Szkolenie', 'produktywni' ),
		'archives'              => __( 'Item Archives', 'produktywni' ),
		'attributes'            => __( 'Item Attributes', 'produktywni' ),
		'parent_item_colon'     => __( 'Parent Item:', 'produktywni' ),
		'all_items'             => __( 'All Items', 'produktywni' ),
		'add_new_item'          => __( 'Add New Item', 'produktywni' ),
		'add_new'               => __( 'Add New', 'produktywni' ),
		'new_item'              => __( 'New Item', 'produktywni' ),
		'edit_item'             => __( 'Edit Item', 'produktywni' ),
		'update_item'           => __( 'Update Item', 'produktywni' ),
		'view_item'             => __( 'View Item', 'produktywni' ),
		'view_items'            => __( 'View Items', 'produktywni' ),
		'search_items'          => __( 'Search Item', 'produktywni' ),
		'not_found'             => __( 'Not found', 'produktywni' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'produktywni' ),
		'featured_image'        => __( 'Featured Image', 'produktywni' ),
		'set_featured_image'    => __( 'Set featured image', 'produktywni' ),
		'remove_featured_image' => __( 'Remove featured image', 'produktywni' ),
		'use_featured_image'    => __( 'Use as featured image', 'produktywni' ),
		'insert_into_item'      => __( 'Insert into item', 'produktywni' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'produktywni' ),
		'items_list'            => __( 'Items list', 'produktywni' ),
		'items_list_navigation' => __( 'Items list navigation', 'produktywni' ),
		'filter_items_list'     => __( 'Filter items list', 'produktywni' ),
	);
	$rewrite = array(
		'slug'                  => 'szkolenie',
		'with_front'            => false,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Szkolenie', 'produktywni' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'training', $args );

}
add_action( 'init', 'training_post_type', 0 );