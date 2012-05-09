// Global variables used to track the instance of this widget's source and URL fields.
// This is necessary so that the send_to_editor function can manipulate the widget's admin 
_standard_300x250_sAdSrcId = null;
_standard_300x250_sAdSrcUrl = null;

(function($) {

	// Attach event handlers on initial page load
	$(function() {
		standard_ad_300x250($);
	});
	
	// If the 300x250 widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'standard-ad-300x250';
		
		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				standard_ad_300x250($);
			} // end if
		} // end if
		
	});
	
})(jQuery);

/**
 * Attaches event handlers for Standard's 300x250 advertisement widget administration
 * panel.
 */
function standard_ad_300x250($) {

	// Display the uploader when the anchor is clicked
	$('.standard-ad-300x250-wrapper > .ad_upload').click(function(evt) {
		
		evt.preventDefault();
	
		// Identify the input fields for this image and anchor
		$(this).siblings('.widget-parent-id').val($(this).parents('.widget').attr('id'));
		var sId = $(this).siblings('.widget-parent-id').val();
		_standard_300x250_sAdSrcId = '#' + $('#' + sId + ' .widget-content .standard-ad-300x250-wrapper').children('.ad_src').attr('id');
		_standard_300x250_sAdSrcUrl = '#' + $('#' + sId + ' .widget-content .standard-ad-300x250-wrapper').children('.ad_url').attr('id');
		
		// Show the media uploader
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	
		// Modify the media uploader to hide certain fields and change text
		var uploaderPoll = setInterval(function() {
			
			if($('#TB_iframeContent').length > 0) {
		
				// Hide unnecessary fields
				var $formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
				$formFields.each(function() {
				
					// Remove everything except the URL field
					if(!($(this).hasClass('submit') || $(this).hasClass('url'))) {
						$(this).hide();
					} // end if
					
					// If we're looking at the URL field, remove the extra buttons and text
					if($(this).hasClass('url')) {
						$(this).children('.field').children('input').siblings().hide();
					} // end if
					
				});
				
				// Change the text of the submit button		
				var $submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
				if($submit.length > 0 && $submit !== null) {
				
					/* Translators: For now, this has to be localized inline. */
					$submit.val('Upload Advertisement');
					clearInterval(uploaderPoll);
					
				} // end if
				
			} // end if
			
		}, 1000);
	
	});
	
	// Delete the adveritsement and clear the input fields when the delete anchor is clicked
	$('.standard-ad-300x250-wrapper > .ad_delete').click(function(evt) {
	
		// If the image is wrapped in an anchor, remove it first
		if($(this).parent().children('.ad_url').length > 0 ) {
			$(this).parent().children('.ad_url').hide().remove();
		} // end if/else
		
		$(this).siblings('img').hide();
		$(this).siblings('input').val('');
		$(this).siblings('a:last').show();
		$(this).hide();

	});

} // end standard_ad_300x250


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

		jQuery(_standard_300x250_sAdSrcId).val(sImageUrl);
		jQuery(_standard_300x250_sAdSrcUrl).val(jQuery(sHtml).attr('href'));
		
	// Otherwise, we'll just grab the image
	} else {

		sImageUrl = jQuery(sHtml).attr('src');		
		jQuery(_standard_300x250_sAdSrcId).val(jQuery(sHtml).attr('src'));		
		
	} // end if
	
	// Display the image in the admin area
	if(jQuery(_standard_300x250_sAdSrcId).siblings('img').parent('a').length > 0) {
		jQuery(_standard_300x250_sAdSrcId).siblings('img').parent('a').show();
	} // end if/else
	jQuery(_standard_300x250_sAdSrcId).siblings('img')
			.attr('src', sImageUrl).show();
	
	// Hide the upload anchor, show the delete anchor
	jQuery(_standard_300x250_sAdSrcId).siblings('.ad_upload')
		.hide();
	jQuery(_standard_300x250_sAdSrcId).siblings('.ad_delete')
		.show();

	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor