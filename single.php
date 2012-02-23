<?php get_header(); ?>
			
			<div id="content" class="row">
			
					<div id="main" class="span8" role="main">
					
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header class="page-header">
							
							<h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>
							
							<?php wpbootstrap_posted_on(); ?>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							
					
						</section> <!-- end article section -->
						
						<footer class="well">
			
							<?php wpbootstrap_post_meta(); ?>
							
						</footer> <!-- end article footer -->
						
						<?php comments_template(); ?>
					
					</article> <!-- end article -->
						
						<?php endwhile; ?>			
						
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