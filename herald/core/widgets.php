<?php

add_action( 'widgets_init', 'herald_register_widgets' );

/**
 * Register widgets
 *
 * Callback function which includes widget classes and initialize theme specific widgets
 * 
 * @return void
 * @since  1.0
 */

if(!function_exists('herald_register_widgets')) :
	function herald_register_widgets(){
			
			//Include widget classes
	 		include_once( get_template_directory() .'/core/widgets/posts.php');
	 		include_once( get_template_directory() .'/core/widgets/video.php');
	 		include_once( get_template_directory() .'/core/widgets/adsense.php');

			register_widget('HRD_Posts_Widget');
			register_widget('HRD_Video_Widget');
			register_widget('HRD_Adsense_Widget');
	}
endif;

?>