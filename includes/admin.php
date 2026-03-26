<?php
/**
 * Admin Settings and Assets for (ng)Arab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register settings and sections.
 */
function ngarab_register_settings() {
	register_setting( 'ngarab_settings_group', 'ngarab_font_size', array( 'sanitize_callback' => 'absint' ) );
	register_setting( 'ngarab_settings_group', 'ngarab_line_height', array( 'sanitize_callback' => 'absint' ) );
	register_setting( 'ngarab_settings_group', 'ngarab_font_family', array( 'sanitize_callback' => 'ngarab_sanitize_font_family' ) );
	register_setting( 'ngarab_settings_group', 'ngarab_convert_numbers', array( 'sanitize_callback' => 'rest_sanitize_boolean' ) );
}

/**
 * Sanitize font family.
 */
function ngarab_sanitize_font_family( $value ) {
	$valid_fonts = array_keys( ngarab_get_font_stacks() );
	return in_array( $value, $valid_fonts, true ) ? $value : 'scheherazade';
}

/**
 * Create the settings page.
 */
function ngarab_settings_page() {
	// Use GitHub avatar dynamically
	$avatar = 'https://github.com/khoirulaksara.png';
	$author_name = 'Khoirul Aksara';
	
	$user = get_user_by( 'login', 'khoirulaksara' );
	if ( ! $user ) {
		$user = get_user_by( 'slug', 'khoirulaksara' );
	}
	
	if ( $user ) {
		$author_name = $user->display_name;
	}
	?>
	<div class="wrap ngarab-settings-wrap">
		<header class="ngarab-header">
			<div class="ngarab-branding">
				<div class="ngarab-logo-wrap">
					<svg viewBox="0 0 153 171" width="40" height="40">
						<path fill="currentColor" d="M70.3,34.2c8.9-3.6,19.6-1.7,26.8,4.8c9.7,8.7,18.6,18.2,27.1,27.9c4.9,5.5,8.5,12.7,7.4,20.3 c-1.2,8.1-5.3,15.8-10.8,21.8c0.5,0.9,1.1,1.7,1.1,2.8c-1.1,0.3-1.9-0.5-2.8-0.9c-2.5,3.8-6.1,6.8-9,10.3 c-6.2,7.5-13,14.9-22.2,18.6c-9.3,3.8-20,1.6-28.5-3.2c-10.4-6-17.8-15.5-25.4-24.5c-5.5-6.7-9.7-15.2-8.6-24.1 c1.2-10.5,7.8-19.2,13.9-27.4C47.7,49.8,57.4,39.2,70.3,34.2 M81.7,47.9C76,50.6,70.8,55,67.5,60.5c-2.4,4.2-4.4,9.3-2.8,14.1 c1.3,3.5,5.1,4.8,8.4,5.4c-9.6,8.1-19.8,17.2-22.8,29.9c-1.6,5.3,0.9,12.3,6.6,13.9c5.5,1.3,9-4.5,14.1-4.9 c5.5-0.4,11.2-0.7,16.5-2.6c3.5-1.3,7.7-2.7,9.1-6.5c-2.7-0.1-5.2,1.1-7.8,1.8c-5.8,1.5-11.9,2.2-17.9,1.4 c-3.5-0.6-7.3-2.3-8.6-5.9c-1.6-4.6,0.4-9.6,3.4-13.2c5.5-6.6,13-11.1,19.8-16.2c4.5-3.5,9.3-6.6,13.6-10.3 c2.3-1.9,3.9-4.7,3.9-7.8c-4.1,0.8-7.2,4-10.6,6.2c-4.8,3.4-10.9,5.6-16.7,4.2c-2.7-0.6-5.4-2.9-5-5.9c0.7-4.9,5.9-9.4,10.9-8 c2.4,1,2.4,3.8,3.3,5.9c3.2-2.4,6.7-5.7,7.1-9.9C91.6,47.1,85.5,46.2,81.7,47.9 M99.6,108.7c1.9-1.1,3.9-2.4,4.6-4.6 C102.2,105.1,99.8,106.2,99.6,108.7 M65.8,125.3c4.3,0.6,9.6-0.4,12.5-3.9C73.8,121.2,68.5,121,65.8,125.3z" />
					</svg>
				</div>
				<div>
					<h1><?php esc_html_e( '(ng)Arab', 'ngarab' ); ?></h1>
					<p><?php esc_html_e( 'Premium Arabic Typography', 'ngarab' ); ?></p>
				</div>
			</div>
			<div class="ngarab-version">v<?php echo esc_html( NGARAB_VERSION ); ?></div>
		</header>

		<form method="post" action="options.php">
			<?php
			settings_fields( 'ngarab_settings_group' );
			do_settings_sections( 'ngarab_settings_group' );
			?>
			
			<div class="ngarab-layout-grid">
				<div class="ngarab-main-content">
					<section class="ngarab-card">
						<h2><?php esc_html_e( 'General Settings', 'ngarab' ); ?></h2>
						<table class="form-table ngarab-settings-table">
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
									<?php $current_font = get_option( 'ngarab_font_family', 'scheherazade' ); ?>
									<select name="ngarab_font_family" id="ngarab_font_family_select">
										<option value="lpmq" <?php selected( $current_font, 'lpmq' ); ?>><?php esc_html_e( 'LPMQ Isep Misbah (Local Special)', 'ngarab' ); ?></option>
										<option value="amiri" <?php selected( $current_font, 'amiri' ); ?>><?php esc_html_e( 'Amiri (Google Font)', 'ngarab' ); ?></option>
										<option value="amiri-quran" <?php selected( $current_font, 'amiri-quran' ); ?>><?php esc_html_e( 'Amiri Quran (Google Font)', 'ngarab' ); ?></option>
										<option value="lateef" <?php selected( $current_font, 'lateef' ); ?>><?php esc_html_e( 'Lateef (Google Font)', 'ngarab' ); ?></option>
										<option value="noto-nastaliq" <?php selected( $current_font, 'noto-nastaliq' ); ?>><?php esc_html_e( 'Noto Nastaliq Urdu (Google Font)', 'ngarab' ); ?></option>
										<option value="scheherazade" <?php selected( $current_font, 'scheherazade' ); ?>><?php esc_html_e( 'Scheherazade New (Google Font)', 'ngarab' ); ?></option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php esc_html_e( 'Convert Numbers', 'ngarab' ); ?></th>
								<td>
									<label class="ngarab-switch">
										<input type="checkbox" name="ngarab_convert_numbers" value="1" <?php checked( get_option( 'ngarab_convert_numbers' ), 1 ); ?> />
										<span class="ngarab-switch-label"><?php esc_html_e( 'Convert standard numbers (0-9) to Arabic numerals (٠-٩)', 'ngarab' ); ?></span>
									</label>
								</td>
							</tr>
						</table>
						
						<div class="ngarab-preview-container">
							<span class="ngarab-preview-label"><?php esc_html_e( 'Live Preview', 'ngarab' ); ?></span>
							<div class="ngarab-preview-box">
								<div id="ngarab-settings-preview">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>
							</div>
						</div>

						<div class="ngarab-submit-wrap">
							<?php submit_button(); ?>
						</div>
					</section>
				</div>

				<aside class="ngarab-sidebar">
					<section class="ngarab-card">
						<div class="ngarab-sidebar-section">
							<h3><?php esc_html_e( 'Documentation', 'ngarab' ); ?></h3>
							<div class="ngarab-info-pill">
								<p><?php esc_html_e( 'To display Arabic text anywhere, use the shortcode:', 'ngarab' ); ?></p>
								<code>[ngarab font="amiri" color="#ff0000"]...[/ngarab]</code>
							</div>
						</div>
						
						<div class="ngarab-credits">
							<p><?php esc_html_e( 'Created with ❤️ by', 'ngarab' ); ?></p>
							<div class="ngarab-author-row">
								<div class="ngarab-author-info">
									<img src="<?php echo esc_url( $avatar ); ?>" alt="Author Avatar">
									<span><?php echo esc_html( $author_name ); ?></span>
								</div>
							</div>
							<div class="ngarab-contact-row">
								<a href="https://github.com/khoirulaksara" target="_blank" class="ngarab-contact-link" title="<?php esc_attr_e( 'GitHub Profile', 'ngarab' ); ?>">
									<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.041-1.416-4.041-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
								</a>
								<a href="mailto:khoirulaksara@gmail.com" class="ngarab-contact-link" title="<?php esc_attr_e( 'Email Support', 'ngarab' ); ?>">
									<span class="dashicons dashicons-email"></span>
								</a>
								<a href="https://log.serat.us" target="_blank" class="ngarab-contact-link" title="<?php esc_attr_e( 'Visit Website', 'ngarab' ); ?>">
									<span class="dashicons dashicons-admin-links"></span>
								</a>
							</div>
						</div>
					</section>
				</aside>
			</div>
		</form>
	</div>
	<?php
}

