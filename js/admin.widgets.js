(function($) {
	$(function() {
		$('h4').each(function() {
			if($(this).parent().parent().parent().attr('id').indexOf('standard-') > 0) {
				$(this).parents('.widget-top').addClass('standard-widget-top');
			} // end if
		});
	});
})(jQuery);