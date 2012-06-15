(function($) {
	$(function() {
		$('h4').each(function() {
			if($(this).text().indexOf('(Standard)') > 0) {
				$(this).parents('.widget-top').addClass('standard-widget-top');
			} // end if
		});
	});
})(jQuery);