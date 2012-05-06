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
				
				$submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
				if($submit.length > 0 && $submit !== null) {
					/* TODO This will need to be manually localized */
					$submit.val('Save as Site Icon');
					clearInterval(submitPoll);
				} // end if
				
			}, 1000);
			
		});
		
		// Remove the URL of the fav icon
		$('#delete_fav_icon').click(function() {
			$('#fav_icon').val('');
		});
		
		/* --- Advertisements --- */
		
		if($('#post_advertisement_type').length > 0){
		
			$select = $('#post_advertisement_type');
			if($select.attr('value') === 'image') {
				$select.parents('tr').siblings(':last').hide();
				$select.parents('tr').next().show();
			} else {
				$select.parents('tr').siblings(':last').show();
				$select.parents('tr').next().hide();
			} // end if/else
		
			$select.change(function() {
				if($(this).children(':selected').attr('value') === 'image') {
					$(this).parents('tr').siblings(':last').hide();
					$(this).parents('tr').next().show();
				} else {
					$(this).parents('tr').siblings(':last').show();
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
			$(this).siblings('#post_advertisement_preview').hide();
			
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

	// Grab the URL of the image and set it into the favicon's URL
	// TODO this doens't yet support links
	jQuery('.media-upload-field').val(jQuery(sHtml).attr('src'));		

	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor