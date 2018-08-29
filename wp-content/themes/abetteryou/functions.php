<?php
/**
 * abetteryou functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package abetteryou
 */

use Includes\Modules\Leads\Leads;
use Includes\Modules\Leads\SimpleContact;
require('vendor/autoload.php');

$fosterform = new SimpleContact();
$fosterform->setupAdmin();
$fosterform->setupShortcode();


if ( ! function_exists( 'abetteryou_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function abetteryou_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on abetteryou, use a find and replace
	 * to change 'abetteryou' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'abetteryou', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'abetteryou' ),
		'mini' => esc_html__( 'Top Mini Menu', 'abetteryou' ),
		'footer' => esc_html__( 'Footer Menu', 'abetteryou' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
	) );*/

	// Set up the WordPress core custom background feature.
	/*add_theme_support( 'custom-background', apply_filters( 'abetteryou_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );*/
	
	register_post_type( 'button', array(
			'labels'             => array(
				'name' 		         => _x( 'Feature Buttons', 'post type general name' ),
				'singular_name'      => _x( 'Feature Button', 'post type singular name' ),
				'menu_name'          => _x( 'Feature Buttons', 'admin menu' ),
				'name_admin_bar'     => _x( 'Feature Button', 'add new on admin bar' ),
				'add_new'            => _x( 'Add New', 'button' ),
				'add_new_item'       => __( 'Add New Feature Button' ),
				'new_item'           => __( 'New Feature Button' ),
				'edit_item'          => __( 'Edit Feature Button' ),
				'view_item'          => __( 'View Feature Button' ),
				'all_items'          => __( 'All Feature Buttons' ),
				'search_items'       => __( 'Search Feature Buttons' ),
				'parent_item_colon'  => __( 'Parent Feature Buttons:' ),
				'not_found'          => __( 'No feature buttons found.' ),
				'not_found_in_trash' => __( 'No feature buttons in Trash.' )
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 
				'slug' 			=> 'buttons',   		//string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
				'with_front' 	=> false, 				//bool Should the permalink structure be prepended with the front base. <br>
														//(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
				'feeds' 		=> true, 				//bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
				'pages' 		=> false				//bool Should the permalink structure provide for pagination. Defaults to true
			),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor' )
	));
	register_post_type( 'location', array(
			'labels'             => array(
				'name' 		         => _x( 'Locations', 'post type general name', 'cc' ),
				'singular_name'      => _x( 'Location', 'post type singular name', 'cc' ),
				'menu_name'          => _x( 'Locations', 'admin menu', 'cc' ),
				'name_admin_bar'     => _x( 'Locations', 'add new on admin bar', 'cc' ),
				'add_new'            => _x( 'Add New', 'location', 'cc' ),
				'add_new_item'       => __( 'Add New Location', 'cc' ),
				'new_item'           => __( 'New Location', 'cc' ),
				'edit_item'          => __( 'Edit Location', 'cc' ),
				'view_item'          => __( 'View Location', 'cc' ),
				'all_items'          => __( 'All Locations', 'cc' ),
				'search_items'       => __( 'Search Locations', 'cc' ),
				'parent_item_colon'  => __( 'Parent Location:', 'cc' ),
				'not_found'          => __( 'No locations found.', 'cc' ),
				'not_found_in_trash' => __( 'No locations found in Trash.', 'cc' )
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 
				'slug' 			=> 'locations',   		//string Customize the permalink structure slug. Defaults to the $post_type value. Should be translatable.
				'with_front' 	=> false, 				//bool Should the permalink structure be prepended with the front base. <br>
														//(example: if your permalink structure is /blog/, then your links will be: false-> /news/, true->/blog/news/). Defaults to true
				'feeds' 		=> true, 				//bool Should a feed permalink structure be built for this post type. Defaults to has_archive value
				'pages' 		=> false				//bool Should the permalink structure provide for pagination. Defaults to true
			),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor' )
	));
}
endif; // abetteryou_setup
add_action( 'after_setup_theme', 'abetteryou_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function abetteryou_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'abetteryou_content_width', 640 );
}
add_action( 'after_setup_theme', 'abetteryou_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function abetteryou_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'abetteryou' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	/*register_sidebar( array(
		'name'          => esc_html__( 'Hours', 'abetteryou' ),
		'id'            => 'widget-hours',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar(array(
		'name'          => esc_html__( 'Location Map', 'abetteryou' ),
		'id'            => 'widget-map',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '',
		'after_title'   => '',
    ));
	register_sidebar( array(
		'name'          => esc_html__( 'Address', 'abetteryou' ),
		'id'            => 'widget-address',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );*/
}
add_action( 'widgets_init', 'abetteryou_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function abetteryou_scripts() { //<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Abel|Work+Sans:400,700' rel='stylesheet' type='text/css'>
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700|Abel|Work+Sans:300,400,700');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'abetteryou-style', get_stylesheet_uri() );
	wp_enqueue_script( 'abetteryou-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);
	wp_enqueue_script( 'abetteryou-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'abetteryou_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

//sorting arrays by specific key
function array_sort($array, $on, $order='SORT_ASC') {
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case 'SORT_ASC':
                asort($sortable_array);
            break;
            case 'SORT_DESC':
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function myfeed_request($qv) {
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types();
	return $qv;
}
add_filter('request', 'myfeed_request');
