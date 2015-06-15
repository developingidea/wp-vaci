<?php

	
//Abstracted function for retrieving specific options inside option arrays
if(!function_exists('ctsc_get_option')){
	function ctsc_get_option($option_name = '', $option_array = 'ctsc_settings', $multilingual = true){
		//Determines whether to grab current language, or original language's option
		if($multilingual)
			$option_list_name = $option_array.ctsc_wpml_current_language();
		else
			$option_list_name = $option_array;
		$option_list = get_option($option_list_name, false);
		if($option_list && isset($option_list[$option_name]))
			$option_value = $option_list[$option_name];
		else
			$option_value = false;
		return $option_value;
	}
}

//Abstracted function for updating specific options inside arrays
if(!function_exists('ctsc_update_option')){
	function ctsc_update_option($option_name, $option_value, $option_array = 'ctsc_settings'){
		$option_list_name = $option_array.ctsc_wpml_current_language();
		$option_list = get_option($option_list_name, false);
		if(!$option_list)
			$option_list = array();
		$option_list[$option_name] = $option_value;
		if(update_option($option_list_name, $option_list))
			return true;
		else
			return false;
	}
}

//Returns the current language's code in the event that WPML is active
if(!function_exists('ctsc_wpml_current_language')){
	function ctsc_wpml_current_language(){
		$language_code = '';
		if(ctsc_custom_wpml_active()){		
			$default_language = ctsc_custom_wpml_default_language();
			$active_language = ICL_LANGUAGE_CODE;
			if($active_language != $default_language)
				$language_code = '_'.$active_language;
		}
		return $language_code;
	}
}


//Custom function to do some cleanup on nested shortcodes
//Used for columns and layout-related shortcodes
function ctsc_do_shortcode($content){ 
	$content = do_shortcode(shortcode_unautop($content)); 
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
	return $content;
}


//Retrieves and returns the shortcode prefix with a trailing underscore
function ctsc_shortcode_prefix(){ 
	$prefix = ctsc_get_option('shortcode_prefix'); 
	if($prefix != '') $prefix = esc_attr($prefix).'_';
	return $prefix;
}


//Returns the appropriate URL, either from a string or a post ID
function ctsc_image_url($id, $size = 'full'){ 
	$url = '';
	if(is_numeric($id)){
		$url = wp_get_attachment_image_src($id, $size);
		$url = $url[0];
	}else{
		$url = $id;
	}
	return $url;
}


//Changes the brighness of a HEX color
if(!function_exists('ctsc_alter_brightness')){
	function ctsc_alter_brightness($colourstr, $steps) {
		$colourstr = str_replace('#','',$colourstr);
		$rhex = substr($colourstr,0,2);
		$ghex = substr($colourstr,2,2);
		$bhex = substr($colourstr,4,2);

		$r = hexdec($rhex);
		$g = hexdec($ghex);
		$b = hexdec($bhex);

		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));  
		$b = max(0,min(255,$b + $steps));
	  
		$r = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);  
		$b = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r.$g.$b;
	}
}

