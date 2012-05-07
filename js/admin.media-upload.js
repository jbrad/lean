(function($) {
	$(function() {
		
		/* --- Fav Icon --- */
		
		// Display the media uploader when the 'Upload' button is clicked
		$('#upload_fav_icon').click(function() {
			
			// Show the media uploader
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			
			// Change the text of the 'Insert Into Post' button
			var $submit = null;
			var submitPoll = setInterval(function() {
				
				if($('#TB_iframeContent').length > 0) {
				
					// Hide unnecessary fields
					var $formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
					$formFields.each(function() {
					
						// Remove everything except the URL field
						if(!$(this).hasClass('submit')) {
							$(this).hide();
						} // end if
						
					});
				
					// Change the text of the submit button
					$submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
					if($submit.length > 0 && $submit !== null) {
						/* TODO This will need to be manually localized */
						$submit.val('Save as Site Icon');
						clearInterval(submitPoll);
					} // end if
				
				} // end if
				
			}, 1000);
			
		});
		
		// Remove the URL of the fav icon
		$('#delete_fav_icon').click(function() {
			$('#fav_icon').val('');
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
			var $submit = null;
			var submitPoll = setInterval(function() {
				
				if($('#TB_iframeContent').length > 0) {
				
					// Hide unnecessary fields
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
							$(this).children('.field').children('input').siblings().hide();
						} // end if
						
					});
				
					// Change the text of the submit button
					$submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
					if($submit.length > 0 && $submit !== null) {
						/* TODO This will need to be manually localized */
						$submit.val('Save Post Advertisement');
						clearInterval(submitPoll);
					} // end if
				} // end if
				
			}, 1000);
		
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
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */ 
window.send_to_editor = function(sHtml) {

	// Grab the URL of the image and set it into the field's ID.
	// The raw class accepts a string of HTML, the other just the attribute
	if(jQuery('.media-upload-field-raw').length > 0) {
		jQuery('.media-upload-field-raw').val(sHtml);
	} else {
		jQuery('.media-upload-field').val(jQuery(sHtml).attr('src'));
	} // end if/else
	
	// If the preview element exists, insert the image into the preview
	if(jQuery('#image_upload_preview').length > 0) {

		// If there's an anchor in the markup, set a target="_blank" on it
		if(jQuery(sHtml).attr('href') !== undefined && jQuery(sHtml).attr('href') !== null) {
			jQuery(sHtml).attr('target', '_blank');
		} // end if
		
		if(jQuery('.media-upload-field-raw').length > 0) {
			jQuery('#image_upload_preview').html(sHtml);
		} else {
		
			jQuery('#image_upload_preview').attr('src', jQuery(sHtml).attr('src'));
			jQuery('#image_upload_preview').css('width', 16).css('height', 16);
			
		} // end if/else
		
		
	} // end if
			
	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor