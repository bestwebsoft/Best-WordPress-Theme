<?php
/**
 * The Single
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
						<a href='<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>'><?php echo get_the_date(); ?></a>
						<span class="post-data"> <?php _e( 'by', 'best' ); ?> </span>
						<?php the_author_posts_link();
						if ( has_category() ) { ?>
							<span class="post-data"> <?php _e( 'in', 'best' ); ?> </span>
							<?php the_category( ', ' );
						}
						edit_post_link( __( 'Edit', 'best' ), '<span class="best-edit-link">', '</span>' ); ?>
					</p>
				</header> <!-- .page-header -->
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
			<nav class="best-link">
				<div class="best-previous-posts-link">
					<?php previous_post_link( '%link', __( 'Older post', 'best' ) ); ?>
				</div> <!-- .best-previous-posts-link -->
				<div class="best-next-posts-link">
					<?php next_post_link( '%link', __( 'Newer post', 'best' ) ); ?>
				</div> <!-- .best-next-posts-link -->
			</nav> <!-- .best-link -->
			<div class="best-clear"></div>
			<div class="comments">
				<?php comments_template(); ?>
			</div> <!-- .comments -->
		<?php } // if have_posts() ?>
	</section> <!-- .best-contents -->
<?php get_sidebar();
get_footer();
