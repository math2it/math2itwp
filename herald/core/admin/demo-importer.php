<?php

/**
 * Demo directory path filter
 *
 * It sets the path for demo packages
 *
 * @return string Directory path
 * @since  1.0
 */
if ( !function_exists( 'herald_wbc_change_demo_directory_path' ) ):
    function herald_wbc_change_demo_directory_path( $demo_directory_path ) {

        $demo_directory_path = str_replace( '\\', '/', get_template_directory() . '/inc/demos/' );

        return $demo_directory_path;

    }
endif;

add_filter( 'wbc_importer_dir_path', 'herald_wbc_change_demo_directory_path' );


/**
 * Demo page description filter
 *
 * It sets the description text of demo importer page in theme options
 *
 * @return string Directory path
 * @since  1.0
 */

if ( !function_exists( 'herald_wbc_filter_desc' ) ):
    function herald_wbc_filter_desc( $description ) {

        $message = __( sprintf( 'Use this panel to import content from theme demo example(s). Note: If you want to try multiple demos, please use %s plugin to reset your WordPress installation after each import and try another demo afterwards.' , '<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a>' ), 'herald' );
        return $message;
    }
endif;

add_filter( 'wbc_importer_description', 'herald_wbc_filter_desc' );


/**
 * Demos title filter
 *
 * It sets the title of demo importer examples in theme options
 *
 * @return string Directory path
 * @since  1.0
 */

if ( !function_exists( 'herald_wbc_filter_demo_title' ) ):
    function herald_wbc_filter_demo_title( $path ) {

        switch ( $path ) {
        case '01_default': $title = esc_html__( 'Herald Default', 'herald' ); break;
        case '02_essence': $title = esc_html__( 'Herald Essence', 'herald' ); break;
        case '03_fashion': $title = esc_html__( 'Herald Fashion', 'herald' ); break;
        case '04_sports': $title = esc_html__( 'Herald Sports', 'herald' ); break;
        case '05_tech': $title = esc_html__( 'Herald Tech', 'herald' ); break;
        case '06_blog': $title = esc_html__( 'Herald Blog', 'herald' ); break;
        default: break;
        }
        return $title;
    }
endif;

add_filter( 'wbc_importer_directory_title', 'herald_wbc_filter_demo_title' );

/**
 * Demo import handler
 *
 * Callback function to execute after redux demo importer.
 * It sets menu locations and home page.
 *
 * @param string  $demo_active_import Name of current demo package to import
 * @return void
 * @since  1.0
 */

if ( !function_exists( 'herald_wbc_after_import' ) ) :
    function herald_wbc_after_import( $demo_active_import , $demo_directory_path ) {

        /* Set Menus */


        $menus = array();

        $main_menu = get_term_by( 'name', 'Herald Main', 'nav_menu' );
        if ( isset( $main_menu->term_id ) ) {
            $menus['herald_main_menu'] = $main_menu->term_id;
        }

        $social_menu = get_term_by( 'name', 'Herald Social', 'nav_menu' );
        if ( isset( $social_menu->term_id ) ) {
            $menus['herald_social_menu'] = $social_menu->term_id;
        }

        $secondary_menu = get_term_by( 'name', 'Herald Secondary 1', 'nav_menu' );
        if ( isset( $secondary_menu->term_id ) ) {
            $menus['herald_secondary_menu_1'] = $secondary_menu->term_id;
        }

        if ( !empty( $menus ) ) {
            set_theme_mod( 'nav_menu_locations', $menus );
        }


        /* Set Home Page */

        $home_page_title = 'Herald Home';

        $page = get_page_by_title( $home_page_title );

        if ( isset( $page->ID ) ) {
            update_option( 'page_on_front', $page->ID );
            update_option( 'show_on_front', 'page' );
        }

        /* Add sidebars from theme options */

        delete_option( 'sidebars_widgets' );
        $custom_sidebars = array();

        global $wpdb;
        $row = $wpdb->get_row( $wpdb->prepare( "SELECT option_value FROM $wpdb->options WHERE option_name = %s LIMIT 1", 'herald_settings' ) );

        if ( is_object( $row ) ) {
            $opts = maybe_unserialize( $row->option_value );
            if ( isset( $opts['sidebars'] ) ) {
                $custom_sidebars = $opts['sidebars'];
            }
        }

        if ( !empty( $custom_sidebars ) ) {
            foreach ( $custom_sidebars as $key => $title ) {

                if ( is_numeric( $key ) ) {
                    register_sidebar(
                        array(
                            'id' => 'herald_sidebar_'.$key,
                            'name' => $title,
                            'description' => '',
                            'before_widget' => '<div id="%1$s" class="widget %2$s">',
                            'after_widget' => '</div>',
                            'before_title' => '<h4 class="widget-title h6"><span>',
                            'after_title' => '</span></h4>'
                        )
                    );
                }
            }
        }

    }

endif;

add_action( 'wbc_importer_after_theme_options_import', 'herald_wbc_after_import', 10, 2 );


?>