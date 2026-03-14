<?php

/*
Plugin Name: (ng)Arab V3
Plugin URI: https://log.serat.us
Description: 
Author: Khoirul Aksara
Version: 3.0
Author URI: https://log.serat.us
*/

// Initialize GitHub Updater
if ( is_admin() ) { // we only need this in the admin area
	include_once( 'updater.php' );
	$config = array(
		'slug'               => plugin_basename( __FILE__ ),
		'proper_folder_name' => 'arabic',
		'api_url'            => 'https://api.github.com/repos/kalingga/arabic',
		'raw_url'            => 'https://raw.githubusercontent.com/kalingga/arabic/master',
		'github_url'         => 'https://github.com/kalingga/arabic',
		'zip_url'            => 'https://github.com/kalingga/arabic/archive/master.zip',
		'requires'           => '3.0',
		'tested'             => '4.0',
		'readme'             => 'README.md',
	);
	new WP_GitHub_Updater( $config );
}

//fungsi load css
function makeup_arab() {
	$src = plugins_url('/css/wedak.css', __FILE__);
	wp_enqueue_style( 'wedak', $src );
}
makeup_arab();

//fungsi shortcode
function shortcode_arab( $atts, $content = null ) {
	return '<div class="arab">' . wpautop( trim( $content ) ) . '</div>';
}
//hooking
add_shortcode( 'ngarab', 'shortcode_arab' );

