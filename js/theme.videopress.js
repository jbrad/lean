(function($) {
	$(function() {
		$(window).resize(function() { 
			$('.video-player').children()
				.css('width', $('.entry-content').width()); 
		});
	});
})(jQuery);