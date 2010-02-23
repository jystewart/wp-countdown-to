=== WP Countdown To ===
Contributors: jystewart
Tags: limitations, cms, timing, countdown
Requires at least: 2.7.0
Tested up to: 2.9.2
Stable tag: trunk
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10973638

Provide a count down to a set date and optionally close comments after that date.

== Description ==

When running wordpress for short term projects it can be useful to be able to count down to 
the end point of the project. And often you'll want to close comments after that point.

This plugin will allow you to do that, providing a hook to close comments and a helper to
show the countdown (in days) on your site.

To show the countdown add the following to your theme:

<?php countdown_days_remaining() ?>

Please Note: This plugin is only tested on PHP5 and may not work on earlier versions.

== Installation ==

1. Upload `wp-countdown-to` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the Countdown To option under Settings and make the appropriate entries

== Frequently Asked Questions ==

There are no frequently asked questions as yet.

== Screenshots ==

1. The settings page in use

== Upgrade Notice ==

No upgrade steps necessary

== To Do ==
* Add automated tests
* Solicit user feedback on further options

== Changelog ==

= 1.0 =
* Consolidated code in use in various projects
* Prepared for first release
