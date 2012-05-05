// Globals are bad, but we need it in order to get the unique ID of the field
// that's related to this specific instance of the widget.
_standard_sAdSrcId = null;

(function($) {
	$(function() {

		// Display the uploader when the anchor is clicked
		$('.standard-ad-300x250-wrapper > a').click(function(evt) {
			
			evt.preventDefault();
			
			// Identify the input field that's related to this particular anchor
			_standard_sAdSrcId = $(this).siblings(':first').attr('id');
			
			// Show the media uploader
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');

			// Change the text of the 'Insert Into Post' button
			var $submit = null;
			var submitPoll = setInterval(function() {
				
				$submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
				if($submit.length > 0 && $submit !== null) {
					/* TODO This will need to be manually localized */
					$submit.val('Upload Advertisement');
					clearInterval(submitPoll);
				} // end if
				
			}, 1000);

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
	jQuery('#' + _standard_sAdSrcId).val(jQuery(sHtml).attr('src'));

	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor