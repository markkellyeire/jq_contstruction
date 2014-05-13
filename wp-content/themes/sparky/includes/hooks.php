<?php
/*
|--------------------------------------------------------------------------
| Hooks
|--------------------------------------------------------------------------
| 
| Define all WordPress hooks in this file.
| 
*/

/**
 * Prevent a recent vulnerability in WordPress by disabling pingbacks.
 */
add_filter( 'xmlrpc_methods' , function( $methods )
{
	unset( $methods['pingback.ping'] );
	return $methods;
});
