//CORE JS FUNCTIONALITY
//Contains only the most essential functions for the theme. No jQuery.

//MOBILE MENU TOGGLE
var menu_exists = !!document.getElementById('menu-mobile-open');
if(menu_exists){
	document.getElementById('menu-mobile-open').addEventListener('click', function(){
		document.body.classList.add('menu-mobile-active');
	});

	document.getElementById('menu-mobile-close').addEventListener('click', function(){
		document.body.classList.remove('menu-mobile-active');
	});
}


//SKIPPING BUTTONS
//Adds smooth scrolling to an anchor link with the specified class
/*jQuery('.skip-to').click(function(e){
	e.preventDefault();
	var target_id = jQuery(this).attr('href');
	jQuery('html, body').animate({
		scrollTop: jQuery(target_id).offset().top
	}, 1000);
});*/