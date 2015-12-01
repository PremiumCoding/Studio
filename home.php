<?php
/*
Template Name: Home 
*/
?>

<?php get_header(); ?>

		<div id="mainwrap" class="homewrap">

			<div id="main" class="clearfix">

				<?php if(isset($pmc_data['infotext_status'])) { ?>
					<div class="infotextwrap">
						<div class="infotext">
							<div class="infotextBorder"></div>
							<h2><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['infotext']); } else {  _e('Welcome to <span>studio</span> - A Minimal Business Theme','wp-studio'); } ?></h2>
							<?php if(isset($pmc_data['quote_bottom_border'])) { ?>				
								<div class="infotextBorder"></div>
							<?php }?>	
						</div>
					</div>
				<?php }?>
				
				<div class="clear"></div>
				

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				
				<div class="usercontent homeuser"><?php the_content(''); ?></div>
				
				
				<?php endwhile; endif; ?>
				
				
				<div class="clear"></div>	
				
					
				<?php if(isset($pmc_data['racent_status_port'])) { ?>
					
					<?php include(BOX_PATH . 'homeRecentPort.php'); ?>
				
				<?php }?>
				

				<div class="clear"> </div>
				
				<?php if(isset($pmc_data['box_status'])) { ?>

					<?php include(BOX_PATH .  'homebox.php'); ?>
					
				<?php }?>	
				
				<div class="clear"> </div>
			</div>
		</div>


<?php get_footer(); ?>