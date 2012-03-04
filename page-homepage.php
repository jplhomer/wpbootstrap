<?php
/*
Template Name: Hero Homepage
*/
?>

<?php get_header() ?>
			<!-- Main hero unit for a primary marketing message or call to action -->

			<div class="hero-unit">
				<h1><?php echo of_get_option('hero_heading'); ?></h1>
				<?php echo of_get_option('hero_description'); ?>
			</div>
			
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