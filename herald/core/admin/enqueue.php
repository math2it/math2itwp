<?php

/* Load admin scripts and styles */
add_action( 'admin_enqueue_scripts', 'herald_load_admin_scripts' );

/**
 * Load scripts and styles in admin
 *
 * It just wrapps two other separate functions for loading css and js files in admin
 *
 * @return void
 * @since  1.0
 */

function herald_load_admin_scripts() {
	herald_load_admin_css();
	herald_load_admin_js();
}


/**
 * Load admin css files
 *
 * @return void
 * @since  1.0
 */

function herald_load_admin_css() {

	global $pagenow, $typenow;


	//Load color picker for categories
	if ( in_array( $pagenow, array( 'edit-tags.php', 'term.php' ) ) && isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'category' ) {
		wp_enqueue_style( 'wp-color-picker' );
	}

	if ( $typenow == 'page' && ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) ) {
		wp_enqueue_style ( 'wp-jquery-ui-dialog' );
	}

	//Load small admin style tweaks
	wp_enqueue_style( 'herald-admin', get_template_directory_uri() . '/assets/css/admin/global.css', false, HERALD_THEME_VERSION, 'screen, print' );
}


/**
 * Load admin js files
 *
 * @return void
 * @since  1.0
 */

function herald_load_admin_js() {

	global $pagenow, $typenow;

	//Load category js
	if ( in_array( $pagenow, array( 'edit-tags.php', 'term.php' ) ) && isset( $_GET['taxonomy'] ) && $_GET['taxonomy'] == 'category' ) {
		wp_enqueue_script( 'herald-category', get_template_directory_uri().'/assets/js/admin/metaboxes-category.js', array( 'jquery', 'wp-color-picker' ), HERALD_THEME_VERSION );
	}

	//Load post & page js
	if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
		if ( $typenow == 'post' ) {
			wp_enqueue_script( 'herald-post', get_template_directory_uri().'/assets/js/admin/metaboxes-post.js', array( 'jquery' ), HERALD_THEME_VERSION );
		} elseif ( $typenow == 'page' ) {
			wp_enqueue_script( 'herald-page', get_template_directory_uri().'/assets/js/admin/metaboxes-page.js', array( 'jquery', 'jquery-ui-dialog', 'jquery-ui-sortable', 'jquery-ui-autocomplete' ), HERALD_THEME_VERSION );
			wp_localize_script( 'herald-page', 'herald_js_settings', herald_get_admin_js_settings() );
		}
	}
}

?>