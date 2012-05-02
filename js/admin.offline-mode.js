(function($) {
	$(function() {
	
		// hide the table row if offline mode is disabled
		if($('#offline_mode').is(':not(:checked)')) {
			$('#offline_mode_message').parent()
				.parent()
				.hide();
		} // end if
		
		// toggle the offline message when the label or checkbox is cliekd
		$('#offline_mode, label[for="offline_mode"]').click(function() {
			if($('#offline_mode').is(':not(:checked)')) {
				$('#offline_mode_message').parent()
					.parent()
					.toggle();
			} // end if
		});
		
	});
})(jQuery);