<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>

<div id="mainwrap">

	<div id="main" >
			<div class="content fullwidth">
					<div class="postcontent">
						<div class="posttext">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							
							<div class="usercontent"><?php the_content(); ?></div>
							
							<?php endwhile; endif; ?>
						</div>
					</div>
			</div>
	</div>
</div>
<?php get_footer(); ?>
