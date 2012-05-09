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

	// Display the uploader when the anchor is clicked
	$('.standard-personal-image-wrapper .option .img_upload').click(function(evt) {
		
		evt.preventDefault();
	
		// Identify the input fields for this image and anchor
		_standard_personal_image_src = '#' + $(this).siblings('.img_src').attr('id');
		
		// Show the media uploader
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	
		// Modify the media uploader to hide certain fields and change text
		var uploaderPoll = setInterval(function() {
			
			if($('#TB_iframeContent').length > 0) {
		
				// Hide unnecessary fields
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
					clearInterval(uploaderPoll);
					
				} // end if
				
			} // end if
			
		}, 1000);
	
	});
	
	// Delete the adveritsement and clear the input fields when the delete anchor is clicked
	$('.standard-personal-image-wrapper .option .img_delete').click(function(evt) {
	
		// Reset the hidden field and hide the preview image
		$(this).siblings('.img_src').val('');
		$(this).siblings('.preview_image').hide();
		
		// Hide the delete link, show the upload link
		$(this).hide();
		$(this).siblings('.img_upload').show();

	});

} // end standard_ad_300x250


/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
window.send_to_editor = function(sHtml) {

	// Store the image's URL in the hidden field
	jQuery(_standard_personal_image_src).val(jQuery(sHtml).attr('src'));
	jQuery(_standard_personal_image_src).siblings('.preview_image').attr('src', jQuery(sHtml).attr('src'));

	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor