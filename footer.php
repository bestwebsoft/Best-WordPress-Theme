<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @subpackage Best
 * @since Best 1.0
 */
?>
			<div class="best-clear"></div><!-- clear -->
		</div> <!-- home -->	
		<div id="best_footer"> <?php 
			get_sidebar( 'footer' ); ?>
			<div class="best-footer-logo">
				<div class="best-footer-logo-content">
					<div class="best-footer-logo-content-home">
						<a href="<?php echo  home_url(); ?>/"><?php bloginfo( 'name' ); ?></a>
					</div> <!-- best-footer-logo-content-home -->
					<footer class="best-footer-logo-content-by">
						<p><?php echo __( 'Designed with love by', 'best' ) . '&nbsp;'; ?><a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'best' ); ?>" target="_blank">BestWebSoft</a> <?php _e( 'and', 'best' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>"target="_blank">WordPress</a>&nbsp;&copy;&nbsp;<?php echo date( 'Y' ) . '&nbsp;'; bloginfo( 'name' ); ?></p>
					</footer> <!-- best-footer-logo-content-by -->					
				</div> <!-- best-footer-logo_content -->
				<div class="best-clear"></div>
			</div> <!-- best-footer-logo -->
		</div> <!-- #best_foote -->
	</div> <!-- wrapper --> 
	<?php wp_footer(); ?>
</body>
</html>