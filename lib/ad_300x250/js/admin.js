// Globals are bad, but we need it in order to get the unique ID of the field
// that's related to this specific instance of the widget.

// TODO this will need to be identified with 300x250
_standard_sAdSrcId = null;
_standard_sAdSrcUrl = null;

(function($) {

	// Attach event handlers on initial page load
	$(function() {
		standard_ad_300x350($);
	});
	
	// If the 300x250 widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {
	
		var sWidgetName = 'standard-ad-300x250';
		
		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				standard_ad_300x350($);
			} // end if
		} // end if
	});
	
})(jQuery);

/**
 * Attaches event handlers for Standard's 300x250 advertisement widget administration
 * panel.
 */
function standard_ad_300x350($) {

	// Display the uploader when the anchor is clicked
	$('.standard-ad-300x250-wrapper > .ad_upload').click(function(evt) {
		
		evt.preventDefault();
	
		// Identify the input fields for this image and anchor
		_standard_sAdSrcId = $(this).siblings('.ad_src').attr('id');
		_standard_sAdSrcUrl = $(this).siblings('.ad_url').attr('id');
		
		// Show the media uploader
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	
		// Change the text of the 'Insert Into Post' button
		var $submit = null;			
		var submitPoll = setInterval(function() {
			
			if($('#TB_iframeContent').length > 0) {
				$submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
				if($submit.length > 0 && $submit !== null) {
				
					/* TODO This will need to be manually localized */
					$submit.val('Upload Advertisement');
					clearInterval(submitPoll);
					
				} // end if
			} // end if
			
		}, 1000);
	
	});
	
	// Delete the adveritsement and clear the input fields when the delete anchor is clicked
	$('.standard-ad-300x250-wrapper > .ad_delete').click(function(evt) {
	
		$(this).siblings('img').hide();
		$(this).siblings('input').val('');
		$(this).siblings('a').show();
		$(this).hide();
		
	});

} // end standard_ads

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */ 
window.send_to_editor = function(sHtml) {

	// If the user has specified a link, we'll grab the anchor and the image source
	var sImageUrl = '';
	if(jQuery(sHtml).children('img').length > 0) {
	
		sImageUrl = jQuery(sHtml).children('img').attr('src');

		jQuery('#' + _standard_sAdSrcId).val(sImageUrl);
		jQuery('#' + _standard_sAdSrcUrl).val(jQuery(sHtml).attr('href'));
		
	// Otherwise, we'll just grab the image
	} else {

		sImageUrl = jQuery(sHtml).attr('src');		
		jQuery('#' + _standard_sAdSrcId).val(jQuery(sHtml).attr('src'));		
		
	} // end if
	
	// TODO determine if we need thisas per the new ajax functionality
	// Show the image
	jQuery('#' + _standard_sAdSrcId).siblings('img')
		.attr('src', sImageUrl).show();
	
	// Hide the upload anchodr, show the delete anchor
	jQuery('#' + _standard_sAdSrcId).siblings('.ad_upload')
		.hide();
	
	jQuery('#' + _standard_sAdSrcId).siblings('.ad_delete')
		.show();

	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor