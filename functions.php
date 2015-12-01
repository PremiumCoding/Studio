<?php


add_action('init', 'js_inc_function');
add_theme_support( 'post-formats', array( 'link', 'gallery', 'video' , 'audio') );
add_theme_support( 'automatic-feed-links' );
require( get_template_directory() . '/updater/theme-updater.php' );


function pmc_dont_update_theme( $r, $url ) {
 if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) )
   return $r; // Not a theme update request. Bail immediately.
  $themes = json_decode( $r['body']['themes'] );
  $child = get_option( 'stylesheet' );
 unset( $themes->themes->$child );
  $r['body']['themes'] = json_encode( $themes );
  return $r;
 }
 add_filter( 'http_request_args', 'pmc_dont_update_theme', 5, 2 );
 
/*-----------------------------------------------------------------------------------*/
// Options Framework
/*-----------------------------------------------------------------------------------*/


// Paths to admin functions
define('MY_TEXTDOMAIN', 'wp-studio');
load_theme_textdomain( 'wp-studio', get_template_directory() . '/languages' );
load_theme_textdomain( 'woocommerce', get_template_directory() . '/languages' );
define('ADMIN_PATH', get_stylesheet_directory() . '/admin/');
define('BOX_PATH', get_stylesheet_directory() . '/includes/boxes/');
define('ADMIN_DIR', get_template_directory_uri() . '/admin/');
define('LAYOUT_PATH', ADMIN_PATH . '/layouts/');

// You can mess with these 2 if you wish.
$themedata = wp_get_theme(get_stylesheet_directory() . '/style.css');
define('THEMENAME', $themedata['Name']);
define('OPTIONS', 'of_options'); // Name of the database row where your options are stored
add_option('IMPORT', 'false');
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	//Call action that sets
	add_action('admin_head','of_option_setup');
	if(get_option('IMPORT') == 'false'){
		wp_redirect( admin_url( 'themes.php?page=optionsframework&import=false' ) );
		update_option('IMPORT', 'true');
	}
	else{
		wp_redirect( admin_url( 'themes.php?page=optionsframework' ) );
	}
}


