<?php

function optionsframework_admin_init() {
		// Rev up the Options Machine
		global $of_options_pmc, $pmc_options_machine;
		$pmc_options_machine = new Options_Machine($of_options_pmc);
		
	
		
				
	    //if reset is pressed->replace options with defaults
    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'optionsframework' ) {
		if (isset($_REQUEST['of_reset']) && 'reset' == $_REQUEST['of_reset']) {
			
			$nonce=$_POST['security'];
			if (!wp_verify_nonce($nonce, 'of_ajax_nonce') ) { 
				header('Location: themes.php?page=optionsframework&reset=error');
				die('Security Check'); 
			} else {
				$defaults = (array) $pmc_options_machine->Defaults;
				update_option(OPTIONS,$defaults);
				generate_options_css($defaults); //generate static css file
				header('Location: themes.php?page=optionsframework&reset=true');
				die($pmc_options_machine->Defaults);
			} 
		}
    }
}
add_action('admin_init','optionsframework_admin_init');
/*-----------------------------------------------------------------------------------*/
/* Options Framework Admin Interface - optionsframework_add_admin */
/*-----------------------------------------------------------------------------------*/
function optionsframework_add_admin() {
	
	if ( !is_plugin_active( 'page-builder-pmc/page-builder-pmc.php' ) ) {
		  //plugin is activated
		$of_page =			add_theme_page('Theme Options','Theme Options','edit_theme_options','optionsframework','optionsframework_options_page') ;
		// Add framework functionaily to the head individually
		add_action("admin_print_scripts-$of_page", 'of_load_only');
		add_action("admin_print_styles-$of_page",'of_style_only');
	} 
		
} 
add_action('admin_menu', 'optionsframework_add_admin');
function pmc_add_admin_bar(){
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array( 'id' => 'pmc_theme_options', 'parent' => 'appearance', 'title' => 'PMC Theme options', 'href' => admin_url('admin.php?page=optionsframework') ) );
	
}
add_action('admin_bar_menu', 'pmc_add_admin_bar', 1000);
/*-----------------------------------------------------------------------------------*/
/* Build the Options Page - optionsframework_options_page */
/*-----------------------------------------------------------------------------------*/
function optionsframework_options_page(){
global $pmc_options_machine;
	/*
	//for debugging
	$pmc_data = get_option(OPTIONS);
	print_r($pmc_data);
	*/	
?>
<div class="wrap" id="of_container">
  <div id="of-popup-save" class="of-save-popup">
    <div class="of-save-save">Options Updated</div>
  </div>
  <div id="of-popup-reset" class="of-save-popup">
    <div class="of-save-reset">Options Reset</div>
  </div>
   <div id="of-popup-fail" class="of-save-popup">
    <div class="of-save-fail">Error!</div>
  </div>
    <div id="header">
      <div class="logo">
        <h2></h2> 
      </div>
	  <div id="js-warning">Warning- This options panel will not work properly without javascript!</div>
      <div class="fa fa-option"> </div>
      <div class="clear"></div>
    </div>
	<div class="pmc-licence">
		<?php
		if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
			include( dirname(dirname( __FILE__ )) . '/updater/theme-updater-admin.php' );
		}

		// Loads the updater classes
		$updater = new EDD_Theme_Updater_Admin(

			// Config settings
			//$my_theme = wp_get_theme();
			$config = array(
				'remote_api_url' => 'https://premiumcoding.com/', // Site where EDD is hosted
				'item_name' => 'Studio', // Name of theme
				'theme_slug' => 'studio', // Theme slug
				'version' => wp_get_theme()->get( 'Version' ), // The current version of this theme
				'author' => 'PremiumCoding', // The author of this theme
				'download_id' => '', // Optional, used for generating a license renewal link
				'renew_url' => '' // Optional, allows for a custom license renewal link
			),

			// Strings
			$strings = array(
				'theme-license' => __( 'Theme License', 'pmc-themes' ),
				'enter-key' => __( 'Enter your theme license key.', 'pmc-themes' ),
				'license-key' => __( 'License Key', 'pmc-themes' ),
				'license-action' => __( 'License Action', 'pmc-themes' ),
				'deactivate-license' => __( 'Deactivate License', 'pmc-themes' ),
				'activate-license' => __( 'Activate License', 'pmc-themes' ),
				'status-unknown' => __( 'License status is unknown.', 'pmc-themes' ),
				'renew' => __( 'Renew?', 'pmc-themes' ),
				'unlimited' => __( 'unlimited', 'pmc-themes' ),
				'license-key-is-active' => __( 'License key is active.', 'pmc-themes' ),
				'expires%s' => __( 'Expires %s.', 'pmc-themes' ),
				'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'pmc-themes' ),
				'license-key-expired-%s' => __( 'License key expired %s.', 'pmc-themes' ),
				'license-key-expired' => __( 'License key has expired.', 'pmc-themes' ),
				'license-keys-do-not-match' => __( 'License keys do not match.', 'pmc-themes' ),
				'license-is-inactive' => __( 'License is inactive.', 'pmc-themes' ),
				'license-key-is-disabled' => __( 'License key is disabled.', 'pmc-themes' ),
				'site-is-inactive' => __( 'Site is inactive.', 'pmc-themes' ),
				'license-status-unknown' => __( 'License status is unknown.', 'pmc-themes' ),
				'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'pmc-themes' ),
				'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'pmc-themes' )
			)

		);		
		$updater ->license_page(); ?>		
	</div>  	
	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >	
	<div id="info_bar"> 
	<a><div id="expand_options" class="expand">Expand</div></a>
    <img style="display:none" src="<?php echo ADMIN_DIR; ?>images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
    <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />	
	<button id ="of_save" type="button" class="button-primary">Save All Changes</button>
	</div><!--.info_bar--> 	
	
    <div id="main">
      <div id="of-nav">
        <ul>
          <?php echo $pmc_options_machine->Menu ?>
			<li class="import"><a title="Import" href="#import">Import</a></li>
			
			
        </ul>
      </div>
      <div id="content"> <?php echo $pmc_options_machine->Inputs /* Settings */ ?> 
		<div class="group" id="import"><h2>Import</h2>
				<div class = "pmc-importer-notes">
					<h4>IMPORTANT - READ FIRST</h4>
				</div>
					<ol>
						<li>We recommend you run our import on a clean WordPress installation to avoid unnecessary complications.</li>
						 <li>All of your posts and pages will be deleted, so use this only on clean install !!!!</li>
						<li>To reset your installation we recommend the following plugin: <a href="http://wordpress.org/plugins/wordpress-database-reset/">Wordpress Database Reset</a></li>
						<li>Never run the importer more then once as it will result in extra (double) content.</li>
						<li>If you have any doubts whether you should run importer or not, do not hesitate to <a target="_blank" href = "https://premiumcoding.zendesk.com/anonymous_requests/new">contact us.</a></li>
					</ol>
			<a class="import">Import Demo</a>
		</div>	  
	</div> 
      <div class="clear"></div>
	 
    </div>
	<div class="save_bar"> 
    <img style="display:none" src="<?php echo ADMIN_DIR; ?>images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
    <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />
	<input type="hidden" name="of_reset" value="reset" />
	
	<button id ="of_save" type="submit" class="button-primary">Save All Changes</button>
	<button id ="of_reset" type="submit" class="button submit-button reset-button" >Options Reset</button>
	</div><!--.save_bar--> 
 
  </form>
 
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div><!--wrap-->
<?php
}
/*-----------------------------------------------------------------------------------*/
/* Load required styles for Options Page - of_style_only */
/*-----------------------------------------------------------------------------------*/
function of_style_only(){
	wp_enqueue_style('admin-style', ADMIN_DIR . 'admin-style.css');
	wp_enqueue_style('color-picker', ADMIN_DIR . 'css/colorpicker.css');
}	
/*-----------------------------------------------------------------------------------*/
/* Load required javascripts for Options Page - of_load_only */
/*-----------------------------------------------------------------------------------*/
function of_load_only() {
	add_action('admin_head', 'of_admin_head');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_register_script('jquery-input-mask', ADMIN_DIR .'js/jquery.maskedinput-1.2.2.js', array( 'jquery' ));
	wp_enqueue_script('jquery-input-mask');
	wp_enqueue_script('color-picker-pmc', ADMIN_DIR .'js/colorpicker.js', array('jquery'));
	wp_enqueue_script('ajaxupload', ADMIN_DIR .'js/ajaxupload.js', array('jquery'));

	
		// Registers custom scripts for the Media Library AJAX uploader.
}
function of_admin_head() { 
			
	global $pmc_data; ?>
		
	<script type="text/javascript" language="javascript">
	jQuery.noConflict();
	jQuery(document).ready(function($){
	//delays until AjaxUpload is finished loading
	//fixes bug in Safari and Mac Chrome
	if (typeof AjaxUpload != 'function') { 
			return ++counter < 6 && window.setTimeout(init, counter * 500);
	}
	//hides warning if js is enabled			
	$('#js-warning').hide();
	
	//Tabify Options			
	$('.group').hide();
	
	// Display last current tab	

	// Display last current tab	
	<?php  if(isset($_GET["import"]) && $_GET["import"] == 'false'){   ?>
		$('.group:last').fadeIn();	
		$('#of-nav li:last').addClass('current');
	<?php } elseif (isset($_GET["import"]) && $_GET["import"] == 'finished'){ ?>	
		$('.group:first').fadeIn();	
		$('#of-nav li:first').addClass('current');	
	<?php } else { ?>	
		$('.group:first').fadeIn();	
		$('#of-nav li:first').addClass('current');
	<?php }  ?>		

				
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
           			$(this).removeClass('hidden');
           			return false;
           		}
				$(this).filter('.hidden').removeClass('hidden');
		});
    });
           					
	$('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		// event.preventDefault();
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		} else {
			$(this).parent().parent().parent().nextAll().each( 
				function(){
           			if ($(this).filter('.last').length) {
           				$(this).addClass('hidden');
						return false;
           			}
           			$(this).addClass('hidden');
           		});
           					
		}
	}
	
	//Current Menu Class/*
	$('#of-nav li a').click(function(evt){

				
		$('#of-nav li').removeClass('current');
		$(this).parent().addClass('current');
							
		var clicked_group = $(this).attr('href');
			
		$('.group').hide();
							
		$(clicked_group).fadeIn();
		return false;
						
	});
	//Expand Options 
	var flip = 0;
				
	$('#expand_options').click(function(){
		if(flip == 0){
			flip = 1;
			$('#of_container #of-nav').hide();
			$('#of_container #content').width(755);
			$('#of_container .group').add('#of_container .group h2').show();
	
			$(this).removeClass('expand');
			$(this).addClass('close');
			$(this).text('Close');
					
		} else {
			flip = 0;
			$('#of_container #of-nav').show();
			$('#of_container #content').width(595);
			$('#of_container .group').add('#of_container .group h2').hide();
			$('#of_container .group:first').show();
			$('#of_container #of-nav li').removeClass('current');
			$('#of_container #of-nav li:first').addClass('current');
					
			$(this).removeClass('close');
			$(this).addClass('expand');
			$(this).text('Expand');
				
		}
			
	});
	// Reset Message Popup
	var reset = "<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>";
				
	if ( reset.length ){
		if ( reset == 'true') {
			var message_popup = $('#of-popup-reset');
		} else {
			var message_popup = $('#of-popup-fail');
	}
		message_popup.fadeIn();
		window.setTimeout(function(){
	    message_popup.fadeOut();                        
		}, 2000);	
	}
	
	//Update Message popup
	$.fn.center = function () {
		this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
		this.css("left", 250 );
		return this;
	}
		
			
	$('#of-popup-save').center();
	$('#of-popup-reset').center();
	$('#of-popup-fail').center();
			
	$(window).scroll(function() { 
		$('#of-popup-save').center();
		$('#of-popup-reset').center();
		$('#of-popup-fail').center();
	});
			
	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();
	
	// COLOR Picker			
	$('.colorSelector').each(function(){
		var Othis = this; //cache a copy of the this variable for use inside nested function
			
			$(this).ColorPicker({
				color: '<?php if(isset($color)) echo $color; ?>',
				onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					$(Othis).children('div').css('backgroundColor', '#' + hex);
					$(Othis).next('input').attr('value','#' + hex);
					
				}
		});
			  
	}); 
	//end color picker
	//AJAX Upload
	function of_image_upload() {
	$('.image_upload_button').each(function(){
			
	var clickedObject = $(this);
	var clickedID = $(this).attr('id');	
			
	var nonce = $('#security').val();
			
	new AjaxUpload(clickedID, {
		action: ajaxurl,
		name: clickedID, // File upload name
		data: { // Additional data to send
			action: 'of_ajax_post_action',
			type: 'upload',
			security: nonce,
			data: clickedID },
		autoSubmit: true, // Submit file after selection
		responseType: false,
		onChange: function(file, extension){},
		onSubmit: function(file, extension){
			clickedObject.text('Uploading'); // change button text, when user selects file	
			this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
			interval = window.setInterval(function(){
				var text = clickedObject.text();
				if (text.length < 13){	clickedObject.text(text + '.'); }
				else { clickedObject.text('Uploading'); } 
				}, 200);
		},
		onComplete: function(file, response) {
			window.clearInterval(interval);
			clickedObject.text('Upload Image');	
			this.enable(); // enable upload button
				
	
			// If nonce fails
			if(response==-1){
				var fail_popup = $('#of-popup-fail');
				fail_popup.fadeIn();
				window.setTimeout(function(){
				fail_popup.fadeOut();                        
				}, 2000);
			}				
					
			// If there was an error
			else if(response.search('Upload Error') > -1){
				var buildReturn = '<span class="upload-error">' + response + '</span>';
				$(".upload-error").remove();
				clickedObject.parent().after(buildReturn);
				
				}
			else{
				var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';
				$(".upload-error").remove();
				$("#image_" + clickedID).remove();	
				clickedObject.parent().after(buildReturn);
				$('img#image_'+clickedID).fadeIn();
				clickedObject.next('span').fadeIn();
				clickedObject.parent().prev('input').val(response);
			}
		}
	});
			
	});
	
	}
	
	of_image_upload();
			
	//AJAX Remove (clear option value)
	$('.image_reset_button').live('click', function(){
	
		var clickedObject = $(this);
		var clickedID = $(this).attr('id');
		var theID = $(this).attr('title');	
				
		var nonce = $('#security').val();
	
		var data = {
			action: 'of_ajax_post_action',
			type: 'image_reset',
			security: nonce,
			data: theID
		};
					
		$.post(ajaxurl, data, function(response) {
						
			//check nonce
			if(response==-1){ //failed
							
				var fail_popup = $('#of-popup-fail');
				fail_popup.fadeIn();
				window.setTimeout(function(){
					fail_popup.fadeOut();                        
				}, 2000);
			}
						
			else {
						
				var image_to_remove = $('#image_' + theID);
				var button_to_hide = $('#reset_' + theID);
				image_to_remove.fadeOut(500,function(){ $(this).remove(); });
				button_to_hide.fadeOut();
				clickedObject.parent().prev('input').val('');
			}
						
						
		});
					
	}); 
	/* Style Select */
	
	(function ($) {
	styleSelect = {
		init: function () {
		$('.select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
		$('.select').live('change', function () {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		}); 
		}
	};
	$(document).ready(function () {
		styleSelect.init()
	})
	})(jQuery);
	
	
	//----------------------------------------------------------------*/
	// Aquagraphite SliderSlider MOD
	//----------------------------------------------------------------*/
	/* Slider Interface */	
	
		//Hide (Collapse) the toggle containers on load
		$(".slide_body").hide(); 
	
		//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
		$(".slide_edit_button").live( 'click', function(){
			$(this).parent().toggleClass("active").next().slideToggle("fast");
			return false; //Prevent the browser jump to the link anchor
		});	
		
		// Update slide title upon typing		
		function update_slider_title(e) {
			var element = e;
			if ( this.timer ) {
				clearTimeout( element.timer );
			}
			this.timer = setTimeout( function() {
				$(element).parent().prev().find('strong').text( element.value );
			}, 100);
			return true;
		}
		
		$('.of-slider-title').live('keyup', function(){
			update_slider_title(this);
		});
		
	
	/* Remove individual slide */
	
		$('.slide_delete_button').live('click', function(){
		// event.preventDefault();
		var agree = confirm("Are you sure you wish to delete this slide?");
			if (agree) {
				var $trash = $(this).parents('li');
				//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
				$trash.remove();
				return false; //Prevent the browser jump to the link anchor
			} else {
			return false;
			}	
		});
	
	/* Add new slide */
	
	$(".slide_add_button").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		
		var newNum = maxNum + 1;
		var iconid =sliderId+1;
		
		slidesContainer.append('<li><div class="slide_header"><strong>Client ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button image_upload_button" id="' + sliderId + '_' + newNum + '" rel="'+sliderInt+'">Upload</span><span class="button image_reset_button" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="' + sliderId + '_' + newNum + '"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>');
		of_image_upload(); // re-initialise upload image..
		return false; //prevent jumps, as always..
	});	
	
	
	$(".slide_add_button_social").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		
		var newNum = maxNum + 1;
		
		slidesContainer.append('<li><div class="slide_header"><strong>Social Icons ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Social alt text</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Icon <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome icon</a>. Only put icon name "fa-facebook-official" </label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="' + sliderId + '_' + newNum + '"></div><label>Link URL </label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>');
		of_image_upload(); // re-initialise upload image..
		return false; //prevent jumps, as always..
	});				
	
	$(".slide_add_button_menu").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		
		var newNum = maxNum + 1;
		
		slidesContainer.append('<li><div class="slide_header"><strong>Add custom Menu ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Menu name</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>');
		of_image_upload(); // re-initialise upload image..
		return false; //prevent jumps, as always..
	});	
	
	$(".slide_add_button_sidebar").live('click', function(){		
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		var sliderInt = $('#'+sliderId).attr('rel');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		
		var newNum = maxNum + 1;
		
		slidesContainer.append('<li><div class="slide_header"><strong>Add custom Sidebar ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Sidebar name</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>');
		of_image_upload(); // re-initialise upload image..
		return false; //prevent jumps, as always..
	});		
		
	
	
	// Sort Slides
	jQuery('.slider').find('ul').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).sortable({
			placeholder: "placeholder",
			opacity: 0.6
		});	
	});
	
	/*----------------------------------------------------------------*/
	/*	Aquagraphite Sorter MOD
	/*----------------------------------------------------------------*/
	jQuery('.sorter').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				$(this).find('.position').each( function() {
				
					var listID = $(this).parent().attr('id');
					var parentID = $(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = $(this).parent().parent().parent().attr('id');
					$(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');
					
				});
			}
		});	
	});	
	
	
	/* save everything */
	$('#of_save').live('click',function() {
			
		var nonce = $('#security').val();
					
		$('.ajax-loading-img').fadeIn();
										
		var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();
										
		//alert(serializedReturn);
						
		var data = {
			<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'optionsframework'){ ?>
			type: 'save',
			<?php } ?>
			action: 'of_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
						
			if (response==1) {
				success.fadeIn();
			} else { 
				alert(response);
				fail.fadeIn();
			}
						
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});
			
	return false; 
					
	});   
	<?php  if(isset($_GET["import"]) && $_GET["import"] == 'true'){   ?>
		$('#of_save').click();
		window.location.href = "<?php echo admin_url( 'themes.php?page=optionsframework&import=finished' ) ?>";
	<?php } ?>
	
	<?php  if(isset($_GET["import"]) && $_GET["import"] == 'false'){   ?>
		$('#of_save').click();
	<?php } ?>	
	
	$('#import .import').live('click', function(){
		window.location.href = "<?php echo admin_url( 'themes.php?page=optionsframework&import=start' ) ?>";
	});
	/**	Ajax Backup & Restore MOD */
	//backup button
	$('#of_backup_button').live('click', function(){
		var answer = confirm("Click OK to backup your current saved options.")
		if (answer){
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
			var nonce = $('#security').val();
			var data = {
				action: 'of_ajax_post_action',
				type: 'backup_options',
				security: nonce
			};
			$.post(ajaxurl, data, function(response) {
				//check nonce
				if(response==-1){ //failed
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
				else {
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}
			});
		}
	return false;
	}); 
	//restore button
	$('#of_restore_button').live('click', function(){
		var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")
		if (answer){
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
			var nonce = $('#security').val();
			var data = {
				action: 'of_ajax_post_action',
				type: 'restore_options',
				security: nonce
			};
			$.post(ajaxurl, data, function(response) {
				//check nonce
				if(response==-1){ //failed
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
				else {
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}	
			});
		}
	return false;
	});
	/**	Ajax Transfer (Import/Export) Option */
	$('#of_import_button').live('click', function(){
		var answer = confirm("Click OK to import options.")
		if (answer){
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
			var nonce = $('#security').val();
			var import_data = $('#export_data').val();
			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
				security: nonce,
				data: import_data
			};
			$.post(ajaxurl, data, function(response) {
				var fail_popup = $('#of-popup-fail');
				var success_popup = $('#of-popup-save');
				//check nonce
				if(response==-1){ //failed
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}		
				else 
				{
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}
			});
		}
	return false;
	});	
			
	//confirm reset			
	$('#of_reset').click(function() {
		var answer = confirm("Click OK to reset. All settings will be lost!")
		if (answer){ 	return true; } else { return false; }
});
			
						
	
}); //end doc ready
</script>
<?php }
/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action - of_ajax_callback */
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');
function of_ajax_callback() {
	global $pmc_options_machine;
	$nonce=$_POST['security'];
	
	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1'); 
			
	//get options array from db
	$all = get_option(OPTIONS);
		
	$save_type = $_POST['type'];
	
	//Uploads
	if($save_type == 'upload'){
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9@._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		 
			$upload_tracking[] = $clickedID;
				
			//update $options array w/ image URL			  
			$upload_image = $all; //preserve current data
			
			$upload_image[$clickedID] = $uploaded_file['url'];
			
			update_option(OPTIONS, $upload_image ) ;
		
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
		 
	}
	elseif($save_type == 'image_reset'){
			
			$id = $_POST['data']; // Acts as the name
			
			$delete_image = $all; //preserve rest of data
			$delete_image[$id] = ''; //update array key with empty value	 
			update_option(OPTIONS, $delete_image ) ;
	
	}	
	
	/*----------------------------------------------------------------*/
	/*	Aquagraphite Backup & Restore MOD
	/*----------------------------------------------------------------*/
	elseif($save_type == 'backup_options')
	{
		$backup = $all;
		$backup['backup_log'] = date('r');
		update_option(BACKUPS, $backup ) ;
		die('1'); 
	}
	elseif($save_type == 'restore_options')
	{
		$pmc_data = get_option(BACKUPS);
		update_option(OPTIONS, $pmc_data);
		die('1'); 
	}
	elseif($save_type == 'import_options'){
		$pmc_data = $_POST['data'];
		$pmc_data = unserialize(base64_decode($pmc_data)); //100% safe - ignore theme check nag
		update_option(OPTIONS, $pmc_data);
		die('1'); 
	}
	
	elseif ($save_type == 'save') {
		
		parse_str($_POST['data'], $pmc_data);
		unset($pmc_data['security']);
		unset($pmc_data['of_save']);
		parse_str($_POST['data']);
		update_option(OPTIONS, $pmc_data);
		generate_options_css($pmc_data); //generate static css file
		die('1');
		
	} 
	elseif ($save_type == 'reset') {
		update_option(OPTIONS,$pmc_options_machine->Defaults);
        die(1); //options reset
        
	}
  die();
}
/*-----------------------------------------------------------------------------------*/
/* Class that Generates The Options Within the Panel - optionsframework_machine */
/*-----------------------------------------------------------------------------------*/
class Options_Machine {
function __construct($options) {
	
	$return = $this->optionsframework_machine($options);
	
	$this->Inputs = $return[0];
	$this->Menu = $return[1];
	$this->Defaults = $return[2];
	
}
/*-----------------------------------------------------------------------------------*/
/* Generates The Options Within the Panel - optionsframework_machine */
/*-----------------------------------------------------------------------------------*/
public static function optionsframework_machine($options) {
    $pmc_data = get_option(OPTIONS);
	
  if(isset($_GET["import"]) && $_GET["import"] == 'start'){   
		/*import setup*/
		defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );
		if(!defined('PMC_PATH')) define( 'PMC_PATH', plugin_dir_path(__FILE__) );
		global $wpdb;
		
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		
		if ( ! class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) ) {
				include $class_wp_importer;
			}
		}
		
		if ( ! class_exists('PMC_import_WP') ) { 
			$class_wp_import = PMC_PATH . 'import/plugins/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) ) {
				include $class_wp_import;

			}
		}
		
		$class_widget_import = PMC_PATH . 'import/plugins/class-widget-data.php';
		if ( file_exists( $class_widget_import ) ) {
			include $class_widget_import;
		}		
			
		


		/*import xml*/

		$importer = new PMC_import_WP();
		
		
		
		$theme_xml = PMC_PATH . 'import/studio.gz';
						
		if ( file_exists( $class_wp_importer ) ) {
								
			$importer->fetch_attachments = true;
			ob_start();
			$importer->import($theme_xml);
			ob_end_clean();					
			
		}
		
		$homepage 	= get_page_by_title( 'Home' );
		
		if( isset($homepage->ID) ) {
			update_option('show_on_front', 'page');
			update_option('page_on_front',  $homepage->ID); // Front Page
		}		

		$locations = get_theme_mod( 'nav_menu_locations' ); 
		$menus = wp_get_nav_menus(); 
		
		if( is_array($menus) ) {

			foreach($menus as $menu) { // assign menus to theme locations
			
				$menu_items = wp_get_nav_menu_object($menu->term_id);		
				
				switch($menu_items->name){
					case 'Main menu':
						$locations['resp_menu'] = $menu->term_id;
						$locations['main-menu'] = $menu->term_id;									
						break;																	
				}				
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations );		

				


		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure('/%postname%/');
		$wp_rewrite->flush_rules();				
		
		/*widgets*/
		$file_widget = PMC_PATH . '/import/widget.json';
		$class_widget_import = new Widget_Data_PMC();
		$class_widget_import->ajax_import_widget_data($file_widget);
	wp_redirect( admin_url( 'themes.php?page=optionsframework&import=true' ) );
	} 		
	
	$defaults = array();   
    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {
	   
	   
		$counter++;
		$val = '';
		if(isset($value['id'])){
			//create array of defaults		
			if ($value['type'] == 'multicheck'){
				if (is_array($value['std'])){
					foreach($value['std'] as $i=>$key){
						$defaults[$value['id']][$key] = true;
					}
				} else {
						$defaults[$value['id']][$value['std']] = true;
				}
			} else {
				if (isset($value['id'])) {
					$defaults[$value['id']] = $value['std'];
				}
			}
		}
		
		//Start Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class = ''; 
			$onclick ='';
			if(isset( $value['class'] )) { $class = $value['class']; }
			if(isset( $value['onclick'] )) { $onclick = $value['onclick']; }
			
			if($value['type'] != "innerheading"){
				$output .= '<div class="section section-'.$value['type'].' '. $class .'" onclick = "'.$onclick .'">'."\n";
				$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
			}
			if($value['type'] == "innerheading"){
			
				$output .= '<div  class="section section-'.$value['type'].' '. $class .'" onclick = "'.$onclick .'">'."\n";
				$output .= '<h1>'. $value['name'] .'</h1>'."\n";
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
			}
		 } 
		 
		 //End Heading
		                                 
		switch ( $value['type'] ) {
		case 'innerheading':
			$output .= '<h2 style="margin:10px 0 0 0 !important;">'. $value['name'] .'</h2>';
		break;			
		
		case 'text':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				$textvalue = str_replace('\\','',$pmc_data[$value['id']]) ;
				$output .= '<input class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $textvalue .'" />';
			
		break;		
		case 'select':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}		
				$output .= '<div class="select_wrapper">';
				$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
				foreach ($value['options'] as $option) {			
					$output .= '<option value="'.$option.'" ' . selected($pmc_data[$value['id']], $option, false) . ' />'.$option.'</option>';	 
				 } 
				 $output .= '</select></div>';
			 
		break;
		case 'select2':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				$output .= '<div class="select_wrapper mini">';
				$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
				foreach ($value['options'] as $option=>$name) {
					$output .= '<option value="'.$option.'" ' . selected($pmc_data[$value['id']], $option, false) . ' />'.$name.'</option>';
				 } 
				$output .= '</select></div>';
			
		break;
		case 'select3':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
								
				global $post;				
				$args = array( 'numberposts' => -1,'post_type' => 'template');				
				$posts = get_posts($args);
				$output .= '<div class="select_wrapper">';
				$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'" >';
				foreach( $posts as $post) {
					setup_postdata($post);
					$output .= '<option value="'.get_the_id().'" ' . selected($pmc_data[$value['id']], get_the_id(), false) . ' />'.get_the_title().'</option>';
				 } 
				$output .= '</select></div>';
			
		break;		
		
		case 'textarea':	
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}	
				$cols = '8';
				$ta_value = '';
				
				if(isset($value['options'])){
						$ta_options = $value['options'];
						if(isset($ta_options['cols'])){
						$cols = $ta_options['cols'];
						} 
					}
					
					$ta_value = str_replace('\\','',$pmc_data[$value['id']]);			
					$output .= '<textarea class="of-input" name="'.$value['id'].'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';		
			
		break;
		case "radio":
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}	
				 foreach($value['options'] as $option=>$name) {
					$output .= '<input class="of-input of-radio" name="'.$value['id'].'" type="radio" value="'.$option.'" ' . checked($pmc_data[$value['id']], $option, false) . ' />'.$name.'<br/>';				
				}	 
			
		break;
		case "slidercategory":
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}		
					$category = '';
					$output .= '<div class="select_wrapper">';
					$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'] .'">';
					$categories = get_terms("sliderocategory");
						$output .= '<option value="0" ' . selected($pmc_data[$value['id']], $category->term_id, false) . ' />None</option>';
					foreach ($categories as $category) {					
						$output .= '<option value="'.$category->term_id.'" ' . selected($pmc_data[$value['id']], $category->term_id, false) . ' />'.$category->name.'</option>';
					 } 
					$output .= '</select></div>' ;
				//$output .= wp_dropdown_categories('show_option_all=Show all&hierarchical=2&name='.$value["id"].'&taxonomy=sliderocategory&selected='.selected($pmc_data[$value["id"]], $option, false).''); 				
			
		break;		
		
		case 'checkbox':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				
				$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'" id="'. $value['id'] .'" value="1" '. checked($pmc_data[$value['id']], true, false) .' />';
			
		break;
		case 'multicheck': 
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}	
				$multi_stored = $pmc_data[$value['id']];
							
				foreach ($value['options'] as $key => $option) {
					if (!isset($multi_stored[$key])) {$multi_stored[$key] = '';}
					$of_key_string = $value['id'] . '_' . $key;
					$output .= '<input type="checkbox" class="checkbox of-input" name="'.$value['id'].'['.$key.']'.'" id="'. $of_key_string .'" value="1" '. checked($multi_stored[$key], 1, false) .' /><label for="'. $of_key_string .'">'. $option .'</label><br />';								
				}	
			
		break;
		case 'upload':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				if(!isset($value['mod'])) $value['mod'] = '';
				$output .= Options_Machine::optionsframework_uploader_function($value['id'],$value['std'],$value['mod']);			
			
		break;
		case 'slider':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}	
				$_id = strip_tags( strtolower($value['id']) );
				$int = '';
				$int =  $_id ;
				$output .= '<div class="slider"><ul id="'.$value['id'].'" rel="'.$int.'">';
				$slides = $pmc_data[$value['id']];
				$count = count($slides);
				if ($count < 2) {
					$oldorder = 1;
					$order = 1;
					$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int,$value['social'],$value['menu'],$value['sidebar']);
				} else {
					$i = 0;
					foreach ($slides as $slide) {
						if(isset( $slide['order']))
							$oldorder = $slide['order'];
						else
							$oldorder =0;
						$i++;
						$order = $i;
						$output .= Options_Machine::optionsframework_slider_function($value['id'],$value['std'],$oldorder,$order,$int,$value['social'],$value['menu'],$value['sidebar']);
					}
				}			
				$output .= '</ul>';		
				if(!$value['social'] and !$value['menu'] and !$value['sidebar']){
				$output .= '<a href="#" class="button slide_add_button">Add New Client</a></div>';			
				}			
				if($value['social']){
				$output .= '<a href="#" class="button slide_add_button_social">Add New Social Icon</a></div>';			
				}			
				if($value['menu']){
				$output .= '<a href="#" class="button slide_add_button_menu">Add New Menu</a></div>';			
				}					
				if($value['sidebar']){
				$output .= '<a href="#" class="button slide_add_button_sidebar">Add New Sidebar</a></div>';			
				}			
			
		break;
		case 'sorter':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				$sortlists = $pmc_data[$value['id']];
				
				$output .= '<div id="'.$value['id'].'" class="sorter">';
				
				
				if ($sortlists) {
				
					foreach ($sortlists as $group=>$sortlist) {
					
						$output .= '<ul id="'.$value['id'].'_'.$group.'" class="sortlist_'.$value['id'].'">';
						$output .= '<h3>'.$group.'</h3>';
						
						foreach ($sortlist as $key => $list) {
							if ($key == "placebo") {
								$output .= '<input class="sorter-placebo" type="hidden" name="'.$value['id'].'['.$group.'][placebo]" value="placebo">';
							} else {
								$output .= '<li id="'.$key.'" class="sortee">';
								$output .= '<input class="position" type="hidden" name="'.$value['id'].'['.$group.']['.$key.']" value="'.$list.'">';
								$output .= $list;
								$output .= '</li>';
							}
						}
						
						$output .= '</ul>';
					}
				}
				
				$output .= '</div>';
			
		break;		
		case 'color':	
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}	
				$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$pmc_data[$value['id']].'"></div></div>';
				$output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $pmc_data[$value['id']] .'" />';
			
		break;   
		
		case 'colorrgb':		
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: '.$pmc_data[$value['id']].'" data-color-format="rgb"></div></div>';
				$output .= '<input class="of-color" name="'.$value['id'].'" id="'. $value['id'] .'" type="text" value="'. $pmc_data[$value['id']] .'" />';
			
		break;   
		
		case 'sizeColor':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = array('size' => 12, 'color' => '#000000');
				}
				$sizeColor = $pmc_data[$value['id']];
				
					
					
						$output .= '<div class="select_wrapper typography-size">';
						$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
							for ($i = 9; $i < 65; $i++){ 
								$test = $i.'px';
								$output .= '<option value="'. $i .'px" ' . selected($sizeColor['size'], $test, false) . '>'. $i .'px</option>'; 
								}
				
						$output .= '</select></div>';
					
					
								/* Font Color */
					
					
						$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$sizeColor['color'].'"></div></div>';
						$output .= '<input class="of-color of-typography of-typography-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $sizeColor['color'] .'" />';
					
					
		break; 	
		
		case 'font':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = array('face' => 'arial');
				}
					$output .= '<div class="select_wrapper font">';
				$output .= '<select class="select of-input" name="'.$value['id'].'" id="'. $value['id'].'">';
				
				$faces = array('arial'=>'Arial',
								'verdana'=>'Verdana, Geneva',
								'trebuchet'=>'Trebuchet',
								'georgia' =>'Georgia',
								'Helvetica Neue' =>'Helvetica Neue',
								'times'=>'Times New Roman',
								'tahoma'=>'Tahoma, Geneva',
								'Telex' => 'Telex',
								'Droid%20Sans' => 'Droid Sans',
								'Convergence' => 'Convergence',
								'Oswald' => 'Oswald',
								'News%20Cycle' => 'News Cycle',
								'Yanone%20Kaffeesatz:300' => 'Yanone Kaffeesatz Light',
								'Yanone%20Kaffeesatz:200' => 'Yanone Kaffeesatz ExtraLight',
								'Yanone%20Kaffeesatz:400' => 'Yanone Kaffeesatz Regular',								
								'Duru%20Sans' => 'Duru Sans',
								'Open%20Sans' => 'Open Sans',
								'PT%20Sans%20Narrow' => 'PT Sans Narrow',
								'Macondo Swash Caps'=>'Macondo Swash Caps',
								'Telex'=>'Telex' ,
								'Sirin%20Stencil' => 'Sirin Stencil',
								'Actor' => 'Actor',
								'Iceberg' => 'Iceberg',
								'Ropa%20Sans' => 'Ropa Sans',
								'Amethysta' => 'Amethysta',
								'Alegreya' => 'Alegreya',
								'Germania One' => 'Germania One',
								'Gudea' => 'Gudea',
								'Trochut' => 'Trochut',
								'Ruluko' => 'Ruluko',
								'Alegreya' => 'Alegreya',
								'Questrial' => 'Questrial',
								'Armata' => 'Armata',								
								'Quicksand' => 'Quicksand',
								'PT%20Sans' => 'PT Sans',
								'Diplomata%20SC' => 'Diplomata SC',
								'Limelight' => 'Limelight',
								'Abril%20Fatface' => 'Abril Fatface',
								'Yeseva%20One' => 'Yeseva One',
								'Smokum' => 'Smokum',
								'Gravitas%20One' => 'Gravitas One',
								'Roboto%20Slab' => 'Roboto Slab',
								'Roboto' => 'Roboto',
								'Domine' => 'Domine',
								'Unna' => 'Unna',
								'Coustard' => 'Coustard',
								'Cantata%20One' => 'Cantata One',
								'Headland%20One' => 'Headland One',
								'Vidaloka' => 'Vidaloka',
								'Josefin Slab' => 'Josefin Slab',
								'Droid Serif' => 'Droid Serif',
								'Cabin' => 'Cabin',
								'Cabin%20Condensed' => 'Cabin Condensed',
								'Raleway' => 'Raleway',
								'Noto%20Sans' => 'Noto+Sans',	
								'Dancing%20Script' => 'Dancing Script',									
								'Oxygen' => 'Oxygen',
								'Lobster' => 'Lobster',
								'Lobster%Two' => 'Lobster Two',	
								'Lusitana:400,700' => 'Lusitana:400,700'
								);			
				foreach ($faces as $i=>$face) {
					$output .= '<option value="'. $i .'" ' . selected($pmc_data[$value['id']], $i, false) . '>'. $face .'</option>';
				}			
								
		
			 $output .= '</select></div>';
			
		break; 
		
		case 'typography':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = array('size'=>12, 'face' => 'arial', 'color' => '#000000','style'=>'normal');
				}
				$typography_stored = $pmc_data[$value['id']];
				
				/* Font Size */
				
				if(isset($typography_stored['size'])) {
				
					$output .= '<div class="select_wrapper typography-size">';
					$output .= '<select class="of-typography of-typography-size select" name="'.$value['id'].'[size]" id="'. $value['id'].'_size">';
						for ($i = 9; $i < 65; $i++){ 
							$test = $i.'px';
							$output .= '<option value="'. $i .'px" ' . selected($typography_stored['size'], $test, false) . '>'. $i .'px</option>'; 
							}
			
					$output .= '</select></div>';
				
				}
				/* Font Color */
				if(isset($typography_stored['color'])) {
				
					$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$typography_stored['color'].'"></div></div>';
					$output .= '<input class="of-color of-typography of-typography-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $typography_stored['color'] .'" />';
				
				}
		
				/* Font Face */
				
				if(isset($typography_stored['face'])) {
				
					$output .= '<div class="select_wrapper typography-face">';
					$output .= '<select class="of-typography of-typography-face select" name="'.$value['id'].'[face]" id="'. $value['id'].'_face">';
					
					$faces = array('arial'=>'Arial',
									'verdana'=>'Verdana, Geneva',
									'trebuchet'=>'Trebuchet',
									'georgia' =>'Georgia',
									'Helvetica Neue' =>'Helvetica Neue',
									'times'=>'Times New Roman',
									'tahoma'=>'Tahoma, Geneva',
									'Telex' => 'Telex',
									'Droid%20Sans' => 'Droid Sans',
									'Convergence' => 'Convergence',
									'Oswald' => 'Oswald',
									'News%20Cycle' => 'News Cycle',
									'Yanone%20Kaffeesatz:300' => 'Yanone Kaffeesatz Light',
									'Yanone%20Kaffeesatz:200' => 'Yanone Kaffeesatz ExtraLight',
									'Yanone%20Kaffeesatz:400' => 'Yanone Kaffeesatz Regular',								
									'Duru%20Sans' => 'Duru Sans',
									'Open%20Sans' => 'Open Sans',
									'PT%20Sans%20Narrow' => 'PT Sans Narrow',
									'Macondo Swash Caps'=>'Macondo Swash Caps',
									'Telex'=>'Telex' ,
									'Sirin%20Stencil' => 'Sirin Stencil',
									'Actor' => 'Actor',
									'Iceberg' => 'Iceberg',
									'Ropa%20Sans' => 'Ropa Sans',
									'Amethysta' => 'Amethysta',
									'Alegreya' => 'Alegreya',
									'Germania One' => 'Germania One',
									'Gudea' => 'Gudea',
									'Trochut' => 'Trochut',
									'Ruluko' => 'Ruluko',
									'Alegreya' => 'Alegreya',
									'Questrial' => 'Questrial',
									'Armata' => 'Armata',									
									'Quicksand' => 'Quicksand',
									'PT%20Sans' => 'PT Sans',
									'Diplomata%20SC' => 'Diplomata SC',
									'Limelight' => 'Limelight',
									'Abril%20Fatface' => 'Abril Fatface',
									'Yeseva%20One' => 'Yeseva One',
									'Smokum' => 'Smokum',
									'Gravitas%20One' => 'Gravitas One',
									'Roboto%20Slab' => 'Roboto Slab',
									'Roboto' => 'Roboto',
									'Domine' => 'Domine',
									'Unna' => 'Unna',
									'Coustard' => 'Coustard',
									'Cantata%20One' => 'Cantata One',
									'Headland%20One' => 'Headland One',
									'Vidaloka' => 'Vidaloka',
									'Josefin%20Slab' => 'Josefin Slab',
									'Droid%20Serif' => 'Droid Serif',
									'Cabin' => 'Cabin',
									'Cabin%20Condensed' => 'Cabin Condensed',
									'Raleway' => 'Raleway',
									'Noto%20Sans' => 'Noto+Sans',	
									'Dancing%20Script' => 'Dancing Script',
									'Oxygen' => 'Oxygen',
									'Lobster' => 'Lobster',
									'Lobster%Two' => 'Lobster Two',
									'Lusitana:400,700' => 'Lusitana:400,700'
									);			
					foreach ($faces as $i=>$face) {
						$output .= '<option value="'. $i .'" ' . selected($typography_stored['face'], $i, false) . '>'. $face .'</option>';
					}			
									
					$output .= '</select></div>';
				
				}
				
				/* Font Weight */
				
				if(isset($typography_stored['style'])) {
				
					$output .= '<div class="select_wrapper typography-style">';
					$output .= '<select class="of-typography of-typography-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
					$styles = array('normal'=>'Normal',
									'bold'=>'Bold'
									);
									
					foreach ($styles as $i=>$style){
					
						$output .= '<option value="'. $i .'" ' . selected($typography_stored['style'], $i, false) . '>'. $style .'</option>';		
					}
					$output .= '</select></div>';
				
				}
			
			
			
		break; 
		case 'border':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
			
				if(!isset($pmc_data[$value['id'] . '_width'])) $pmc_data[$value['id'] . '_width'] ='';
				if(!isset($pmc_data[$value['id'] . '_style'])) $pmc_data[$value['id'] . '_style'] ='';
				if(!isset($pmc_data[$value['id'] . '_color'])) $pmc_data[$value['id'] . '_color'] ='';
				
				$border_stored = array('width' => $pmc_data[$value['id'] . '_width'] ,
										'style' => $pmc_data[$value['id'] . '_style'],
										'color' => $pmc_data[$value['id'] . '_color'],
										);
					
				/* Border Width */
				$border_stored = $pmc_data[$value['id']];
				
				$output .= '<div class="select_wrapper border-width">';
				$output .= '<select class="of-border of-border-width select" name="'.$value['id'].'[width]" id="'. $value['id'].'_width">';
					for ($i = 0; $i < 21; $i++){ 
					$output .= '<option value="'. $i .'" ' . selected($border_stored['width'], $i, false) . '>'. $i .'</option>';				 }
				$output .= '</select></div>';
				
				/* Border Style */
				$output .= '<div class="select_wrapper border-style">';
				$output .= '<select class="of-border of-border-style select" name="'.$value['id'].'[style]" id="'. $value['id'].'_style">';
				
				$styles = array('none'=>'None',
								'solid'=>'Solid',
								'dashed'=>'Dashed',
								'dotted'=>'Dotted');
								
				foreach ($styles as $i=>$style){
					$output .= '<option value="'. $i .'" ' . selected($border_stored['style'], $i, false) . '>'. $style .'</option>';		
				}
				
				$output .= '</select></div>';
				
				/* Border Color */		
				$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: '.$border_stored['color'].'"></div></div>';
				$output .= '<input class="of-color of-border of-border-color" name="'.$value['id'].'[color]" id="'. $value['id'] .'_color" type="text" value="'. $border_stored['color'] .'" />';
			
		break;   
		case 'images':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				$i = 0;
				
				$select_value = $pmc_data[$value['id']];
				
				foreach ($value['options'] as $key => $option) 
				{ 
				$i++;
		
					$checked = '';
					$selected = '';
					if(NULL!=checked($select_value, $key, false)) {
						$checked = checked($select_value, $key, false);
						$selected = 'of-radio-img-selected';  
					}
					$output .= '<span>';
					$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'.$value['id'].'" '.$checked.' />';
					$output .= '<div class="of-radio-img-label">'. $key .'</div>';
					$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
					$output .= '</span>';				
				}
			
		break;
		case 'tiles':
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}
				$i = 0;
				if(isset($pmc_data[$value['id']]))
					$select_value = $pmc_data[$value['id']];
				else
					$select_value = 1;
				
				foreach ($value['options'] as $key => $option) 
				{ 
				$i++;
		
					$checked = '';
					$selected = '';
					if(NULL!=checked($select_value, $option, false)) {
						$checked = checked($select_value, $option, false);
						$selected = 'of-radio-tile-selected';  
					}
					$output .= '<span>';
					$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="'.$option.'" name="'.$value['id'].'" '.$checked.' />';
					$output .= '<div class="of-radio-tile-img '. $selected .'" style="background: url('.$option.')" onClick="document.getElementById(\'of-radio-tile-'. $value['id'] . $i.'\').checked = true;"></div>';
					$output .= '</span>';				
				}
			
		break;
		case "info":
				if (!isset($pmc_data[$value['id']])) {
					$pmc_data[$value['id']] = '';
				}	
				$info_text = $value['std'];
				$output .= '<div class="of-info">'.$info_text.'</div>';
			
		break;                                   	
		case 'heading':
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$header_class = preg_replace("/[^A-Za-z0-9]/", "", strtolower($value['name']) );
			$jquery_click_hook = preg_replace("/[^A-Za-z0-9]/", "", strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<li class="'. $header_class .'"><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;
				//backup and restore options data
				case 'backup':
					$instructions = $value['desc'];
					$backup = get_option('BACKUPS');
					if(!isset($backup['backup_log'])) {
						$log = 'No backups yet';
					} else {
						$log = $backup['backup_log'];
					}
					$output .= '<div class="backup-box">';
					$output .= '<div class="instructions">'.$instructions."\n";
					$output .= '<p><strong>Last Backup :<span class="backup-log">'.$log.'</span></strong></p></div>'."\n";
					$output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
					$output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
					$output .= '</div>';
				break;
				//export or import data between different installs
				case 'transfer':
					$instructions = $value['desc'];
					$output .= '<textarea id="export_data" rows="8">'.base64_encode(serialize($pmc_data)) /* 100% safe - ignore theme check nag */ .'</textarea>'."\n<br>";
					$output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';
				break;;		
		} 
		
		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id = $array['id']; 
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){$std = $saved_std;} 
					$meta = $array['meta'];
					
					if($array['type'] == 'text') { // Only text at this point
						 
						 $output .= '<input class="input-text-small of-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != 'heading' ) { 
			if ( $value['type'] != 'checkbox' ) 
				{ 
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ 
				$explain_value = '<div class="explain">'. $value['desc'] .'</div>'."\n"; 
			} 
			$output .= '</div>'.$explain_value."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}
	   
	}
    $output .= '</div>';
    return array($output,$menu,$defaults);	
}
/*-----------------------------------------------------------------------------------*/
/* Aquagraphite Uploader - optionsframework_uploader_function */
/*-----------------------------------------------------------------------------------*/
public static function optionsframework_uploader_function($id,$std,$mod){
    $pmc_data =get_option(OPTIONS);
	
	$uploader = '';
    $upload = $pmc_data[$id];
	$hide = '';
	
	if ($mod == "min") {$hide ='hide';}
	
    if ( $upload != "") { $val = $upload; } else {$val = $std;}
    
	$uploader .= '<input class="'.$hide.' upload of-input" name="'. $id .'" id="'. $id .'_upload" value="'. $val .'" />';	
	
	$uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'">'._('Upload').'</span>';
	
	if(!empty($upload)) {$hide = '';} else { $hide = 'hide';}
	$uploader .= '<span class="button image_reset_button '. $hide.'" id="reset_'. $id .'" title="' . $id . '">Remove</span>';
	$uploader .='</div>' . "\n";
    $uploader .= '<div class="clear"></div>' . "\n";
	if(!empty($upload)){
		$uploader .= '<div class="screenshot">';
    	$uploader .= '<a class="of-uploaded-image" href="'. $upload . '">';
    	$uploader .= '<img class="of-option-image" id="image_'.$id.'" src="'.$upload.'" alt="" />';
    	$uploader .= '</a>';
		$uploader .= '</div>';
		}
	$uploader .= '<div class="clear"></div>' . "\n"; 
return $uploader;
}
/*-----------------------------------------------------------------------------------*/
/* Aquagraphite Slider - optionsframework_slider_function */
/*-----------------------------------------------------------------------------------*/
public static function optionsframework_slider_function($id,$std,$oldorder,$order,$int, $social = false,  $menu = false, $sidebar = false){
    $pmc_data = get_option(OPTIONS);
	$slider = '';
    $slide = $pmc_data[$id];
	
    if (isset($slide[$oldorder])) { $val = $slide[$oldorder]; } else {$val = $std;}
	
	//initialize all vars
	$slidevars = array('title','url','link','description','role','icon','facebook','dribble','vimeo','mail','video','top','left','twitter');
	
	foreach ($slidevars as $slidevar) {
		if (!isset($val[$slidevar])) {
			$val[$slidevar] = '';
		}
	}
	
	//begin slider interface	
	if (!empty($val['title'])) {
		$slider .= '<li><div class="slide_header"><strong>'.str_replace('\\','',$val['title']).'</strong>';
	} else {
		if($menu){
		$slider .= '<li><div class="slide_header"><strong>Menu '.$order.'</strong>';
		}
		else if($sidebar){
		$slider .= '<li><div class="slide_header"><strong>Sidebar '.$order.'</strong>';
		}	
		else if($social){
		$slider .= '<li><div class="slide_header"><strong>Social '.$order.'</strong>';
		}	
		else{
		$slider .= '<li><div class="slide_header"><strong>Client '.$order.'</strong>';
		}		
	}
	
	$slider .= '<input type="hidden" class="slide of-input order" name="'. $id .'['.$order.'][order]" id="'. $id.'_'.$order .'_slide_order" value="'.$order.'" />';
	$slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';
	
	$slider .= '<div class="slide_body">';
	
	if ($social){
	$slider .= '<label>Social Icon alt text</label>';
	$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. str_replace('\\','',$val['title']) .'" />';		
	}
	else if ($menu){
	$slider .= '<label>Menu name</label>';
	$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. str_replace('\\','',$val['title']) .'" />';		
	}
	else if ($sidebar){
	$slider .= '<label>Sidebar name</label>';
	$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. str_replace('\\','',$val['title']) .'" />';		
	}	
	else{
	$slider .= '<label>Title</label>';
	$slider .= '<input class="slide of-input of-slider-title" name="'. $id .'['.$order.'][title]" id="'. $id .'_'.$order .'_slide_title" value="'. str_replace('\\','',$val['title']) .'" />';
	}
	if ($social){
	$slider .= '<label>Icon URL</label>';
	}
	else {	
		if(!$menu && !$sidebar){
		$slider .= '<label>Image URL</label>';
	}
	}
	if(!$menu && !$sidebar){
		$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][url]" id="'. $id .'_'.$order .'_slide_url" value="'. $val['url'] .'" />';
		$slider .= '<div class="upload_button_div"><span class="button image_upload_button" id="'.$id.'_'.$order .'" rel="' . $int . '">Upload</span>';
		
		if(!empty($val['url'])) {$hide = '';} else { $hide = 'hide';}
		$slider .= '<span class="button image_reset_button'. $hide.'" id="reset_'. $id .'_'.$order .'" title="' . $id . '_'.$order .'">Remove</span>';
		$slider .='</div>' . "\n";
		$slider .= '<div class="'. $id .'_'.$order .'">';
		if(!empty($val['url'])){
			
			$slider .= '<a class="of-uploaded-image" href="'. $val['url'] . '">';
			if($social){
			$slider .= '<img class="of-option-image small" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';}
			else{
			$slider .= '<img class="of-option-image" id="image_'.$id.'_'.$order .'" src="'.$val['url'].'" alt="" />';}
			$slider .= '</a>';
			
			}
		$slider .= '</div>';	
	}
	if ($social){
		$slider .= '<label>Link URL</label>';
	} else {	
		if(!$menu && !$sidebar){
		$slider .= '<label>Link URL (optional)</label>';
	}
	}
	if(!$menu && !$sidebar){
	$slider .= '<input class="slide of-input" name="'. $id .'['.$order.'][link]" id="'. $id .'_'.$order .'_slide_link" value="'. $val['link'] .'" />';
	}
	$slider .= '<a class="slide_delete_button" href="#">Delete</a>';
    $slider .= '<div class="clear"></div>' . "\n";
	$slider .= '</div>';
	$slider .= '</li>';
return $slider;
}
/*-----------------------------------------------------------------------------------*/
/* End Class
/*-----------------------------------------------------------------------------------*/	
}	//end class
?>