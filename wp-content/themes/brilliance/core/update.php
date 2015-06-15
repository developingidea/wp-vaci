<?php

//Theme licenses
if(!function_exists('cpotheme_license_setup')){
	add_action('admin_init', 'cpotheme_license_setup');
	function cpotheme_license_setup(){
		$license = trim(cpotheme_get_option('license_'.CPOTHEME_ID));
		$updater = new CPOTheme_Core_Updater(array(
			'remote_api_url'=> CPOCORE_STORE,
			'author'	=> CPOCORE_AUTHOR,
			'version' => CPOTHEME_VERSION,
			'item_name' => CPOTHEME_NAME,
			'license' => $license,
			'url' => home_url())
		);
	}
}


//Manage license activation
if(!function_exists('cpotheme_license_activate')){
	function cpotheme_license_activate($option_name){
		if(isset($_POST['cpotheme_custom_action']) && $_POST['cpotheme_custom_action'] == $option_name){
			//if(!wp_verify_nonce($_POST['_wpnonce'], 'cpotheme_nonce')) return;
			
			$license_field_name = 'license_'.CPOTHEME_ID;
			
			//Check if license field is submitted, and is different than current one
			if(isset($_POST[$license_field_name])){
				$license_status = trim(cpotheme_get_option($license_field_name.'_status', 'cpotheme_settings', false));
				$current_license = trim(cpotheme_get_option($license_field_name, 'cpotheme_settings', false));
				$new_license = esc_attr(trim($_POST[$license_field_name]));
				
				//Check license if not currently active, or if not empty and different from current one
				if($license_status != 'valid' || ($new_license != '' && $new_license != $current_license)){
					$args = array(
					'edd_action' => 'activate_license', 
					'license' => $new_license, 
					'item_name' => urlencode(CPOTHEME_NAME));
					$response = wp_remote_get(add_query_arg($args, CPOCORE_STORE), array('timeout' => 15, 'sslverify' => false));

					if(is_wp_error($response)) return false;

					$license_data = json_decode(wp_remote_retrieve_body($response));
					
					cpotheme_update_option('license_'.CPOTHEME_ID.'_status', $license_data->license);
				}
			}
		}
	}
}


//Manage license activation
if(!function_exists('cpotheme_license_notice')){
	add_action('admin_notices', 'cpotheme_license_notice');
	function cpotheme_license_notice(){
		$current_license_dismissed = trim(cpotheme_get_option(CPOTHEME_ID.'_license', 'cpotheme_settings', false));
		
		//If notice hasn't been explicitly dismissed, display it
		if(current_user_can('manage_options') && $current_license_dismissed != 'dismissed'){
			$current_license_status = trim(cpotheme_get_option('license_'.CPOTHEME_ID.'_status', 'cpotheme_settings', false));
			$current_license = trim(cpotheme_get_option('license_'.CPOTHEME_ID, 'cpotheme_settings', false));

			if($current_license_status != 'valid'){
				$core_path = defined('CPO_CORELITE_URL') ? CPO_CORELITE_URL : get_template_directory_uri().'/core/';
				echo '<div id="message" class="updated">';
				echo '<div class="cpotheme-notice">';
				echo '<img class="cpotheme-wizard-image" src="'.$core_path.'images/ct-icon.png">';
				echo '<a href="'.add_query_arg('ctdismiss', CPOTHEME_ID.'_license').'" class="cpothemes-notice-dismiss">'.__('Dismiss This Notice', 'cpocore').'</a>';
				if($current_license_status == 'invalid' && $current_license != ''){
					echo '<span style="color:red;">';
					echo __('The theme license you entered is invalid!', 'cpocore');
					echo '<br></span>';
				}
				echo __('Please add your CPOThemes license key in order to get automatic theme updates from your dashboard.', 'cpocore');
				echo '<br>';
				echo '<b><a href="themes.php?page=cpotheme_settings">'.__('Enter License Key', 'cpocore').'</a></b>';
				echo ' | ';
				echo '<a target="_blank" href="http://www.cpothemes.com/dashboard/purchase-history">'.__('Obtain the license key at CPOThemes', 'cpocore').'</a>';
				
				echo '<div class="cpotheme-wizard-clear"></div>';
				echo '</div>';
				echo '</div>';
			}
		}
	}
}