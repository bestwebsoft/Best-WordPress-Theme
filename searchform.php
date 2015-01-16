<?php /**
 * The template for displaying search forms in best
 *
 * @subpackage best
 * @since best 1.0
 */ ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="search" name="s" id="s" placeholder="<?php _e( 'Enter search keyword', 'best' ); ?>" value="<?php the_search_query(); ?>"/>
	<input type="submit" class="alignright" value=""/>
	<div class="best-clear"></div>
</form><!-- .search-form -->