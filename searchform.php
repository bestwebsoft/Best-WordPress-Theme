<?php
/**
 * The template for displaying search forms in best
 *
 * @subpackage best
 * @since      best 1.0
 */ ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" name="s" placeholder="<?php _e( 'Enter search keyword', 'best' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
	<button type="submit" value=""></button>
	<div class="best-clear"></div>
</form><!-- .search-form -->
