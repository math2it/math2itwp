<?php
 
/* Load frontend scripts and styles */
add_action( 'wp_enqueue_scripts', 'herald_load_scripts' );

/**
 * Load scripts and styles on frontend
 *
 * It just wrapps two other separate functions for loading css and js files
 *
 * @return void
 * @since  1.0
 */

function herald_load_scripts() {
	herald_load_css();
	herald_load_js();
}

/**
 * Load frontend css files
 *
 * @return void
 * @since  1.0
 */

function herald_load_css() {
	
	//Load google fonts
	if( $fonts_link = herald_generate_fonts_link() ){
		wp_enqueue_style( 'herald-fonts', $fonts_link, false, HERALD_THEME_VERSION );
	}
	
	
	//Check if is minified option active and load appropriate files
	if(	herald_get_option('minify_css') ){
		
		wp_enqueue_style( 'herald-main', get_template_directory_uri() . '/assets/css/min.css', false, HERALD_THEME_VERSION );
	
	} else {

		$styles = array( 
			'font-awesome' => 'font-awesome.css',
			'bootstrap' => 'bootstrap.css',
			'magnific-popup' => 'magnific-popup.css',
			'owl-carousel' => 'owl.carousel.css',
			'main' => 'main.css'
		);

		foreach ($styles as $id => $style ){
			wp_enqueue_style( 'herald-'.$id, get_template_directory_uri() . '/assets/css/' . $style, false, HERALD_THEME_VERSION );
		}
	}

	//Append dynamic css
	wp_add_inline_style( 'herald-main', herald_generate_dynamic_css() );

	//Load WooCommerce CSS
	if ( herald_is_woocommerce_active() ) {
		wp_enqueue_style( 'herald-woocommerce', get_template_directory_uri() . '/assets/css/herald-woocommerce.css', array( 'herald-main'), HERALD_THEME_VERSION );
	}

	//Load bbPress CSS
	if ( herald_is_bbpress_active() ) {
		wp_enqueue_style( 'herald-bbpress', get_template_directory_uri() . '/assets/css/herald-bbpress.css', array( 'herald-main'), HERALD_THEME_VERSION );
	}

	//Load RTL css
	if ( herald_is_rtl() ) {
		wp_enqueue_style( 'herald-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array( 'herald-main'), HERALD_THEME_VERSION );
	}

	//Do not load font awesome from our shortcodes plugin
	wp_dequeue_style( 'mks_shortcodes_fntawsm_css' );
	
}


/**
 * Load frontend js files
 *
 * @return void
 * @since  1.0
 */

function herald_load_js() {

	//Load comment reply js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Check if is minified option active and load appropriate files
	if(	herald_get_option('minify_js') ){
		
		wp_enqueue_script( 'herald-main', get_template_directory_uri() . '/assets/js/min.js', array( 'jquery' ), HERALD_THEME_VERSION, true );
	
	} else {

		$scripts = array( 
			'imagesloaded' => 'imagesloaded.js',
			'fitvids' => 'jquery.fitvids.js',
			'magnific-popup' => 'jquery.magnific-popup.js',
			'sticky-kit' => 'jquery.sticky-kit.js',
			'owl-carousel' => 'owl.carousel.js',
			'main' => 'main.js'
		);

		foreach ($scripts as $id => $script ){
			wp_enqueue_script( 'herald-'.$id, get_template_directory_uri().'/assets/js/'. $script, array( 'jquery' ), HERALD_THEME_VERSION, true );
		}
	}

	wp_localize_script( 'herald-main', 'herald_js_settings', herald_get_js_settings() );
}
?>