<?php
global $pmc_data; 
$use_bg = ''; $background = ''; $custom_bg = ''; $body_face = ''; $use_bg_header =''; $background_header = ''; $custom_bg_header = '';

if(isset($pmc_data['background_image'])) {
	$use_bg = $pmc_data['background_image'];
}


if(isset($pmc_data['background_image_header'])) {
	$use_bg_header = $pmc_data['background_image_header'];
}

if($use_bg) {

	$custom_bg = $pmc_data['body_bg_custom'];
	
	if(!empty($custom_bg)) {
		$bg_img = $custom_bg;
	} else {
		$bg_img = $pmc_data['body_bg'];
	}
	
	$bg_prop = $pmc_data['body_bg_properties'];
	
	$background = 'url('. $bg_img .') '.$bg_prop ;

}


if($use_bg_header) {

	$custom_bg_header = $pmc_data['header_bg_custom'];
	
	if(!empty($custom_bg)) {
		$bg_img_header = $custom_bg;
	} else {
		$bg_img_header = $pmc_data['header_bg'];
	}
	
	$bg_prop_header = $pmc_data['header_bg_properties'];
	
	$background_header = 'url('. $bg_img_header .') '.$bg_prop_header ;

}

function ieOpacity($opacityIn){
	
	$opacity = explode('.',$opacityIn);
	if($opacity[0] == 1)
		$opacity = 100;
	else
		$opacity = $opacity[1] * 10;
		
	return $opacity;
}

function HexToRGB($hex,$opacity) {
		$hex = ereg_replace("#", "", $hex);
		$color = array();
 
		if(strlen($hex) == 3) {
			$color['r'] = hexdec(substr($hex, 0, 1) . $r);
			$color['g'] = hexdec(substr($hex, 1, 1) . $g);
			$color['b'] = hexdec(substr($hex, 2, 1) . $b);
		}
		else if(strlen($hex) == 6) {
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
		}
 
		return 'rgba('.$color['r'] .','.$color['g'].','.$color['b'].','.$opacity.')';
	}
	


?>
#headerwrap{background:<?php echo $pmc_data['body_background_color'].' '.$background ?>  !important;}
body {	 
	background:<?php echo $pmc_data['body_background_color'].' '.$background ?>  !important;
	color:<?php echo $pmc_data['body_font']['color']; ?>;
	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;
	font-size: <?php echo $pmc_data['body_font']['size']; ?>;
	font-weight: normal;
	line-height: 1.65em;
	letter-spacing: normal;
}
#commentform #respond #commentform input#submit, #respond #commentform input#submit, #contactform .contactbutton .contact-button {font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif;}
h1,h2,h3,h4,h5,h6, .blogpostcategory .posted-date p, .team .title, .term-description p, .titleBottom{
	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['heading_font']['face'])))); ?> !important;
	<?php if(strpos($pmc_data['heading_font']['face'],'200')) {?>
		font-weight: 300;
	<?php } else { ?>
		font-weight: normal;
	<?php }  ?>
	line-height: 110%;
}

h1 { 	
	color:<?php echo $pmc_data['heading_font_h1']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h1']['size'] ?> !important;
	}
	
h2, .term-description p { 	
	color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h2']['size'] ?> !important;
	}

h3 { 	
	color:<?php echo $pmc_data['heading_font_h3']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h3']['size'] ?> !important;
	}

h4 { 	
	color:<?php echo $pmc_data['heading_font_h4']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h4']['size'] ?> !important;
	}	
	
h5 { 	
	color:<?php echo $pmc_data['heading_font_h5']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h5']['size'] ?> !important;
	}	

h6 { 	
	color:<?php echo $pmc_data['heading_font_h6']['color']; ?>;
	font-size: <?php echo $pmc_data['heading_font_h6']['size'] ?> !important;
	}	
h2.title a {color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;}
a, a:active, a:visited, .footer_widget .widget_links ul li a{color: <?php echo $pmc_data['body_link_coler']; ?>;}	
.widget_nav_menu ul li a  {color: <?php echo $pmc_data['body_link_coler']; ?>;}
a:hover, h2.title a:hover, .item3 h3:hover, .item4 h3:hover, .item3 h3 a:hover, #portitems2 h3 a:hover {color: <?php echo $pmc_data['mainColor']; ?>;}
.product-remove a:hover {color: <?php echo $pmc_data['mainColor']; ?> !important;}
.item3 h3, .item4 h3, .item3 h3 a, .item4 h3 a, .item3 h4, .item2 h4, .item4 h4, #portitems2 h3 a {color:<?php echo $pmc_data['heading_font_h3']['color']; ?>;}



