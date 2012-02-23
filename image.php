<?php get_header(); ?>

			<div id="content" class="row">
			
					<div id="main" class="span8" role="main">
					
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
      				
      						<header class="page-header">
        						<h1 class="h2"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h2>
      						</header>
      				
      						<section class="post_content clearfix">
								<!-- To display the current image in the photo gallery -->
								<div class="thumbnails row">
									<div class="attachment-img span8">
										<a href="<?php echo wp_get_attachment_url($post->ID); ?>" class="thumbnail">
										<?php echo wp_get_attachment_image( $post->ID, 'large' );
											if ($image) : ?>
												<img src="<?php echo $image[0]; ?>" alt="" />
											<?php endif; ?>
										</a>
									</div>
								</div>
				
								<!-- To display thumbnail of previous and next image in the photo gallery -->
								<ul class="pager">
									<li class="next"><?php next_image_link() ?></li>
									<li class="previous"><?php previous_image_link() ?></li>
								</ul>
								
      						</section>
      						
      						<footer>
								<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ' ', '</p>'); ?>
      						</footer>
    					</article>
    					
    					<?php endwhile; else: ?>
    					
    					<div class="help">
    						<p>Sorry, no attachments matched your criteria.</p>
    					</div>
					
						<?php endif; ?>
					
  					</div> <!-- end #main -->
  					
  					<?php get_sidebar(); // sidebar 1 ?>
  				
  			</div> <!-- end #content -->

<?php get_footer(); ?>