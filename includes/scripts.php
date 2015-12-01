<?php
function js_inc_function()
{
    if (!is_admin()) {
    
         wp_register_script('pmc_customjs', get_template_directory_uri() . '/js/custom.js', array(
            'jquery'
        ), true);  
		wp_enqueue_script('pmc_customjs');		      

		
        wp_register_script('pmc_prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(
            'jquery'
        ), true);
		wp_enqueue_script('pmc_prettyphoto');

        wp_register_script('pmc_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(
            'jquery'
        ), true);  
		wp_enqueue_script('pmc_isotope');				
        wp_register_script('pmc_contact', get_template_directory_uri() . '/js/contact.js', array(
            'jquery'
        ), true);  
		wp_enqueue_script('pmc_contact');			
        wp_register_script('pmc_ba-bbq', get_template_directory_uri() . '/js/jquery.ba-bbq.js', array(            'jquery'        ), true);  		wp_enqueue_script('pmc_ba-bbq');	

        wp_register_script('pmc_bxSlider', get_template_directory_uri() . '/js/jquery.bxslider.js', array(
            'jquery'
        ) ,true);  
		wp_enqueue_script('pmc_bxSlider');					
			        wp_register_script('pmc_any', get_template_directory_uri() . '/js/jquery.anythingslider.js', array(            'jquery'        ), true);		wp_enqueue_script('pmc_any');			


    }
}
add_action('init', 'js_inc_function');

//css
function enqueue_css() {
	global $pmc_data; 
    if( !is_admin()){
		wp_register_style('main', get_template_directory_uri() . '/style.css', 'style');
		wp_enqueue_style( 'main');
		wp_register_style('options', get_template_directory_uri() . '/css/options.css', 'style');
		wp_enqueue_style( 'options');	
		wp_register_style('prettyp', get_template_directory_uri() . '/prettyPhoto.css', 'style');
		wp_enqueue_style( 'prettyp');				wp_enqueue_style('font-awesome_pms', get_template_directory_uri() . '/css/font-awesome.css' ,'',NULL);		if(isset($pmc_data['heading_font'])){			if($pmc_data['heading_font']['face'] != 'verdana' and $pmc_data['heading_font']['face'] != 'trebuchet' and $pmc_data['heading_font']['face'] != 'georgia' and $pmc_data['heading_font']['face'] != 'Helvetica Neue' and $pmc_data['heading_font']['face'] != 'times,tahoma') {				wp_register_style('googleFont', 'http://fonts.googleapis.com/css?family='.$pmc_data['heading_font']['face'] ,'',NULL);				wp_enqueue_style( 'googleFont');				}				}		if(isset($pmc_data['body_font'])){			if(($pmc_data['body_font']['face'] != 'verdana') and ($pmc_data['body_font']['face'] != 'trebuchet') and ($pmc_data['body_font']['face'] != 'georgia') and ($pmc_data['body_font']['face'] != 'Helvetica Neue') and ($pmc_data['body_font']['face'] != 'times,tahoma')) {				wp_register_style('googleFontbody', 'http://fonts.googleapis.com/css?family='.$pmc_data['body_font']['face'] ,'',NULL);				wp_enqueue_style( 'googleFontbody');			}						}
		
	}
}
add_action('init', 'enqueue_css');


?>