<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
	<title><?php bloginfo('name'); ?></title>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="site-container">
        <!-- site-header -->
        <header class="site-header">
			<div class="logo"><a href="<?php echo home_url(); ?>"><img src=<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>><h1><?php bloginfo('name'); ?></h1></a></div>
				<nav>
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
				</nav>
			<div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
        </header><!-- /site-header -->
		<div class="header-content-divider"></div>

	<section class="container active"> <!-- Content -->