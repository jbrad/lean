// Global variables used to track the instance of this widget's source and URL fields.
// This is necessary so that the send_to_editor function can manipulate the widget's admin 
_standard_personal_image_src = null;

(function($) {

	// Attach event handlers on initial page load
	$(function() {
		standard_personal_image($);
	});
	
	// If the Personal Image widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'standard-personal-image';
		
		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				standard_personal_image($);
			} // end if
		} // end if
		
	});
	
})(jQuery);

/**
 * Attaches event handlers for Standard's Personal Image widget administration
 * panel.
 */
function standard_personal_image($) {

	// Display the uploader when the anchor is clicked. 
	// We have to unbind previous click events in case someone adds multiple instances of this widget
	$('.standard-personal-image-wrapper .option .preview_image_container').unbind('click')
		.click(function(evt) {
		
		evt.preventDefault();
	
		// Identify the input fields for this image and anchor
		_standard_personal_image_src = '#' + $(this).siblings('.img_src').attr('id');
		
		// Show the media uploader
		personal_image_show_media_uploader();
		$('#TB_iframeContent').load(function() {
		
			// if the user is uploading a new personal image, we need to poll until we see the form fields
			var personal_image_poll = setInterval(function() {
				if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
					standard_personal_image_hide_unused_fields($, personal_image_poll);
				} // end if
			}, 500);
	
			// if they aren't uplaoding, we'll clear the fields on load
			standard_personal_image_hide_unused_fields($);	
		});
		
	});
	
	// Delete the adveritsement and clear the input fields when the delete anchor is clicked
	$('.standard-personal-image-wrapper .option .img_delete').click(function(evt) {
	
		// Reset the hidden field and hide the preview image
		$(this).siblings('.img_src').val('');
		$(this).siblings('.preview_image_container').children('img').hide();
		
		// Hide the delete link, show the upload link
		$(this).hide();

	});

} // end standard_personal_image

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image	
 */
function standard_personal_image_hide_unused_fields($, poller) {

	// Hide unnecessary fields
	var bHasHiddenFields = false;
	var $formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
	$formFields.each(function() {
	
		// Remove all of the field
		if(!$(this).hasClass('submit')) {
			$(this).hide();
		} // end if
		
	});
	
	// Change the text of the submit button		
	var $submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
	if($submit.length > 0 && $submit !== null) {
	
		/* Translators: For now, this has to be localized inline. */
		$submit.val('Upload Image');
		
		bHasHiddenFields = true;
		
	} // end if
	
	// Clear the polling interfval
	if(poller !== null && bHasHiddenFields) {
		clearInterval(poller);
	} // end if

} // end standard_personal_image_hide_unused_fields

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
function personal_image_show_media_uploader() {

 	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	
	// Save the previous handler since we're spinning up another instance
 	window.restore_editor = window.send_to_editor;
 	
	window.send_to_editor = function(sHtml) {
	
		// In testing, some environments were wrapping the image with an anchor so we need a failsafe
		var $img = jQuery(sHtml).children('img').length === 1 ? jQuery(sHtml).children('img') : jQuery(sHtml);
	
		// Store the image's URL in the hidden field
		jQuery(_standard_personal_image_src).val($img.attr('src'));
		jQuery(_standard_personal_image_src).siblings('.preview_image_container').children('.preview_image').attr('src', $img.attr('src')).show();
	
		// Hide the thickbox
		tb_remove();
		
		// Restore the previous editor handler
		window.send_to_editor = window.restore_editor;		

	} // end window.send_to_editor

	
} // end ad_personal_image_show_media_uploader