function of_option_setup()	{


		
	if (!get_option('of_options')){
	
		$pmc_data = 'YToxMDM6e3M6MTQ6InNob3dyZXNwb25zaXZlIjtzOjE6IjEiO3M6MTU6ImluZm90ZXh0X3N0YXR1cyI7czoxOiIxIjtzOjEwOiJib3hfc3RhdHVzIjtzOjE6IjEiO3M6MTg6InJhY2VudF9zdGF0dXNfcG9ydCI7czoxOiIxIjtzOjE4OiJob21lX3JlY2VudF9udW1iZXIiO3M6MToiNiI7czo4OiJpbmZvdGV4dCI7czo0NjoiV2VsY29tZSB0byBTdHVkaW8gOSwgYSBjcmVhdGl2ZSANCkFnZW5jeSBUaGVtZSI7czoxMDoiYm94MV90aXRsZSI7czo3OiJISVJFIE1FIjtzOjk6ImJveDFfbGluayI7czoyNDoiaHR0cDovL3ByZW1pdW1jb2RpbmcuY29tIjtzOjE2OiJib3gxX2Rlc2NyaXB0aW9uIjtzOjEyNToiRG9uZWMgcGVkZSBqdXN0bywgZnJpbmdpbGxhIHZlbCwgYWwsIHZ1bHB1dGF0ZSANCmVnZXQsIGFyY3UuIEluIGVuaW0ganVzdG8sIGxvcmVtIGlwc3VtLg0KPHN0cm9uZz5pbmZvQHByZW1pdW1jb2Rpbmc8L3N0cm9uZz4iO3M6MTA6ImJveDJfdGl0bGUiO3M6ODoiQUJPVVQgVVMiO3M6OToiYm94Ml9saW5rIjtzOjI0OiJodHRwOi8vcHJlbWl1bWNvZGluZy5jb20iO3M6MTY6ImJveDJfZGVzY3JpcHRpb24iO3M6MTAzOiJMb3JlbSBpcHN1bSBkb2xvciBzaXQgZWN0ZSBhZGlwaXNjaW5nIGVsaXQsIA0Kbm9udW1teSBldWlzb2QgdmVkLg0KPGJyPg0KPHN0cm9uZz4rMTIzIDU2OTggNzg0PC9zdHJvbmc+IjtzOjQ6ImxvZ28iO3M6NzM6Imh0dHA6Ly9zdHVkaW8ucHJlbWl1bWNvZGluZy5jb20vd3AtY29udGVudC91cGxvYWRzLzIwMTMvMDEvc3R1ZGlvTG9nby5wbmciO3M6NzoiZmF2aWNvbiI7czo3NzoiaHR0cDovL21lcmNvci5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3VwbG9hZHMvMjAxMi8wOS9mYXZpY29uLW1lcmNvci5wbmciO3M6MTY6Imdvb2dsZV9hbmFseXRpY3MiO3M6MTc6IjxzY3JpcHQ+PC9zY3JpcHQ+IjtzOjk6Im1haW5Db2xvciI7czo3OiIjRDI1ODU4IjtzOjg6ImJveENvbG9yIjtzOjc6IiMxZTFlMjAiO3M6MTU6IlNoYWRvd0NvbG9yRm9udCI7czo3OiIjMDAwMDAwIjtzOjIzOiJTaGFkb3dPcGFjaXR0eUNvbG9yRm9udCI7czozOiIwLjIiO3M6MjE6ImJvZHlfYmFja2dyb3VuZF9jb2xvciI7czo3OiIjZmFmYWZhIjtzOjE2OiJiYWNrZ3JvdW5kX2ltYWdlIjtzOjE6IjEiO3M6NzoiYm9keV9iZyI7czo3NToiaHR0cDovL3N0dWRpby5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3RoZW1lcy9zdHVkaW8vaW1hZ2VzL2JnL2JnMTYucG5nIjtzOjE4OiJib2R5X2JnX3Byb3BlcnRpZXMiO3M6MTA6InJlcGVhdCAwIDAiO3M6MjM6ImJhY2tncm91bmRfaW1hZ2VfaGVhZGVyIjtzOjE6IjEiO3M6MjM6ImhlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiMxZTFlMjAiO3M6MjA6ImhlYWRlcl9iZ19wcm9wZXJ0aWVzIjtzOjEwOiJyZXBlYXQgMCAwIjtzOjEyOiJjdXN0b21fc3R5bGUiO3M6MDoiIjtzOjk6ImJvZHlfZm9udCI7YTozOntzOjQ6InNpemUiO3M6NDoiMjRweCI7czo1OiJjb2xvciI7czo3OiIjMmEyYjJjIjtzOjQ6ImZhY2UiO3M6NzoiZ2VvcmdpYSI7fXM6MTI6ImhlYWRpbmdfZm9udCI7YToyOntzOjQ6ImZhY2UiO3M6ODoiVmlkYWxva2EiO3M6NToic3R5bGUiO3M6Njoibm9ybWFsIjt9czo5OiJtZW51X2ZvbnQiO3M6NzoiZ2VvcmdpYSI7czoxNDoiYm9keV9ib3hfY29sZXIiO3M6NzoiI2ZmZmZmZiI7czoxNToiYm9keV9saW5rX2NvbGVyIjtzOjc6IiMyYTJiMmMiO3M6MTU6ImhlYWRpbmdfZm9udF9oMSI7YToyOntzOjQ6InNpemUiO3M6NDoiNDBweCI7czo1OiJjb2xvciI7czo3OiIjMmEyYjJjIjt9czoxNToiaGVhZGluZ19mb250X2gyIjthOjI6e3M6NDoic2l6ZSI7czo0OiIzMnB4IjtzOjU6ImNvbG9yIjtzOjc6IiMyYTJiMmMiO31zOjE1OiJoZWFkaW5nX2ZvbnRfaDMiO2E6Mjp7czo0OiJzaXplIjtzOjQ6IjI2cHgiO3M6NToiY29sb3IiO3M6NzoiIzJhMmIyYyI7fXM6MTU6ImhlYWRpbmdfZm9udF9oNCI7YToyOntzOjQ6InNpemUiO3M6NDoiMThweCI7czo1OiJjb2xvciI7czo3OiIjMmEyYjJjIjt9czoxNToiaGVhZGluZ19mb250X2g1IjthOjI6e3M6NDoic2l6ZSI7czo0OiIxN3B4IjtzOjU6ImNvbG9yIjtzOjc6IiMyYTJiMmMiO31zOjE1OiJoZWFkaW5nX2ZvbnRfaDYiO2E6Mjp7czo0OiJzaXplIjtzOjQ6IjE2cHgiO3M6NToiY29sb3IiO3M6NzoiIzJhMmIyYyI7fXM6MTE6InBvcnRfbnVtYmVyIjtzOjI6IjEyIjtzOjEzOiJmYWNlYm9va19zaG93IjtzOjE6IjEiO3M6ODoiZmFjZWJvb2siO3M6Mzk6Imh0dHBzOi8vd3d3LmZhY2Vib29rLmNvbS9QcmVtaXVtQ29kaW5nLyI7czoxMjoidHdpdHRlcl9zaG93IjtzOjE6IjEiO3M6NzoidHdpdHRlciI7czozMzoiaHR0cHM6Ly90d2l0dGVyLmNvbS9wcmVtaXVtY29kaW5nIjtzOjEwOiJ2aW1lb19zaG93IjtzOjE6IjEiO3M6NToidmltZW8iO3M6MTY6Imh0dHA6Ly92aW1lby5jb20iO3M6MTI6InlvdXR1YmVfc2hvdyI7czoxOiIxIjtzOjc6InlvdXR1YmUiO3M6Mjc6Imh0dHA6Ly9kcmliYmJsZS5jb20vZ2xqaXZlYyI7czo0OiJkaWdnIjtzOjE5OiJodHRwOi8vd3d3LmRpZ2cuY29tIjtzOjEwOiJlbWFpbF9zaG93IjtzOjE6IjEiO3M6NToiZW1haWwiO3M6MjI6ImluZm9AcHJlbWl1bWNvZGluZy5jb20iO3M6MTI6ImNvbnRhY3RlbWFpbCI7czoxNzoiaW5mb0B5b3VybWFpbC5jb20iO3M6MTI6ImNvbnRhY3RlcnJvciI7czoyNToiRXJyb3Igd2hpbGUgc2VuZGluZyBtYWlsLiI7czoxNDoiY29udGFjdHN1Y2Nlc3MiO3M6NzoiU3VjY2VzcyI7czoxNDoiZXJyb3JwYWdldGl0bGUiO3M6MTA6Ik9PT1BTISA0MDQiO3M6MTc6ImVycm9ycGFnZXN1YnRpdGxlIjtzOjY1OiJTZWVtcyBsaWtlIHlvdSBzdHVtYmxlZCBhdCBzb21ldGhpbmcgdGhhdCBkb2VzblxcXCd0IHJlYWxseSBleGlzdCI7czo5OiJlcnJvcnBhZ2UiO3M6MTcxOiJTb3JyeSwgYnV0IHRoZSBwYWdlIHlvdSBhcmUgbG9va2luZyBmb3IgaGFzIG5vdCBiZWVuIGZvdW5kLjxici8+VHJ5IGNoZWNraW5nIHRoZSBVUkwgZm9yIGVycm9ycywgdGhlbiBoaXQgcmVmcmVzaC48L2JyPk9yIHlvdSBjYW4gc2ltcGx5IGNsaWNrIHRoZSBpY29uIGJlbG93IGFuZCBnbyBob21lOikiO3M6MTY6InNob3dzb2NpYWxmb290ZXIiO3M6MToiMSI7czo5OiJjb3B5cmlnaHQiO3M6NTQ6IsKpIDIwMTMgY29weXJpZ2h0IFBSRU1JVU1DT0RJTkcgLy8gQWxsIHJpZ2h0cyByZXNlcnZlZCI7czoyMzoidHJhbnNsYXRpb25fc29jaWFsdGl0bGUiO3M6MDoiIjtzOjIwOiJ0cmFuc2xhdGlvbl9mYWNlYm9vayI7czo4OiJGYWNlYm9vayI7czoxOToidHJhbnNsYXRpb25fdHdpdHRlciI7czo3OiJUd2l0dGVyIjtzOjE3OiJ0cmFuc2xhdGlvbl92aW1lbyI7czo1OiJWaW1lbyI7czoxNjoidHJhbnNsYXRpb25fZGlnZyI7czo0OiJEaWdnIjtzOjE5OiJ0cmFuc2xhdGlvbl9kcmliYmxlIjtzOjc6IkRyaWJibGUiO3M6MTc6InRyYW5zbGF0aW9uX2VtYWlsIjtzOjEzOiJTZW5kIHVzIEVtYWlsIjtzOjI0OiJ0cmFuc2xhdGlvbl9lbnRlcl9zZWFyY2giO3M6MTU6IkVudGVyIHNlYXJjaC4uLiI7czoyMDoidHJhbnNsYXRpb25fbW9yZWxpbmsiO3M6OToiUmVhZCBtb3JlIjtzOjI0OiJwb3J0X3Byb2plY3RfZGVzY3JpcHRpb24iO3M6MjA6IlByb2plY3QgRGVzY3JpcHRpb246IjtzOjIwOiJwb3J0X3Byb2plY3RfZGV0YWlscyI7czoxNjoiUHJvamVjdCBkZXRhaWxzOiI7czoxNjoicG9ydF9wcm9qZWN0X3VybCI7czoxMjoiUHJvamVjdCBVUkw6IjtzOjIxOiJwb3J0X3Byb2plY3RfZGVzaWduZXIiO3M6MTc6IlByb2plY3QgZGVzaWduZXI6IjtzOjE3OiJwb3J0X3Byb2plY3RfZGF0ZSI7czoyNzoiUHJvamVjdCBEYXRlIG9mIGNvbXBsZXRpb246IjtzOjE5OiJwb3J0X3Byb2plY3RfY2xpZW50IjtzOjE1OiJQcm9qZWN0IENsaWVudDoiO3M6MTg6InBvcnRfcHJvamVjdF9zaGFyZSI7czoxNzoiU2hhcmUgdGhlIHByb2plY3QiO3M6MjA6InBvcnRfcHJvamVjdF9yZWxhdGVkIjtzOjE1OiJSZWxhdGVkIHByb2plY3QiO3M6MTU6InRyYW5zbGF0aW9uX2FsbCI7czo4OiJTaG93IGFsbCI7czoyNDoidHJhbnNsYXRpb25fbmV4dF9wcm9qZWN0IjtzOjEyOiJOZXh0IHByb2plY3QiO3M6Mjc6InRyYW5zbGF0aW9uX3ByZXZpdXNfcHJvamVjdCI7czoxMzoiUHJldiBwcm9qZWN0ICI7czoyMDoidHJhbnNsYXRpb25fbmV4dHBhZ2UiO3M6MTE6Ik9sZGVyIHBvc3RzIjtzOjI0OiJ0cmFuc2xhdGlvbl9wcmV2aW91c3BhZ2UiO3M6MTE6Ik5ld2VyIHBvc3RzIjtzOjE0OiJ0cmFuc2xhdGlvbl9ieSI7czozOiJCeToiO3M6MjI6InRyYW5zbGF0aW9uX2NhdGVnb3JpZXMiO3M6MTE6IkNhdGVnb3JpZXM6IjtzOjE2OiJ0cmFuc2xhdGlvbl90YWdzIjtzOjY6IlRhZ3M6ICI7czoyNjoidHJhbnNsYXRpb25fc2hhcmVfY2F0ZWdvcnkiO3M6NToiU2hhcmUiO3M6MjE6InRyYW5zbGF0aW9uX2Jsb2dfcGFnZSI7czo1OToiV2VsY29tZSB0byA8c3Bhbj5vdXIgYmxvZzwvc3Bhbj4sIHdlIHdpbGwga2VlcCB5b3UgaW5mb3JtZWQiO3M6MzI6InRyYW5zbGF0aW9uX2NvbW1lbnRfbGVhdmVfcmVwbGF5IjtzOjY6IlN1Ym1pdCI7czozNToidHJhbnNsYXRpb25fY29tbWVudF9sZWF2ZV9yZXBsYXlfdG8iO3M6MTY6IkxlYXZlIGEgUmVwbHkgdG8iO3M6Mzk6InRyYW5zbGF0aW9uX2NvbW1lbnRfbGVhdmVfcmVwbGF5X2NhbmNsZSI7czoxMzoiQ2FuY2VsIFJlcGxheSI7czoyNDoidHJhbnNsYXRpb25fY29tbWVudF9uYW1lIjtzOjQ6Ik5hbWUiO3M6MjQ6InRyYW5zbGF0aW9uX2NvbW1lbnRfbWFpbCI7czo0OiJNYWlsIjtzOjI3OiJ0cmFuc2xhdGlvbl9jb21tZW50X3dlYnNpdGUiO3M6NzoiV2Vic2l0ZSI7czoyODoidHJhbnNsYXRpb25fY29tbWVudF9yZXF1aXJlZCI7czo4OiJyZXF1aXJlZCI7czoyNjoidHJhbnNsYXRpb25fY29tbWVudF9jbG9zZWQiO3M6MjA6IkNvbW1lbnRzIGFyZSBjbG9zZWQuIjtzOjMxOiJ0cmFuc2xhdGlvbl9jb21tZW50X25vX3Jlc3BvbmNlIjtzOjEyOiJObyBSZXNwb25zZXMiO3M6MzE6InRyYW5zbGF0aW9uX2NvbW1lbnRfb25lX2NvbW1lbnQiO3M6MTA6IjEgUmVzcG9uc2UiO3M6MzE6InRyYW5zbGF0aW9uX2NvbW1lbnRfbWF4X2NvbW1lbnQiO3M6OToiUmVzcG9uc2VzIjtzOjI0OiJ0cmFuc2xhdGlvbl9jb250YWN0X25hbWUiO3M6NDoiTmFtZSI7czoyNToidHJhbnNsYXRpb25fY29udGFjdF9lbWFpbCI7czo1OiJFbWFpbCI7czoyNzoidHJhbnNsYXRpb25fY29udGFjdF9tZXNzYWdlIjtzOjc6Ik1lc3NhZ2UiO3M6MjQ6InRyYW5zbGF0aW9uX2NvbnRhY3Rfc2VuZCI7czoxMjoiU2VuZCBNZXNzYWdlIjtzOjI1OiJ0cmFuc2xhdGlvbl9jb250YWN0X2NsZWFyIjtzOjU6IkNsZWFyIjtzOjk6ImhlYWRlcl9iZyI7czowOiIiO3M6OToiZGlnZ19zaG93IjtzOjA6IiI7fQ==';
		$pmc_data = unserialize(base64_decode($pmc_data)); //100% safe - ignore theme check nag
		update_option('of_options', $pmc_data);
		
	}
	//delete_option(OPTIONS);
	
}

