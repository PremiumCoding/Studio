<?php

	if(isset($pmc_data['home_recent_number']))
		$showpost = $pmc_data['home_recent_number'];
	else
		$showpost = 6;
		


	$pc = new WP_Query(array('orderby' => 'date', 'showposts' =>  $showpost, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'post_type' => array( 'portfolioentry'))); 
?>

	
<?php 	if ($pc->have_posts()) : ?>
<div class="homeRacent portHome">
	<div class="titleborder"></div>
	<div class="homeRecent">
	<ul id="sliderAdvertisePort" class="sliderAdvertisePort">
		<?php
		$currentindex = '';
		$count = 1;
		$countitem = 1;
		?>
		<?php  while ($pc->have_posts()) : $pc->the_post();
		if($countitem == 1){
			echo '<li>';}			
		$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);	
		$catType= 'portfoliocategory';
		
		//category
		$categoryIn = get_the_term_list( get_the_ID(), $catType, '', ', ', '' );	
		$category = explode(',',$categoryIn);	
		//end category			
		if ( has_post_thumbnail() ){
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
			$image = $image[0];}
		else
			$image = get_template_directory_uri() .'/images/placeholder-580.png'; 
			if( has_post_format( 'link' , get_the_ID()))
			add_filter( 'the_excerpt', 'filter_content_link' );		
		if($count != 3){
			echo '<div class="one_third" >';
		}
		else{
			echo '<div class="one_third last" >';
			$count = 0;
		}
		?>
				<div class="recentimage">
					
					<a href = "<?php the_permalink() ?>">
						<div class="overdefult"> 
							<div class="portTitle"><?php $title = the_title('','',FALSE);  echo substr($title, 0, 99);  ?></div>
						</div>
					</a>
					<div class="image">
						<div class="loading"></div>
						<img src="<?php echo get_template_directory_uri() ?>/js/timthumb.php?src=<?php echo $image ?>&amp;h=250&amp;w=250" alt="<?php the_title(); ?>">
					</div>
				</div>
				
			
			</div>
		<?php 
		$count++;
		
		 if($countitem == 6){ 
			$countitem = 0; ?>
			</li>
		<?php } 
		$countitem++;
		endwhile; 
		wp_reset_query(); ?>
		</ul>
		
	</div>
	
</div>

<?php  endif; ?>

<div class="clear"></div>
<div class="titleborder"></div>
