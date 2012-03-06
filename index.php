<?php get_header(); ?>
			
			<div id="content" class="row">
					
				<div id="main" class="span8" role="main">
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						<header class="page-header">
							
							<h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							
							<?php wpbootstrap_posted_on(); ?>
						
						</header> <!-- end article header -->
					
						<section class="post_content">
							<?php the_content('Read more &raquo;'); ?>
					
						</section> <!-- end article section -->
						
						<footer class="well">
							<?php wpbootstrap_post_meta(); ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "wpbootstrap")) ?></li>
								<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "wpbootstrap")) ?></li>
							</ul>
						</nav>
					<?php } ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
						<header>
							<h1>Not Found</h1>
						</header>
						<section class="post_content">
							<p>Sorry, but the requested resource was not found on this site.</p>
						</section>
						<footer>
						</footer>
					</article>
					
					<?php endif; ?>
				
				</div> <!-- end #main -->
				
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>