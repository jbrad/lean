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
		
		// Setup the handler for triggering the social icon url
		$('#set-social-icon-url').click(function(evt) {
		
			evt.preventDefault();
			
			if($.trim($(this).prev().val()).length > 0) {
			
				// Set the list item's URL
				var sUrl = $(this).prev().val();	
				$('li.active-icon').attr('data-url', sUrl);
				
				// Clear out the input
				$(this).prev().val('');
				
				// Hide the container
				$(this).parent().addClass('hidden');
				
				// Remove active icons
				$('.active-icon').removeClass('active-icon');
				
				// Update the data
				updateIconValues();
				
				// Update the icons
				updateActiveIcons($);
			
			} else {
			
				// Hide the container
				$(this).parent().addClass('hidden');
				
				// Remove active icons
				$('.active-icon').removeClass('active-icon');
				
			} // end if
			
			$('.icon-url').val('');
		
		});
		
		checkForMaxIcons();

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
		
		socialIconsShowMediaUploader($);
		$('#TB_iframeContent').load(function() {
	
			// if the user is uplaoding a new icon, we need to poll until we see the form fields
			var mediaPoll = setInterval(function() {
				if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
					socialOptionsHideUnusedFields($, mediaPoll);
				}  // end if
			}, 500);
	
			// if they aren't uplaoding, we'll clear the fields on load
			socialOptionsHideUnusedFields($);
			
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
		var aIconSrc = $('#' + sInputId).val().split(';');
		$(aIconSrc).each(function() {
		
			if( this.length > 0) {
	
				// Look to see if there are URL's
				var aIconUrl = this.split('|');
				var sUrl = null;
				var sSrc = null;
				if(aIconUrl.length === 1) {
					sSrc = aIconUrl[0];
				} else {
					sSrc = aIconUrl[0]
					sUrl = aIconUrl[1];
				} // end if
	
				// Create the image
				var $socialIcon = $('<img />').attr('src', sSrc);
				
				// Create a list item from the image
				var $listItem = $('<li />').attr('data-url', sUrl).append($socialIcon)
				
				// If we're active icons, let's setup click handlers
				if(sWrapperId === 'active-icons') {
					setupIconClickHander($, $listItem);
				} // end if 
				
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
		update: updateIconValues,
		over: overHandler
	});
	
	$(sAvailableId).children('ul').sortable({
		connectWith: sActiveId + ' > ul',
		update: updateIconValues,
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
function updateIconValues() {
	
	// Update the inputs to track the active icon arrangement.	
	updateActiveIcons(jQuery);
	
	// Update the inputs to track the available icon arrangement.
	updateAvailableIcons(jQuery);

	// Clear the drag and drop border
	jQuery(this).css('border', '0');
	
	jQuery.post(ajaxurl, {
	
		action: 'standard_save_social_icons',
		nonce: jQuery('#standard-save-social-icons-nonce').text(),
		availableSocialIcons: jQuery('#available-social-icons').val(),
		activeSocialIcons: jQuery('#active-social-icons').val(),
		updateSocialIcons: 'true'
		
	}, function(response) {
	
		if( parseInt(response) === 0 ) {

			jQuery('#active-icon-list > li').each(function() {
				setupIconClickHander(jQuery, jQuery(this));
			});
			
		} // end if
		
	});
	
	checkForMaxIcons();

} // end updateIconValues

/**
 * Checks to see if the recommended number of icons are active. If so, displays a warning message.
 */
function checkForMaxIcons() {

	// If the user has seven icons, we need to disable sorting.
	if(jQuery('#active-icon-list').children().length >= 7) {		
		jQuery('#social-icon-max').removeClass('hidden');	
	} else {
		jQuery('#social-icon-max').addClass('hidden');
	} // end if
	
} // end checkForMaxIcons 

/**
 * Attachs a click handler to the incoming element.
 * 
 * @params	$		The jQuery function
 * @params	$this	The element on which to attach the handler
 */
function setupIconClickHander($, $this) {

	$this.click(function(evt) {
		
		var sRssUrl = '';
		if($(evt.srcElement).attr('src') !== '') {
			if($(evt.srcElement).attr('src').toString().indexOf('rss.png') > 0) {
				sRssUrl = $('#standard-wordpress-rss-url').text();
			} // end if
		} // end if
			
		// if the input is visible, clear it out; otherwise, show it.
		if($('#active-icon-url').is(':visible')) {
		
			$(this).parent()
				.siblings('#active-icon-url')
				.children('input[type=text]')
				.val('');
		
		} else {
		
			$(this).parent()
				.siblings('#active-icon-url')
				.removeClass('hidden');

		} // end if/else
		
		$(this).parent()
			.siblings('#active-icon-url')
			.children('input[type=text]')
			.val($(this).attr('data-url'));
		
		// Update the active icon that we're editing
		$('.active-icon').removeClass('active-icon');
		$(this).addClass('active-icon');
		
		updateIconValues();
		
		if('' !== sRssUrl) {
			$('#social-icon-url').val(sRssUrl);
		} // end if
		
	});

} // end setupIconClickHander

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
			
				// Set the image's src and url
				if($(this).children('img').attr('src').length > 0) {
				
					sActiveIcons += $(this).children('img').attr('src');
					
					if($(this).attr('data-url') !== undefined && $(this).attr('data-url') !== null) {
						sActiveIcons += '|' + $(this).attr('data-url');
					} // end if
					
					sActiveIcons += ';';
					
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
			$(evt.srcElement).parent().hide();
			
			updateIconValues();
			
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
function socialOptionsHideUnusedFields($, poller) {

	// Hide unnecessary fields
	var bHasHiddenFormFields = false;
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
		
		bHasHiddenFormFields = true;
		
	} // end if
	
	if( poller !== null && bHasHiddenFormFields) {
		clearInterval(poller);
	} // end if

} // end hideUnusedFields

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
function socialIconsShowMediaUploader() {

 	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	
	// Save the previous handler since we're spinning up another instance
 	window.restore_editor = window.send_to_editor;
 	
	window.send_to_editor = function(sHtml) {
	
		var $img = jQuery(sHtml).children('img').length === 1 ? jQuery(sHtml).children('img') : jQuery(sHtml);
	
		// Store the image's URL in the hidden field
		jQuery('#available-social-icons').val(jQuery('#available-social-icons').val() + ';' + $img.attr('src'));
		
		displayIcons(jQuery, 'available-social-icons', 'available-icons');
		updateIconValues();
	
		// Hide the thickbox
		tb_remove();
		
		// Restore the previous editor handler
		window.send_to_editor = window.restore_editor;		

	} // end window.send_to_editor

	
} // end ad_personal_image_show_media_uploader