// Build Options
require_once (ADMIN_PATH . 'theme-options.php'); 		// Options panel settings and custom settings
require_once (ADMIN_PATH . 'admin-interface.php');		// Admin Interfaces 
require_once (ADMIN_PATH . 'admin-functions.php'); 	// Theme actions based on options settings
require_once (ADMIN_PATH . 'medialibrary-uploader.php'); // Media Library Uploader


$includes =  get_template_directory() . '/includes/';
$widget_includes =  get_template_directory() . '/includes/widgets/';

require_once ($includes  . 'scripts.php'); // Load JS 

// Other theme options
require_once ($includes . 'menu.php'); 		   // Menus
require_once ($includes . 'sidebars.php');
require_once ($includes . 'shortcodes.php');
	
require_once ($widget_includes . 'pop_widget.php'); 
require_once ($widget_includes . 'racent_widget.php'); 








function fl_shortcode_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "fl_add_shortcode_tinymce_plugin");
		add_filter('mce_buttons', 'fl_register_shortcode_button');
	}
}
add_action( 'init', 'fl_shortcode_button' );
 
 if ( ! isset( $content_width ) ) $content_width = 960;
/**
 * Register the TinyMCE Shortcode Button
 */
function fl_register_shortcode_button($buttons) {
	array_push($buttons, "|", "flshortcodes");
	return $buttons;
}

