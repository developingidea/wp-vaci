<?php


//Displays the blog title and descripion in home or frontpage
if(!function_exists('cpotheme_title')){
	//add_filter('wp_title', 'cpotheme_title');
	function cpotheme_title($title){
		global $page, $paged;
		
		if(is_feed()) return $title;
			
		$separator = ' | ';	
		$description = get_bloginfo('description', 'display');
		$name = get_bloginfo('name');
		
		//Homepage title
		if($description && (is_home() || is_front_page()))
			$full_title = $title.$separator.$description;
		else
			$full_title = $title;
			
		//Page numbers
		if($paged >= 2 || $page >= 2) 
			$full_title .= ' | '.sprintf( __('Page %s', 'cpocore'), max($paged, $page));
		
		return $title;
	}
}


//Displays the current page's title. Used in the main banner area.
if(!function_exists('cpotheme_page_title')){
	function cpotheme_page_title(){
		global $post;
		if(isset($post->ID)) $current_id = $post->ID; else $current_id = false;		
		$title_tag = function_exists('is_woocommerce') && is_woocommerce() && is_singular('product') ? 'span' : 'h1';
		
		echo '<'.$title_tag.' class="pagetitle-title heading">';
		if(function_exists('is_woocommerce') && is_woocommerce()){
			woocommerce_page_title();
		}elseif(is_category() || is_tag() || is_tax()){
			echo single_tag_title('', true);
		}elseif(is_author()){
			the_author();
		}elseif(is_date()){
			_e('Archive', 'cpocore');
		}elseif(is_404()){
			echo __('Page Not Found', 'cpocore');
		}elseif(is_search()){
			echo __('Search Results for', 'cpocore').' "'.get_search_query().'"';
		}else{
			echo get_the_title($current_id);
		}
		echo '</'.$title_tag.'>';
	}
}


//Displays the current page's title. Used in the main banner area.
if(!function_exists('cpotheme_header_image')){
	function cpotheme_header_image(){
		$url = apply_filters('cpotheme_header_image', get_header_image());
		if($url != '')
			return $url;
		else
			return false;
	}
}


//Displays a Revolution Slider assigned to the current page.
if(!function_exists('cpotheme_header_slider')){
	function cpotheme_header_slider(){
		if(function_exists('putRevSlider')){
			$current_id = cpotheme_current_id();
			if(is_tax() || is_category() || is_tag())
				$page_slider = cpotheme_tax_meta($current_id, 'page_slider');
			else
				$page_slider = get_post_meta($current_id, 'page_slider', true);
			
			if($page_slider != '0' && $page_slider != ''){
				echo '<div id="revslider" class="revslider">';
				putRevSlider($page_slider);
				echo '</div>';
			}
		}
	}
}


//Display custom favicon
if(!function_exists('cpotheme_favicon')){
	add_action('wp_head','cpotheme_favicon');
	function cpotheme_favicon(){
		$favicon_url = cpotheme_get_option('general_favicon');
		if($favicon_url != '')
			echo '<link type="image/x-icon" href="'.esc_url($favicon_url).'" rel="icon" />';
	}
}
	
	
//Add theme-specific body classes
add_filter('body_class', 'cpotheme_body_class');
function cpotheme_body_class($body_classes = ''){
	$current_id = cpotheme_current_id();
	$classes = '';
	
	//Sidebar Layout
	$classes .= ' sidebar-'.cpotheme_get_sidebar_position();
	
	//Full Width Pages
	if(is_404() || is_search())
		$page_full = 0;
	elseif(is_tax() || is_category() || is_tag())
		$page_full = cpotheme_tax_meta($current_id, 'page_full');
	else
		$page_full = get_post_meta($current_id, 'page_full', true);
		
	if($page_full == '1')
		$classes .= ' content-full';
	
	$body_classes[] = $classes;
	
	return $body_classes;
}


//Display viewport tag
if(!function_exists('cpotheme_viewport')){
	add_action('wp_head','cpotheme_viewport');
	function cpotheme_viewport(){
		$responsive_styles = get_template_directory_uri().'/style-responsive.css';
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>'."\n";
	}
}


//Print pingback metatag
if(!function_exists('cpotheme_pingback')){
	add_action('wp_head','cpotheme_pingback');
	function cpotheme_pingback(){
		if(get_option('default_ping_status') == 'open')
			echo '<link rel="pingback" href="'.get_bloginfo('pingback_url').'"/>'."\n";
	}
}


//Print charset metatag
if(!function_exists('cpotheme_charset')){
	add_action('wp_head','cpotheme_charset');
	function cpotheme_charset(){
		echo '<meta charset="'.get_bloginfo('charset').'"/>'."\n";
	}
}


