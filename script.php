<?php
    header('Content-Type: text/javascript; charset=UTF-8');
?>
window.onload = function () {
   /** ページトップ処理 **/
   // スクロールした場合
   jQuery(window).scroll(function() {
       // スクロール位置が400を超えた場合
       if (jQuery(this).scrollTop() > 400) {
           jQuery('#pagetop').fadeIn();
       } else {
           // ページトップへをフェードアウト
           jQuery('#pagetop').fadeOut();
       }
   });

   // ページトップクリック
   jQuery('#pagetop').click(function() {
       // ページトップへスクロール
       jQuery('html, body').animate({
           scrollTop: 0
       }, 300);
       return false;
   });
   
	// スクロールしながら指定位置（アンカー）まで移動ができる
	jQuery('ul.faq-items li a[href*=\\#]').click(function() {
		var target = jQuery(this.hash);
		if(target.length) {
			if(target) {
				var targetOffset = target.offset().top;
				jQuery('html, body').animate({scrollTop: targetOffset}, "slow");
				return false;
			}
		}
	});
	
	// 郵便番号から住所を検索する
	jQuery('button.zipcloud_search').click(function() {
		// 検索中であることを表示
		document.getElementById('state').value = '検索中...';
		// 郵便番号の取得
		var zipcode = document.getElementById('zipcode').value;
		// zipcloudAPIの呼び出し
		var element = document.createElement('script');
		element.type = 'text/javascript';
		element.charset = 'utf-8';
		element.src = 'http://zipcloud.ibsnet.co.jp/api/search?zipcode='+zipcode+'&callback=writeAddressByZipcloud';
		document.body.appendChild(element);
	});
	writeAddressByZipcloud = function(response) {
		// 検索中の表示を消去
		var element = document.getElementById('state');
		element.value = '';
		// エラー発生時は、アラートを出して終了
		if(response.status != 200) {
			alert(response.message);
			return false;
		}
		// 検索結果がなかった場合も、アラートを出して終了
		if(!response.results) {
			alert('該当する住所が見つかりませんでした');
			return false;
		}
		// 住所文字列の作成
		var address = response.results[0].address1 + response.results[0].address2;
		// 結果が１つの場合は、町域名まで含める
		if(response.results.length == 1) {
			address += response.results[0].address3;
		}
		element.value = address;
	};
	//document.write('<button type="button" class="zipcloud_search" onclick="searchAddressByZipcloud();">郵便番号から住所を検索</button>');
	
	if(jQuery("ul.form li").children().attr("type") == "hidden"){
		jQuery(".v-post .vf-greet").hide();
	}
};
