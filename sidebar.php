				<div id="sidebar1" class="sidebar span4" role="complementary">
				
					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="alert">
						
							<p>Please activate some Widgets.</p>
						
						</div>

					<?php endif; ?>

				</div>