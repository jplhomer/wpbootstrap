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
		esc_attr( get_the_date() . ' at ' . get_the_time() ),
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

/************* HOMEPAGE WIDGET SETUP *****************/

/** 
 * Function to count sidebar widgets
 * Because it's awesome
 * Since WP Bootstrap 0.1
 */
function count_sidebar_widgets( $sidebar_id, $echo = true ) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return __( 'Invalid sidebar ID' );
    if( $echo )
        echo count( $the_sidebars[$sidebar_id] );
    else
        return count( $the_sidebars[$sidebar_id] );
}

/**
 * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
 * Source: http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
 */
function widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets	

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'widget-last ';
	}
	
	if(($my_widget_num[$this_id] == 1) && ($this_id == 'hero-features')) { // if it's the first one in the hero-features sidebar
		$class .= 'active '; // add the active class for the carousel
	}

	$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1);
	return $params;

}
add_filter('dynamic_sidebar_params','widget_first_last_classes');

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

/************* BOOTSTRAP IMAGE SETUP *****************/

/** 
 * Functions to make images responsive
 * They need to resize with the browser window and not have explicit dimensions
 * Since WP Bootstrap 1.2
 */

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Add "thumbnail" class
add_filter('wp_get_attachment_link','add_class_attachment_link',10,1);

