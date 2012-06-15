(function($) {
	$(function() {
	
		// hide the table row if offline mode is disabled
		if($('#offline_mode').is(':not(:checked)')) {
			$('#offline_mode_message').parent()
				.parent()
				.hide();
		} // end if
		
		// toggle the offline message when the label or checkbox is clicked
		$('#offline_mode, label[for="offline_mode"]').click(function() {
		
			$parent = $('#offline_mode_message').parent().parent();
			$('#offline_mode').is(':not(:checked)') ? $parent.hide() : $parent.show();
			
		});
		
	});
})(jQuery);