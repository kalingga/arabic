=== (ng)Arab ===
Contributors: khoirulaksara
Donate link: https://paypal.me/gonzsky
Tags: arabic, font, quran, typography, lpmq
Requires at least: 5.0
Tested up to: 6.7
Stable tag: 3.0.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Professional Arabic typography for WordPress. Display beautiful Arabic text with high-performance WOFF2 fonts, colorization, transliterations, and full Gutenberg support.

== Description ==

**(ng)Arab** (pronounced 'Ngarab') is designed for bloggers, scholars, and developers who want to display Arabic text, such as Quranic verses or Hadiths, with high-quality typography and maximum legibility.

The plugin utilizes professional Arabic fonts in lightweight WOFF2 format, ensuring aesthetic appeal and lightning-fast performance for any international project.

* **Gutenberg Ready**: Full support for the Block Editor with a native (ng)Arab block.
* **Font Selection**: Choose from 6+ professional Arabic fonts including LPMQ, Amiri, and Scheherazade.
* **Transliteration & Translation**: Add Latin reading and meaning labels directly under the Arabic text.
* **Color Customization**: Easily change the color of your Arabic text via a built-in color picker.
* **Copy to Clipboard**: One-click copy button for your visitors to easily grab the Arabic text.
* **Performance First**: Uses standardized WOFF2 format for minimal impact on page load speed.
* **Shortcode Helper**: Convenient button integrated into both Classic and Block editors.

== Installation ==

1. Upload the `ngarab` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Configure your preferred global settings under **Settings -> (ng)Arab**.
4. Use the **(ng)Arab block** in Gutenberg or the `[ngarab]` shortcode to insert your text.

== Frequently Asked Questions ==

= How do I use the new features? =
For the best experience, use the **(ng)Arab block** in the Gutenberg editor. If you prefer shortcodes, use: `[ngarab font="amiri" color="#ff0000" trans="Bismillah" trj="In the name of Allah" copy="yes"] Teks Arab [/ngarab]`.

= Where can I change the global font settings? =
Navigate to **Settings -> (ng)Arab** in your WordPress dashboard to find all customization options and live previews.

== Privacy Policy ==

**(ng)Arab** offers two methods for rendering Arabic typography:

1. **Local Hosting (Recommended):** By default, the plugin uses high-performance WOFF2 fonts stored locally within the plugin directory. No data is sent to external servers in this mode, ensuring maximum privacy and GDPR compliance.

2. **Google Fonts Integration:** As an optional feature, users may choose to load additional fonts via the Google Fonts API. Please note that using this feature involves standard browser requests to Google's servers, which may include the user's IP address and browser user-agent string according to Google's privacy policy.

No personal user data is collected, stored, or shared by the plugin itself.

== Screenshots ==

1. Beautiful Arabic text displayed on the frontend with transliteration.
2. The settings page for customizing global typography and selecting fonts.
3. Shortcode helper button integrated into the Classic Editor toolbar.
4. Native (ng)Arab block interface in the Gutenberg editor.

== Upgrade Notice ==

= 3.0.0 =
Initial Official WordPress.org Release. This version includes full Gutenberg support, premium typography, and repository-compliant security updates.

== Changelog ==

= 3.0.0 =
* **Initial Official Release**.
* **Gutenberg Ready**: Full support for the Block Editor with a native (ng)Arab block.
* **Classic Editor Support**: Integrated TinyMCE shortcode generator.
* **Premium Typography**: 6+ professional Arabic fonts including LPMQ, Amiri, and Lateef.

* **Advanced Features**: Live transliteration, translation, and color customization.
* **User Experience**: One-click Copy to Clipboard functionality.
* **Performance**: Optimized WOFF2 font loading and modular script architecture.
* **Compliance**: 100% WordPress.org guideline compliant code and sanitization.

= 2.0.0 (Internal Release - 2015) =
* **Performance Optimization**: Migrated font assets from .ttf to .woff2 format for significantly faster loading times.
* Improved cross-browser compatibility for Arabic script rendering.

= 1.0.0 (Private Release - 2014) =
* Initial private release for internal projects and specific clients.
* Core features for converting Latin text to (ng)Arab characters.
