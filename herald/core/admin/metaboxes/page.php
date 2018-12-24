<?php 

/**
 * Load page metaboxes
 * 
 * Callback function for page metaboxes load
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_load_page_metaboxes' ) ) :
	function herald_load_page_metaboxes() {
		
		/* Layout metabox */
		add_meta_box(
			'herald_page_layout',
			esc_html__( 'Page Layout', 'herald' ),
			'herald_page_layout_metabox',
			'page',
			'side',
			'default'
		);

		/* Sidebar metabox */
		add_meta_box(
			'herald_sidebar',
			esc_html__( 'Sidebar', 'herald' ),
			'herald_sidebar_metabox',
			'page',
			'side',
			'default'
		);

		/* Authors template metabox */
		add_meta_box(
			'herald_author_options',
			esc_html__('Authors', 'herald'),
			'herald_author_options_metabox',
			'page',
			'side',
			'default'
		) ;

		/* Modules metabox */
		add_meta_box(
			'herald_modules',
			esc_html__( 'Modules', 'herald' ),
			'herald_modules_metabox',
			'page',
			'normal',
			'high'
		);

		/* Pagination metabox */
		add_meta_box(
			'herald_pagination',
			esc_html__( 'Pagination', 'herald' ),
			'herald_pagination_metabox',
			'page',
			'normal',
			'high'
		);

	}
endif;


