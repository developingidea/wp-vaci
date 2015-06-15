<?php 

if(!function_exists('ctsc_metadata_settings')){
	function ctsc_metadata_settings(){
		$ctsc_config = array();
		
		$ctsc_config[] = array(
		'id' => 'shortcode_prefix',
		'name' => __('Shortcode Prefix', 'ctsc'),
		'desc' => __('Specifies a prefix for all shortcodes, so that you may avoid possible conflicts when installing themes or other plugins. If using a prefix, an underscore (_) will be used as a separator.', 'ctsc'),
		'type' => 'text',
		'std' => 'ct');
		
		
		return $ctsc_config;
	}
}