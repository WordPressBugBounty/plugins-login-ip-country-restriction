=== Login IP & Country Restriction ===
Contributors: Iulia Cazan
Tags: country restriction, login restriction, block country, block IP, country firewall
Requires at least: 5.1
Tested up to: 7.1
Stable tag: 6.8.3
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JJA37EHZXWUTJ

Tighten your website security and fight against dictionary bot attacks originating from other countries, by denying access.


== Description ==

**Login IP & Country Restriction** hooks into the WordPress authentication system to give you complete control over who can even attempt to access your login page. By default, all access is allowed until you configure specific rules to whitelist or blacklist logins by explicit IP addresses or entire countries.

This plugin is highly effective at stopping massive botnet brute-force attempts before they strain your server resources.

### 🔒 Core Features (100% Free)
* **IP Restriction:** Allow or block specific IP addresses (supports local loops like 127.0.0.1 and IPv6).
* **Country Restriction:** Whitelist or blacklist entire countries from accessing the authentication filters.
* **Independent Logic:** Run IP rules only, country rules only, or combine both together for maximum security.
* **Smart Redirects:** Configure custom behavior to automatically redirect restricted traffic back to the front page.
* **XML-RPC Protection:** Secure authentication methods beyond standard web forms.
* **Data Portability:** Quickly export and import your security settings, and check status details for debugging.

### 💎 Take Your Security Further with Pro
**Login IP & Country Restriction Pro** adds:
* Additional rule types
* Redirect restricted login (404 or 403 with a custom message)
* Lockout duration and individual user lockout
* WooCommerce integration (automatically allow the countries of new customers)
* Bypass the IP and country restrictions for specific roles
* Single IP login per user
* Simulate an IP or country to test your rules

[Explore Login IP & Country Restriction Pro &rarr;](https://iuliacazan.ro/wordpress-extension/login-ip-country-restriction-pro/)

*Important Safety Note:* Please ensure you always configure the plugin to allow your own IP address or country before locking down settings so you do not accidentally lock yourself out!


== Installation ==

1. Upload the `login-ip-country-restriction` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Navigate to the new settings panel to set up your allowed IPs and countries.


== Frequently Asked Questions ==

= Do I need a third-party API key for this plugin to work? =
No. Out of the box the plugin uses the PHP GeoIP extension when it is available on the server, otherwise the free ipapi.co lookup. Optionally, you can add API keys for the geolocated.io, ip2location.io or geoplugin.net services in the integration settings. The lookup method that works for your server is remembered for a few hours.

= My site is behind Cloudflare, what should I do? =
Enable the option to trust the Cloudflare visitor IP (HTTP_CF_CONNECTING_IP) in the IPs settings. Enable it only if the site is really behind Cloudflare, because otherwise visitors could spoof that header. Sites that were already using the plugin keep this enabled until the settings are saved.

= Can I block both an IP and a country at the same time? =
Yes. Both types of restrictions work entirely independently of one another. You can restrict by country, whitelist a few specific external IPs, or use both methods simultaneously.

= Help! I locked myself out. What do I do? =
If you accidentally lock yourself out by misconfiguring your country or IP whitelist, don't panic. Simply log into your server via FTP or hosting File Manager, rename the plugin folder from `login-ip-country-restriction` to `login-ip-country-restriction-temp` to temporarily disable it, log back into WordPress, rename it back, and correct your configuration.


== Screenshots ==

1. Main configuration dashboard for login restriction rules and XML-RPC methods.
2. IP restriction interface showing easy management of allowed and blocked IPs.
3. Country restriction panel with simple multi-select dropdowns for whitelists and blacklists.
4. Redirect settings to manage blocked visitors.
5. Tools layout for importing/exporting configurations and reviewing debug details.


== License ==
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.


== Upgrade Notice ==
None


== Changelog ==

= 6.8.3 =
* Tested up to 7.1
* Security hardening: validate the detected IP, capability check on settings save
* Added the opt-in option to trust the Cloudflare visitor IP header (existing installs keep the current behavior until settings are saved)
* Fixed the multisite transients cleanup query
* Fixed the registration redirect also applying to the login page
* Pro: WooCommerce customers countries collection is compatible with HPOS order storage (the classic storage is still supported)
* Pro: the lockout duration now locks the user out after a restricted login attempt (the country lookup cache is now fixed at 1 hour); saving the settings clears the lockouts
* Lower timeout and proper Accept header for IP lookups

See the full [changelog](changelog.txt) for detailed information on changes made in the earlier versions.
