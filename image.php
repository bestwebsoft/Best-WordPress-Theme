<?php /**
 * The template for displaying image attachments
 *
 * @subpackage Best
 * @since      Best 1.0
 */
get_header(); ?>
	<section class="best-contents">
		<?php if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>
				<section id="best-post-<?php the_ID(); ?>" <?php post_class( 'best-post' ); ?>>
					<header class="page-header">
						<h2 class="best-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute( array( 'before' => __( 'Permalink to ', 'best' ), 'after' => '' ) ); ?>"><?php the_title(); ?></a>
						</h2>
						<p class="best-p-post-data">
							<span class="post-data"><?php _e( 'posted on', 'best' ); ?> </span>
							<a href="<?php the_permalink(); ?>">
								<?php echo get_the_date(); ?>
							</a>
							<span class="post-data"> <?php echo __( 'Size', 'best' ) . ':' ?> </span>
							<a href="<?php echo esc_url( wp_get_attachment_url() ); ?>" target="_blank">
								<?php $metadata = wp_get_attachment_metadata();
								echo $metadata['width'] . ' &times;' . $metadata['height']; ?>
							</a>
							<span class="post-data"> <?php _e( 'in', 'best' ); ?> </span>
							<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php _e( 'Return to', 'best' );
							echo ' ' . esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ); ?>">
								<?php echo get_the_title( $post->post_parent ) . '. '; ?>
							</a>
							<?php edit_post_link( __( 'Edit', 'best' ) ); ?>
						</p>
					</header><!-- .page-header -->
					<div class="entry">
						<article class="entry-attachment">
							<div class="attachment">
								<?php $attachments = array_values( get_children( array(
									'post_parent'    => $post->post_parent,
									'post_status'    => 'inherit',
									'post_type'      => 'attachment',
									'post_mime_type' => 'image',
									'order'          => 'ASC',
									'orderby'        => 'menu_order ID',
								) ) );
								foreach ( $attachments as $k => $attachment ) {
									if ( $attachment->ID == $post->ID ) {
										break;
									}
								}
								$k ++;
								if ( count( $attachments ) > 1 ) {
									if ( isset( $attachments[ $k ] ) ) {
										// get the URL of the next image attachment
										$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
									} else {
										// or get the URL of the first image attachment
										$next_attachment_url = get_attachment_link( $attachments[0]->ID );
									}
								} else {
									// or, if there's only 1 image, get the URL of the image
									$next_attachment_url = wp_get_attachment_url();
								} ?>
								<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
									<?php $attachment_size = apply_filters( 'best_attachment_size', array( 654, 99999 ) );
									echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
								</a>
								<?php if ( ! empty( $post->post_excerpt ) ) { ?>
									<div class="wp-caption-text">
										<?php the_excerpt(); ?>
									</div>
								<?php } ?>
							</div><!-- .attachment -->
						</article><!-- .entry-attachment -->
						<article class="entry-description">
							<?php the_content();
							wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'best' ) . ':' . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
							) ); ?>
							<div class="best-clear"></div>
							<?php wp_link_pages(); ?>
							<footer class="best-tags">
								<?php if ( has_tag() ) {
									the_tags( '', ',&nbsp;', '' );
								} ?>
							</footer> <!-- .best-tags -->
						</article><!-- .entry-description -->
					</div>  <!-- .entry -->
					<nav class="best-link">
						<div class="best-image-nav-prev alignleft"><?php previous_image_link( false, '&nbsp;' . __( 'Previous', 'best' ) ); ?></div>
						<div class="best-image-nav-next alignright"><?php next_image_link( false, __( 'Next', 'best' ) . '&nbsp;' ); ?></div>
						<div class="best-clear"></div>
					</nav><!-- .best-link -->
				</section><!-- #best-post -->
			<?php } // while have_posts()
		} // if have_posts()
		comments_template(); ?>
	</section><!-- .best-contents -->
<?php get_sidebar();
get_footer();
