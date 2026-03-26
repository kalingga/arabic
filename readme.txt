=== (ng)Arab ===
Contributors: khoirulaksara
Donate link: https://paypal.me/gonzsky
Tags: arabic, font, quran, typography, lpmq
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 3.1.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Professional Arabic typography. Display beautiful Arabic text with high-performance fonts, colorization, transliterations, and Gutenberg support.

== Description ==

**(ng)Arab** (pronounced 'Ngarab') is designed for bloggers, scholars, and developers who want to display Arabic text, such as Quranic verses or Hadiths, with high-quality typography.

The plugin utilizes professional Arabic fonts in lightweight WOFF2 format, ensuring maximum legibility and aesthetic appeal for any international project.

* **Gutenberg Ready**: Full support for the Block Editor with a native **(ng)Arab** block.
* **Font Selection**: Choose from 6+ professional Arabic fonts including **LPMQ**, **Amiri**, and **Scheherazade**.
* **Transliteration & Translation**: Add latin reading and meaning labels directly under the Arabic text.
* **Color Customization**: Easily change the color of your Arabic text via a color picker.
* **Copy to Clipboard**: One-click copy button for your visitors to easily copy the Arabic text.
* **Standardized Font**: Lightweight WOFF2 format for lightning-fast performance.
* **Shortcode Helper**: Convenient button in both Classic and Block editors.

== Installation ==

1. Upload the `arabic` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the `[ngarab]` shortcode or the new **editor button** to insert your Arabic text.

== Frequently Asked Questions ==

= How do I use the new features? =
You can use the **(ng)Arab block** in Gutenberg for the best experience. For shortcodes, use: `[ngarab font="lateef" color="#ff0000" trans="Bismillah" trj="Dengan nama Allah" copy="yes"] Teks Arab [/ngarab]`.

= Where can I change the font and size? =
Navigate to **Settings -> (ng)Arab** in your WordPress dashboard to find all customization options.

== Screenshots ==

1. Arabic text displayed.
2. The settings page for customizing typography and selecting fonts.
3. Shortcode helper button in the editor toolbar.
4. Block editor interface.

== Upgrade Notice ==

= 3.1.0 =
Arabic Number Conversion & Enhanced RTL Editor. This update adds support for converting Western digits to Arabic numerals and improves the right-to-left editing experience.

= 3.0.0 =
Initial Official Release. This version includes full Gutenberg support, premium typography, and repository-compliant security updates.

== Changelog ==

= 3.1.0 =
* **Arabic Number Conversion**: Added feature to convert Western digits (0-9) to Arabic numerals (٠-٩).
* **Text Alignment**: Added option for Left, Center, and Right alignment.
* **Global Settings**: Added a toggle for global number conversion control.
* **Shortcode & Block Support**: New `convert_num` and `align` attributes.
* **Enhanced RTL Editor**: Improved right-to-left support and font styling in the editor modals.
* **Font Update**: Optimized font stacks and set Scheherazade New as the default font.

= 3.0.0 =
* **Initial Official Release**.
* **Gutenberg Ready**: Full support for the Block Editor with a native (ng)Arab block.
* **Classic Editor Support**: Integrated TinyMCE shortcode generator.
* **Premium Typography**: 6+ professional Arabic fonts including LPMQ, Amiri, and Lateef.
* **Advanced Features**: Live transliteration, translation, and color customization.
* **User Experience**: One-click Copy to Clipboard functionality and live font previews.
* **Performance**: Optimized WOFF2 font loading and clean, modular script architecture.
* **Compliance**: 100% WordPress.org guideline compliant code, security, and sanitization.

= 2.0.0 (Internal Release - 2015) =
* **Performance Optimization:** Migrated font assets from .ttf to .woff2 format for significantly faster loading times and smaller file sizes.
* Improved cross-browser compatibility for Arabic script rendering.

= 1.0.0 (Private Release - 2014) =
* Initial private release for internal projects and specific clients.
* Core features for converting Latin text to (ng)Arab characters.
* Basic selection of calligraphy-style fonts.