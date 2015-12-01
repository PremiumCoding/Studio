<!-- box home page for 4 intro boxes -->
	<div class = "homeBoxAll">
		<div class="homeBox ">
			<div class="one_half first">
				<h3><a class="overdefultlink" href="<?php if(isset($pmc_data['box1_link'])) echo $pmc_data['box1_link']?>"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['box1_title']); } else {  _e('Featured Box 1 Title','wp-studio'); } ?></a></h3>
				<div class="recentdescription">
					<div class="descriptionHomePort">
						<div><p><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['box1_description']); } else {  _e('Featured Box 1 Description','wp-studio'); } ?> </p></div>
					</div>
				</div>
								
			</div>
			<div class="one_half last">
				<h3><a class="overdefultlink" href="<?php if(isset($pmc_data['box2_link'])) echo $pmc_data['box2_link']?>"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['box2_title']); } else {  _e('Featured Box 2 Title','wp-studio'); } ?></a></h3>
				<div class="recentdescription">
					<div class="descriptionHomePort">
						<div><p><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['box2_description']); } else {  _e('Featured Box 2 Description','wp-studio'); } ?> </p></div>
					</div>
				</div>	
			</div>

		</div>
	</div>

		
		<div class="clear"></div>	