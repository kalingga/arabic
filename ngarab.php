<?php
/**
 * Plugin Name: (ng)Arab
 * Plugin URI:  https://github.com/khoirulaksara/ngarab
 * Description: A premium Arabic typography solution for WordPress. Display beautiful Arabic text with multiple fonts, colors, transliterations, and native Gutenberg support.
 * Version:     3.1.1
 * Author:      Khoirul Aksara
 * Author URI:  https://log.serat.us
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ngarab
 * Requires PHP: 7.2
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register settings and sections.
 */
function ngarab_register_settings() {
	register_setting( 'ngarab_settings_group', 'ngarab_font_size', array(
		'type'              => 'integer',
		'sanitize_callback' => 'absint',
		'default'           => 24,
	) );
	register_setting( 'ngarab_settings_group', 'ngarab_line_height', array(
		'type'              => 'integer',
		'sanitize_callback' => 'absint',
		'default'           => 45,
	) );
	register_setting( 'ngarab_settings_group', 'ngarab_font_family', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => 'lpmq',
	) );
}
add_action( 'admin_init', 'ngarab_register_settings' );

/**
 * Add options page to the menu.
 */
function ngarab_add_admin_menu() {
	add_options_page(
		__( '(ng)Arab Settings', 'ngarab' ),
		__( '(ng)Arab', 'ngarab' ),
		'manage_options',
		'ngarab',
		'ngarab_settings_page'
	);
}
add_action( 'admin_menu', 'ngarab_add_admin_menu' );

/**
 * Settings page HTML callback.
 */
function ngarab_settings_page() {
	?>
	<div class="wrap">
		<h1><?php esc_html_e( '(ng)Arab Settings', 'ngarab' ); ?></h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'ngarab_settings_group' );
			do_settings_sections( 'ngarab_settings_group' );
			?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Font Size (pt)', 'ngarab' ); ?></th>
					<td><input type="number" name="ngarab_font_size" value="<?php echo esc_attr( get_option( 'ngarab_font_size', 24 ) ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Line Height (px)', 'ngarab' ); ?></th>
					<td><input type="number" name="ngarab_line_height" value="<?php echo esc_attr( get_option( 'ngarab_line_height', 45 ) ); ?>" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Default Arabic Font', 'ngarab' ); ?></th>
					<td>
						<?php $current_font = get_option( 'ngarab_font_family', 'lpmq' ); ?>
						<select name="ngarab_font_family" id="ngarab_font_family_select">
							<option value="lpmq" <?php selected( $current_font, 'lpmq' ); ?>><?php esc_html_e( 'LPMQ Isep Misbah (Local Special)', 'ngarab' ); ?></option>
							<option value="amiri" <?php selected( $current_font, 'amiri' ); ?>><?php esc_html_e( 'Amiri (Google Font)', 'ngarab' ); ?></option>
							<option value="amiri-quran" <?php selected( $current_font, 'amiri-quran' ); ?>><?php esc_html_e( 'Amiri Quran (Google Font)', 'ngarab' ); ?></option>
							<option value="lateef" <?php selected( $current_font, 'lateef' ); ?>><?php esc_html_e( 'Lateef (Google Font)', 'ngarab' ); ?></option>
							<option value="noto-nastaliq" <?php selected( $current_font, 'noto-nastaliq' ); ?>><?php esc_html_e( 'Noto Nastaliq Urdu (Google Font)', 'ngarab' ); ?></option>
							<option value="scheherazade" <?php selected( $current_font, 'scheherazade' ); ?>><?php esc_html_e( 'Scheherazade New (Google Font)', 'ngarab' ); ?></option>
						</select>
						
						<div class="ngarab-preview-box">
							<span class="ngarab-preview-label"><?php esc_html_e( 'Preview:', 'ngarab' ); ?></span>
							<div id="ngarab-settings-preview">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>
						</div>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php
}

/**
 * Load plugin styles and inject dynamic settings.
 */
