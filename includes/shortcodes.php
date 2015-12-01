<?php

//question
function shortcode_question($atts, $content=null){
return '<div class="question"><span class="img"></span><h3>'.$content.'</h3></div>';	
}
add_shortcode('question', 'shortcode_question');

//success
function shortcode_success($atts, $content=null){
return '<div class="success"><span class="img"></span><h3>'.$content.'</h3></div>';	
}
add_shortcode('success', 'shortcode_success');

//info
function shortcode_info($atts, $content=null){
return '<div class="info"><span class="img"></span><h3>'.$content.'</h3></div>';	
}
add_shortcode('info', 'shortcode_info');

//error
function shortcode_error($atts, $content=null){
return '<div class="error"><span class="img"></span><h3>'.$content.'</h3></div>';
}
add_shortcode('error', 'shortcode_error');

//full
function shortcode_full($atts, $content = null){
return '<div class="full">' . do_shortcode($content) . '</div>';
}
add_shortcode('full', 'shortcode_full');

//half
function shortcode_half($atts, $content = null){
return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('half', 'shortcode_half');

//half last
function shortcode_half_last($atts, $content = null){
return '<div class="one_half last">' . do_shortcode($content) . '</div>';
}
add_shortcode('half_last', 'shortcode_half_last');

//one third
function shortcode_onethird($atts, $content=null){
return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'shortcode_onethird');

//one third last
function shortcode_onethird_last($atts, $content=null){
return '<div class="one_third last">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third_last', 'shortcode_onethird_last');

//one fourth
function shortcode_onefourth($atts, $content=null){
return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'shortcode_onefourth');

//one fourth last
function shortcode_onefourth_last($atts, $content=null){
return '<div class="one_fourth last">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth_last', 'shortcode_onefourth_last');

//two thirds
function shortcode_twothirds($atts, $content=null){
return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'shortcode_twothirds');

//three fourths
function shortcode_threefourths($atts, $content=null){
return '<div class="three_fourths">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'shortcode_threefourths');

//three fourths last 
function shortcode_threefourths_last($atts, $content=null){
return '<div class="three_fourths last">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths_last', 'shortcode_threefourths_last');

//one fifth 
function shortcode_onefifth($atts, $content=null){
return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'shortcode_onefifth');

//one fifth  last 
function shortcode_onefifth_last($atts, $content=null){
return '<div class="one_fifth last">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth_last', 'shortcode_onefifth_last');

//four fifths  
function shortcode_fourfifths($atts, $content=null){
return '<div class="four_fifths">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifths', 'shortcode_fourfifths');

//four fifths last
function shortcode_fourfifths_last($atts, $content=null){
return '<div class="four_fifths last">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifths_last', 'shortcode_fourfifths_last');

//break
function shortcode_break($atts, $content=null){
return '<div class="break clearfix">&nbsp;</div>';
}
add_shortcode('break', 'shortcode_break');

//divider
function shortcode_divider($atts, $content=null){
return '<div class="divider clearfix">&nbsp;</div>';
}
add_shortcode('divider', 'shortcode_divider');

//divider top
function shortcode_dividertop( $atts, $content = null ) {
return '<div class="totop"><div class="gototop"></div></div>';
}
add_shortcode('dividertop', 'shortcode_dividertop');

//ribbon red
function shortcode_ribbon_red($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));
return '<div class="ribbon"><div class="ribbon_left_red"></div><div class="ribbon_center_red"><a href ="'.$url.'">' .do_shortcode($content). '</a></div><div class="ribbon_right_red"></div></div>';
}
add_shortcode('ribbon_red', 'shortcode_ribbon_red');

//ribbon blue
function shortcode_ribbon_blue($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));
return '<div class="ribbon"><div class="ribbon_left_blue"></div><div class="ribbon_center_blue"><a href ="'.$url.'">' .do_shortcode($content). '</a></div><div class="ribbon_right_blue"></div></div>';
}
add_shortcode('ribbon_blue', 'shortcode_ribbon_blue');

//ribbon yellow
function shortcode_ribbon_yellow($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));
return '<div class="ribbon"><div class="ribbon_left_yellow"></div><div class="ribbon_center_yellow"><a href ="'.$url.'">' .do_shortcode($content). '</a></div><div class="ribbon_right_yellow"></div></div>';
}
add_shortcode('ribbon_yellow', 'shortcode_ribbon_yellow');

