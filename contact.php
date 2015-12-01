<?php
/*
Template Name: Contact sidebar
*/
?>

<?php get_header(); ?>

<div id="mainwrap">
	<div id="main" >

		<div class="content contact">
				<div class="postcontent">
					<div class="posttext">
			
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
						
						
						<?php the_content(); ?>
							
					
						<?php endwhile; endif; ?>
						
						<form method="post" id="contatti" action="<?php echo get_template_directory_uri(); ?>/sendemail.php"> 
							<div id="contactform"> 

								<div class="commentfield">							
								<label for="author"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_contact_name']); } else {  _e('Name','wp-studio'); } ?><small> (<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_comment_required']); } else {  _e('required','wp-studio'); } ?>)</small></label>							
								<input type="text" name="name" id="name" />						
								</div>
								<div class="commentfield">							
								<label for="email"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_contact_email']); } else {  _e('Email','wp-studio'); } ?><small> (<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_comment_required']); } else {  _e('required','wp-studio'); } ?>)</small></label>							
								<input type="text" name="email" id="email" /> 													
								</div>
								<div class="commentfield">									
								<label for="message"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_contact_message']); } else {  _e('Message','wp-studio'); } ?><small> (<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_comment_required']); } else {  _e('required','wp-studio'); } ?>)</small></label>
								<div class="commentfieldarea"><textarea name="message" id="testo" rows="12" cols="" ></textarea>	
								</div>
								</div>
								<input type="hidden" name="errorM" id="errorM" value="<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['contacterror']); } else {  _e('Error while sending mail.','wp-studio'); } ?><?php echo stripText($pmc_data['contacterror']) ?>" />
								<input type="hidden" name="successM" id="successM" value="<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['contactsuccess']); } else {  _e('Success','wp-studio'); } ?><?php echo stripText($pmc_data['contactsuccess']) ?>" />
								<input type="hidden" name="mailto" id="mailto" value="<?php echo stripText($pmc_data['contactemail']) ?>" />
								<div class="contactbutton"> 
									<input type="submit" class="contact-button" name="submit" id="invia" value="<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_contact_send']); } else {  _e('Send','wp-studio'); } ?>"/>
									<input type="reset" class="contact-button" name="clear" value="<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_contact_clear']); } else {  _e('Clear','wp-studio'); } ?>"/>
								</div>
								<span id="result"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['contacterror']); } else {  _e('Error while sending mail.','wp-studio'); } ?></span>
								<span id="resultsuccess"><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['contactsuccess']); } else {  _e('Success','wp-studio'); } ?></span>
							</div> 
						</form> 
					</div>
				</div>
			</div>

<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
