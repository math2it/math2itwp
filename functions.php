<?php // start every pure php file


// CSS JS
require_once( __DIR__ . '/functions-files/css-js.php');

// Google font
require_once( __DIR__ . '/functions-files/google-font.php');

// Math2IT custom settings
require_once( __DIR__ . '/functions-files/math2it-setting.php');

// Custom menu theme
require_once( __DIR__ . '/functions-files/menu.php');

// Navigation
require_once( __DIR__ . '/functions-files/nav.php');

// wordpress title
add_theme_support( 'title-tag' );
add_filter( 'document_title_separator', 'cyb_document_title_separator' );
function cyb_document_title_separator( $sep ) {
    $sep = "|";
    return $sep;
}

// Support Featured Images
add_theme_support( 'post-thumbnails' );

// css admin page
function admin_panel_css() {
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style_admin.css' );
}
add_action( 'admin_head', 'admin_panel_css' );



// Support svg image 
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
    }
add_action('upload_mimes', 'add_file_types_to_uploads');




