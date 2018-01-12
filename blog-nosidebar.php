<?php
	get_header();
?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		<div class="blog-posts readable-content <?php if (is_archive()) { echo esc_attr('post-archive'); } ?>">
			<?php
				if (is_category())
				{
					?>
						<header class="page-header">
							<h1 class="page-title">
								<?php
									_e('Post Category', 'read');
								?>
								
								<span class="on"><?php _e('&#8594;', 'read'); ?></span>
								
								<span><?php echo single_cat_title(); ?></span>
							</h1>
						</header>
					<?php
				}
				elseif (is_tag())
				{
					?>
						<header class="page-header">
							<h1 class="page-title">
								<?php
									_e('Posts Tagged', 'read');
								?>
								
								<span class="on"><?php _e('&#8594;', 'read'); ?></span>
								
								<span><?php echo single_tag_title(); ?></span>
							</h1>
						</header>
					<?php
				}
				elseif (is_author())
				{
					?>
						<header class="page-header">
							<h1 class="page-title">
								<?php
									_e('Author Archives', 'read');
								?>
								
								<span class="on"><?php _e('&#8594;', 'read'); ?></span>
								
								<span><?php the_author(); ?></span>
							</h1>
						</header>
					<?php
				}
				elseif (is_date())
				{
					?>
						<header class="page-header">
							<h1 class="page-title">
								<?php
									_e('Date Archives', 'read');
								?>
								
								<span class="on"><?php _e('&#8594;', 'read'); ?></span>
								
								<span>
									<?php
										if (is_day()) :
										
											printf(get_the_date());
										
										elseif (is_month()) :
										
											printf(get_the_date(_x('F Y', 'monthly archives date format', 'read')));
										
										elseif (is_year()) :
										
											printf(get_the_date(_x('Y', 'yearly archives date format', 'read')));
										
										else :
										
											_e('Archives', 'read');
										
										endif;
									?>
								</span>
							</h1>
						</header>
					<?php
				}
			?>
			
			<?php
				if (have_posts()) :
					while (have_posts()) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
								<header class="entry-header">
									<h1 class="entry-title">
										<?php
											$hide_post_title = get_option($post->ID . 'hide_post_title', false);
											
											if ($hide_post_title)
											{
												$hide_post_title_out = 'style="display: none;"';
											}
											else
											{
												$hide_post_title_out = "";
											}
										?>
										<a <?php echo $hide_post_title_out; ?> href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h1>
								</header>
								
								<footer class="entry-meta">
									<span class="post-category">
										<?php
											_e('posted in', 'read');
											
											echo ' ';
											
											the_category(', ');
										?>
									</span>
									<span class="post-date">
										<?php
											_e('on', 'read');
										?>
										
										<a href="<?php the_permalink(); ?>" title="<?php the_time(); ?>" rel="bookmark">
											<time class="entry-date" datetime="<?php echo get_the_date('c'); ?>">
												<?php
													echo get_the_date();
												?>
											</time>
										</a>
									</span>
									<span class="by-author">
										<?php
											_e('by', 'read');
										?>
										
										<span class="author vcard">
											<a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php _e('View all posts by ', 'read') . get_the_author(); ?>" rel="author">
												<?php
													the_author();
												?>
											</a>
										</span>
									</span>
									<?php
										if (comments_open() || get_comments_number())
										{
											?>
												<span class="comments-link">
													<?php
														comments_popup_link(__('0 Comments', 'read'),
																			__('1 Comment', 'read'),
																			__('% Comments', 'read'));
													?>
												</span>
											<?php
										}
									?>
									<?php
										edit_post_link(__('Edit', 'read'), '<span class="edit-link">', '</span>');
									?>
								</footer>
								
								<?php
									if (has_post_thumbnail())
									{
										?>
											<div class="featured-image">
												<a href="<?php the_permalink(); ?>">
													<?php
														the_post_thumbnail('pixelwars__image_size_1');
													?>
												</a>
											</div>
										<?php
									}
								?>
								
								<div class="entry-content clearfix">
									<?php
										if (has_excerpt())
										{
											the_excerpt();
											
											echo '<a class="more-link" href="'. get_permalink() . '">' . __('Continue reading <span class="meta-nav">&#8594;</span>', 'read') . '</a>';
										}
										else
										{
											$theme_excerpt = get_option('theme_excerpt', 'No');
											
											if ($theme_excerpt == 'Yes')
											{
												the_excerpt();
											}
											elseif ($theme_excerpt == 'standard')
											{
												$format = get_post_format();
												
												if ( $format == false )
												{
													the_excerpt();
												}
												else
												{
													the_content(__('Continue reading <span class="meta-nav">&#8594;</span>', 'read'));
												}
											}
											else
											{
												the_content(__('Continue reading <span class="meta-nav">&#8594;</span>', 'read'));
											}
										}
									?>
									
									<?php
										wp_link_pages(array('before' => '<div class="page-links clearfix">' . __('Pages:', 'read'), 'after' => '</div>'));
									?>
								</div>
							</article>
						<?php
					endwhile;
				else :
				
					get_template_part('no', 'posts');
				
				endif;
			?>
			
			<?php
				get_template_part('part', 'pagination');
			?>
		</div>
	</div>
</div>

<?php
	get_footer();
?>