//Display shortcut edit links for logged in users
if(!function_exists('cpotheme_edit')){
	function cpotheme_edit(){
		if(cpotheme_get_option('general_editlinks'))
			edit_post_link('<span class="icon-cog"></span> '.__('Edit', 'cpocore'));
	}
}


//Display the site's logo
if(!function_exists('cpotheme_logo')){
	function cpotheme_logo($width = 0, $height = 0){
		$output = '<div id="logo" class="logo">';
		if(cpotheme_get_option('general_texttitle') == 0){
			if(cpotheme_get_option('general_logo') == ''){
				if(defined('CPOTHEME_LOGO_WIDTH')) $width = CPOTHEME_LOGO_WIDTH;
				$output .= '<a class="site-logo" href="'.home_url().'"><img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('name').'" width="'.$width.'" height="'.$height.'"/></a>';
			}else{
				$logo_width = cpotheme_get_option('general_logo_width');
				if($logo_width != '') $logo_width = ' style="width:'.$logo_width.'px;"';
				$output .= '<a class="site-logo" href="'.home_url().'"><img src="'.cpotheme_get_option('general_logo').'" alt="'.get_bloginfo('name').'"'.$logo_width.'/></a>';
			}
		}
		
		$classes = '';
		if(cpotheme_get_option('general_texttitle') == 0) $classes = ' hidden';
		if(is_singular() && !is_front_page()){
			$output .= '<span class="title site-title'.$classes.'"><a href="'.home_url().'">'.get_bloginfo('name').'</a></span>';
		}else{
			$output .= '<h1 class="title site-title '.$classes.'"><a href="'.home_url().'">'.get_bloginfo('name').'</a></h1>';
		}
		
		$output .= '</div>';
		echo $output;
	}
}


//Display language switcher
if(!function_exists('cpotheme_languages')){
	function cpotheme_languages($display = false){
		if($display || cpotheme_get_option('layout_languages') == 1 && function_exists('icl_get_languages')):
			$output = '<div id="languages" class="languages">';
			$langs = icl_get_languages('skip_missing=0&orderby=code');
			
			//Print current active language
			foreach($langs as $current_lang): 
				if($current_lang['language_code'] == ICL_LANGUAGE_CODE):
					$output .= '<div class="language-active" id="language-active-'.$current_lang['language_code'].'">';
					$output .= '<img src="'.$current_lang['country_flag_url'].'" alt="'.$current_lang['language_code'].'"> ';
					$output .= $current_lang['native_name'];
					$output .= '</div>';
				endif; 
			endforeach;
			
			//Print full lagnguage list
			$output .= '<div class="language-list">';
			foreach($langs as $current_lang):
				$output .= '<a class="language-item" href="'.$current_lang['url'].'" id="language-switch-'.$current_lang['language_code'].'">';
				$output .= '<img src="'.$current_lang['country_flag_url'].'" alt="'.$current_lang['language_code'].'"> ';
				$output .= $current_lang['native_name'];
				$output .= '</a>';
			endforeach;
			$output .= '</div>';
			
			$output .= '</div>';
			echo $output;
		endif;
	}
}
	
	
//Display woocommerce cart
if(!function_exists('cpotheme_cart')){	
	function cpotheme_cart($display = false){
		if(($display || cpotheme_get_option('layout_cart') == 1) && function_exists('is_woocommerce')){
			global $woocommerce;
			$output = '<div id="shopping-cart" class="shopping-cart">';
			
			//Cart Summary
			$output .= '<div class="cart-title">';
			$output .= $woocommerce->cart->get_cart_total();		
			$output .= '</div>';		
			
			//Cart dropdown
			$output .= '<div class="cart_list cart-list">';
			$output .= '<div class="woocommerce widget_shopping_cart">';
			$output .= '<div class="widget_shopping_cart_content"></div>';
			$output .= '</div>';		
			$output .= '</div>';		
			$output .= '</div>';
			
			echo $output;
		}
	}
}
	
	
//Display social links
if(!function_exists('cpotheme_social_links')){
	function cpotheme_social_links(){
		echo '<div id="social" class="social">';
		$links = cpotheme_get_option('social_links');
		if(is_array($links)) 
		foreach($links as $current_link){
			if($current_link['url'] != ''){
				echo '<a class="social-profile" href="'.esc_url($current_link['url']).'" title="'.$current_link['name'].'" target="_blank">';
				if($current_link['icon'] != '') echo '<span class="social-icon">'.$current_link['icon'].'</span>';
				if($current_link['name'] != '') echo '<span class="social-title">'.$current_link['name'].'</span>';
				echo '</a>';
			}
		}
		echo '</div>';
	}
}


