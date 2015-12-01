<?php get_header(); ?>

			
<div id="mainwrap">

	<div id="main" class="clearfix">	

		<div class="content fullwidth errorpage">
				<div class="postcontent">
					<h2><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['errorpagetitle']); } else {  _e('OOOPS! 404','wp-studio'); } ?></h2>
					<div class="posttext">
						<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['errorpage']); } else {  _e('Sorry, but the page you are looking for has not been found.<br/>Try checking the URL for errors, then hit refresh.</br>Or you can simply click the icon below and go home:)','wp-studio'); } ?>
					</div>
					<div class="homeIcon"><a href="<?php echo home_url(); ?>"></a></div>
				</div>							
		</div>
	</div>
</div>

<?php get_footer(); ?>
