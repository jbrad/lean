(function($) {
	"use strict";
	$(function() {
		$('h4').each(function() {

			var $parent = $(this).parent().parent().parent();

			if($parent.attr('id') !== undefined && $parent.attr('id') !== false) {
				$(this).parents('.widget-top').addClass('widget-top');
			} // end if
		});
	});
}(jQuery));