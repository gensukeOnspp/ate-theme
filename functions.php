<?php
	if ( ! isset( $content_width ) ){
		$content_width = 600;
	}

	/* 
	 * 記事タイトルを先にする場合、区切り文字をページタイトルの右に出力する引数「’right’」を加える
	 * from twentyfourteenテーマ
	 */
	/* wp_title( '|', true, 'right' ) */
	function twentyfourteen_wp_title( $title, $sep ) {
		/*
		* $page	「固定ページ」や「投稿」の現在のページ番号。
		* $paged	「カテゴリー」や「タグ」の一覧ページの現在のページ番号。
		* どちらも1ページ目は0、2ページ目以降は2、3…と整数（int）が格納される。
		* */
		global $paged, $page;
		 
		// フィードリクエストだった場合、「ページタイトル」を返す
		if ( is_feed() ){
			return $title;
		}	
		$title .= get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description ){
			$title = "$title $sep $site_description";
		 }
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ){
			$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );
		}	
		return $title;
	}
	add_filter( 'wp_title', 'twentyfourteen_wp_title', 10, 2 );
	/* ここまで */
	

	/*
	register_nav_menus(array(
			'main_navigation' => 'Primary Navigation'
		)
	);
	* */
	/*
	 * ウィジェット
	 * 一つしかないけど、複数できる
	 */
	function this_theme_widgets_init() {
		register_sidebar();
	}
	add_action( 'widgets_init', 'this_theme_widgets_init' );
	if(function_exists('register_sidebars')) {
		register_sidebars(2, array(
			'name' =>  'Navigation Widget %d',
			// これがあるとなぜかダメ
			/*'id' => 'rightbar',*/
			'description' => '',
			'before_widget' => '<li>',
			'after_widget' => '</li>'
			)
		);
	}
	/* ここまで */
	

	// ページに、カテゴリメタボックスを追加する
	/*
	function add_categories_for_pages(){
		register_taxonomy_for_object_type('category', 'page');
	}
	add_action('init','add_categories_for_pages');
	* */

	/* 
	 * 固定ページ以外のメニュー
	 */
	// カスタムメニューを有効化
	add_theme_support( 'menus' );
	// カスタムメニューの「場所」を設定するコード
	register_nav_menu( 'main-navi', 'メインのナビゲーション' );
	register_nav_menu( 'footer-navi', 'フッターのナビゲーション' );
	register_nav_menu( 'top-navi', 'トップのナビゲーション' );
	/*ここまで */


	// RSS2 のフィードリンクを表示してくれるもの
	add_theme_support( 'automatic-feed-links' );

	// メニューの URL が空の場合 <a></a> タグを出力しない。
	/*
	function new_walker_nav_menu_start_el($item_output){

		preg_match_all("|<a>(.*)</a>|", $item_output, $data, PREG_PATTERN_ORDER);

		for($i = 0; $i < count($data[0]); $i++){
			$match_data = preg_quote($data[0][$i], '/');
			$item_output = preg_replace('/'.$match_data.'/', $data[1][$i], $item_output);
		}
		return $item_output;
	}
	add_filter( 'walker_nav_menu_start_el', 'new_walker_nav_menu_start_el');
	* */
	
	/*
	 * WordPress本文にショートコードを使ってどこにでもメニューを配置できる
	 */
	function print_menu_shortcode($atts, $content = null) {
		extract(shortcode_atts(array( 'name' => null,
										'head_title' => null),
										 $atts), EXTR_SKIP);
		$demand_title;
		if (empty($head_title)) {
			$demand_title = get_the_title();
		} else {
			$demand_title = $head_title;
		}	
		$for_page_menu = '<div id="page-side">';
		$for_page_menu .= '<p>' . $demand_title . '</p>';
		$for_page_menu .= wp_nav_menu( array( 'menu' => $name, 'container_class' => 'sidenavi', 'echo' => false ) );
		$for_page_menu .= '</div>';
		return $for_page_menu;
	}
	add_shortcode('menu', 'print_menu_shortcode');
	/*ここまで */
	
	
	/*
	 * 投稿にトップURLを呼び出すショートコード
	 */
	function call_root_url($atts, $content = null) {
		//extract(shortcode_atts(array( 'name' => null, 'head_title' => null ), $atts), EXTR_SKIP);
		return get_template_directory_uri();
	}
	add_shortcode('root_addr', 'call_root_url');
	/* ここまで */

	
	if(is_search()){
		// the_content のタグ挿入を無効化したい
		remove_filter('the_content', 'wpautop');
	}
	
	function convert_search_query() {
		global $wp_query;
		$squery = $wp_query->query['s'];
		$kanaquery = mb_convert_kana($squery, 'R');
		return $kanaquery;
	}
	add_action('get_search_query', 'convert_search_query');
	
	/*
	 * テーマの中で、このコードを使用してjQueryのをロードすることができる
	 */
	function mh_load_my_script() { 
		wp_enqueue_script( 'jquery' );
	}
	add_action( 'wp_enqueue_scripts', 'mh_load_my_script' ); 
	
	// 「script.php」をテーマフォルダに配置
	$cssdir = get_stylesheet_directory_uri();
	wp_enqueue_script( 'theme-script', $cssdir.'/script.php', array('jquery'));
	/* ここまで */


	/* ページネーション */
	function list_paginate(){
		global $wp_query, $paged;
		
		// need an unlikely integer
		// ありえない整数値をいれておくことで、様々な整数に対応
		$big = 999999999;
		
		echo paginate_links( array(
			// 'base' ページ番号付きのリンクを生成するために使われるベースの URL を指定
			/*
			 * get_pagenum_link( not a link )
			 * apply_filters('get_pagenum_link', $result)とプラグインによって変更される場合があるため
			* */
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => ($paged ? $paged : 1),
			'total' => $wp_query->max_num_pages
		) );
	}
	
	
	/*
	 * パンくずリストを表示するほぼコピペ関数
	 */
	function the_bread( $query = true ){
	 
		if( is_archive()){
			$cate = get_queried_object();
		}else if( is_single() ){
			$cate = get_the_category();
			$cate = $cate[0];
		}
		$queried_object = get_queried_object();
		$current = array( "name"=>$cate->name , "term_id"=>$cate->term_id );
		$parents = array();
		 
		echo '<ol class="bread clearfix" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">';
		 
		if( is_home() ){
			//トップページの場合にはリンクを表示させない
			echo '<li>ホーム</li>';
		}elseif( is_search() ){
			$search_query =  get_search_query();
			echo '<li><a href="' . home_url() . '/" itemprop="url"><span itemprop="title">ホーム</span></a> > </li><li>「'. $search_query .'」の検索結果</li>';
		}elseif( is_page() ){
			//固定ページの処理
			echo '<li><a href="' . home_url() . '/" itemprop="url"><span itemprop="title">ホーム</span></a> > </li>';
			 
			if( $parent_ID = $queried_object->post_parent ){
				 
				while( $parent_ID ){
					$parent = get_post( $parent_ID );
					// 配列に要素を追加する
					array_unshift($parents , $parent);
					$parent_ID = $parent->post_parent;
				}
				 
				foreach( $parents as $parent ){
					echo '<li><a href="'. get_permalink( $parent->ID ) .'" itemprop="url"><span itemprop="title">'. $parent->post_title .'</span></a> > </li>';
				}
			}
			 
		}else{
			//それ以外のページの処理
			echo '<li><a href="' . home_url() . '/" itemprop="url"><span itemprop="title">ホーム</span></a> > </li>';
			 
			while( $cate->parent ){
				//ひとつ上の階層のカテゴリデータを配列$parentsの先頭に格納
				//下からカテゴリ階層を遡るのでデータは常に先頭に格納する必要がある
				$cate = get_category( $cate->parent );
				array_unshift($parents , $cate);
			}
			 
			//$parentsの内容を表示
			foreach( $parents as $parent ){
				echo '<li><a href="'. get_category_link( $parent->term_id ) .'" itemprop="url"><span itemprop="title">' . $parent->name . '</span></a> > </li>';
			}
			 
			//現在表示されているカテゴリの表示
			if( is_archive()){
				echo '<li>'.$current["name"].'</li>';
			}else if( is_single() ){
				//echo '<li><a href="'. get_category_link(  $current[" term_id"] ) .'" itemprop="url"><span itemprop="title">' . $parent->name . '</span></a> > </li>';				
				echo '<li><a href="'. get_category_link( $current[" term_id"]="" ) .'"="" itemprop="url"><span itemprop="title">'. $current["name"] .'</span></a> > </li>';
			}
		}
		echo '<li>'.$queried_object->post_title.'</li>';
		echo "</ol>";
	}
	/* ここまで */

	// アップデートチェックの初期化
	require 'theme-update-checker.php'; // ライブラリのパス
	$example_update_checker = new ThemeUpdateChecker(
		'ateno-theme', // テーマフォルダ名
		'http://172.16.1.147/update-info.json' // JSONファイルのURL
	);

?>
