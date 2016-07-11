<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @subpackage Best
 * @since      Best 1.0
 */
get_header(); ?>
	<article class="best-contents">
		<div id="content" class="site-content" role="main">
			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Not Found', 'best' ); ?></h1>
			</header>
			<div class="page-wrapper">
				<div class="page-content">
					<h1><?php _e( 'Error 404', 'best' ); ?></h1>
					<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'best' ); ?></h2>
					<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'best' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- .page-wrapper -->
		</div><!-- #content -->
	</article><!-- .best-contents -->
<?php get_sidebar();
get_footer();
