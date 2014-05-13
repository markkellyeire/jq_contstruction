<?php
/**
 * Configuration varibles to be merged with the defaults in wp-config.php
 * and defined as constants.
 */

return array(
	
	// Define the environment.
	'WP_ENV'      => 'staging',
	
	// DB details.
	'DB_HOST'     => '',
	'DB_USER'     => '',
	'DB_PASSWORD' => '',
	'DB_NAME'     => '',
	
	// SMTP Details for email sending. These settings are applied when
	// at least the SMTP host is provided.
	'SMTP_HOST' => '',
	'SMTP_USER' => '',
	'SMTP_PASS' => '',
	'SMTP_PORT' => 587,
	'SMTP_AUTH' => true,
	
	// Do not allow plugins/themes to be updated/installed.
	'DISALLOW_FILE_MODS' => true,
	
	// WordPress Debug mode.
	'WP_DEBUG' => false,
	
);