<?php

//Adds the admin custom pages for Theme Settings, SEO and Update
if(!function_exists('ctsc_custom')){
	add_action('admin_menu', 'ctsc_custom');
	function ctsc_custom(){
		//Get the image path for the core icon
		$core_path = get_template_directory_uri().'/core/';
		if(defined('CPO_CORE')) $core_path = CPO_CORE;
		
		//Set up data to add admin menus
		add_options_page(__('CPO Shortcodes', 'ctsc'), __('CPO Shortcodes', 'ctsc'), 'manage_options', 'ctsc_settings', 'ctsc_settings');
	}
}

//Build Settings Form
if(!function_exists('ctsc_custom_form')){
	function ctsc_custom_form($option_name, $option_list){ 
		
		$option_name = $option_name.ctsc_custom_wpml_option_suffix(); ?>
		
		<div class="wrap">
			<div class="icon32" id="icon-themes"></div>
			<h2><?php echo get_admin_page_title(); ?></h2>
			
			<?php //ctsc_custom_header($option_list); ?>
			
			<div id="settingsmenu" class="ctsc-menu">
				<?php ctsc_custom_nav($option_list); ?>
			</div>

			<?php if(isset($_GET['ok'])): ?>
			<div id="message" class="updated">
				<p><strong><?php _e('Changes have been saved.', 'ctsc'); ?></strong></p>
			</div>
			<?php endif; ?>
			<?php if(isset($_GET['error'])): ?>
			<div id="message" class="error">
				<p><strong><?php _e('Changes could not be saved.', 'ctsc'); ?></strong></p>
			</div>
			<?php endif; ?> 
			
			<form name="ctsc_custom_form" method="post" action="admin.php?page=<?php echo $_GET['page'].ctsc_custom_wpml_option_url(); ?>" enctype="multipart/form-data">
				<?php if(isset($_GET['tab']) && $_GET['tab'] != '') $current_tab = htmlentities($_GET['tab']); else $current_tab = ''; ?>
				<input type="hidden" name="ctsc_custom_tab" id="ctsc_custom_tab" value="<?php echo $current_tab; ?>" />
				<input type="hidden" name="ctsc_custom_action" id="ctsc_custom_action" value="<?php echo $option_name; ?>" />
				<?php ctsc_custom_fields($option_list, $option_name); ?>
				<?php if(function_exists('wp_nonce_field')) wp_nonce_field('ctsc_nonce'); ?>
			</form>
		</div>
	<?php }
}


//Create navigation menu for settings page
if(!function_exists('ctsc_custom_nav')){
	function ctsc_custom_nav($options){
		$output .= '<div class="ctsc-languages">';
		$output .= ctsc_custom_wpml_nav();
		$output .= '</div>';
		echo $output;
	}
}

//Display the options forms fields
if(!function_exists('ctsc_custom_fields')){
	function ctsc_custom_fields($cpo_options, $list_name){    
		$output = '';
		$tab_count = 0;
		$current_tab = '';
		if(isset($_GET['tab']) && $_GET['tab'] != '')
			$current_tab = htmlentities($_GET['tab']);
		$option_list = get_option($list_name, false);
	   
		$output .= '<div class="ctsc-block">';
		//$output .= '<input class="ctsc-submit button-primary" type="submit" name="ctsc_settings_save" value="'.__('Save Settings', 'ctsc').'" />';
		
		foreach($cpo_options as $current_field){
			
			//Set common attributes for each element
			$field_name = isset($current_field['id']) ? $current_field['id'] : '';
			$field_title = isset($current_field['name']) ? $current_field['name'] : '';
			$field_desc = isset($current_field['desc']) ? $current_field['desc'] : '';
			$field_type = isset($current_field['type']) ? $current_field['type'] : 'separator';
			
			$field_value = '';
			//$field_value = get_option($field_name);
			if($option_list && isset($option_list[$field_name])) $field_value = $option_list[$field_name];
				
				
			// Is a field divider
			if($field_type == 'divider'){
				$output .= '<h3 class="ctsc-divider">'.$field_title.'</h3>';
			
			//Is a normal field. Print field containers
			}else{
				$output .= '<div class="item">';
				$output .= '<label for="'.$field_name.'" class="field-title">'.$field_title.'</label>';
				$output .= '<div class="field-content">';
			}
			
			if($field_type == 'text')
				$output .= ctsc_form_text($field_name, $field_value, $current_field);
			
			elseif($field_type == 'textarea')
				$output .= ctsc_form_textarea($field_name, $field_value, $current_field);
			
			elseif($field_type == 'select')
				$output .= ctsc_form_select($field_name, $field_value, $current_field['option'], $current_field);
			
			elseif($field_type == 'checkbox')
				$output .= ctsc_form_checkbox($field_name, $field_value, $current_field);
			
			elseif($field_type == 'yesno')
				$output .= ctsc_form_yesno($field_name, $field_value, $current_field);
			
			elseif($field_type == 'color')
				$output .= ctsc_form_color($field_name, $field_value);
			
			elseif($field_type == 'imagelist')
				$output .= ctsc_form_imagelist($field_name, $field_value, $current_field['option'], $current_field);
				
			elseif($field_type == 'upload') 
				$output .= ctsc_form_upload($field_name, $field_value);
			
			elseif($field_type == 'font') 
				$output .= ctsc_form_font($field_name, $field_value, $current_field['option'], $current_field);
					
			//Separators
			if($field_type != 'divider'){
				$output .= '</div>';
				$output .= '<div class="field-desc">'.$field_desc.'</div>';
				$output .= '</div>';
			}
			unset($current_field);
		}
		
		$output .= '<input class="ctsc-submit button-primary" type="submit" name="ctsc_settings_save" value="'.__('Save Settings', 'ctsc').'" />';
		$output .= '</div>';
		echo $output;
	}
}

