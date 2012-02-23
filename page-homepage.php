<?php
/*
Template Name: Hero Homepage
*/
?>

<?php get_header() ?>
			<!-- Main hero unit for a primary marketing message or call to action -->

			
			<!-- load feature from Hero Feature sidebar. If more than one widget, use the carousel -->
			<?php if ( count_sidebar_widgets('hero-features', false) > 1 ) : ?>
			<!--<div class="hero-unit">-->
				<div class="carousel" id="hero-carousel">
					<!-- Carousel items -->
					<div class="carousel-inner">
					<?php dynamic_sidebar( 'hero-features' ); ?>
					</div>
					<!-- Carousel nav -->
					<a class="carousel-control left" href="#hero-carousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#hero-carousel" data-slide="next">&rsaquo;</a>
				</div>
			<!-- </div> -->
			<?php elseif ( count_sidebar_widgets('hero-features', false) === 1 ) : // if there's only one widget in the Hero Features sidebar, don't do Carousel ?>

			<?php dynamic_sidebar( 'hero-features' ); // class hero-unit is added via widget ?>

			<?php else : // if no widget has been added to the Hero Features sidebar ?>
			<div class="hero-unit">
				<h1>Hello, world!</h1>
				<p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
				<p>Update this section by going to <strong>Dashboard &rarr; Appearance &rarr; Widgets</strong>. Use the <strong>Hero Feature</strong> sidebar. 
				<br />Be sure to set the <em>hero-unit</em> class.</p>
				<p><a class="btn btn-primary btn-large" href="/wp-admin/widgets.php">Do it now &raquo;</a></p>
			</div>			
			<?php endif; ?>
			
			<!-- Example row of columns -->
			<div class="row">
			<?php if ( ! dynamic_sidebar( 'hero-featurettes' ) ) : ?>
				<div class="alert alert-info">
					This is where you could start putting featurettes.<br />
					Add some in <strong>Dashboard &rarr; Appearance &rarr; Widgets</strong>. Use the <strong>Hero Featurettes</strong> sidebar.
				</div>
			<?php endif; ?>
			</div>
<?php get_footer(); ?>