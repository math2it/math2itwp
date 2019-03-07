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

// Quick edit post meta field
require_once( __DIR__ . '/functions-files/quick-edit.php');

// Gutenberg
// require_once( __DIR__ . '/functions-files/gutenberg.php');

// wordpress title
add_theme_support( 'title-tag' );
add_filter( 'document_title_separator', 'cyb_document_title_separator' );
function cyb_document_title_separator( $sep ) {
    $sep = "|";
    return $sep;
}


// Support Featured Images
add_theme_support( 'post-thumbnails' );

// remove p tag from category description
remove_filter('term_description','wpautop');


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


// support wide image
function writy_setup() {
    add_theme_support( 'align-wide' );
  }
add_action( 'after_setup_theme', 'writy_setup' );


// comments 
// ------------------------------------------------

// function wpbeginner_comment_text_before($arg) {
//     $arg['comment_notes_before'] = "<p class='comment-policy'>We are glad you have chosen to leave a comment. Please keep in mind that comments are moderated according to our <a href='http://www.example.com/comment-policy-page/'>comment policy</a>.</p>";
//     return $arg;
// }
  
// add_filter('comment_form_defaults', 'wpbeginner_comment_text_before');

// // move comment field to bottom
// function wpb_move_comment_field_to_bottom( $fields ) {
//     $comment_field = $fields['comment'];
//     unset( $fields['comment'] );
//     $fields['comment'] = $comment_field;
//     return $fields;
// }
// add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom');

// // remove website field 
// function wpbeginner_remove_comment_url($arg) {
//     $arg['url'] = '';
//     return $arg;
// }
// add_filter('comment_form_default_fields', 'wpbeginner_remove_comment_url');


// category and tag have the same template
// ------------------------------------------------
add_filter( 'category_template', 'category_and_cat_template' );
add_filter( 'tag_template', 'category_and_cat_template' );
function category_and_cat_template( $template ) {
    if ((is_category() and (!is_category('book')) and (!is_category('tool'))) or (is_tag())) {
        $template = locate_template( 'cat-tag-layout.php' ); 
    }
    return $template;
}


// change the lenght of an excerpt
function wpdocs_custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
function wpdocs_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );


// ------------------------------------------------
// PLUGINS
// ------------------------------------------------
require_once( __DIR__ . '/plugins/custom-gutenberg-button/my-custom-format.php');
