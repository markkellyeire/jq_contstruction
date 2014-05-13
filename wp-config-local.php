<?php
/**
 * Configuration varibles to be merged with the defaults in wp-config.php
 * and defined as constants.
 */

return array(
	
	// Define the environment.
	'WP_ENV'      => 'local',
	
	// DB details.
	'DB_HOST'     => 'localhost',
	'DB_USER'     => 'root',
	'DB_PASSWORD' => 'password',
	'DB_NAME'     => 'jamesquinn',
	
	// SMTP Details for email sending. These settings are applied when
	// at least the SMTP host is provided.
	'SMTP_HOST' => '',
	'SMTP_USER' => '',
	'SMTP_PASS' => '',
	'SMTP_PORT' => 587,
	'SMTP_AUTH' => true,
	
	// Do not allow plugins/themes to be updated/installed.
	'DISALLOW_FILE_MODS' => false,
	
	// WordPress Debug mode.
	'WP_DEBUG' => false,
	
);
