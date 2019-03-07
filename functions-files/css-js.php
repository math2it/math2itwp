<?php

// ------------------------------------------------------
// Add scripts and stylesheets
// ------------------------------------------------------
function math2itwp_scripts() {
  // bootstrap
  //----------------------
  // wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3' );
  wp_enqueue_style( 'bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css', array(), '4.2.1' );
  // wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '4.1.3', true );
  wp_enqueue_script( 'jquery','https://code.jquery.com/jquery-3.3.1.slim.min.js', array( 'jquery' ), '3.3.1', true );
  wp_enqueue_script( 'popper','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js', array(), '1.14.6', true );
  wp_enqueue_script( 'bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js', array(), '4.2.1', true );
  // others
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
  // wp_enqueue_style( 'font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0' );
  wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', array(), '5.7.2' );
  wp_enqueue_style( 'fontello', get_template_directory_uri() . '/css/fontello/fontello.css' );
  wp_enqueue_script( 'jquery',
  get_template_directory_uri() . '/js/jquery-1.11.0.min.js', array( 'jquery' ), '1.11.0', true );
  wp_enqueue_script( 'backtotop',
  get_template_directory_uri() . '/js/backtotop.js', array( 'jquery' ), '1.0', true );
  wp_enqueue_script( 'contact-form',
  get_template_directory_uri() . '/js/contact-form.js', array(), '1.0', true );
  // scrollspy headings
  // wp_enqueue_style( 'bootstrap-toc','https://cdn.rawgit.com/afeld/bootstrap-toc/v1.0.1/dist/bootstrap-toc.min.css', array(), '1.0.1' );
  // wp_enqueue_script( 'bootstrap-toc','https://cdn.rawgit.com/afeld/bootstrap-toc/v1.0.1/dist/bootstrap-toc.min.js', array(), '1.0.1', true );
  wp_enqueue_script( 'bootstrap-toc',get_template_directory_uri() . '/js/bootstrap-toc.min.js', array(), '1.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'math2itwp_scripts' );


// different css for toc sidebar on posts/page
function math2itwp_tocsidebar() {
  $post_id = get_the_ID();
  if ((get_field('toc_on_sidebar',$post_id)==true) or (get_the_series()) ):
    wp_enqueue_style( 'has_sidebar', get_template_directory_uri() . '/css/has_sidebar.css' );
  else:
    wp_enqueue_style( 'hasno_sidebar', get_template_directory_uri() . '/css/hasno_sidebar.css' );
  endif;
}
add_action( 'wp_enqueue_scripts', 'math2itwp_tocsidebar' );