/**
 * Save page meta
 * 
 * Callback function to save page meta data
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_save_page_metaboxes' ) ) :
	function herald_save_page_metaboxes( $post_id, $post ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		if ( isset( $_POST['herald_page_nonce'] ) ) {
			if ( !wp_verify_nonce( $_POST['herald_page_nonce'], __FILE__  ) )
				return;
		}

		if ( $post->post_type == 'page' && isset( $_POST['herald'] ) ) {
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

			if( isset( $_POST['herald']['pag'] ) &&  $_POST['herald']['pag'] != 'none' ){
				$herald_meta['pag'] = $_POST['herald']['pag'];
			}

			if ( isset( $_POST['herald']['sections'] ) ) {
				$herald_meta['sections'] = array_values( $_POST['herald']['sections'] );
				foreach($herald_meta['sections'] as $i => $section ){
					if(!empty($section['modules'])){
						foreach( $section['modules'] as $j => $module ){
							if ( isset( $module['manual'] ) && !empty( $module['manual'] ) ) {
								$section['modules'][$j]['manual'] = array_map( 'absint', explode( ",", $module['manual'] ) );
							}
							
							if ( isset( $module['author'] ) && !empty( $module['author'] ) ) {
								
								$section['modules'][$j]['author'] =  herald_get_authors_id_by_username($module['author']);
							}

							if( !empty( $module['exclude_by_id'] ) ){
								$section['modules'][$j]['exclude_by_id'] = array_map('absint', explode(',', $module['exclude_by_id']));
							}
							
                            if ( isset( $module['tag'] ) && !empty( $module['tag'] ) ) {
                                $tax = $module['type'] == 'woocommerce' ? 'product_tag' : 'post_tag';
                                $section['modules'][$j]['tag'] = herald_get_tax_term_slug_by_name( $module['tag'], $tax);
                            }
                            
                            if( !empty( $module['tax'] ) ) {
                                
                                $taxonomies = array();
                                foreach( $module['tax'] as $k => $tax ){
                                    
                                    if(!empty($tax)){
                                        
                                        if( is_array($tax) ){
                                            $taxonomies[$k] = $tax;
                                        } else {
                                            $taxonomies[$k] = herald_get_tax_term_id_by_name( $tax, $k);
                                            
                                        }
                                    }
                                    
                                }
                                $section['modules'][$j]['tax'] =  $taxonomies;
                            }
						}

						$herald_meta['sections'][$i]['modules'] = array_values($section['modules']);
					}
				}
			}

			if ( isset( $_POST['herald']['authors'] ) ) {
				$herald_meta['authors']['orderby'] = !empty( $_POST['herald']['authors']['orderby'] ) ? $_POST['herald']['authors']['orderby'] : 0;
				$herald_meta['authors']['order'] = !empty( $_POST['herald']['authors']['order'] ) ? $_POST['herald']['authors']['order'] : 'DESC';
				$herald_meta['authors']['exclude'] = !empty( $_POST['herald']['authors']['exclude'] ) ? array_map('absint', explode(',', $_POST['herald']['authors']['exclude'])) : '';
				$herald_meta['authors']['roles'] = !empty( $_POST['herald']['authors']['roles'] ) ? $_POST['herald']['authors']['roles'] : array();
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

if ( !function_exists( 'herald_page_layout_metabox' ) ) :
	function herald_page_layout_metabox( $object, $box ) {
		
		$meta = herald_get_page_meta( $object->ID );
		$layouts = herald_get_page_layouts( true );
?>
	  	<ul class="herald-img-select-wrap">
	  	<?php foreach ( $layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $meta['layout'] ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['layout'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php esc_html_e( 'Choose a layout', 'herald' ); ?></p>

	  <?php
	}
endif;


/**
 * Pagination metabox
 * 
 * Callback function to create pagination metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_pagination_metabox' ) ) :
	function herald_pagination_metabox( $object, $box ) {
		
		$meta = herald_get_page_meta( $object->ID );
		$layouts = herald_get_pagination_layouts( false, true );
?>
	  	<ul class="herald-img-select-wrap">
	  	<?php foreach ( $layouts as $id => $layout ): ?>
	  		<li>
	  			<?php $selected_class = $id == $meta['pag'] ? ' selected': ''; ?>
	  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
	  			<span><?php echo $layout['title']; ?></span>
	  			<input type="radio" class="herald-hidden" name="herald[pag]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['pag'] );?>/> </label>
	  		</li>
	  	<?php endforeach; ?>
	   </ul>

	   <p class="description"><?php esc_html_e( 'Note: Pagination will be applied to the last post module on the page', 'herald' ); ?></p>

	  <?php
	}
endif;

/**
 * Module generator metabox
 * 
 * Callback function to create modules metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_modules_metabox' ) ) :
	function herald_modules_metabox( $object, $box ) {

		$meta = herald_get_page_meta( $object->ID );

		//print_r($meta);
	
		$default = array(
			'modules' => array(),
			'use_sidebar' => 'right',
			'sidebar' => 'herald_default_sidebar',
			'sticky_sidebar' => 'herald_default_sticky_sidebar',
			'css_class' => ''
		);

		$module_defaults = herald_get_module_defaults();

		
		$options = array(
			'use_sidebar' => herald_get_sidebar_layouts(),
			'sidebars' => herald_get_sidebars_list(),
			'module_options' => herald_get_module_options()
		);	

?>
		
		<div id="herald-sections">
			<?php if(!empty($meta['sections'])) : ?>
				<?php foreach($meta['sections'] as $i => $section) : $section = herald_parse_args( $section, $default ); ?>
					<?php herald_generate_section( $section, $options, $i ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		
		<p><a href="javascript:void(0);" class="herald-add-section button-primary"><?php esc_html_e( 'Create new section', 'herald' ); ?></a></p>
		
		<div id="herald-section-clone">
			<?php herald_generate_section( $default, $options ); ?>
		</div>

		<div id="herald-module-clone">
			<?php foreach( $module_defaults as $type => $module ): ?>
				<div class="<?php echo esc_attr($type); ?>">
					<?php herald_generate_module( $module, $options['module_options'][$type]); ?>
				</div>
			<?php endforeach; ?>
		</div>

		<div id="herald-sections-count" data-count="<?php echo count($meta['sections']); ?>"></div>
				  	
	<?php
	}
endif;


/**
 * Generate section
 * 
 * Generate section field inside modules generator
 * 
 * @param   $section Data array for current section
 * @param   $options An array of section options
 * @param   $i id of a current section, if false then create an empty section
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_section' ) ) :
	function herald_generate_section( $section, $options, $i = false ) {
		extract( $options );
		$name_prefix = ( $i === false ) ? '' :  'herald[sections]['.$i.']';
		$edit = ( $i === false ) ? '' :  'edit';
		$section_class = ( $i === false ) ? '' :  'herald-section-'.$i;
		$section_num = ( $i === false ) ? '' : $i ;
		//print_r($section);
		?>
		<div class="herald-section <?php echo esc_attr($section_class); ?>" data-section="<?php echo esc_attr($section_num); ?>">
			
			<div class="herald-modules">
				<?php if(!empty( $section['modules'] ) ): ?>
					<?php foreach($section['modules'] as $j => $module ) : $module = herald_parse_args( $module, herald_get_module_defaults( $module['type'] ) ); ?>
						<?php herald_generate_module( $module, $module_options[$module['type']], $i, $j ); ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
			<div class="herald-modules-count" data-count="<?php echo esc_attr(count($section['modules'])); ?>"></div>


			<div class="section-bottom">
				<div class="left">
					<?php $module_data = herald_get_module_defaults(); ?>
					<?php foreach( $module_data as $key => $mod ) : ?>
						<a href="javascript:void(0);" class="herald-add-module button-secondary" data-type="<?php echo esc_attr($mod['type']); ?>"><?php echo '+ '.$mod['type_name']. ' ' .esc_html__( 'Module', 'herald'); ?></a>
					<?php endforeach; ?>
				</div>
				<div class="right">
					<span><?php esc_html_e( 'Sidebar', 'herald' ); ?> (<span class="herald-sidebar"><?php echo $section['use_sidebar']; ?></span>)</span>
					<a href="javascript:void(0);" class="herald-edit-section button-secondary"><?php esc_html_e( 'Edit', 'herald' ); ?></a>
					<a href="javascript:void(0);" class="herald-remove-section button-secondary"><?php esc_html_e( 'Remove', 'herald' ); ?></a>
				</div>
			</div>

			
			<div class="herald-section-form <?php echo esc_attr($edit); ?>">

				<div class="herald-opt">
					<div class="herald-opt-title">
						<?php esc_html_e( 'Display sidebar', 'herald' ); ?>:
					</div>
				    <div class="herald-opt-content">
					    <ul class="herald-img-select-wrap">
					  	<?php foreach ( $use_sidebar as $id => $layout ): ?>
					  		<li>
					  			<?php $selected_class = herald_compare( $id, $section['use_sidebar'] ) ? ' selected': ''; ?>
					  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
					  			<br/><span><?php echo $layout['title']; ?></span>
					  			<input type="radio" class="herald-hidden herald-count-me sec-sidebar" name="<?php echo esc_attr($name_prefix); ?>[use_sidebar]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $section['use_sidebar'] );?>/>
					  		</li>
					  	<?php endforeach; ?>
					    </ul>
					    <small class="howto"><?php esc_html_e( 'Choose a sidebar layout', 'herald' ); ?></small>
					</div>
				</div>

			    <div class="herald-opt">
			    	<div class="herald-opt-title">
			    		<?php esc_html_e( 'Standard sidebar', 'herald' ); ?>:
			    	</div>
				    <div class="herald-opt-content">
					    <select name="<?php echo esc_attr($name_prefix); ?>[sidebar]" class="herald-count-me herald-opt-select">
					  	<?php foreach ( $sidebars as $id => $name ): ?>
					  		<option class="herald-count-me" value="<?php echo esc_attr($id); ?>" <?php selected( $id, $section['sidebar'] );?>><?php echo $name; ?></option>
					  	<?php endforeach; ?>
					  	</select>
				 		<small class="howto"><?php esc_html_e( 'Choose a standard sidebar', 'herald' ); ?></small>
				 	</div>
				</div>

				<div class="herald-opt">
				 	<div class="herald-opt-title">
				 		<?php esc_html_e( 'Sticky sidebar', 'herald' ); ?>:
				 	</div>
				  	<div class="herald-opt-content">
					  	<select name="<?php echo esc_attr($name_prefix); ?>[sticky_sidebar]" class="herald-count-me herald-opt-select">
					  	<?php foreach ( $sidebars as $id => $name ): ?>
					  		<option class="herald-count-me" value="<?php echo esc_attr($id); ?>" <?php selected( $id, $section['sticky_sidebar'] );?>><?php echo $name; ?></option>
					  	<?php endforeach; ?>
					  	</select>
					 	<small class="howto"><?php esc_html_e( 'Choose a sticky sidebar', 'herald' ); ?></small>
					 </div>
				</div>

				<div class="herald-opt">
					<div class="herald-opt-title">
						<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
					</div>
					<div class="herald-opt-content">
						<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr($section['css_class']);?>"/><br/>
						<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this section using CSS (i.e. my-custom-section)', 'herald' ); ?></small>
					</div>
				</div>

			</div>

		</div>
		<?php
	}
endif;


/**
 * Generate module field
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $i id of a current section
 * @param   $j id of a current module
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_module' ) ) :
	function herald_generate_module( $module, $options, $i = false, $j = false ) {
		//print_r($module['type']);
		$name_prefix = ( $i === false ) ? '' :  'herald[sections]['.$i.'][modules]['.$j.']';
		$edit = ( $j === false ) ? '' :  'edit';
		$module_class = ( $j === false ) ? '' :  'herald-module-'.$j;
		$module_num = ( $j === false ) ? '' : $j;

		$activate_hidden = $module['active'] ? 'herald-hidden' : '';
		$deactivate_hidden = $module['active'] ? '' : 'herald-hidden';

		if( !$module['active'] ) {
			$module_class .= ' herald-module-disabled';
		}
		

?>
		<div class="herald-module <?php echo esc_attr($module_class); ?>" data-module="<?php echo esc_attr($module_num); ?>">
			
			<div class="left">
				<span class="herald-module-type">
					<?php echo ($module['type_name']); ?>
					<?php if(isset($module['columns']) && !in_array( $module['type'], array('woocommerce', 'authors', 'cats') )  ){
							$columns = herald_get_module_columns();
							echo '(<span class="herald-module-columns">'.$columns[$module['columns']]['title'].'</span>)';
						}
					?>
				</span>
				<span class="herald-module-title"><?php echo esc_html( $module['title'] ); ?></span>
			</div>

		
		
			<div class="right">
				
				<a href="javascript:void(0);" class="herald-edit-module"><?php esc_html_e( 'Edit', 'herald' ); ?></a> | 
				<a href="javascript:void(0);" class="herald-deactivate-module"><span class="<?php echo esc_attr($deactivate_hidden);?>"><?php esc_html_e( 'Deactivate', 'herald' ); ?></span><span class="<?php echo esc_attr($activate_hidden);?>"><?php esc_html_e( 'Activate', 'herald' ); ?></span></a> |
				<a href="javascript:void(0);" class="herald-remove-module"><?php esc_html_e( 'Remove', 'herald' ); ?></a> 
			</div>

			<div class="herald-module-form <?php echo esc_attr($edit); ?>">
				<input class="herald-count-me" type="hidden" name="<?php echo esc_attr($name_prefix); ?>[type]" value="<?php echo esc_attr($module['type']); ?>"/>
				<input class="herald-module-deactivate" type="hidden" name="<?php echo esc_attr($name_prefix); ?>[active]" value="<?php echo esc_attr($module['active']); ?>"/>
				<?php $mod_type = isset($module['cpt']) ? 'cpt' : $module['type']; ?>
				<?php call_user_func( 'herald_generate_module_'.$mod_type, $module, $options, $name_prefix ); ?>

		   	</div>

		</div>
		
	<?php
	}
endif;


/**
 * Generate posts module
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $name_prefix id of a current module
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_module_posts' ) ) :
function herald_generate_module_posts( $module, $options, $name_prefix ){
	
	extract( $options ); ?>

	<div class="herald-opt-tabs">
		<a href="javascript:void(0);" class="active"><?php esc_html_e( 'Appearance', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Selection', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Actions', 'herald' ); ?></a>
	</div>

	<div class="herald-tab first">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title]" value="<?php echo esc_attr($module['title']);?>"/>
				<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[hide_title]" value="1" <?php checked( $module['hide_title'], 1 ); ?> class="herald-count-me" />
				<?php esc_html_e( 'Do not display publicly', 'herald' ); ?>
				<small class="howto"><?php esc_html_e( 'Enter your module title', 'herald' ); ?></small>

			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title Link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/>
				<small class="howto"><?php esc_html_e( 'Optionally, specify URL for module title', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Width', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep-control">
			  	<?php foreach ( $columns as $id => $column ): ?>
			  		<li>
			  			<?php $selected_class = herald_compare( $id, $module['columns'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($column['img']); ?>" title="<?php echo esc_attr($column['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
			  			<br/><span><?php echo esc_attr($column['title']); ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me mod-columns" name="<?php echo esc_attr($name_prefix); ?>[columns]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['columns'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose module width', 'herald' ); ?></small>
		    </div>
	    </div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Layout', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep">
			  	<?php foreach ( $layouts as $id => $layout ): ?>
			  		<?php $disabled_class = ( $module['columns'] % $layout['col'] ) ? 'herald-disabled' : ''; ?>
			  		<li class="<?php echo esc_attr($disabled_class); ?>">
			  			<?php $selected_class = herald_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>" data-col="<?php echo esc_attr($layout['col']); ?>">
			  			<br/><span><?php echo esc_attr($layout['title']); ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['layout'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose your main posts layout', 'herald' ); ?></small>
		    </div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Number of posts', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[limit]" value="<?php echo esc_attr($module['limit']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Max number of posts to display', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Starter Layout', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep">
			  	<?php foreach ( $starter_layouts as $id => $layout ): ?>
			  		<?php $disabled_class = $layout['col'] && $module['columns'] % $layout['col']  ? 'herald-disabled' : ''; ?>
			  		<li class="<?php echo esc_attr($disabled_class); ?>">
			  			<?php $selected_class = herald_compare( $id, $module['starter_layout'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>" data-col="<?php echo esc_attr($layout['col']); ?>">
			  			<br/><span><?php echo $layout['title']; ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[starter_layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['starter_layout'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose your starter posts layout', 'herald' ); ?></small>
		    </div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Number of starter posts', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[starter_limit]" value="<?php echo esc_attr($module['starter_limit']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Number of posts to display in starter layout', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', 'herald' ); ?></small>
			</div>
		</div>

	</div>

	<div class="herald-tab">
		
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Order by', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $order as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[order]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['order'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>

				<div class="herald-live-search-opt">

					<br/><?php esc_html_e( 'Or choose manually', 'herald' ); ?>:<br/>
		   			<input type="text" class="herald-live-search" placeholder="<?php esc_html_e( 'Type to search...', 'herald' ); ?>" /><br/>
		   			<?php $manualy_selected_posts = herald_get_manually_selected_posts($module['manual'], $module['type']); ?>
		   			<?php $manual = !empty( $manualy_selected_posts ) ? implode( ",", $module['manual'] ) : ''; ?>
		   			<input type="hidden" class="herald-count-me herald-live-search-hidden" data-type="<?php echo esc_attr($module['type']); ?>" name="<?php echo esc_attr($name_prefix); ?>[manual]" value="<?php echo esc_attr($manual); ?>" />
		   			<div class="herald-live-search-items tagchecklist">
		   				<?php herald_display_manually_selected_posts($manualy_selected_posts); ?>
		   			</div>

		   		</div>

		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Sort', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="DESC" <?php checked( $module['sort'], 'DESC' ); ?> class="herald-count-me" /><?php esc_html_e('Descending', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="ASC" <?php checked( $module['sort'], 'ASC' ); ?> class="herald-count-me" /><?php esc_html_e('Ascending', 'herald') ?></label><br/>
		   	</div>
	    </div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'In category', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<div class="herald-fit-height">
		   		<?php foreach ( $cats as $cat ) : ?>
		   			<?php $checked = in_array( $cat->term_id, $module['cat'] ) ? 'checked="checked"' : ''; ?>
		   			<label><input class="herald-count-me" type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[cat][]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo $checked; ?> /><?php echo $cat->name;?></label><br/>
		   		<?php endforeach; ?>
		   		</div>
		   		<small class="howto"><?php esc_html_e( 'Check whether you want to display posts from specific categories only', 'herald' ); ?></small>
		   		<br/>
		   		<label><input type="checkbox" name="<?php echo esc_attr( $name_prefix ); ?>[cat_child]" value="1" class="herald-count-me" <?php checked( $module['cat_child'], 1 );?>/><?php esc_html_e( 'Apply child categories', 'herald' ); ?></label><br/>
		    	<small class="howto"><?php esc_html_e( 'If parent category is selected, posts from child categories will be included automatically', 'herald' ); ?></small>
		    	<br/>
		    	<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[cat_inc_exc]" value="in" <?php checked( $module['cat_inc_exc'], 'in' ); ?> class="herald-count-me" /><?php esc_html_e('Include', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[cat_inc_exc]" value="not_in" <?php checked( $module['cat_inc_exc'], 'not_in' ); ?> class="herald-count-me" /><?php esc_html_e('Exclude', 'herald') ?></label><br/>
		   		<small class="howto"><?php esc_html_e( 'Wheter to include or exclude posts from selected categories', 'herald' ); ?></small>
		   	</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Tagged with', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[tag]" value="<?php echo esc_attr(herald_get_tax_term_name_by_slug($module['tag'])); ?>" class="herald-count-me"/><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify one or more tags separated by comma. i.e. life, cooking, funny moments', 'herald' ); ?></small>
		   		<br/>
		    	<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[tag_inc_exc]" value="in" <?php checked( $module['tag_inc_exc'], 'in' ); ?> class="herald-count-me" /><?php esc_html_e('Include', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[tag_inc_exc]" value="not_in" <?php checked( $module['tag_inc_exc'], 'not_in' ); ?> class="herald-count-me" /><?php esc_html_e('Exclude', 'herald') ?></label><br/>
		   		<small class="howto"><?php esc_html_e( 'Wheter to include or exclude posts from selected tags', 'herald' ); ?></small>
		   	</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Filter by author', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[author]" value="<?php echo esc_attr(herald_get_authors_username_by_id($module['author'])); ?>" class="herald-count-me" />
		   		<small class="howto"><?php esc_html_e( 'Specify one or more authors (usernames) separated by comma. i.e admin, someuser, etc...', 'herald' ); ?></small>
		   		<br>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="in" <?php checked( $module['author_inc_exc'], 'in' ); ?> class="herald-count-me" /><?php esc_html_e('Include', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="not_in" <?php checked( $module['author_inc_exc'], 'not_in' ); ?> class="herald-count-me" /><?php esc_html_e('Exclude', 'herald') ?></label><br/>
		   		<small class="howto"><?php esc_html_e( 'Wheter to include or exclude posts from selected authors', 'herald' ); ?></small>
	   		</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Exclude by id', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<?php  $ids = !empty($module['exclude_by_id']) ?  implode(',', $module['exclude_by_id']) : ''; ?>
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[exclude_by_id]" value="<?php echo esc_attr( $ids ); ?>" class="herald-count-me" />
		   		<small class="howto"><?php esc_html_e( 'Specify post ids separated by comma if you want to exclude those posts. i.e. 213,32,12,45', 'herald' ); ?></small>
	   		</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Format', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $formats as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[format]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['format'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php esc_html_e( 'Display posts that have a specific format', 'herald' ); ?></small>
	   		</div>
	   	</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Not older than', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $time as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[time]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['time'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php esc_html_e( 'Display posts that are not older than specific time range', 'herald' ); ?></small>
	   		</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Unique posts (do not duplicate)', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[unique]" value="1" <?php checked( $module['unique'], 1 ); ?> class="herald-count-me" /></label>
		   		<small class="howto"><?php esc_html_e( 'If you check this option, posts in this module will be excluded from other modules below.', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>

	<div class="herald-tab">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display child category links', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[cat_nav]" value="1" <?php checked( $module['cat_nav'], 1 ); ?> class="herald-count-me" /></label>
		   		<small class="howto"><?php esc_html_e( 'Note: if one parent category is checked in post selection, links to its child categories will be automatically displayed', 'herald' ); ?></small>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display module as slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[slider]" value="1" <?php checked( $module['slider'], 1 ); ?> class="herald-count-me herald-next-hide" /></label>
		   		<small class="howto"><?php esc_html_e( 'Note: if slider is apllied to a module, "starter" layout will be ignored', 'herald' ); ?></small>
		   	</div>
	    </div>

	    <?php $style = $module['slider'] ? '' : 'display:none;'; ?>
	    <div class="herald-opt" style="<?php echo esc_attr( $style ); ?>">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Autoplay slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="text" name="<?php echo esc_attr($name_prefix); ?>[autoplay]" value="<?php echo esc_attr($module['autoplay']); ?>" class="herald-count-me small-text" /> sec.</label>
		   		<small class="howto"><?php esc_html_e( 'Specify number of seconds to enable automatic rotation of slider', 'herald' ); ?></small>
		   	</div>
	    </div>

	    

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display "view all" button', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><?php esc_html_e( 'Text', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_text]" value="<?php echo esc_attr($module['more_text']);?>" class="herald-count-me" />
		   		<br/>
		   		<label><?php esc_html_e( 'URL', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_url]" value="<?php echo esc_attr($module['more_url']);?>" class="herald-count-me" /><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify text and URL if you want to display "view all" button in this module', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>
<?php }
endif;

/**
 * Generate featured module
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $name_prefix id of a current module
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_module_featured' ) ) :
function herald_generate_module_featured( $module, $options, $name_prefix ){
	
	extract( $options ); ?>

	<div class="herald-opt-tabs">
		<a href="javascript:void(0);" class="active"><?php esc_html_e( 'Appearance', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Selection', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Actions', 'herald' ); ?></a>
	</div>

	<div class="herald-tab first">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title]" value="<?php echo esc_attr($module['title']);?>"/>
				<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[hide_title]" value="1" <?php checked( $module['hide_title'], 1 ); ?> class="herald-count-me" />
				<?php esc_html_e( 'Do not display publicly', 'herald' ); ?>
				<small class="howto"><?php esc_html_e( 'Enter your module title', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title Link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/>
				<small class="howto"><?php esc_html_e( 'Optionally, specify URL for module title', 'herald' ); ?></small>

			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Layout', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap ">
			  	<?php foreach ( $layouts as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = herald_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
			  			<br/><span><?php echo esc_attr($layout['title']); ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['layout'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose your main posts layout', 'herald' ); ?></small>
		    </div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', 'herald' ); ?></small>
			</div>
		</div>

	</div>

	<div class="herald-tab">
		<div class="herald-opt <?php echo (count($post_types) < 2) ? 'herald-hidden-i' : ''; ?>">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Post type', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<select class="herald-fa-post-type herald-count-me" name="<?php echo esc_attr( $name_prefix ); ?>[post_type]">
					<?php foreach ($post_types as $post_type) :?>
						<?php
						if( empty($post_type) ){
							continue;
						}
						?>
                        <option value="<?php echo esc_attr($post_type->name)?>" <?php selected($module['post_type'], $post_type->name); ?>><?php echo esc_attr($post_type->labels->singular_name); ?></option>
					<?php endforeach; ?>
                </select>

		   	</div>
	    </div>
		
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Order by', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $order as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[order]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['order'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
					
				<div class="herald-live-search-opt">

					<br/><?php esc_html_e( 'Or choose manually', 'herald' ); ?>:<br/>
		   			<input type="text" class="herald-live-search herald-live-search-with-cpts" placeholder="<?php esc_html_e( 'Type to search...', 'herald' ); ?>" /><br/>
		   			<?php
                    $featured_type = $module['post_type'] == 'post' ? 'featured' : $module['post_type'];
                    $manualy_selected_posts = herald_get_manually_selected_posts($module['manual'], $featured_type); ?>
		   			<?php $manual = !empty( $manualy_selected_posts ) ? implode( ",", $module['manual'] ) : ''; ?>
		   			<input type="hidden" class="herald-count-me herald-live-search-hidden" data-type="<?php echo esc_attr($module['type']); ?>" name="<?php echo esc_attr($name_prefix); ?>[manual]" value="<?php echo esc_attr($manual); ?>" />
		   			<div class="herald-live-search-items tagchecklist">
		   				<?php herald_display_manually_selected_posts($manualy_selected_posts); ?>
		   			</div>

		   		</div>

		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Sort', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="DESC" <?php checked( $module['sort'], 'DESC' ); ?> class="herald-count-me" /><?php esc_html_e('Descending', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="ASC" <?php checked( $module['sort'], 'ASC' ); ?> class="herald-count-me" /><?php esc_html_e('Ascending', 'herald') ?></label><br/>
		   	</div>
	    </div>
	
        <?php foreach ( $post_types as $post_type ) :
            
            if ( empty( $post_type->taxonomies ) ) {
                continue;
            }
            
            foreach ( $post_type->taxonomies as $taxonomy ) :
                
                if ( ! isset( $taxonomy['hierarchical'] ) ) {
                    continue;
                }
                
                if( $taxonomy['hierarchical'] && empty( $taxonomy['terms'] ) ){
                    continue;
                }
                
                ?>
                <div class="herald-opt herald-watch-for-changes" data-show-on-value="<?php echo esc_attr($post_type->name);?>">
            
                        <div class="herald-opt-title">
                            <?php echo esc_attr( $taxonomy['name'] ); ?>:
                        </div>
                        <div class="herald-opt-content">
                            <?php
                            
                            $taxonomy_id = herald_patch_taxonomy_id($taxonomy['id']);
                            
                            if ( $taxonomy['hierarchical'] ):
                                if ( empty( $taxonomy['terms'] ) ) {
                                    continue;
                                }
                                ?>
                                <div class="herald-fit-height">
                                    <?php foreach ( $taxonomy['terms'] as $term ) : ?>
                                        <?php $checked = !empty($module[$taxonomy_id]) && in_array( $term->term_id, $module[$taxonomy_id] ) ? 'checked="checked"' : ''; ?>
                                        <label><input class="herald-count-me" type="checkbox" name="<?php echo esc_attr( $name_prefix . '[' . $taxonomy_id . ']' ); ?>[]" value="<?php echo esc_attr( $term->term_id ); ?>" <?php echo $checked; ?> /><?php echo $term->name; ?>
                                        </label>
                                        <br/>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                                <label>
                                    <?php $apply_child = !empty($module[$taxonomy_id . '_child']) ? $module[$taxonomy_id . '_child'] : 0; ?>
                                    <input type="checkbox" name="<?php echo esc_attr( $name_prefix . '[' . $taxonomy_id . '_child]' ); ?>" value="1" class="herald-count-me" <?php checked($apply_child, 1); ?>/>
                                    <strong><?php printf(esc_html__('Apply child %s', 'herald'), strtolower($taxonomy['name'])); ?></strong>
                                </label>
                                <small class="howto"><?php printf(esc_html__( 'Check whether you want to display posts from specific %s only', 'herald' ), strtolower($taxonomy['name'])); ?></small>
                            <?php else: ?>
                                <?php $value = empty($module[$taxonomy_id]) ? '' : herald_get_tax_term_name_by_slug( $module[$taxonomy_id], $taxonomy['id'] ); ?>
                                <input type="text" name="<?php echo esc_attr( $name_prefix . '[' . $taxonomy_id . ']' ); ?>" value="<?php echo esc_attr( $value ); ?>" class="herald-count-me"/><br/>
                                <small class="howto"><?php printf(esc_html__( 'Specify one or more %s separated by comma. i.e. life, cooking, funny moments', 'herald' ), strtolower($taxonomy['name'])); ?></small>
                            <?php endif;
                            
                            $taxonomy_inc_exc = empty($module[ $taxonomy_id . '_inc_exc' ]) ? 'in' : $module[ $taxonomy_id . '_inc_exc' ];
                            ?>
                            <br/>
                            <label><input type="radio" name="<?php echo esc_attr( $name_prefix . '[' . $taxonomy_id . '_inc_exc]' ); ?>" value="in" <?php checked( $taxonomy_inc_exc, 'in' ); ?> class="herald-count-me"/><?php esc_html_e( 'Include', 'herald' ) ?>
                            </label><br/>
                            <label><input type="radio" name="<?php echo esc_attr( $name_prefix ) . '[' . $taxonomy_id . '_inc_exc]'; ?>" value="not_in" <?php checked( $taxonomy_inc_exc, 'not_in' ); ?> class="herald-count-me"/><?php esc_html_e( 'Exclude', 'herald' ) ?>
                            </label><br/>
                            <small class="howto"><?php printf(esc_html__( 'Whether to include or exclude posts from selected %s', 'herald' ), strtolower($taxonomy['name'])); ?></small>
                        <br>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'By author', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[author]" value="<?php echo esc_attr(herald_get_authors_username_by_id($module['author'])); ?>" class="herald-count-me" />
		   		<small class="howto"><?php esc_html_e( 'Specify one or more authors (usernames) separated by comma. i.e admin, someuser, etc...', 'herald' ); ?></small>
		   		<br>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="in" <?php checked( $module['author_inc_exc'], 'in' ); ?> class="herald-count-me" /><?php esc_html_e('Include', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[author_inc_exc]" value="not_in" <?php checked( $module['author_inc_exc'], 'not_in' ); ?> class="herald-count-me" /><?php esc_html_e('Exclude', 'herald') ?></label><br/>
		   		<small class="howto"><?php esc_html_e( 'Wheter to include or exclude posts from selected authors', 'herald' ); ?></small>
	   		</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Exclude by id', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			<?php  $ids = !empty($module['exclude_by_id']) ?  implode(',', $module['exclude_by_id']) : ''; ?>
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[exclude_by_id]" value="<?php echo esc_attr(  $ids ); ?>" class="herald-count-me" />
		   		<small class="howto"><?php esc_html_e( 'Specify post ids separated by comma if you want to exclude those posts. i.e. 213,32,12,45', 'herald' ); ?></small>
	   		</div>
	   	</div>

	   	<div class="herald-opt herald-watch-for-changes" data-show-on-value="post">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Format', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $formats as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[format]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['format'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php esc_html_e( 'Display posts which have a specific format', 'herald' ); ?></small>
	   		</div>
	   	</div>
		
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Not older than', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $time as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[time]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['time'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php esc_html_e( 'Display posts that are not older than specific time range', 'herald' ); ?></small>
	   		</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Unique posts (do not duplicate)', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[unique]" value="1" <?php checked( $module['unique'], 1 ); ?> class="herald-count-me" /></label>
		   		<small class="howto"><?php esc_html_e( 'If you check this option, posts in this module will be excluded from other modules below.', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>

	<div class="herald-tab">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display child category links', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[cat_nav]" value="1" <?php checked( $module['cat_nav'], 1 ); ?> class="herald-count-me" /></label>
		   		<small class="howto"><?php esc_html_e( 'Note: if one parent category is checked in post selection, links to its child categories will be automatically displayed', 'herald' ); ?></small>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display "view all" button', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><?php esc_html_e( 'Text', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_text]" value="<?php echo esc_attr($module['more_text']);?>" class="herald-count-me" /><br/>
		   		<label><?php esc_html_e( 'URL', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_url]" value="<?php echo esc_attr($module['more_url']);?>" class="herald-count-me" /><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify text and URL if you want to display "view all" button in this module', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>


<?php }
endif;


/**
 * Generate text module
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $name_prefix id of a current module
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_module_text' ) ) :
	function herald_generate_module_text( $module, $options, $name_prefix ){
		
		extract( $options ); ?>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title]" value="<?php echo esc_attr($module['title']);?>"/>
				<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[hide_title]" value="1" <?php checked( $module['hide_title'], 1 ); ?> class="herald-count-me" />
				<?php esc_html_e( 'Do not display publicly', 'herald' ); ?>
				<small class="howto"><?php esc_html_e( 'Enter your module title', 'herald' ); ?></small>				
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title Link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/>
				<small class="howto"><?php esc_html_e( 'Optionally, specify URL for module title', 'herald' ); ?></small>

			</div>
		</div>
	
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Width', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap">
			  	<?php foreach ( $columns as $id => $column ): ?>
			  		<li>
			  			<?php $selected_class = herald_compare( $id, $module['columns'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($column['img']); ?>" title="<?php echo esc_attr($column['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
			  			<br/><span><?php echo $column['title']; ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me mod-columns" name="<?php echo esc_attr($name_prefix); ?>[columns]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['columns'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose module width', 'herald' ); ?></small>
		    </div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Content', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<textarea class="herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[content]"><?php echo esc_textarea( $module['content'] ); ?></textarea>
				<small class="howto"><?php esc_html_e( 'Paste any text, HTML, script or shortcodes here', 'herald' ); ?></small>

				<label>
					<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[autop]" value="1" <?php checked( $module['autop'], 1 ); ?> class="herald-count-me" />
					<?php esc_html_e( 'Automatically add paragraphs', 'herald' ); ?>
				</label>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', 'herald' ); ?></small>
			</div>
		</div>

	<?php }
endif;

/**
 * Generate WooCommerce module
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $name_prefix id of a current module
 * @since  1.2
 */

