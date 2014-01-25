/**
 * Attaches event handlers for the Personal Image widget administration
 * panel.
 */
function personal_image($) {
	"use strict";

	// Setup the character counter - we have to do it for each widget on the admin page because of how
	// WordPress manages this on the dashboard.
	$('.bio textarea').each(function() {

		var $span = $(this).next().children('span');

		// Update the counter on load
		$span.text( 400 - parseInt($(this).val().length, 10 ) );

		// Update the counter when typing
		$(this).keyup(function() {
			$span.text( 400 - parseInt($(this).val().length, 10 ) );
		});

	});

	// Display the uploader when the anchor is clicked.
	// We have to unbind previous click events in case someone adds multiple instances of this widget
	$('.personal-image-wrapper .option .personal_image_preview_image_container img').unbind('click')
        .click(function(evt) {
            launchMediaUploader.call(this, $, evt, 'Personal Image', false, true);
        }
    );

	// Delete the adveritsement and clear the input fields when the delete anchor is clicked
	$('.personal-image-wrapper .option .img_delete').click(function(evt) {

		// Reset the hidden field and hide the preview image
		$(this).siblings('.img_url').val('');
		$(this).siblings('.img_src').val('');
		$(this).siblings('.personal_image_preview_image_container').children('img').attr('src', $(this).next().val());

		// Hide the delete link, show the upload link
		$(this).hide();

	});

} // end personal_image

(function($) {
	"use strict";
	// Attach event handlers on initial page load
	$(function() {
		personal_image($);
	});

	// If the Personal Image widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'personal-image';

		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				personal_image($);
			} // end if
		} // end if

	});

}(jQuery));