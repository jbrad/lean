# 1.9.1 (February 4th, 2014)

## Updated to Bootstrap 3.1.0
## Moved files from inc to includes so child themes can access them
## Styling category and archive dropdowns to match Bootstraps styling
## Fixing issue with not being able to remove site logo and site icon

## Change Set

**Modified**
* bower.json
* css/admin.css
* css/less/admin.less
* css/less/bootstrap.less
* css/less/style.less
* css/less/widgets.less
* css/lib/bootstrap/badges.less
* css/lib/bootstrap/breadcrumbs.less
* css/lib/bootstrap/button-groups.less
* css/lib/bootstrap/buttons.less
* css/lib/bootstrap/code.less
* css/lib/bootstrap/dropdowns.less
* css/lib/bootstrap/forms.less
* css/lib/bootstrap/glyphicons.less
* css/lib/bootstrap/grid.less
* css/lib/bootstrap/input-groups.less
* css/lib/bootstrap/jumbotron.less
* css/lib/bootstrap/list-group.less
* css/lib/bootstrap/mixins.less
* css/lib/bootstrap/modals.less
* css/lib/bootstrap/navbar.less
* css/lib/bootstrap/navs.less
* css/lib/bootstrap/normalize.less
* css/lib/bootstrap/pager.less
* css/lib/bootstrap/pagination.less
* css/lib/bootstrap/panels.less
* css/lib/bootstrap/print.less
* css/lib/bootstrap/responsive-utilities.less
* css/lib/bootstrap/scaffolding.less
* css/lib/bootstrap/tables.less
* css/lib/bootstrap/theme.less
* css/lib/bootstrap/tooltip.less
* css/lib/bootstrap/type.less
* css/lib/bootstrap/variables.less
* css/lib/bootstrap/wells.less
* functions.php
* inc/footer.google-custom-search.php → includes/footer.google-custom-search.php
* inc/header.favicon.php → includes/header.favicon.php
* inc/header.google-analytics.php → includes/header.google-analytics.php
* inc/header.google-plus.php → includes/header.google-plus.php
* inc/native-seo.php → includes/native-seo.php
* inc/theme-custom-comments.php → includes/theme-custom-comments.php
* inc/theme-custom-filters.php → includes/theme-custom-filters.php
* inc/theme-custom-header.php → includes/theme-custom-header.php
* inc/theme-features.php → includes/theme-features.php
* inc/theme-localization.php → includes/theme-localization.php
* inc/theme-settings.php → includes/theme-settings.php
* inc/theme-styles-and-scripts.php → includes/theme-styles-and-scripts.php
* inc/theme-variables.php → includes/theme-variables.php
* js/admin.media-upload.min.js
* js/admin.min.js
* js/dev/admin.media-upload.js
* js/lib/bootstrap.min.js
* js/lib/bootstrap/affix.js
* js/lib/bootstrap/alert.js
* js/lib/bootstrap/button.js
* js/lib/bootstrap/carousel.js
* js/lib/bootstrap/collapse.js
* js/lib/bootstrap/dropdown.js
* js/lib/bootstrap/modal.js
* js/lib/bootstrap/popover.js
* js/lib/bootstrap/scrollspy.js
* js/lib/bootstrap/tab.js
* js/lib/bootstrap/tooltip.js
* js/lib/bootstrap/transition.js
* js/theme.main.min.js
* package.json
* style.css

# 1.9.0 (January 27th, 2014)

