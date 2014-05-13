<?php

// Allow shortcodes in widgets.
add_filter('widget_text', 'do_shortcode');

/**
 * Sample shortcode that outputs a greeting.
 * 
 * @example
 * [hello name='World']
 */
add_shortcode( 'hello' , function( $attributes )
{
	return 'Hello, ' . $attributes['name'] . '!';
});
