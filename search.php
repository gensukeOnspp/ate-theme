<!-- search.php 抜粋 -->
<?php get_header(); ?>

<div class="main-container">
	<?php the_bread(); ?>
		
	<!-- div class="search_results" -->
	<article>
	<?php if(have_posts()): ?>
		<!-- 検索ワードを出力 -->
		<h4><?php the_search_query(); ?>の検索結果 : <?php echo $wp_query->found_posts; ?>件</h4>
		<?php while(have_posts()): the_post(); ?>
			<section>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<!--<p class="date"><?php //echo get_the_date(); ?></p>-->
				<div class="excerpt">
					<?php
						$content = get_the_content();
						//文字列
						$sentence = strip_tags($content);
						$wd = get_search_query();
						//文字列から指定の文字が最初に出現する位置を取得
						$num = mb_strpos($sentence, $wd, 0, "utf-8");
						if($num >= 20){
							// 文字数を指定して抽出する関数
							// mb_substr(文字列, 開始位置, 文字数); 
							// echo mb_substr($sentence, $num-20, 200, "utf-8");
							$tw_sentence = mb_substr($sentence, $num-20, 120, "utf-8");
						}else{
							$tw_sentence = mb_substr($sentence, 0, 120, "utf-8");
							//$tw_sentence .= "…"
							//$tw_sentence .= mb_substr($sentence, $num, 120, "utf-8");							
						}
						$result = str_replace($wd, '<b style="font-size:14px; opacity:1;">'.$wd.'</b>', $tw_sentence);
						echo $result;
					?>
					<!--<p><a href="<?php //the_permalink(); ?>">続きを読む</a></p>-->
				</div><!-- end of .excerpt -->
			</section>
		<?php endwhile; ?>
		<?php list_paginate(); ?>
	 
	<!-- 検索ワードに該当する記事がない場合の処理-->
	<?php else: ?>
		<!-- 検索ワードを出力-->
		<h2>「<span><?php the_search_query(); ?></span>」の検索結果が見つかりませんでした。</h2>
		<p>別のキーワードでお試しください。</p>
		<!-- 検索フォームを表示-->
		<?php get_search_form(); ?>
	<?php endif;  ?>
	<!--/div>< end of .search_results -->
	</article>

</div><!-- .main-container -->
<?php get_footer(); ?>
