/**
 * Attaches event handlers for the 468x60 advertisement widget administration
 * panel.
 */
function ad_468x60($) {
	"use strict";

	// Display the uploader when the anchor is clicked
	// We have to unbind previous click events in case someone adds multiple instances of this widget
	$('.ad-468x60-wrapper > .preview_image_container img').unbind('click')
		.click(function(evt) {
            launchMediaUploader.call(this, $, evt, '468x80 Ad', false, true);
        }
    );

    // Delete the advertisement and clear the input fields when the delete anchor is clicked
    $('.ad-468x60-wrapper .button-delete').click(function() {

        $(this).parent().find('img').attr('src', '');
        $(this).parent().find('input[type="hidden"]').val('');
        $(this).hide();

    });

} // end ad_468x60

(function($) {
	"use strict";
	// Attach event handlers on initial page load
	$(function() {
		ad_468x60($);
	});

	// If the 468x60 widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'ad-468x60';

		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				ad_468x60($);
			} // end if
		} // end if

	});

}(jQuery));