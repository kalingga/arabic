<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When the plugin is deleted from the WordPress dashboard, this file is run.
 * This is the place to clean up all data stored by the plugin.
 *
 * @link       https://github.com/kalingga/arabic
 * @since      3.1.2
 *
 * @package    Ngarab
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * List of options to delete.
 */
$ngarab_options = array(
	'ngarab_font_size',
	'ngarab_line_height',
	'ngarab_font_family',
);

foreach ( $ngarab_options as $ngarab_option_name ) {
	delete_option( $ngarab_option_name );
}