if ( !function_exists( 'herald_generate_module_woocommerce' ) ) :
function herald_generate_module_woocommerce( $module, $options, $name_prefix ){
	
	extract( $options ); ?>

	<div class="herald-opt-tabs">
		<a href="javascript:void(0);" class="active"><?php esc_html_e( 'Appearance', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Selection', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Actions', 'herald' ); ?></a>
	</div>

	<div class="herald-tab first">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title]" value="<?php echo esc_attr($module['title']);?>"/>
				<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[hide_title]" value="1" <?php checked( $module['hide_title'], 1 ); ?> class="herald-count-me" />
				<?php esc_html_e( 'Do not display publicly', 'herald' ); ?>
				<small class="howto"><?php esc_html_e( 'Enter your module title', 'herald' ); ?></small>

			</div>
		</div>
	
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title Link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/>
				<small class="howto"><?php esc_html_e( 'Optionally, specify URL for module title', 'herald' ); ?></small>

			</div>
		</div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Number of products', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[limit]" value="<?php echo esc_attr($module['limit']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Max number of products to display', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display product category', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input type="hidden" name="<?php echo esc_attr($name_prefix); ?>[display_cat]" value="0">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[display_cat]" value="1" <?php checked( $module['display_cat'], 1 ); ?> class="herald-count-me" /></label>
		   	</div>
	    </div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display price', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input type="hidden" name="<?php echo esc_attr($name_prefix); ?>[display_price]" value="0">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[display_price]" value="1" <?php checked( $module['display_price'], 1 ); ?> class="herald-count-me" /></label>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', 'herald' ); ?></small>
			</div>
		</div>
	   
	</div>

	<div class="herald-tab">
		
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Order by', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $order as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[order]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['order'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
				
				<div class="herald-live-search-opt">

					<br/><?php esc_html_e( 'Or choose manually', 'herald' ); ?>:<br/>
		   			<input type="text" class="herald-live-search" placeholder="<?php esc_html_e( 'Type to search...', 'herald' ); ?>" /><br/>
		   			<?php $manualy_selected_posts = herald_get_manually_selected_posts($module['manual'], 'product'); ?>
		   			<?php $manual = !empty( $manualy_selected_posts ) ? implode( ",", $module['manual'] ) : ''; ?>
		   			<input type="hidden" class="herald-count-me herald-live-search-hidden" data-type="product" name="<?php echo esc_attr($name_prefix); ?>[manual]" value="<?php echo esc_attr($manual); ?>" />
		   			<div class="herald-live-search-items tagchecklist">
		   				<?php herald_display_manually_selected_posts($manualy_selected_posts); ?>
		   			</div>

		   		</div>
		   	</div>
	    </div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'In product category', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<div class="herald-fit-height">
		   		<?php foreach ( $cats as $cat ) : ?>
		   			<?php $checked = in_array( $cat->term_id, $module['cat'] ) ? 'checked="checked"' : ''; ?>
		   			<label><input class="herald-count-me" type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[cat][]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo $checked; ?> /><?php echo $cat->name;?></label><br/>
		   		<?php endforeach; ?>
		   		</div>
		   		<small class="howto"><?php esc_html_e( 'Check whether you want to display posts from specific product categories only', 'herald' ); ?></small>
                <br/>
                <label><input type="radio" name="<?php echo esc_attr( $name_prefix ); ?>[cat_inc_exc]" value="in" <?php checked( $module['cat_inc_exc'], 'in' ); ?> class="herald-count-me" /><?php esc_html_e('Include', 'herald') ?></label><br/>
                <label><input type="radio" name="<?php echo esc_attr( $name_prefix ); ?>[cat_inc_exc]" value="not_in" <?php checked( $module['cat_inc_exc'], 'not_in' ); ?> class="herald-count-me" /><?php esc_html_e('Exclude', 'herald') ?></label><br/>
                <small class="howto"><?php esc_html_e( 'Whether to include or exclude posts from selected categories', 'herald' ); ?></small>
		   	</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Tagged with', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[tag]" value="<?php echo esc_attr(herald_get_tax_term_name_by_slug($module['tag'], 'product_tag')); ?>" class="herald-count-me"/><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify one or more tags separated by comma. i.e. life, cooking, funny moments', 'herald' ); ?></small>
                <br>
                <label><input type="radio" name="<?php echo esc_attr( $name_prefix ); ?>[tag_inc_exc]" value="in" <?php checked( $module['tag_inc_exc'], 'in' ); ?> class="herald-count-me" /><?php esc_html_e('Include', 'herald') ?></label><br/>
                <label><input type="radio" name="<?php echo esc_attr( $name_prefix ); ?>[tag_inc_exc]" value="not_in" <?php checked( $module['tag_inc_exc'], 'not_in' ); ?> class="herald-count-me" /><?php esc_html_e('Exclude', 'herald') ?></label><br/>
                <small class="howto"><?php esc_html_e( 'Whether to include or exclude posts from selected tags', 'herald' ); ?></small>
		   	</div>
	   	</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Not older than', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $time as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[time]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['time'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php esc_html_e( 'Display products that are not older than specific time range', 'herald' ); ?></small>
	   		</div>
	   	</div>

	</div>

	<div class="herald-tab">

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display module as slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[slider]" value="1" <?php checked( $module['slider'], 1 ); ?> class="herald-count-me herald-next-hide" /></label>
		   	</div>
	    </div>

	    <?php $style = $module['slider'] ? '' : 'display:none;'; ?>
	    <div class="herald-opt" style="<?php echo esc_attr( $style ); ?>">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Autoplay slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="text" name="<?php echo esc_attr($name_prefix); ?>[autoplay]" value="<?php echo esc_attr($module['autoplay']); ?>" class="herald-count-me small-text" /> sec.</label>
		   		<small class="howto"><?php esc_html_e( 'Specify number of seconds to enable automatic rotation of slider', 'herald' ); ?></small>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display "view all" button', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><?php esc_html_e( 'Text', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_text]" value="<?php echo esc_attr($module['more_text']);?>" class="herald-count-me" />
		   		<br/>
		   		<label><?php esc_html_e( 'URL', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_url]" value="<?php echo esc_attr($module['more_url']);?>" class="herald-count-me" /><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify text and URL if you want to display "view all" button in this module', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>
