<?php
/**
 * Plugin Name: (ng)Arab
 * Plugin URI:  https://github.com/kalingga/arabic
 * Description: A WordPress plugin to display Arabic text with clean typography using the LPMQ Isep Misbah font. Supports multi-line text (Surah).
 * Version:     3.0.0
 * Author:      Khoirul Aksara
 * Author URI:  https://log.serat.us
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: arabic
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load plugin styles.
 */
function ngarab_enqueue_styles() {
	$src = plugins_url( 'css/wedak.css', __FILE__ );
	wp_enqueue_style( 'ngarab-styles', $src, array(), '3.0.0' );
}
add_action( 'wp_enqueue_scripts', 'ngarab_enqueue_styles' );

/**
 * Shortcode to display Arabic text.
 *
 * @param array  $atts    Shortcode attributes.
 * @param string $content Shortcode content.
 * @return string
 */
function ngarab_shortcode_handler( $atts, $content = null ) {
	return '<div class="arab">' . wpautop( trim( $content ) ) . '</div>';
}
add_shortcode( 'ngarab', 'ngarab_shortcode_handler' );
