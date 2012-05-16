(function($) {
	$(function() {
		
		// Hide the table of options.
		$('.social-icons-wrapper').siblings('table').hide();
		
		prepareIconMediaUploader($);

		// Render the available icons and make them draggable
		displayIcons($, 'available-social-icons', 'available-icons');
		makeDraggableAndDroppable($, 'available-icons');
		
		// Render the active icons and make them draggable
		displayIcons($, 'active-social-icons', 'active-icons');
		makeDraggableAndDroppable($, 'active-icons');

	});
})(jQuery);

/**
 * TODO
 */
function prepareIconMediaUploader($) {

	// Setup the media uplaoder for this button
	$('#upload-social-icon').click(function(evt) {
		
		evt.preventDefault();
		
		social_icons_show_media_uploader($);
		$('#TB_iframeContent').load(function() {
	
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
				$submit.val('Upload Social Icon');
				
			} // end if
		});
	
		
	});

} // end prepareIconMediaUploader

/**
 * TODO
 */
function displayIcons($, sInputId, sWrapperId) {

	if($('#' + sInputId).length > 0) {

		// Clear out the existing list
		$('#' + sWrapperId + ' > ul').children('li').remove();
	
		// Rebuild the list based on the available icons
		var aIconUrls = $('#' + sInputId).val().split(';');
		$(aIconUrls).each(function() {
		
			if( this.length > 0) {
	
				// Create the image
				var $socialIcon = $('<img />').attr('src', this);
				
				// Create a list item from the image
				var $listItem = $('<li />').append($socialIcon)
				
				// Append it to the list of available icons
				$('#' + sWrapperId)
					.children('ul')
					.append($listItem);
				
			} // end if 
			
		});
	
	} // end if 

} // end displayIcons

/**
 * TODO
 */
function makeDraggableAndDroppable($, sId) {

	$('#' + sId).children('ul')
		.droppable({

			over: function() {
				$(this).css('border', '1px dashed #ccc');
			}, 
			
			out: function() {
				$(this).css('border', '0');
			},
			
			drop: function(event, ui) {
	
				// Drop the social icons into the new container
				$(this).append($(event.srcElement).parent());
				
				// Update the inputs to track the active icon arrangement.				
				var sActiveIcons = '';
				$('#active-icons ul').children().each(function() {
					if($(this).children('img').attr('src').length > 0) {
						sActiveIcons += $(this).children('img').attr('src') + ';';
					} // end if
				});
				$('#active-social-icons').val(sActiveIcons);
			
				// Update the inputs to track the available icon arrangement.
				var sAvailableIcons = '';
				$('#available-icons ul').children().each(function() {
					if($(this).children('img').attr('src').length > 0) {
						sAvailableIcons += $(this).children('img').attr('src') + ';';
					} // end if 
				});
				$('#available-social-icons').val(sAvailableIcons);
	
				$(this).css('border', '0');
	
			} // end drop
		})
		.children('li')
		.draggable({ 
			revert: true,
			revertDuration: 0
		});

} // end makeDroppableDraggable

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
function social_icons_show_media_uploader() {

 	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	
	// Save the previous handler since we're spinning up another instance
 	window.restore_editor = window.send_to_editor;
 	
	window.send_to_editor = function(sHtml) {
	
		// Store the image's URL in the hidden field
		jQuery('#available-social-icons').val(jQuery('#available-social-icons').val() + ';' + jQuery(sHtml).attr('src'));
		
		displayIcons(jQuery, 'available-social-icons', 'available-icons');
	
		// Hide the thickbox
		tb_remove();
		
		// Restore the previous editor handler
		window.send_to_editor = window.restore_editor;		

	} // end window.send_to_editor

	
} // end ad_personal_image_show_media_uploader