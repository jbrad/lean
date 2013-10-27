# 1.4 (October 27th, 2013)

## Font Awesome 4
* Updated to Font Awesome 4

## Streamline Stylesheets and LESS Files
* Spent a lot of time removing duplicate styles and utilized Bootstrap a bit more. Brought the style.css file down from 152kb to 129kb.

## Fixed Responsive Issue with Status Post Format
* Added some additional responsive classes

### Change Set

**Modified**
* css/admin.css
* css/editor-style.css
* css/theme-responsive.css
* css/theme.contrast-light.css
* css/less/author-box.less
* css/less/bootstrap.less
* css/less/comments.less
* css/less/footer.less
* css/less/font-awesome.less
* css/less/header.less
* css/less/ie-styles.less
* css/less/misc.less
* css/less/mixins.less
* css/less/navigation.less
* css/less/pages.less
* css/less/posts.less
* css/less/posts.format-aside.less
* css/less/posts.format-audio.less
* css/less/posts.format-chat.less
* css/less/posts.format-link.less
* css/less/posts.format-status.less
* css/less/posts.format-quote.less
* css/less/posts.format-video.less
* css/less/structure.less
* css/less/style.less
* css/less/theme-responsive.less
* css/less/theme.contrast-light.less
* css/less/typography.less
* css/less/variables.less
* css/less/widgets.less
* css/lib/font-awesome/bootstrap.less
* css/lib/font-awesome/core.less
* css/lib/font-awesome/extras.less
* css/lib/font-awesome/fixed-width.less
* css/lib/font-awesome/font-awesome.less
* css/lib/font-awesome/font-awesome-ie7.less
* css/lib/font-awesome/icons.less
* css/lib/font-awesome/larger.less
* css/lib/font-awesome/list.less
* css/lib/font-awesome/mixins.less
* css/lib/font-awesome/path.less
* css/lib/font-awesome/rotated-flipped.less
* css/lib/font-awesome/spinning.less
* css/lib/font-awesome/stacked.less
* css/lib/font-awesome/variables.less
* font/font-awesome/FontAwesome.otf
* font/font-awesome/fontawesome-webfont.eot
* font/font-awesome/fontawesome-webfont.woff
* font/font-awesome/fontawesome-webfont.otf
* font/font-awesome/fontawesome-webfont.svg
* font/font-awesome/fontawesome-webfont.ttf
* inc/theme-styles-and-scripts.php
* includes/author-box.php
* includes/loop.post-meta.php
* lib/activity/css/less/widget.less
* lib/activity/css/widget.css
* lib/ad-125x125/css/widget.css
* lib/ad-300x250/css/widget.css
* lib/ad-billboard/css/widget.css
* lib/influence/css/less/widget.less
* lib/influence/css/widget.css
* lib/influence/views/widget.php
* comments.php
* image.php
* loop.php
* loop-aside.php
* loop-audio.php
* loop-chat.php
* loop-gallery.php
* loop-image.php
* loop-link.php
* loop-quote.php
* loop-status.php
* loop-video.php
* pagination.php
* sidebar.php
* social-networking.php
* template-archives.php
* template-sitemap.php
* style.css
* Gruntfile.js
* bower.json
* 404.php
* comments.php
* js/dev/theme.comments.js
* js/theme.main.min.js

**Added**
* css/less/bootstrap-overrides.less
* css/lib/font-awesome/bordered-pulled.less

**Removed**
* css/less/theme.videopress.less

# 1.3.1 (October 22st, 2013)

## Social Icons
* Added the font size for icon-envelope in navigation.less

### Change Set

**Modified**
* css/less/navigation.less

# 1.3 (October 21st, 2013)

## Utilize Bootstrap 3 Grid Fully
* Replaced JavaScript that was pushing the sidebar down below the content area and using the push and pull classes in Bootstrap 3's grid

## Offline Page Widget Area
* I added a widget area for the offline page.

