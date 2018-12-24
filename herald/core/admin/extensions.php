<?php

/* Run Theme Update Check */

add_action( 'admin_init', 'herald_run_updater' );

if ( !function_exists( 'herald_run_updater' ) ):
	function herald_run_updater() {

		$user = herald_get_option( 'theme_update_username' );
		$apikey = herald_get_option( 'theme_update_apikey' );
		if ( !empty( $user ) && !empty( $apikey ) ) {
			include_once get_template_directory() .'/inc/updater/class-pixelentity-theme-update.php';
			PixelentityThemeUpdate::init( $user, $apikey );
		}
	}
endif;


/* Extened user social profiles  */

add_filter( 'user_contactmethods', 'herald_user_social_profiles' );

if ( !function_exists( 'herald_user_social_profiles' ) ):
	function herald_user_social_profiles( $contactmethods ) {

		unset( $contactmethods['aim'] );
		unset( $contactmethods['yim'] );
		unset( $contactmethods['jabber'] );

		$social = herald_get_social();
		foreach ( $social as $soc_id => $soc_name ) {
			if ( $soc_id ) {
				$contactmethods[$soc_id] = $soc_name;
			}
		}

		return $contactmethods;
	}
endif;


/* Store registered sidebars so we can get them before wp_registered_sidebars is initialized to use them in theme options */

add_action( 'admin_init', 'herald_check_sidebars' );

if ( !function_exists( 'herald_check_sidebars' ) ):
	function herald_check_sidebars() {
		global $wp_registered_sidebars;
		if ( !empty( $wp_registered_sidebars ) ) {
			update_option( 'herald_registered_sidebars', $wp_registered_sidebars );
		}
	}
endif;


/* Change customize link to lead to theme options instead of live customizer */

add_filter( 'wp_prepare_themes_for_js', 'herald_change_customize_link' );

if ( !function_exists( 'herald_change_customize_link' ) ):
	function herald_change_customize_link( $themes ) {
		if ( array_key_exists( 'herald', $themes ) ) {
			$themes['herald']['actions']['customize'] = admin_url( 'admin.php?page=herald_options' );
		}
		return $themes;
	}
endif;


/* Change default arguments of flickr widget plugin */

add_filter( 'mks_flickr_widget_modify_defaults', 'herald_flickr_widget_defaults' );

if ( !function_exists( 'herald_flickr_widget_defaults' ) ):
	function herald_flickr_widget_defaults( $defaults ) {

		$defaults['t_width'] = 93;
		$defaults['t_height'] = 93;
		return $defaults;
	}
endif;


/* Change default arguments of author widget plugin */

add_filter( 'mks_author_widget_modify_defaults', 'herald_author_widget_defaults' );

if ( !function_exists( 'herald_author_widget_defaults' ) ):
	function herald_author_widget_defaults( $defaults ) {
		$defaults['avatar_size'] = 80;
		return $defaults;
	}
endif;


/* Change default arguments of social widget plugin */

add_filter( 'mks_social_widget_modify_defaults', 'herald_social_widget_defaults' );

if ( !function_exists( 'herald_social_widget_defaults' ) ):
	function herald_social_widget_defaults( $defaults ) {
		$defaults['size'] = 44;
		$defaults['style'] = 'circle';
		return $defaults;
	}
endif;


/* Show admin notices */

add_action( 'admin_init', 'herald_check_installation' );

if ( !function_exists( 'herald_check_installation' ) ):
	function herald_check_installation() {
		add_action( 'admin_notices', 'herald_welcome_msg', 1 );
		add_action( 'admin_notices', 'herald_update_msg', 1 );
	}
endif;


/* Show welcome message and quick tips after theme activation */
if ( !function_exists( 'herald_welcome_msg' ) ):
	function herald_welcome_msg() {
		if ( !get_option( 'herald_welcome_box_displayed' ) ) { 
			update_option( 'herald_theme_version', HERALD_THEME_VERSION );
			include_once get_template_directory() .'/core/admin/welcome-panel.php';
		}
	}
endif;


/* Show message box after theme update */
if ( !function_exists( 'herald_update_msg' ) ):
	function herald_update_msg() {
		if ( get_option( 'herald_welcome_box_displayed' ) ) {
			$prev_version = get_option( 'herald_theme_version' );
			$cur_version = HERALD_THEME_VERSION;
			if ( $prev_version === false ) { $prev_version = '0.0.0'; }
			if ( version_compare( $cur_version, $prev_version, '>' ) ) {
				include_once get_template_directory() .'/core/admin/update-panel.php';
			}
		}
	}
endif;


/* Add dashboard widget */

add_action( 'wp_dashboard_setup', 'herald_add_dashboard_widgets' );

if ( !function_exists( 'herald_add_dashboard_widgets' ) ):
	function herald_add_dashboard_widgets() {
		add_meta_box( 'herald_dashboard_widget', 'Meks - WordPress Themes & Plugins', 'herald_dashboard_widget_cb', 'dashboard', 'side', 'high' );
	}
endif;


/* Function that outputs the contents of our dashboard widget */

if ( !function_exists( 'herald_dashboard_widget_cb' ) ):
	function herald_dashboard_widget_cb() {
		$hide = false;
		if ( $data = get_transient( 'herald_mksaw' ) ) { 
			if ( $data != 'error' ) {
				echo $data;
			} else {
				$hide = true;
			}
		} else {
			$url = 'https://demo.mekshq.com/mksaw.php';
			$args = array( 'body' => array( 'key' => md5( 'meks' ), 'theme' => 'herald' ) );
			$response = wp_remote_post( $url, $args );
			if ( !is_wp_error( $response ) ) {
				$json = wp_remote_retrieve_body( $response );
				if ( !empty( $json ) ) {
					$json = ( json_decode( $json ) );
					if ( isset( $json->data ) ) {
						echo $json->data;
						set_transient( 'herald_mksaw', $json->data, 86400 );
					} else {
						set_transient( 'herald_mksaw', 'error', 86400 );
						$hide = true;
					}
				} else {
					set_transient( 'herald_mksaw', 'error', 86400 );
					$hide = true;
				}

			} else {
				set_transient( 'herald_mksaw', 'error', 86400 );
				$hide = true;
			}
		}

		if ( $hide ) {
			echo '<style>#herald_dashboard_widget {display:none;}</style>'; //hide widget if data is not returned properly
		}

	}
endif;


/* White label WP Review plugin - remove banner from options */

add_filter( 'wp_review_remove_branding', '__return_true' );


/* Remove WP review for pages */

add_filter( 'wp_review_excluded_post_types', 'herald_wp_review_exclude_post_types' );

if ( !function_exists( 'herald_wp_review_exclude_post_types' ) ):
	function herald_wp_review_exclude_post_types( $excluded ) {
	  $excluded[] = 'page';
	  return $excluded;
	}
endif; 

/* Remove WP review notice */

remove_action('admin_notices', 'wp_review_admin_notice');


/* Remove WP review jQuery UI from admin pages */

add_action('admin_enqueue_scripts', 'herald_wp_review_exclude_admin_scripts', 99 );

if ( !function_exists( 'herald_wp_review_exclude_admin_scripts' ) ):
	function herald_wp_review_exclude_admin_scripts() {

		if( herald_is_wp_review_active() ) {
		 	wp_dequeue_style( 'plugin_name-admin-ui-css' );
		 	wp_dequeue_style( 'wp-review-admin-ui-css' );
		}
		
		wp_dequeue_style( 'jquery-ui.js' );

	}
endif;


?>