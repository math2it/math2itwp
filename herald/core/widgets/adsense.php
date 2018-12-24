<?php
/*-----------------------------------------------------------------------------------*/
/*	Adsense Widget Class
/*-----------------------------------------------------------------------------------*/

class HRD_Adsense_Widget extends WP_Widget { 

	var $defaults;

	function __construct() {
		$widget_ops = array( 'classname' => 'herald_adsense_widget', 'description' => esc_html__('You can place Google AdSense or any JavaScript related code inside this widget', 'herald') );
		$control_ops = array( 'id_base' => 'herald_adsense_widget' );
		parent::__construct( 'herald_adsense_widget', esc_html__('Herald Adsense', 'herald'), $widget_ops, $control_ops );

		$this->defaults = array( 
				'title' => '',
				'adsense_code' => '',
			);
	}

	
	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		if ( !empty($title) ) {
			echo $before_title . $title . $after_title;
		}
		
		$adsense_code = !empty( $instance['adsense_code'] ) ? $instance['adsense_code'] : '';

		?>
		<div class="herald_adsense_wrapper">
			<?php echo $adsense_code; ?>
		</div>
	
		<?php
			echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adsense_code'] = current_user_can('unfiltered_html') ? $new_instance['adsense_code'] : stripslashes( wp_filter_post_kses( addslashes($new_instance['adsense_code']) ) );
		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>
			
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title', 'herald'); ?>:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
			<small class="howto"><?php esc_html_e('Leave empty for no title', 'herald'); ?></small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'adsense_code' )); ?>"><?php esc_html_e('Adsense Code', 'herald'); ?>:</label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'adsense_code' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'adsense_code' )); ?>" class="widefat" rows="10"><?php echo $instance['adsense_code']; ?></textarea>
			<small class="howto"><?php esc_html_e('Place your Google Adsense code or any JavaScript related advertising code.', 'herald'); ?></small>
		</p>
				
	<?php
	}
}

?>