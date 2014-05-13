<?php

// Add a new custom post type, or two.
add_action( 'init' , function()
{
	$singluar = 'Event';
	$plural   = 'Events';
	
	register_post_type( 'event' , [
		'labels' => [
			'name'               => $singluar,
			'singular_name'      => $singluar,
			'menu_name'          => $plural,
			'all_items'          => "All $plural",
			'add_new'            => 'Add New',
			'add_new_item'       => "Add New $singluar",
			'edit'               => 'Edit',
			'edit_item'          => "Edit $singluar",
			'new_item'           => "New $singluar",
			'view_item'          => "View $singluar",
			'search_items'       => "Search $plural",
			'not_found'          => "No $plural found in the Database.",
			'not_found_in_trash' => "No $plural found in Trash"
		],
		
		'description'            => "$plural custom post type.",
		'public'                 => true,
		'exclude_from_search'    => true,
		'menu_position'          => 25,
		'menu_icon'              => img( 'assets/custom-post-icon.png' ),
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields',
                                      'comments', 'revisions', 'page-attributes', 'post-formats' ]
	]);
});
