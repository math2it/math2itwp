<?php 

add_action( 'category_add_form_fields', 'herald_category_add_meta_fields', 10, 2 );

/**
 * Add category meta 
 * 
 * Callback function to load category meta fields on "new category" screen
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_category_add_meta_fields' ) ) :
	function herald_category_add_meta_fields() {
		$meta = herald_get_category_meta();
		$options = herald_get_category_meta_options();
		extract($options);
?>

	 
	 <div class="form-field">
	  	<label><?php esc_html_e( 'Featured area', 'herald' ); ?></label>
	  	<ul class="herald-img-select-wrap">
	  	<?php foreach ( $fa_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['fa_layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[fa_layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['fa_layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php esc_html_e( 'Choose a featured posts layout for this category', 'herald' ); ?></p>
	 </div>

	 <div class="form-field">
	  	<label><?php esc_html_e( 'Main layout', 'herald' ); ?></label>
	  	<ul class="herald-img-select-wrap herald-next-hide">
	  	<?php foreach ( $post_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php esc_html_e( 'Choose main layout for this category', 'herald' ); ?></p>
	 </div>

	 <?php $style = $meta['layout'] == 'inherit' ? 'display:none;' : ''; ?>
	 <div class="form-field" style="<?php echo esc_attr($style); ?>">
		    <label>
		    	<?php esc_html_e( 'Posts per page', 'herald' ); ?>
		   	</label>
			<input type="radio" name="herald[ppp]" value="inherit" <?php checked( $meta['ppp'], 'inherit' );?> class="herald-next-hide"> <?php esc_html_e( 'Inherit from global category settings', 'herald' ); ?><br/>
			<input type="radio" name="herald[ppp]" value="custom" <?php checked( $meta['ppp'], 'custom' );?> class="herald-next-hide"> <?php esc_html_e( 'Set custom number', 'herald' ); ?>
			<p class="description"><?php esc_html_e( 'Choose how many posts per page you want to display', 'herald' ); ?></p>
	 </div>

	 <?php $style = $meta['ppp'] == 'inherit' ? 'display:none;' : ''; ?>
	  <div class="form-field" style="<?php echo esc_attr($style); ?>">
	  		<label>
	  			<?php esc_html_e( 'Number of posts per page', 'herald' ); ?>
	  		</label>
			<input type="text" name="herald[ppp_num]" value="<?php echo esc_attr($meta['ppp_num']); ?>" style="width: 50px; "/> <?php esc_html_e( 'posts', 'herald' ); ?><br/>
	  </div>

	 <?php $style = $meta['layout'] == 'inherit' ? 'display:none;' : ''; ?>
	  <div class="form-field" style="<?php echo esc_attr($style); ?>">
	  		<label><?php esc_html_e( 'Number of posts per page', 'herald' ); ?></label>
		  	<input type="text" name="herald[ppp]" value="<?php echo esc_attr($meta['ppp']); ?>" style="width: 50px; "/> <?php esc_html_e( 'posts', 'herald' ); ?><br/>
		  	<small  class="description"><?php esc_html_e( 'Note: leave empty if you want to inherit from global category option', 'herald' ); ?></small>
	  </div>

	 <div class="form-field">
	  	<label><?php esc_html_e( 'Starter layout', 'herald' ); ?></label>
	  	<ul class="herald-img-select-wrap herald-next-hide">
	  	<?php foreach ( $starter_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['starter_layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[starter_layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['starter_layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php esc_html_e( 'Choose starter layout for this category', 'herald' ); ?></p>
	 </div>

	 <?php $style = $meta['starter_layout'] == 'inherit' ? 'display:none;' : ''; ?>
	 <div class="form-field" style="<?php echo esc_attr($style); ?>">
	  	<label><?php esc_html_e( 'Number of starter posts', 'herald' ); ?></label>
	  	<input type="text" style="width: 50px;" name="herald[starter_limit]" value="<?php echo esc_attr( $meta['starter_limit']); ?>"/>
	    <p class="description"><?php esc_html_e( 'Choose number of post to display in starter layout', 'herald' ); ?></p>
	 </div>

	 <div class="form-field">
	  	<label><?php esc_html_e( 'Display sidebar', 'herald' ); ?></label>
	  	<ul class="herald-img-select-wrap">
	  	<?php foreach ( $sidebars_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['use_sidebar'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[use_sidebar]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['use_sidebar'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>
	   <p class="description"><?php esc_html_e( 'Choose sidebar layout', 'herald' ); ?></p>
	 </div>

	  <?php if ( !empty( $sidebars ) ): ?>
	  <div class="form-field">
	  <label><?php esc_html_e( 'Standard sidebar', 'herald' ); ?></label>
	  	<select name="herald[sidebar]">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $meta['sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select>
	  <p class="description"><?php esc_html_e( 'Choose standard sidebar to display', 'herald' ); ?></p>
	  </div>
	  <div class="form-field">
	  <label><?php esc_html_e( 'Sticky sidebar', 'herald' ); ?></label>
	  <select name="herald[sticky_sidebar]">
	  	<?php foreach ( $sidebars as $id => $name ): ?>
	  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $meta['sticky_sidebar'] );?>><?php echo $name; ?></option>
	  	<?php endforeach; ?>
	  </select>
	   <p class="description"><?php esc_html_e( 'Choose sticky sidebar to display', 'herald' ); ?></p>
	   </div>
	  <?php endif; ?>

	  <div class="form-field">
	  	<label><?php esc_html_e( 'Pagination', 'herald' ); ?></label>
		  	<ul class="herald-img-select-wrap">
	  		<?php foreach ( $pag_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['pag'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[pag]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['pag'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   		</ul>
		   	<p class="description"><?php esc_html_e( 'Choose pagination type', 'herald' ); ?></p>
	  </div>

	  <div class="form-field">
		<label><?php esc_html_e( 'Color', 'herald' ); ?></label>
			<input type="radio" name="herald[color_type]" value="inherit" class="herald-radio color-type" <?php checked( $meta['color_type'], 'inherit' );?>> <?php esc_html_e( 'Inherit from accent color', 'herald' ); ?><br/>
			<input type="radio" name="herald[color_type]" value="custom" class="herald-radio color-type" <?php checked( $meta['color_type'], 'custom' );?>> <?php esc_html_e( 'Set custom color', 'herald' ); ?>
			  <div id="herald-color-wrap">
			  <p>
			   	<input name="herald[color]" type="text" class="herald-colorpicker" value="<?php echo esc_attr($meta['color']); ?>" data-default-color="<?php echo esc_attr($meta['color']); ?>"/>
			  </p>
			  <?php $recent_colors = get_option( 'herald_recent_cat_colors' ); ?>
			  <?php if(!empty($recent_colors)) : ?>
			  <p><?php esc_html_e( 'Recently used', 'herald' ); ?>:<br/>
			 <?php foreach($recent_colors as $color) : ?>
			  	<a href="javascript:void(0)" style="background: <?php echo esc_attr($color); ?>;" class="herald-rec-color" data-color="<?php echo esc_attr($color); ?>"></a>
			  <?php endforeach; ?>
			  </p>
			  <?php endif; ?>
			</div><br/>
				<p class="description"><?php esc_html_e( 'Choose a color', 'herald' ); ?></p>
		</div>

		<div class="form-field">
			<label><?php esc_html_e( 'Image', 'herald' ); ?></label>
			<?php $display = $meta['image'] ? 'initial' : 'none'; ?>
			<p>
				<img id="herald-image-preview" src="<?php echo esc_url( $meta['image'] ); ?>" style="width: 300px;  border: 2px solid #ebebeb; display:<?php echo esc_attr( $display ); ?>;">
			</p>

			<p>
				<input type="hidden" name="herald[image]" id="herald-image-url" value="<?php echo esc_attr( $meta['image'] ); ?>"/>
				<input type="button" id="herald-image-upload" class="button-secondary" value="<?php esc_attr_e( 'Upload', 'herald' ); ?>"/>
				<input type="button" id="herald-image-clear" class="button-secondary" value="<?php esc_attr_e( 'Clear', 'herald' ); ?>" style="display:<?php echo esc_attr( $display ); ?>"/>
			</p>

			<p class="description"><?php esc_html_e( 'Upload an image for this category', 'herald' ); ?></p>
		</div>

	<?php
	}
endif;


add_action( 'category_edit_form_fields', 'herald_category_edit_meta_fields', 10, 2 );

/**
 * Edit category meta 
 * 
 * Callback function to load category meta fields on edit screen
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_category_edit_meta_fields' ) ) :
	function herald_category_edit_meta_fields( $term ) {
		$meta = herald_get_category_meta( $term->term_id );
		$options = herald_get_category_meta_options();
		extract($options);
?>
	  
	  <tr class="form-field">
	  	<th scope="row" valign="top">
	  		<?php esc_html_e( 'Featured area', 'herald' ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="herald-img-select-wrap">
		  	<?php foreach ( $fa_layouts as $id => $layout ): ?>
		  		<li>
		  			<?php $selected_class = herald_compare( $meta['fa_layout'], $id ) ? ' selected': ''; ?>
		  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
		  			<span><?php echo $layout['title']; ?></span>
		  			<input type="radio" class="herald-hidden" name="herald[fa_layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['fa_layout'] );?>/> </label>
		  		</li>
		  	<?php endforeach; ?>
		   </ul>
		   <p class="description"><?php esc_html_e( 'Choose a featured posts layout for this category', 'herald' ); ?></p>
		</td>
	 </tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php esc_html_e( 'Posts main layout', 'herald' ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="herald-img-select-wrap herald-next-hide">
	  		<?php foreach ( $post_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['layout'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['layout'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   		</ul>
		   	<p class="description"><?php esc_html_e( 'Choose posts layout for this category', 'herald' ); ?></p>
	 	</td>
	  </tr>

	   <?php $style = $meta['layout'] == 'inherit' ? 'display:none;' : ''; ?>
	 <tr class="form-field" style="<?php echo esc_attr($style); ?>">
		    <th>
		    	<?php esc_html_e( 'Posts per page', 'herald' ); ?>
		   	</th>
		   	<td>
				<input type="radio" name="herald[ppp]" value="inherit" <?php checked( $meta['ppp'], 'inherit' );?> class="herald-next-hide"> <?php esc_html_e( 'Inherit from global category settings', 'herald' ); ?><br/>
				<input type="radio" name="herald[ppp]" value="custom" <?php checked( $meta['ppp'], 'custom' );?>  class="herald-next-hide"> <?php esc_html_e( 'Set custom number', 'herald' ); ?>
				<p class="description"><?php esc_html_e( 'Choose how many posts per page you want to display', 'herald' ); ?></p>
			</td>
	 </tr>

	 <?php $style = $meta['ppp'] == 'inherit' ? 'display:none;' : ''; ?>
	  <tr class="form-field" style="<?php echo esc_attr($style); ?>">
	  		<th>
	  			<?php esc_html_e( 'Number of posts per page', 'herald' ); ?>
	  		</th>
	  		<td>
				<input type="text" name="herald[ppp_num]" value="<?php echo esc_attr($meta['ppp_num']); ?>" style="width: 50px; "/> <?php esc_html_e( 'posts', 'herald' ); ?><br/>
			</td>
	  </tr>
	 

	  <tr class="form-field">
	  	<th scope="row" valign="top">
	  		<label><?php esc_html_e( 'Starter layout', 'herald' ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="herald-img-select-wrap herald-next-hide"> 
		  	<?php foreach ( $starter_layouts as $id => $layout ): ?>
		  		<li>
		  			<?php $selected_class = herald_compare( $meta['starter_layout'], $id ) ? ' selected': ''; ?>
		  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
		  			<span><?php echo $layout['title']; ?></span>
		  			<input type="radio" class="herald-hidden" name="herald[starter_layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['starter_layout'] );?>/> </label>
		  		</li>
		  	<?php endforeach; ?>
		   </ul>
		   <p class="description"><?php esc_html_e( 'Choose starter layout for this category', 'herald' ); ?></p>
		</td>
	 </tr>

	 <?php $style = $meta['starter_layout'] == 'inherit' ? 'display:none;' : ''; ?>
	 <tr class="form-field" style="<?php echo esc_attr($style); ?>">
	 	<th scope="row" valign="top">
	  		<label><?php esc_html_e( 'Number of starter posts', 'herald' ); ?></label>
	  	</th>
	  	<td>
	  		<input type="text" style="width: 50px;" name="herald[starter_limit]" value="<?php echo esc_attr( $meta['starter_limit']); ?>"/>
	    	<p class="description"><?php esc_html_e( 'Choose number of post to display in starter layout', 'herald' ); ?></p>
	    </td>
	 </tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php esc_html_e( 'Display sidebar', 'herald' ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="herald-img-select-wrap">
	  		<?php foreach ( $sidebars_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['use_sidebar'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[use_sidebar]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['use_sidebar'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   </ul>
		   	<p class="description"><?php esc_html_e( 'Choose sidebar layout', 'herald' ); ?></p>
	 	</td>
	  </tr>

	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php esc_html_e( 'Standard sidebar', 'herald' ); ?></label>
	  	</th>
	  	<td>
			<select name="herald[sidebar]">
			<?php foreach ( $sidebars as $id => $name ): ?>
				<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $meta['sidebar'] );?>><?php echo $name; ?></option>
			<?php endforeach; ?>
			</select>
			<p class="description"><?php esc_html_e( 'Choose standard sidebar to display', 'herald' ); ?></p>
	  	</td>
	  </tr>
	  <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php esc_html_e( 'Sticky sidebar', 'herald' ); ?></label>
	  	</th>
	  	<td>
		  	<select name="herald[sticky_sidebar]">
		  	<?php foreach ( $sidebars as $id => $name ): ?>
		  		<option value="<?php echo esc_attr($id); ?>" <?php selected( $id, $meta['sticky_sidebar'] );?>><?php echo $name; ?></option>
		  	<?php endforeach; ?>
		  	</select>
		    <p class="description"><?php esc_html_e( 'Choose sticky sidebar to display', 'herald' ); ?></p>
	   </td>
	 </tr>

	 <tr class="form-field">
		<th scope="row" valign="top">
	  		<label><?php esc_html_e( 'Pagination', 'herald' ); ?></label>
	  	</th>
	  	<td>
		  	<ul class="herald-img-select-wrap">
	  		<?php foreach ( $pag_layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = herald_compare( $meta['pag'], $id ) ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[pag]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['pag'] );?>/> </label>
	  		</li>
	  		<?php endforeach; ?>
	   		</ul>
		   	<p class="description"><?php esc_html_e( 'Choose pagination type', 'herald' ); ?></p>
	 	</td>
	  </tr>

	 <tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Color', 'herald' ); ?></label></th>
			<td>
				<label><input type="radio" name="herald[color_type]" value="inherit" class="herald-radio color-type" <?php checked( $meta['color_type'], 'inherit' );?>> <?php esc_html_e( 'Inherit from accent color', 'herald' ); ?></label> <br/>
				<label><input type="radio" name="herald[color_type]" value="custom" class="herald-radio color-type" <?php checked( $meta['color_type'], 'custom' );?>> <?php esc_html_e( 'Set custom color', 'herald' ); ?></label>
			  	<div id="herald-color-wrap">
			  	<p>
			    	<input name="herald[color]" type="text" class="herald-colorpicker" value="<?php echo esc_attr($meta['color']); ?>" data-default-color="<?php echo esc_attr($meta['color']); ?>"/>
			 	 </p>

			 	 <?php $recent_colors = get_option( 'herald_recent_cat_colors' ); ?>
			 	 <?php if(!empty($recent_colors)) : ?>
			 	 <p class="description"><?php esc_html_e( 'Recently used', 'herald' ); ?>:<br/>
			 	 <?php foreach($recent_colors as $color) : ?>
			 	 	<a href="javascript:void(0)" style="background: <?php echo esc_attr($color); ?>;" class="herald-rec-color" data-color="<?php echo esc_attr($color); ?>"></a>
			 	 <?php endforeach; ?>
			 	 </p>

			 	 <?php endif; ?>
				</div>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label><?php esc_html_e( 'Image', 'herald' ); ?></label></th>
			<?php $display = $meta['image'] ? 'initial' : 'none'; ?>
			<td>
			<p>
				<img id="herald-image-preview" src="<?php echo esc_url( $meta['image'] ); ?>" style="width: 300px;  border: 2px solid #ebebeb; display:<?php echo esc_attr( $display ); ?>;">
			</p>

			<p>
				<input type="hidden" name="herald[image]" id="herald-image-url" value="<?php echo esc_attr( $meta['image'] ); ?>"/>
				<input type="button" id="herald-image-upload" class="button-secondary" value="<?php esc_attr_e( 'Upload', 'herald' ); ?>"/>
				<input type="button" id="herald-image-clear" class="button-secondary" value="<?php esc_attr_e( 'Clear', 'herald' ); ?>" style="display:<?php echo esc_attr( $display ); ?>"/>
			</p>

			<p class="description"><?php esc_html_e( 'Upload an image for this category', 'herald' ); ?></p>
			</td>
		</tr>		

	<?php
	}
endif;


add_action( 'edited_category', 'herald_save_category_meta_fields', 10, 2 );
add_action( 'create_category', 'herald_save_category_meta_fields', 10, 2 );

/**
 * Save category meta 
 * 
 * Callback function to save category meta data
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_save_category_meta_fields' ) ) :
	function herald_save_category_meta_fields( $term_id ) {

		if ( isset( $_POST['herald'] ) ) {

			$meta = array();

			if( isset( $_POST['herald']['layout'] ) && $_POST['herald']['layout'] != 'inherit' ){
				$meta['layout'] = $_POST['herald']['layout'];
			}

			if( isset( $_POST['herald']['starter_layout'] ) && $_POST['herald']['starter_layout'] != 'inherit' ){
				$meta['starter_layout'] = $_POST['herald']['starter_layout'];
				$meta['starter_limit'] = absint($_POST['herald']['starter_limit']);
			}

			if( isset( $_POST['herald']['fa_layout'] ) && $_POST['herald']['fa_layout'] != 'inherit' ){
				$meta['fa_layout'] = $_POST['herald']['fa_layout'];
			}

			if( isset( $_POST['herald']['use_sidebar'] ) && $_POST['herald']['use_sidebar'] != 'inherit' ){
				$meta['use_sidebar'] = $_POST['herald']['use_sidebar'];
			}

			if( isset( $_POST['herald']['sidebar'] ) && $_POST['herald']['sidebar'] != 'inherit' ){
				$meta['sidebar'] = $_POST['herald']['sidebar'];
			}

			if( isset( $_POST['herald']['sticky_sidebar'] ) && $_POST['herald']['sticky_sidebar'] != 'inherit' ){
				$meta['sticky_sidebar'] = $_POST['herald']['sticky_sidebar'];
			}

			if( isset( $_POST['herald']['pag'] ) && $_POST['herald']['pag'] != 'inherit' ){
				$meta['pag'] = $_POST['herald']['pag'];
			}

			if( isset( $_POST['herald']['ppp'] ) && $_POST['herald']['ppp'] != 'inherit'){
				$meta['ppp'] = $_POST['herald']['ppp'];
				$meta['ppp_num'] = absint($_POST['herald']['ppp_num']);
			}

			if( isset( $_POST['herald']['color_type'] ) ) { 
				if( $_POST['herald']['color_type'] != 'inherit' ){
					$meta['color_type'] = $_POST['herald']['color_type'];
					$meta['color'] = $_POST['herald']['color'];
				}

				herald_update_cat_colors( $term_id, $_POST['herald']['color'], $_POST['herald']['color_type'] );
			}

			if ( isset( $_POST['herald']['image'] ) ) {
				$meta['image'] = $_POST['herald']['image'];
			}
			

			if(!empty($meta)){
				update_option( '_herald_category_'.$term_id, $meta );
			} else {
				delete_option( '_herald_category_'.$term_id );
			}
			
		}

	}
endif;

/**
 * Update category colors 
 * 
 * Function checks for category color and updates two fields
 * in options table. One for list of category colors and second
 * for recently picked colors.
 * 
 * @param   int $cat_id
 * @param   string $color Hexadecimal color value
 * @param   string $type inherit|custom
 * @return  void 
 * @since  1.0
 */
