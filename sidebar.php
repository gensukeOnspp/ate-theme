<!-- sidebar -->
<nav><ul>

<?php /*if ( is_active_sidebar( 'Navigation Widget 1' ) ) :
	dynamic_sidebar( 'Navigation Widget 1' );
else:*/ ?>
<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar(1)): ?>

	<div class="widget">
		<h2>No Widget</h2>
		<p>ウィジットは設定されていません。</p>
	</div>

<?php endif; ?>

</ul></nav>
<!-- /sidebar -->