/**
 * Load the TinyMCE plugin: shortcode_plugin.js
 */
function fl_add_shortcode_tinymce_plugin($plugin_array) {
   $plugin_array['flshortcodes'] = get_template_directory_uri() . '/js/shortcode_plugin.js';
   return $plugin_array;
}
 


function shortcontent($start, $end, $new, $source, $lenght){
$text = strip_tags(preg_replace('/<h(.*)>(.*)<\/h(.*)>.*/iU', '', $source), '<b><strong>');
$text = preg_replace('#\[video\](.*)\[\/video\]#si', '', $text);
$text = preg_replace('#\[pmc_link\](.*)\[\/pmc_link\]#si', '', $text);
$text = preg_replace('/\[[^\]]*\]/', $new, $text); 
return substr(preg_replace('/\s[\s]+/','',$text),0,$lenght);

}


function new_excerpt_more($more) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');



function socialLinkTop() {
	$social = '';
	global $pmc_data; 
	if(isset($pmc_data['facebook_show']))
	$social .= '<a target="_blank" class="facebooklink top" href="'.$pmc_data['facebook'].'" title="'.translation('translation_facebook', 'Facebook').'"><i class="fa fa-facebook"></i></a>'; 
	if(isset($pmc_data['youtube_show']))
	$social .= '<a target="_blank" class="dribble top" href="'.$pmc_data['youtube'].'" title="'.translation('translation_dribble', 'Dribble').'"><i class="fa fa-dribbble"></i></a>';  
	if(isset($pmc_data['twitter_show']))
	$social .= '<a target="_blank" class="twitterlink top" href="'.$pmc_data['twitter'].'" title="'.translation('translation_twitter', 'Twitter').'"><i class="fa fa-twitter"></i></a>'; 
	if(isset($pmc_data['email_show']))
	$social .= '<a target="_blank" class="emaillink top" href="mailto:'.$pmc_data['email'].'" title="'.translation('translation_email', 'Send us Email').'"><i class="fa fa-envelope"></i></a>';  	
	if(isset($pmc_data['vimeo_show'])) 
	$social .= '<a target="_blank" class="vimeo top" href="'.$pmc_data['vimeo'].'" title="'.translation('translation_vimeo', 'Vimeo').'"><i class="fa fa-vimeo"></i></a>';
	echo $social;
}

function socialLinkCat($link,$title,$email) {
	global $pmc_data,$sitepress;; 
	$social = '';
	$social .='<a class="addthis_button" addthis:url="'.$link.'" addthis:title="'.$title.'" ><img src="'. get_template_directory_uri() .'/images/socialIconShareMore.png" width="64" height="64"  alt="More..." />';
	$social .= translation('translation_share_category', 'Share'); 
	$social .='</a><script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-507800a118eab6fa"></script>';	

	echo $social; }



