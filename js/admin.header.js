(function($) {
	$(function() {
		
		// If the header bottom element is present, then there's a background image
		if($('#header-bottom').length > 0) {
			$('#header-top').addClass('has-background');
		} // end if
		
		// Make sure the description color matches the color of the header, if custom colors are being used.			
		$(document).mouseup(function() {
			updateDescriptionTextColor($);
		});
		
		$('#text-color').keyup(function() {
			updateDescriptionTextColor($);
		});
		
		// If the 'Reset Header Text' button is visible, provide the custom color.
		if($('#resettext').is(':visible')) {
			updateDescriptionTextColor($);
		} // end if 
	
	});
	
})(jQuery);

/**
 * Updates the color of the description text in the 'Header' dashboard screen
 * to match what the user will see on the frontend.
 */
function updateDescriptionTextColor($) {

	if($('#text-color').val().length === 4 || $('#text-color').val().length === 7) {
		$('#desc').removeAttr('style')
				.css('color', $('#text-color').val().toString() + ' !important');
	} // end if 
	
} // updateDescriptionTextColor