//ribbon green
function shortcode_ribbon_green($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));
return '<div class="ribbon"><div class="ribbon_left_green"></div><div class="ribbon_center_green"><a href ="'.$url.'">' .do_shortcode($content). '</a></div><div class="ribbon_right_green"></div></div>';
}
add_shortcode('ribbon_green', 'shortcode_ribbon_green');

//ribbon green
function shortcode_ribbon_white($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => ''
	), $atts));
return '<div class="ribbon"><div class="ribbon_left_white"></div><div class="ribbon_center_white"><a href ="'.$url.'">' .do_shortcode($content). '</a></div><div class="ribbon_right_white"></div></div>';
}
add_shortcode('ribbon_white', 'shortcode_ribbon_white');

//high light dark
function shortcode_highlight_black($atts, $content=null){
return '<span class="black" >' .$content. '</span>';
}
add_shortcode('highlight_black', 'shortcode_highlight_black');


//high light yellow
function shortcode_highlight_yellow($atts, $content=null){
return '<span class="yellow" >' .$content. '</span>';
}
add_shortcode('highlight_yellow', 'shortcode_highlight_yellow');


//high light blue
function shortcode_highlight_blue($atts, $content=null){
return '<span class="blue" >' .$content. '</span>';
}
add_shortcode('highlight_blue', 'shortcode_highlight_blue');


//high light green
function shortcode_highlight_green($atts, $content=null){
return '<span class="green" >' .$content. '</span>';
}
add_shortcode('highlight_green', 'shortcode_highlight_green');


//list arrow
function shortcode_list_arrow($atts, $content=null){
return '<ul class="arrow" >' .$content. '</ul>';
}
add_shortcode('list_arrow', 'shortcode_list_arrow');

//list arrow point
function shortcode_list_arrow_point($atts, $content=null){
return '<ul class="arrow_point" >' .$content. '</ul>';
}
add_shortcode('list_arrow_point', 'shortcode_list_arrow_point');

//list circle
function shortcode_list_circle($atts, $content=null){
return '<ul class="circle" >' .$content. '</ul>';
}
add_shortcode('list_circle', 'shortcode_list_circle');


//list tick
function shortcode_list_tick($atts, $content=null){
return '<ul class="ticklist" >' .$content. '</ul>';
}
add_shortcode('list_tick', 'shortcode_list_tick');

//list comment
function shortcode_list_comment($atts, $content=null){
return '<ul class="commentlistshort" >' .$content. '</ul>';
}
add_shortcode('list_comment', 'shortcode_list_comment');

//list mail
function shortcode_list_mail($atts, $content=null){
return '<ul class="maillist" >' .$content. '</ul>';
}
add_shortcode('list_mail', 'shortcode_list_mail');

//list plus
function shortcode_list_plus($atts, $content=null){
return '<ul class="pluslist" >' .$content. '</ul>';
}
add_shortcode('list_plus', 'shortcode_list_plus');

//list ribbon
function shortcode_list_ribbon($atts, $content=null){
return '<ul class="ribbonlist" >' .$content. '</ul>';
}
add_shortcode('list_ribbon', 'shortcode_list_ribbon');

//list settings
function shortcode_list_settings($atts, $content=null){
return '<ul class="settingslist" >' .$content. '</ul>';
}
add_shortcode('list_settings', 'shortcode_list_settings');

//list star
function shortcode_list_star($atts, $content=null){
return '<ul class="starlist" >' .$content. '</ul>';
}
add_shortcode('list_star', 'shortcode_list_star');

//list image
function shortcode_list_image($atts, $content=null){
return '<ul class="imagelist" >' .$content. '</ul>';
}
add_shortcode('list_image', 'shortcode_list_image');

//list link
function shortcode_list_link($atts, $content=null){
return '<ul class="linklist" >' .$content. '</ul>';
}
add_shortcode('list_link', 'shortcode_list_link');

//text
function shortcode_slogan ($atts, $content=null){
return '<span class="slogan" >' . do_shortcode($content) . '</span>';
}
add_shortcode('slogan', 'shortcode_slogan');

//dropcap
function shortcode_dropcap($atts, $content=null) {
return '<div class="dropcap">' .$content. '</div>';
}
add_shortcode('dropcap', 'shortcode_dropcap');

//button dark
function shortcode_button_dark($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"iconlink" =>''
	), $atts));
	$image = '';
	if($iconlink == '')
		$image = '';
	else
		$image = '<div class="iconbutton"><img src="'.$iconlink.'" /></div>';
return '<div class="buttonshort"><div class="buttondark">'.$image.'<div class="buttonleft"><a href="'.$url.'">'.do_shortcode($content).'</a></div></div></div>';
}
add_shortcode('button_dark', 'shortcode_button_dark');

//button blue
function shortcode_button_blue($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"iconlink" =>''
	), $atts));
	$image = '';
	if($iconlink == '')
		$image = '';
	else
		$image = '<div class="iconbutton"><img src="'.$iconlink.'" /></div>';
return '<div class="buttonshort"><div class="buttonblue">'.$image.'<div class="buttonleft"><a href="'.$url.'">'.do_shortcode($content).'</a></div></div></div>';
}
add_shortcode('button_blue', 'shortcode_button_blue');

//button green
function shortcode_button_green($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"iconlink" =>''
	), $atts));
	$image = '';
	if($iconlink == '')
		$image = '';
	else
		$image = '<div class="iconbutton"><img src="'.$iconlink.'" /></div>';
return '<div class="buttonshort"><div class="buttongreen">'.$image.'<div class="buttonleft"><a href="'.$url.'">'.do_shortcode($content).'</a></div></div></div>';
}
add_shortcode('button_green', 'shortcode_button_green');

//button pink
function shortcode_button_pink($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"iconlink" =>''
	), $atts));
	$image = '';
	if($iconlink == '')
		$image = '';
	else
		$image = '<div class="iconbutton"><img src="'.$iconlink.'" /></div>';
return '<div class="buttonshort"><div class="buttonpink">'.$image.'<div class="buttonleft"><a href="'.$url.'">'.do_shortcode($content).'</a></div></div></div>';
}
add_shortcode('button_pink', 'shortcode_button_pink');

//button yellow
function shortcode_button_yellow($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"iconlink" =>''
	), $atts));
	$image = '';
	if($iconlink == '')
		$image = '';
	else
		$image = '<div class="iconbutton"><img src="'.$iconlink.'" /></div>';
return '<div class="buttonshort"><div class="buttonyellow">'.$image.'<div class="buttonleft"><a href="'.$url.'">'.do_shortcode($content).'</a></div></div></div>';
}
add_shortcode('button_yellow', 'shortcode_button_yellow');

//button orange
function shortcode_button_orange($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"iconlink" =>''
	), $atts));
	$image = '';
	if($iconlink == '')
		$image = '';
	else
		$image = '<div class="iconbutton"><img src="'.$iconlink.'" /></div>';
return '<div class="buttonshort"><div class="buttonorange">'.$image.'<div class="buttonleft"><a href="'.$url.'">'.do_shortcode($content).'</a></div></div></div>';
}
add_shortcode('button_orange', 'shortcode_button_orange');



//button download
function shortcode_button_download($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"bottom_text"=>''
	), $atts));
return '<div class="button_download"><a href="'.$url.'"><div class="button_download_left"></div><div class="button_download_right"><div class="button_download_right_top">'.do_shortcode($content).'</div><div class="button_download_right_bottom">'.$bottom_text.'</div></div></a></div>';
}
add_shortcode('button_download', 'shortcode_button_download');

//button search
function shortcode_button_search_c($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"bottom_text"=>''
	), $atts));
return '<div class="button_search"><a href="'.$url.'"><div class="button_search_left"></div><div class="button_search_right"><div class="button_search_right_top">'.do_shortcode($content).'</div><div class="button_search_right_bottom">'.$bottom_text.'</div></div></a></div>';
}
add_shortcode('button_search_c', 'shortcode_button_search_c');//linefunction shortcode_line($atts, $content = null) {return '<div class="infotextBorderSingle short"></div>';}add_shortcode('line', 'shortcode_line');





?>