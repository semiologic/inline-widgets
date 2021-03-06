=== Inline Widgets ===
Contributors: Denis-de-Bernardy & Mike_Koepke
Donate link: https://www.semiologic.com/donate/
Tags: semiologic
Requires at least: 2.8
Tested up to: 4.3
Stable tag: trunk

Lets you insert any widget in the contents of your posts and pages.


== Description ==

The Inline Widgets plugin for WordPress lets you insert any widget within the content of your posts and pages -- rather than merely in a sidebar.

You may also find its parent project, the Feed Widgets plugin, of interest.


= Placing a widget in your content =

It's short and simple:

1. Browse Appearance / Widgets
2. Open the Inline Widgets panel ("sidebar", in the WP jargon)
3. Place whichever widgets you want in that panel
4. Edit your post or page
5. Notice the Widgets dropdown menu
6. Select your widget in that dropdown menu, and it'll insert your widget where your mouse cursor is at


Common uses for this plugin include:

- A contact form widget
- A newsletter subscription form widget
- A silo stub or map widget
- A recent updates widget before or after a silo stub
- An author image widget, in the event you only want those in some posts or pages
- A text widget with arbitrary information you're inserting in multiple posts or pages

The list goes on, and on. Your imagination is the only limit.


= Help Me! =

The [Semiologic forum](http://forum.semiologic.com) is the best place to report issues.


== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Change Log ==

= 2.5 =

- WP 4.3 compat
- Tested against PHP 5.6

= 2.4.1 =

- Fix versioning issue with 2.3.2/2.3.3.   Inline widgets dropdown not showing on some sites.

= 2.4 =

- WP 4.0 Compat

= 2.3.3 =

- Broke WP 3.9/TinyMCE4 inline widgets in toolbar with 2.3.1 change.  Guess nobody noticed.

= 2.3.2 =

- TinyMCE 3 and 4 used different editor initialization settings.  Change to support both now when adding the inline widgets dropdown.

= 2.3.1 =

- Use more full proof WP version check to alter plugin behavior instead of relying on $wp_version constant.

= 2.3 =

- Changes for WP 3.9/TinyMCE compatibility
- Code refactoring
- Disable quicktags functionality

= 2.2.1 =

- WP 3.8 compat

= 2.2 =

- WP 3.6 compat
- PHP 5.4 compat

= 2.1.2 =

- Resolved unknown index warnings

= 2.1.1 =

- Fixed null array call warning

= 2.1 =

- Resolved unknown index warnings
- WP 3.5 compat

= 2.0.4 =

- PHP notices

= 2.0.3 =

- WP 3.0.1 compat
- Make admin area script validate

= 2.0.2 =

- Avoid using broken WP functions

= 2.0.1 =

- Fix conflict with phpzon

= 2.0 =

- Complete rewrite
- WP_Widget class
- Shortcode-based
- Localization
- Code enhancements and optimizations
