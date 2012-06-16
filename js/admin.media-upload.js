_standard_presentationPreviewImage = null;
_standard_presentationPreviewUrl = null;

(function($) {
	$(function() {
		
		/* --- Fav Icon --- */
		
		// Display the media uploader when the 'Upload' button is clicked
		$('#upload_fav_icon').click(function() {
			
			// the element that will receive the preview image
			_standard_presentationPreviewImage = 'fav_icon_preview';
			_standard_presentationPreviewUrl = 'fav_icon';
			
			// Show the media uploader
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			
			$('#TB_iframeContent').load(function() {
	
				// if the user is uploading a new icon, we need to poll until we see the form fields
				var fav_icon_poll = setInterval(function() {
					if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
						standard_upload_hide_unused_fields($, fav_icon_poll);
					} // end if
				}, 500);
		
				// if they aren't uploading, we'll clear the fields on load
				standard_upload_hide_unused_fields($);
			
			});
				
		});
		
		// Remove the URL of the fav icon
		$('#delete_fav_icon').click(function() {
			$('#fav_icon').val('');
			$(this).siblings('img').hide();
			$(this).hide();
		});
		
		/* --- Logo --- */
		
		// Display the media uploader when the 'Upload' button is clicked
		$('#upload_logo').click(function() {
			
			// the element that will receive the preview image
			_standard_presentationPreviewImage = 'logo_preview';
			_standard_presentationPreviewUrl = 'logo';
			
			// Show the media uploader
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			
			$('#TB_iframeContent').load(function() {
	
				// if the user is uploading a new logo, we need to poll until we see the form fields
				var logo_poll = setInterval(function() {
					if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
						standard_upload_hide_unused_fields($, logo_poll);
					} // end if
				}, 500);
		
				// if they aren't uploading, we'll clear the fields on load
				standard_upload_hide_unused_fields($);
			
			});
				
		});
		
		// Remove the URL of the fav icon
		$('#delete_logo').click(function() {
			$('#logo').val('');
			$(this).siblings('img').hide();
			$(this).hide();
		});
		
		/* --- Advertisements --- */
		
		if($('#post_advertisement_type').length > 0){
		
			$select = $('#post_advertisement_type');
			if($select.attr('value') === 'image') {
			
				$select.parents('tr').siblings(':last').hide();
				$select.parents('tr').next().show();
				
			} else if($select.attr('value') === 'adsense'){
				
				$select.parents('tr').siblings(':last').show();
				$select.parents('tr').next().hide();
				
			} else {
			
				$select.parents('tr').siblings(':last').hide();
				$select.parents('tr').next().hide();
			
			} // end if/else
		
			$select.change(function() {
			
				if($(this).children(':selected').attr('value') === 'image') {
				
					$(this).parents('tr').siblings(':last').hide();
					$(this).parents('tr').next().show();
					
				} else if($(this).children(':selected').attr('value') === 'adsense') {
				
					$(this).parents('tr').siblings(':last').show();
					$(this).parents('tr').next().hide();
				
				} else {
				
					$(this).parents('tr').siblings(':last').hide();
					$(this).parents('tr').next().hide();
					
				} // end if/else
			});
		
		} // end if
		
		// Display the media uploader when the 'Upload' button is clicked
		$('#upload_post_advertisement_image').click(function() {
		
			// Show the media uploader
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			
			// Change the text of the 'Insert Into Post' button
			$('#TB_iframeContent').load(function() {
	
				// if the user is uploading a new ad, we need to poll until we see the form fields
				var banner_ad_poll = setInterval(function() {
					if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
						standard_ad_banner_hide_unused_fields($, banner_ad_poll);
					} // end if
				}, 500);
		
				// if they aren't uploading, we'll clear the fields on load
				standard_ad_banner_hide_unused_fields($);
			
			});		
		
		});
		
		// Remove the URL of the Post Advertisement Image
		$('#delete_post_advertisement_image').click(function() {
		
			$('#post_advertisement_image').val('');
			$(this).siblings('#image_upload_preview').hide();
			$(this).hide();
			
		});

	});
})(jQuery);

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image	
 */
