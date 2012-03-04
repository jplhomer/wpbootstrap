<?php
/*
Author: Josh Larson
URL: http://jplhomer.org

Based off of: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)
require_once('library/plugins.php');          // plugins & extra functions (optional)

// Get WP Bootstrap specific utilities
require_once('library/wpbootstrap-utils.php');

// Options panel
require_once('library/options-panel.php');

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'grid4', 360, 268, true );
add_image_size( 'grid3', 260, 180, true );
add_image_size( 'grid2', 160, 120, true );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="well widget %2$s"><ul class="nav nav-list">',
    	'after_widget' => '</ul></div>',
    	'before_title' => '<li class="nav-header">',
    	'after_title' => '</li>',
    ));

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
?>