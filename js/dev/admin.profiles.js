(function($) {
	"use strict";
	$(function () {
	
		var $googlePlus, sMessage, spanMessage;
		$googlePlus = $('#google_plus');
	
		if( 0 < $googlePlus.length ) {
			
			sMessage = "We do not support Google+ vanity URLs.";
			
			spanMessage = 
				$('<span />')
					.attr('class', 'description')
					.html( '&nbsp;' + sMessage );
			
			spanMessage.insertAfter( $googlePlus );
			
		} // end if
		
	});
}(jQuery));