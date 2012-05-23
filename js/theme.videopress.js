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
		css('width', jQuery('.entry-content').width());
		
	// Update the actual video
	jQuery('.video-player').children()
		.css('width', jQuery('.entry-content').width()); 

} // end sizeVideo