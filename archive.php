<?php
	/*
	 * get_query_var()でページ数を取得してpagedに渡す
	 * */
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	$args = array(
		'posts_per_page' => get_option('posts_per_page'), // 1ページに含める投稿数
		'paged' => $paged
	);
	$the_query = new WP_Query( $args );
	
?>

<!-- ヘッダー読み込み header.phpを読み込んでくれる -->
<?php get_header(); ?>

<div class="main-container">
	<?php the_bread(); ?>
		
	<article>
		<h4><?php echo get_query_var('monthnum'); ?>月：</h4>
		<?php 
		/* 
		 * この書き方は、パーマリンクをデフォルト以外にしている場合のみ有効です。デフォルトのままだと、「0年0月」になります。
		 * デフォルトパーマリンクの時は、
		 * 
		 *  <?php 
		 * $thisyear = substr($m, 0, 4);
		 * $thismonth = substr($m, 4, 2);
		 * echo $thisyear . '年'. $thismonth . '月';
		 * ?>
		 * 
		 * というコードに差し替えてください。
		 */
		
		// お決まりのループ開始処理
		if ( $the_query -> have_posts() ) :
			while ( $the_query -> have_posts() ) : $the_query -> the_post(); ?>
				<section>
					<!-- ここに表示するタイトルやコンテンツなどを指定 -->
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<?php echo get_the_date() ?>
				</section>
			<?php endwhile; // end of the loop. ?>
			<?php list_paginate(); ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?><!-- 忘れずにリセットする必要がある -->
	</article>
</div>

<!-- フッター読み込み footer.phpを読み込んでくれる -->
<?php get_footer(); ?>