function add_class_attachment_link($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a class="thumbnail"',$html);
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/************* BOOTSTRAP COMPONENTS SETUP *****************/

/** 
 * We want to filter through the_content() and add the necessary code for things like scrollspy, accordions, and navable tabs.
 * Since WP Bootstrap 1.2
 */

function slugify ($str) { // turn name into slug for ID
	$slug = str_replace(' ','-',strtolower($str));
	return $slug;	
}

function wpbootstrap_feature($type) { // check if feature is activated for post
	global $post;
	
	$custom = get_post_meta($post->ID, 'wpbootstrap_component' );
	
	if ($custom[0] == $type) {
		return true;
	} else {
		return false;
	}
}

function wpbootstrap_scrollspy($content) { // turn content into Bootstrap's ScrollSpy feature
	// STILL NEEDS TO WORK OUT OFFSET KINKS.
	$pattern = "/<h2 ?.*>(.*)<\/h2>/"; // grab all H2 elements
	preg_match_all($pattern, $content, $headings);
	// $headings[0] returns each element w/tag
	// $headings[1] returns the innerHTML of tag	

	if ($headings[1][0] != '') { // if there's somethin here
		// build navbar
		$navbar = '<div class="subnav" id="scrollspy-nav">';
		$navbar .= '<ul class="nav nav-pills">';
		foreach ($headings[1] as $item) {
			$navbar .= '<li><a href="#' . slugify($item) . '">' . $item . '</a></li>';
			
			// edit the H2 Tags themselves
			$search = "/<h2 ?.*>" . $item . "<\/h2>/";
			$replace = '<h2 id="' . slugify($item) . '">' . $item . '</h2>';
			$content = preg_replace( $search, $replace, $content );
		}
		$navbar .= '</ul>';
		$navbar .= '</div>';

		echo $navbar;
	}
	echo $content;
}

function wpbootstrap_navtabs($content) { // turn content into Bootstrap's Nav Pills feature
	$pattern = "/<h2 ?.*>(.*)<\/h2>/"; // grab all H2 elements
	preg_match_all($pattern, $content, $headings);
	// $headings[0] returns each element w/tag
	// $headings[1] returns the innerHTML of tag	

	if ($headings[1][0] != '') { // if there's somethin here
		$x = 0; //counter
		// build navbar
		$navbar .= '<ul class="nav nav-tabs">';
		foreach ($headings[1] as $item) {
			if ($x == 0) { $active = ' class="active"'; } else { $active = ''; }
			$navbar .= '<li' . $active . '><a data-toggle="tab" href="#' . slugify($item) . '">' . $item . '</a></li>';
			$x++;
		}
		$navbar .= '</ul><div class="tab-content">';
		
		$x = 0;
		foreach ($headings[1] as $item) { // print $navbar right before first panel, so we can have pre-material if wanted.
			// edit the H2 Tags themselves
			$search = "/<h2 ?.*>" . $item . "<\/h2>/";
			if ($x == 0) {
				$replace = $navbar . '<div id="' . slugify($item) . '" class="tab-pane fade active in"><h2>' . $item . '</h2>';
			} else {
				$replace = '</div><div id="' . slugify($item) . '" class="tab-pane fade"><h2>' . $item . '</h2>';
			}
			$content = preg_replace( $search, $replace, $content );
			$x++;
		}
		$content .= $content . '</div></div>'; // gotta close off the last tab & container.
	}
	echo $content;
}

function wpbootstrap_navpills($content) { // turn content into Bootstrap's Nav Tabs feature
	$pattern = "/<h2 ?.*>(.*)<\/h2>/"; // grab all H2 elements
	preg_match_all($pattern, $content, $headings);
	// $headings[0] returns each element w/tag
	// $headings[1] returns the innerHTML of tag	

	if ($headings[1][0] != '') { // if there's somethin here
		$x = 0; //counter
		// build navbar
		$navbar .= '<ul class="nav nav-pills">';
		foreach ($headings[1] as $item) {
			if ($x == 0) { $active = ' class="active"'; } else { $active = ''; }
			$navbar .= '<li' . $active . '><a data-toggle="tab" href="#' . slugify($item) . '">' . $item . '</a></li>';
			$x++;
		}
		$navbar .= '</ul><div class="tab-content">';
		
		$x = 0;
		foreach ($headings[1] as $item) { // print $navbar right before first panel, so we can have pre-material if wanted.
			// edit the H2 Tags themselves
			$search = "/<h2 ?.*>" . $item . "<\/h2>/";
			if ($x == 0) {
				$replace = $navbar . '<div id="' . slugify($item) . '" class="tab-pane fade active in"><h2>' . $item . '</h2>';
			} else {
				$replace = '</div><div id="' . slugify($item) . '" class="tab-pane fade"><h2>' . $item . '</h2>';
			}
			$content = preg_replace( $search, $replace, $content );
			$x++;
		}
		
		$content .= $content . '</div></div>'; // gotta close off the last tab & container.
	}
	echo $content;	
}

function wpbootstrap_accordion($content) { // turn content into Bootstrap's Accordion (collapse plugin)
	$pattern = "/<h2 ?.*>(.*)<\/h2>/"; // grab all H2 elements
	preg_match_all($pattern, $content, $headings);
	// $headings[0] returns each element w/tag
	// $headings[1] returns the innerHTML of tag	

	if ($headings[1][0] != '') { // if there's somethin here
		$x = 0; //counter
		// build accordion
		$accordion = '<div class="accordion" id="page-accordion">';
		foreach ($headings[1] as $item) {
			if ($x == 0) { 
				$replace = $accordion. '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#page-accordion" href="#' . slugify($item) . '">' . $item . '</a></div><div id="' . slugify($item) . '" class="accordion-body collapse in"><div class="accordion-inner">';
			} else { 
				$replace = '</div></div></div>'; // end preceding group 
				$replace .= '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#page-accordion" href="#' . slugify($item) . '">' . $item . '</a></div><div id="' . slugify($item) . '" class="accordion-body collapse"><div class="accordion-inner">';
			}
			$search = "/<h2 ?.*>" . $item . "<\/h2>/";
			$content = preg_replace( $search, $replace, $content );
			$x++;
		}
		$content .= '</div></div></div></div>'; // end last accordion-body, accordion-group, and accordion			
	}
	echo $content;	
}

function add_bootstrap_features($content) { // can turn the_content()'s H2 tags into Scrollspy, nav-tabs, nav-pills, or accordion!
	$content = wpbootstrap_plead($content); // we want to emphasize the first paragraph... maybe
	
	// only add features if they're activated (within custom post meta)
	if ( wpbootstrap_feature('scrollspy') ) {
		wpbootstrap_scrollspy($content); // active ScrollSpy for the document
	} else if ( wpbootstrap_feature('nav-tabs') ) { // Add Tabs for each H2 repesented
		wpbootstrap_navtabs($content); // Nav Tabs for the document
	} else if ( wpbootstrap_feature('nav-pills') ) { // Add Pills for each H2 repesented
		wpbootstrap_navpills($content); // Nav Pills for the document
	} else if ( wpbootstrap_feature('accordion') ) { // Create accordion using each H2 repesented
		wpbootstrap_accordion($content); // You get the picture
	} else {
		return $content;
	}
}

// priority is low so shortcodes and stuff still fire
add_filter('the_content', 'add_bootstrap_features', 12);

/* ADD META FOR BOOTSTRAP COMPONENTS OPTIONS */

/* Fire meta box setup function on the post editor screen */
add_action( 'load-post.php', 'wpbootstrap_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'wpbootstrap_post_meta_boxes_setup' );

/* Meta box setup function */
function wpbootstrap_post_meta_boxes_setup() {
	
	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'wpbootstrap_add_post_meta_boxes' );

	/* Save the wpbootstrap_components meta on 'save_post' hook. */
	add_action( 'save_post', 'wpbootstrap_components_save_meta', 10, 2 );
}

function wpbootstrap_add_post_meta_boxes() {
	add_meta_box(
		'wpbootstrap-component',
		esc_html__( 'Bootstrap Components', 'wpbootstrap' ),
		'wpbootstrap_components_meta_box',
		'page',
		'side',
		'default'
	);	
}

/* show the damn box, already */
function wpbootstrap_components_meta_box( $object, $box ) { ?>
	<?php wp_nonce_field( basename( __FILE__ ), 'wpbootstrap_components_nonce' ); ?>
	
	<p>
		<?php _e( "Choose a Twitter Bootstrap feature to use on the page. It will parse each H2 tag in your document.", 'wpbootstrap' ); ?>
	</p>
	
	<?php $custom = get_post_custom( $object->ID );
	$component = $custom['wpbootstrap_component'][0]; 
	$selected = ' selected="selected"'; ?>
	
	<select name="wpbootstrap_component">
		<option value=""></option>
		<option value="scrollspy"<?php if ($component == "scrollspy" ) { echo $selected; } ?>>Scrollspy</option>
		<option value="nav-tabs"<?php if ($component == "nav-tabs" ) { echo $selected; } ?>>Nav-Tabs</option>
		<option value="nav-pills"<?php if ($component == "nav-pills" ) { echo $selected; } ?>>Nav-Pills</option>
		<option value="accordion"<?php if ($component == "accordion" ) { echo $selected; } ?>>Accordion</option>
	</select>
	<?php
}

/* Save the dern option */
function wpbootstrap_components_save_meta( $post_id, $post ) {
	/* vurrrify dis shiz */
	if ( !isset( $_POST['wpbootstrap_components_nonce'] ) || !wp_verify_nonce( $_POST['wpbootstrap_components_nonce'], basename( __FILE__ ) ) )
		return $post_id;
		
	// get post type
	$post_type = get_post_type_object( $post->post_type );
	
	// I can haz permission to editz?
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;
	
	// Get le posted value
	$component = $_POST['wpbootstrap_component'];
	
	// update her
	update_post_meta( $post_id, 'wpbootstrap_component', $component );			
}


/************* BOOTSTRAP OPTIONS FUNCTIONS *****************/

/** 
 * Use these actions to display our options values (and use them)
 * Since WP Bootstrap 1.2
 */

if (! function_exists('wpbootstrap_options_styles') ) {

	function wpbootstrap_options_styles() { // prints styles based on Theme Options. Call this in header.php
		?><style type="text/css"><?php

		if ( of_get_option('navbar_bg') != '' ) { // if they set a navbar_bg option ?>
			.navbar-inner { background: <?php echo of_get_option('navbar_bg'); ?> }
		<?php }
		
		$hero_bg = of_get_option('hero_bg'); // get the Hero bg image/color
		if ($hero_bg) {
			if ($hero_bg['image']) { ?>
			.hero-unit { background: <?php echo $hero_bg['color']; ?> url('<?php echo $hero_bg['image']; ?>') <?php echo $hero_bg['position'] . ' ' . $hero_bg['repeat']; ?>; }
			<?php } else { ?>
			.hero-unit { background: <?php echo $hero_bg['color']; ?>; }
			<?php }	
		}
		
		if ( of_get_option('hero_text_color') ) { // get the Hero text color ?>
			.hero-unit > h1, .hero-unit > p { color: <?php echo of_get_option('hero_text_color'); ?>; }
		<?php }
		
		$typography = of_get_option('typography');
		if ( $typography ) { // get typography options ?>
			body { 
				font-family: <?php echo $typography['face']; ?>;
				font-size: <?php echo $typography['size']; ?>;
				font-style: <?php echo $typography['style']; ?>; 
			}
			p { color: <?php echo $typography['color']; ?>; }
		<?php }
		
		if ( of_get_option('fixed_navbar') == '1' ) { // add some padding if we're fixed at the top ?>
			body {
				padding-top: 60px;
			} <?php
		}
		?></style><?php
	}
}

if (! function_exists('wpbootstrap_plead') ) {	

	function wpbootstrap_plead($content) { // we want to emphasize the first paragraph... maybe
		if ( of_get_option('use_lead') == '1' ) { // if it's set in the theme options
			global $post;
			$lead_types = of_get_option('lead_options');
			foreach ($lead_types as $type => $value) {
				if (get_post_type( $post->ID ) == $type && $value == 1 && ( is_single( $post->ID ) || is_page( $post->ID ) )) {
					$content = preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1); // add 'lead' class to first p in single post type
				}
			}
			return $content;
		} else {
			return $content;
		}
	}
}