## Adding font awesome to admin pages
## Removing unnecessary images for theme settings pages
## Removing unnecessary javascript for theme settings social page
## Removing glpyhicon styles to remove error loading it in admin styles
## Removing sticky image and replacing with CSS
## Removing more unnecessary js and css
## Updating active icons message
## Removing unnecessary styles for author box
## Converting all CSS comments to LESS comments
## Removing IE styles
## Updating footer to remove unnecessary styles
## Removing unnecessary styles for header
## Removing unnecessary styles for navigation
## Removing unnecessary miscellaneous styles
## Removing unnecessary styles from pages.less and moved to appropriate …
## Removing unnecessary styles from post format aside
## Removing unnecessary styles from post format audio
## Removing unnecessary styles from post format chat
## Removing unnecessary styles from post format gallery
## Removing unnecessary styles from post format image
## Removing unnecessary styles from post format link
## Removing unnecessary styles from post format quote
## Removing unnecessary styles from post format status
## Removing unnecessary styles from post format video
## Refactoring some gallery post format code
## Fix issue with showing active icons as white
## Adding table classes via Javascript
## Fixing issue with text alignment with aside #post format
## Moving pager and infinite scrolling styles to navigation.less
## Removing unnecessary variables for pager out of variables.less
## Moving post-title styling to bootstrap-overrides.less
## Moving share daddy styles out to separate .less file
## Refactoring the pager links to be consistent on index and single posts
## Adding the text-muted class to post header and meta areas for text co…
## Refactoring form input javascript and removing hover from tables
## Refactoring theme contrast light
## Removing the submit button styling and adding classes via Javascript
## Removing theme-responsive.css from being created in Gruntfile
## Fixing indentations and removing comments from .less files
## Refactoring activity widget styles
## Refactoring ad 125x125 widget styles
## Refactoring all ad widget styles and adding img-responsive class
## Refactoring google custom search widget styles
## Refactoring social influence widget styles
## Refactoring personal image widget styles
## Refactoring seo widget styles
## Removing HTLM5 Shiv and Respond.js, thus only supporing the latest ve…
## Fixing some alignment with first menu item with header and navbar-brand
## Removing unnecessary pagination styles
## Removing unnecessary imports in .less files
## Removing theme-responsive.css file
## Removing the img-responsive class from billboard ad widget
## Removing unnecessary bootstrap javascript files
## Using the built in collapse for allowed-tags
## Reformatting javascript files to remove tab characters
## Refactoring admin.header.js
## Utilizing the new media uploader for the site icon and logo
## Refactoring media-upload code
## Expanding the width of the media uploader to be full width
## Creating a helper function for launching the media uploader
## Updated all widgets and admin options to use launchMediaUploader
## Commit new admin javascript files
## Inline author box in single.php
## Inline post title back to loop templates
## Inline post link pages back to loop templates
## Inline post content back to loop templates
## Inline post meta back to loop templates
## Adding btn class to all inputs of type submit
## Inline section classes back to theme templates
## Updating lean logo for admin navigation and theme options pages
## Updating theme menu to use font awesome icon instead of png
## Fix issue with not being able to click on ad image after removing it.
## Making all of the delete buttons consistent
## Rearranging grunt file
## Ignore bower_components during build task

## Change Set

**Modified**

