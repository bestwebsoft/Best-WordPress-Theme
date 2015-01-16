<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @subpackage Best
 * @since Best 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>
<article id="comments" class="comments-area"> <?php 
	if ( have_comments() ) { ?>
		<h2 class="comments-title"> <?php
			printf( _n( __( 'One thought on', 'best' ) . ' &ldquo;%2$s&rdquo;', '%1$s ' . __( 'thoughts on', 'best' ) . ' &ldquo;%2$s&rdquo;', get_comments_number(), 'best' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
		</h2>
		<ol class="comment-list"> <?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 74,
			) ); ?>
		</ol><!-- .comment-list --> <?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav class="best-link" role="navigation">
				<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'best' ); ?></h1>
				<div class="best-nav-previous"><?php previous_comments_link( __( 'Older Comments', 'best' ) ); ?></div>
				<div class="best-nav-next"><?php next_comments_link( __( 'Newer Comments', 'best' ) ); ?></div>
				<div class="best-clear"></div>
			</nav><!-- .comment-navigation --> <?php 
		} // Check for comment navigation
		if ( ! comments_open() && get_comments_number() ) { ?>
			<p class="no-comments"><?php _e( 'Comments are closed.' , 'best' ); ?></p> <?php 
		} //comments_open() && get_comments_number() ?> <?php 
	} // have_comments()
	comment_form(); ?>
</article><!-- #comments -->