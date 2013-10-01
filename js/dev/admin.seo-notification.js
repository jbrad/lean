(function($) {
	"use strict";
	$(function () {
		
		if($('#lean-hide-seo-message').length > 0) {
		
			$('#lean-hide-seo-message').click(function(evt) {

				evt.preventDefault();
				
				$.post(ajaxurl, {
				
					action: 'save_wordpress_seo_message_setting',
					nonce: $.trim($('#hide-seo-message-nonce').text()),
					hideSeoNotification: 'true'
					
				}, function(response) {

					if(parseInt(response, 10) === 0) {
						$('#hide-seo-message-notification').hide();
					} // end if
					
				});
				
			});
		
		} // end if
		
	});
}(jQuery));