/* ***********************
--------------------------------------
------------MENU----------
--------------------------------------
*********************** */

.menu li:hover ul {border-bottom: 5px solid <?php echo $pmc_data['mainColor']; ?>;}
.menu li ul li a, .item4 h4 a, #portitems2 .category a, .homeRacent .category a, .item3 h4 a, .homeRacent .productF h3.category, .homeRacent .productR h3.category, .widget_search form div input#keyword, .widget_product_search form div input#keyword
{	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important; }
.menu > li a {	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['menu_font'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif !important; color:#2e2d2d;letter-spacing: normal;}
.menu a span{ 	font-family: <?php echo str_replace("%20"," ",str_replace(":300"," ",str_replace(":200"," ",str_replace(":400"," ",$pmc_data['body_font']['face'])))); ?>, "Helvetica Neue", Arial, Helvetica, Verdana, sans-serif  !important; color:#aaa !important;letter-spacing: normal;}


.homeBox h2 a {color:<?php echo $pmc_data['heading_font_h2']['color']; ?>;}


.homeRacent h2 ,.advertise h2,.slider-category .anythingBase,#nslider img, .related h3, .projectdescription h3, .portsingle .portfolio h3, .titleborderh,
.socialsingle h2{
	background:<?php echo $pmc_data['body_background_color'].' '.$background  ?>  !important;
	}

 #footer, #slider-wrapper-iframe, #slider-wrapper  {background:#000!important;}



/* ***********************
--------------------------------------
------------MAIN COLOR----------
--------------------------------------
*********************** */

#footer .product_list_widget li del, #footer .widget del span, .footer_widget h3 span,.catlinkhover,.item h3 a:hover, .item2 h3 a:hover, .item4 h3 a:hover,.catlink:hover,.infotext span, .homeRacent h3 a:hover, .item4 h4 a:hover,.tags a:hover,
.blogpost .link:hover,.blogpost .postedin:hover ,.blogpost .postedin:hover, .blogpost .link a:hover,.blogpostcategory a.textlink:hover,
.footer_widget .widget_links ul li a:hover, .footer_widget .widget_categories  ul li a:hover,  .footer_widget .widget_archive  ul li a:hover,
#footerb .footernav ul li a:hover,.footer_widget  ul li a:hover,.tags span a:hover,.more-link:hover,
.menu li a:hover,.menu li a:hover strong, .menu li ul li:hover ul li:hover a,
.menu > li.current-menu-item a strong,.menu > li.current-menu-ancestor a strong, .blogpostcategory .posted-date a:hover, .blogpostcategory .blogmore, .navigation a, .comment-nav a,
.tags  a, .content ol.commentlist li .reply a, .commentsDate, .projectdescription .portnavigation .portprev a, .blogpost .datecomment .link a, .projectdescription .portnavigation .portnext a, .sentry a
{color:<?php echo $pmc_data['mainColor']; ?> !important;}

#commentform #respond #commentform input#submit, #respond #commentform input#submit, #contactform .contactbutton .contact-button,
.addthis_button_facebook img:hover, .addthis_button_twitter img:hover, .addthis_button_more img:hover, .emaillink img:hover, .gototop, #footer .widget_tag_cloud a:hover,
.comment-inside {background:<?php echo $pmc_data['mainColor']; ?>;}

.homeBox p, .content .sentry blockquote, .content.fullwidth blockquote, .content.pagesidebar blockquote, .blogpost .projectdescription .datecomment {border-color:<?php echo $pmc_data['mainColor']; ?>; }
::selection { background: <?php echo $pmc_data['mainColor']; ?> !important; color:#fff; text-shadow: none; }
.comment-inside:after {border-color: <?php echo $pmc_data['mainColor']; ?> <?php echo $pmc_data['mainColor']; ?> transparent  transparent;}

/* ***********************
--------------------------------------
------------RESPONSIVE MODE----------
--------------------------------------
*********************** */

<?php if($pmc_data['showresponsive'] ) { ?>

@media screen and (min-width:0px) and (max-width:1100px){
	.sidebarwrap,.iconrwrap{display:none;}
	}

@media screen and (min-width:0px) and (max-width:970px){

	 
	/*footer*/
	.footer_widget1{margin-top: 30px; }
	.homeRacent .overdefult, .item3 .overdefult, .item2 .overdefult {opacity:0 !important;}
	 
	#footer .socialcategory {margin-bottom:30px !important;}
	.footer_widget .widgett{margin:5px auto 15px auto !important; }
	#footerb .copyright{width:100% !important; text-align:center !important; font-size:12px;}
	.socialfooter .socialcategory{height:40px;margin: 0px 0 10px 0px; text-align: center;float: none;width: 180px;margin: 0 auto;}
	.footer_widget .category_posts .widgett, .footer_widget .recent_posts .widgett{float:none;}

	/*menu + header*/
	#logo {width:100%;float:left;position:relative;height:80px; }
	#mainwrap{top:0;}
	#header {float:left; }
	#logo {width:100%; }
	.infotext h2 {font-size:24px !important; line-height: 140%;}
	.current_page_ancestor, .current-menu-item{border:none !important; padding-top:10px !important;}
	.infotext h1 {text-align:center;}
	.pagenav{display:none !important;}
	.respMenu{display:block; z-index: 999; position: relative;margin-bottom: 20px;margin-top:120px !important;cursor:pointer; }	
	.respMenu select {height:50px;background:#fff;width:60%;cursor:pointer;  }
	
	.menu li, .widget_nav_menu .menu, .socialfooter{float:none !important;}
	.wrap{width: 94% !important; margin: 0 auto;}

	

	/*blog*/
	audio {width: 90%;}
	.blogpostcategory{width:98%; margin:20px auto; float:none;display: inline-block;}
	#slider-category .slider-item img {height:98% !important; width:100% !important;}
	.anythingBase .panel {background:none !important;}
	.portfolio .description{margin-top:10px;}
	.blogpostcategory iframe {width: 92.5% !important; height: auto;}
	.meta {float: left;width: 100%;}


	/*single*/
	.blogpost{width:98%; margin:0 auto;}
	.blogpost .author{margin-left:0px ;}
	.postcontent.singledefult {background:none; margin-bottom:20px;}
	.posttext img {width: 97%;}
	.posttext .image-gallery img {width:auto!important; height:auto !important; }
	.image-gallery, .gallery-item{float:none; display:inline-block;}


	/*comment*/
	#commentform #respond #commentform textarea, #commentform #respond #commentform input{width:100%;margin-left: 0; padding-right: 0; margin-right: 0; padding-left: 0;}
	#commentform{margin:0 auto;}
	.commentfield{float:none;}
	.commentlist .commenttext {width: 75%;text-align: left;padding:15px 10px 0 15px;}
	.comment-author{padding:0px 10px 0 0px;}


	/*general*/
	.recentimage .image{background:none !important;}
	body{text-align:center;}
	h1,h2,h3,h4,h5,h6{margin-left:0 !important; margin-right:0 !important;}
	img {height: auto; }
	
	/*text-align:left*/
	.singledefult h1, .singledefult h2, .singledefult h3,.blogpostcategory .meta,.blogpostcategory p,.singledefult .tags,.usercontent,.blogpostcategory .blogcontent,.singledefult .posttext,
	.projectdescription h2,.commentfield,.comment-author,.projectdescription  p,.recentdescription .description,.recentdescription .descrpiton,.date-inside,.logged-in-as
	{text-align:left !important;}
	
	/*padding:0*/
	.projectdetails .blogsingleimage,#commentform #respond,#main, .homeRacent .recentdescription, .footer_widget1, .footer_widget2, .footer_widget3, .footer_widget4,.projectdescription .posttext ,
	.projectdescription  p ,.projectdescription,.footer_widget .widgett,.footer_widget .widget_search form div
	{padding:0 !important;}	
	
	/*display:none*/
	 .menu li li ,#remove , .titleborder,.footernav, .closewrap,.sidebar,.related,.addthis_button_more,.editlink, .advertise, .homeRacent.SP,#footer .star-rating ,
	.totop, .loading, .outerpagewrap.error404,.bx-prev,.bx-next,.homeIcon,#nslider,#nslidert.homeRacent .category,.slider-wrapper, #nslider-wrapper, #slider-wrapper,.blogpostcategory .overdefultlink,
	.blogsingleimage .nextbutton.port, .blogsingleimage .prevbutton.port,.nivoSlidert,.relatedtitle,.portfolio .category, .blogsingleimage .nextbutton.port, .blogsingleimage .prevbutton.port{
		display:none !important;
	}

	/*display:100%*/
	#header,  #main ,#showpost,#footer  ,.homeRecent ,.homeBox .one_third,.homeRacent h3,.homeRacent,.homeRacent .one_half ,.totop, .infotext ,.infotextwrap, #footerinside, .one_half,.footernav,#footerb ,
	.footer_widget1, .footer_widget2, .footer_widget3, .footer_widget4,.pagecontent, .portfolio,.wp-pagenavi,.image ,.pagecontentContent,#portitems2 h3,.audioPlayer,#commentform,#respond,
	.one_fourth, .one_fifth,.three_fourths,.one_fourths,.two_thirds,.one_third,.team .social,.item3,.item4 ,.leftContentSP ,.rightContentSP, .imagesSPAll,.top-nav ,#respond #commentform input,
	#respond #commentform textarea ,.boxDescription,.footer_widget .widget_search form div,.infotext h1,.projectdetails #slider img,#portitems2 .one_half ,
	.projectdescription .posttext,.homeRacent .one_fourth,.pagecontentContent, object,.one_fourth,.bodywrapOut,.bodywrapIn, #logo img{
		width:100% !important;
	}
	#logo img {width:90% !important;margin-top:20px;margin-bottom:20px;}
	
	/*new*/
	body{font-size:16px !important;}
	.bodywrapOut,.bodywrapIn, .homeBox ,.footer_widget .widget_nav_menu, #logo ,.homeRecent ul, #mainwrap,.content,.blogpostcategory .blogmore,.errorpage .posttext,.homeRecent
	{border-left:none !important; border-right:none !important; border:none !important; padding:0 !important; margin:0 !important;}

	
	#logo{height:100%;}
	
	.image img,.overdefult,.homeRacent .recentimage, .blogimage img,.posttext img ,#portitems2 .image
	{  height: 100% !important;}
	.blogimage img{width:100% !important;}
	.homeRacent .recentimage, .item3 .recentimage {width:auto;-moz-box-shadow: none;-webkit-box-shadow:none; box-shadow:none; }
	.blogimage img, .posttext img{height:auto !important;}
	
	.descriptionHomePort {font-size:16px;}
	.descriptionHomePort p {text-align:left;}
	.blogpostcategory h2,h2,h1,.postcontent h1,.errorpage .postcontent h2,.singledefult h2,#commentform h3,.projectdescription h2{font-size:30px !important;}
	.tags{font-size:24px !important; margin-bottom:20px;}
	.blogsingleimage img, .audioPlayer, iframe{float:left; }
	.blogsingleimage iframe{width:100% !important; height:auto; padding:5px 0;}
	
	#commentform #respond #commentform input#submit, #respond #commentform input#submit { margin:0 !important;}
	
	/*new*/
	

	.borderLine {width:95% !important;}
	.borderLineRight{width:88% !important;}
	.borderLineLeft{width:10% !important;}
	.image .loading{text-align:center; width:100%;}
	.pagewrap{height:auto; padding-bottom:10px; margin-bottom:10px;}
	.posttext .blogsingleimage,.gallery-single {width:100%; text-align: center;}
	.blogsingleimage iframe{width: 98%;}
	.block .h2{font-size:14px !important;}


	/*port*/
	.portfolio h3, .portfolio h4{text-align:center !important; margin-top: 10px;}
	#portitems4{text-align:center;margin:0 auto;}
	.portfolio{margin: 0 auto; display: inline-block;}
	.portsingle .portfolio, .portsingleshare,.titleborderh{display:none !important;}
	.blogsingleimage .sentry img, .projectdetails .blogsingleimage,.projectdetails,.projectdescription ,.blogpost .datecomment {width: 100% !important;}
	.projectdescription { margin-bottom: 30px;}
	#portitems2 .recentdescription .description {padding:0px 10px 0 0px;}
	.item2 .image {background:#fff !important;}
	.item3{height:auto;}
	.blogpost .projectdescription .datecomment {width:90% !important;padding-left:10px;}
	
	/*page*/
	.fullwidth{margin-top:20px;}
	.page .socialsingle {padding-left:5px;}
	#slider img{float: left; }


	/*shortcode*/
	.one_half, .one_third, .two_thirds, .one_fourth, .three_fourths, .one_fifth, .two_fifth, .three_fifths, .four_fifths {margin-top:10px; margin-right:0px;}

	.question h3, .success h3, .info h3, .error h3 {line-height:120%;}


}

/*479*/
@media screen and (min-width:478px) and (max-width:970px){

	
	/*footer*/
	#footer .widget{width:99%; margin:2px;}
	.gototop {margin:-25px 0px 0px 90% !important}

	/*single*/
	.blogpost{width:98%; margin:0 auto 50px auto;}

	/*portfolio*/
	#portitems3  h3,#portitems3  h4{text-align:center !important;}
	#portitems2 .recentdescription {width:100% !important; min-height:125px;}


	/*port*/
	.one_half.item2{width:47% !important; float:left; margin-right:0; margin-left:2%;}
	.one_half.item2 img{width: 100%; height:150px;}
	#portitems2 .one_half{margin-right:0 !important}
	.item3{width:47% !important; float:left; margin-right:0; margin-left:2%;}
	.item3 img{width: 100%;}


	.homeRecent .one_third{width: 47.2% !important; float: left;padding-top:5px; margin-left:1%;}
	#portitems2 .one_half{width: 47.2% !important; float: left;padding-top:5px;  margin-left:1% !important}
	.homeRecent .one_third.last{display:none;}


}


@media screen and (min-width:481px) and (max-width:960px){

	 input, textarea{max-width:98% !important;}
}

@media screen and (max-width:515px){

	input, textarea{max-width:97% !important;}


	#slider-category, .blogFullWidth #slider-category {width: 92.5% !important;height:auto !important; padding-bottom:0px !important;}
	#slider-category img, .blogFullWidth #slider-category img {width: 100% !important; height:auto !important;	padding-bottom:0px !important;}
	#slider-category .anythingSlider, .blogFullWidth #slider-category .anythingSlider {	padding-bottom:5px !important;}

	/*single*/
	.singledefult .sentry,.singledefult .meta,#respond {width:100%;}
	.specificComment{margin:60px 0px 0px 0px;}
	.tags {margin-left:0; width:100%;}

}


@media screen and (max-width:599px){
	.top-nav ul{display:none;}
	.squareHolder{display:none !important;}	

	
}

@media screen and (max-width:479px){
	/*home recent port*/
	#sliderAdvertisePort .one_third{width:98% !important}

	

	/*footer*/
	#footer .widget{width:98%; margin-left:2px;}
	.gototop {margin:-25px 0px 0px 80% !important}


	/*blog*/
	.blogpostcategory .leftholder{display:none;}
	.blogpostcategory .meta {width:100%; margin:0 auto;}
	.blogpostcategory .blogmore{width: 100%;float: right !important;text-align: right;}
	.blogpostcategory .meta .socialsingle{width:50%;}
	.comment-author, .commentlist .commenttext{width:100% !important; text-align:center !important;padding:0px 10px 0 0px;}
	.commentlist .avatar {width:100%; float:none; background:none;}
	.squareHolder{display:none !important;}

	/*single*/
	.singledefult .socialsingle{padding-left:0; float:left;}





}

@media screen and (min-width:560px) and (max-width:970px){
	/*blog*/
	.link-category .blogpostcategory{margin:0 auto 50px auto;}
	.posttext {width:100%; margin:0 auto;}

	/*single*/
	#commentform {float:none}
	.commentlist,#commentform{width: 100%;text-align: center;margin: 20px auto !important;text-align:center;}
	form#commentform{width:100%;}
	.singledefult .blogpost{width:100% !important; margin:0 auto;}
	#respond{float:none;}

	/*comment*/

	#commentform{width:100%; margin:0 auto;}
	
	.homeBox .one_half{width:48% !important}
	.homeBox h3,.homeBox p{text-align:left;}

}

@media screen and (min-width:599px) and (max-width:960px){
	.homeRacent .one_third{width:48.2% !important; }
	.homeRacent .one_third.last{margin-right:1.4% }
}



@media screen and (min-width:700px) and (max-width:970px){
	.recentdescription .description {padding-left:20px !important;}
	#portitems2 .recentdescription {padding-left:0%;}
	.homeRacent.post .recentdescription{width:100%;}
	.blogpostcategory{width:600px; margin:0 auto 10px auto;}
}

@media screen and (min-width:700px) and (max-width:960px){
	/*home recent port*/
	.recentdescription .descrpiton {padding-right: 5px;}

}



@media screen and (min-width:768px){
	/*shortcode*/
	.one_half { width: 48% }
	.one_third { width: 30% }
	.two_thirds { width: 65.33% }
	.one_fourth { width: 22% ; }
	.three_fourths { width: 74% }
	.one_fifth { width: 16.8% }
	.four_fifths { width: 79.2% }
}


<?php } ?>

/* ***********************
--------------------------------------
------------CUSTOM CSS----------
--------------------------------------
*********************** */

<?php echo stripText($pmc_data['custom_style']) ?>