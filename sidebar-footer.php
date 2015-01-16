<?php
/**
 * The Footer Sidebar
 *
 * @subpackage Best
 * @since Best 1.0
 */
if ( ! is_active_sidebar( 'best_footer_sidebar' ) ) {
	return;
}
?>
<aside id="best_footer_sidebar">
	<div class="best-footer-sidebar-content"> <?php 
		if ( is_active_sidebar( 'best_footer_sidebar' ) ) { 
			dynamic_sidebar( 'best_footer_sidebar' ); 
		} ?>
		<div class="best-clear"></div>
	</div> <!-- best-footer-sidebar-content -->
</aside> <!-- footer_sidebar -->