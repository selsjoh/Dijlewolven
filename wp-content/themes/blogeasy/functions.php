<?php
/**
 * Blogeasy functions and definitions
 */


/**
* Sets up theme defaults and registers support for various WordPress features.
*/
if ( ! function_exists( 'blogeasy_setup' ) ) :

	function blogeasy_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'blogeasy', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'blogeasy' ),
		) );

		// Switch default core markup to output valid HTML5
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blogeasy_custom_background_args', array(
			'default-color' => 'efefef',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Set post thumbnail size
		set_post_thumbnail_size( 1366, 900 );

	}
endif;
add_action( 'after_setup_theme', 'blogeasy_setup' );


/**
* Set the content width in pixels, based on the theme's design and stylesheet.
*/
function blogeasy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogeasy_content_width', 980 );
}
add_action( 'after_setup_theme', 'blogeasy_content_width', 0 );


/**
* Register widget area.
*/
function blogeasy_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blogeasy' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'blogeasy' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );
}
add_action( 'widgets_init', 'blogeasy_widgets_init' );


/**
* Enqueue scripts and styles.
*/
function blogeasy_scripts() {
	wp_enqueue_style( 'blogeasy-fonts', '//fonts.googleapis.com/css?family=Barlow|Barlow+Semi+Condensed:500' );
	wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/assets/css/fontawesome-all.css', array(), '5.0.6', 'all' );
	wp_enqueue_style( 'slicknavcss', get_template_directory_uri() . '/assets/css/slicknav.css', array(), 'v1.0.10', 'all' );
	wp_enqueue_style( 'bootstrap-4', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), 'v4.0.0', 'all' );
	wp_enqueue_style( 'blogeasy-style', get_stylesheet_uri(), array(), 'v1.0.0', 'all' );

	wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.js', array('jquery'), 'v1.0.10', true );
	wp_enqueue_script( 'blogeasy-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blogeasy_scripts' );


/**
* Implement the Custom Header feature.
*/
require get_template_directory() . '/inc/custom-header.php';


/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/template-tags.php';


/**
* Functions which enhance the theme by hooking into WordPress.
*/
require get_template_directory() . '/inc/template-functions.php';


/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';


/**
* Load Jetpack compatibility file.
*/
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
* Load WooCommerce compatibility file.
*/
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
* Add Breadcrumb to the theme
*/
require get_template_directory() . '/inc/lib/breadcrumb-trail/breadcrumb-trail.php';


/**
* Add Plugin Recommendations
*/
require get_template_directory() . '/inc/lib/init-tgmpa.php';


/**
* Add Customizer Settings
*/
require get_template_directory() . '/inc/customizer/add-settings.php';