//Display social links - old and deprecated
if(!function_exists('cpotheme_social')){
	function cpotheme_social(){
		$output = '<div id="social" class="social social-old">';
		$output .= cpotheme_social_item(cpotheme_get_option('social_facebook'), 'Facebook', 'facebook');
		$output .= cpotheme_social_item(cpotheme_get_option('social_twitter'), 'Twitter', 'twitter');
		$output .= cpotheme_social_item(cpotheme_get_option('social_gplus'), 'Google Plus', 'google-plus');
		$output .= cpotheme_social_item(cpotheme_get_option('social_youtube'), 'YouTube', 'youtube');
		$output .= cpotheme_social_item(cpotheme_get_option('social_linkedin'), 'LinkedIn', 'linkedin');
		$output .= cpotheme_social_item(cpotheme_get_option('social_pinterest'), 'Pinterest', 'pinterest');
		$output .= cpotheme_social_item(cpotheme_get_option('social_foursquare'), 'Foursquare', 'foursquare');
		$output .= cpotheme_social_item(cpotheme_get_option('social_tumblr'), 'Tumblr', 'tumblr');
		$output .= cpotheme_social_item(cpotheme_get_option('social_flickr'), 'Flickr', 'flickr');
		$output .= cpotheme_social_item(cpotheme_get_option('social_instagram'), 'Instagram', 'instagram');
		$output .= cpotheme_social_item(cpotheme_get_option('social_dribbble'), 'Dribbble', 'dribbble');
		$output .= cpotheme_social_item(cpotheme_get_option('social_skype'), 'Skype', 'skype');
		$output .= '</div>';
		echo $output;
	}
}

if(!function_exists('cpotheme_social_item')){	
	function cpotheme_social_item($url, $title = '', $name = ''){
		if($url != ''):
			$output = '<a class="social-profile social-profile-'.$name.'" href="'.$url.'" title="'.$title.'" target="_blank">';
			if($name != '') $output .= '<span class="social-icon"></span>';
			if($title != '') $output .= '<span class="social-title">'.$title.'</span>';
			$output .= '</a>';
			return $output;
		endif;
	}
}


//Prints speed, timeout and effect values for the homepage slider
if(!function_exists('cpotheme_slider_data')){	
	function cpotheme_slider_data($navigation = true, $pagination = true){ 
		$output = '';
		$output .= ' data-cycle-pause-on-hover="true"';
		$output .= ' data-cycle-slides=".slide"';
		
		if($navigation){
			$output .= ' data-cycle-prev=".slider-prev"';
			$output .= ' data-cycle-next=".slider-next"';
		}
		
		if($pagination){
			$output .= ' data-cycle-pager=".slider-pages"';
		}
		
		$slider_timeout = (int)cpotheme_get_option('slider_timeout');
		if($slider_timeout == '') $slider_timeout = '8000';
		$output .= ' data-cycle-timeout="'.$slider_timeout.'"';
		
		$slider_speed = (int)cpotheme_get_option('slider_speed');
		if($slider_speed == '') $slider_speed = '2000';
		$output .= ' data-cycle-speed="'.$slider_speed.'"';
		
		$slider_effect = (int)cpotheme_get_option('slider_effect');
		if($slider_effect == '') $slider_effect = 'fade';
		$output .= ' data-cycle-fx="'.$slider_effect.'"';
		
		echo $output;
	}
}


//Print an option content
if(!function_exists('cpotheme_block')){
	function cpotheme_block($option, $wrapper = '', $subwrapper = ''){
		$content = cpotheme_get_option($option);
		if($content != ''){
			if($wrapper != '') echo '<div id="'.$wrapper.'" class="'.$wrapper.'">';
			if($subwrapper != '') echo '<div class="'.$subwrapper.'">';
			echo do_shortcode(stripslashes(html_entity_decode(cpotheme_get_option($option))));
			if($subwrapper != '') echo '</div>';
			if($wrapper != '') echo '</div>';
		}
	}
}


//Print subfooter sidebars
if(!function_exists('cpotheme_subfooter')){
	function cpotheme_subfooter(){		
		$footer_columns = cpotheme_get_option('layout_subfooter_columns');
		if($footer_columns == '') $footer_columns = 3;
		for($count = 1; $count <= $footer_columns; $count++){ 
			if(is_active_sidebar('footer-widgets-'.$count)){ 
				$footer_last = $count == $footer_columns ? ' col-last' : '';
				echo '<div class="column col'.$footer_columns.$footer_last.'">';
				dynamic_sidebar('footer-widgets-'.$count); 
				echo '</div>';
			} 
		}
		echo '<div class="clear"></div>';
	}
}


//Print footer copyright line
if(!function_exists('cpotheme_footer')){
	function cpotheme_footer(){		
		echo '<div class="footer-content">';
		if(cpotheme_get_option('footer_text') != ''){
			echo do_shortcode(stripslashes(html_entity_decode(cpotheme_get_option('footer_text'))));
		}else{
			echo '&copy; '.get_bloginfo('name').' '.date("Y").'. '; 
			if(cpotheme_get_option('general_credit') == 1){
				printf(__('Theme designed by <a href="%s">CPOThemes</a>.', 'cpocore'), 'http://www.cpothemes.com'); 
			}
		}
		echo '</div>';
	}
}


