<?php
/**
 * Shortcode Handler and Frontend Assets for (ng)Arab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle the [ngarab] shortcode.
 */
function ngarab_shortcode_handler( $atts, $content = null ) {
	$default_size   = get_option( 'ngarab_font_size', 24 );
	$default_height = get_option( 'ngarab_line_height', 45 );
	$default_font   = get_option( 'ngarab_font_family', 'lpmq' );

	$atts = shortcode_atts( array(
		'size'     => $default_size,
		'height'    => $default_height,
		'font'     => $default_font,
		'color'    => '',
		'trans'    => '', // Transliterasi
		'trj'      => '', // Terjemahan
		'show_copy' => '0', // Show Copy Button
	), $atts, 'ngarab' );

	// Font family mapping
	$font_family = ngarab_get_font_family( $atts['font'] );

	$style = "font-family: {$font_family}; font-size: {$atts['size']}pt !important; line-height: {$atts['height']}px !important;";
	if ( ! empty( $atts['color'] ) ) {
		$style .= " color: {$atts['color']} !important;";
	}

	$output = '<div class="arab-container">';
	$output .= '<div class="arab" style="' . esc_attr( $style ) . '">' . do_shortcode( $content ) . '</div>';

	// Transliteration & Translation
	if ( ! empty( $atts['trans'] ) || ! empty( $atts['trj'] ) ) {
		$output .= '<div class="arab-meta">';
		if ( ! empty( $atts['trans'] ) ) {
			$output .= '<span class="arab-trans">' . esc_html( $atts['trans'] ) . '</span>';
		}
		if ( ! empty( $atts['trj'] ) ) {
			$output .= '<div class="arab-trj">' . esc_html( $atts['trj'] ) . '</div>';
		}
		$output .= '</div>';
	}

	// Copy Button
	if ( '1' === $atts['show_copy'] ) {
		$output .= '<button class="arab-copy-btn" data-clipboard-text="' . esc_attr( wp_strip_all_tags( $content ) ) . '">';
		$output .= __( 'Copy', 'ngarab' );
		$output .= '</button>';
	}

	$output .= '</div>';

	return $output;
}

/**
 * Enqueue frontend scripts and styles.
 */
function ngarab_frontend_assets() {
	wp_enqueue_style(
		'ngarab-style',
		plugins_url( 'assets/css/wedak.css', dirname( __FILE__ ) ),
		array(),
		filemtime( plugin_dir_path( dirname( __FILE__ ) ) . 'assets/css/wedak.css' )
	);

	wp_enqueue_script(
		'ngarab-clipboard',
		includes_url( '/js/clipboard.min.js' ),
		array(),
		'2.0.11',
		true
	);

	wp_enqueue_script(
		'ngarab-script',
		plugins_url( 'assets/js/copy.js', dirname( __FILE__ ) ),
		array( 'ngarab-clipboard' ),
		NGARAB_VERSION,
		true
	);

	wp_localize_script( 'ngarab-script', 'ngarab_copy_vars', array(
		'copied_text' => __( 'Copied!', 'ngarab' ),
	) );
}
