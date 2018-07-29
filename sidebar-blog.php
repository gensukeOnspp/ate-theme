<!-- sidebar -->
<ul id="rightbar">

<?php /*if ( is_active_sidebar( 'Navigation Widget 2' ) ) :
	dynamic_sidebar( 'Navigation Widget 2' );
else:*/ ?>
<!-- Navigation Widget 2を呼び出す
	それでも、sidebar.phpファイルはないとダメ -->
<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(2)): ?>

	<div class="widget">
		<h2>No Widget</h2>
		<p>ウィジットは設定されていません。</p>
	</div>

<?php endif; ?>

</ul>
<!-- /sidebar -->
