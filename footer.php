<?php
global $pmc_data, $sitepress;
?>		</div>	</div></div>
<footer>	
	<div id="footer">
		<div class="totop"><div class="gototop"><div class="arrowgototop"></div></div></div>
		<div class="fshadow"></div>
		<div id="footerinside">
			<div class="footer_widget">
				
					<div class="footer_widget1">
					<?php dynamic_sidebar( 'footer1' ); ?>				
					</div>	
					
					<div class="footer_widget2">	
					<?php dynamic_sidebar( 'footer2' ); ?>
					</div>	
					
					<div class="footer_widget3 last">	
					<?php dynamic_sidebar( 'footer3' ); ?>					<?php if($pmc_data['showsocialfooter']){ ?>						<div class="socialfooter">						<h3><?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['translation_socialtitle']); } else {  _e('SOCIALIZE WITH US','wp-studio'); } ?></h3>						<div class="socialcategory"><?php socialLinkTop() ?></div>						</div>						<?php } ?>
					</div>
					
					
			</div>
		</div>
		<div id="footerbwrap">
			<div id="footerb">
				<div class="footernav">
						<?php if ( has_nav_menu( 'footer-menu' ) ) { wp_nav_menu( array( 'menu_class' => 'footernav','theme_location' => 'footer-menu' ) );} ?>
				</div>
				<div class="copyright">									<?php if (!function_exists('icl_object_id') or (ICL_LANGUAGE_CODE == $sitepress->get_default_language()) ) { echo stripText($pmc_data['copyright']); } else {  _e('&copy; 2011 All rights reserved. ','wp-studio'); } ?>

				</div>
			</div>
		</div>
	</div>
</footer>	<?php wp_footer();  ?>
</body>
</html>
