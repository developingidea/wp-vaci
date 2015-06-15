jQuery(document).ready(function(){
	
	//HOMEPAGE SLIDES
	jQuery('.slider-slides').cycle({
		speed: jQuery(this).data('speed'),
		timeout: jQuery(this).data('timeout'),
		fx: jQuery(this).data('effect'),
		pager: '.slider-pages',
		pause: true,
		pauseOnPagerHover: true,
		containerResize: false,
		slideResize: false,
		fit: 1
	});
	jQuery('.slider-pages').click(function(){
		jQuery('.slider-slides').cycle('pause');
	});
	
	/* HEADER PARALLAX */
	var slider_height = jQuery('.slider-slides').height();
	var fadeUntil = slider_height / 1, paddingFactor = slider_height / 5;
	jQuery(window).bind('scroll', function(){
		var offset = jQuery(document).scrollTop(), opacity = 0, padding = 0;
		if(offset <= fadeUntil){
			opacity = 1 - offset / fadeUntil;
			padding = paddingFactor * offset / fadeUntil;
		}
		jQuery('.slide-body').css('opacity', opacity);
		jQuery('.slide-body').css('margin-top', padding);
	});
});