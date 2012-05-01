(function($) {
	$(function() {
		
		// Set the text of the post title
		$('#post-title').text($('#title').val());
		$('#blog-title').text($('#site-title').text());
		
		// Update the title if the user changes the title input field
		$('#title').keyup(function() {
			$('#post-title').text($(this).val());
			$('#blog-title').text($('#site-title').text());
		});
		
		// if we're writing a new post, we need to poll for the permalink until it's present.
		if($('#sample-permalink').text().length === 0) {
			var permalinkPoll = setInterval(function() {
				if($('#sample-permalink').text().length > 0) {
					$('#permalink').text($('#sample-permalink').text());
					clearInterval(permalinkPoll);
				}
			}, 1000);
		} // end if
		
		// Set the permalink
		$('#permalink').text($('#sample-permalink').text());
		$('#editable-post-name')
			.change(function() {
			
				// We need to remove the trailing slash
				var sUrlRoot = $('#sample-permalink').text().substring(0, $('#sample-permalink').text().length - 1);			
				$('#permalink').text(sUrlRoot + $('#new-post-slug').val() + '/');
				
			});
		
		// Update the date
		var aTimestamp = $('#timestamp > b').text().split('@');
		var sDate = aTimestamp[0];
		if(aTimestamp.length === 1) {
			$('#date').text($('#todays-date').text());
		} else {
			$('#date').text(aTimestamp[0]);
		} // end if
		
		// Update the character counter and the description whenever the user updates the meta description
		var aTitleWords = $('#post-title').text().split(' ');
		$('#standard_seo_post_meta_description').keyup(function() {
		
			// the character counter
			var iDescriptionLength = parseInt( $(this).val().length );			
			$('#character-count').text( 140 - iDescriptionLength );
			
			// the description field
			$('#description').text($(this).val());
			
			// bold the words in the title and in the description
			var aDescriptionWords = $('#description').text().split(' ');
			var htmlDescription = '';
			/*
			for(var i = 0, l = aDescriptionWords.length; i < l; i++) {
			
				var sCurrentWord = aDescriptionWords[i];
				
				// If the last character of the current word is not a letter of number, let's discard for now	
				if(sCurrentWord.charAt(sCurrentWord.length - 1).match(/[a-zA-Z0-9]/) === null) {
					//sCurrentWord = sCurrentWord.substring(0, sCurrentWord.length - 1);
					//console.log(sCurrentWord);
				} // end if
				
				// Look for matches of whole words in the description in the title
				console.log('About to match: ' + sCurrentWord);
				if($('#post-title').text().toLowerCase().indexOf(sCurrentWord.toLowerCase()) > -1) {
				
					// Mark the words in the description that are also in the title as bold
					aDescriptionWords[i] = '<strong>' + sCurrentWord + '</strong>';
					
				} // end for
				
				htmlDescription += aDescriptionWords[i];
				htmlDescription += ' ';
				
			} // end for
			*/
			// TODO writ ethe routine for making matched words bold in description and title
			//$('#description').html($.trim( htmlDescription ) );
			
			// Update the description
			
			
		});
		
	});
})(jQuery);