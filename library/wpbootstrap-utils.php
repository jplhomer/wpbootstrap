<?php
/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function wpbootstrap_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'wpbootstrap_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function wpbootstrap_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpbootstrap' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyeleven_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function wpbootstrap_auto_excerpt_more( $more ) {
	return ' &hellip;' . wpbootstrap_continue_reading_link();
}
add_filter( 'excerpt_more', 'wpbootstrap_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function wpbootstrap_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= wpbootstrap_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'wpbootstrap_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function wpbootstrap_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wpbootstrap_page_menu_args' );

if ( ! function_exists( 'wpbootstrap_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function wpbootstrap_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<ul class="pager">
				<li class="previous"><?php next_posts_link( __( '&larr; Older', 'wpbootstrap' ) ); ?></li>
				<li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'wpbootstrap' ) ); ?></li>
			</ul>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // wpbootstrap_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Twenty Eleven 1.0
 * @return string|bool URL or false when no link is present.
 */
function wpbootstrap_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function wpbootstrap_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="row"'; // . $class . '"';
}

if ( ! function_exists( 'wpbootstrap_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function wpbootstrap_posted_on() {
	printf( __( '<p class="meta muted"><i class="icon-time"></i> <time datetime="%1$s" pubdate>%2$s</time> by <a href="%3$s">%4$s</a>.</p>' ),
		esc_attr( get_the_date( 'c' ) ),
		esc_attr( get_the_time() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists('wpbootstrap_post_meta') ) :
/**
 * Prints HTML with meta information for the current post - category, tag, edit link..
 *
 * @since WP Bootstrap 0.1
 */
function wpbootstrap_post_meta() {
	if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ' ', 'wpbootstrap' ) );
		if ( $categories_list ):
			?>
			<span class="cat-links mute"><i class="icon-bookmark"></i>
			<?php printf( __( ' %2$s', 'wpbootstrap' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list ); ?>
			</span>
		<?php endif; // End if categories ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ' ', 'wpbootstrap' ) );
			if ( $tags_list ): ?>
		<span class="tag-links mute"><i class="icon-tag"></i>
			<?php printf( __( ' %2$s', 'wpbootstrap' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list 
		endif; // End if 'post' == get_post_type() 

		edit_post_link( __( 'Edit', 'wpbootstrap' ), '<span class="edit-link btn pull-right">', '</span>' ); 
}

endif;

/**
 * Removes all but wanted classes for the nav menu.
 *
 * @since WP Bootstrap 0.1
 */

add_filter( 'nav_menu_css_class', 'additional_active_item_classes', 10, 2 );

function additional_active_item_classes($classes = array(), $menu_item = false){

	if(in_array('current-menu-item', $menu_item->classes)){
		$classes[] = 'active';
	}

	return $classes;
}

/**
 * Walker class for changing submenu class
 *
 * @since WP Bootstrap 0.1
 */

class Add_Submenu_Class extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }
}
?>