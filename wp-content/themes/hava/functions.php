<?php

function hava_setup() {

  load_theme_textdomain( 'hava', get_template_directory() . '/languages' );

  add_theme_support( 'automatic-feed-links' );

  add_theme_support( 'title-tag' );

  add_theme_support('custom-background', array(
    'default-color' => '#fafafa',
  ));

  register_nav_menus(array(
    'header-menu' => __('Header Menu', 'hava'),
  ));

  $defaults = array(
    'height'      => 58,
    'header-text' => array( 'site-title' ),
  );
  add_theme_support( 'custom-logo', $defaults );

  add_theme_support('post-thumbnails');
  add_image_size('hava-large', 700, '', true);
  add_image_size('hava-medium', 250, '', true);
  add_image_size('hava-small', 120, '', true);


}
add_action( 'after_setup_theme', 'hava_setup' );

function hava_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'hava_content_width', 640 );
}
add_action( 'after_setup_theme', 'hava_content_width' );

function hava_nav() {
  wp_nav_menu( array(
    'theme_location'  => 'header-menu',
    'depth' => 1,
  ));
}

function hava_enqueue_scripts() {

  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );

  wp_enqueue_style(
    'google-fonts', add_query_arg(
      array(
        'family' => urlencode( 'Josefin Sans:300,400' ),
        'subset' => urlencode( 'latin' ),
      ), '//fonts.googleapis.com/css'
      )
    );

    wp_enqueue_style( 'hava-main-style', get_stylesheet_uri() );

    wp_enqueue_script( 'fontawesome', get_template_directory_uri() . '/js/fontawesome.min.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'fa-brands', get_template_directory_uri() . '/js/fa-brands.min.js', array ( 'jquery' ), 1.1, true);

    if ( is_singular() && comments_open() && esc_attr(get_option( 'thread_comments' )) ) {
      wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'hava_enqueue_scripts' );

function hava_widgets() {

    register_sidebar( array(
      'name' => __( 'Footer Widget 1', 'hava' ),
      'id' => 'footer-widget-1',
      'description' => __( 'Left side of the footer', 'hava' ),
    ) );

    register_sidebar( array(
      'name' => __( 'Footer Widget 2', 'hava' ),
      'id' => 'footer-widget-2',
      'description' => __( 'Middle of the footer', 'hava' ),
    ) );

    register_sidebar( array(
      'name' => __( 'Footer Widget 3', 'hava' ),
      'id' => 'footer-widget-3',
      'description' => __( 'Right side of the footer', 'hava' ),
    ) );

}
add_action( 'widgets_init', 'hava_widgets' );

require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/hava-logo.php';
