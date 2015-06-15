<?php 


/* ctsc-column Wrapper Shortcode - Alternate Markup */
if(!function_exists('ctsc_shortcode_columns')){
	function ctsc_shortcode_columns($atts, $content = null){
		$attributes = extract(shortcode_atts(array('number' => '2'), $atts));
		return '<div class="ctsc-columns ctsc-col'.$number.'">'.ctsc_do_shortcode($content).'<div class="ctsc-col-divide"></div></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'columns', 'ctsc_shortcode_columns');
}


/* Single ctsc-column Shortcode - Alternate Markup */
if(!function_exists('ctsc_shortcode_column_single')){
	function ctsc_shortcode_column_single($atts, $content = null){
		$content = $content;		
		return '<div class="ctsc-column">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column', 'ctsc_shortcode_column_single');
}


/* Half ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column2')){
	function ctsc_shortcode_column2($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col2'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_half', 'ctsc_shortcode_column2');
}

/* Half Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column2_last')){
	function ctsc_shortcode_column2_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col2 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_half_last', 'ctsc_shortcode_column2_last');
}



/* Third ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3')){
	function ctsc_shortcode_column3($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col3'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_third', 'ctsc_shortcode_column3');
}

/* Two-Thirds ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3x2')){
	function ctsc_shortcode_column3x2($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col3x2'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_two_thirds', 'ctsc_shortcode_column3x2');
}

/* Third Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3_last')){
	function ctsc_shortcode_column3_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col3 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_third_last', 'ctsc_shortcode_column3_last');
}

/* Two-Thirds Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column3x2_last')){
	function ctsc_shortcode_column3x2_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col3x2 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_two_thirds_last', 'ctsc_shortcode_column3x2_last');
}



/* Quarter ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4')){
	function ctsc_shortcode_column4($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col4'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_fourth', 'ctsc_shortcode_column4');
}

/* Three-Quarters ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4x3')){
	function ctsc_shortcode_column4x3($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col4x3'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_three_fourths', 'ctsc_shortcode_column4x3');
}

/* Quarter Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4_last')){
	function ctsc_shortcode_column4_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col4 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_fourth_last', 'ctsc_shortcode_column4_last');
}

/* Three-Quarters Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column4x3_last')){
	function ctsc_shortcode_column4x3_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col4x3 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_three_fourths_last', 'ctsc_shortcode_column4x3_last');
}



/* Fifth ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5')){
	function ctsc_shortcode_column5($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_fifth', 'ctsc_shortcode_column5');
}

/* Two-Fifths ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x2')){
	function ctsc_shortcode_column5x2($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5x2'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_two_fifths', 'ctsc_shortcode_column5x2');
}

/* Three-Fifths ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x3')){
	function ctsc_shortcode_column5x3($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5x3'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_three_fifths', 'ctsc_shortcode_column5x3');
}

/* Four-Fifths ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x4')){
	function ctsc_shortcode_column5x4($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5x4'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_four_fifths', 'ctsc_shortcode_column5x4');
}

/* Fifth Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5_last')){
	function ctsc_shortcode_column5_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div><div class="col-divide"></div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_fifth_last', 'ctsc_shortcode_column5_last');
}

/* Two-Fifths Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x2_last')){
	function ctsc_shortcode_column5x2_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5x2 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_two_fifths_last', 'ctsc_shortcode_column5x2_last');
}

/* Three-Fifths Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x3_last')){
	function ctsc_shortcode_column5x3_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5x3 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_three_fifths_last', 'ctsc_shortcode_column5x3_last');
}

/* Four-Fifths Last ctsc-column Shortcode */
if(!function_exists('ctsc_shortcode_column5x4_last')){
	function ctsc_shortcode_column5x4_last($atts, $content = null){
		$attributes = extract(shortcode_atts(array('style' => ''), $atts));
		$style = $style == '' ? '' : ' ctsc-column-'.$style;
		return '<div class="ctsc-column ctsc-col5x4 ctsc-col-last'.$style.'">'.ctsc_do_shortcode($content).'</div>';
	}
	add_shortcode(ctsc_shortcode_prefix().'column_four_fifths_last', 'ctsc_shortcode_column5x4_last');
}




/* Visual Composer Integration */
if(function_exists('vc_remove_param')){
	add_action('init', 'ctsc_shortcode_column_vc');
	function ctsc_shortcode_column_vc() {
		//REMOVE PARAMETERS
		vc_remove_param('vc_column', 'el_class');
		vc_remove_param('vc_column', 'css');
		/*vc_remove_param('vc_column', 'border_style');
		vc_remove_param('vc_column', 'font_color');
		vc_remove_param('vc_column', 'padding');
		vc_remove_param('vc_column', 'bg_image');
		vc_remove_param('vc_column', 'bg_image_repeat');
		vc_remove_param('vc_column', 'bg_color');
		vc_remove_param('vc_column', 'margin_bottom');*/
		
		//ROW PARAMETERS
		

		//Background
		vc_add_param('vc_column', array(
			'param_name' => 'bg_image',
			'type' => 'attach_image',
			'heading' => __('Background Image', 'ctsc'),
			'value' => '',
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'bg_color',
			'type' => 'colorpicker',
			'heading' => __('Background Color', 'ctsc'),
			'value' => '',
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'bg_style',
			'type' => 'dropdown',
			'heading' => __('Background Style', 'ctsc'),
			'value' => ctsc_metadata_background_styles(),
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'color',
			'type' => 'dropdown',
			'heading' => __('Text Color', 'ctsc'),
			'value' => ctsc_metadata_text_color(),
		));
		
		//Border
		vc_add_param('vc_column', array(
			'param_name' => 'border',
			'type' => 'textfield',
			'heading' => __('Border Width', 'ctsc'),
			'value' => '0',
			'group' => __('Border', 'ctsc'),
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'border_color',
			'type' => 'colorpicker',
			'heading' => __('Border Color', 'ctsc'),
			'value' => '',
			'group' => __('Border', 'ctsc'),
		));
		
		//Padding
		vc_add_param('vc_column', array(
			'param_name' => 'padding_top',
			'type' => 'textfield',
			'heading' => __('Top Padding', 'ctsc'),
			'value' => '',
			'group' => __('Layout', 'ctsc'),
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'padding_right',
			'type' => 'textfield',
			'heading' => __('Right Padding', 'ctsc'),
			'value' => '',
			'group' => __('Layout', 'ctsc'),
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'padding_bottom',
			'type' => 'textfield',
			'heading' => __('Bottom Padding', 'ctsc'),
			'value' => '',
			'group' => __('Layout', 'ctsc'),
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'padding_left',
			'type' => 'textfield',
			'heading' => __('Left Padding', 'ctsc'),
			'value' => '',
			'group' => __('Layout', 'ctsc'),
		));
		
		//Other
		vc_add_param('vc_column', array(
			'param_name' => 'id',
			'type' => 'textfield',
			'heading' => __('Element ID', 'ctsc'),
			'value' => '',
			'group' => __('Other', 'ctsc'),
		));
		
		vc_add_param('vc_column', array(
			'param_name' => 'class',
			'type' => 'textfield',
			'heading' => __('CSS Classes', 'ctsc'),
			'value' => '',
			'group' => __('Other', 'ctsc'),
		));
		
		/*vc_add_param('vc_column', array(
			'param_name' => 'animation',
			'type' => 'dropdown',
			'heading' => __('Entrance Animation', 'ctsc'),
			'value' => ctsc_metadata_animation(),
			'group' => __('Other', 'ctsc'),
		));*/
	}
}