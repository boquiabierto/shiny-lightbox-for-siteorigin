(function($){

	$(function() {
		var widgets = [ 'gallery', 'sow-masonry-grid', 'so-widget-sow-image-grid'];
		$.each( widgets, function( index, value ){
			$( '.lightbox .' + value + ' a' ).shinybox();
		});
	});
	
})(jQuery);
