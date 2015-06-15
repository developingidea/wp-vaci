<?php
/*
Plugin Name: CPO Shortcodes
Description: Lets you use over 30 different shortcodes to create incredible, rich-media pages. You can easily insert them using a shortcode generator added to the WordPress visual editor toolbar.
Author: CPOThemes
Version: 1.2.3
Author URI: http://www.cpothemes.com
*/

//Plugin setup
if(!function_exists('ctsc_setup')){
	add_action('plugins_loaded', 'ctsc_setup');
	function ctsc_setup(){
		//Load text domain
		$textdomain = 'ctsc';
		$locale = apply_filters('plugin_locale', get_locale(), $textdomain);
		if(!load_textdomain($textdomain, trailingslashit(WP_LANG_DIR).$textdomain.'/'.$textdomain.'-'.$locale.'.mo')){
			load_plugin_textdomain($textdomain, FALSE, basename(dirname(__FILE__)).'/languages/');
		}
	}
}


//Add Public scripts
add_action('wp_enqueue_scripts', 'ctsc_scripts_front');
function ctsc_scripts_front( ){
    $scripts_path = plugins_url('scripts/' , __FILE__);
	
	//Register custom scripts for later enqueuing
	wp_register_script('ctsc-core', $scripts_path.'core.js', array('jquery'), false, true);
	wp_register_script('ctsc-waypoints', $scripts_path.'jquery-waypoints.js', array());
	wp_register_script('ctsc-toggles', $scripts_path.'shortcodes-toggles.js', array('jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-tabs'));
	wp_register_script('cpotheme-cycle', $scripts_path.'jquery-cycle2.js', array('jquery'), false, true);
}


//Add Admin scripts
if(!function_exists('ctsc_scripts_back')){
	add_action('admin_enqueue_scripts', 'ctsc_scripts_back');
	function ctsc_scripts_back( ){
		$scripts_path = plugins_url('scripts/' , __FILE__);
	
		//Common scripts
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-effects-core');
		wp_enqueue_script('jquery-effects-fade');
		wp_enqueue_script('ctsc-admin-js', $scripts_path.'admin.js');
	}
}


//Add public stylesheets
add_action('wp_enqueue_scripts', 'ctsc_add_styles');
function ctsc_add_styles(){
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('ctsc-shortcodes', $stylesheets_path.'style.css');
	wp_register_style('ctsc-fontawesome', $stylesheets_path.'fontawesome.css');
}

//Add admin stylesheets
add_action('admin_print_styles', 'ctsc_add_styles_admin');
function ctsc_add_styles_admin(){
	$stylesheets_path = plugins_url('css/' , __FILE__);
	wp_enqueue_style('ctsc-admin', $stylesheets_path.'admin.css');
	wp_enqueue_style('ctsc-fontawesome', $stylesheets_path.'fontawesome.css');
}


//Add localized vars
add_action('admin_enqueue_scripts', 'ctsc_shortcode_tinymce_vars');
function ctsc_shortcode_tinymce_vars($plugin_array) {  
	$core_path = plugins_url('images/' , __FILE__);
	wp_localize_script('jquery-ui-core', 'ctsc_vars', array('prefix' => ctsc_shortcode_prefix()));
}
	

//Add TinyMCE button script
add_filter('mce_external_plugins', 'ctsc_shortcode_tinymce');  
function ctsc_shortcode_tinymce($plugin_array) {  
	$core_path = plugins_url('scripts/' , __FILE__);	
	$plugin_array['ctsc_shortcodes'] = $core_path.'shortcodes-tinymce.js';
	return $plugin_array; 
}


//Add TinyMCE button
add_filter('mce_buttons', 'ctsc_shortcode_tinymce_buttons'); 
function ctsc_shortcode_tinymce_buttons($button_list){
   array_push($button_list, "ctsc_shortcodes_button");
   return $button_list; 
} 	

if(function_exists('vc_map')){
	function ctsc_param_icon($settings, $value) {
		$dependency = vc_generate_dependencies_attributes($settings);
		$output = '<div class="my_param_block">';
		$output .= '<select class="wpb_vc_param_value wpb-select fontawesome" name="'.$settings['param_name'].'" '.$dependency.'>';
		$icon_list = ctsc_metadata_icons();
		foreach($icon_list as $icon_key => $icon_value){
			$output .= '<option value="'.$icon_key.'"';
			if($value == $icon_key) $output .= ' selected="selected"';
			$output .= '>'.$icon_value.'</option>';
		}
		$output .= '</select>';	
		$output .= '</div>';
		return $output;
	}
	add_shortcode_param('iconlist', 'ctsc_param_icon');
}

//Allow shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

//Add all Shortcode components
$core_path = plugin_dir_path(__FILE__);

//General
require_once($core_path.'functions/custom.php');
require_once($core_path.'functions/forms.php');
require_once($core_path.'functions/settings.php');
require_once($core_path.'functions/general.php');
//Metadata
require_once($core_path.'metadata/metadata-general.php');
require_once($core_path.'metadata/metadata-settings.php');
//Shortcodes
require_once($core_path.'shortcodes/shortcode-accordion.php');
require_once($core_path.'shortcodes/shortcode-animation.php');
require_once($core_path.'shortcodes/shortcode-button.php');
require_once($core_path.'shortcodes/shortcode-clear.php');
require_once($core_path.'shortcodes/shortcode-column.php');
require_once($core_path.'shortcodes/shortcode-counter.php');
require_once($core_path.'shortcodes/shortcode-dropcap.php');
require_once($core_path.'shortcodes/shortcode-feature.php');
require_once($core_path.'shortcodes/shortcode-focus.php');
require_once($core_path.'shortcodes/shortcode-leading.php');
require_once($core_path.'shortcodes/shortcode-list.php');
require_once($core_path.'shortcodes/shortcode-map.php');
require_once($core_path.'shortcodes/shortcode-message.php');
require_once($core_path.'shortcodes/shortcode-optin.php');
require_once($core_path.'shortcodes/shortcode-posts.php');
require_once($core_path.'shortcodes/shortcode-pricing.php');
require_once($core_path.'shortcodes/shortcode-progress.php');
require_once($core_path.'shortcodes/shortcode-separator.php');
require_once($core_path.'shortcodes/shortcode-section.php');
require_once($core_path.'shortcodes/shortcode-slideshow.php');
require_once($core_path.'shortcodes/shortcode-spacer.php');
require_once($core_path.'shortcodes/shortcode-tabs.php');
require_once($core_path.'shortcodes/shortcode-team.php');
require_once($core_path.'shortcodes/shortcode-testimonial.php');

register_activation_hook(__FILE__, 'ctsc_settings_defaults');

//Change directory for overriding VC templates
if(function_exists('vc_set_template_dir')){
	vc_set_template_dir($core_path.'templates/');
}