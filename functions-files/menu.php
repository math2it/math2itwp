<?php

// ---------------------------------------------------------------------
// Add custom menus to theme
// ---------------------------------------------------------------------
function wp_custom_new_menu() {
  register_nav_menus(
    array(
      'math2it-custom-menu' => __( 'Math2IT Menu' ),
    )
  );
}
add_action( 'init', 'wp_custom_new_menu' );