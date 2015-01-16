<?php
/**
 * Best functions and definitions
 *
 * @subpackage Best
 * @since Best 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 656;
function best_setup() {
	// Sets up the content width value based on the theme's design.
	load_theme_textdomain( 'best', get_template_directory() . '/languages' );
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// Switches default core markup for search form, comment form,
	// and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	// This theme supports all available post formats by default.
 	// See http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', 
		array(
			'aside', 
			'audio', 
			'chat', 
			'gallery', 
			'image', 
			'link', 
			'quote', 
			'status', 
			'video'
		) 
	);
	add_theme_support( "custom-header", 
		array(
			'default-image'				=> '',
			'width'						=> 1920,
			'height'					=> 245,
			'flex-width'				=> false,
			'flex-height'				=> false,
			'random-default'			=> false,
			'header-text'				=> true,
			'default-text-color'		=> '#444',
			'uploads'					=> true,
			'wp-head-callback'			=> 'best_header_style',
			'admin-head-callback'		=> '',
			'admin-preview-callback'	=> '',
		) 
	);
	// This theme supports custom background color and image,
	// and here we also set up the default background color.
	add_theme_support( 'custom-background', 
		array(
			'default-color' => 'fff',
		) 
	);
	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'best_image_content_size', 656, 9999	); // Unlimited height, soft crop
}

/* Function add menu pages */
function best_admin_menu() {
	global $bws_theme_info;
	if ( empty( $bws_theme_info ) ) {
		if ( ( function_exists( 'wp_get_theme' ) ) ) {
			$current_theme = wp_get_theme();
			$current_theme_ver = $current_theme->get( 'Version' );
		} else
			$current_theme_ver = '';
		$bws_theme_info = array( 'id' => '144', 'version' => $current_theme_ver );
	}
	require_once( dirname( __FILE__ ) . '/bws_menu/bws_menu.php' );
	add_theme_page( 'BWS Themes', 'BWS Themes', 'edit_theme_options', 'bws_themes', 'bws_add_themes_menu_render' );
}

