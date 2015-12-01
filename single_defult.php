
<div id="mainwrap">
	<?php if (have_posts()) : while (have_posts()) : the_post();  $postmeta = get_post_custom($post->ID);  ?>
	<div id="main">	
	<div class="content singledefult">
		<div class="postcontent singledefult" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		
			<div class="blogpost">		
				<div class="posttext">
				<?php if( !get_post_format()){?> 
				
				<?php } ?>
					<?php if ( !has_post_format( 'gallery' , $post->ID)) { ?>
						<div class="blogsingleimage">			
							<?php	
							if ( !get_post_format() ) {
								if ( has_post_thumbnail() ){
									$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
									$image = $image[0];
									}
								else
									$image = get_template_directory_uri() . '/images/placeholder-580.png';
								
							?>
							<a href="<?php echo $image ?>" rel="lightbox[single-gallery]" title="<?php the_title(); ?>">
								<img src="<?php echo get_template_directory_uri() ?>/js/timthumb.php?src=<?php echo $image ?>&amp;h=320&amp;w=750" alt="<?php the_title(); ?>">
							</a>
							<?php } ?>
							<?php if ( has_post_format( 'video' , $post->ID)) {?>
							
								<?php  
								if ($postmeta["selectv"][0] == 'vimeo')  
								{  
									echo '<iframe src="http://player.vimeo.com/video/'.$postmeta["video_post_url"][0].'" width="730" height="410"  ></iframe>';  
								}  
								else if ($postmeta["selectv"][0] == 'youtube')  
								{  
									echo '<iframe width="730" height="410" src="http://www.youtube.com/embed/'.$postmeta["video_post_url"][0].'"  ></iframe>';  
								}  
								else  
								{  
									echo 'Please select a Video Site via the WordPress Admin';  
								}  
								?>
							<?php
							}
							?>	
							<?php if ( has_post_format( 'audio' , $post->ID)) {?>
							<div class="audioPlayer">
								<?php echo do_shortcode('[audio file="'. $postmeta["audio_post_url"][0] .'"]') ?>
							</div>
							<?php
							}
							?>	
							<?php if(has_post_format( 'video' , $post->ID)){ ?>
								<div class = "meta videoGallery">
							<?php } 
							
							else {?>
								<div class = "meta">
							<?php } ?>		
								<h1 class="title"><?php the_title();?></h1>									
								<div class="squareHolder">
									<div class="comment-inside">
										<a href="#comments" title="<?php the_title(); ?>"><?php comments_number( '0', '1', '%' ); ?> </a>
									</div>
								</div>
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
							
						</div>
					<?php } else {?>
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
						<div class="gallery-single">
						<?php
							foreach ($attachments as $attachment) {
								$title = '';
								//echo apply_filters('the_title', $attachment->post_title);
								$image =  wp_get_attachment_image_src( $attachment, 'full' ); 	?>
									<div class="image-gallery">
										<a href="<?php echo $image[0] ?>" rel="lightbox[single-gallery]" title="<?php the_title(); ?>"><div class = "over"></div>
											<img src="<?php echo get_template_directory_uri() ?>/js/timthumb.php?src=<?php echo $image[0] ?>&amp;h=106&amp;w=106" alt="<?php the_title(); ?>"/>					
										</a>	
									</div>			
									<?php } ?>
						</div>
						<?php } ?>
							<div class = "meta videoGallery">
								<h1 class="title"><?php the_title(); ?></h1>									
								<div class="squareHolder">
									<div class="comment-inside">
										<a href="#comments" title="<?php the_title(); ?>"><?php comments_number( '0', '1', '%' ); ?> </a>
									</div>
								</div>
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
					<?php }  ?>
					<div class="sentry">
						<?php if ( has_post_format( 'video' , $post->ID)) {?>
							<div><?php the_content(); ?></div>
						<?php
						}
					    if ( has_post_format( 'audio' , $post->ID)) { ?>
							<div><?php the_content(); ?></div>
						<?php
						}						
						if(has_post_format( 'gallery' , $post->ID)){?>
							<div class="gallery-content"><?php the_content(); 	?></div>
						<?php } 
						if( !get_post_format()){?> 
						    <?php add_filter('the_content', 'addlightboxrel_replace'); ?>
							<div><?php the_content(); ?></div>		
						<?php } ?>
						<div class="singleBorder"></div>
					</div>
				</div>
				
				<?php if(has_tag()) { ?>
					<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { $tagsTR = stripText($pmc_data['translation_tags']); } else {  $tagsTR = __('Tags: ','wp-studio'); } ?>
					<div class="tags"><?php the_tags($tagsTR,', ',''); ?></div>	
				<?php } ?>
					

				
			</div>						
			
		</div>		

	<?php comments_template(); ?>
					
	<?php endwhile; else: ?>
					
		<?php include_once(TEMPLATEPATH."/404.php"); ?>
					
	<?php endif; ?>
	</div>

</div>
</div>