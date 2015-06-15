<?php //Contains assorted functions and utilities for themes.

//Calculate sidebar class to load
function cpotheme_get_sidebar_position(){
	$current_id = cpotheme_current_id();
	if(is_tax() || is_category() || is_tag()){ 
		$sidebar_layout = cpotheme_tax_meta($current_id, 'layout_sidebar');
	}else{
		$sidebar_layout = get_post_meta($current_id, 'layout_sidebar', true);
	}
	if($sidebar_layout == '')
		$sidebar_layout = 'right';
	return $sidebar_layout;
}

	
//Abstracted function for retrieving specific options inside option arrays
if(!function_exists('cpotheme_get_option')){
	function cpotheme_get_option($option_name = '', $option_array = 'cpotheme_settings', $multilingual = true){
		//Determines whether to grab current language, or original language's option
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
if(!function_exists('cpotheme_update_option')){
	function cpotheme_update_option($option_name, $option_value, $option_array = 'cpotheme_settings'){
		$option_list_name = $option_array;
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


//Searches for a link inside a string. Used for post formats
if(!function_exists('cpotheme_find_link')){
	function cpotheme_find_link($content, $fallback){
	
		$link_url = '';
		$link_pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$post_content = $content;
		if(preg_match($link_pattern, $post_content, $link_url))
			return $link_url[0];
		else
			return $fallback;
	}
}


//Retrieve page number for the current post or page
if(!function_exists('cpotheme_current_page')){
	function cpotheme_current_page(){
		$current_page = 1;
		if(is_front_page()){
			if(get_query_var('page')) $current_page = get_query_var('page'); else $current_page = 1;
		}else{
			if(get_query_var('paged')) $current_page = get_query_var('paged'); else $current_page = 1;
		}
		return $current_page;
	}
}


//Retrieve current post or taxonomy id
if(!function_exists('cpotheme_current_id')){
	function cpotheme_current_id(){
		$current_id = false;
		if(is_tax() || is_category() || is_tag()){ 
			$current_id = get_queried_object()->term_id;
		}else{
			global $post;
			if(isset($post->ID)) $current_id = $post->ID; else $current_id = false;
		}
		return $current_id;
	}
}


//Custom function to do some cleanup on nested shortcodes
//Used for columns and layout-related shortcodes
if(!function_exists('cpotheme_do_shortcode')){
	function cpotheme_do_shortcode($content){ 
		$content = do_shortcode(shortcode_unautop($content)); 
		$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
		return $content;
	}
}


add_action('after_switch_theme', 'cpotheme_rewrite_flush');
function cpotheme_rewrite_flush(){
    flush_rewrite_rules();
}