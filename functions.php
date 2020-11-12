<?php

/** Tell WordPress to run theme_setup() when the 'after_setup_theme' hook is run. */

if ( ! function_exists( 'theme_setup' ) ):

function theme_setup() {

	/* This theme uses post thumbnails (aka "featured images")
	*  all images will be cropped to thumbnail size (below), as well as
	*  a square size (also below). You can add more of your own crop
	*  sizes with add_image_size. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(120, 90, true);
	add_image_size('square', 150, 150, true);
	add_image_size('rectangle', 385, 235, true);
	add_image_size('single-page', 685, 540, true);


	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses wp_nav_menu() in one location.
	* You can allow clients to create multiple menus by
  * adding additional menus to the array. */

	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'footer'=> 'Footer Navigation',
		"social"=> 'Social Nav'
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
endif;

add_action( 'after_setup_theme', 'theme_setup' );


/* Add all our JavaScript files here.
We'll let WordPress add them to our templates automatically instead
of writing our own script tags in the header and footer. */

function base_theme_scripts() {

	//Don't use WordPress' local copy of jquery, load our own version from a CDN instead
wp_deregister_script('jquery');
  wp_enqueue_script(
  	'jquery',
  	"http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );

  wp_enqueue_script(
    'scripts', //handle
    get_template_directory_uri() . '/js/scripts.js', //source
    array( 'jquery'), //dependencies
    null, // version number
    true //load in footer
  );
  wp_enqueue_script(
  	'fontAwesome',
  	"http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://kit.fontawesome.com/428b4fcaf0.js",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );
}

add_action( 'wp_enqueue_scripts', 'base_theme_scripts' );


/* Custom Title Tags */

function base_theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'base_theme' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'base_theme_wp_title', 10, 2 );

/*
  Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function base_theme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'base_theme_page_menu_args' );


/*
 * Sets the post excerpt length to 40 characters.
 */
function base_theme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'base_theme_excerpt_length' );

/*
 * Returns a "Continue Reading" link for excerpts
 */
function base_theme_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">Read More</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and base_theme_continue_reading_link().
 */