function ngarab_enqueue_styles() {
	$src = plugins_url( 'assets/css/wedak.css', __FILE__ );
	wp_enqueue_style( 'ngarab-styles', $src, array(), '3.1.0' );

	$font_size   = get_option( 'ngarab_font_size', 24 );
	$line_height = get_option( 'ngarab_line_height', 45 );
	$font_family = get_option( 'ngarab_font_family', 'lpmq' );

	$font_stack = ngarab_get_font_stack( $font_family );

	$custom_css = "
		:root {
			--ng-arab-font-size: {$font_size}pt;
			--ng-arab-line-height: {$line_height}px;
			--ng-arab-font-family: {$font_stack};
		}";

	wp_add_inline_style( 'ngarab-styles', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ngarab_enqueue_styles' );

/**
 * Load assets for WP Admin (Settings & Editor).
 */
function ngarab_admin_assets( $hook ) {
	// Only on our settings page or post editors
	if ( 'settings_page_ngarab' !== $hook && ! in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		return;
	}

	// Enqueue all Google Fonts for previews in one stable request
	$combined_url = 'https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Nastaliq+Urdu:wght@400..700&family=Scheherazade+New:wght@400;500;600;700&display=swap';
	
	wp_enqueue_style( 'ngarab-google-fonts-admin', $combined_url, array(), '3.1.0.1' );
	
	// Enqueue local font via front-end CSS
	wp_enqueue_style( 'ngarab-local-font-admin', plugins_url( 'assets/css/wedak.css', __FILE__ ), array(), '3.1.0.1' );
	
	// Admin specific styles
	wp_enqueue_style( 'ngarab-admin-css', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), '3.1.0.1' );

	// Gutenberg Block Assets
	wp_enqueue_script(
		'ngarab-block-js',
		plugins_url( 'assets/js/block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
		'3.1.0.1',
		true
	);

	// Settings Page Script
	if ( 'settings_page_ngarab' === $hook ) {
		wp_enqueue_script(
			'ngarab-settings-js',
			plugins_url( 'assets/js/settings.js', __FILE__ ),
			array(),
			'3.1.0.1',
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'ngarab_admin_assets' );

/**
 * Add Google Fonts to TinyMCE Editor instance.
 */
function ngarab_mce_css( $mce_css ) {
	$combined_url = 'https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Lateef:wght@200;300;400;500;600;700;800&family=Noto+Nastaliq+Urdu:wght@400..700&family=Scheherazade+New:wght@400;500;600;700&display=swap';
	
	if ( ! empty( $mce_css ) ) {
		$mce_css .= ',';
	}
	$mce_css .= str_replace( ',', '%2C', $combined_url );
	$mce_css .= ',' . plugins_url( 'assets/css/wedak.css', __FILE__ );
	
	return $mce_css;
}
add_filter( 'mce_css', 'ngarab_mce_css' );

/**
 * Add resource hints for Google Fonts in Admin.
 */
function ngarab_admin_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'ngarab_admin_resource_hints', 10, 2 );

/**
 * Enqueue front-end JS.
 */
function ngarab_frontend_assets() {
	wp_enqueue_script( 'ngarab-copy-js', plugins_url( 'assets/js/copy.js', __FILE__ ), array(), '3.1.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'ngarab_frontend_assets' );

/**
 * Get font stack and enqueue Google Fonts if needed.
 */
function ngarab_get_font_stack( $font_key ) {
	$fonts = array(
		'lpmq'         => "'LPMQ', 'Amiri', 'Traditional Arabic', serif",
		'amiri'        => "'Amiri', serif",
		'amiri-quran'  => "'Amiri Quran', 'Amiri', serif",
		'lateef'       => "'Lateef', cursive",
		'noto-nastaliq'=> "'Noto Nastaliq Urdu', cursive",
		'scheherazade' => "'Scheherazade New', serif",
	);

	if ( ! isset( $fonts[ $font_key ] ) ) {
		$font_key = 'lpmq';
	}

	// Enqueue individual Google Fonts for front-end efficient loading
	$google_fonts = array(
		'amiri'        => 'family=Amiri:ital,wght@0,400;0,700;1,400;1,700',
		'amiri-quran'  => 'family=Amiri+Quran&family=Amiri:ital,wght@0,400;0,700;1,400;1,700',
		'lateef'       => 'family=Lateef:wght@200;300;400;500;600;700;800',
		'noto-nastaliq'=> 'family=Noto+Nastaliq+Urdu:wght@400..700',
		'scheherazade' => 'family=Scheherazade+New:wght@400;500;600;700',
	);

	if ( isset( $google_fonts[ $font_key ] ) ) {
		$handle = 'ngarab-font-' . $font_key;
		if ( ! wp_style_is( $handle, 'enqueued' ) ) {
			wp_enqueue_style( $handle, 'https://fonts.googleapis.com/css2?' . $google_fonts[ $font_key ] . '&display=swap', array(), '1.0.0' );
		}
	}

	return $fonts[ $font_key ];
}

/**
 * Add preconnect for Google Fonts.
 */
function ngarab_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'ngarab_resource_hints', 10, 2 );

/**
 * Add TinyMCE button for [ngarab] shortcode.
 */
function ngarab_add_tinymce_button() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'ngarab_register_tinymce_plugin' );
		add_filter( 'mce_buttons', 'ngarab_add_button_to_toolbar' );
	}
}
add_action( 'admin_init', 'ngarab_add_tinymce_button' );

/**
 * Register the TinyMCE plugin.
 */
function ngarab_register_tinymce_plugin( $plugin_array ) {
	$plugin_array['ngarab'] = plugins_url( 'assets/js/editor.js', __FILE__ );
	return $plugin_array;
}

/**
 * Add the button to the TinyMCE toolbar.
 */
function ngarab_add_button_to_toolbar( $buttons ) {
	array_push( $buttons, 'ngarab' );
	return $buttons;
}

/**
 * Shortcode to display Arabic text.
 */
function ngarab_shortcode_handler( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'font'  => '',
		'color' => '',
		'trans' => '',
		'trj'   => '',
		'copy'  => 'no',
	), $atts, 'ngarab' );

	$style_rules = array();
	if ( ! empty( $atts['font'] ) ) {
		$font_stack    = ngarab_get_font_stack( $atts['font'] );
		$style_rules[] = '--ng-arab-font-family: ' . $font_stack;
	}
	if ( ! empty( $atts['color'] ) ) {
		$style_rules[] = '--ng-arab-color: ' . esc_attr( $atts['color'] );
	}

	$style_attr = ! empty( $style_rules ) ? ' style="' . esc_attr( implode( '; ', $style_rules ) ) . ';"' : '';

	$output = '<div class="arab-container">';
	
	$output .= '<div class="arab"' . $style_attr . '>' . wp_kses_post( trim( $content ) ) . '</div>';

	if ( ! empty( $atts['trans'] ) || ! empty( $atts['trj'] ) ) {
		$output .= '<div class="arab-meta">';
		if ( ! empty( $atts['trans'] ) ) {
			$output .= '<span class="arab-trans">' . esc_html( $atts['trans'] ) . '</span>';
		}
		if ( ! empty( $atts['trj'] ) ) {
			$output .= '<span class="arab-trj">' . esc_html( $atts['trj'] ) . '</span>';
		}
		$output .= '</div>';
	}

	if ( 'yes' === $atts['copy'] ) {
		$output .= '<button class="arab-copy-btn" title="Copy Arabic Text">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
			<span>Copy</span>
		</button>';
	}

	$output .= '</div>';

	return $output;
}
add_shortcode( 'ngarab', 'ngarab_shortcode_handler' );

/**
 * Register Gutenberg Block.
 */
function ngarab_register_block() {
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	register_block_type( 'ngarab/main', array(
		'render_callback' => function( $attributes, $content ) {
			$shortcode_atts = '';
			if ( ! empty( $attributes['font'] ) ) {
				$shortcode_atts .= ' font="' . esc_attr( $attributes['font'] ) . '"';
			}
			if ( ! empty( $attributes['color'] ) ) {
				$shortcode_atts .= ' color="' . esc_attr( $attributes['color'] ) . '"';
			}
			if ( ! empty( $attributes['trans'] ) ) {
				$shortcode_atts .= ' trans="' . esc_attr( $attributes['trans'] ) . '"';
			}
			if ( ! empty( $attributes['trj'] ) ) {
				$shortcode_atts .= ' trj="' . esc_attr( $attributes['trj'] ) . '"';
			}
			if ( ! empty( $attributes['showCopy'] ) && $attributes['showCopy'] ) {
				$shortcode_atts .= ' copy="yes"';
			}

			return ngarab_shortcode_handler( $attributes, $attributes['content'] ?? '' );
		},
	) );
}
add_action( 'init', 'ngarab_register_block' );
