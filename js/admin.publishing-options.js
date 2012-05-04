(function($) {
	$(function() {
		
		// Privacy Policy
		// Generate the policy when the button is clicked
		$('#generate_privacy_policy').click(function(evt) {
			
			evt.preventDefault();
			
			$.post(ajaxurl, {
				
					action: 'standard_generate_privacy_policy_page',
					nonce: $.trim($('#standard-privacy-policy-nonce').text()),
					generatePrivacyPolicy: 'true'
					
				}, function(response) {
console.log( response );
					if( parseInt(response) > 0 ) {
						$('#generate-policy-wrapper').slideUp('fast', function() {
						
							var sNewHref = $('#edit-privacy-policy').attr('href');
							sNewHref = sNewHref.replace('null-policy', response);
							
							$('#edit-privacy-policy').attr('href', sNewHref);
							$('#has-policy-wrapper').slideDown('fast');
							
						});
					} // end if
					
				});
			
		});
		
		/* Comment Policy */
		
	});
})(jQuery);