## Homepage Template Widget Areas
* The homepage template now has widget areas! It also uses your page title and content for the jumbotron area. Enjoy!

## Default Widgets
* The default widgets were replaced by a warning message with a link to Appearance > Widgets so you can add your own.

## Two Levels of Navigation
* Since Bootstrap's Navbar only supports 2 levels of navigation (you can't double dropdown a single dropdown Lloyd), you are now prompted about that in Appearance > Menus.

## Google Analytics Loading Twice
* Fixes an issue that the Google Analytics code is being loaded twice. The theme's SEO is good, but not that good. I like even numbers better anyways.

### Change Set

**Modified**

* css/less/navigation.less
* css/less/variables.less
* css/less/pages.less
* css/less/admin.less
* style.css
* 404.php
* image.php
* inc/theme-custom-filters.php
* inc/theme-features.php
* index.php
* header.php
* page-offline-mode.php
* page.php
* search.php
* sidebar.php
* single.php
* template-archives.php
* template-fullwidth.php
* template-home.php
* template-sitemap.php
* page-offline-mode.php
* lib/Bootstrap_Nav_Walker.class.php
* js/dev/theme.main.js
* js/dev/admin.menu.js
* js/admin.min.js
* Gruntfile.js
* lang/lean.po

# 1.2.2 (October 17th, 2013)

## Add Media
* Fixed issue with being able to upload media to posts and pages

## Gallery Post Format
* Defaulted the gallery images to large so they fill the carousel for gallery post formats

### Change Set

**Modified**

* loop-gallery.php
* js/dev/admin.media-uploader.js

# 1.2.1 (October 16th, 2013)

## 125x125 Ad Widget

## Social Icons

### Change Set

**Modified**

* lib/ad-125x125/views/widget.php
* css/less/navigation.less

# 1.2 (October 8th, 2013)

## Light Contrast Color Scheme

### Change Set

**Modified**

* css/less/admin.social-options.less
* style.less
* lean.po
* loop.php
* loop-aside.php
* loop-audio.php
* loop-chat.php
* loop-gallery.php
* loop-image.php
* loop-link.php
* loop-quote.php
* loop-status.php
* loop-video.php
* page.php
* single.php
* social-networking.php
* theme-settings.php

**Removed**

* influence/css/icn-social-sprites.png

**Added**

* includes/author-box.php
* includes/loop.post-content.php
* includes/loop.post-link-pages.php
* includes/loop.post-meta.php
* includes/loop.post-title.php

# 1.1.3 (October 6th, 2013)

## Light Contrast Color Scheme

* Added additional light contrast colors for new post formats

## Archives and Sitemap Pages

* Updated the archives and sitemap pages to use Font Awesome icons

## Social Influence Widget

* Updated to use Font Awesome for Twitter and Facebook counts
* Fixed number formatting issue when displaying both counts

### Change Set

**Modified**

* css/less/theme.contrast-light.less
* css/less/variables.less
* css/less/mixins.less
* style.less
* template-archives.php
* template-sitemap.php
* influence/widget.php
* influence/css/less/widget.less

**Removed**

* influence/css/icn-social-sprites.png

# 1.1.2 (October 4th, 2013)

## Comment Form

* Fixes issue with the allowed HTML tags wrapping

## Mobile menu items

* Fixes issue with the first mobile menu item has negative margin

### Change Set

**Modified**

* theme-custom-filters.php
* css/less/theme-responsive.less
* css/less/navigation.less
* css/less/misc.less
* style.less

# 1.1.1 (October 1st, 2013)

## Grunt File

* Fixes issue with build task in Gruntfile

### Change Set

**Modified**

* Gruntfile.js

## 1.1 (October 1st, 2013)

- Ready for public release

## 1.0 (September 26th, 2013)

### Documentation

* [Initial release](http://docs.leantheme.co)

### Theme

* [Initial Release](http://leantheme.co)