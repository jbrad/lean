(function ($) {
	$(function () {

		// Create the notice that will appear above the post title
		var $titleMessage = $('<div />')
			.attr('id', 'standard-post-editor')
			.attr('class', 'warning')
			.append(
				$('<p />')
					.html('<strong>Your title is too long.</strong>')
			);

		// Display the notice if the existing title is too long ( >= 70 characters)
		if($.trim($('#title').val()).length >= 70) {
			$titleMessage.insertBefore($('#title'));
		} // end if

		// Display the notice if the user types a title that is too long ( >= 70 characters)
		$('#title').keydown(function () {

			if($.trim($(this).val()).length >= 70) {
				$titleMessage.insertBefore($('#title'));
			} else {
				$titleMessage.remove();
			} // end if
		
		});
	
	});
}(jQuery));