//Save all settings upon submitting the settings form
if(!function_exists('ctsc_custom_save')){
	function ctsc_custom_save($option_name, $option_fields){
		
		$lang_url = ctsc_custom_wpml_option_url();	
		$option_name = $option_name.ctsc_custom_wpml_option_suffix();
		if(isset($_POST['ctsc_custom_tab']) && $_POST['ctsc_custom_tab'] != '')
			$current_tab = '&tab='.htmlentities($_POST['ctsc_custom_tab']);
		else
			$current_tab = '';
			
		//Check if we're submitting a custom page
		if(isset($_POST['ctsc_custom_action']) && $_POST['ctsc_custom_action'] == $option_name){
			if(!wp_verify_nonce($_POST['_wpnonce'], 'ctsc_nonce')) header("Location: options-general.php?page=".$_GET['page'].$lang_url."&error");
			

			//Get the option array, then update the array values
			$options_list = get_option($option_name, false);
			foreach($option_fields as $current_option){
				$field_id = $current_option["id"];
					
				//If the field has an update, process it.
				if(isset($_POST[$field_id])){
					$field_value = '';
					$field_value = esc_attr(trim($_POST[$field_id]));

					$current_value = '';
					if(isset($options_list[$field_id]))
						$current_value = $options_list[$field_id];
					
					// Add option
					if($current_value == '' && $field_value != ''){
						$options_list[$field_id] = $field_value;
					}
					// Update option
					elseif($field_value != $current_value){
						$options_list[$field_id] = $field_value;
					}
					// Delete unused option
					elseif($field_value == ''){
						//TODO: Check default values
						$options_list[$field_id] = $field_value;
					}
				}
			}
			update_option($option_name, $options_list);
			
			header('Location: options-general.php?page='.$_GET['page'].$current_tab.$lang_url."&ok");
		}
	}
}


if(!function_exists('ctsc_custom_header')){
	function ctsc_custom_header(){
		$theme_data = wp_get_theme(); ?>
		<div class="ctsc-header">
			<div class="ctsc-badge">
				<?php //_e('Version', 'ctsc'); ?> 
				<?php echo $theme_data->get('Version'); ?>
			</div>
			
			<div class="ctsc-header-title" id="ctsc-header-title">
				<?php echo $theme_data->get('Name'); ?>
			</div>
			<div class="ctsc-header-meta">
				<a target="_blank" href="http://www.ctsc.com/support"><?php _e('Theme Documentation', 'ctsc'); ?></a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="http://themeforest.net/user/ctsc?ref=ctsc"><?php _e('More Themes', 'ctsc'); ?></a>
			</div>
			<!--<div class="ctsc-header-social">
				<div class="header-social-item">
					<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fmanuelvicedo.com&amp;width=120&amp;height=21&amp;colorscheme=light&amp;lang=en&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>
				</div>
				<div class="header-social-item">
					<iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.1379006964.html#_=1379511119899&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=manuelvicedo&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 160px; height:20px;" title="Follow On Twitter" data-twttr-rendered="true"></iframe>
				</div>
			</div>-->
		</div>
		
		<?php
	}
}

if(!function_exists('ctsc_custom_support')){
	function ctsc_custom_support(){
		$output = '';
		$output .= '<div class="ctsc-support">';
		$output .= '<a target="_blank" href="http://www.ctsc.com/documentation">'.__('Theme Documentation', 'ctsc').'</a>';
		$output .= '&nbsp;&nbsp;|&nbsp;&nbsp;';
		$output .= '<a target="_blank" href="http://www.ctsc.com/forums">'.__('Support Forum', 'ctsc').'</a>';
		$output .= '</div>';
		return $output;
	}
}


