<?php
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'dijlewolven-child' for the blaskan theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 20);

// functie om svg (vector) files te kunnen oploaden

function cc_mime_types($mimes) 
{ $mimes['svg'] = 'image/svg+xml'; return $mimes; } add_filter('upload_mimes', 'cc_mime_types'); 




// bijkomende style-sheet:
function additional_custom_styles() {

    /*Enqueue The Styles*/
    wp_enqueue_style( 'responsive', get_stylesheet_directory_uri() . '/responsive.css' ); 
}
add_action( 'wp_enqueue_scripts', 'additional_custom_styles', 40);

?>