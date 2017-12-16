=== Goo.gl Shortlinks ===
Contributors: cochran, ronalfy
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=TLKVZFHV64ZS4&lc=US&item_name=Christopher%20Cochran&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: Goo.gl, URL shortener, shortlinks
Requires at least: 3.0
Tested up to: 3.1.1
Stable tag: trunk

Allows automatic url shortening of post links using goo.gl URL Shortener. 

== Description ==

The default method of WordPress' implementation of shortlinks adds ?p={post-id} to the end of your site name in place of the full URL. Though this can indeed shorten your link quite significantly; if you have a long site name it still might not be as effective.

This WordPress plug-in allows automatic url shortening of post links with goo.gl URL Shortener using the API recently provided by Google in place of the default ?p={post-id}.

For Example:  
WordPress "shortlink": http://christophercochran.me/?p=47 (not so short is it?)  
Shortlink created with the goo.gl API : http://goo.gl/Tqczu (I can haz more to say about my awesome link on Twiter now – YAY)

== Installation ==

1. Upload the entire 'goo.gl-shortlinks' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to the 'Settings > Goo.gl Shortlinks' menu
4. Add your API key for a higher usage limits 'Homepage Teasers'

== Frequently Asked Questions ==

= What is goo.gl? =

goo.gl is a service that takes long URLs and squeezes them into fewer characters to make a link easier to share, tweet, or email to friends. For example, the short URL http://goo.gl/O2jpy is a convenient shorthand representation for the long URL http://christophercochran.me/.

Goo.gl short URLs are randomly generated, and the mappings of short URLs to long URLs are publicly accessible. Additionally, the short URL to long URL mappings are:

Immutable – once created by you, no one else can change them
Irrevocable – once created, they do not expire. Note, however, that Google reserves the right to remove any goo.gl short URL, for example for spam, security or legal reasons

= Why use the Google URL Shortener? =

People share a lot of links online. This is particularly true as microblogging services such as Twitter and Google Buzz have grown in popularity. With character limits in tweets, status updates, and other modes of short form publishing, a shorter URL leaves more room to say what's on your mind.

Google's global production infrastructure to provide users with the following benefits:

Stability – *reliable service with good uptime*
Security – *warning message if the short URL points to a suspected malware, phishing, or spam website*
Speed – *fast resolution of short URLs (in a few milliseconds)*

= Why and where should I get an API Key? =

**Why you should get a key**  
Higher usage limits. Without an API key, we don't know who you are, and we're pretty shy. You'll be subject to anonymous usage limits, and those are very, very low. Your requests will fail when you exceed your limits. With an API key, you'll have very high usage limits — high enough to accommodate most applications' needs.
Traffic reports. With an API key, you also get access to fun graphs of your API usage on the APIs Console.

**How to get a key**  
Visit the Google APIs Console and:

Create a project. You can create as many or as few projects as you need. (See the Google APIs Console FAQ for details.) We will generate exactly one key per project.
Activate the URL Shortener API. After creating a project, you should see a list of APIs, each with an Activate button. Click on ours.
Nab the key. Click "Keys" on the left-hand side to find out about yours. The "Value" is the string you want.

= I don’t see the "get shortlink" button in my post page? =

Shortlinks will only be generated on a post save. Don’t want to exceed our limit now do we?

== Screenshots ==

1. Get shortlink popup
2. Goo.gl Shortlinks Settings page
3. History: 10 Most recent shortend URLs ( only available when authenticate. )


== Changelog ==

= 1.0 =
* Initial release. 
= 1.1 =
* Authentication. This will allow any shortlinks created in this app to be available on the user's dashboard at goo.gl. 
* History within dashboard: Displays 10 most recent shortend URLs.
= 1.1.1 = 
* Added uninstall option (removes options when plugin is deactivated and deleted).
= 1.1.2 = 
* Fixed an issue when having no API Key entered may call generation of a shortlink to fail even when google API wasn't exhausted. 

== Coming Soon ==


= 1.2 =
* In post link statistics with referrers, clicks, and browser stats.
* Shortcode to place short links inside a post for users to copy.