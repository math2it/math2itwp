<?php 

/* Update latest theme version (we use internally for new version introduction text) */

add_action('wp_ajax_herald_update_version', 'herald_update_version');

if(!function_exists('herald_update_version')):
function herald_update_version(){
	update_option('herald_theme_version',HERALD_THEME_VERSION);
	die();
}
endif;


/* Hide welcome screen */

add_action('wp_ajax_herald_hide_welcome', 'herald_hide_welcome');

if(!function_exists('herald_hide_welcome')):
function herald_hide_welcome(){
	update_option('herald_welcome_box_displayed', true);
	die();
}
endif;


/**
 * Get searched posts or pages on ajax call for auto-complete functionality
 * 
 */
add_action( 'wp_ajax_herald_ajax_search', 'herald_ajax_search' );

if ( !function_exists( 'herald_ajax_search' ) ):
	function herald_ajax_search() {
		
		$post_type = in_array($_GET['type'], array('posts', 'featured')) ? array_keys( get_post_types( array( 'public' => true ) ) ) : $_GET['type'];
		
		$posts = get_posts( array(
				's' => $_GET['term'],
				'post_type' => $post_type,
				'posts_per_page' => -1
			) );

		$suggestions = array();

		global $post;
		
		foreach ( $posts as $post ) {
			setup_postdata( $post );
			$suggestion = array();
			$suggestion['label'] = esc_html( $post->post_title );
			$suggestion['id'] = $post->ID;
			$suggestions[]= $suggestion;
		}

		$response = $_GET["callback"] . "(" . json_encode( $suggestions ) . ")";

		echo $response;

		die();
	}
endif;

?>