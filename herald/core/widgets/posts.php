<?php

class HRD_Posts_Widget extends WP_Widget {

	var $defaults;

	function __construct() {
		$widget_ops = array( 'classname' => 'herald_posts_widget', 'description' => esc_html__( 'Display your posts with this widget', 'herald' ) );
		$control_ops = array( 'id_base' => 'herald_posts_widget' );
		parent::__construct( 'herald_posts_widget', esc_html__( 'Herald Posts', 'herald' ), $widget_ops, $control_ops );

		$this->defaults = array(
			'title' => esc_html__( 'Posts', 'herald' ),
			'style' => 'g1',
			'slider' => 0,
			'numposts' => 5,
			'category' => array(),
			'auto_detect' => 0,
			'orderby' => 0,
			'time' => 0,
			'meta' => array( 'date'),
			'format' => 0,
			'cat_link' => 1,
			'manual' => array(),
			'tag' => array(),
		);
	}


	function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance['title'] );

		

		if ( !empty( $title ) ) {
			$title =  $before_title . $title . $after_title;
			
			if( !empty( $instance['slider'] ) ) {			
				$title = str_replace('</span>', '</span><div class="herald-slider-controls"></div>', $title);
			}

			echo $title;
		}
	
		//print_r($instance);

		$q_args = array(
			'post_type'=> 'post',
			'posts_per_page' => $instance['numposts'],
			'ignore_sticky_posts' => 1,
			'orderby' => $instance['orderby']
		);


		if ( !empty( $instance['manual'] ) && !empty( $instance['manual'][0] ) ) {
			$q_args['posts_per_page'] = absint( count( $instance['manual'] ) );
			$q_args['orderby'] =  'post__in';
			$q_args['post__in'] =  $instance['manual'];
			$q_args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			if ( !empty( $instance['auto_detect'] ) && is_single() ) {

				$cats = get_the_category();

				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$q_args['category__in'][] = $cat->term_id;
					}
				}

			} else {

				if ( !empty( $instance['category'] ) ) {
					$q_args['category__in'] = $instance['category'];
				}
			}

			if ( !empty( $instance['tag'] ) ) {
				$q_args['tag_slug__in'] = $instance['tag'];
			}

			if ( !empty( $instance['format'] ) ) {
				
				if( $instance['format'] == 'standard'){
					
					$terms = array();
					$formats = get_theme_support('post-formats');
					if(!empty($formats) && is_array($formats[0])){
						foreach($formats[0] as $format){
							$terms[] = 'post-format-'.$format;
						}
					}
					$operator = 'NOT IN';

				} else {
					$terms = array('post-format-'.$instance['format']);
					$operator = 'IN';
				}
				
				$q_args['tax_query'] = array(
					array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => $terms,
					'operator' => $operator
					)
				);
			}

			if ( $instance['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {
				
				$q_args['orderby'] = 'meta_value_num';
				$q_args['meta_key'] = ev_get_meta_key();

			} else if ( strpos( $instance['orderby'], 'reviews' ) !== false && herald_is_wp_review_active() ) {
				
				$review_type = substr( $instance['orderby'], 8, strlen($instance['orderby']) );

				$q_args['orderby'] = 'meta_value_num';
				$q_args['meta_key'] = 'wp_review_total';

				$q_args['meta_query'] = array(
					array(
						'key'     => 'wp_review_type',
						'value'   => $review_type,
					)
				);

			}

			if($q_args['orderby'] == 'title'){
				$q_args['order'] = 'ASC';
			}


			if ( !empty( $instance['time'] ) ) {
				$q_args['date_query'] = array(
					'after' => date( 'Y-m-d', herald_calculate_time_diff( $instance['time'] ) )
				);
			}
		}

		$herald_posts = new WP_Query( $q_args );

		if ( $herald_posts->have_posts() ): ?>

		<?php $slider_class = !empty( $instance['slider'] ) && $herald_posts->post_count > 1 ? 'herald-widget-slider' : ''; ?>

		<div class="row <?php echo esc_attr( $slider_class ); ?>">

			<?php while ( $herald_posts->have_posts() ) : $herald_posts->the_post(); ?>
				<?php include( locate_template( 'core/widgets/posts-templates/content-'.$instance['style'].'.php' ) ); ?>
			<?php endwhile; ?>

		</div>

		<?php endif; ?>

		<?php wp_reset_postdata(); ?>

		<?php
		echo $after_widget;
	}


	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['orderby'] = $new_instance['orderby'];
		$instance['category'] = $new_instance['category'];
		$instance['numposts'] = absint( $new_instance['numposts'] );
		$instance['time'] = $new_instance['time'];
		$instance['style'] = $new_instance['style'];
		$instance['slider'] = isset( $new_instance['slider'] ) ? 1 : 0;
		$instance['cat_link'] = isset( $new_instance['cat_link'] ) ? 1 : 0;
		$instance['auto_detect'] = isset( $new_instance['auto_detect'] ) ? 1 : 0;
		$instance['meta'] = !empty($new_instance['meta']) ? $new_instance['meta'] : array();
		$instance['manual'] = !empty( $new_instance['manual'] ) ? explode( ",", $new_instance['manual'] ) : array();
		$instance['format'] = $new_instance['format'];
		$instance['tag'] = herald_get_tax_term_slug_by_name( $new_instance['tag'] );
		

		return $instance;
	}

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title', 'herald' ); ?>:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
	  		<?php $this->widget_style( $this, $instance['style'] ); ?>
		</p>

		<p>
	   	 	<label for="<?php echo esc_attr($this->get_field_id( 'numposts' )); ?>"><?php esc_html_e( 'Number of posts to show', 'herald' ); ?>:</label>
		 	<input id="<?php echo esc_attr($this->get_field_id( 'numposts' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'numposts' )); ?>" value="<?php echo absint( $instance['numposts'] ); ?>" class="small-text" />
	  	</p>

		<p>
			<input id="<?php echo esc_attr($this->get_field_id( 'slider' )); ?>" type="checkbox" name="<?php echo esc_attr($this->get_field_name( 'slider' )); ?>" value="1" <?php checked( 1, $instance['slider'] ); ?>/>
			<label for="<?php echo esc_attr($this->get_field_id( 'slider' )); ?>"><?php esc_html_e( 'Apply slider', 'herald' ); ?></label>
		</p>

	  	<p>
	  		<input id="<?php echo esc_attr($this->get_field_id( 'cat_link' )); ?>" type="checkbox" name="<?php echo esc_attr($this->get_field_name( 'cat_link' )); ?>" value="1" <?php checked( 1, $instance['cat_link'] ); ?>/>
			<label for="<?php echo esc_attr($this->get_field_id( 'cat_link' )); ?>"><?php esc_html_e( 'Display category link', 'herald' ); ?></label>
		</p>

		<p>
	  		<?php $this->widget_meta( $this, $instance['meta'] ); ?>
		</p>

	  	<p>
	  	 <?php $this->widget_orderby( $this, $instance['orderby'] ); ?>
	    </p>

	   <p>
	   	 <label for="<?php echo esc_attr($this->get_field_id( 'manual' )); ?>"><?php esc_html_e( 'Or choose manually', 'herald' ); ?>:</label>
		 <input id="<?php echo esc_attr($this->get_field_id( 'manual' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'manual' )); ?>" value="<?php echo esc_attr(implode( ",", $instance['manual'] )); ?>" class="widefat" />
		 <small class="howto"><?php esc_html_e( 'Specify post ids separated by comma if you want to select only those posts. i.e. 213,32,12,45 Note: you can also choose pages as well as custom post types', 'herald' ); ?></small>
	   </p>

	  <p>
	  	<?php $this->widget_tax( $this, 'category', $instance['category'] ); ?>
	  </p>

	  
	  <p>
		<input id="<?php echo esc_attr($this->get_field_id( 'auto_detect' )); ?>" type="checkbox" name="<?php echo esc_attr($this->get_field_name( 'auto_detect' )); ?>" value="1" <?php checked( 1, $instance['auto_detect'] ); ?>/>
		<label for="<?php echo esc_attr($this->get_field_id( 'auto_detect' )); ?>"><?php esc_html_e( 'Auto detect category', 'herald' ); ?></label>
		<small class="howto"><?php esc_html_e( 'If sidebar is used on single post template, display posts from current post category ', 'herald' ); ?></small>
	  </p>

	   <p>
	   	 <label for="<?php echo esc_attr($this->get_field_id( 'tag' )); ?>"><?php esc_html_e( 'Tagged with', 'herald' ); ?>:</label>
		 <input id="<?php echo esc_attr($this->get_field_id( 'tag' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'tag' )); ?>" value="<?php echo esc_attr(herald_get_tax_term_name_by_slug($instance['tag'])); ?>" class="widefat" />
		 <small class="howto"><?php esc_html_e( 'Specify one or more tags separated by comma. i.e. life, cooking, funny moments', 'herald' ); ?></small>
	   </p>

	   <p>
	  	 <?php $this->widget_format( $this, $instance['format'] ); ?>
	   </p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'time' )); ?>"><?php esc_html_e( 'Only select posts which are not older than', 'herald' ); ?>:</label>
		<select id="<?php echo esc_attr($this->get_field_id( 'time' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'time' )); ?>" class="widefat">
			<?php $time = herald_get_time_diff_opts(); ?>
			<?php foreach ( $time as $key => $value ): ?>
				<option value="<?php echo esc_attr($key); ?>" <?php selected( $instance['time'], $key, true ); ?>><?php echo $value;?></option>
			<?php endforeach; ?>
		</select>
	</p>	

	<?php
	}


	function widget_orderby( $widget_instance = false, $orderby = false ) {

		$orders = herald_get_post_order_opts();

		if ( !empty( $widget_instance ) ) { ?>
				<label for="<?php echo esc_attr($widget_instance->get_field_id( 'orderby' )); ?>"><?php esc_html_e( 'Order by:', 'herald' ); ?></label>
				<select id="<?php echo esc_attr($widget_instance->get_field_id( 'orderby' )); ?>" name="<?php echo esc_attr($widget_instance->get_field_name( 'orderby' )); ?>" class="widefat">
					<?php foreach ( $orders as $key => $order ) { ?>
						<option value="<?php echo esc_attr($key); ?>" <?php selected( $orderby, $key );?>><?php echo $order; ?></option>
					<?php } ?>
				</select>
		<?php }
	}

	function widget_format( $widget_instance = false, $format = false ) {

		$formats = herald_get_post_format_opts();

		if ( !empty( $widget_instance ) ) { ?>
				<label for="<?php echo esc_attr($widget_instance->get_field_id( 'format' )); ?>"><?php esc_html_e( 'Format:', 'herald' ); ?></label>
				<select id="<?php echo esc_attr($widget_instance->get_field_id( 'format' )); ?>" name="<?php echo esc_attr($widget_instance->get_field_name( 'format' )); ?>" class="widefat">
					<?php foreach ( $formats as $key => $name ) { ?>
						<option value="<?php echo esc_attr($key); ?>" <?php selected( $format, $key );?>><?php echo $name; ?></option>
					<?php } ?>
				</select>
		<?php }
	}

	function widget_tax( $widget_instance, $taxonomy, $selected_taxonomy = false ) {
		if ( !empty( $widget_instance ) && !empty( $taxonomy ) ) {
			$categories = get_terms( $taxonomy, 'orderby=name&hide_empty=0' );
?>
				<label for="<?php echo esc_attr($widget_instance->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Choose from:', 'herald' ); ?></label><br/>
					<?php foreach ( $categories as $category ) { ?>
						<input type="checkbox" name="<?php echo esc_attr($widget_instance->get_field_name( 'category' )); ?>[]" value="<?php echo esc_attr($category->term_id); ?>" <?php echo in_array( $category->term_id, (array)$selected_taxonomy ) ? 'checked': ''?> /> <?php echo $category->name; ?><br/>
					<?php } ?>
		<?php }
	}

	function widget_style( $widget_instance = false, $current = false ) {

		$styles = array(
			'g1' => esc_html__( 'List', 'herald' ),
			'f' => esc_html__( 'Big', 'herald' ),
			'f1' => esc_html__( 'Big (overlay)', 'herald' )
		);

		if ( !empty( $widget_instance ) ) { ?>
				<label for="<?php echo esc_attr($widget_instance->get_field_id( 'style' )); ?>"><?php esc_html_e( 'Widget style:', 'herald' ); ?></label>
				<select id="<?php echo esc_attr($widget_instance->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($widget_instance->get_field_name( 'style' )); ?>" class="widefat">
					<?php foreach ( $styles as $id => $title ) { ?>
						<option value="<?php echo esc_attr($id); ?>" <?php selected( $current, $id );?>><?php echo $title; ?></option>
					<?php } ?>
				</select>
		<?php }
	}

	function widget_meta( $widget_instance = false, $current = false ) {

		$meta = herald_get_meta_opts();

		if ( !empty( $widget_instance ) ) : ?>
				<label for="<?php echo esc_attr($widget_instance->get_field_id( 'meta' )); ?>"><?php esc_html_e( 'Display meta data:', 'herald' ); ?></label><br/>
				<?php foreach ( $meta as $id => $title ) : ?>
				<?php $checked = in_array($id, $current ) ? 'checked="checked"' : ''; ?>
				<input type="checkbox" id="<?php echo esc_attr($widget_instance->get_field_id( 'meta' )); ?>" name="<?php echo esc_attr($widget_instance->get_field_name( 'meta' )); ?>[]" value="<?php echo esc_attr($id); ?>" <?php echo $checked; ?>> <?php echo $title; ?><br/>
				<?php endforeach; ?>
		<?php endif; ?>
	<?php }

}

?>