* 404.php
* Gruntfile.js
* bower.json
* breadcrumbs.php
* comments.php
* css/admin.css
* css/img/icn-blog.png
* css/img/icn-heart.png
* css/img/icn-wrench.png
* css/img/theme-logo.png
* css/less/admin.header.less
* css/less/admin.less
* css/less/admin.social-options.less
* css/less/author-box.less
* css/less/bootstrap-overrides.less
* css/less/bootstrap.less
* css/less/comments.less
* css/less/editor-style.less
* css/less/font-awesome.less
* css/less/footer.less
* css/less/header.less
* css/less/ie-styles.less
* css/less/misc.less
* css/less/mixins.less
* css/less/navigation.less
* css/less/pages.less
* css/less/posts.format-aside.less
* css/less/posts.format-audio.less
* css/less/posts.format-chat.less
* css/less/posts.format-gallery.less
* css/less/posts.format-image.less
* css/less/posts.format-link.less
* css/less/posts.format-quote.less
* css/less/posts.format-status.less
* css/less/posts.format-video.less
* css/less/posts.less
* css/less/sharedaddy.less
* css/less/structure.less
* css/less/style.less
* css/less/theme-responsive.less
* css/less/theme.contrast-light.less
* css/less/typography.less
* css/less/variables.less
* css/less/widgets.less
* css/theme-responsive.css
* css/theme.contrast-light.css
* footer.php
* header.php
* image.php
* images/icn-theme-small.png
* images/sticky.png
* inc/footer.google-custom-search.php
* inc/header.favicon.php
* inc/header.google-analytics.php
* inc/header.google-plus.php
* inc/native-seo.php
* inc/theme-custom-filters.php
* inc/theme-settings.php
* inc/theme-styles-and-scripts.php
* inc/theme-variables.php
* includes/author-box.php
* includes/loop.post-content.php
* includes/loop.post-link-pages.php
* includes/loop.post-meta.php
* includes/loop.post-title.php
* index.php
* js/admin.media-upload.min.js
* js/admin.min.js
* js/dev/admin.header.js
* js/dev/admin.media-upload.js
* js/dev/admin.menu.js
* js/dev/admin.post.js
* js/dev/admin.profiles.js
* js/dev/admin.publishing-options.js
* js/dev/admin.seo-notification.js
* js/dev/admin.site-mode.js
* js/dev/admin.social-options.js
* js/dev/admin.template-sitemap.js
* js/dev/admin.widgets.js
* js/dev/theme.comments.js
* js/dev/theme.main.js
* js/dev/theme.tiled-gallery.js
* js/dev/theme.videopress.js
* js/html5shiv.min.js
* js/lib/bootstrap.min.js
* js/lib/html5-shiv/html5shiv.js
* js/lib/respond/respond.min.js
* js/lib/respond/respond.src.js
* js/md5.min.js
* js/respond.min.js
* js/theme.main.min.js
* lib/activity/css/less/admin.less
* lib/activity/css/less/widget.less
* lib/activity/css/widget.css
* lib/activity/plugin.php
* lib/ad-125x125/css/admin.css
* lib/ad-125x125/css/less/admin.less
* lib/ad-125x125/css/less/widget.less
* lib/ad-125x125/css/widget.css
* lib/ad-125x125/js/admin.min.js
* lib/ad-125x125/js/dev/admin.js
* lib/ad-125x125/plugin.php
* lib/ad-125x125/views/admin.php
* lib/ad-300x250/css/admin.css
* lib/ad-300x250/css/less/admin.less
* lib/ad-300x250/css/less/widget.less
* lib/ad-300x250/css/widget.css
* lib/ad-300x250/js/admin.min.js
* lib/ad-300x250/js/dev/admin.js
* lib/ad-300x250/plugin.php
* lib/ad-300x250/views/admin.php
* lib/ad-billboard/css/admin.css
* lib/ad-billboard/css/less/admin.less
* lib/ad-billboard/css/less/widget.less
* lib/ad-billboard/js/admin.min.js
* lib/ad-billboard/js/dev/admin.js
* lib/ad-billboard/views/admin.php
* lib/google-custom-search/css/less/admin.less
* lib/google-custom-search/css/less/widget.less
* lib/google-custom-search/css/widget.css
* lib/influence/css/less/admin.less
* lib/influence/css/less/widget.less
* lib/influence/css/widget.css
* lib/personal-image/css/admin.css
* lib/personal-image/css/less/admin.less
* lib/personal-image/css/less/widget.less
* lib/personal-image/css/widget.css
* lib/personal-image/js/admin.min.js
* lib/personal-image/js/dev/admin.js
* lib/personal-image/views/admin.php
* lib/seo/css/less/admin.less
* lib/seo/js/admin.min.js
* loop-aside.php
* loop-audio.php
* loop-chat.php
* loop-gallery.php
* loop-image.php
* loop-link.php
* loop-quote.php
* loop-status.php
* loop-video.php
* loop.php
* package.json
* page-offline-mode.php
* page.php
* pagination.php
* search.php
* single.php
* social-networking.php
* style.css
* template-archives.php
* template-fullwidth.php
* template-home.php
* template-sitemap.php

# 1.8.0 (January 6th, 2014)

## Fixes issue with responsive grid when using Appearances > Header
## Changing the responsive grid for landscape tablets to show the sidebar
## Adding grunt-contrib-copy, grunt-sed and regexp-quote to project
## Fixing widget admin styling to look better with WordPress 3.8
## Updating comments to use Bootstrap media objects and removed unnecessary code
## Fixing some color issues with dark contrast
## Removing padding-bottom on footer nav to shorten up the footer
## Removing the background image for quote post formats and using CSS
## Adding padding to audio post format
## Updating to use grunt copy instead of bower export overrides
## Removing gradient on activity tabs to match navbars background colorShow social icons on mobile

### Change Set

**Modified**