if(!function_exists('ctsc_custom_header_old')){
	function ctsc_custom_header_old(){
		$theme_data = wp_get_theme(); ?>
		<div class="ctsc-header">
			
			
			<div class="header-version">
				<div class="header-version-name">
					<?php _e('Theme Version', 'ctsc'); ?>
				</div>
				<div class="header-version-number">
					<?php echo $theme_data->get('Version'); ?>
				</div>
			</div>
			
			<div class="header-social">
				<div class="header-social-item">
					<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fctsc&amp;width=120&amp;height=21&amp;colorscheme=light&amp;lang=en&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe>
				</div>
				<div class="header-social-item">
					<iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.1379006964.html#_=1379511119899&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=ctsc&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 140px; height:20px;" title="Follow On Twitter" data-twttr-rendered="true"></iframe>
				</div>
			</div>
			
			<div class="header-title" id="cpo-header-title">
				<?php echo $theme_data->get('Name'); ?>
			</div>
			<div class="header-meta">
				<a target="_blank" href="http://www.ctsc.com/support"><?php _e('Theme Documentation', 'ctsc'); ?></a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="http://www.ctsc.com/forums"><?php _e('Support Forums', 'ctsc'); ?></a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a target="_blank" href="http://www.ctsc.com/themes"><?php _e('More Themes', 'ctsc'); ?></a>
			</div>
		</div>
		
		<?php
	}
}


//Installs options with default values, without overriding existing ones
if(!function_exists('ctsc_custom_install')){
	function ctsc_custom_install($option_name, $option_fields, $overwrite){
		
		$lang_url = ctsc_custom_wpml_option_url();	
		$option_name = $option_name.ctsc_custom_wpml_option_suffix();
				
		//Get the option array, then update the array values
		$options_list = get_option($option_name, false);
		foreach($option_fields as $current_option){
			if(isset($current_option['id'])){
				$field_id = $current_option['id'];
				
				//Check if there's no value already set
				//If overwrite is set, replace values always
				if(!isset($options_list[$field_id]) || $overwrite){
					//If there's no default defined, set an empty string
					if(isset($current_option['std']))
						$field_default = $current_option['std'];
					else
						$field_default = '';
								
					$options_list[$field_id] = $field_default;
				}
			}
		}
		update_option($option_name, $options_list);
	}
}

//Create navigation menu for settings page
if(!function_exists('ctsc_custom_wpml_nav')){
	function ctsc_custom_wpml_nav(){
		$output = '';
		if(ctsc_custom_wpml_active()){
			$language_list = ctsc_custom_wpml_languages();
			
			//Get current language
			if(isset($_GET['lang'])){
				$active_language = trim(htmlentities($_GET['lang']));
			}else{
				$active_language = ctsc_custom_wpml_default_language();
			}
			
			$output = '';
			$first_link = true;
			foreach($language_list as $current_language){
				$language_code = $current_language['code'];
				$language_name = $current_language['display_name'];
				$language_active = false;
				//Disable link for default language
				if($active_language == $language_code)
					$language_active = true;
				
				if(!$first_link)
					$output .= ' | ';
				
				if($language_active)
					$output .= '<span><b>';
				else
					$output .= '<a href="admin.php?page='.$_GET['page'].'&lang='.$language_code.'">';
				
				$output .= $language_name;
				if(ctsc_custom_wpml_default_language() == $language_code) 
					$output .= ' ('.__('default', 'ctsc').')';
				
				if($language_active)
					$output .= '</b></span>';
				else
					$output .= '</a>';
					
				$first_link = false;
			}
		return $output;
		}
	}
}
if(!function_exists('ctsc_custom_wpml_active')){	
	function ctsc_custom_wpml_active(){
		if(defined('ICL_LANGUAGE_CODE') && defined('ICL_SITEPRESS_VERSION'))
			return true;
		else
			return false;
	}
}

if(!function_exists('ctsc_custom_wpml_languages')){
	function ctsc_custom_wpml_languages(){
		if(ctsc_custom_wpml_active()){
			global $sitepress;
			return $sitepress->get_active_languages();
		}
	}
}

if(!function_exists('ctsc_custom_wpml_default_language')){
	function ctsc_custom_wpml_default_language(){
		if(ctsc_custom_wpml_active()){
			global $sitepress;
			return $sitepress->get_default_language();
		}
	}
}

if(!function_exists('ctsc_wpml_settings')){
	function ctsc_wpml_settings(){
		return get_option('icl_sitepress_settings');
	}
}

//Check if WPML is present and append language code to option array
//The default language should not be appended
if(!function_exists('ctsc_custom_wpml_option_suffix')){
	function ctsc_custom_wpml_option_suffix(){
		$language_code = '';
		if(ctsc_custom_wpml_active()){
			if(isset($_GET['lang']) && $_GET['lang'] != ''){
				$default_language = ctsc_custom_wpml_default_language();
				$active_language = trim(htmlentities($_GET['lang']));
				if($active_language != $default_language)
					$language_code = '_'.$active_language;
			}
		}
		return $language_code;
	}
}

//Return the language url for page redirections, empty if default language
if(!function_exists('ctsc_custom_wpml_option_url')){
	function ctsc_custom_wpml_option_url(){
		$lang_url = '';
		if(ctsc_custom_wpml_active()){
			if(isset($_GET['lang']) && $_GET['lang'] != ''){
				$default_language = ctsc_custom_wpml_default_language();
				$active_language = trim(htmlentities($_GET['lang']));
				if($active_language != $default_language)
					$lang_url = '&lang='.$active_language;
			}
		}
		return $lang_url;
	}
}