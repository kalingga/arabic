<?php

/*
Plugin Name: (ng)Arab
Plugin URI: http://lorosukmo.github.io/
Description: dedicated to http://pelajarnujogja.or.id and http://ipnudiy.or.id - ^ I ❤ OpenSource ^
Author: Khoirul Anwar a.k.a Loro Sukmo
Version: 1.0
Author URI: http://choiroel.wordpress.com/
*/

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
?>
