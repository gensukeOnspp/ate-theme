	<form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
		<input type="text" id="search" name="s" value="<?php the_search_query(); ?>">
		<input type="image" class="searchbutton" value=" ">
	</form>