function socialLinkSingle() {
	$social = '';
	$social ='<div class="addthis_toolbox"><div class="custom_images">';
	global $pmc_data; 
	if(isset($pmc_data['facebook_show'])) 
	$social .= '<a class="addthis_button_facebook" title="'.translation('translation_facebook', 'Facebook').'"><i class="fa fa-facebook"></i></a>';            
	if(isset($pmc_data['twitter_show'])) 
	$social .= '<a class="addthis_button_twitter" title="'.translation('translation_twitter', 'Twitter').'"><i class="fa fa-twitter"></i></a>';  
	$social .='<a class="addthis_button_more"><i class="fa fa-plus"></i></a></div><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f3049381724ac5b"></script>';	
	if(isset($pmc_data['email_show'])) 
	$social .= '<a class="emaillink" href="mailto:'.$pmc_data['email'].'" title="'.translation('translation_email', 'Send us Email').'"><i class="fa fa-envelope"></i></a></div>'; 
	echo $social;
}

function translation($theme_name, $translation_name){
	global $pmc_data, $sitepress;
	if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { 
		if(isset($pmc_data[$theme_name]))
			$string = stripText($pmc_data[$theme_name]); 
		else
			$string = '';
		} 
	else {  
		$string = __($translation_name,'wp-studio'); 				
	} 
	return $string;

}

function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

add_filter('the_content', 'addlightboxrel_replace');

function addlightboxrel_replace ($content)
{	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
  	$replacement = '<a$1href=$2$3.$4$5 rel="lightbox[%LIGHTID%]"$6>';
    $content = preg_replace($pattern, $replacement, $content);
	if(isset($post->ID))
		$content = str_replace("%LIGHTID%", $post->ID, $content);
    return $content;
}



function filter_content_gallery( $content ){
	$content = explode('[gallery]', $content );	
	$contentgal = $content[0];	
	return $contentgal;
}



function stripText($string) 
{ 
    return str_replace("\\",'',$string);
} 



/*portfolio loop*/

function portfolio($height, $width, $item, $post = 'port' ,$number = 0,$cat = ''){
	global $pmc_data; 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$categport = '';


	if($post == 'post'){
		$postT = 'post';
		$showposts = 999;
		$postC = 'category';	
		$categport="";		
		}
	else{
		$postT = 'portfolioentry';
		$postC = 'portfoliocategory';
		$showposts = 999;
		if($cat != '')
			$categport='&portfoliocategory='.$cat;
		}
		
	if($number != 0)
		$showposts = $number;
		
	$postPage = '&posts_per_page='.$showposts;		
		
	if($item == 3){
		$titleChar = 999;
	}
	else if($item == 2){
		$titleChar = 25;
	}	
	else {
		$titleChar = 25;
	}


	if($categport != "")
		$pmc = new WP_Query(array('orderby=date', 'post_type' =>  $postT, 'paged' => $paged, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'posts_per_page' => $showposts ,'portfoliocategory' => $cat )); 
	else
		$pmc = new WP_Query(array('orderby=date', 'post_type' =>  $postT, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'posts_per_page' => $showposts , 'paged' => $paged,'suppress_filters' => false)); 
		

	$limit_text = 100;
	$currentindex = '';
	$counter = 0;
	$portfolio = '';
	$count = 0;
	while ( $pmc->have_posts() ) : $pmc->the_post();
		$do_not_duplicate = get_the_ID(); 
		$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', false);
		$entrycategory = get_the_term_list( get_the_ID(), $postC, '', ' ', '' );
		$catstring = $entrycategory;
		$catstring = strip_tags($catstring);
		$catidlist = explode(" ", $catstring);
		for($i = 0; $i < sizeof($catidlist); ++$i){
			$catidlist[$i].=$currentindex;
		}
		$catlist = implode(" ", $catidlist);

		$counter++;
		$category = get_the_term_list( get_the_ID(), $postC, '', ', ', '' );	
		if ( has_post_format( 'link' , get_the_ID())) 
			$linkPost = filter_link(get_the_content());
		else
			if (function_exists('icl_object_id')) 
				$linkPost = get_permalink(icl_object_id(get_the_ID(), 'portfolioentry', true, true));
			else 
				$linkPost = get_permalink();
				
		
		if($item != 2){

		$portfolio .= '<div class="item'.$item.' '.$catlist .'" data-category="'. $catlist.'">';
			if($item == 3) {
			
			$portfolio .= '
				<div class="recentimage">
					<a href="'. $linkPost .'">
						<div class="overdefult">
							<div class="portTitle">'. the_title('','',FALSE) .'</div>
						</div>
					</a>
					<div class="image">
						<div class="loading"></div>
						<img src="'. get_template_directory_uri() .'/js/timthumb.php?src='. $full_image[0] .'&amp;h='.$height.'&amp;w='.$width.'" alt="'. the_title('','',FALSE) .'">
					</div>
				</div>';
			}
			
			

		$portfolio .= '</div>';
		
		} else {
		$category = get_the_term_list( get_the_ID(), $postC, '', '', '' );	
		$categoryHover = get_the_term_list( get_the_ID(), $postC, '', ', ', '' );			
		if($count != 2){
			$portfolio .= '<div class="one_half item2 '.$catlist .'" data-category="'. $catlist.'" >';
		}
		else{
			$portfolio .= '<div class="one_half last item2 '.$catlist .'" data-category="'. $catlist.'" >';
			$count = 0;
		}

			$portfolio .= '
				<div class="recentimage">
					<a href="'. $linkPost .'">
						<div class="overdefult">
							<div class="portTitle">'. the_title('','',FALSE) .'</div>	
						</div>
					</a>
					<div class="image">
						<div class="loading"></div>
						<img src="'. get_template_directory_uri() .'/js/timthumb.php?src='. $full_image[0] .'&amp;h='.$height.'&amp;w='.$width.'" alt="'. the_title('','',FALSE) .'">
					</div>
				</div>
			</div>';

		$count++;
		
		}

		

	endwhile; 	

	echo $portfolio;
}

