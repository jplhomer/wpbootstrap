		</div> <!-- end #container -->

		<footer role="contentinfo" class="page-footer">
		
			<div id="inner-footer" class="container clearfix">

				<div id="supplementary" class="row">
					<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
					<div id="first" class="widget-area span4" role="complementary">
						<?php dynamic_sidebar( 'sidebar-3' ); ?>
					</div><!-- #first .widget-area -->
					<?php endif; ?>
				
					<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
					<div id="second" class="widget-area span4" role="complementary">
						<?php dynamic_sidebar( 'sidebar-4' ); ?>
					</div><!-- #second .widget-area -->
					<?php endif; ?>
				
					<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
					<div id="third" class="widget-area span4" role="complementary">
						<?php dynamic_sidebar( 'sidebar-5' ); ?>
					</div><!-- #third .widget-area -->
					<?php endif; ?>
				</div><!-- #supplementary -->
		
				<p class="attribution row">
					<span class="pull-right">Developed by <a href="http://jplhomer.org/">Joshua P. Larson</a> using the <a href="http://twitter.github.com/bootstrap/index.html" target="_blank">Twitter Bootstrap framework</a>.</span>
					&copy; <?php bloginfo('name'); ?> <?php _e("is powered by", "bonestheme"); ?> <a href="http://wordpress.org/" title="WordPress">WordPress</a> <span class="amp">&</span> <a href="http://www.themble.com/bones" title="Bones" class="footer_bones_link">Bones</a>.
				</p>
			
			</div> <!-- end #inner-footer -->
			
		</footer> <!-- end footer -->
		
		
		<!-- scripts are now optimized via Modernizr.load -->	
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/scripts.js"></script>
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>