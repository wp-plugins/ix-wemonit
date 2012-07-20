=== IX WeMonit ===
Contributors: ixiter
Donate link: http://ixiter.com/plugins/ix-wemonit/
Tags: WeMonit, Server Monitoring
Requires at least: 3.4
Tested up to: 3.4
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show the data of your WeMonit Services. The Plugin comes with a widget, shortcodes and template tags.

== Description ==

[WeMonit](http://wemonit.de/ "WeMonit Services") is a service, that monitors your server/webseite availability. They offer a free plan, where you can setup 5 services and you got notified by email and iOS-Push, when your server is down.

IX WeMonit helps you to display these monitor stats as text and image. The plugin comes with a typical sidebar widget with lots of options, and also shortcodes and template tags for the same options and to display data graphs.

On the plugins options page, you have to set up your API Key for your WeMonit account. After the plugin connected to WeMonit, it shows all available services and related shortcodes and template tags.
The widget will appear in the widget section of your theme.
As a "special feature", the plugin adds shortcode ability to sidebar widgets.  By installing this plugin, you can use all shortcodes in text widgtes, like you used to do in articles and pages.
So if you dont like the built in widget, you can easily create your own customized widget. i.e. you can even add the graphs to a wide footer widget.

The following data is available by the plugin, via shortcode and template tag

* Age - The number of seconds the service is monitored by WeMonit
* Timespan - A formatted Textsnippet to display the age as days and hours
* CurrentLatency - The current latency of your WeMonit service
* IP4 Uptime Percent - Your services uptime in %, in the IP4 network
* IP4 Downtime - The number of downtimes of your service in the IP4 network
* IP4 Downtime Percent - Your services downtime in %, in the IP4 network
* IP6 Uptime Percent - Your services uptime in %, in the IP6 network
* IP6 Downtime - The number of downtimes of your service in the IP6 network
* IP6 Downtime Percent - Your services downtime in %, in the IP6 network

The graphs are only available with shortcodes and template tags

* IP4 Latency - A latency graph with one week on the horizontal scale for the IP4 network
* IP4 Uptime - An uptime graph with one week on the horizontal scale for the IP4 network
* IP6 Latency - A latency graph with one week on the horizontal scale for the IP6 network
* IP6 Uptime - An uptime graph with one week on the horizontal scale for the IP6 network

The shortcode and template tag names follow a simpe pattern and uses only one attribute/paramter, the service ID.

* Example shortcode: `[ix_wemonit_getIp4CurrentLatency id="1234"]`
* Example template tag: `<?php echo ix_wemonit_getIp4CurrentLatency('1234'); ?>`

== Installation ==

1. Upload the complete `ix-wemonit` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in the WordPress admin page.
3. Create an account at [WeMonit](http://wemonit.de/ "WeMonit Services") and setup minimum 1 service
4. Generate an API Key in your WeMonit account and enter it or your WeMonit login data on the plugins options page
5. Save Changes on the plugins options page
6. Done

== Frequently Asked Questions ==

= Is it possible to retrieve detailed logs to generate own graphs =

Not yet. You would need to extend the plugin and log the data by yourself. WeMonit shows more detailed graphs on their pages. Maybe they will add these to the API somewhen.

== Screenshots ==

1. The options page. Nothing but the apikey is required. Then it shows all available services with related shortcodes and template tags.
2. The build in widget control

== Changelog ==

= 1.0 =
* July, 18th 2012
* First public version

= 0.0.1 =
* July, 18th 2012
* I read about WeMonit the first time, found the API and my first thought was on a plugin.

== Upgrade Notice ==
First public version

== Links ==
Use the following links to stay tuned with the plugin development.
* [WP Plugin Directory](http://wordpress.org/extend/plugins/ix-wemonit/ "IX WeMonit in the WP Plugin Directory")
* [Download](http://downloads.wordpress.org/plugin/ix-wemonit.zip "Download IX WeMonit from the WP Plugin Directory")
* [WP Plugin Forum](http://wordpress.org/support/plugin/ix-wemonit/ "The IX WeMonit support forum")
* [WP SVN repository](http://plugins.trac.wordpress.org/browser/ix-wemonit/ "Browse the SVN repository")
* [Google Code Git repository](http://code.google.com/p/ix-wemonit-wordpress-plugin/ "Browse the GIT repository")
