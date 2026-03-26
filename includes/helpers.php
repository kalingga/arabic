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
	return isset( $stacks[ $key ] ) ? $stacks[ $key ] : $stacks['scheherazade'];
}
/**
 * Convert standard numbers (0-9) to Arabic numerals (٠-٩).
 * 
 * @param string $text
 * @return string
 */
function ngarab_convert_arabic_numbers( $text ) {
	// Pattern to match HTML tags/entities OR digits
	// Group 1: HTML tags <...> or Entities &...;
	// Group 2: Decimals 0-9
	return preg_replace_callback(
		'/(<[^>]*>|&[#a-z0-9]+;)|(\d)/i',
		function ( $matches ) {
			// If it's a tag or entity (Group 1), return it untouched
			if ( ! empty( $matches[1] ) ) {
				return $matches[1];
			}
			
			// If it's a digit (Group 2), convert it
			$western = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
			$arabic  = array( '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' );
			return str_replace( $western, $arabic, $matches[2] );
		},
		$text
	);
}
