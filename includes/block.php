<?php
/**
 * Gutenberg Block Registration for (ng)Arab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Gutenberg block.
 */
function ngarab_register_block() {
	// Register Block Script
	wp_register_script(
		'ngarab-block-js',
		plugins_url( 'assets/js/block.js', dirname( __FILE__ ) ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor', 'wp-components' ),
		NGARAB_VERSION,
		true
	);

	// Register Block Style for Editor
	wp_register_style(
		'ngarab-block-editor-style',
		plugins_url( 'assets/css/wedak.css', dirname( __FILE__ ) ),
		array(),
		NGARAB_VERSION
	);

	// Add script translations
	wp_set_script_translations( 'ngarab-block-js', 'ngarab', plugin_dir_path( dirname( __FILE__ ) ) . 'languages' );

	// Register Block Type
	register_block_type( 'ngarab/ngarab-block', array(
		'editor_script' => 'ngarab-block-js',
		'editor_style'  => 'ngarab-block-editor-style',
		'attributes'      => array(
			'arabText' => array( 'type' => 'string', 'default' => '' ),
			'font'     => array( 'type' => 'string', 'default' => get_option( 'ngarab_font_family', 'lpmq' ) ),
			'color'    => array( 'type' => 'string', 'default' => '' ),
			'trans'    => array( 'type' => 'string', 'default' => '' ),
			'trj'      => array( 'type' => 'string', 'default' => '' ),
			'showCopy' => array( 'type' => 'boolean', 'default' => false ),
		),
		'render_callback' => 'ngarab_block_render_callback',
	) );
}

/**
 * Render callback for the Gutenberg block.
 */
function ngarab_block_render_callback( $attributes, $content ) {
	// Map Gutenberg attributes to shortcode attributes
	$atts = array(
		'font'      => $attributes['font'],
		'color'     => $attributes['color'],
		'trans'     => $attributes['trans'],
		'trj'       => $attributes['trj'],
		'show_copy'  => $attributes['showCopy'] ? '1' : '0',
		'convert_num' => $attributes['convertNum'] ? '1' : '0',
	);

	// Reuse the shortcode handler for consistency
	return ngarab_shortcode_handler( $atts, $attributes['arabText'] );
}
