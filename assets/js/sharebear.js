(function($) {

	// Mail
	$('.sb-icon').click(function() {
		if ($(this).hasClass('sb-envelope') ) {
			// do nothing
		} else {
			window.open(this.href, 'sharebear', 'location=0, width=800, height=500');
			return false;
		}
	});

	// Window Resize
	$(window).resize(function(){
		var windowWidth = $(window).width();
		if(windowWidth > 768) {
			$('.sb-bottom-bar').removeClass('sb-bottom-bar').addClass('sb-sidebar');
		} else {
			$('.sb-sidebar').removeClass('sb-sidebar').addClass('sb-bottom-bar');
		}
	});

	$(window).trigger('resize');

})( jQuery );