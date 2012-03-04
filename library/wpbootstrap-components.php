<?php 

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