<?php
/**
 * The template for displaying Search Results pages
 *
 * @subpackage Best
 * @since Best 1.0
 */
get_header(); ?>
	<section class="best-contents"> <?php 
		if ( have_posts() ) { ?>
			<article class="best-search-title">
				<h2 class="best-title">
					<?php printf( __( 'Search Results for', 'best' ) . ': %s', '<span>' . get_search_query() . '</span>' ); ?>
				</h2>
			</article> <!-- .best-search-title --> <?php
			while ( have_posts() ) {
				the_post(); ?>
				<section id="best-post-<?php the_ID(); ?>"  <?php post_class( 'best-post' ); ?>>
					<header class="page-header">
					<h2 class="best-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permalink to', 'best' ); the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				 	<p class="best-p-post-data">
				 		<span class="post-data"><?php _e( 'posted on', 'best' ); ?> </span>
				 		<a href="<?php the_permalink(); ?>">
				 			<?php the_time( get_option( 'date_format' ) ) ?>
				 		</a>
				 		<span class="post-data"> <?php _e( 'by', 'best' ); ?> </span>
				 		<?php the_author_posts_link(); ?>
				 		<span class="post-data"> <?php _e( 'in', 'best' ); ?> </span>
				 		<?php the_category ( ',&nbsp;' ); 
				 		edit_post_link( __( 'Edit', 'best' ), '<span class="best-edit-link">', '</span>' ); ?>
				 	</p>
				 	</header> <!-- .page-header -->
				 	<?php if ( has_post_thumbnail() ) { ?>
					 	<div class="best-content-image"> <?php 
				 			the_post_thumbnail( 'best_image_content_size' );						
							do_action( 'best_the_post_thumbnail_caption' ); ?>											
						</div> <!-- content_image --> <?php 
					} // has_post_thumbnail() ?>
				 	<article class="best-content">
				 		<?php the_excerpt(); ?>
				 	</article> <!-- .best-content -->
				 	<footer class="best-tags"> <?php
			 			if ( the_tags() ) { ?>
				 			<?php the_tags( '', ',&nbsp;', '' );
				 		} ?>
			 		</footer> <!-- .best-tags -->
				</section> <!-- #best-post --> <?php 
			} // while have_posts()	?>				
		<nav class="best-link">
			<div class="best-previous-posts-link">
				<?php next_posts_link( __( 'Previous posts', 'best' ) . ' ' ); ?>
			</div> <!-- best-previous-posts-link -->
			<div class="best-next-posts-link">
				<?php previous_posts_link( ' ' . __( 'Next posts', 'best' ) ); ?>
			</div> <!-- best-next-posts-link -->
		</nav> <!-- .best-link --> <?php 
		} else { ?>
			<h2 class="best-title">
				<?php printf( __( 'Search Results for', 'best' ) . ': %s', '<span>' . get_search_query() . '</span>' ); ?>
			</h2>
			<p><?php _e( 'Sorry, but nothing matches your search terms. Please try again using different keywords.', 'best' ); ?></p>
				<?php get_search_form(); ?>
		<div class="best-clear"></div> <?php 
		} // if have_posts() ?>
	</section> <!-- .best-contents -->
<?php get_sidebar();
get_footer();