add_action('init', 'create_portfolio');

function create_portfolio() {
	$portfolio_args = array(
		'label' => 'Portfolio',
		'singular_label' => 'Portfolio',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'author', 'comments', 'excerpt')
	);
	register_post_type('portfolioentry',$portfolio_args);
}
add_action("admin_init", "add_portfolio");
add_action('save_post', 'update_portfolio_data');

function add_portfolio(){
	add_meta_box("portfolio_details", "Portfolio Entry Options", "portfolio_options", "portfolioentry", "normal", "high");
}

function update_portfolio_data(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){
		if( isset($_POST["author"]) ) {
			update_post_meta($post->ID, "author", $_POST["author"]);
		}
		if( isset($_POST["date"]) ) {
			update_post_meta($post->ID, "date", $_POST["date"]);
		}
		if( isset($_POST["detail_active"]) ) {
			update_post_meta($post->ID, "detail_active", $_POST["detail_active"]);
		}else{
			update_post_meta($post->ID, "detail_active", 0);
		}
		if( isset($_POST["website_url"]) ) {
			update_post_meta($post->ID, "website_url", $_POST["website_url"]);
		}
		if( isset($_POST["status"]) ) {
			update_post_meta($post->ID, "status", $_POST["status"]);
		}		
		if( isset($_POST["customer"]) ) {
			update_post_meta($post->ID, "customer", $_POST["customer"]);
		}			

	}
}

function portfolio_options(){
	global $post;
	$pmc_data = get_post_custom($post->ID);
	if (isset($pmc_data["author"][0])){
		$author = $pmc_data["author"][0];
	}else{
		$author = "";
	}
	if (isset($pmc_data["date"][0])){
		$date = $pmc_data["date"][0];
	}else{
		$date = "";
	}
	if (isset($pmc_data["status"][0])){
		$status = $pmc_data["status"][0];
	}else{
		$status = "";
	}	
	if (isset($pmc_data["detail_active"][0])){
		$detail_active = $pmc_data["detail_active"][0];
	}else{
		$detail_active = 0;
		$pmc_data["detail_active"][0] = 0;
	}
	if (isset($pmc_data["website_url"][0])){
		$website_url = $pmc_data["website_url"][0];
	}else{
		$website_url = "";
	}
	
	if (isset($pmc_data["customer"][0])){
		$customer = $pmc_data["customer"][0];
	}else{
		$customer = "";
	}	 ?>
    <div id="portfolio-options">
        <table cellpadding="15" cellspacing="15">
        	<tr>
                <td colspan="2"><strong>Portfolio Overview Options:</strong></td>
            </tr>
            <tr>
                <td><label>Link to Detail Page: <i style="color: #999999;">(Do you want a project detail page?)</i></label></td><td><input type="checkbox" name="detail_active" value="1" <?php if( isset($detail_active)){ checked( '1', $pmc_data["detail_active"][0] ); } ?> /></td>	
            </tr>
            <tr>
            	<td><label>Project Link: <i style="color: #999999;">(The URL of your project)</i></label></td><td><input name="website_url" style="width:500px" value="<?php echo $website_url; ?>" /></td>
            </tr>
            <tr>
            	<td><label>Project Author: <i style="color: #999999;">(The URL of your project)</i></label></td><td><input name="author" style="width:500px" value="<?php echo $author; ?>" /></td>
            </tr>
            <tr>
            	<td><label>Project date: <i style="color: #999999;">(Date of project)</i></label></td><td><input name="date" style="width:500px" value="<?php echo $date; ?>" /></td>
            </tr>	
            <tr>
            	<td><label>Customer: <i style="color: #999999;">(Customer of project)</i></label></td><td><input name="customer" style="width:500px" value="<?php echo $customer; ?>" /></td>
            </tr>				
            <tr>
            	<td><label>Project status: <i style="color: #999999;">(Status of project)</i></label></td><td><input name="status" style="width:500px" value="<?php echo $status; ?>" /></td>
            </tr>				
        </table>
    </div>
      
<?php
}	
	
function add_portfolio_category(){
	add_meta_box("portfolio_categories", "Portfolio categories(only for portfolio templates)", "portfolio_category_options", "page", "normal", "high");
}	

add_action('save_post', 'update_portfolio_category_data');
add_action("admin_init", "add_portfolio_category");

function portfolio_category_options(){
	global $post;
	$pmc_data = get_post_custom($post->ID);
	if (isset($pmc_data["port_category"][0])){
		$port_category = $pmc_data["port_category"][0];
	}else{
		$port_category = "";
	}

?>
    <div id="portfolio-category-options">
        <table cellpadding="15" cellspacing="15">
        	<tr>
                <td colspan="2"><strong>Portfolio category(only for portfolio templates):</strong></td>
            </tr>
            <tr>
            	<td><label>Category: <i style="color: #999999;">(select category)</i></label></td><td>
				<?php wp_dropdown_categories('show_option_all=Show all&hierarchical=2&name=port_category&taxonomy=portfoliocategory&selected='.$port_category.''); ?>
				</td>
            </tr>
			
        </table>
    </div>
      
<?php
}
function update_portfolio_category_data(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){
		if( isset($_POST["port_category"]) ) {
			update_post_meta($post->ID, "port_category", $_POST["port_category"]);
		}			

	}
}


register_taxonomy("portfoliocategory", array("portfolioentry"), array("hierarchical" => true, "label" => "Portfolio Categories", "singular_label" => "Portfolio Category", "rewrite" => true));

