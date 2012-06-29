(function($) {
	$(function() {
		sizeVideo();
		$(window)
			.load(sizeVideo)
			.resize(sizeVideo);
	});
})(jQuery);

function sizeVideo() {

	// Update the poster size
	jQuery('.videopress-poster').
		css('width', jQuery('.video-player').parent().width());
		
	// Update the actual video
	jQuery('.video-player').children()
		.css('width', jQuery('.video-player').parent().width()); 

	// If the site is full-width, fix the float issue ont he thumbnail
	if( jQuery('.fullwidth').length > 0 ) {
	
		jQuery('.videopress-poster')
			.height('100%');
			
		jQuery('.videopress-placeholder')
			.children('div:last')
			.children('img')
			.css('margin-top', '-40px');
			
	} // end if

} // end sizeVideo