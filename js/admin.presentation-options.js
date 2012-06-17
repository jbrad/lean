(function($) {
	$(function() {

		// Hide the 'Presentation' header for the posts and pages section
		if($('h3:first').text().toLowerCase() === 'presentation') {
			$('h3:first').hide();	 
		} // end if
		 
	});
})(jQuery);