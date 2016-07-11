<?php
/**
 * The Page
 *
 * @subpackage Best
 * @since      Best 1.0
 */
get_header(); ?>
	<section class="best-contents">
		<?php if ( have_posts() ) {
			the_post(); ?>
			<section id="best-post-<?php the_ID(); ?>" <?php post_class( 'best-post' ); ?>>
				<header class="page-header">
					<h2 class="best-title"><?php the_title(); ?></h2>
					<p class="best-p-post-data">
						<span class="post-data"><?php _e( 'posted on', 'best' ); ?> </span>
						<?php echo get_the_date(); ?>
						<span class="post-data"> <?php _e( 'by', 'best' ); ?> </span>
						<?php the_author_posts_link();
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
				</article> <!-- .best-content -->
			</section> <!-- #best-post -->
			<nav class="best-link">
				<div class="best-previous-posts-link">
					<?php next_posts_link( __( 'Previous posts', 'best' ) . ' ' ); ?>
				</div> <!-- best-previous-posts-link -->
				<div class="best-next-posts-link">
					<?php previous_posts_link( ' ' . __( 'Next posts', 'best' ) ); ?>
				</div> <!-- best-next-posts-link -->
			</nav> <!-- .best-link -->
			<div class="best-clear"></div>
			<?php if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		} // if have_posts() ?>
	</section> <!-- .best-contents -->
<?php get_sidebar();
get_footer();
