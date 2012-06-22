(function($) {
	$(function() {
		if( $('#postdivrich').length > 0 && $('#editable-post-name').text().toLowerCase() === 'search-results') {
			$('#postdivrich').hide();
			$('.postbox-container').hide();
		} // end if
	});
})(jQuery);