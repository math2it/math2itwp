<?php

// -------------------------------------------------
// Add Google Fonts
// -------------------------------------------------
function math2itwp_google_fonts() {
  wp_register_style('Comfortaa', 'http://fonts.googleapis.com/css?family=Comfortaa:400,700&amp;subset=vietnamese');
  wp_enqueue_style( 'Comfortaa'); // default font
  wp_register_style('Righteous', 'http://fonts.googleapis.com/css?family=Righteous'); // math2it's index title
  wp_enqueue_style( 'Righteous');
  wp_register_style('Nunito', 'https://fonts.googleapis.com/css?family=Nunito:400,400i,700,700i&amp;subset=vietnamese'); // math2it's index title
  wp_enqueue_style( 'Nunito');
  // wp_register_style('Pacifico', 'https://fonts.googleapis.com/css?family=Pacifico'); // category's title
  // wp_enqueue_style( 'Pacifico');
}
add_action('wp_print_styles', 'math2itwp_google_fonts');