function base_theme_auto_excerpt_more( $more ) {
	return ' &hellip;' . base_theme_continue_reading_link();
}
add_filter( 'excerpt_more', 'base_theme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function base_theme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= base_theme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'base_theme_custom_excerpt_more' );


/*
 * Register a single widget area.
 * You can register additional widget areas by using register_sidebar again
 * within base_theme_widgets_init.
 * Display in your template with dynamic_sidebar()
 */
function base_theme_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' => 'The primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'base_theme_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function base_theme_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'base_theme_remove_recent_comments_style' );


if ( ! function_exists( 'base_theme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function base_theme_posted_on() {
	printf('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s',
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr( 'View all posts by %s'), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'base_theme_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
function base_theme_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/* Get rid of junk! - Gets rid of all the crap in the header that you dont need */

function clean_stuff_up() {
	// windows live
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	// wordpress gen tag
	remove_action('wp_head', 'wp_generator');
	// comments RSS
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 3 );
}

add_action('init', 'clean_stuff_up');


/* Here are some utility helper functions for use in your templates! */

/* pre_r() - makes for easy debugging. <?php pre_r($post); ?> */
function pre_r($obj) {
	echo "<pre>";
	print_r($obj);
	echo "</pre>";
}

/* is_blog() - checks various conditionals to figure out if you are currently within a blog page */
function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

/* get_post_parent() - Returns the current posts parent, if current post if top level, returns itself */
function get_post_parent($post) {
	if ($post->post_parent) {
		return $post->post_parent;
	}
	else {
		return $post->ID;
	}
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Header & Footer',
		'menu_title' 	=> 'Header & Footer'
	));
	
}

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

add_action('acf/init', 'register_our_blocks');

function register_our_blocks() {
  acf_register_block_type(array(
    'name'            => 'featured-employee',
    'title'           => __('Featured Employee'),
    'category'        => 'common',
    'mode'            => 'auto',
    'icon'            => 'admin-users',
	'render_template' => 'blocks/featured-employee.php',
	'example'		  => array (
			'attributes'       => array(
				'mode'             => 'preview',
				'data'			   => array(
					  'section_title' =>  'Featured Employee',
						'_section_title' =>  'field_5f8711773b8da',
						'featured_employee' => 140,
						'_featured_employee' =>  'field_5f87117e3b8db',
				)
			)
		)
  ));
  acf_register_block_type(array(
    'name'            => 'two-column-layout',
    'title'           => __('Box with Two Columns'),
    'category'        => 'common',
    'mode'            => 'auto',
    'icon'            => 'table-col-after',
	'render_template' => 'blocks/2-column.php',
	'example'		  => array (
			'attributes'       => array(
				'mode'             => 'preview',
				'data'			   => array(
					'left_column_0_title' => 'About Us',
					'_left_column_0_title' => 'field_5f872faebec43', 
					'left_column_0_main_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris facilisis porttitor augue.',
					'_left_column_0_main_text' => 'field_5f87380212e92',
					'left_column_0_link' => array (
						'title' => 'Learn More', 
						'url' => 'http://juno-project/services/' ,
						'target' => '' ,
					),					
					'_left_column_0_link' => 'field_5f87381412e93' ,
					'left_column' => array(
						0 => 'text'
					),
 					'_left_column' => 'field_5f872f68bec40' ,
					'right_column_0_image' =>  178,
					'_right_column_0_image' => 'field_5f873268ae772' ,
					'right_column' => array( 
						0 => 'image' 
					),					
					'_right_column' => 'field_5f873268ae771' 
				)
			)
		)
  ));
	acf_register_block_type(array(
		'name'            => 'team-members',
		'title'           => __('Team Members'),
		'category'        => 'common',
		'mode'            => 'auto',
		'icon'            => 'buddicons-buddypress-logo',
		'render_template' => 'blocks/team-members.php',
		'example'		  => array (
			'attributes'       => array(
				'mode'             => 'preview',
			)
		)
	));
	acf_register_block_type(array(
		'name'            => 'tapered-text-block',
		'title'           => __('Tapered Text Block'),
		'category'        => 'common',
		'mode'            => 'auto',
		'icon'            => 'align-center',
		'render_template' => 'blocks/tapered-text-block.php',
		'example'		  => array (
			'attributes'       => array(
				'mode'             => 'preview',
				'data'			   => array(
					'title'      => 'Tapered Text Box',
					'main_content' => "<p>fdafdsafdh lorem ips fdsaufdsanbfojmn fdsafdsaun bfdsoumnfdsa bjiosugfdn fdauobsjfd anbfsouifd fduobfdaun</p>"
				)
			)
		)
	));
	acf_register_block_type(array(
		'name'            => 'tabbed-content',
		'title'           => __('Tabbed Content'),
		'category'        => 'common',
		'mode'            => 'auto',
		'icon'            => 'index-card',
		'render_template' => 'blocks/tabbed-content.php',
		'example'		  => array (
			'attributes'       => array(
				'mode'             => 'preview',
				'data'			   => array(
					'tabs_0_title' => 'Wordpress Development',
					'_tabs_0_title' => 'field_5f89e3c934fef',
					'tabs_0_main_content' => 'Pellentesque in erat lectus. Maecenas rhoncus nibh et justo dictum vulputate. Pellentesque ex sapien, semper non luctus nec, condimentum eget lectus. Nullam sit amet dui lectus. Sed mattis porttitor facilisis. Praesent ut tortor eleifend, consectetur nulla et, mattis urna. Etiam interdum orci eget volutpat ultrices. Quisque ullamcorper non nulla a maximus. Fusce bibendum diam non lacus ullamcorper scelerisque. Quisque maximus finibus lectus ac tincidunt. Vestibulum at diam sit amet risus malesuada laoreet. ',
					'_tabs_0_main_content' => 'field_5f89e3d034ff0',
					'tabs_1_title' => 'Digital Marketing',
					'_tabs_1_title' => 'field_5f89e3c934fef',
					'tabs_1_main_content' => 'Nunc gravida tellus eu ullamcorper interdum. Nam condimentum lorem a turpis auctor, nec fermentum sapien vehicula. Donec aliquet rhoncus fringilla. Vestibulum euismod varius faucibus. Nullam bibendum urna non congue posuere. Cras elit velit, vehicula id tristique ut, pulvinar nec erat. Mauris aliquet quis quam eu dignissim. Praesent a ultricies enim. Mauris ullamcorper tincidunt neque at porta. Duis sagittis molestie urna, vitae vestibulum nisi tempus non. Vestibulum tempor leo quis massa pharetra maximus. ',
					'_tabs_1_main_content' => 'field_5f89e3d034ff0',
					'tabs_2_title' => 'Shopify Development',
					'_tabs_2_title' => 'field_5f89e3c934fef',
					'tabs_2_main_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ullamcorper interdum augue quis semper. Praesent condimentum metus at nulla condimentum efficitur. Integer viverra tempor libero et consequat. Nunc facilisis nibh ut tellus fringilla, ac vulputate eros porttitor. Nam ac velit orci. Nulla velit dui, tincidunt id odio ac, suscipit blandit nisl. Pellentesque eu aliquam ligula. Curabitur non neque at sapien congue ullamcorper. Suspendisse porta erat et mattis fermentum. Nunc et blandit odio. Na',
					'_tabs_2_main_content' => 'field_5f89e3d034ff0',
					'tabs' => 3,
					'_tabs' => 'field_5f89e3b234fee',
				)
			)
		)
	));
}
function my_mce_buttons_2( $buttons ) {	
	/**
	 * Add in a core button that's disabled by default
	 */
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';

	return $buttons;
};
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

add_editor_style("style.editor.css");
add_theme_support('editor-styles');

function pagination_bar(){
	if(is_singular())
		return;
	global $wp_query;

	$total_pages = $wp_query->max_num_pages;

	if($total_pages > 1) {
		$current_page = max(1, get_query_var('paged'));
		echo'<div class="pagination-bar">';
		echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
		));
		echo '</div>';
	}
}

function custom_short_excerpt($excerpt){
            return substr($excerpt, 0, 200). '...';

}

add_filter('the_excerpt', 'custom_short_excerpt');

function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_theme_support( 'editor-color-palette', array(
    array(
        'name' => __( 'Bright Blue', 'starter-theme' ),
        'slug' => 'bright-blue',
        'color' => '#062288',
    ),
    array(
        'name' => __( 'Dark Blue', 'starter-theme' ),
        'slug' => 'dark-blue',
        'color' => '#020726',
    ),
    array(
        'name' => __( 'Bright Pink', 'starter-theme' ),
        'slug' => 'bright-pink',
        'color' => '#FF009B',
    ),
    array(
        'name' => __( 'Deep Red', 'starter-theme' ),
        'slug' => '#810207',
        'color' => '#810207',
	),
	array(
        'name' => __( 'Off White', 'starter-theme' ),
        'slug' => 'off-white',
        'color' => '#FBF8FA',
    ),
) );

