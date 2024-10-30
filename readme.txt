=== LH Paragraph Ids ===
Contributors: shawfactor
Donate link: http://lhero.org/portfolio/lh-paragraph-ids/
Tags: paragraphs, links, html, html5, fragment, id, indieweb, rdf
Requires at least: 5.2
Tested up to: 6.0
Stable tag: 2.00

LH Paragraph Ids is a WordPress plugin that adds ids to paragraph and heading elements within singular posts, pahes and custom post types.

== Description ==

LH Paragraph Level IDs plugin adds an ‘id’ attribute to each paragraph tag in a blog post, giving the author and readers additional functionality.

So for example, `<p>` becomes `<p id="lh_element_id-p-23463-3">`.

Note if an id for an element already exists, it is kept. Also note this is done dynamically so ar no time is the content stored in the database changed.

There is also an optional feature to add a link to the paragraph symbol at the end of the post, like this. ¶ See faq for enabling this.

These additions allow anyone to link directly to that paragraph in the post. This is useful for long tracts of text and is also useful for rdf and semantics (in that these technologies often require identification of parts of a page).

**Requires wp_body_open**

Note this plugin requires wordpress 5.2 and for your theme to support the wp_body_open hook (most good themes do).

**Like this plugin? Please consider [leaving a 5-star review](https://wordpress.org/support/view/plugin-reviews/lh-paragraph-ids/).**

**Love this plugin or want to help the LocalHero Project? Please consider [making a donation](https://lhero.org/portfolio/lh-paragraph-ids/).**

== Installation ==

Install using WordPress:

1. Log in and go to *Plugins* and click on *Add New*.
1. Search for *LH Paragraph Ids* and hit the *Install Now* link in the results. WordPress will install it.
1. From the Plugin Management page in WordPress, activate the *Lh Paragraph Ids* plugin.
1. That is it , the plugin has no settings (it just works), but has filters to modify its behaviour, see faq.

== Frequently Asked Questions ==

= How do I enable automatic paragraph links? =

By default, automtic paragraph links are turned off, they can be turned on by a filter like this:

add_filter('lh_paragraph_ids_link_enabled', function(){
    //Do something with the content
    return true;
});

= What happens if I deactiavte this plugin?  =

The plugin does not add anything to the content stored in the database, all attributes are added dynamically by the plugin. So you can safely deactivate the plugion if you no longer want the functionality it enables

= Can you give me some examples of sites running this plugin?  =

The [LocalHero project website](https://lhero.org) and the [Melbourne Touch rugby association](https://princesparktouch.com) I founded both run on the same multisite that runs this plugin. View source to see it in action, the additonal ¶ functionality is not enabled.

= Can you give me some examples of sites running this plugin?  =

The [LocalHero project website](https://lhero.org) and the [Melbourne touch rugby association](https://princesparktouch.com) I founded both run on the same multisite that uses this plugin.

= What is something does not work?  =

LH Paragraph Ids, and all [LocalHero](https://lhero.org) plugins are made to WordPress standards. Therefore they should work with all well coded plugins and themes. However not all plugins and themes are well coded (and this includes many popular ones). 

If something does not work properly, firstly deactivate ALL other plugins and switch to one of the themes that come with core, e.g. twentyfirteen, twentysixteen etc.

If the problem persists please leave a post in the support forum: [https://wordpress.org/support/plugin/lh-paragraph-ids/](https://wordpress.org/support/plugin/lh-paragraph-ids/). I look there regularly and resolve most queries.

= What if I need a feature that is not in the plugin?  =

Please contact me for custom work and enhancements here: [https://shawfactor.com/contact/](https://shawfactor.com/contact/).


== Changelog ==

**0.01 July 29, 2014**  
Initial release.

**0.02 April 29, 2015**  
Only filter content on front end

**1.00 July 13, 2015**  
Object oriented code

**2.00 August 07, 2022**  
Removed settings, improved and simplified