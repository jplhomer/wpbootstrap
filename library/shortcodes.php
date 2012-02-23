<?php

// shortcodes

// Gallery shortcode

// remove the standard shortcode
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_tbs');

function gallery_shortcode_tbs($attr) {
	global $post, $wp_locale;
	
	extract( shortcode_atts( array( // get the new "grid" property for size control
		'grid' => '2' // default is span2
	), $attr ) );
	
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	if ($attachments) {
		$output = '<ul class="thumbnails">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li class="span'. $grid . '">';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul>';
	}

	return $output;
}

// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => '', /* primary, info, success, danger (leave blank for default) */
	'size' => 'btn-medium', /* btn-small, btn-medium, btn-large */
	'url'  => '',
	'text' => '', 
	), $atts ) );

	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $text;
	$output .= '</a>';

	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
// NOTE: The "Block" function has been integrated into the Alert function. It's all onesies, now.
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-warning', /* alert-warning, alert-info, alert-success, alert-error, alert-block */
	'close' => 'false', /* display close link */
	'title' => '', /* Optional h4 alert-heading title */
	'text' => '', 
	), $atts ) );

	$output = '<div class="alert '. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" href="#" data-dismiss="alert">×</a>';
	}
	if($title != '') {
		$output .= '<h4 class="alert-heading">' . $title . '</h4>';
	}
	$output .= $text . '</div>';

	return $output;
}

add_shortcode('alert', 'alerts');

// Progress Bars
function progress_bars( $atts, $content = null) {
	extract( shortcode_atts( array(
		'type' => '', /* [default = none], progress-info, progress-success, progress-danger */
		'striped' => 'false', /* use gradient for striped */
		'animated' => 'false', /* animate gradient. Must use striped! */
		'width' => '' /* how long you want the progress bar */
	), $atts ) );
	
	if ($striped) { $striped = ' progress-striped'; } else { $striped = ''; }	
	if ($animated) { $animated = ' active'; } else { $animated = ''; }
	$output = '<div class="progress '. $type . $striped . $animated .'">';
	$output .= '<div class="bar" style="width: '. $width . '%;"></div></div>';
	
	return $output;
}

add_shortcode('progress', 'progress_bars');
?>