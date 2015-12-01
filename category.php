<?php get_header(); 

?>

<script type="text/javascript">
jQuery(document).ready(function($){
	    $('.slider').anythingSlider({
		hashTags : false,
		expand		: true,
		autoPlay	: true,
		resizeContents  : false,
		pauseOnHover    : true,
		buildArrows     : false,
		buildNavigation : false,
		delay		: 4000,
		resumeDelay	: 0,
		animationTime	: 800,
		delayBeforeAnimate:0,	
		easing : 'easeInOutQuint',
	    })


	});
	
</script>	
 
<div id="mainwrap">

	<div id="main">


		<div class="pad"></div>	
					
			<div class="content blog">
						
				<?php if (have_posts()) : ?>
				
				<?php while (have_posts()) : the_post();
				$postmeta = get_post_custom($post->ID); 
				if ( has_post_format( 'gallery' , $post->ID)) { 
				?>
				<div class="slider-category">
				
					<div class="blogpostcategory">
					<?php
						global $post;
						$post_subtitrare = get_post( $post->ID );
						$content = $post_subtitrare->post_content;
						$pattern = get_shortcode_regex();
						preg_match( "/$pattern/s", $content, $match );
						if( isset( $match[2] ) && ( "gallery" == $match[2] ) ) {
							$atts = shortcode_parse_atts( $match[3] );
							$attachments = isset( $atts['ids'] ) ? explode( ',', $atts['ids'] ) : get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . $post->ID .'&order=ASC&orderby=menu_order ID' );
						}

						if ($attachments) {?>
						<div id="slider-category" class="slider-category">
						<div class="loading"></div>
							<ul id="slider" class="slider">
								<?php
									foreach ($attachments as $attachment) {
										$image =  wp_get_attachment_image_src( $attachment, 'full' ); ?>	
											<li>
											<div class="slider-item">
												<img src="<?php echo get_template_directory_uri() ?>/js/timthumb.php?src=<?php echo $image[0] ?>&amp;h=320&amp;w=750" alt="<?php the_title(); ?>"/>					
													
											</div>			
											</li>
											<?php } ?>
							</ul>
							
						</div>
				  <?php } else { 
				  $image = get_template_directory_uri() .'/images/placeholder-580-gallery.png'; ?>
				  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri() ?>/js/timthumb.php?src=<?php echo $image ?>&amp;h=320&amp;w=750" alt="<?php the_title(); ?>"></a>
				  <?php }?>
						<div class="entry">
							<div class = "meta">
									
									<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<div class = "squareHolder"><div class = "comment-inside"><?php comments_popup_link('0', '1', '%'); ?></div></div>
									<div class = "posted-date">
										<div class = "date-inside">
											<a href="<?php 
												$arc_year = get_the_time('Y'); 
												$arc_month = get_the_time('m'); 
												$arc_day = get_the_time('d');
												echo get_day_link($arc_year, $arc_month, $arc_day); ?>">
												<?php the_time('F j, Y');?> 
											</a>
										</div> 
									</div>
									</div>									
									<div class="blogcontent"><?php echo shortcontent('[', ']', '', $post->post_content ,300);?> ...</div>
									<a class="blogmore" href="<?php the_permalink() ?>"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_morelink']); } else {  _e('Read more','wp-studio'); } ?> </a>

							</div>
							
						</div>	
					</div>
				
				<?php } 
				if ( has_post_format( 'video' , $post->ID)) { ?>
				<div class="slider-category">
				
					<div class="blogpostcategory">
					<div class="loading"></div>
					<?php
					
					if(!empty($postmeta["video_post_url"][0])) {?>
					<?php  
						if ($postmeta["selectv"][0] == 'vimeo')  
						{  
							echo '<iframe src="http://player.vimeo.com/video/'.$postmeta["video_post_url"][0].'" width="580" height="280"  ></iframe>';  
						}  
						else if ($postmeta["selectv"][0] == 'youtube')  
						{  
							echo '<iframe width="580" height="280" src="http://www.youtube.com/embed/'.$postmeta["video_post_url"][0].'"  ></iframe>';  
						}  
						else  
						{  
							echo 'Please select a Video Site via the WordPress Admin';  
							}  
					}
					else{ 
						  $image = get_template_directory_uri() .'/images/placeholder-580-video.png'; ?>
						  <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri() ?>/js/timthumb.php?src=<?php echo $image ?>&amp;h=320&amp;w=750" alt="<?php the_title(); ?>"></a>
						
					<?php } ?>					
						<div class="entry">

							<div class = "meta">
									<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<div class = "squareHolder"><div class = "comment-inside"><?php comments_popup_link('0', '1', '%'); ?></div></div>
									<div class = "posted-date">
										<div class = "date-inside">
											<a href="<?php 
												$arc_year = get_the_time('Y'); 
												$arc_month = get_the_time('m'); 
												$arc_day = get_the_time('d');
												echo get_day_link($arc_year, $arc_month, $arc_day); ?>">
												<?php the_time('F j, Y');?> 
											</a>
										</div> 
									</div>
									</div>										
									<div class="blogcontent"><?php echo shortcontent('[', ']', '', $post->post_content ,300);?> ...</div>
									<a class="blogmore" href="<?php the_permalink() ?>"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_morelink']); } else {  _e('Read more','wp-studio'); } ?></a>

							</div>
							
						</div>	
					</div>
				 
				<?php } 
				if ( has_post_format( 'link' , $post->ID)) {?>
				<div class="link-category">
					<div class="blogpostcategory">
					<span><?php echo the_content(); ?> </span>


					<div class="entry">

						<div class = "meta">
								
							<h2 class="title"><a href="<?php if(isset($postmeta["link_post_url"][0] )) echo $postmeta["link_post_url"][0] ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<div class = "squareHolder"><div class = "comment-inside"><?php comments_popup_link('0', '1', '%'); ?></div></div>
							<div class = "posted-date">
								<div class = "date-inside">
									<a href="<?php 
										$arc_year = get_the_time('Y'); 
										$arc_month = get_the_time('m'); 
										$arc_day = get_the_time('d');
										echo get_day_link($arc_year, $arc_month, $arc_day); ?>">
										<?php the_time('F j, Y');?> 
									</a>
								</div> 
							</div>
							</div>									
							<a class="blogmore" href="<?php if(isset($postmeta["link_post_url"][0] )) echo $postmeta["link_post_url"][0]  ?>"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_morelink']); } else {  _e('Read more','wp-studio'); } ?></a>

						</div>
						
					</div>	

				</div>
				
				<?php 
				} 	
				?>
				<?php if ( has_post_format( 'audio' , $post->ID)) {?>
				<div class="blogpostcategory">
					<div class="audioPlayerWrap">
						<div class="loading"></div>
						<div class="audioPlayer">
							<?php echo do_shortcode('[audio file="'. $postmeta["audio_post_url"][0] .'"]') ?>
						</div>
					</div>
					<div class="entry">

						<div class = "meta">
								
							<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<div class = "squareHolder"><div class = "comment-inside"><?php comments_popup_link('0', '1', '%'); ?></div></div>
							<div class = "posted-date">
								
								<div class = "date-inside">
									<a href="<?php 
										$arc_year = get_the_time('Y'); 
										$arc_month = get_the_time('m'); 
										$arc_day = get_the_time('d');
										echo get_day_link($arc_year, $arc_month, $arc_day); ?>">
										<?php the_time('F j, Y');?> 
									</a>
								</div> 
							</div>
							</div>										
							<div class="blogcontent"><?php echo shortcontent('[', ']', '', $post->post_content ,300);?> ...</div>
							<a class="blogmore" href="<?php the_permalink() ?>"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_morelink']); } else {  _e('Read more','wp-studio'); } ?></a>

						</div>
						
					</div>		
				 
				<?php
				}
				?>					
				
				
				<?php
				if ( !get_post_format() ) {?>
						
				<div class="blogpostcategory">
																
						<a class="overdefultlink" href="<?php the_permalink() ?>">
						<div class="overdefult">
						</div>
						</a>
						
						<div class="blogimage">	
							<div class="loading"></div>		
							<?php	
								if ( has_post_thumbnail() ){
									$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
									$image = $image[0];
									}
								else
									$image = get_template_directory_uri() .'/images/placeholder-580.png'; 
							?>
							
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo get_template_directory_uri() ?>/js/timthumb.php?src=<?php echo $image ?>&amp;h=320&amp;w=750" alt="<?php the_title(); ?>"></a>
						</div>
						
						<div class="entry">
							<div class = "meta">
									
								<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<div class = "squareHolder"><div class = "comment-inside"><?php comments_popup_link('0', '1', '%'); ?></div></div>
								<div class = "posted-date">
									<div class = "date-inside">
										<a href="<?php 
											$arc_year = get_the_time('Y'); 
											$arc_month = get_the_time('m'); 
											$arc_day = get_the_time('d');
											echo get_day_link($arc_year, $arc_month, $arc_day); ?>">
											<?php the_time('F j, Y');?> 
										</a>
									</div> 
								</div>
								</div>			
								<div class="blogcontent"><?php echo shortcontent('[', ']', '', $post->post_content ,300);?> ...</div>
								<a class="blogmore" href="<?php the_permalink() ?>"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_morelink']); } else {  _e('Read more','wp-studio'); } ?></a>

							</div>
							
						</div>		
				 	
				<?php } ?>		
					<?php endwhile; ?>
					
						<div class="navigation">
							<div class="alignleft"><?php previous_posts_link(translation('translation_previouspage', 'Newer posts')) ?></div>
							<div class="alignright"><?php next_posts_link(translation('translation_nextpage', 'Older posts'),'') ?></div>
						</div>
						
						<?php else : ?>
						
							<div class="postcontent">
								<h1><?php echo $pmc_data['errorpagetitle'] ?></h1>
								<div class="posttext">
									<?php echo $pmc_data['errorpage'] ?>
								</div>
							</div>
							
						<?php endif; ?>
					
			</div>
		

	</div>
	
</div>				
							
<?php get_footer(); ?>
