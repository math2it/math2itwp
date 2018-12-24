<?php

add_action( 'init', 'herald_register_menus' );

/**
 * Register menus
 *
 * Callback function theme menus registration and init
 * 
 * @return void
 * @since  1.0
 */

if( !function_exists( 'herald_register_menus' ) ) :
    function herald_register_menus() {
	    register_nav_menu('herald_main_menu', esc_html__( 'Main Menu' , 'herald'));
	   	register_nav_menu('herald_social_menu', esc_html__( 'Social Menu' ,'herald'));
	   	register_nav_menu('herald_secondary_menu_1', esc_html__( 'Secondary Menu 1' , 'herald'));
	   	register_nav_menu('herald_secondary_menu_2', esc_html__( 'Secondary Menu 2' , 'herald'));
	   	register_nav_menu('herald_secondary_menu_3', esc_html__( 'Secondary Menu 3' , 'herald'));
    }
endif;

?>