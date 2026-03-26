<?php
/**
 * Helper functions for (ng)Arab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the available font stacks.
 *
 * @return array
 */
function ngarab_get_font_stacks() {
	return array(
		'lpmq'           => "'LPMQ', serif",
		'amiri'          => "'Amiri', serif",
		'amiri-quran'    => "'Amiri Quran', 'Amiri', serif",
		'lateef'         => "'Lateef', cursive",
		'noto-nastaliq'  => "'Noto Nastaliq Urdu', cursive",
		'scheherazade'   => "'Scheherazade New', serif",
	);
}

/**
 * Get font family by key.
 * 
 * @param string $key
 * @return string
 */
function ngarab_get_font_family( $key ) {
	$stacks = ngarab_get_font_stacks();
	return isset( $stacks[ $key ] ) ? $stacks[ $key ] : $stacks['lpmq'];
}
