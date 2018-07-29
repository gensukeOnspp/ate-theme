		<div class="slide"><?php echo do_shortcode("[huge_it_slider id='2']"); ?></div>
		<div id="content">
			<?php
				$categories = array('news', 'activity_report');
				foreach($categories as $cat){ ?>
					<section>
						<div class="<?php echo $cat; ?>">
							<?php
								/*
								 *  指定したカテゴリーの ID を取得
								 * 	$category_id = get_cat_ID( $cat );
								 * */
								// カテゴリースラッグからカテゴリー名とカテゴリーのリンクを取得
								$cat_obj = get_category_by_slug( $cat );
								// このカテゴリーの URL を取得
								$category_link = get_category_link( $cat_obj -> cat_ID );
							?>
							<!-- このカテゴリーへのリンクを出力 -->
							<a href="<?php echo esc_url( $category_link ); ?>"></a>
						</div>
						<?php
							$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
							
							$args = array(
								'posts_per_page' => 2,
								'category_name' => $cat,
								'paged' => $paged
							);
							$title_query = new WP_Query( $args );
							if($title_query -> have_posts()) :
								while($title_query -> have_posts()) : $title_query -> the_post(); ?>
									<dl>
										<dt><?php echo get_the_date(); ?></dt>
										<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><dd>
									</dl>
								<?php endwhile; else: ?>
								<p>なんかいろいろ<br clear="all" /></p>
							<?php endif;
						?>
					</section>
				<?php unset($cat); } ?>
			<div class="corner">
				<a href="<?php echo get_template_directory_uri(); ?>/donation"><div class="corner_round_1"></div></a>
				<a href="<?php echo get_template_directory_uri(); ?>/admission"><div class="corner_round_2"></div></a>
			</div>
		</div><!-- #content -->
		<aside>
			<a href="#" target="_blank"><div class="facebook"></div></a>
			<a href="http://fun-creation.co.jp/" target="_blank"><div class="fc_b"></div></a>
			<a href="http://funcrt-pb.fun-creation.co.jp/" target="_blank"><div class="ehon_b"></div></a>
		</aside>
