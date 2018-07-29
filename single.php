<!-- ヘッダー読み込み header.phpを読み込んでくれる -->
<?php get_header(); ?>

	<div class="main-container">
		<?php wp_nav_menu( array ( 'theme_location' => 'main-navi' ,
										'container' => 'nav'));
		// パンくずを表示させたい
		the_bread(); ?>
		
		<article><div class="sgl-post">
			<?php
				if(have_posts()) :
					while(have_posts()) : the_post(); ?>
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="post-title"><span><?php echo get_the_date(); ?></span><h4><?php the_title(); ?></h4></div>
							<?php the_content(); ?>
					
							<p class="footer-post-meta">
								<?php the_tags('Tag : ', ', '); ?>
								<!-- 複数の投稿者がいる場合 -->
								<?php if ( is_multi_author() ): ?>
									<span class="post-author">作成者 : <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
								<?php endif; ?>
							</p>
						</div>
										
						<!-- ▼もし記事が表示数より多い場合、ページャーを表示する▼ -->	
						<!-- ページナビゲーション -->
						<div class="navigation">
							<?php if( get_previous_post() ): ?>
								<div class="alignleft">
									<?php previous_post_link('%link', '«  %title', TRUE, ''); // 第3引数でカテゴリ内か全体かの指定 ?>
								</div>
							<?php endif;
							if( get_next_post() ): ?>
								<div class="alignright">
									<?php next_post_link('%link', '%title  »', TRUE, ''); ?>
								</div>
							<?php endif; ?>
						</div>
						<!-- /ページナビゲーション-->		
					<?php endwhile; else: ?>
					<p>記事がない場合に表示させる文章など。<br clear="all" /></p>
				<?php endif;
			
			/* 投稿画面で <!--nextpage--> と書くと、その部分でページが分割
			 * before
			 * link_before
			 * */ 
			$args = array(
				'before' => '<div class="page-link">',
				'after' => '</div>',
				'link_before' => '<span>',
				'link_after' => '</span>'
				);
				wp_link_pages($args);
			?>
					
			<?php comments_template(); ?>
		</div></article>
		<?php get_sidebar( 'blog' ); ?>
	</div><!-- /.main-container -->
	
<!-- フッター読み込み footer.phpを読み込んでくれる -->
<?php get_footer(); ?>
