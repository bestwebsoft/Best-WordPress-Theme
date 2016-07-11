<?php
/**
 * The Index
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
							<span class="post-data"> <?php _e( 'by', 'best' ); ?> </span>
							<?php the_author_posts_link();
							if ( has_category() ) { ?>
								<span class="post-data"> <?php _e( 'in', 'best' ); ?> </span>
								<?php the_category( ', ' );
							}
							edit_post_link( __( 'Edit', 'best' ), '<span class="best-edit-link">', '</span>' ); ?>
						</p>
					</header><!-- .page-header -->
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="best-content-image">
							<?php the_post_thumbnail( 'best_image_content_size' );
							do_action( 'best_the_post_thumbnail_caption' ); ?>
						</div> <!-- content_image -->
					<?php } // has_post_thumbnail() ?>
					<article class="best-content">
						<?php the_content();
						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'best' ) . ':' . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
						) ); ?>
						<footer class="best-tags">
							<?php if ( has_tag() ) {
								the_tags( '', ', ', '' );
							} ?>
						</footer> <!-- .best-tags -->
					</article> <!-- .best-content -->
				</section> <!-- #best-post -->
			<?php } // while have_posts() ?>
			<nav class="best-link">
				<div class="best-previous-posts-link">
					<?php next_posts_link( __( 'Previous posts', 'best' ) . ' ' ); ?>
				</div> <!-- best-previous-posts-link -->
				<div class="best-next-posts-link">
					<?php previous_posts_link( ' ' . __( 'Next posts', 'best' ) ); ?>
				</div> <!-- best-next-posts-link -->
			</nav> <!-- .best-link -->
			<div class="best-clear"></div>
		<?php } else {
			// If no content, include the "No posts found" template.
			if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
				<p><?php printf( __( 'Ready to publish your first post?', 'best' ) . ' <a href="%1$s">' . __( 'Get started here', 'best' ) . '</a>', admin_url( 'post-new.php' ) ); ?></p> <?php
			} elseif ( is_search() ) { ?>
				<p><?php _e( 'Sorry, but nothing matches your search terms. Please try again using different keywords.', 'best' ); ?></p>
				<?php get_search_form();
			} else { ?>
				<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'best' ); ?></p>
				<?php get_search_form(); ?>
				<div class="best-clear"></div>
			<?php }
		} // if have_posts() ?>
	</section> <!-- .best-contents -->
<?php get_sidebar();
get_footer();
