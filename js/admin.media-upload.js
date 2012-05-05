(function($) {
	$(function() {
		
		// Display the media uploader whtn the 'Upload' button is clicked
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
	jQuery('#fav_icon').val(jQuery(sHtml).attr('src'));

	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor