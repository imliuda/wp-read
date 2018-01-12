<?php
	$category_archive_type = get_option( 'category_archive_type', 'Masonry' );
	
	if ( $category_archive_type == 'No Sidebar' )
	{
		get_template_part( 'blog', 'nosidebar' );
	}
	elseif ( $category_archive_type == 'Masonry' )
	{
		get_template_part( 'blog', 'masonry' );
	}
	else
	{
		get_template_part( 'blog', 'sidebar' );
	}
?>