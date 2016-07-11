<?php
/**
 * The Sidebar
 *
 * @subpackage Best
 * @since      Best 1.0
 */
?>
<aside class="best-sidebar">
	<?php if ( is_active_sidebar( 'best_right_sidebar' ) ) {
		dynamic_sidebar( 'best_right_sidebar' );
	} else {
		$args = array(
			'before_widget' => '<aside class="widget wrap-widget">',
			'after_widget'  => '</aside>',
		);
		the_widget( 'WP_Widget_Recent_Posts', false, $args );
		the_widget( 'WP_Widget_Recent_Comments', false, $args );
		the_widget( 'WP_Widget_Archives', false, $args );
		the_widget( 'WP_Widget_Categories', false, $args );
	} ?>
	<div class="best-clear"></div>
</aside> <!-- best-sidebar -->
