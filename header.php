<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<!-- wrapper -->
	<div class="wrapper">

		<!-- header -->
		<header class="header" id="header" role="banner">
			<div class="container">


				<!-- logo -->
				<div class="logo">
					<?php if (function_exists('the_custom_logo')) {
						the_custom_logo();
					} ?>
				</div>
				<!-- /logo -->


				<!-- nav -->
				<nav class="nav" role="navigation">
					<?php header_nav(); 
					
					echo do_shortcode('[gtranslate]'); ?>
				</nav>
				<!-- /nav -->


				<div id="mob-menu-bar">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</div>
			</div><!-- /container -->
		</header>
		<!-- /header -->

		<div class="body-content">