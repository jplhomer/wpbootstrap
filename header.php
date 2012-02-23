<!doctype html>  
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?> class="no-js iem7"> <![endif]-->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 8)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title><?php wp_title(''); ?></title>
		
		<!-- meta tags should be handled by SEO plugin. I reccomend (http://yoast.com/wordpress/seo/) -->
		
		<!-- mobile optimized -->
		<meta name="viewport" content="width=device-width">
		
		<!-- allow pinned sites -->
		<meta name="application-name" content="<?php bloginfo('name'); ?>" />
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

		<!-- get normal styles + bootstrap -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
		
		<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/jquery-1.7.1.min.js"><\/script>')</script>
		
		<!-- modernizr (without media query polyfill) -->
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/modernizr.custom.min.js"></script>
		
		<!-- Grab Bootstrap's Javascript -->
		<script src="<?php echo get_template_directory_uri(); ?>/library/js/libs/bootstrap.min.js"></script>
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
	</head>
	
	<body <?php body_class(); ?>>

		<header role="banner">
		
			<div class="navbar">
				<div class="navbar-inner">
					<nav class="container" role="navigation">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
						<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<div class="nav-collapse">
							<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
							<?php get_search_form(); ?>
						</div><!--/.nav-collapse -->
					</nav><!--/.container -->
				</div><!--/.navbar-inner -->
			</div><!--/.navbar -->
		</header><!--/header -->
	
		<div class="container">