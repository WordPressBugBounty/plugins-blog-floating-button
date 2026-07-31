=== Blog Floating Button ===
Contributors:1meril
Donate link: https://bfb-plugin.com/
Tags: announcement,banner,footer banner,floating banner,fixed banner
Requires at least: WordPress 6.0
Tested up to: 7.0
Requires PHP: 8.2
Stable tag: 1.4.21
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Blog Floating Button (BFB) adds customizable floating buttons to your WordPress site and directs visitors to key landing pages.

== Description ==

Blog Floating Button (BFB) makes it easy to add floating buttons to your WordPress site. Use them to guide visitors to landing pages, such as product or contact pages, and encourage purchases or inquiries.

From the WordPress admin area, you can change the button text and choose from four button styles and five colors. This makes it easy to create a prominent floating button that matches your site's design.

### How to Use

= General Settings =

Configure the settings shared by all floating buttons.

<ul>
	<li>Development mode: Select "Show only to administrators" to display floating buttons only to users logged in as administrators. This is useful during initial setup. Select "Show to everyone" when you are ready to display them to all visitors.</li>
	<li>Desktop button design: Choose the button design shown to visitors using desktop computers.</li>
	<li>Mobile button design: Choose the button design shown to visitors using mobile devices.</li>
	<li>Homepage display: Choose how floating buttons appear on the homepage.</li>
	<li>Excluded post IDs: Floating buttons are hidden on posts and pages with the specified IDs. Enter the IDs of pages where you do not want a button to appear, such as a contact page.</li>
	<li>Auto-hide: Automatically hide floating buttons when a visitor scrolls the page. Select "Always show" to turn off auto-hide.</li>
	<li>Enable click tracking: Choose whether to track button clicks.</li>
	<li>Exclude administrators from click tracking: Choose whether to track clicks from users logged in as administrators. For more accurate data, excluding administrators is recommended except during testing.</li>
	<li>PRO version license key: Enter a paid PRO version license key to unlock additional features.</li>
</ul>

= Button Settings =

Configure each floating button individually.

<ul>
	<li>Button type: Choose the button shape.</li>
	<li>Button color: Change the button color.</li>
	<li>Button text: Set the text displayed on the button.</li>
	<li>Destination URL: Set the URL that opens when a visitor clicks the button.</li>
	<li>Link behavior: Choose how the link opens. Select "New tab" to open it in a separate browser tab.</li>
	<li>Background color: Change the color of the bar behind the button.</li>
</ul>

This plugin bundles the Montserrat font (SIL Open Font License 1.1).
See css/fonts/OFL.txt for the full license text.

== Installation ==

= Automatic Installation =

1. In the WordPress admin area, go to Plugins > Add New.
2. Enter "Blog Floating Button" and click "Search Plugins."
3. When the plugin appears, click "Install Now."
4. After installation, activate the plugin.

= Manual Installation =

1. Download the plugin.
2. Extract `blog-floating-button-latest.zip`.
3. Upload the extracted plugin folder to `/wp-content/plugins/`.
4. In the WordPress admin area, go to Plugins > Installed Plugins and activate the plugin.

== Changelog ==
= 1.4.21 =
Security release.
Fixed a stored XSS vulnerability in the access analytics report screen.
Fixed a SQL injection vulnerability in the report screen's search and filter parameters.
Fixed an error-reporting issue that could disclose server paths.
Completed a plugin-wide review of output escaping and input sanitization.
Addressed Plugin Check findings.

= 1.4.20 =
Adjusted error reporting levels.

= 1.4.19 =
Fixed an issue with the preview feature.
Fixed an issue with the A/B testing feature.

= 1.4.18 =
Improved license activation performance.

= 1.4.17 =
Allowed the `<br>` tag in button text.
Increased the URL character limit to 500.
Updated the conditions that control button visibility.
Fixed an issue with the "Plugin Information" tab.

= 1.4.16 =
Fixed issues with the `[bfb_show]` and `[bfb_hide]` shortcodes.
Fixed issues with the desktop and mobile button display trigger areas.
Improved plugin output handling.

= 1.4.15 =
Added support for PHP 8.1.x.
Added support for PHP 8.2.x.
Added support for WordPress 6.5.
Fixed an issue that occurred when jQuery Migrate was not loaded.
Added per-post settings for custom post types.

= 1.4.14 =
Added a log deletion feature.
Added a settings export feature.
Added support for WordPress 6.3.2.

= 1.4.13 =
Addressed security vulnerabilities.
Fixed minor issues.

= 1.4.12 =
Updated the help content.
Added support for PHP 8.1.0.
Added support for WordPress 6.1.1.

= 1.4.11 =
Fixed minor issues.

= 1.4.10 =
Expanded the help content.
Fixed minor issues.

= 1.4.9 =
Fixed an issue that cleared the PRO version license key and other settings when an individual post was updated.

= 1.4.8 =
Fixed an issue with hidden pages in the PRO version.
Fixed an issue that prevented some saved settings from being deleted.
Updated how the chart display script is loaded.
Fixed access analytics for WordPress installations in a subdirectory.

= 1.4.7 =
Fixed an issue that prevented per-post settings from being saved in some environments.

= 1.4.6 =
Improved security.
Fixed minor issues.

= 1.4.0 =
Added A/B testing.
Updated the live preview system.
Improved data verification and validation.
Fixed minor issues.

= 1.3.4 =
Changed the click-tracking report from impression count to user count.

= 1.3.3 =
Added charts to the click-tracking report.

= 1.3.1 =
Made minor improvements to click tracking.

= 1.3.0 =
Released the click-tracking feature.

= 1.2.3 =
Resolved undefined variable and undefined index errors.
Added a setting for how long buttons remain hidden via cookies.

= 1.2.1 =
Added color controls for microcopy, descriptions, and button text.
Allowed HTML in the top text and description fields.
Fixed minor issues.

= 1.2.0 =
Released per-category settings for the PRO version.
Fixed script loading errors.
Added floating button spacing controls.

= 1.1.7 =
Made minor improvements and added help content.

= 1.1.6 =
Fixed an issue that prevented links from opening in a new tab.

= 1.1.5 =
Fixed the editor screen layout.

= 1.1.4 =
Initial working version.

== Screenshots ==

1. Floating button demo
2. Button settings
3. Access analytics report chart

== Frequently Asked Questions ==

== Upgrade Notice ==

= 1.4.21 =
Security release. Please update as soon as possible.
