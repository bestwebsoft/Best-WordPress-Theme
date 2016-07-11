<?php
/**
 * The Footer Sidebar
 *
 * @subpackage Best
 * @since Best 1.0
 */
if ( is_active_sidebar( 'best_footer_sidebar' ) ) { ?>
	<aside id="best_footer_sidebar">
		<div class="best-footer-sidebar-content">
			<?php dynamic_sidebar( 'best_footer_sidebar' ); ?>
			<div class="best-clear"></div>
		</div> <!-- best-footer-sidebar-content -->
	</aside> <!-- footer_sidebar -->
<?php }
