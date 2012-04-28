(function($) {
	$(function() {
		
		// TODO this should pull in the author's gravatar based on email address
		
		// Toggles acceptable HTML tags
		if($('.form-allowed-tags').length > 0) {

			$('.form-allowed-tags').children('a')
				.click(function(evt) {
					evt.preventDefault();
					$(this).siblings('code')
						.fadeToggle('fast');
				});
				
		} // end if
		
	});
})(jQuery);