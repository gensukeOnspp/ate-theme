	<footer>
		<?php //get_sidebar('ft'); ?>
		<?php wp_nav_menu( array ( 'theme_location' => 'footer-navi',
									'container' => 'footer')); ?>

			<div class="copy-right">Copyright © <?php bloginfo('name'); ?>　All Rights Reserved.</div>
		<?php wp_footer(); ?>
	</footer>
</body>
</html>
