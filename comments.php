	<?php comment_form(); ?>

	<div id="comment-area">
		<?php if( have_comments() ): // コメントがあったら ?>
			<h3 id="comments">Comment</h3>
			<ol class="commets-list">
				<?php wp_list_comments( 'avatar_size=55' ); ?>
			</ol>
		<?php endif; ?>
	</div>
	
	<div class="comment-page-link">
		<?php paginate_comments_links(); ?>
	</div>
