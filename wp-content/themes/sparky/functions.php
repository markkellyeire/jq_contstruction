<?php
/*
|--------------------------------------------------------------------------
| Functions (What is this file?)
|--------------------------------------------------------------------------
| 
| This file is automatically loaded by WordPress and allows us to do quite
| a bit of awesome things. Such as override default functionality, add new
| features, new image sizes, new post types and a lot more.
| 
*/

$current_dir  = dirname( __FILE__ ) . '/';

define( 'DIR_INCLUDES' , $current_dir . 'includes/' );
define( 'DIR_THEME'    , get_stylesheet_directory_uri() . '/' );
define( 'DIR_PARTIALS' , $current_dir . '_partials/' );


/*
|--------------------------------------------------------------------------
| Template Handler - overrides WP templating
|--------------------------------------------------------------------------
| 
| The template handler will allow us to use the Plates PHP template
| library to handle all our views.
| Right before a view is rendered (such as page.php, single.php, etc)
| we take over and let Plates render the views.
| 
| Comment out the line below to revert to default WordPress templating.
| 
*/
require_once DIR_INCLUDES . 'template-handler.class.php';

// Core helpers and classes for our Sparky theme.
require_once DIR_INCLUDES . 'helpers.php';
require_once DIR_INCLUDES . 'sparky.class.php';
require_once DIR_INCLUDES . 'assets.class.php';
require_once DIR_INCLUDES . 'carousel.class.php';

// When using the Options plugin with ACF - we might find the Options class useful
// as it can retrieve values and cache them for any consecutive queries.
// require_once DIR_INCLUDES . 'options.class.php';


// Initialise the Sparky class. It enables a few necessary features.
Sparky::init();


// Add the global assets required for our theme and set the order to a higher number so other scripts can be queued before these.
Assets::add( '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js' , 5 , 'lt IE 9' );
Assets::add( '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js' , 5 , 'gte IE 9' );

Assets::add( DIR_THEME . 'js/main.js' , 10 );
Assets::add( DIR_THEME . 'css/main.css' , 5 );


// Set custom image sizes for WordPress to resize when uploading new images.
Sparky::add_custom_image_sizes([
	'large-carousel' => '1024x680',
]);


// Load some additional custom post types.
// require_once DIR_INCLUDES . 'custom-post-types.php';

// Define sidebars, if necessary.
// require_once DIR_INCLUDES . 'sidebars.php';

// Define shortcodes, if necessary.
// require_once DIR_INCLUDES . 'shortcodes.php';

// Load custom hooks, if necessary.
require_once DIR_INCLUDES . 'hooks.php';

// Define ACF Options pages, if necessary.
// if ( is_admin() )
// {
// 	// Advanced Custom Fields - Options pages
// 	if ( function_exists('acf_add_options_sub_page') )
// 	{
// 		acf_set_options_page_title( 'Site Options' );
		
// 		acf_add_options_sub_page( 'General' );
// 	}
// }
