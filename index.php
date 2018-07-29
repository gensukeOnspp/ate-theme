<!-- ヘッダー読み込み header.phpを読み込んでくれる -->
<?php get_header(); ?>
									
	<div class="main-container">
		<?php wp_nav_menu( array ( 'theme_location' => 'main-navi' ,
										'container' => 'nav')); ?>
		<!-- メイン部分の読み込み loop.phpを読み込んでくれる -->
		<?php get_template_part( 'loop' ); ?>
	</div><!-- .main-container -->

<!-- フッター読み込み footer.phpを読み込んでくれる -->
<?php get_footer(); ?>
