(function($) {

	$(window).load(function() {

		// If the header bottom element	$('#standard-theme-logo').hide(); is present, then there's a background image
		if($('#header-bottom').length > 0) {
			$('#header-top').addClass('has-background');
		} // end if
		
		// Make sure the description color matches the color of the header, if custom colors are being used.			
		$(document).mouseup(function() {
			//updateDescriptionTextColor($);
		});
		
		$('#text-color').keyup(function() {
			//updateDescriptionTextColor($);
		});
		
		// If the 'Reset Header Text' button is visible, provide the custom color.
		if($('#resettext').is(':visible')) {
			//updateDescriptionTextColor($);
		} // end if 
		
		// If we're editing the header and the user has uploaded a background image and a logo...
		if( $('#header-bottom').length > 0 ) {

			// Get the logo depending on if it's an image or text 
			var $logo = null;
			if( ( $logo = $('#standard-theme-logo') ).length === 0 ) {
				$logo = $('#header-top');
			} // end if

			// Position the logo
			$background = $('#standard-theme-background');
			$logo.css({
				marginTop: Math.round( $background.height() / 2 ) - Math.round( $logo.height() / 4 )
			}).fadeIn('fast');
			
		} else {
		
			$('#header-top').css('margin-bottom', '0');
			if($('#standard-theme-logo').length > 0) {
				$('#standard-theme-logo').fadeIn('fast');
			} // end if
			
		} // end if
		
		// Hide the options for the text input if we're using a logo
		if( $('#standard-theme-logo').length > 0 ) {
			$('h3').each(function() {
			
				/* Translators: This will need to be translated. */
				if($(this).text().toLowerCase() === 'header text') {
				
					$(this).hide();
					$(this).next().hide();
					
				} // end if
				
			});
		} // end if
	
	});
	
})(jQuery);

/**
 * Updates the color of the description text in the 'Header' dashboard screen
 * to match what the user will see on the frontend.
 */
function updateDescriptionTextColor($) {
	if($('#desc').is(':visible')) {

	} // end if 
} // updateDescriptionTextColor