/**
 * Add settings link in admin menu.
 */
function ngarab_admin_menu() {
	add_options_page(
		__( '(ng)Arab Settings', 'ngarab' ),
		__( '(ng)Arab', 'ngarab' ),
		'manage_options',
		'ngarab',
		'ngarab_settings_page'
	);
}

/**
 * Register TinyMCE button for Classic Editor.
 */
function ngarab_add_tinymce_button() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( 'true' === get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'ngarab_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'ngarab_register_tinymce_button' );
	}
}

function ngarab_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['ngarab'] = plugins_url( 'assets/js/editor.js?v=' . NGARAB_VERSION, dirname( __FILE__ ) );
	return $plugin_array;
}

function ngarab_register_tinymce_button( $buttons ) {
	array_push( $buttons, 'ngarab' );
	return $buttons;
}
add_action( 'admin_init', 'ngarab_add_tinymce_button' );

/**
 * Enqueue admin scripts and styles.
 */
function ngarab_admin_assets( $hook ) {
	// Settings Page Assets
	if ( 'settings_page_ngarab' === $hook ) {
		wp_enqueue_style(
			'ngarab-admin-css',
			plugins_url( 'assets/css/admin.css', dirname( __FILE__ ) ),
			array(),
			NGARAB_VERSION
		);

		wp_enqueue_script(
			'ngarab-settings-js',
			plugins_url( 'assets/js/settings.js', dirname( __FILE__ ) ),
			array(),
			NGARAB_VERSION,
			true
		);
	}

	// Load fonts for TinyMCE modal on post/page editing screens
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		wp_enqueue_style(
			'ngarab-editor-preview',
			plugins_url( 'assets/css/wedak.css', dirname( __FILE__ ) ),
			array(),
			NGARAB_VERSION
		);
	}
}
