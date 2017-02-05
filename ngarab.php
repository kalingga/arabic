<?php

/*
Plugin Name: (ng)Arab V2
Plugin URI: http://lorosukmo.github.io/
Description: dedicated to http://pelajarnujogja.or.id and http://ipnudiy.or.id - ^ I ❤ OpenSource ^
Author: Khoirul Anwar a.k.a Loro Sukmo
Version: 2.0
Author URI: http://choiroel.wordpress.com/
*/
include_once('updater.php');
if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'arabic', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/lorosukmo/arabic', // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/lorosukmo/arabic/master', // the github raw url of your github repo
        'github_url' => 'https://github.com/lorosukmo/arabic', // the github url of your github repo
        'zip_url' => 'https://github.com/lorosukmo/arabic/zipball/master', // the zip url of the github repo
        'sslverify' => true // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '4.7', // which version of WordPress is your plugin tested up to?
        'readme' => 'README.MD' // which file to use as the readme for the version number
    );
    new WPGitHubUpdater($config);
}
//fungsi load css
function makeup_arab() {
	$src = plugins_url('/css/wedak.css', __FILE__);
	wp_enqueue_style( 'wedak', $src );
}
makeup_arab();

//fungsi shortcode
function shortcode_arab( $atts, $content = null ) {
return '<p class="arab">' . $content . '</p>';
}
//hooking
add_shortcode( 'ngarab', 'shortcode_arab' );

