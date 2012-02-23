<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)
require_once('library/plugins.php');          // plugins & extra functions (optional)
require_once('library/custom-post-type.php'); // custom post type example

// Get shortcodes, baby!
require_once('library/shortcodes.php');			// custom shortcodes

// Get WP Bootstrap specific utilities
require_once('library/wpbootstrap-utils.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
	
	register_sidebar( array(
		'name' => __( 'Hero Features', 'wpbootstrap' ),
		'id' => 'hero-features',
		'description' => __( 'The main features shown on the optional Hero Template. Width: 1170px', 'wpbootstrap' ),
		'before_widget' => '<div class="item">',
		'after_widget' => '</div>',
		'before_title' => '<h1>',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Hero Featurettes', 'wpbootstrap' ),
		'id' => 'hero-featurettes',
		'description' => __( 'The featurettes shown on the optional Hero Template Width: 370px', 'wpbootstrap' ),
		'before_widget' => '<aside id="%1$s" class="span4 widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
    
		register_sidebar( array(
		'name' => __( 'Footer Area One', 'wpbootstrap' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'wpbootstrap' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'wpbootstrap' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'wpbootstrap' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'wpbootstrap' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'wpbootstrap' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Sidebar 2',
    	'description' => 'The second (secondary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="comment-author vcard row clearfix">
				<div class="avatar span1">
					<?php echo get_avatar($comment,$size='75',$default='<path_to_url>' ); ?>
				</div>
				<div class="span7">
					<?php printf(__('<h4>%s</h4>'), get_comment_author_link()) ?>
					<?php edit_comment_link(__('Edit'),'<span class="edit-comment btn btn-small btn-info">','</span>') ?>
                    
                    <?php if ($comment->comment_approved == '0') : ?>
       					<div class="alert alert-success">
          				<p><?php _e('Your comment is awaiting moderation.') ?></p>
          				</div>
					<?php endif; ?>
                    
                    <?php comment_text() ?>
                    
                    <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                    
                </div>
			</div>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form class="navbar-search pull-right" role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input class="search-query" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search" />
    </form>';
    return $form;
} // don't remove this bracket!

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

/**
 * Add predetermined classes to widgets for the choosing
 * Source: http://ednailor.com/2011/01/24/adding-custom-css-classes-to-sidebar-widgets/
 */

function wpbootstrap_widget_form_extend( $instance, $widget ) {
	/* Allows User to Add Custom CSS Classes */
	$row .= "\t<p><em>Use 'hero-unit' for the standard hero slide.</em></p><input type='text'   name='widget-{$widget->id_base}[{$widget->number}][classes]'   id='widget-{$widget->id_base}-{$widget->number}-classes'   class='widefat' value='{$instance['classes']}'/>\n";
	$row .= "</p>\n";
	
	echo $row;
	return $instance;
}
add_filter('widget_form_callback', 'wpbootstrap_widget_form_extend', 10, 2);

function wpbootstrap_widget_update( $instance, $new_instance ) {
	$instance['classes'] = $new_instance['classes'];
	return $instance;
}
add_filter( 'widget_update_callback', 'wpbootstrap_widget_update', 10, 2 );

function wpbootstrap_dynamic_sidebar_params( $params ) {
	global $wp_registered_widgets;
	$widget_id    = $params[0]['widget_id'];
	$widget_obj    = $wp_registered_widgets[$widget_id];
	$widget_opt    = get_option($widget_obj['callback'][0]->option_name);
	$widget_num    = $widget_obj['params'][0]['number'];
	
	if ( isset($widget_opt[$widget_num]['classes']) && !empty($widget_opt[$widget_num]['classes']) )
	$params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['classes']} ", $params[0]['before_widget'], 1 );
	
	return $params;
}
add_filter( 'dynamic_sidebar_params', 'wpbootstrap_dynamic_sidebar_params' );

// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

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

?>