* .gitignore
* Gruntfile.js
* bower.json
* comments.php
* css/less/bootstrap.less
* css/less/comments.less
* css/less/font-awesome.less
* css/less/footer.less
* css/less/misc.less
* css/less/navigation.less
* css/less/posts.format-audio.less
* css/less/posts.format-quote.less
* css/less/posts.less
* css/less/theme.contrast-light.less
* css/lib/twitter/alerts.less → css/lib/bootstrap/alerts.less
* css/lib/twitter/badges.less → css/lib/bootstrap/badges.less
* css/lib/twitter/bootstrap.less → css/lib/bootstrap/bootstrap.less
* css/lib/twitter/breadcrumbs.less → css/lib/bootstrap/breadcrumbs.less
* css/lib/twitter/button-groups.less → css/lib/bootstrap/button-groups.less
* css/lib/twitter/buttons.less → css/lib/bootstrap/buttons.less
* css/lib/twitter/carousel.less → css/lib/bootstrap/carousel.less
* css/lib/twitter/close.less → css/lib/bootstrap/close.less
* css/lib/twitter/code.less → css/lib/bootstrap/code.less
* css/lib/twitter/component-animations.less → css/lib/bootstrap/component-animations.less
* css/lib/twitter/dropdowns.less → css/lib/bootstrap/dropdowns.less
* css/lib/twitter/forms.less → css/lib/bootstrap/forms.less
* css/lib/twitter/glyphicons.less → css/lib/bootstrap/glyphicons.less
* css/lib/twitter/grid.less → css/lib/bootstrap/grid.less
* css/lib/twitter/input-groups.less → css/lib/bootstrap/input-groups.less
* css/lib/twitter/jumbotron.less → css/lib/bootstrap/jumbotron.less
* css/lib/twitter/labels.less → css/lib/bootstrap/labels.less
* css/lib/twitter/list-group.less → css/lib/bootstrap/list-group.less
* css/lib/twitter/media.less → css/lib/bootstrap/media.less
* css/lib/twitter/mixins.less → css/lib/bootstrap/mixins.less
* css/lib/twitter/modals.less → css/lib/bootstrap/modals.less
* css/lib/twitter/navbar.less → css/lib/bootstrap/navbar.less
* css/lib/twitter/navs.less → css/lib/bootstrap/navs.less
* css/lib/twitter/normalize.less → css/lib/bootstrap/normalize.less
* css/lib/twitter/pager.less → css/lib/bootstrap/pager.less
* css/lib/twitter/pagination.less → css/lib/bootstrap/pagination.less
* css/lib/twitter/panels.less → css/lib/bootstrap/panels.less
* css/lib/twitter/popovers.less → css/lib/bootstrap/popovers.less
* css/lib/twitter/print.less → css/lib/bootstrap/print.less
* css/lib/twitter/progress-bars.less → css/lib/bootstrap/progress-bars.less
* css/lib/twitter/responsive-utilities.less → css/lib/bootstrap/responsive-utilities.less
* css/lib/twitter/scaffolding.less → css/lib/bootstrap/scaffolding.less
* css/lib/twitter/tables.less → css/lib/bootstrap/tables.less
* css/lib/twitter/theme.less → css/lib/bootstrap/theme.less
* css/lib/twitter/thumbnails.less → css/lib/bootstrap/thumbnails.less
* css/lib/twitter/tooltip.less → css/lib/bootstrap/tooltip.less
* css/lib/twitter/type.less → css/lib/bootstrap/type.less
* css/lib/twitter/utilities.less → css/lib/bootstrap/utilities.less
* css/lib/twitter/variables.less → css/lib/bootstrap/variables.less
* css/lib/twitter/wells.less → css/lib/bootstrap/wells.less
* css/theme.contrast-light.css
* fonts/font-awesome/FontAwesome.otf → fonts/FontAwesome.otf
* fonts/font-awesome/fontawesome-webfont.eot → fonts/fontawesome-webfont.eot
* fonts/font-awesome/fontawesome-webfont.svg → fonts/fontawesome-webfont.svg
* fonts/font-awesome/fontawesome-webfont.ttf → fonts/fontawesome-webfont.ttf
* fonts/font-awesome/fontawesome-webfont.woff → fonts/fontawesome-webfont.woff
* header.php
* images/bg-quote-dark.png
* images/bg-quote.png
* inc/theme-custom-comments.php
* inc/theme-custom-filters.php
* js/dev/theme.comments.js
* js/dev/theme.main.js
* js/html5shiv.min.js
* js/lib/twitter/affix.js → js/lib/bootstrap/affix.js
* js/lib/twitter/alert.js → js/lib/bootstrap/alert.js
* js/lib/twitter/button.js → js/lib/bootstrap/button.js
* js/lib/twitter/carousel.js → js/lib/bootstrap/carousel.js
* js/lib/twitter/collapse.js → js/lib/bootstrap/collapse.js
* js/lib/twitter/dropdown.js → js/lib/bootstrap/dropdown.js
* js/lib/twitter/modal.js → js/lib/bootstrap/modal.js
* js/lib/twitter/popover.js → js/lib/bootstrap/popover.js
* js/lib/twitter/scrollspy.js → js/lib/bootstrap/scrollspy.js
* js/lib/twitter/tab.js → js/lib/bootstrap/tab.js
* js/lib/twitter/tooltip.js → js/lib/bootstrap/tooltip.js
* js/lib/twitter/transition.js → js/lib/bootstrap/transition.js
* js/lib/html5shiv-dist/html5shiv.js → js/lib/html5-shiv/html5shiv.js
* js/lib/html5shiv-dist/html5shiv-printshiv.js
* js/lib/js-md5/md5.js → js/lib/md5/md5.js
* js/lib/respond/respond.src.js
* js/respond.min.js
* js/theme.main.min.js
* lib/activity/css/admin.css
* lib/activity/css/less/admin.less
* lib/activity/css/less/widget.less
* lib/activity/css/widget.css
* lib/ad-125x125/css/admin.css
* lib/ad-125x125/css/less/admin.less
* lib/ad-300x250/css/admin.css
* lib/ad-300x250/css/less/admin.less
* lib/ad-billboard/css/admin.css
* lib/ad-billboard/css/less/admin.less
* lib/google-custom-search/css/admin.css
* lib/google-custom-search/css/less/admin.less
* lib/influence/css/admin.css
* lib/influence/css/less/admin.less
* lib/influence/css/less/widget.less
* lib/lean-ad-125x125/css/admin.css
* lib/lean-ad-125x125/css/widget.css
* lib/lean-ad-125x125/js/admin.min.js
* lib/lean-ad-300x250/css/admin.css
* lib/lean-ad-300x250/css/widget.css
* lib/lean-ad-300x250/js/admin.min.js
* lib/lean-ad-billboard/css/admin.css
* lib/lean-ad-billboard/css/widget.css
* lib/lean-ad-billboard/js/admin.min.js
* lib/personal-image/css/admin.css
* lib/personal-image/css/fake-personal.jpg
* lib/personal-image/css/less/admin.less
* loop-quote.php
* package.json
* sidebar.php
* style.css

