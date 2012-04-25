(function($) {
	$(function() {
		
		if($('#page_template').length > 0) {
			$('#page_template').children('option')
				.each(function() {
					if($(this).val() == 'template-sitemap.php') {
						$(this).attr('disabled', 'disabled');
					}
				});
		} // end if
		
	});
})(jQuery);