//Print submenu navigation
if(!function_exists('cpotheme_submenu')){
	function cpotheme_submenu(){		
		$ancestors = array_reverse(get_post_ancestors(get_the_ID()));
		if(empty($ancestors[0]) || $ancestors[0] == 0) $ancestors[0] = get_the_ID();
		echo '<ul id="submenu" class="menu-sub">';
		wp_list_pages(apply_filters('cpotheme_submenu_query', "title_li=&child_of=".$ancestors[0]));
		echo '</ul>';
	}
}


//Print submenu navigation
if(!function_exists('cpotheme_sitemap')){
	function cpotheme_sitemap(){		
		//Print page list
		echo '<div class="column col2">';
		echo '<h3>'.__('Pages', 'cpocore').'</h3>';
		echo '<ul>'.wp_list_pages('sort_column=menu_order&title_li=&echo=0').'</ul>';
		echo '</div>';
		
		//Print post categories and tag cloud
		echo '<div class="column col2 col-last">';
		echo '<h3>'.__('Post Categories', 'cpocore').'</h3>';
		echo '<ul>'.wp_list_categories('title_li=&show_count=1&echo=0').'</ul>';
		echo '<h3>'.__('Post Tags', 'cpocore').'</h3>';
		echo '<ul>'.wp_tag_cloud('echo=0').'</ul>';
		echo '</div>';
		
		echo '<div class="clear"></div>';
	}
}


//Enqueue custom font stylesheets from Google Fonts
if(!function_exists('cpotheme_fonts')){
	function cpotheme_fonts($font_name, $load_variants = false){
		$font_variants = $load_variants != false ? ':100,300,400,700' : '';
		if(is_array($font_name)){
			foreach($font_name as $current_font)
				if(!in_array($current_font, array('Arial', 'Georgia', 'Times+New+Roman', 'Verdana'))){
					$font_id = 'cpotheme-font-'.strtolower(str_replace('+', '-', $current_font));
					wp_enqueue_style($font_id, '//fonts.googleapis.com/css?family='.$current_font.$font_variants);
				}
		}else{
			if(!in_array($font_name, array('Arial', 'Georgia', 'Times+New+Roman', 'Verdana'))){
				$font_id = 'cpotheme-font-'.strtolower(str_replace('+', '-', $font_name));
				wp_enqueue_style($font_id, '//fonts.googleapis.com/css?family='.$font_name.$font_variants);
			}
		}
	}
}
	
//Adds custom analytics code in the footer
if(!function_exists('cpotheme_layout_analytics')){
	add_action('wp_footer','cpotheme_layout_analytics');
	function cpotheme_layout_analytics(){
		$output = stripslashes(html_entity_decode(cpotheme_get_option('general_analytics'), ENT_QUOTES));
		//$output = stripslashes($output);
		echo $output;
	}
}

//Adds custom css code in the footer
if(!function_exists('cpotheme_layout_css')){
	add_action('wp_head','cpotheme_layout_css', 25);
	function cpotheme_layout_css(){
		$output = cpotheme_get_option('general_css');
		if($output != ''){
			$output = '<style type="text/css">'.stripslashes(html_entity_decode($output)).'</style>';
			echo $output;
		}
	}
}

//Retireve sidebar position (DEPRECATED)
if(!function_exists('cpotheme_sidebar_position')){
	function cpotheme_sidebar_position(){
		$sidebar_position = cpotheme_get_option('sidebar_position');
		if($sidebar_position == 'left')
			echo 'content-right';
		elseif($sidebar_position == 'none')
			echo 'content-wide';
	}
}

