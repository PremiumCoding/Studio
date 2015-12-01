
/*loading image*/

jQuery(document).ready(function(){	

	jQuery('.overgallery').hide();
	jQuery('.overvideo').hide();
	jQuery('.overdefult').hide();	  
	jQuery('.overport').hide();	  

	
	
	
	jQuery(window).load(function () {
		jQuery('.one_half').find('.loading').attr('class', '');
		jQuery('.one_third').find('.loading').attr('class', '');	
		jQuery('.one_fourth').find('.loading').attr('class', '');			
		jQuery('.item').find('.loading').attr('class', '');
		jQuery('.item4').find('.loading').attr('class', '');
		jQuery('.item3').find('.loading').attr('class', '');	
		jQuery('.blogimage').find('.loading').attr('class', '');	
		jQuery('.image').css('background', 'none');
		jQuery('.recentimage').css('background', 'none');	
		jQuery('.audioPlayerWrap').css({'background':'none','height':'25px','padding-top':'0px'});	
		jQuery('.blogpostcategory').find('.loading').removeClass('loading');
		jQuery('.image').find('.loading').removeClass('loading');
		//show the loaded image
		jQuery('iframe').show()	
		jQuery('img').show();
		jQuery('.audioPlayer').show();
		jQuery('.overgallery').show();
		jQuery('.overvideo').show();
		jQuery('.overdefult').show();	  
		jQuery('.overport').show();	  
		jQuery('#slider-wrapper .loading').removeClass('loading');
		jQuery('.imagesSPAll .loading').removeClass('loading');
		jQuery('#slider').css('display','block');
		jQuery('#slider .images').animate({'opacity':1},300);
		jQuery('#slider,#slider img,.textSlide').css('opacity','1'); 
		jQuery('#slider-wrapper').css('max-height','500px'); 		
    })



});

/*sidebar*/
jQuery(document).ready(function(){
	jQuery('.sidebarButton').hover(function(){
		jQuery('.sidebar').animate({width: 'show'}, 300);
		jQuery('.sidebarButton').fadeOut(200);

	});
	jQuery('.sidebar').hover(function(){
	},
	  function () {
		jQuery('.sidebar').animate({width: 'hide'}, 300);
		jQuery('.sidebarButton').fadeIn(200);
	  });	
});

/*social top icons*/
jQuery(document).ready(function(){
	jQuery('.iconButton').hover(function(){
		jQuery('.iconrwrap .socialcategory').animate({width: 'show'}, 200);
		jQuery('.iconButton').fadeOut(200);

	});
	jQuery('.iconrwrap .socialcategory').hover(function(){
	},
	  function () {
		jQuery('.iconrwrap .socialcategory').animate({width: 'hide'}, 200);
		jQuery('.iconButton').fadeIn(200);
	  });	
});


/*add submenu class*/	
jQuery(document).ready(function(){

   jQuery('#menu-main-menu-1 > li').each(function(index) {
	   if(jQuery(this).find('ul').size() > 0 ){
			jQuery(this).addClass('has-sub-menu');
	   }
	});

});

function gotosite(sel) {
		var URL = sel.options[sel.selectedIndex].value; 
		
		window.location.href = URL;

}


jQuery(document).ready(function(){
	jQuery('ul.menu > li').hover(function(){
		jQuery(this).find('ul').stop(true,true).fadeIn(250);

	},
	  function () {
		jQuery(this).find('ul').stop(true,true).fadeOut(100);
	  });
	
});

/*add lightbox*/
jQuery(document).ready(function(){
jQuery(".gallery a").attr("rel", "lightbox[gallery]");

});





/*to top*/

jQuery(document).ready(function($){
	$(".totop ").hide();

});

jQuery(window).bind('scroll', function(){
if(jQuery(this).scrollTop() > 200) 
 jQuery(".totop ").fadeIn(200);
else
 jQuery(".totop ").fadeOut(200);
 


});


/* lightbox*/
function loadprety(){

jQuery(".gallery a").attr("rel", "lightbox[gallery]").prettyPhoto({theme:'light_rounded',overlay_gallery: false,show_title: false});

}
				
	

jQuery(document).ready(function(){	
	jQuery('#remove h2 a:first-child').attr('class','catlink catlinkhover');
	jQuery('.catlink').click(function() {
		jQuery('#remove h2 a').attr('class','catlink');
		jQuery(this).attr('class','catlink catlinkhover');
	});	
});


jQuery(document).ready(function(){	
	jQuery('.gototop').click(function() {
		jQuery('html, body').animate({scrollTop:0}, 'medium');
	});
});