if ( !function_exists( 'herald_update_cat_colors' ) ):
	function herald_update_cat_colors( $cat_id, $color, $type ) {

		/* Update category color */
		
		$colors = get_option( 'herald_cat_colors' );

		if(empty($colors)) {
			$colors = array();
		}

		if ( array_key_exists( $cat_id, $colors ) ) {

			if ( $type == 'inherit' ) {
				unset( $colors[$cat_id] );
			} elseif ( $colors[$cat_id] != $color ) {
				$colors[$cat_id] = $color;
			}

		} else {

			if ( $type != 'inherit' ) {
				$colors[$cat_id] = $color;
			}
		}

		update_option( 'herald_cat_colors', $colors );


		/* Store recent category colors */
		if ( $type != 'inherit' ) {

			$num_col = 10;
			$current = get_option( 'herald_recent_cat_colors' );
			if(empty($current)) {
				$current = array();
			}
			$update = false;

			if ( !in_array( $color, $current ) ) {
				$current[] = $color;
				if ( count( $current ) > $num_col ) {
					$current = array_slice( $current, ( count( $current ) - $num_col ), ( count( $current ) - 1 ) );
				}
				$update = true;
			}

			if ( $update ) {
				update_option( 'herald_recent_cat_colors', $current );
			}
		
		}

	}
