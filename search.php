<?php get_header(); ?>
			
			<div id="content" class="row">
			
				<div id="main" class="span8" role="main">
				
					<h1 class="archive_title"><span>Search Results for:</span> <?php echo esc_attr(get_search_query()); ?></h1>
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header class="page-header">
							
							<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
							
							<?php wpbootstrap_posted_on(); ?>							
						
						</header> <!-- end article header -->
					
						<section class="post_content">
							<?php the_excerpt('<span class="read-more">Read more on "'.the_title('', '', false).'" &raquo;</span>'); ?>
					
						</section> <!-- end article section -->
						
						<footer>
					
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="pager clearfix">
								<li class="previous"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
								<li class="next"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
							</ul>
						</nav>
					<?php } ?>			
					
					<?php else : ?>
					
					<!-- this area shows up if there are no results -->
					
					<article id="post-not-found">
						<header>
							<h1>No Results Found</h1>
						</header>
						<section class="post_content">
							<p>Sorry, but the requested resource was not found on this site.</p>
						</section>
						<footer>
						</footer>
					</article>
					
					<?php endif; ?>
				
				</div> <!-- end #main -->
				

					
				<?php get_sidebar(); ?>
							
    
			</div> <!-- end #content -->

<?php get_footer(); ?>