// Generates breadcrumb navigation
if(!function_exists('cpotheme_breadcrumb')){
	function cpotheme_breadcrumb($display = false){
		if(!is_home() && !is_front_page() && ($display || cpotheme_get_option('layout_breadcrumbs'))){
			//Use WooCommerce navigation if it's a shop page
			if(function_exists('is_woocommerce') && function_exists('woocommerce_breadcrumb') && is_woocommerce()){
				woocommerce_breadcrumb();
				return;
			}
			
			$result = '';
			if(function_exists('yoast_breadcrumb')){
				$result = yoast_breadcrumb('','', false);
			}
			
			if($result == ''){
				global $post;
				if(is_object($post)) $pid = $post->ID; else $pid = '';
				$result = '';
				
				if($pid != ''){
					$result = "<span class='breadcrumb-separator'></span>";
					//Add post hierarchy
					if(is_singular()):
						$post_data = get_post($pid);
						$result .= "<span class='breadcrumb-title'>".apply_filters('the_title', $post_data->post_title)."</span>\n";
						//Add post hierarchy
						while($post_data->post_parent):
							$post_data = get_post($post_data->post_parent);
							$result = "<span class='breadcrumb-separator'></span><a class='breadcrumb-link' href='".get_permalink($post_data->ID)."'>".apply_filters('the_title', $post_data->post_title)."</a>\n".$result;
						endwhile;
						
					elseif(is_tax()):
						$result .= single_tag_title('', false);
						
					elseif(is_author()):
						$author = get_userdata(get_query_var('author'));
						$result .= $author->display_name;
						
					//Prefix with a taxonomy if possible
					elseif(is_category()):					
						$post_data = get_the_category($pid);
						if(isset($post_data[0])):
							$data = get_category_parents($post_data[0]->cat_ID, TRUE, ' &raquo; ');
							if(!is_object($data)):
								$result .= substr($data, 0, -8);
							endif;
						endif;
						
					elseif(is_search()):					
						$result .= __('Search Results', 'cpocore');
					else:
						if(isset($post->ID)) $current_id = $post->ID; else $current_id = false;
						if($current_id){
							$result .= get_the_title($current_id);
						}
					endif;
				}elseif(is_404()){
					$result = "<span class='breadcrumb-separator'></span>";
					$result .= __('Page Not Found', 'cpocore');
				}
				$result = '<a class="breadcrumb-link" href="'.home_url().'">'.__('Home', 'cpocore').'</a>'.$result;
			}
			
			$output = '<div id="breadcrumb" class="breadcrumb">'.$result.'</div>';
			echo $output;
		}
	}
}

//Displays the post date
if(!function_exists('cpotheme_postpage_date')){
	function cpotheme_postpage_date($display = false, $date_format = '', $format_text =''){
		if($display || cpotheme_get_option('postpage_dates') != 0){
			if($date_format != '') {
				$date_string = get_the_date($date_format);
			}
			else{
				$date_format = get_option('date_format');
				$date_string = get_the_date($date_format);
			}
			if($format_text != '') $date_string = sprintf($format_text, $date_string);
			echo '<div class="post-date">'.$date_string.'</div>';
		}
	}
}
	
//Displays the author link
if(!function_exists('cpotheme_postpage_author')){
	function cpotheme_postpage_author($display = false, $format_text =''){
		if($display || cpotheme_get_option('postpage_authors') != 0){
			$author_alt = sprintf(esc_attr__('View all posts by %s', 'cpocore'), get_the_author());
			$author = sprintf('<a href="%1$s" title="%2$s">%3$s</a>', get_author_posts_url(get_the_author_meta('ID')), $author_alt,get_the_author());
			if($format_text != ''){
				$author = sprintf($format_text, $author);
			}
			echo '<div class="post-author">'.$author.'</div>';
		}
	}
}

//Displays the category list for the current post
if(!function_exists('cpotheme_postpage_categories')){
	function cpotheme_postpage_categories($display = false, $format_text =''){
		if($display || cpotheme_get_option('postpage_categories') != 0){
			$category_list = get_the_category_list(', ');
			if($format_text != ''){
				$category_list = sprintf($format_text, $category_list);
			}
			echo '<div class="post-category">'.$category_list.'</div>';
		}
	}
}

//Displays the number of comments for the post
if(!function_exists('cpotheme_postpage_comments')){
	function cpotheme_postpage_comments($display = false, $format_text = ''){
		if($display || cpotheme_get_option('postpage_comments') != 0){
			$comments_num = get_comments_number();
			
			//Format comment texts
			if($format_text != ''){
				$text = $format_text;
			}else{
				if($comments_num == 0)
					$text = __('No Comments', 'cpocore');
				elseif($comments_num == 1)
					$text = __('One Comment', 'cpocore');
				else
					$text = __('%1$s Comments', 'cpocore');
			}
			
			$comments = sprintf($text, number_format_i18n($comments_num));
			echo '<div class="post-comments">'.sprintf('<a href="%1$s">%2$s</a>', get_permalink(get_the_ID()).'#comments', $comments).'</div>';	
		}
	}
}

//Displays the post tags
if(!function_exists('cpotheme_postpage_tags')){
	function cpotheme_postpage_tags($display = false, $before = '', $separator = ', ', $after = ''){
		if($display || cpotheme_get_option('postpage_tags') != 0){
			echo '<div class="post-tags">';
			the_tags($before, $separator, $after);
			echo '</div>';
		}
	}
}

//Display Read More link for post excerpts
if(!function_exists('cpotheme_postpage_readmore')){
	function cpotheme_postpage_readmore($classes = ''){
		return '<a class="post-readmore '.$classes.'" href="'.get_permalink(get_the_ID()).'">'.apply_filters('cpotheme_readmore', __('Read More', 'cpotheme')).'</a>';
	}
}

