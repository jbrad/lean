(function($) {
	$(function() {
		
		// Display the media uploader whtn the 'Upload' button is clicked
		$('#upload_fav_icon').click(function() {
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		});
		
		// Remove the URL of the fav icon
		$('#delete_fav_icon').click(function() {
			$('#fav_icon').val('');
		});
		
	});
})(jQuery);

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image afterbeing uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML TODO
 */ 
window.send_to_editor = function(sHtml) {

	// Grab the URL of the image and set it into the favicon's URL
	jQuery('#fav_icon').val(jQuery('img', sHtml).attr('src'));

	// Hide the thickbox
	tb_remove();

} // end window.send_to_editor