# 1.7.1 (December 11th, 2013)

## Updated to Bootstrap 3.0.3
* Updating LESS and JavaScript files to Bootstrap 3.0.3
* This also fixes an issue with the jumbotron not wrapping properly on the homepage template

### Change Set

**Modified**

* css/lib/twitter/*.less
* js/lib/twitter/*.js

# 1.7.0 (November 28th, 2013)

## Added Instagram Social Icon

## Added Customization for Jetpack Social Sharers
* Updating to social sharers to use Font Awesome icons to increase performance

### Change Set

**Modified**

* style.css
* bower.json
* package.json
* css/lib/twitter/mixins.less
* css/lib/twitter/posts.less
* css/lib/twitter/style.less
* css/lib/twitter/variables.less
* js/theme.main.min.js
* js/dev/theme.main.js
* social-networking.php

**Added**

* images/social/small/instagram.png


# 1.6.0 (November 10th, 2013)

## Updated Bootstrap to 3.0.2

## Updated Font Awesome to 4.0.2

## Fixed issue with responsive videos

### Change Set

**Modified**

* Gruntfile.js
* bower.json
* css/lib/font-awesome/font-awesome.less
* css/lib/font-awesome/icons.less
* css/lib/font-awesome/variables.less
* css/lib/twitter/forms.less
* css/lib/twitter/mixins.less
* css/lib/twitter/panels.less
* css/lib/twitter/thumbnails.less
* fonts/font-awesome/FontAwesome.otf
* fonts/font-awesome/fontawesome-webfont.eot
* fonts/font-awesome/fontawesome-webfont.svg
* fonts/font-awesome/fontawesome-webfont.ttf
* fonts/font-awesome/fontawesome-webfont.woff
* js/lib/bootstrap.min.js
* js/lib/twitter/affix.js
* js/lib/twitter/alert.js
* js/lib/twitter/button.js
* js/lib/twitter/carousel.js
* js/lib/twitter/collapse.js
* js/lib/twitter/dropdown.js
* js/lib/twitter/modal.js
* js/lib/twitter/popover.js
* js/lib/twitter/scrollspy.js
* js/lib/twitter/tab.js
* js/lib/twitter/tooltip.js
* js/lib/twitter/transition.js
* js/theme.main.min.js
* js/dev/theme.main.js

# 1.5.0 (November 5th, 2013)

## Updated Bootstrap to 3.0.1

## Added format-aside class to aside posts
* loop-aside.php

### Change Set

**Modified**

* bower.json
* package.json
* css/less/bootstrap.less
* css/less/style.less
* css/lib/font-awesome/font-awesome.less
* css/lib/font-awesome/icons.less
* css/lib/font-awesome/stacked.less
* css/lib/font-awesome/variables.less
* css/lib/twitter/alerts.less
* css/lib/twitter/bootstrap.less
* css/lib/twitter/breadcrumbs.less
* css/lib/twitter/button-groups.less
* css/lib/twitter/buttons.less
* css/lib/twitter/carousel.less
* css/lib/twitter/code.less
* css/lib/twitter/dropdowns.less
* css/lib/twitter/forms.less
* css/lib/twitter/glyphicons.less
* css/lib/twitter/grid.less
* css/lib/twitter/input-groups.less
* css/lib/twitter/jumbotron.less
* css/lib/twitter/list-group.less
* css/lib/twitter/mixins.less
* css/lib/twitter/modals.less
* css/lib/twitter/navbar.less
* css/lib/twitter/navs.less
* css/lib/twitter/normalize.less
* css/lib/twitter/pagination.less
* css/lib/twitter/panels.less
* css/lib/twitter/print.less
* css/lib/twitter/progress-bars.less
* css/lib/twitter/responsive-utilities.less
* css/lib/twitter/scaffolding.less
* css/lib/twitter/tables.less
* css/lib/twitter/theme.less
* css/lib/twitter/thumbnails.less
* css/lib/twitter/tooltip.less
* css/lib/twitter/type.less
* css/lib/twitter/utilities.less
* css/lib/twitter/variables.less
* css/theme.contrast-light.css
* js/lib/bootstrap.min.js
* js/lib/twitter/affix.js
* js/lib/twitter/alert.js
* js/lib/twitter/button.js
* js/lib/twitter/carousel.js
* js/lib/twitter/collapse.js
* js/lib/twitter/dropdown.js
* js/lib/twitter/modal.js
* js/lib/twitter/popover.js
* js/lib/twitter/scrollspy.js
* js/lib/twitter/tab.js
* js/lib/twitter/tooltip.js
* js/lib/twitter/transition.js
* js/theme.main.min.js
* lib/activity/css/widget.css
* lib/influence/css/widget.css
* style.css
* loop-aside.php
* functions.php
* inc/theme-variables.php

# 1.4.2 (October 30th, 2013)

## Fixes Issue with Image Alignment in posts and pages
* Added styles back for alignleft, alignright, etc...

## Fixes Issue with child themes loading stylesheets
* Fixed issue in theme-styles-and-scripts.php

## Fix post navigation hover background color

## Fix issue with aside date displaying on mobile

## Fix weird issue with displaying style.css file in Chrome

### Change Set

**Modified**

* css/less/font-awesome.less
* css/less/posts.less
* css/less/posts.format-aside.less
* css/less/variables.less
* inc/theme-styles-and-scripts.php

# 1.4.1 (October 29th, 2013)

## Fixes Issue with Pages Not Having Content Background
* Added the panel classes to pages and page templates

### Change Set

**Modified**

* page.php
* template-archives.php
* template-fullwidth.php
* template-sitemap.php

# 1.4 (October 27th, 2013)

## Font Awesome 4
* Updated to Font Awesome 4

## Streamline Stylesheets and LESS Files
* Spent a lot of time removing duplicate styles and utilized Bootstrap a bit more. Brought the style.css file down from 152kb to 129kb.
* All colors are now variables in variables.less, this will make it crazy easy to modify the colors of the theme.

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