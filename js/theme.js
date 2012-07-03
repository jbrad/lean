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
		}).load(function() {
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
		
		// Introduce responsive functionality but only if the CSS is loaded
		if($('link[id*="bootstrap-responsive-css"]').length > 0) {
		
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
			
		} // end if

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
 * This positions the logo against the background so that it's centered and properly positioned for
 * responsive behavior.
 *
 * @params	$	A reference to the jQuery function.
 */
function processLogoAndBackground($) {
	
	var $background = null;
	if( ( $background = $('#header-image').children(':first').children('img') ).length > 0 ) {
	
		$('#hgroup').css({
			padding: 0,
			marginTop: Math.round( $background.height() / 2 ) - Math.round( $('#hgroup').height() / 2 )
		});
		
	} // end if
	
	// Center header widgets based on if the backgroound and logo is present
	if( $('#header-widget').length > 0) {	
		if( $('#logo').length > 0 && $('#logo').children().length >= 1) {
			$('#header-widget').css({
				marginTop: Math.round( $('#hgroup').height() / 2 ) - Math.round( $('#header-widget').height() / 2 )
			});			
		} else {
			$('#header-widget').css({
				marginTop: Math.round( $('#header-image').height() / 2 ) - Math.round( $('#header-widget').height() )
			});	
		} // end if/else
	} // end if
		
	

} // end processLogoAndBackground