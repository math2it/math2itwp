<?php
/*-----------------------------------------------------------------------------------*/
/*	Video Widget Class
/*-----------------------------------------------------------------------------------*/

class HRD_Video_Widget extends WP_Widget { 

	var $defaults;

	function __construct() {
		$widget_ops = array( 'classname' => 'herald_video_widget', 'description' => esc_html__('You can easily place YouTube or Vimeo video here', 'herald') );
		$control_ops = array( 'id_base' => 'herald_video_widget' );
		parent::__construct( 'herald_video_widget', esc_html__('Herald Video', 'herald'), $widget_ops, $control_ops );

		$this->defaults = array( 
				'title' => esc_html__('Video', 'herald'),
				'video_id' => '',
				'type' => 'youtube',
				'height' => 165,
				'content' => ''
			);
	}

	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = apply_filters('widget_title', $instance['title'] );
		
		echo $before_widget;

		if ( !empty($title) ) {
			echo $before_title . $title . $after_title;
		}
		?>
		<div class="video-widget-inside">
		<?php if(!empty($instance['video_id'])) : ?>

			<?php $protocol =  is_ssl() ? 'https://' : 'http://'; ?>

			<?php if($instance['type'] == 'youtube') : ?>
			
				<iframe width="100%" height="<?php echo absint($instance['height']); ?>" src="<?php echo esc_attr($protocol);?>www.youtube.com/embed/<?php echo esc_attr($instance['video_id']); ?>?showinfo=0;controls=0" frameborder="0" allowfullscreen></iframe>
			
			<?php elseif($instance['type'] == 'vimeo') : ?>
				
				<iframe width="100%" height="<?php echo absint($instance['height']); ?>" src="<?php echo esc_attr($protocol);?>player.vimeo.com/video/<?php echo esc_attr($instance['video_id']);?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			
			<?php endif; ?>
			
		<?php endif; ?>
		
		<?php if(!empty($instance['content'])) : ?>
			<?php echo wpautop($instance['content']);?>
		<?php endif; ?>
		
		<div class="clear"></div>
		
		</div>
		
		<?php
		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_id'] = strip_tags( $new_instance['video_id'] );
		$instance['type'] = $new_instance['type'];
		$instance['height'] = absint($new_instance['height']);
		$instance['content'] = $new_instance['content'];
		return $instance;
	}

	function form( $instance ) {
	
		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>
				
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title', 'herald'); ?>:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		
		<p>
			<label><?php esc_html_e('Video type', 'herald'); ?>:</label><br/>
			<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" value="youtube" <?php checked($instance['type'],'youtube'); ?>/>
			<label><?php esc_html_e('YouTube', 'herald'); ?></label><br/>
			<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" value="vimeo" <?php checked($instance['type'],'vimeo'); ?>/>
			<label><?php esc_html_e('Vimeo', 'herald'); ?></label>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'video_id' )); ?>"><?php esc_html_e('Video ID', 'herald'); ?>:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'video_id' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'video_id' )); ?>" value="<?php echo esc_attr($instance['video_id']); ?>" class="widefat" />
			<small><?php esc_html_e('ID example', 'herald'); ?>: XsEMu5UCy0g</small>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php esc_html_e('Height', 'herald'); ?>: </label>
			<input id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'height' )); ?>" value="<?php echo absint($instance['height']); ?>" class="small-text" /> px
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'content' )); ?>"><?php esc_html_e('Description (optional)', 'herald'); ?>:</label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'content' )); ?>" rows="5" name="<?php echo esc_attr($this->get_field_name( 'content' )); ?>" class="widefat"><?php echo $instance['content']; ?></textarea>
		</p>
		
	<?php
	}
}

?>