endif;


add_action( 'delete_category', 'herald_delete_category_meta' );

/**
 * Delete category meta 
 * 
 * Delete our custom category meta from database on category deletion
 * 
 * @return  void 
 * @since  1.0
 */

if ( !function_exists( 'herald_delete_category_meta' ) ):
	function herald_delete_category_meta( $term_id ) {
		
		//Delete category meta
		delete_option( '_herald_category_'.$term_id );

		//Check for category colors deletion
		$colors = get_option( 'herald_cat_colors' );

		if ( !empty($colors) && array_key_exists( $term_id, $colors ) ) {
				unset( $colors[$term_id] );
				update_option( 'herald_cat_colors', $colors );
		}
	}	
endif;

/**
 * Get category meta options
 *
 * @return array Options of our category meta data
 * @since  1.0
 */

if ( !function_exists( 'herald_get_category_meta_options' ) ):
	function herald_get_category_meta_options() {
		$options = array(
			'sidebars_layouts' => herald_get_sidebar_layouts( true ),
			'sidebars' => herald_get_sidebars_list( true ),
			'post_layouts' => herald_get_main_layouts( true, false ),
			'starter_layouts' => herald_get_main_layouts( true, true ),
			'fa_layouts' => herald_get_featured_layouts( true, true ),
			'pag_layouts' => herald_get_pagination_layouts( true )
		);
		return $options;
	}
endif;

?>