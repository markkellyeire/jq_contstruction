<?php

if ( function_exists('register_sidebar') )
{
	$sidebar_defaults = [
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	];
	
	// Define the sidebars here.
	$sidebars = [
		[ 'name' => 'Home Page Sidebar' ],
		[ 'name' => 'Article Listing Sidebar' ],
		[ 'name' => 'Single Article Sidebar' ]
	];
	
	foreach( $sidebars as $sidebar )
	{
		register_sidebar( array_merge( $sidebar , $sidebar_defaults ) );
	}
}


/**
 * Unregister the widgets that we don't want the client to use.
 */
// add_action( 'widgets_init' , function() {
// 	unregister_widget( 'WP_Widget_Pages' );
// 	unregister_widget( 'WP_Widget_Calendar' );
// 	unregister_widget( 'WP_Widget_Archives' );
// 	unregister_widget( 'WP_Widget_Links' );
// 	unregister_widget( 'WP_Widget_Meta' );
// 	unregister_widget( 'WP_Widget_Search' );
// 	unregister_widget( 'WP_Widget_Categories' );
// 	unregister_widget( 'WP_Widget_Recent_Posts' );
// 	unregister_widget( 'WP_Widget_Recent_Comments' );
// 	unregister_widget( 'WP_Widget_RSS' );
// 	unregister_widget( 'WP_Widget_Tag_Cloud' );
// 	unregister_widget( 'WP_Nav_Menu_Widget' );
// 	unregister_widget( 'WP_Widget_Text' );
// });