function standard_upload_hide_unused_fields($, poller) {

	// Hide unnecessary fields
	var bHasHiddenFields = false;
	var $formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
	$formFields.each(function() {
	
		// Remove everything except the URL field
		if(!$(this).hasClass('submit')) {
			$(this).hide();
		} // end if
		
		// Make sure that we select the 'Full Size' of the image
		if($(this).hasClass('image-size')) {
			$(this).children('.field').children().each(function() {
				if($(this).children('input[type=radio]').attr('id').indexOf('-full-') > 0) {
					$(this).children('input[type=radio]').attr('checked', 'checked');
				} // end if
			});
		} // end if

		// If we're looking at the URL field, remove the extra buttons and text
		if($(this).hasClass('url')) {
		
			var $input = $(this).children('.field').children('input');
			$input.val('');
			$input.attr('placeholder', 'http://');
			$input.siblings().hide();
			
		} // end if
	
	});
	
	// Change the text of the submit button
	var $submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
	if($submit.length > 0 && $submit !== null) {
	
		/* Translators: This will need to be manually localized */
		$submit.val('Save Image');
		
		bHasHiddenFields = true;
		
	} // end if
						
	// Clear the polling interfval
	if(poller !== null && bHasHiddenFields) {
		clearInterval(poller);
	} // end if

} // end standard_upload_hide_unused_fields

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image	
 */
function standard_ad_banner_hide_unused_fields($, poller) {

	// Hide unnecessary fields
	var bHasHiddenFields = false;
	var $formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
	$formFields.each(function() {

		// Remove everything except the URL field
		if(!($(this).hasClass('submit') || $(this).hasClass('url'))) {
			$(this).hide();
		} // end if

		// Make sure that we select the 'Full Size' of the image
		if($(this).hasClass('image-size')) {
			$(this).children('.field').children().each(function() {
				if($(this).children('input[type=radio]').attr('id').indexOf('-full-') > 0) {
					$(this).children('input[type=radio]').attr('checked', 'checked');
				} // end if
			});
		} // end if

		// If we're looking at the URL field, remove the extra buttons and text
		if($(this).hasClass('url')) {
		
			var $input = $(this).children('.field').children('input');
			$input.val('');
			$input.attr('placeholder', 'http://');
			$input.siblings().hide();
			
		} // end if

	});

	// Change the text of the submit button
	var $submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
	if($submit.length > 0 && $submit !== null) {
	
		/* Translators: This will need to be manually localized */
		$submit.val('Save Post Advertisement');

		bHasHiddenFields = true;

	} // end if
						
	// Clear the polling interfval
	if(poller !== null && bHasHiddenFields) {
		clearInterval(poller);
	} // end if

} // end standard_ad_banner_hide_unused_fields

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */ 
window.send_to_editor = function(sHtml) {

	// Set the container ID for the preview image that's being uploaded
	var sPreviewId = '#' + _standard_presentationPreviewImage;
	var sPreviewUrlId = '#' + _standard_presentationPreviewUrl;
	
	console.log(jQuery(sPreviewUrlId));

	// Grab the URL of the image and set it into the field's ID.
	// The raw class accepts a string of HTML, the other just the attribute
	if(jQuery('.media-upload-field-raw').length > 0) {
		jQuery('.media-upload-field-raw').val(sHtml);
	} else {
		jQuery(sPreviewUrlId).val(jQuery(sHtml).attr('src'));
	} // end if/else
	
	// If the preview element exists, insert the image into the preview
	if(jQuery(sPreviewId).length > 0) {

		// If there's an anchor in the markup, set a target="_blank" on it
		if(jQuery(sHtml).attr('href') !== undefined && jQuery(sHtml).attr('href') !== null) {
			jQuery(sHtml).attr('target', '_blank');
		} // end if
		
		if(jQuery('.media-upload-field-raw').length > 0) {
			jQuery(sPreviewId).html(sHtml);
		} else {
		
			jQuery(sPreviewId).attr('src', jQuery(sHtml).attr('src'));
			jQuery(sPreviewId).css('width', 16).css('height', 16);
			
		} // end if/else
		
		
	} // end if
			
	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor