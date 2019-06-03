(function($){
	
	$( '.lightbox .gallery a, .lightbox .sow-masonry-grid a' ).shinybox();
	
	$( '.lightbox img').each(function( index ){
		if ( $(this).parent().is('a') ) {
			$(this).parent().shinybox();
		}
	});
	
})(jQuery);
