<?php
/**
 * Plugin Name: (ng)Arab
 * Plugin URI: https://github.com/khoirulaksara/ngarab
 * Description: Enhance and beautify Arabic text display in WordPress with advanced typography and improved readability.
 * Version: 3.1.0
 * Author: Khoirul Aksara
 * Author URI: https://log.serat.us
 * License: GPL2
 * Text Domain: ngarab
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get Plugin Data for Versioning
$ngarab_plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ) );
define( 'NGARAB_VERSION', $ngarab_plugin_data['Version'] );

// Include modular files
require_once plugin_dir_path( __FILE__ ) . 'includes/helpers.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/admin.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/block.php';

// Admin Hooks
add_action( 'admin_init', 'ngarab_register_settings' );
add_action( 'admin_menu', 'ngarab_admin_menu' );
add_action( 'admin_enqueue_scripts', 'ngarab_admin_assets' );

// Shortcode Hooks
add_shortcode( 'ngarab', 'ngarab_shortcode_handler' );
add_action( 'wp_enqueue_scripts', 'ngarab_frontend_assets' );

// Block Hooks
add_action( 'init', 'ngarab_register_block' );

/**
 * Add Settings link to plugin action links.
 */
function ngarab_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=ngarab">' . __( 'Settings', 'ngarab' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ngarab_add_settings_link' );
