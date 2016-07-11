<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="home">
 *
 * @subpackage Best
 * @since      Best 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="best_header">
		<div class="best-head">
			<header class="best-logo">
				<h1 class='best-site-title'><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<p class='best-site-title'><?php bloginfo( 'description' ); ?></p>
			</header> <!-- .best-logo -->
			<div class="best-search">
				<?php get_search_form(); ?>
			</div> <!-- search -->
			<nav class="best-nav best-main-navigation">
				<h1 class="best-assistive-text"><?php _e( 'Menu', 'best' ); ?></h1>
				<div class="best-assistive-text skip-link">
					<a href="#content" title="<?php esc_attr_e( 'Skip to content', 'best' ); ?>"><?php _e( 'Skip to content', 'best' ); ?></a>
				</div>
				<?php wp_nav_menu( array(
						'theme_location' => 'header-menu',
				) ); ?>
			</nav> <!-- .best-nav -->
			<div class="best-clear"></div>
		</div> <!-- .best-head -->
		<div class="best-breadcrumbs">
			<div class="best-breadcrumbs-content">
				<div class="best-breadcrumbs-patch">
					<span class="best-span-breadcrambs"><?php do_action( 'best_breadcrumbs', 'best' ); ?></span>
				</div> <!-- best-breadcrumbs-patch -->
				<div class="best-breadcrumbs-posts">
					<?php do_action( 'best_posts', 'best' ); ?>
				</div> <!-- best-breadcrumbs-posts -->
				<div class="best-clear"></div>
			</div> <!-- best-breadcrumbs-content -->
		</div> <!-- breadcrams -->
	</div> <!-- header -->
	<?php $header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<img src="<?php echo esc_url( $header_image ); ?>" class="best-custom-img-header" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
	<?php } ?>
	<div id="home">
