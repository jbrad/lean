# Changelog

## 3.0.1 (July 9th, 2012)

### Core Theme

* Resolving the issue that marked the 'Sitemap' option as disabled in the single Page editor
* Introducing compatibility with Platinum SEO
* Properly importing VideoPress-related JavaScript for better compatibility with child themes
* Version detection improvements
* Improving core theme JavaScript functionality to support child themes that disable responsive functionality
* Removed maximum-scale value in the site meta to support zooming on mobile devices
* Fixed the issue of not being able to delete social icons in Firefox for Mac
* Fixed an issue with the logo not properly displaying in the header
* Resolved issues with having only a header image, a header image with a logo, a header image with text, and a logo or text without a header image
* General SEO improvements to the header
* Introducing the ability to reset the social icons (ideal for those who ran previews, betas, or who want to restore default social icon functionality)
* Moved two functions that were in 'Helper Functions' to 'Custom Filters' in functions.php
* Added two helper functions to help refactor the header template
* Refactored the header template to improve readability and to better support use of header images, logos, and text
* Improved header functionality to support header widgets with only header images
* Improved positioning of logos and widgets when a background is present
* Updating editor-style.css to reflect how unordered lists look on published posts
* Resolving an issue that prevented proper linking of the privacy policy when not using pretty permalinks
* Making sure the image in the image post format displays in RSS
* Updating the way VideoPress stylesheets and JavaScript sources are imported
* Updating the way Contrast stylesheets imported
* Fixing a problem that prevented the Site Icon from displaying after deleting and uploading without first saving
* Resolved an issue with the Theme Customizer that improperly toggled the display of the logo

### Personal Image Widget

* Resolved a bug with the Personal Image widget that displayed the same image in the admin when multiple Personal Image widgets are present
* Centering Personal Image if the width is less than 300 pixels.
* Resolving a problem that prevented the Personal Image widget placeholder from displaying in Firefox

### Influence Widget

* Improved communication between Standard and Twitter, Facebook, and FeedBurner
* Introduced better caching and value serialization
* Added improvements to clearing out old values

### 125x125 Ad Widget

* Changing class names to prevent ad-blocking software from hiding the advertisements

### 300x250 Widget

* Renaming widget directory to prevent ad-blocking software from hiding the advertisements
* Moving styles from from styles.css to this widget's widget.css

### 468x60 Ad Widget

* Improvement to the 468x60 placeholder in Firefox
* Renaming widget directory to prevent ad-blocking software from hiding the advertisements
* Moving styles from from styles.css to this widget's widget.css

## 3.0 (June 29th, 2012)

## Documentation

* [Initial release](http://docs.8bit.io/)

## Theme

* [Initial Release](http://standardtheme.com)