<?php
global $pmc_data, $sitepress;
?>
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
					<?php dynamic_sidebar( 'footer3' ); ?>
					</div>
					
					
			</div>
		</div>
		<div id="footerbwrap">
			<div id="footerb">
				<div class="footernav">
						<?php if ( has_nav_menu( 'footer-menu' ) ) { wp_nav_menu( array( 'menu_class' => 'footernav','theme_location' => 'footer-menu' ) );} ?>
				</div>
				<div class="copyright">

				</div>
			</div>
		</div>
	</div>
</footer>	
</body>
</html>