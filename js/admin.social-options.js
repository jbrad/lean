(function($) {
	$(function() {
		
		// Hide the table of options.
		$('.social-icons-wrapper').siblings('table').hide();
		
		prepareIconMediaUploader($);

		// Render the avaialable icons and the active icons
		displayIcons($, 'available-social-icons', 'available-icons');
		displayIcons($, 'active-social-icons', 'active-icons');
		
		// Make the lists sortable
		makeSortable($, '#active-icons', '#available-icons');
		
		// Setup how to delete icons
		makeIconsRemoveable($);

	});
})(jQuery);

/**
 * Sets up the icon media uploader to render with limited fields when the upload button
 * has been clicked.
 *
 * @params	$	A reference to the jQuery function
 */
function prepareIconMediaUploader($) {

	// Setup the media uploader for this button
	$('#upload-social-icon').click(function(evt) {
		
		evt.preventDefault();
		
		social_icons_show_media_uploader($);
		$('#TB_iframeContent').load(function() {
	
			// if the user is uplaoding a new icon, we need to poll until we see the form fields
			var mediaPoll = setInterval(function() {

				if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
					
					// Hide unnecessary field
					hideUnusedFields($, mediaPoll);
					
				} 
			}, 1000);
	
			// if they aren't uplaoding, we'll clear the fields on load
			hideUnusedFields($);
			
		});
	
		
	});

} // end prepareIconMediaUploader

/**
 * Sets up the icon media uploader to render with limited fields when the upload button
 * has been clicked.
 *
 * @params		$				A reference to the jQuery function
 * @params		sInputId		A reference to the input field that contains the icons to display
 * @params		sWrapperId		A reference to the container that will contain the list of icons.
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
 * Enables sorting for the social icon containers.
 *
 * @params		$				A reference to the jQuery function
 * @params		sActiveId		A reference to the container of the active icons
 * @params		sWrapperId		A reference to the container of the available icons
 */
function makeSortable($, sActiveId, sAvailableId) {

	$(sActiveId).children('ul').sortable({
		connectWith: sAvailableId + ' > ul',
		update: updateHandler,
		over: overHandler
	});
	
	$(sAvailableId).children('ul').sortable({
		connectWith: sActiveId + ' > ul',
		update: updateHandler,
		over: overHandler
	});

} // end makeSortable

/**
 * Adds a border around an element that is about to receive an icon.
 */
function overHandler() {
	jQuery(this).css('border', '1px dashed #ccc');
} // end overHandler

/**
 * Updates the list of active icons and available icons. Fired when sorting has been completed.
 */
function updateHandler() {

	// Update the inputs to track the active icon arrangement.	
	updateActiveIcons(jQuery);
	
	// Update the inputs to track the available icon arrangement.
	updateAvailableIcons(jQuery);

	// Clear the drag and drop border
	jQuery(this).css('border', '0');

}

/**
 * Updates the input field of active icons.
 *
 * @params	$	A reference to the jQuery function
 */
function updateActiveIcons($) {

	var sActiveIcons = '';
	$('#active-icons ul').children('li')
		.each(function() {
			if($(this).children().length > 0) {
				if($(this).children('img').attr('src').length > 0) {
					sActiveIcons += $(this).children('img').attr('src') + ';';
				} // end if
			} else {

			} // end if
		});
	$('#active-social-icons').val(sActiveIcons);

} // end updateActiveIcons

/**
 * Updates the input field of available icons.
 *
 * @params	$	A reference to the jQuery function
 */
function updateAvailableIcons($) {

	var sAvailableIcons = '';
	$('#available-icons ul').children('li').each(function() {
		if($(this).children('img').length > 0 && $(this).children('img').attr('src').length > 0) {
			sAvailableIcons += $(this).children('img').attr('src') + ';';
		} // end if 	
	});
	$('#available-social-icons').val(sAvailableIcons);

} // end updateAvailableIcons

/**
 * Makes it possible to delete icons via shortcuts or dragging to the appropropriate area.
 *
 * @params	$	A reference to the jQuery function
 */
function makeIconsRemoveable($) {

	// Drag and drop delete ala widgets
	$('#delete-icons').droppable({
		
		over: overHandler, 
		
		drop: function(evt) {
		
			$(evt.srcElement).hide().attr('src', '');
			updateAvailableIcons($);
			
			$(this).css('border', 0);
	
		} // end drop
		
	});
	
	// Delete shortcut ala OS X
	$('#available-icons > ul > li').click(function() {
		
		// Maintain a reference to the icon we're removing
		var $icon = $(this).children('img');
		
		// Look for the delete shortcut
		$(window).keydown(function(evt) {
		
			if(evt.keyCode === 93) {
			
				$(window).keydown(function(evt) {
				
					if(evt.keyCode === 8) {
						
						// Hide the icon and remove it's source attribute
						$icon.hide().attr('src', '');
	
						updateAvailableIcons($);
	
						$(window).unbind(evt);
						
					} // end if
					
				});
				
			} // end if
			
		});
		
	});

} // end makeIconsRemoveable

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image	
 */
function hideUnusedFields($, poller) {

	// Hide unnecessary fields
	var $formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
	$formFields.each(function() {
	
		// Remove everything except the URL field
		if(!($(this).hasClass('submit'))) {
			$(this).hide();
		} // end if
		
	});
	
	// Change the text of the submit button		
	var $submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
	if($submit.length > 0 && $submit !== null) {
	
		/* Translators: For now, this has to be localized inline. */
		$submit.val('Upload Social Icon');
		
	} // end if
	
	if( poller !== null) {
		clearInterval(poller);
	}

} // end hideUnusedFields

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