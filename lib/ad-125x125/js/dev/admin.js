/**
 * Attaches event handlers for the 300x250 advertisement widget administration
 * panel.
 */
function ad_125x125($) {
	"use strict";
	// Display the uploader when the anchor is clicked
	// We have to unbind previous click events in case someone adds multiple instances of this widget
	$('.ad-125x125-wrapper img').unbind('click')
		.click(function(evt) {
            launchMediaUploader.call(this, $, evt, '125x125 Ad', false, true);
	});

    // Delete the advertisement and clear the input fields when the delete anchor is clicked
    $('.ad-125x125-wrapper button').click(function() {

        $(this).parent().find('img').attr('src', '');
        $(this).parent().find('input[type="hidden"]').val('');
        $(this).hide();

    });

} // end ad_125x125

(function($) {
	"use strict";
	// Attach event handlers on initial page load
	$(function() {
		ad_125x125($);
	});
	
	// If the 300x250 widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'ad-125x125';
		
		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				ad_125x125($);
			} // end if
		} // end if
		
	});
	
}(jQuery));