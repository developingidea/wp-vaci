<?php

//Display Settings page
if(!function_exists('ctsc_settings')){
	function ctsc_settings(){
		ctsc_custom_form('ctsc_settings', ctsc_metadata_settings());
	}
}

//Save Settings page
if(!function_exists('ctsc_settings_save')){
	add_action('admin_init', 'ctsc_settings_save');
	function ctsc_settings_save(){
		ctsc_custom_save('ctsc_settings', ctsc_metadata_settings());
	}
}
	
//Install settings upon theme switch
if(!function_exists('ctsc_settings_defaults')){
	function ctsc_settings_defaults(){
		ctsc_custom_install('ctsc_settings', ctsc_metadata_settings(), false);
	}
}