<?php }
endif;

/**
 * Generate cpt module
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $name_prefix id of a current module
 * @since  1.5.4
 */

if ( !function_exists( 'herald_generate_module_cpt' ) ) :
function herald_generate_module_cpt( $module, $options, $name_prefix ){
	
	extract( $options ); ?>

	<div class="herald-opt-tabs">
		<a href="javascript:void(0);" class="active"><?php esc_html_e( 'Appearance', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Selection', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Actions', 'herald' ); ?></a>
	</div>

	<div class="herald-tab first">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title]" value="<?php echo esc_attr($module['title']);?>"/>
				<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[hide_title]" value="1" <?php checked( $module['hide_title'], 1 ); ?> class="herald-count-me" />
				<?php esc_html_e( 'Do not display publicly', 'herald' ); ?>
				<small class="howto"><?php esc_html_e( 'Enter your module title', 'herald' ); ?></small>

			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title Link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/>
				<small class="howto"><?php esc_html_e( 'Optionally, specify URL for module title', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Width', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep-control">
			  	<?php foreach ( $columns as $id => $column ): ?>
			  		<li>
			  			<?php $selected_class = herald_compare( $id, $module['columns'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($column['img']); ?>" title="<?php echo esc_attr($column['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
			  			<br/><span><?php echo esc_attr($column['title']); ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me mod-columns" name="<?php echo esc_attr($name_prefix); ?>[columns]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['columns'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose module width', 'herald' ); ?></small>
		    </div>
	    </div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Layout', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep">
			  	<?php foreach ( $layouts as $id => $layout ): ?>
			  		<?php $disabled_class = ( $module['columns'] % $layout['col'] ) ? 'herald-disabled' : ''; ?>
			  		<li class="<?php echo esc_attr($disabled_class); ?>">
			  			<?php $selected_class = herald_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>" data-col="<?php echo esc_attr($layout['col']); ?>">
			  			<br/><span><?php echo esc_attr($layout['title']); ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['layout'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose your main posts layout', 'herald' ); ?></small>
		    </div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Number of posts', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[limit]" value="<?php echo esc_attr($module['limit']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Max number of posts to display', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Starter Layout', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep">
			  	<?php foreach ( $starter_layouts as $id => $layout ): ?>
			  		<?php $disabled_class = $layout['col'] && $module['columns'] % $layout['col']  ? 'herald-disabled' : ''; ?>
			  		<li class="<?php echo esc_attr($disabled_class); ?>">
			  			<?php $selected_class = herald_compare( $id, $module['starter_layout'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>" data-col="<?php echo esc_attr($layout['col']); ?>">
			  			<br/><span><?php echo $layout['title']; ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[starter_layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['starter_layout'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose your starter posts layout', 'herald' ); ?></small>
		    </div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Number of starter posts', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[starter_limit]" value="<?php echo esc_attr($module['starter_limit']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Number of posts to display in starter layout', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', 'herald' ); ?></small>
			</div>
		</div>

	</div>

	<div class="herald-tab">
		
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Order by', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $order as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[order]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['order'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
					
				<div class="herald-live-search-opt">

					<br/><?php esc_html_e( 'Or choose manually', 'herald' ); ?>:<br/>
		   			<input type="text" class="herald-live-search" placeholder="<?php esc_html_e( 'Type to search...', 'herald' ); ?>" /><br/>
		   			<?php $manual = !empty( $module['manual'] ) ? implode( ",", $module['manual'] ) : ''; ?>
		   			<input type="hidden" class="herald-count-me herald-live-search-hidden" data-type="<?php echo esc_attr($module['type']); ?>" name="<?php echo esc_attr($name_prefix); ?>[manual]" value="<?php echo esc_attr($manual); ?>" />
		   			<div class="herald-live-search-items tagchecklist">
		   				<?php $manualy_selected_posts = herald_get_manually_selected_posts($module['manual'], $module['type']); ?>
		   				<?php herald_display_manually_selected_posts($manualy_selected_posts); ?>
		   			</div>

		   		</div>

		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Sort', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="DESC" <?php checked( $module['sort'], 'DESC' ); ?> class="herald-count-me" /><?php esc_html_e('Descending', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="ASC" <?php checked( $module['sort'], 'ASC' ); ?> class="herald-count-me" /><?php esc_html_e('Ascending', 'herald') ?></label><br/>
		   	</div>
	    </div>

		<?php foreach ( $taxonomies as $taxonomy ) : ?>
		    <div class="herald-opt">
				<div class="herald-opt-title">
					<?php esc_html_e( 'In ', 'herald' ); ?><?php echo $taxonomy['name']; ?>:
				</div>
				<div class="herald-opt-content">

					<?php if($taxonomy['hierarchical']) : ?>

						<div class="herald-fit-height">
				   			<?php foreach ($taxonomy['terms'] as $term) : ?>
				   			<?php $tax = !empty( $module['tax'][$taxonomy['id']] ) ? $module['tax'][$taxonomy['id']] : array(); ?>
				   			<?php $checked = in_array( $term->term_id, $tax ) ? 'checked="checked"' : ''; ?>
				   			<label><input class="herald-count-me" type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[tax][<?php echo esc_attr($taxonomy['id']); ?>][]" value="<?php echo esc_attr($term->term_id); ?>" <?php echo $checked; ?> /><?php echo $term->name;?></label><br/>
					   		<?php endforeach; ?>
				   		</div>
			   			<small class="howto"><?php esc_html_e( 'Check whether you want to display posts from specific', 'herald' ); ?> <?php echo $taxonomy['name']; ?></small>

				   	<?php else: ?>
							<?php $tax = !empty( $module['tax'][$taxonomy['id']] ) ? herald_get_tax_term_name_by_id($module['tax'][$taxonomy['id']], $taxonomy['id'] ) : '' ?>
					   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[tax][<?php echo esc_attr($taxonomy['id']); ?>]" value="<?php echo esc_attr( $tax ); ?>" class="herald-count-me"/><br/>
					   		<small class="howto"><?php esc_html_e( 'Specify one or more terms separated by comma. i.e. life, cooking, funny moments', 'herald' ); ?></small>

					<?php endif; ?>

                    <br>
                    <label><input type="radio" name="<?php echo esc_attr( $name_prefix ) . '[' . $taxonomy['id'] . '_inc_exc]'; ?>" value="in" <?php checked( $module[$taxonomy['id'] . '_inc_exc'], 'in' ); ?> class="herald-count-me" /><?php esc_html_e('Include', 'herald') ?></label><br/>
                    <label><input type="radio" name="<?php echo esc_attr( $name_prefix ) . '[' . $taxonomy['id'] . '_inc_exc]'; ?>" value="not_in" <?php checked( $module[$taxonomy['id'] . '_inc_exc'], 'not_in' ); ?> class="herald-count-me" /><?php esc_html_e('Exclude', 'herald') ?></label><br/>
                    <small class="howto"><?php esc_html_e( 'Whether to include or exclude cpt from selected taxonomies', 'herald' ); ?></small>
                </div>
		   	</div>
		<?php endforeach; ?>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Exclude by id', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<?php  $ids = !empty($module['exclude_by_id']) ?  implode(',', $module['exclude_by_id']) : ''; ?>
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[exclude_by_id]" value="<?php echo esc_attr( $ids ); ?>" class="herald-count-me" />
		   		<small class="howto"><?php esc_html_e( 'Specify post ids separated by comma if you want to exclude those posts. i.e. 213,32,12,45', 'herald' ); ?></small>
	   		</div>
	   	</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Not older than', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ( $time as $id => $title ) : ?>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[time]" value="<?php echo esc_attr($id); ?>" <?php checked( $module['time'], $id ); ?> class="herald-count-me" /><?php echo $title;?></label><br/>
		   		<?php endforeach; ?>
		   		<small class="howto"><?php esc_html_e( 'Display posts that are not older than specific time range', 'herald' ); ?></small>
	   		</div>
	   	</div>

	   	<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Unique posts (do not duplicate)', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[unique]" value="1" <?php checked( $module['unique'], 1 ); ?> class="herald-count-me" /></label>
		   		<small class="howto"><?php esc_html_e( 'If you check this option, posts in this module will be excluded from other modules below.', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>

	<div class="herald-tab">
	
	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display module as slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[slider]" value="1" <?php checked( $module['slider'], 1 ); ?> class="herald-count-me herald-next-hide" /></label>
		   		<small class="howto"><?php esc_html_e( 'Note: if slider is apllied to a module, "starter" layout will be ignored', 'herald' ); ?></small>
		   	</div>
	    </div>

	    <?php $style = $module['slider'] ? '' : 'display:none;'; ?>
	    <div class="herald-opt" style="<?php echo esc_attr( $style ); ?>">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Autoplay slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="text" name="<?php echo esc_attr($name_prefix); ?>[autoplay]" value="<?php echo esc_attr($module['autoplay']); ?>" class="herald-count-me small-text" /> sec.</label>
		   		<small class="howto"><?php esc_html_e( 'Specify number of seconds to enable automatic rotation of slider', 'herald' ); ?></small>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display "view all" button', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><?php esc_html_e( 'Text', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_text]" value="<?php echo esc_attr($module['more_text']);?>" class="herald-count-me" />
		   		<br/>
		   		<label><?php esc_html_e( 'URL', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_url]" value="<?php echo esc_attr($module['more_url']);?>" class="herald-count-me" /><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify text and URL if you want to display "view all" button in this module', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>
<?php }
endif;







/**
 * Generate category module
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $name_prefix id of a current module
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_module_cats' ) ) :
function herald_generate_module_cats( $module, $options, $name_prefix ){
	
	extract( $options ); ?>

	<div class="herald-opt-tabs">
		<a href="javascript:void(0);" class="active"><?php esc_html_e( 'Appearance', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Selection', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Actions', 'herald' ); ?></a>
	</div>

	<div class="herald-tab first">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title]" value="<?php echo esc_attr($module['title']);?>"/>
				<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[hide_title]" value="1" <?php checked( $module['hide_title'], 1 ); ?> class="herald-count-me" />
				<?php esc_html_e( 'Do not display publicly', 'herald' ); ?>
				<small class="howto"><?php esc_html_e( 'Enter your module title', 'herald' ); ?></small>

			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title Link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/>
				<small class="howto"><?php esc_html_e( 'Optionally, specify URL for module title', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Layout', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep">
			  	<?php foreach ( $layouts as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = herald_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>">
			  			<br/><span><?php echo esc_attr($layout['title']); ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['layout'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose a layout', 'herald' ); ?></small>
		    </div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display posts count', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input type="hidden" name="<?php echo esc_attr($name_prefix); ?>[display_count]" value="0" class="herald-count-me" />
		   		<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[display_count]" value="1" <?php checked( $module['display_count'], 1 ); ?> class="herald-count-me herald-next-hide" />
		   	</div>
	    </div>


	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Count label', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<input type="text" name="<?php echo esc_attr($name_prefix); ?>[count_label]" value="<?php echo esc_attr($module['count_label']);?>" class="herald-count-me" />
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr(esc_html($module['css_class']));?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', 'herald' ); ?></small>
			</div>
		</div>		

	</div>

	<div class="herald-tab">
		
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Categories', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<ul class="sortable-fields">
					<?php $cats = herald_sort_option_items( $cats,  $module['cat']); ?>
			   		<?php foreach ( $cats as $cat ) : ?>
			   			<?php $checked = in_array( $cat->term_id, $module['cat'] ) ? 'checked="checked"' : ''; ?>
			   			<li>
			   				<label>
			   					<input class="herald-count-me" type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[cat][]" value="<?php echo esc_attr($cat->term_id); ?>" <?php echo esc_attr($checked); ?> /><?php echo $cat->name;?>
			   				</label>
			   			</li>
			   		<?php endforeach; ?>
			   	</ul>
			   	<small class="howto"><?php esc_html_e( 'Select categories you would like to display, or leave empty for "all categories"', 'herald' ); ?></small>
		   </div>
		   	
	   	</div>

	</div>

	<div class="herald-tab">

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display module as slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[slider]" value="1" <?php checked( $module['slider'], 1 ); ?> class="herald-count-me herald-next-hide" /></label>
		   	</div>
	    </div>

	    <?php $style = $module['slider'] ? '' : 'display:none;'; ?>
	    <div class="herald-opt" style="<?php echo esc_attr( $style ); ?>">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Autoplay slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="text" name="<?php echo esc_attr($name_prefix); ?>[autoplay]" value="<?php echo esc_attr($module['autoplay']); ?>" class="herald-count-me small-text" /> sec.</label>
		   		<small class="howto"><?php esc_html_e( 'Specify number of seconds to enable automatic rotation of slider', 'herald' ); ?></small>
		   	</div>
	    </div>


	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display "view all" link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><?php esc_html_e( 'Text', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_text]" value="<?php echo esc_attr($module['more_text']);?>" class="herald-count-me" />
		   		<br/>
		   		<label><?php esc_html_e( 'URL', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_url]" value="<?php echo esc_attr($module['more_url']);?>" class="herald-count-me" /><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify text and URL if you want to display "view all" button in this module', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>
<?php }
endif;







/**
 * Generate authors module
 * 
 * @param   $module Data array for current module
 * @param   $options An array of module options
 * @param   $name_prefix id of a current module
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_module_authors' ) ) :
function herald_generate_module_authors( $module, $options, $name_prefix ){
	
	extract( $options ); ?>

	<div class="herald-opt-tabs">
		<a href="javascript:void(0);" class="active"><?php esc_html_e( 'Appearance', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Selection', 'herald' ); ?></a>
		<a href="javascript:void(0);"><?php esc_html_e( 'Actions', 'herald' ); ?></a>
	</div>

	<div class="herald-tab first">

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title]" value="<?php echo esc_attr($module['title']);?>"/>
				<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[hide_title]" value="1" <?php checked( $module['hide_title'], 1 ); ?> class="herald-count-me" />
				<?php esc_html_e( 'Do not display publicly', 'herald' ); ?>
				<small class="howto"><?php esc_html_e( 'Enter your module title', 'herald' ); ?></small>

			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Title Link', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me mod-title" type="text" name="<?php echo esc_attr($name_prefix); ?>[title_link]" value="<?php echo esc_attr($module['title_link']);?>"/>
				<small class="howto"><?php esc_html_e( 'Optionally, specify URL for module title', 'herald' ); ?></small>
			</div>
		</div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Layout', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			    <ul class="herald-img-select-wrap herald-col-dep">
			  	<?php foreach ( $layouts as $id => $layout ): ?>
			  		<li>
			  			<?php $selected_class = herald_compare( $id, $module['layout'] ) ? ' selected': ''; ?>
			  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="herald-img-select<?php echo esc_attr($selected_class); ?>" data-col="<?php echo esc_attr($layout['col']); ?>">
			  			<br/><span><?php echo esc_attr($layout['title']); ?></span>
			  			<input type="radio" class="herald-hidden herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $module['layout'] );?>/>
			  		</li>
			  	<?php endforeach; ?>
			    </ul>
		    	<small class="howto"><?php esc_html_e( 'Choose your authors layout', 'herald' ); ?></small>
		    </div>
	    </div>

 		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Number of authors', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[authors_number]" value="<?php echo esc_attr($module['authors_number']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Max number of authors to display', 'herald' ); ?></small>
			</div>
		</div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Limit author bio', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
			   	<input type="text" class="small-text herald-count-me" name="<?php echo esc_attr($name_prefix); ?>[limit]" value="<?php echo esc_attr( $module['limit'] ); ?>"/>
		    	<small class="howto"><?php esc_html_e( 'Specify how many characters you want to display.', 'herald' ); ?></small>
		    </div>
	    </div>

		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Custom CSS class', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input class="herald-count-me" type="text" name="<?php echo esc_attr($name_prefix); ?>[css_class]" value="<?php echo esc_attr($module['css_class']);?>"/><br/>
				<small class="howto"><?php esc_html_e( 'Specify class name for a possibility to apply custom styling to this module using CSS (i.e. my-custom-module)', 'herald' ); ?></small>
			</div>
		</div>

	</div>

	<div class="herald-tab">
		
		<div class="herald-opt">
			<?php 
				$orderby_options = array(
					'post_count' => __('Post Count', 'herald'),
					'user_name' => __('Username', 'herald') ,
					'display_name' => __('Display Name', 'herald'),
					'user_registered' => __('Register Date', 'herald')
				); 
			?>
			<div class="herald-opt-title">
				<?php esc_html_e( 'Order by', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php foreach ($orderby_options as $value => $name): ?>
					<?php $checked = ( $module['orderby'] === $value ) ? 'checked' : '' ; ?>
					<label for="<?php echo esc_attr($name_prefix); ?>[orderby]">
						<input type="radio" name="<?php echo esc_attr($name_prefix); ?>[orderby]" value="<?php echo esc_attr($value); ?>" <?php echo $checked; ?>  class="herald-count-me" />
						<?php echo esc_html_e( $name, 'herald' ); ?>
					</label><br>
				<?php endforeach; ?>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Sort', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="DESC" <?php checked( $module['sort'], 'DESC' ); ?> class="herald-count-me" /><?php esc_html_e('Descending', 'herald') ?></label><br/>
		   		<label><input type="radio" name="<?php echo esc_attr($name_prefix); ?>[sort]" value="ASC" <?php checked( $module['sort'], 'ASC' ); ?> class="herald-count-me" /><?php esc_html_e('Ascending', 'herald') ?></label><br/>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Exlude roles', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<?php 
				 	global $wp_roles;
		     		$roles = $wp_roles->get_names(); 	
					foreach($roles as $role) : ?>
					  	<input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[roles][]" value="<?php echo esc_attr($role); ?>" <?php echo ( in_array( $role, $module['roles'])) ? 'checked="checked"' : ''; ?> class="herald-count-me" />
						<label for="<?php echo esc_attr($name_prefix); ?>[roles]"><?php echo esc_html_e( $role,'herald' ); ?></label><br>
					<?php endforeach; 
				?>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Exlude by id', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
				<input type="text" name="<?php echo esc_attr($name_prefix); ?>[exclude]" value="<?php echo esc_attr( $module['exclude'] );?>" class="herald-count-me" /><br>
				<small><?php esc_html_e('Enter author IDs separated by comma', 'herald');?></small>
		   	</div>
	    </div>

	</div>

	<div class="herald-tab">

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display module as slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="checkbox" name="<?php echo esc_attr($name_prefix); ?>[slider]" value="1" <?php checked( $module['slider'], 1 ); ?> class="herald-count-me herald-next-hide" /></label>
		   	</div>
	    </div>

	    <?php $style = $module['slider'] ? '' : 'display:none;'; ?>
	    <div class="herald-opt" style="<?php echo esc_attr( $style ); ?>">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Autoplay slider', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><input type="text" name="<?php echo esc_attr($name_prefix); ?>[autoplay]" value="<?php echo esc_attr($module['autoplay']); ?>" class="herald-count-me small-text" /> sec.</label>
		   		<small class="howto"><?php esc_html_e( 'Specify number of seconds to enable automatic rotation of slider', 'herald' ); ?></small>
		   	</div>
	    </div>

	    <div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e( 'Display "view all" button', 'herald' ); ?>:
			</div>
			<div class="herald-opt-content">
		   		<label><?php esc_html_e( 'Text', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_text]" value="<?php echo esc_attr($module['more_text']);?>" class="herald-count-me" />
		   		<br/>
		   		<label><?php esc_html_e( 'URL', 'herald' ); ?></label>: <input type="text" name="<?php echo esc_attr($name_prefix); ?>[more_url]" value="<?php echo esc_attr($module['more_url']);?>" class="herald-count-me" /><br/>
		   		<small class="howto"><?php esc_html_e( 'Specify text and URL if you want to display "view all" button in this module', 'herald' ); ?></small>
		   	</div>
	    </div>

	</div>
<?php }
endif;



/**
 * Author Options metabox
 * 
 * Callback function to create author options metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'herald_author_options_metabox' ) ) :
	function herald_author_options_metabox( $object, $box ) {
		
		$authors_meta = herald_get_page_meta( $object->ID, 'authors' );
			
		$orderby_options = array(
			'post_count' => __('Post Count', 'herald'),
			'user_name' => __('Username', 'herald') ,
			'display_name' => __('Display Name', 'herald'),
			'user_registered' => __('Register Date', 'herald')
		);
		
		?>
		<div class="herald-opt">
			<div class="herald-opt-title">
				<?php esc_html_e('Order by', 'herald');?>:
			</div>
			<div class="herald-opt-content">
				<?php 
				foreach ($orderby_options as $value => $name): ?>
					<?php $checked = ($authors_meta['orderby'] === $value) ? 'checked' : '' ; ?>
					<input type="radio" class="herald-count-me" name="herald[authors][orderby]" value="<?php echo esc_attr($value); ?>" <?php echo $checked; ?>>
					<label for="herald[authors][orderby]"><?php echo esc_html_e($name, 'herald'); ?></label><br>
				<?php endforeach; ?>
		   	</div>
	    </div>

		<p><strong><?php esc_html_e('Order', 'herald');?></strong></p>
		<input type="radio"  class="herald-count-me" name="herald[authors][order]" value="DESC" <?php checked($authors_meta['order'],'DESC');?>>
		<label for="herald[authors][order]">Descending</label><br>
		<input type="radio" class="herald-count-me" name="herald[authors][order]" value="ASC" <?php checked($authors_meta['order'],'ASC');?>>
		<label for="herald[authors][order]">Ascending</label><br>
		
		<p><strong><?php esc_html_e('Exclude roles','herald');?></strong></p>	
		<?php 
		 	global $wp_roles;
     		$roles = $wp_roles->get_names(); 	

		foreach($roles as $role) : ?>
		  	<input type="checkbox" class="herald-count-me" name="herald[authors][roles][]" value="<?php echo esc_attr($role); ?>" <?php echo (in_array($role, $authors_meta['roles'])) ? 'checked="checked"' : ''; ?>>
			<label for="herald[authors][roles]"><?php echo esc_html_e($role,'herald'); ?></label><br>
		<?php endforeach; ?>

		<p><strong><?php esc_html_e('Exclude by ID','herald');?></strong></p>
		<?php $implode_args = !empty($authors_meta['exclude']) ? implode(',', $authors_meta['exclude']) : '' ?>
		<input type="text" class="herald-count-me" name="herald[authors][exclude]" value="<?php echo esc_attr( $implode_args);?>"><br>
		<small><?php esc_html_e('Enter author IDs separated by comma', 'herald');?></small>
		
	
		<?php 
	}
endif;
?>