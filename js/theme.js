/* ---------------------------------------------------------------- *
 * Post-page load functionality
 * ---------------------------------------------------------------- */

(function($) {
	$(function() {
		
		// Bootstrap Multi-Level Menus
		$('.submenu').hover(function() {
			
			// Display the submenu on hover
			$(this).children('ul')
				.removeClass('submenu-hide')
				.addClass('submenu-show');
				
		}, function() {
		
			// Hide the submenu when not on hover
			$(this).children('ul')
				.removeClass('.submenu-show')
				.addClass('submenu-hide');
			
		}).click(function() {
		
			// If the submenu item is clicked, navigate to its anchor
			window.location = $(this).children('a').attr('href');
			
		});
		
		// Center Header Logo only if the background image is present
		processLogoAndBackground($);
		$(window).resize(function() {
			processLogoAndBackground($);
		});
		
		// If the Activity Widget is present, activate the first tab
		if($('.tabbed-widget').length > 0) { 
			
			$('.nav-tabs').children('li:first')
				.addClass('active');
				
			$('.tab-content').children('.tab-pane:first')
				.addClass('active');
			
		} // end if
		
		// Navigate to the menu item's anchor
		$('.dropdown a').click(function() {
			window.location = $(this).attr('href');
		});
		
		// Force menus to collapse if resizing from mobile to full
		$(window).resize(function() {
			if($(this).width() >= 979) {
				$('.btn-navbar').trigger('click');
			} // end if
		});
		
		// Move sidebar below content on left sidebar layout
		if($('#sidebar').length > 0 && $('#wrapper > .container > .row').children(':first').attr('id') == 'sidebar') {
		
			moveSidebarInLeftSidebarLayout($);
			$(window).resize(function() {
				moveSidebarInLeftSidebarLayout($);
			});
		
		} // end if
		
		// FitVid
		$('.entry-content').fitVids();
		
	});
})(jQuery);

/**
 * In mobile view with the left-sidebar layout, repositions the sidebar below the content.
 */
function moveSidebarInLeftSidebarLayout($) {

	if($('#wrapper').width() < 768) {
		$('#sidebar').insertAfter('#main');
	} else {
		$('#sidebar').insertBefore('#main');
	} // end if

} // end moveSidebarInLeftSidebarLayout

/**
 * TODO
 */
function processLogoAndBackground($) {
	
	if( ( $background = $('#header-image').children(':first').children('img') ).length > 0 ) {
	
		$('#hgroup').css({
			padding: 0,
			marginTop: Math.round( $background.height() / 2 ) - Math.round( $('#hgroup').height() / 2 )
		});
		
	} // end if

} // end processLogoAndBackground