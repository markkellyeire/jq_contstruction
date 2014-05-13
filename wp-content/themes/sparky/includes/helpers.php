<?php

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
| 
| Small functions can be considers as helpers, these are used throughout
| the code but are too small to turn into a class.
| 
*/



/**
 * Outputs the content of a file that is located in the _partials directory.
 *
 * @param  string  $file Name of the file stored in the _partials directory. Extension is optional.
 * @param  array   $vars List of variables to pass to the view.
 * @param  boolean $echo Whether to output the content or return it.
 *
 * @return mixed         String or void.
 */
function partial( $file , $vars = [] , $echo = true )
{
	// Get extension if it's set, or default to php.
	$extension = pathinfo( $file , PATHINFO_EXTENSION );
	if ( !$extension ) $extension = 'php';
	
	// Construct the URI for the file.
	$file_path = DIR_PARTIALS . "{$file}.{$extension}";
	
	// Before going any further, let's test to see if our file actually exists.
	if ( !file_exists( $file_path ) )
	{
		throw new Exception( "Could not load {$file_path}.\nPlease double check the path." );
	}
	
	// Start the output buffer.
	ob_start();
	
	// Make the variables available for the required file.
	extract( $vars );
	
	// Include our file.
	require $file_path;
	
	// Let's get what the output buffer has rendered.
	$content = ob_get_clean();
	
	// If we're not echoing the data, lets return it.
	if ( !$echo ) return $content;
	
	// Output the data to the view.
	echo $content;
}



/**
 * Returns the path to an image.
 *
 * @param  string  $filename
 * @param  boolean $echo
 *
 * @return string
 */
function img( $filename , $echo = true )
{
	$img = DIR_THEME . "img/{$filename}";
	
	if ( !$echo ) return $img;
	
	echo $img;
}



/**
 * Returns the path to a JavaScript file.
 *
 * @param  string  $filename
 * @param  boolean $echo
 *
 * @return string
 */
function js( $filename , $echo = true )
{
	$js = DIR_THEME . "js/{$filename}";
	
	if ( !$echo ) return $js;
	
	echo $js;
}



/**
 * Returns the path to a CSS file.
 *
 * @param  string  $filename
 * @param  boolean $echo
 *
 * @return string
 */
function css( $filename , $echo = true )
{
	$css = DIR_THEME . "css/{$filename}";
	
	if ( !$echo ) return $css;
	
	echo $css;
}



/**
 * Determines if the current request is ajax or not.
 *
 * @return boolean
 */
function ajax_request()
{
	$req = $_SERVER['HTTP_X_REQUESTED_WITH'];
	
	return ( !empty( $req ) && strtolower( $req ) == 'xmlhttprequest' ) ? true : false;
}



/**
 * Redirect to another page. It's best to perform redirects before
 * anything has been rendered.
 *
 * @param  string $location
 *
 * @return void
 */
function redirect( $location )
{
	header( "location: $location" );
	exit;
}



/**
 * Overload WP's mail method by setting some defaults.
 *
 * @param  string|array $to
 * @param  string       $subject
 * @param  string       $message
 * @param  string|array $headers
 * @param  string|array $attachments
 *
 * @return boolean
 */
function send_email( $to , $subject , $message , $headers = [] , $attachments = [] ) {
	// Send html messages.
	add_filter( 'wp_mail_content_type' , function() { return 'text/html'; } );
	
	// Strip slashes from the message.
	$message = stripslashes( $message );
	
	return wp_mail( $to , $subject , $message , $headers, $attachments );
}



/**
 * Determine if a string starts with a given needle.
 *
 * @param  string  $haystack
 * @param  string|array  $needles
 * @return bool
 */
function starts_with( $haystack , $needles )
{
	foreach ( (array) $needles as $needle )
	{
		if ( strpos( $haystack , $needle ) === 0 ) return true;
	}

	return false;
}



/**
 * Determine if a given string ends with a given needle.
 *
 * @param string $haystack
 * @param string|array $needles
 * @return bool
 */
function ends_with( $haystack , $needles )
{
	foreach ( (array) $needles as $needle )
	{
		if ( $needle == substr( $haystack , strlen( $haystack ) - strlen( $needle ) ) ) return true;
	}

	return false;
}



/**
 * Determine if a given string contains a given sub-string.
 *
 * @param  string        $haystack
 * @param  string|array  $needle
 * @return bool
 */
function str_contains( $haystack , $needle )
{
	foreach ( (array) $needle as $n )
	{
		if ( strpos( $haystack , $n ) !== false ) return true;
	}

	return false;
}



/**
 * Truncates a string based on the length of words.
 *
 * @param  string  $string
 * @param  integer $words
 * @param  string  $suffix
 *
 * @return string
 */
function truncate( $string , $words , $suffix = '&hellip;' )
{
	$string = strip_tags( $string );
	
	$words_array = explode( ' ' , $string );
	
	// If the string is shorter than the words, we'll return the string without the suffix.
	if ( count($words_array) <= $words ) return $string;
	
	// Get the right number of words from the words array.
	$string_parts = array_slice( $words_array , 0 , $words );
	
	return implode( ' ' , $string_parts ) . $suffix;
}



/**
 * Get an item from an array using "dot" notation.
 *
 * @param  array   $array
 * @param  string  $key
 * @param  mixed   $default
 * 
 * @return mixed
 */
function array_get( $array , $key , $default = null )
{
	if ( is_null( $key ) ) return $array;
	
	if ( isset( $array[$key] ) ) return $array[$key];

	foreach ( explode( '.' , $key ) as $segment )
	{
		if ( !is_array( $array ) || !array_key_exists( $segment , $array ) )
		{
			return $default;
		}

		$array = $array[$segment];
	}

	return $array;
}



/**
 * Set an array item to a given value using "dot" notation.
 *
 * If no key is given to the method, the entire array will be replaced.
 *
 * @param  array   $array
 * @param  string  $key
 * @param  mixed   $value
 * 
 * @return void
 */
function array_set( &$array , $key , $value )
{
	if ( is_null( $key ) ) return $array = $value;

	$keys = explode( '.' , $key );

	while ( count( $keys ) > 1 )
	{
		$key = array_shift( $keys );

		// If the key doesn't exist at this depth, we will just create an empty array
		// to hold the next value, allowing us to create the arrays to hold final
		// values at the correct depth. Then we'll keep digging into the array.
		if ( !isset( $array[$key] ) || !is_array( $array[$key] ) )
		{
			$array[$key] = [];
		}

		$array =& $array[$key];
	}

	$array[ array_shift( $keys ) ] = $value;
}



/**
 * Pluck an array of values from an array.
 *
 * @param  array   $array
 * @param  string  $key
 * @return array
 */
function array_pluck( $array , $key )
{
	return array_map( function( $value ) use ( $key )
	{
		return is_object( $value ) ? $value->$key : $value[$key];
	} , $array );
}