//Displays the author link
if(!function_exists('cpotheme_author_links')){
	function cpotheme_author_links(){
		echo '<div class="author-social">';
		$user_meta = get_the_author_meta('user_url'); 
		if($user_meta != '')
			echo '<a target="_blank" rel="nofollow" class="author-web" href="'.$user_meta.'">'.__('Website', 'cpocore').'</a>';
		$user_meta = get_the_author_meta('facebook'); 
		if($user_meta != '')
			echo '<a target="_blank" rel="nofollow" class="author-facebook" href="'.$user_meta.'">'.__('Facebook', 'cpocore').'</a>';
		$user_meta = get_the_author_meta('twitter'); 
		if($user_meta != '')
			echo '<a target="_blank" rel="nofollow" class="author-twitter" href="//twitter.com/'.$user_meta.'">'.__('Twitter', 'cpocore').'</a>';
		$user_meta = get_the_author_meta('googleplus'); 
		if($user_meta != '')
			echo '<a target="_blank" rel="nofollow" class="author-googleplus" href="'.$user_meta.'">'.__('Google+', 'cpocore').'</a>';
		echo '</div>';
	}
}

//Displays visual media of a particular post
if(!function_exists('cpotheme_post_media')){
	function cpotheme_post_media($post_id, $media_type, $video = '', $options = null){
		$args = array(
		'post_type' => 'attachment',
		'posts_per_page' => -1,
		'post_status' => null,
		'post_mime_type' => 'image',
		'exclude' => get_post_thumbnail_id(),
		'post_parent' => $post_id);
		
		switch($media_type){
			case 'none': break;
			case 'image': the_post_thumbnail(); break;
			case 'slideshow': cpotheme_post_slideshow($args); break;
			case 'gallery': cpotheme_post_gallery($args, 3); break;
			case 'video': cpotheme_post_video($video); break;
			default: the_post_thumbnail(); break;
		}
	}
}


//Displays a slideshow of the given query
if(!function_exists('cpotheme_post_slideshow')){
	function cpotheme_post_slideshow($args, $options = null){
		$attachments = get_posts($args);
		$image_size = isset($options['size']) ? $options['size'] : 'large';
		$thumb_count = 0;
		if($attachments){ ?>
		<div class="slideshow">
			<div class="slideshow-slides cycle-slideshow" data-cycle-slides=".slideshow-slide" data-cycle-prev=".slideshow-prev" data-cycle-next=".slideshow-next" data-cycle-pager=".slideshow-pages" data-cycle-timeout="5000" data-cycle-speed="1000" data-cycle-fx="fade">
				<?php wp_enqueue_script('cpotheme_cycle'); ?>
				<?php foreach($attachments as $attachment): $thumb_count++; ?>
				<div class="slideshow-slide" <?php if($thumb_count != 1) echo 'style="display:none;"'; ?>>
					<?php $image_url = wp_get_attachment_image_src($attachment->ID, $image_size); ?>
					<?php $full_image_url = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
					<a href="<?php echo $full_image_url[0]; ?>" rel="gallery[slideshow]">
						<img src="<?php echo $image_url[0]; ?>" alt="<?php echo $attachment->post_excerpt; ?>" class="aligncenter"/>
					</a>
					<?php if($attachment->post_excerpt != ''): ?>
					<div class="slide-content content"><?php echo $attachment->post_excerpt; ?></div>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="slideshow-prev"></div>
			<div class="slideshow-next"></div>
			<div class="slideshow-pages"></div>
		</div>
		<?php }
	}
}

//Displays a gallery of the given query
if(!function_exists('cpotheme_post_gallery')){
	function cpotheme_post_gallery($args, $columns = 3, $size = 'portfolio'){
		$attachments = get_posts($args);
		$feature_count = 0;
		if($attachments){ ?>
		<div class="image-gallery">
			<?php foreach($attachments as $attachment): ?>
			<?php if($feature_count % $columns == 0 && $feature_count != 0) echo '<div class="col-divide"></div>'; ?>
			<?php $feature_count++; ?>
			<div class="column col<?php echo $columns; if($feature_count % $columns == 0 && $feature_count != 0) echo ' col-last'; ?>">
				<?php if($attachment->post_excerpt != ''): ?>
				<div class="content"><?php echo $attachment->post_excerpt; ?></div>
				<?php endif; ?>
				<?php $source = wp_get_attachment_image_src($attachment->ID, $size); ?>
				<?php $original_source = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
				<a href="<?php echo $original_source[0]; ?>" rel="gallery[portfolio]">
					<img src="<?php echo $source[0]; ?>"/>
				</a>
			</div>
			<?php endforeach; ?>
			<div class="clear"></div>
		</div>
		<?php }
	}
}

//Displays a video of the given query
if(!function_exists('cpotheme_post_video')){
	function cpotheme_post_video($video_url, $image_url = ''){
		if($video_url != ''){ ?>
		<div class="video">
			<?php echo wp_oembed_get($video_url); ?>
		</div>
		<?php }
	}
}