function getcatslug($catID){
		$cat_obj = get_term($catID, 'portfoliocategory');
		$cat_slug = '';
		$cat_slug = $cat_obj->slug;
		return $cat_slug;
	}

function add_slider_category(){
	add_meta_box("slider_categories", "Post type", "slider_category_options_post", "post", "normal", "high");
	
}	


add_action('save_post', 'update_slider_category_data');
add_action("admin_init", "add_slider_category");

function slider_category_options(){
	global $post;
	$pmc_data = get_post_custom($post->ID);
	if (isset($pmc_data["slider_category"][0])){
		$slider_category = $pmc_data["slider_category"][0];
	}else{
		$slider_category = "";
	}

?>
    <div id="portfolio-category-options">
        <table cellpadding="15" cellspacing="15">		
		
        	<tr>
                <td colspan="2"><strong>Select slider:</strong></td>
            </tr>
			
            <tr>
            	<td><label>Slider: <i style="color: #999999;">(select slider for this page/post)</i></label></td><td>
				<?php wp_dropdown_categories('show_option_all=None&hierarchical=2&name=slider_category&taxonomy=sliderocategory&selected='.$slider_category.''); ?>
				</td>
            </tr>
        </table>
    </div>
      
<?php
}

function slider_category_options_post(){
	global $post;
	$pmc_data = get_post_custom($post->ID);
	if (isset($pmc_data["slider_category"][0])){
		$slider_category = $pmc_data["slider_category"][0];
	}else{
		$slider_category = "";
	}
	if (isset($pmc_data["video_post_url"][0])){
		$video_post_url = $pmc_data["video_post_url"][0];
	}else{
		$video_post_url = "";
	}	
	if (isset($pmc_data["video_active_post"][0])){
		$video_active_post = $pmc_data["video_active_post"][0];
	}else{
		$video_active_post = 0;
		$pmc_data["video_active_post"][0] = 0;
	}	
	
	if (isset($pmc_data["link_post_url"][0])){
		$link_post_url = $pmc_data["link_post_url"][0];
	}else{
		$link_post_url = "";
	}	
	
	if (isset($pmc_data["audio_post_url"][0])){
		$audio_post_url = $pmc_data["audio_post_url"][0];
	}else{
		$audio_post_url = "";
	}	

	if (isset($pmc_data["audio_post_title"][0])){
		$audio_post_title = $pmc_data["audio_post_title"][0];
	}else{
		$audio_post_title = "";
	}	
	
	if (isset($pmc_data["selectv"][0])){
		$selectv = $pmc_data["selectv"][0];
	}else{
		$selectv = "";
	}	
	
	

?>
    <div id="portfolio-category-options">
        <table cellpadding="15" cellspacing="15">
	
            <tr class="videoonly">
            	<td><label>Video URL(*required): <i style="color: #999999;">
				<br>Link should look for Youtube: http://www.youtube.com/watch?v=WhBoR_tgXCI - So ID is WhBoR_tgXCI
				<br>Link should look for Vimeo: http://vimeo.com/29017795 so ID is 29017795 <br></i></label><br><input name="video_post_url" style="width:500px" value="<?php echo $video_post_url; ?>" /></td>
            </tr>	
            <tr class="select_video">
            	<td><label>Select video: <i style="color: #999999;">
				<select name="selectv">
				<?php if ($selectv == 'vimeo') {?>
				  <option value="vimeo" selected>Vimeo</option>
				 <?php } else {?>
				  <option value="vimeo">Vimeo</option>						
				 <?php }?>	
				<?php if ($selectv == 'youtube') {?>				 
				  <option value="youtube" selected>YouTube</option>
				 <?php } else {?>
				  <option value="youtube">YouTube</option>						
				 <?php }?>					  
				</select>
				
            </tr>			
            <tr class="linkonly">
            	<td><label>Link URL: <i style="color: #999999;"></i></label><br></td><td><input name="link_post_url" style="width:500px" value="<?php echo $link_post_url; ?>" /></td>
            </tr>				

            <tr class="audioonly">
            	<td><label>Audio URL: <i style="color: #999999;"></i></label><br></td><td><input name="audio_post_url" style="width:500px" value="<?php echo $audio_post_url; ?>" /></td>
            </tr>
            <tr class="audioonly">
            	<td><label>Audio title : <i style="color: #999999;"></i></label><br></td><td><input name="audio_post_title" style="width:500px" value="<?php echo $audio_post_title; ?>" /></td>
            </tr>			
			
        </table>
		<script>
		jQuery(document).ready(function(){	
				if (jQuery("input[name=post_format]:checked").val() == 'video'){
					jQuery('.videoonly , .select_video').show();
					jQuery('.linkonly').hide();
					jQuery('.audioonly').hide();}
					
				else if (jQuery("input[name=post_format]:checked").val() == 'link'){
					jQuery('.linkonly').show();
					jQuery('.videoonly, .select_video').hide();	
					jQuery('.audioonly').hide();}	
				else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
					jQuery('.linkonly').hide();
					jQuery('.videoonly, .select_video').hide();	
					jQuery('.audioonly').show();}						
				else{
					jQuery('.videoonly').hide();
					jQuery('.audioonly').hide();
					jQuery('.linkonly, .select_video').hide();}
				
				jQuery("input[name=post_format]").change(function(){
				if (jQuery("input[name=post_format]:checked").val() == 'video'){
					jQuery('.videoonly, .select_video').show();
					jQuery('.linkonly').hide();
					jQuery('.audioonly').hide();}
				else if (jQuery("input[name=post_format]:checked").val() == 'link'){
					jQuery('.linkonly').show();
					jQuery('.videoonly, .select_video').hide();	
					jQuery('.audioonly').hide();}	
				else if (jQuery("input[name=post_format]:checked").val() == 'audio'){
					jQuery('.linkonly').hide();
					jQuery('.audioonly').show();
					jQuery('.videoonly, .select_video').hide();	}						
				else{
					jQuery('.videoonly, .select_video').hide();
					jQuery('.linkonly').hide();
					jQuery('.audioonly').hide();}
			});
		});
		</script>
    </div>
	
      
