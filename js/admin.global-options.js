(function($) {
	$(function() {

		// Hide the 'Global' header for the posts and pages section
		if($('h3:first').text().toLowerCase() === 'global') {
			$('h3:first').hide();	 
		} // end if
		 
	});
})(jQuery);