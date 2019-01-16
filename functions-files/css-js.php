<?php

// ---------------------------------------------------------------------
// Add scripts and stylesheets
// ---------------------------------------------------------------------
function math2itwp_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3' );
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.0' );
  wp_enqueue_style( 'fontello', get_template_directory_uri() . '/css/fontello/fontello.css' );
  wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '4.1.3', true );
  wp_enqueue_script( 'jquery',
  get_template_directory_uri() . '/js/jquery-1.11.0.min.js', array( 'jquery' ), '1.11.0', true );
  wp_enqueue_script( 'backtotop',
  get_template_directory_uri() . '/js/backtotop.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'math2itwp_scripts' );