<?php


	
}


function update_slider_category_data(){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
	if($post){
		if( isset($_POST["slider_category"]) ) {
			update_post_meta($post->ID, "slider_category", $_POST["slider_category"]);
		}	
		if( isset($_POST["video_post_url"]) ) {
			update_post_meta($post->ID, "video_post_url", $_POST["video_post_url"]);
		}	
		if( isset($_POST["video_active_post"]) ) {
			update_post_meta($post->ID, "video_active_post", $_POST["video_active_post"]);
		}else{
			update_post_meta($post->ID, "video_active_post", 0);
		}		
		if( isset($_POST["link_post_url"]) ) {
			update_post_meta($post->ID, "link_post_url", $_POST["link_post_url"]);
		}	
		if( isset($_POST["audio_post_url"]) ) {
			update_post_meta($post->ID, "audio_post_url", $_POST["audio_post_url"]);
		}		
		if( isset($_POST["audio_post_title"]) ) {
			update_post_meta($post->ID, "audio_post_title", $_POST["audio_post_title"]);
		}					
		if( isset($_POST["selectv"]) ) {
			update_post_meta($post->ID, "selectv", $_POST["selectv"]);
		}			
	}
	
	
	
}




if( !function_exists( 'studio_fallback_menu' ) )
{
	/**
	 * Create a navigation out of pages if the user didnt create a menu in the backend
	 *
	 */
	function studio_fallback_menu()
	{
		$current = "";
		if (is_front_page()){$current = "class='current-menu-item'";} 
		
		
		echo "<div class='fallback_menu'>";
		echo "<ul class='studio_fallback menu'>";
		echo "<li $current><a href='".get_bloginfo('url')."'>Home</a></li>";
		wp_list_pages('title_li=&sort_column=menu_order');
		echo "</ul></div>";
	}
}

function getVimeoThumb($id) {
    $pmc_data = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
    $pmc_data = json_decode($pmc_data);
    return $pmc_data[0]->thumbnail_small;
}

function removeChar($char){
	$char = explode('#',$char);
	return $char[1];
}

/*audio player*/
function wp_audio_player_head() {
	global $pmc_data;	
	
	echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/audio-player.js"></script>';
	echo '<script type="text/javascript">';
	echo 'AudioPlayer.setup("'.get_template_directory_uri().'/js/player.swf", {';
	echo 'width: 750,animation:"no", bg:"2a2b2c",leftbg:"1e1e20", rightbg:"1e1e20", volslider:"'.removeChar($pmc_data['mainColor']).'", voltrack:"ffffff", lefticon:"ffffff",righticon:"ffffff",skip:"ffffff", loader:"'.removeChar($pmc_data['mainColor']).'",
		 righticonhover:"ffffff", rightbghover:"'.removeChar($pmc_data['mainColor']).'", text:"1e1e20", border:"1e1e20"';
	echo '});</script>';
}
add_action('wp_head','wp_audio_player_head');

function wp_audio_player($atts) {
extract(shortcode_atts(array(
    'no' => '1',
    'file' => 'http://'
  ), $atts));
	$postmeta = get_post_custom(get_the_id());
	$title = 'Sample title';
	if(isset($postmeta["audio_product_title"][0]))
		$title = $postmeta["audio_product_title"][0];
	if(isset($postmeta["audio_post_title"][0]))
		$title = $postmeta["audio_post_title"][0];	
		
	return '<script type="text/javascript">AudioPlayer.embed("audioplayer_$no", {soundFile: "'.$file.'",titles: "'.$title.'"});</script><p id="audioplayer_$no">
			<audio controls="controls">
			<source src="'.$file.'" type="audio/mpeg" />
			Your browser does not support the audio tag.
			</audio>
			</p>';
}
add_shortcode('audio', 'wp_audio_player');

function closeTags($string){
	$output  = '';
	$open = $close = 0;
	$open = substr_count($string , '<strong>');
	$close = substr_count($string , '</strong>');
	if($open > $close )	
		$output .='</strong>'; 
	echo $output;
}

function closeTagsReturn($string){
	$output  = '';
	$open = $close = 0;
	$open = substr_count($string , '<strong>');
	$close = substr_count($string , '</strong>');
	if($open > $close )	
		$output .='</strong>'; 
	return $output;
}

function add_this_script_footer(){ 
	global $pmc_data, $sitepress;
	
		if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { 
			$search = stripText($pmc_data['translation_enter_search']); 
			
			} 
		else {  
			$search = __('Enter search...','wp-studio'); 
				
		} 

?>

<script>	
	jQuery(document).ready(function(){	
		jQuery('#sidebarsearch input').val('<?php echo $search ?>');
		
		jQuery('#sidebarsearch input').focus(function() {
			jQuery('#sidebarsearch input').val('');
		});
		
		jQuery('#sidebarsearch input').focusout(function() {
			jQuery('#sidebarsearch input').val('<?php echo $search ?>');
		});	
		
	});	
	

	
	jQuery("a[rel^='lightbox']").prettyPhoto({theme:'light_rounded',overlay_gallery: false,show_title: false});	
</script>
<?php  }


add_action('wp_footer', 'add_this_script_footer'); 	

/*if file exist*/
function url_exists($url) {
    if (fopen($url,'r')) return true;
    else return false;
}

add_filter( 'the_category', 'add_nofollow_cat' );  

function add_nofollow_cat( $text ) { 
	$text = str_replace('rel="category tag"', "", $text); 
	return $text; 
	}


?>