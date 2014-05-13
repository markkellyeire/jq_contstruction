<?php

class Options {
	
	/**
	 * Allow options to be cached.
	 *
	 * @var array
	 */
	public static $cache = [];
	
	/**
	 * Returns a cached value, or stores the value in the cache if it isn't already.
	 *
	 * @param  string   $key
	 * @param  function $callback
	 *
	 * @return mixed
	 */
	public static function _cached( $key , $callback )
	{
		// If the key isn't cached, then we'll run the callback and store the value to
		// be returned next time.
		if ( !array_key_exists( $key , self::$cache ) )
		{
			self::$cache[ $key ] = $callback();
		}
		
		return self::$cache[ $key ];
	}
	
	/**
	 * Magic call to simplify loading of options and caching them.
	 * 
	 * @example
	 * To load a value from the Options page, we use the following syntax:
	 *     Options::admin_email();
	 * The above expects a custom field field-name to be called 'admin_email'.
	 * 
	 * @param  string $method Name of the custom field, as saved in the ACF backend.
	 * @param  array $args    Array of arguments - will not be used in this case.
	 *
	 * @return mixed
	 */
	public static function __callStatic( $method , $args )
	{
		return self::_cached( $method , function() use( $method )
		{
			return get_field( $method , 'options' );
		});
	}
	
}
