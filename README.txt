=== Simple Recent Posts Slider ===
Contributors: narthur
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=narthur%2ea%40gmail%2ecom&lc=US&item_name=Wp%20Bootstrap%20Recent&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: content slider, html slider, media object, responsive, responsive slider, slider, slideshow, shortcode, bootstrap, twitter bootstrap, posts, recent posts, recent, carousel, content slideshow, horizontal slider, javascript, jquery, posts slider, slider plugin, thumbnail, thumbnails slider, wordpress slider, best slider, free slider, categories
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a light-weight and responsive recent posts slider shortcode.

== Description ==

# Features

* Easy to install using a shortcode
* Responsive
* Light weight
* Easy to style using CSS
* Automatically pulls in post featured-image thumbnails

# Using the Shortcode

Simply drop this string into any post or page:

    [recent_slider_lite]

## Options

Add option/value pairs to the shortcode in order to override defaults like this:

    [recent_slider_lite quantity=5 category=category_name]

Available options include:

* quantity (defaults to 3)
* category

# Styling using CSS

Classes:

| Class                                        | Description               |
|----------------------------------------------|---------------------------|
| `.unslider`                                  | Outer wrapper             |
| `.bootstrap-slider`                          | Inner wrapper             |
| `.unslider-arrow.next, .unslider-arrow.prev` | Next and previous buttons |
| `.media-left`                                | Thumbnail area            |
| `.media-body`                                | Content area              |
| `.media-heading`                             | Post title                |
| `.btn`                                       | "Read More" button        |

For more information, see [Bootstrap 3's media object documentation](http://getbootstrap.com/components/#media).

== Installation ==

1. Upload `wp-bootstrap-recent` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Place the `[recent_slider_lite]` shortcode within any post or page.

== Frequently Asked Questions ==

= How do I set a post's thumbnail to be displayed in the slider? =

In the post edit screen, set your image as that post's featured image. [See WordPress' documentation for more
information.](https://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail)

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot
