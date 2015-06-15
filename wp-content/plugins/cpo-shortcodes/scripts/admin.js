jQuery(document).ready(function(){
    
	/* SETTINGS MENU TABS */
	/* Menu Transitions */
	jQuery('.ctsc-menu-item').click(function(event){
		var current_id = event.target.id;
		if(!jQuery('#' + current_id).hasClass('active')){
			jQuery('.ctsc-block').fadeOut(300);
    		jQuery('#' + current_id + '_block').delay(500).fadeIn(300);
			jQuery('.ctsc-menu-item').removeClass('active');
			jQuery('#' + current_id).addClass('active');
		}
    });
	/* Memorize Current Tab on Saves */
	jQuery('.ctsc-menu-item').click(function(event){
		var current_id = jQuery(this).attr('id');
		jQuery('#ctsc_custom_tab').val(current_id);
    });
	/* Save Settings */
	jQuery('.ctsc-submit').click(function(event){
		jQuery('.ctsc-submit').val('...');
    });
	
	
	/* COLOR PICKER FIELD */
	jQuery('.ctsc-color').each(function(){
		current_object = jQuery(this);
		current_object.wpColorPicker({ defaultColor: current_object.val() });
	});
	
	
	/* IMAGE LIST FIELD */
	//Change border color when selecting the image
    jQuery('.ctsc-form_image_list_item img').click(function() {
        
        //Change other borders
        var parent = jQuery(this).parent().parent();
        jQuery(parent).find('img').each(function() {
            jQuery(this).removeClass('selected');
        });
        
        //Selected image
        jQuery(this).addClass('selected');        
    }); 	
});