// register navigation menu
function best_register_nav_menu() {
	register_nav_menu( 'header-menu', __( 'Header Menu', 'best' ) );
}
// Сonclusion sidebar
function best_register_sidebar() {
	// Right sidebar
	register_sidebar( 
		array(
			'name' 			=> __( 'Home Right Sidebar', 'best' ),
			'id' 			=> 'best_right_sidebar',
			'before_widget' => '<section class="best-witget-right-sidebar">',
			'after_widget' 	=> '</section>',
			'before_title' 	=> '<h2 class="best-widget-title">',
			'after_title' 	=> '</h2>',
		) 
	);
	// Footer sidebar
	register_sidebar( 
		array(
			'name' 			=> __( 'Footer Sidebar', 'best' ),
			'id' 			=> 'best_footer_sidebar',
			'before_widget' => '<section class="best-witget-footer-sidebar">',
			'after_widget' 	=> '</section>',
			'before_title' 	=> '<h2 class="best-widget-title">',
			'after_title' 	=> '</h2>',
		) 
	);
}
// Proper way to enqueue scripts and styles
function best_style_scripts() {
	 // Adds JavaScript to pages with the comment form to support
	 // sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_style( 'best_styles', get_stylesheet_uri() );
	wp_enqueue_script( 'best_scripts', get_template_directory_uri() . '/js/scripts.js', array( "jquery" ) );
	wp_enqueue_script( 'best_html5', get_template_directory_uri() . '/js/html5.js' );// including scripts for compatibility html5 with IE
	$script_localization = array( // array with elements to localize in scripts
		'choose_file'			=> __( 'Choose file', 'best' ),
		'file_is_not_selected'	=> __( 'File is not selected', 'best' ),
		'best_home_url'			=> esc_url( home_url() ),
	);
	wp_localize_script( 'best_scripts', 'script_loc', $script_localization );// localization in scripts
}
// customize site title
function best_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	global $page, $paged;
	// Add the blog name
	$title = get_bloginfo( 'name', 'display' ) . $title;
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}
	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page', 'best' ) . ' %s', max( $paged, $page ) );
	}
	return $title;
}
// Set up post entry meta.
// Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
function best_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( ', ' );
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', ', ' );
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by', 'best' ) . ' %s', get_the_author() ) ),
		get_the_author()
	);
	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = _n( __( 'This entry was posted in', 'best'  ) . ' %1$s ' . __( 'and tagged', 'best'  ) . ' %2$s ' . __( 'on', 'best'  ) . ' %3$s<span class="by-author"> ' . __( 'by', 'best'  ) . ' %4$s</span>.' );
	} elseif ( $categories_list ) {
		$utility_text = _n( __( 'This entry was posted in', 'best'  ) . ' %1$s ' . ' %3$s<span class="by-author"> ' . __( 'by', 'best'  ) . ' %4$s</span>.' );
	} else {
		$utility_text = _n( __( 'This entry was posted in', 'best'  ) . ' %3$s<span class="by-author"> ' . __( 'by', 'best'  ) . ' %4$s</span>.' );
	}
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
// Includes support Breadcrumbs
function  best_breadcrumbs() { ?>
	<h3><?php
	if ( is_single() ) {
		// show title differently depending on whether list of categories is displayed  
		if ( has_category() ) { // check if the post belongs to any categories 
			echo get_the_title();
		} elseif ( isset( $_GET[ 'page' ] ) && ! empty( $_GET[ 'page' ] ) ) { // if it is a page of a paginated post 		
			if ( ! is_front_page() ) { // if it is not home page add hyphen before 'page'
				_e( 'Page ','best' ); echo $_GET[ 'page' ];
			}	
		}
	} elseif ( is_category() ) {
		printf( __( 'Category Archives', 'best' ) . ':&thinsp;%s', single_cat_title( '', false ) );
	} elseif ( is_attachment() ) {
		echo get_the_title();
	} elseif ( is_page() ) {
		echo get_the_title();  
	} elseif ( is_tag() ) { // if it is a tags archive page 
		printf( __( 'Tag Archives', 'best' ) . ':&thinsp;%s', single_tag_title( '', false ) );
	} elseif ( is_day() ) {
		echo __( 'Archive for', 'best' ) . ' &thinsp;'; the_time( 'F jS Y' );
	} elseif ( is_month() ) {
		echo __( 'Archive for', 'best' ) . ' &thinsp;'; the_time( 'F Y' );
	} elseif ( is_year() ) {
		echo __( 'Archive for', 'best' ) . ' &thinsp;'; the_time( 'Y' );
	} elseif ( is_author() ) {
		echo __( 'Author&#8217;s Archive', 'best' ) . ":&thinsp;"; the_author();
	} elseif ( is_search() ) {
		echo __( 'Search Results', 'best' );
	} elseif ( is_404() ) { 
		echo __( 'Page not found', 'best' );
	}
	if ( isset( $_GET[ 'paged' ] ) && ! empty( $_GET[ 'paged' ] ) ) { // if it is a page of the post list 
		echo '&thinsp;' . __( 'Page ','best' ); echo $_GET[ 'paged' ];
	} ?>
	</h3><?php
	if ( ( ! is_front_page() ) && ( ! is_404() ) ) { // if it is Front Page 'Home' is not displayed 
		echo '<a href="' . esc_url( get_home_url( null, '/' ) ) . '">' . __( 'Home', 'best' ) . "</a>"; // link to Front Page 	
	} //endif is_front_page() 
	if ( is_single() ) {
		// show title differently depending on whether list of categories is displayed  
		if ( has_category() ) { // check if the post belongs to any categories 
			echo '&thinsp;/&thinsp;' . get_the_title();
		} else {
			echo '&thinsp;/&thinsp;' . get_the_title();
		}
		if ( isset( $_GET[ 'page' ] ) && ! empty( $_GET[ 'page' ] ) ) { // if it is a page of a paginated post 		
			if ( ! is_front_page() ) { // if it is not home page add hyphen before 'page'
				$symbol_before_page = '&thinsp;/&thinsp;';
			} else {
				$symbol_before_page = '';
			}
			echo $symbol_before_page; _e( 'Page ','best' ); echo $_GET[ 'page' ];
		}
	} elseif ( is_category() ) {
		$category = get_queried_object();
		$this_cat = $category->name;
		$cat_bread = array();
		if ( $category->parent ) {
			while ( $category->parent ) {
				$category = get_category( $category->parent );
				array_push( $cat_bread, '&thinsp;/&thinsp;<a href="' . esc_url( get_category_link( $category->cat_ID ) ) . '" title="' . esc_attr( $category->slug ) . '">' . $category->name . '</a>' );       
			}
			for ( $i = count( $cat_bread ) - 1; $i >= 0; $i-- ) {
				echo $cat_bread[$i];
			}      
		}
		echo '&thinsp;/&thinsp;' . $this_cat;
	} elseif ( is_attachment() ) {
		echo '&thinsp;/&thinsp;' . get_the_title();
	} elseif ( is_page() ) {
		global $post;
		if( $post->ancestors ) {
			// reverse order of a parent pages array for the current page 
			$ancestors = array_reverse( $post->ancestors );
			// display links to parent pages of the current page 
			for( $i = 0; $i < count( $ancestors); $i++ ) {
				if ( 0 == $i ) {
					echo '&thinsp;/&thinsp;<a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a>';  
				} else {
					echo '&thinsp;/&thinsp;<a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a>';  
				}
			}
			echo '&thinsp;/&thinsp;' . get_the_title();  
		} else {
			echo '&thinsp;/&thinsp;' . get_the_title();  
		}
	} elseif ( is_tag() ) { // if it is a tags archive page 
		printf( '&thinsp;/&thinsp;%s', single_tag_title( '', false ) );
	} elseif ( is_day() ) {
		echo '&thinsp;/&thinsp;'; the_time( 'F jS Y' );
	} elseif ( is_month() ) {
		echo '&thinsp;/&thinsp;'; the_time( 'F Y' );
	} elseif ( is_year() ) {
		echo '&thinsp;/&thinsp;'; the_time( 'Y' );
	} elseif ( is_author() ) {
		echo '&thinsp;/&thinsp;'; the_author();
	} elseif ( is_search() ) {
		echo '&thinsp;/&thinsp;' . __( 'Search Results', 'best' );
	} elseif ( is_404() ) { 
		echo '&thinsp;/&thinsp;' . __( 'Page not found', 'best' );
	}
	if ( isset( $_GET[ 'paged' ] ) && ! empty( $_GET[ 'paged' ] ) ) { // if it is a page of the post list 
		if ( ! is_front_page() ) { // if it is not home page add hyphen before 'page'
			$symbol_before_page = '&thinsp;/&thinsp;';
		}
		else {
			$symbol_before_page = '';
		}
		echo $symbol_before_page; _e( 'Page ','best' ); echo $_GET[ 'paged' ];
	}
}
// output function posts
function best_posts() {
	$num_posts = wp_count_posts( 'post' );
	$num_posts = $num_posts->publish; //publish, draft
	$num_posts = sprintf( _n( '%s', '%s', $num_posts ), number_format_i18n( $num_posts ) );
	if ( !is_single() ) {
		echo $num_posts . ' ' . __( 'Posts', 'best' );
	}
}
// caption text
function best_the_post_thumbnail_caption() {
	global $post;
	$thumbnail_id    = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts( 
						array( 
							'p'			=> $thumbnail_id, 
							'post_type' => 'attachment' 
							) 
						);
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		if( $thumbnail_image[0]->post_excerpt !="" ){
			echo '<p class="wp-caption-text">'. $thumbnail_image[0] -> post_excerpt .'</p>';
		}
	}
}
// functions file enables you to customize the read more link tex
function best_modify_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">' . __( 'More Link', 'best' ) . '</a>';
}
function best_header_style() {
	$text_color = get_header_textcolor();
	$display_text = display_header_text();
	if ( $text_color == HEADER_TEXTCOLOR )// If no custom options for text are set, return default.
		return;
	// If optins are set, we use them  ?>
	<style type="text/css"> <?php 
	if ( 'blank' != $text_color ) { //If the user has set a custom color for the text use that ?>
		.best-site-title,
		.best-site-title a {
			color: #<?php echo $text_color; ?> !important;
		} <?php 
	} 
	if( ! $display_text ){ // Display text or not ?>
		.best-site-title {
			display: none;
		} <?php 
	} ?>
	</style> <?php 
}
add_action( 'after_setup_theme', 'best_setup' );
add_action( 'init', 'best_register_nav_menu' );
add_action( 'admin_menu', 'best_admin_menu' );
add_action( 'widgets_init', 'best_register_sidebar' );
add_action( 'wp_enqueue_scripts', 'best_style_scripts' );
add_filter( 'wp_title', 'best_wp_title', 10, 2 );
add_action( 'best_breadcrumbs', 'best_breadcrumbs' );
add_action( 'best_posts', 'best_posts' );
add_action( 'best_the_post_thumbnail_caption', 'best_the_post_thumbnail_caption' );
add_filter( 'the_content_more_link', 'best_modify_read_more_link' );