<?php

/**
 * Load post metaboxes
 * 
 * Callback function for post metaboxes load
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_load_post_metaboxes' ) ) :
	function herald_load_post_metaboxes() {

		/* Layout metabox */
		add_meta_box(
			'herald_layout',
			esc_html__( 'Post Layout', 'herald' ),
			'herald_layout_metabox',
			'post',
			'side',
			'default'
		);

		/* Sidebar metabox */
		add_meta_box(
			'herald_sidebar',
			esc_html__( 'Sidebar', 'herald' ),
			'herald_sidebar_metabox',
			'post',
			'side',
			'default'
		);

		/* Meta bar metabox */
		add_meta_box(
			'herald_meta_bar',
			esc_html__( 'Meta bar', 'herald' ),
			'herald_meta_bar_metabox',
			'post',
			'side',
			'default'
		);

		/* Display metabox */
		add_meta_box(
			'herald_display',
			esc_html__( 'Display', 'herald' ),
			'herald_display_metabox',
			'post',
			'side',
			'default'
		);

	}
endif;


/**
 * Save post meta
 * 
 * Callback function to save post meta data
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_save_post_metaboxes' ) ) :
	function herald_save_post_metaboxes( $post_id, $post ) {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['herald_post_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['herald_post_nonce'], __FILE__  ) )
				return;
		}


		if ( $post->post_type == 'post' && isset( $_POST['herald'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$herald_meta = array();

			if( isset( $_POST['herald']['use_sidebar'] ) &&  $_POST['herald']['use_sidebar'] != 'inherit' ){
				$herald_meta['use_sidebar'] = $_POST['herald']['use_sidebar'];
			}
			
			if( isset( $_POST['herald']['sidebar'] ) &&  $_POST['herald']['sidebar'] != 'inherit' ){
				$herald_meta['sidebar'] = $_POST['herald']['sidebar'];
			}

			if( isset( $_POST['herald']['sticky_sidebar'] ) &&  $_POST['herald']['sticky_sidebar'] != 'inherit' ){
				$herald_meta['sticky_sidebar'] = $_POST['herald']['sticky_sidebar'];
			}

			if( isset( $_POST['herald']['layout'] ) &&  $_POST['herald']['layout'] != 'inherit' ){
				$herald_meta['layout'] = $_POST['herald']['layout'];
			}

			if( isset( $_POST['herald']['meta_bar_position'] ) &&  $_POST['herald']['meta_bar_position'] != 'inherit' ){
				$herald_meta['meta_bar_position'] = $_POST['herald']['meta_bar_position'];
			}


			$display = array('fimg' ,'headline' ,'tags'	,'author' ,'sticky_bar' ,'related', 'ad_above', 'ad_below');
			foreach($display as $key){
				if( isset( $_POST['herald']['display'][$key] ) &&  $_POST['herald']['display'][$key] != 'inherit' ){
					$herald_meta['display'][$key] = $_POST['herald']['display'][$key];
				}
			}
		
			
			if(!empty($herald_meta)){
				update_post_meta( $post_id, '_herald_meta', $herald_meta );
			} else {
				delete_post_meta( $post_id, '_herald_meta');
			}

		}
	}
endif;


/**
 * Layout metabox
 * 
 * Callback function to create layout metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_layout_metabox' ) ) :
	function herald_layout_metabox( $object, $box ) {
		
		$herald_meta = herald_get_post_meta( $object->ID );
		$layouts = herald_get_single_layouts( true );
?>
	  	<ul class="herald-img-select-wrap">
	  	<?php foreach ( $layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $herald_meta['layout'] ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $herald_meta['layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php esc_html_e( 'Choose a layout', 'herald' ); ?></p>

	  <?php
	}
endif;



/**
 * Sidebar metabox
 * 
 * Callback function to create sidebar metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_sidebar_metabox' ) ) :
	function herald_sidebar_metabox( $object, $box ) {
		
		if($object->post_type == 'post'){
			$herald_meta = herald_get_post_meta( $object->ID );
		} else {
			$herald_meta = herald_get_page_meta( $object->ID );
		}
		
		$sidebars_lay = herald_get_sidebar_layouts( true );
		$sidebars = herald_get_sidebars_list( true );
?>
	  	<ul class="herald-img-select-wrap">
	  	<?php foreach ( $sidebars_lay as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $herald_meta['use_sidebar'] ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[use_sidebar]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $herald_meta['use_sidebar'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php esc_html_e( 'Display sidebar', 'herald' ); ?></p>

	  <?php if ( !empty( $sidebars ) ): ?>

	  	<p><select name="herald[sidebar]" class="widefat">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $herald_meta['sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select></p>
	  <p class="description"><?php esc_html_e( 'Choose standard sidebar to display', 'herald' ); ?></p>

	  	<p><select name="herald[sticky_sidebar]" class="widefat">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $herald_meta['sticky_sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select></p>
	  <p class="description"><?php esc_html_e( 'Choose sticky sidebar to display', 'herald' ); ?></p>

	  <?php endif; ?>
	  <?php
	}
endif;

/**
 * Meta bar metabox
 * 
 * Callback function to create meta bar metabox
 * 
 * @since  1.3
 */

if ( !function_exists( 'herald_meta_bar_metabox' ) ) :
	function herald_meta_bar_metabox( $object, $box ) {
		
		$herald_meta = herald_get_post_meta( $object->ID );
		$layouts = herald_get_meta_bar_layouts( true );
?>
	  	<ul class="herald-img-select-wrap">
	  	<?php foreach ( $layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $herald_meta['meta_bar_position'] ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[meta_bar_position]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $herald_meta['meta_bar_position'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php esc_html_e( 'Choose meta bar layout', 'herald' ); ?></p>

	  <?php
	}
endif;

/**
 * Display options metabox
 * 
 * Callback function to create display ptions metabox
 * 
 * @since  1.3
 */

if ( !function_exists( 'herald_display_metabox' ) ) :
	function herald_display_metabox( $object, $box ) {
		
		$herald_meta = herald_get_post_meta( $object->ID );
		
		$meta = $herald_meta['display'];

		$options = array(
					'fimg' => esc_html( 'Featured Image', 'herald'),
					'headline' => esc_html( 'Headline (excerpt)', 'herald'),
					'tags'	=> esc_html( 'Tags', 'herald'),
					'author' => esc_html( 'Author Area', 'herald'),
					'sticky_bar' => esc_html( 'Sticky Bottom Bar', 'herald'),
					'related' => esc_html( 'Related posts', 'herald'),
					'ad_above' => esc_html( 'Ad above content', 'herald'),
					'ad_below' => esc_html( 'Ad below content', 'herald'),
			);

		$values = array(
			'inherit' => esc_html( 'Inherit', 'herald'),
			1 => esc_html( 'On', 'herald'),
			0 => esc_html( 'Off', 'herald'),
			);

		foreach($options as $id => $option): ?>
		
			<p><label><?php echo $option; ?>:</label> <select name="herald[display][<?php echo esc_attr($id); ?>]" class="alignright">
				<?php foreach($values as $value => $title): ?>
					<?php if( in_array( $id, array( 'ad_below', 'ad_above' ) ) && $value === 'inherit') { 
						continue;
					} ?>
					<option value="<?php echo esc_attr($value); ?>" <?php selected($meta[$id], $value); ?>><?php echo $title; ?></option>
				<?php endforeach; ?>
			</select></p>

		<?php endforeach; ?>	  

	   <p class="description"><?php esc_html_e( 'Optionally override global display options for single posts', 'herald' ); ?></p>

	  <?php
	}
endif;
?>