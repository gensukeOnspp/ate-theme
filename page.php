<!-- ヘッダー読み込み header.phpを読み込んでくれる -->
<?php get_header(); ?>

	<div class="main-container">
		<?php wp_nav_menu( array ( 'theme_location' => 'main-navi' ,
										'container' => 'nav'));
		// パンくずを表示させたい
		the_bread();
		
		$v = array(
			'活動紹介' => array(
				'name' => 'page_activity_intro', 'head_title' => ''
			),
			'ボランティア' => array(
				'name' => 'page_volunteer', 'head_title' => ''
			),
			'ボランティア登録フォーム' => array(
				'name' => 'page_volunteer', 'head_title' => 'ボランティア'
			),
			'会の理念' => array(
				'name' => 'page_idea', 'head_title' => ''
			),
			'会社案内' => array(
				'name' => 'page_idea', 'head_title' => '会の理念'
			),
			'寄付' => array('name' => 'page_donation', 'head_title' => ''
			),
			'入会のご案内' => array(
				'name' => 'page_admission', 'head_title' => ''
			),
			'正会員・賛助会員申し込みフォーム' => array(
				'name' => 'page_admission', 'head_title' => '入会のご案内'
			)
		);
		
		$title = $post->post_title;
		foreach( $v as $key=>$val ){
			if($title == $key){
				echo do_shortcode("[menu name=\"{$val[name]}\" head_title=\"{$val[head_title]}\"]");				
			}
		}
		
		if(have_posts()) :
			while(have_posts()) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
				</div>
			<?php endwhile; 
		else: ?>
			<p>記事がない場合に表示させる文章など。<br clear="all" /></p>
		<?php endif; ?>

	</div><!-- .main-container -->

<!-- フッター読み込み footer.phpを読み込んでくれる -->
<?php get_footer(); ?>
	
<a id="pagetop" href="#top" class="page_top"></a>