//Paginates a single post's content by using a numbered list
if(!function_exists('cpotheme_pagination')){
	function cpotheme_pagination(){
		$query = $GLOBALS['wp_query'];
		$current_page = max(1, absint($query->get('paged')));
		$total_pages = max(1, absint($query->max_num_pages));
		if($total_pages == 1) return;

		$pages_to_show = 8;
		$larger_page_to_show = 10;
		$larger_page_multiple = 2;
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor( $pages_to_show_minus_1/2 );
		$half_page_end = ceil( $pages_to_show_minus_1/2 );
		$start_page = $current_page - $half_page_start;

		$end_page = $current_page + $half_page_end;
		
		if(($end_page - $start_page) != $pages_to_show_minus_1)
			$end_page = $start_page + $pages_to_show_minus_1;

		if($end_page > $total_pages){
			$start_page = $total_pages - $pages_to_show_minus_1;
			$end_page = $total_pages;
		}

		if($start_page < 1)
			$start_page = 1;

		$out = '';

		//First Page Link
		if(1 == $current_page)
			$out .= '<span class="first_page">'.__('First', 'cpocore').'</span>';
		else
			$out .= '<a class="pagination-page page first_page" href="'.esc_url(get_pagenum_link(1)).'">'.__('First', 'cpocore').'</a>';

		//Show each page
		foreach(range($start_page, $end_page) as $i){
			if($i == $current_page)
				$out .= "<span>$i</span>";
			else
				$out .= '<a class="pagination-page page" href="'.esc_url(get_pagenum_link($i)).'">'.$i.'</a>';
		}
		
		//Last Page Link
		if($total_pages == $current_page)
			$out .= '<span class="last_page">'.__('Last', 'cpocore').'</span>';
		else
			$out .= '<a class="pagination-page page last_page" href="'.esc_url(get_pagenum_link($total_pages)).'">'.__('Last', 'cpocore').'</a>';
		
		$out = '<div id="pagination" class="pagination">'.$out.'</div>';

		echo $out;
	}
}


//Paginates a list of posts, such as the blog or portfolio
if(!function_exists('cpotheme_numbered_pagination')){
	function cpotheme_numbered_pagination($query = ''){
		global $wp_query;
		if($query != '')
			$total_pages = $query->max_num_pages;
		else
			$total_pages = $wp_query->max_num_pages;
		if($total_pages > 1){
			echo '<div class="pagination">';
			if(!$current_page = get_query_var('paged'))
				$current_page = 1;
			if(get_option('permalink_structure')){
				$link_format = 'page/%#%/';
			}else{
				$link_format = '&paged=%#%';
			}
			echo paginate_links(array(
			'base' => str_replace(999999, '%#%', esc_url(get_pagenum_link(999999))),
			'current' => max(1, get_query_var('paged')),
			'total' => $total_pages,
			'format' => $link_format,
			'mid_size' => 4,
			'type' => 'list',
			'prev_next'	=> false
			));
			echo '</div>';
		}
	}
}


//Paginates a single post by using a numbered list
if(!function_exists('cpotheme_post_pagination')){
	function cpotheme_post_pagination(){
		wp_link_pages(array('before' => '<div class="postpagination">', 'after' => '</div>', 'pagelink' => '<span>%</span>', 'separator' => ''));
	}
}


//Prints the main navigation menu
if(!function_exists('cpotheme_menu')){
	function cpotheme_menu($options = null){
		if(has_nav_menu('main_menu')){
			if(isset($options['toggle']) && $options['toggle'] == true) cpotheme_menu_toggle();
			wp_nav_menu(array('menu_id' => 'menu-main', 'menu_class' => 'menu-main nav_main', 'theme_location' => 'main_menu', 'depth' => '4', 'container' => false, 'walker' => new Cpotheme_Menu_Walker()));
		}
	}
}


//Prints the mobile navigation menu
if(!function_exists('cpotheme_mobile_menu')){
	add_action('wp_footer', 'cpotheme_mobile_menu');
	function cpotheme_mobile_menu($options = null){
		if(has_nav_menu('main_menu')){
			echo '<div id="menu-mobile-close" class="menu-mobile-close menu-mobile-toggle"></div>';
			wp_nav_menu(array('menu_id' => 'menu-mobile', 'menu_class' => 'menu-mobile', 'theme_location' => 'main_menu', 'depth' => '4', 'container' => false, 'walker' => new Cpotheme_Menu_Walker()));
		}
	}
}


//Prints the main navigation menu
if(!function_exists('cpotheme_menu_toggle')){
	function cpotheme_menu_toggle(){
		if(has_nav_menu('main_menu'))
			echo '<div id="menu-mobile-open" class=" menu-mobile-open menu-mobile-toggle"></div>';
	}
}

