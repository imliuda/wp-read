<?php
	$blog_type = 'Sidebar';
	
	if (isset($_GET['blog_type']))
	{
		if ($_GET['blog_type'] == 'no_sidebar')
		{
			$blog_type = 'No Sidebar';
		}
		elseif ($_GET['blog_type'] == 'masonry')
		{
			$blog_type = 'Masonry';
		}
	}
	else
	{
		$blog_type = get_option('blog_type', 'Sidebar');
	}
	
	
	if ($blog_type == 'No Sidebar')
	{
		get_template_part('blog', 'nosidebar');
	}
	elseif ($blog_type == 'Masonry')
	{
		get_template_part('blog', 'masonry');
	}
	else
	{
		get_template_part('blog', 'sidebar');
	}
?>