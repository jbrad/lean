(function($) {
	$(function() {
		
		// Grab the post title
		$('#post-title').text($('#title').val());
		$('#blog-title').text($('#site-title').text());
		
		// If the post title changes, update the preview
		$('#title').keyup(function() {
			$('#post-title').text($(this).val());
		});
		
		// Poll the permalink field and update the preview as it changes
		setInterval(function() {
			if($('#sample-permalink').text().length > 0 && $('#sample-permalink').text().indexOf('http://') === 0) {
				$('#permalink').text($('#sample-permalink').text());
			} // end if
		}, 1000);
		
		// Poll the date field and update the preview as it changes
		setInterval(function() {
			if($('#timestamp > b').text().indexOf('@') !== -1) {	
				$('#date').text($('#timestamp > b').text().split('@')[0]);
			} else {
				$('#date').text($('#todays-date').text());
			} // end if
		}, 1000);
		
		// Update the description preview to match what the user has entered
		$('#standard_seo_post_meta_description').keyup(function() {
			
			// First, we update the character counter
			$('#character-count').text( 140 - parseInt($(this).val().length) );
			
			// Update the preview of the description
			$('#description').text($(this).val());
			
			// Bold words in the description that also match the title, ignore case
			var aTitleWords = $('#post-title').text().split(' ');
			for(var i = 0, l = aTitleWords.length; i < l; i++) {	
			
				var sCurrentWord = aTitleWords[i];
				$('#description').html(
					$('#description').html().replace(new RegExp(sCurrentWord, 'g'), '<strong>' + sCurrentWord + '</strong>')
				);
				
				$('#description').html(
					$('#description').html().replace(new RegExp(sCurrentWord.toLowerCase(), 'g'), '<strong>' + sCurrentWord.toLowerCase() + '</strong>')
				);
			
			} // end for
			
		});
	
	});
})(jQuery);