//Prints the footer navigation menu
if(!function_exists('cpotheme_top_menu')){
	function cpotheme_top_menu(){
		if(has_nav_menu('top_menu')){
			echo '<div id="topmenu" class="topmenu">';
			wp_nav_menu(array('menu_class' => 'menu-top', 'theme_location' => 'top_menu', 'depth' => 1, 'fallback_cb' => null));
			echo '</div>';
		}
	}
}

//Prints the footer navigation menu
if(!function_exists('cpotheme_footer_menu')){
	function cpotheme_footer_menu(){
		if(has_nav_menu('footer_menu')){
			echo '<div id="footermenu" class="footermenu">';
			wp_nav_menu(array('menu_class' => 'menu-footer', 'theme_location' => 'footer_menu', 'depth' => '2', 'fallback_cb' => false));
			echo '</div>';
		}
	}
}

//Displays a dropdown list of the main menu items
if(!function_exists('cpotheme_mobile_menu')){
	function cpotheme_mobile_menu(){
		if(has_nav_menu('main_menu')){
			//Get all custom menus, then retrieve the one set to the main menu
			$menu_locations = get_nav_menu_locations();
			$menu_object = wp_get_nav_menu_object($menu_locations['main_menu']);
			
			if($menu_object){
				$menu_items = wp_get_nav_menu_items($menu_object->term_id);
				$current_parent = array();
				$current_level = 0;
				$last_id = 'root';
				$output = '';
				$output .= '<select id="menu-mobile" class="menu-mobile">';
				$output .= '<option value="#">'.__('Go To...', 'cpocore').'</option>';
				foreach($menu_items as $current_item){
					$item_title = '';
					//Go down a level
					if($current_item->menu_item_parent == $last_id){
						$current_level++;
						array_push($current_parent, $last_id);
					//Go back up a level, check if going up more than once
					}elseif($current_level > 0 && $current_item->menu_item_parent != end($current_parent)){
						while($current_item->menu_item_parent != end($current_parent) && $current_level > 0){
							$current_level--;
							array_pop($current_parent);
						}
					}
					
					$item_title .= str_repeat('-', $current_level).' ';
					$item_title .= $current_item->title;
					$item_url = $current_item->url;
					$last_id = $current_item->ID;
					$output .= '<option value="'.$item_url.'">'.$item_title.'</option>';
				}
				$output .= '</select>';
				echo $output;
			}
		}else{
			//Default page list
			$args = array('sort_column' => 'menu_order');
			$menu_items = get_pages($args);
			$current_parent = array();
			$current_level = 0;
			$last_id = -1;
			
			$output = '';
			$output .= '<select id="menu-mobile" class="menu-mobile">';
			$output .= '<option value="#">'.__('Go To...', 'cpocore').'</option>';
			foreach($menu_items as $current_item){
				$item_title = '';
				//Go down a level
				if($current_item->post_parent == $last_id){
					$current_level++;
					array_push($current_parent, $last_id);
				//Go back up a level, check if going up more than once
				}elseif($current_level > 0 && $current_item->post_parent != end($current_parent)){
					while($current_item->post_parent != end($current_parent)){
						$current_level--;
						array_pop($current_parent);
					}
				}
				
				$item_title .= str_repeat('-', $current_level).' ';
				$item_title .= $current_item->post_title;
				$item_url = get_permalink($current_item->ID);
				$last_id = $current_item->ID;
				$output .= '<option value="'.$item_url.'">'.$item_title.'</option>';
			}
			$output .= '<select>';
			echo $output;
		}
	}
}



//Print comment markup
if(!function_exists('cpotheme_comment')){
	function cpotheme_comment($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		
		//Normal Comments
		switch($comment->comment_type): case '': ?>
		<li class="comment" id="comment-<?php comment_ID(); ?>">
			<div class="comment-avatar">
				<?php echo get_avatar($comment, 50); ?>
			</div>
			<div class="comment-title">
				<div class="comment-options secondary-color-bg">
					<?php edit_comment_link(__('Edit', 'cpocore')); ?>
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
				<div class="comment-author">
					<?php echo get_comment_author_link(); ?>
				</div>
				<div class="comment-date">
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
						<?php printf(__('%1$s at %2$s', 'cpocore'), get_comment_date(),  get_comment_time()); ?>
					</a>
				</div>
			</div>
			
			<div class="comment-content">    
				<?php if($comment->comment_approved == '0'): ?>
					<span class="comment-approval"><?php _e('Your comment is awaiting approval.', 'cpocore'); ?></span>
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>
		<?php break;
		
		//Pingbacks & Trackbacks
		case 'pingback': case 'trackback': ?>
		<li class="pingback">
			<?php comment_author_link(); ?>
			<?php edit_comment_link(__('Edit', 'cpocore'), ' (', ')'); ?>
		<?php break;
		endswitch;
	}
}