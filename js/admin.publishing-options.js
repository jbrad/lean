(function($) {
	$(function() {
		
		// Privacy Policy
		$('#generate_privacy_policy').click(function(evt) {
			
			evt.preventDefault();
			
			$.post(ajaxurl, {
				
					action: 'standard_generate_privacy_policy_page',
					nonce: $.trim($('#standard-privacy-policy-nonce').text()),
					generatePrivacyPolicy: 'true'
					
				}, function(response) {
				
					if( parseInt(response) > 0 ) {

						$('#generate-privacy-policy-wrapper').hide('fast', function() {
						
							var sNewHref = $('#edit-privacy-policy').attr('href');
							sNewHref = sNewHref.replace('null-privacy-policy', response);
							
							$('#edit-privacy-policy').attr('href', sNewHref);
							$('#has-privacy-policy-wrapper').show();
							
						});
						
					} // end if
					
				});
			
		});
		
		// Comment Policy
		$('#generate_comment_policy').click(function(evt) {
			
			evt.preventDefault();
			
			$.post(ajaxurl, {
				
					action: 'standard_generate_comment_policy_page',
					nonce: $.trim($('#standard-comment-policy-nonce').text()),
					generateCommentPolicy: 'true'
					
				}, function(response) {

					if( parseInt(response) > 0 ) {
					
						$('#generate-comment-policy-wrapper').hide('fast', function() {
						
							var sNewHref = $('#edit-comment-policy').attr('href');
							sNewHref = sNewHref.replace('null-comment-policy', response);
							
							$('#edit-comment-policy').attr('href', sNewHref);
							console.log($('#edit-comment-policy'));
							$('#has-comment-policy-wrapper').show();
							
						});
						
					} // end if
					
				});
			
		});
		
	});
})(jQuery);