<?php

/**
 * Get module defaults
 *
 * @param string  $type Module type
 * @return array Default arguments of a module
 * @since  1.0
 */

if ( !function_exists( 'herald_get_module_defaults' ) ):
	function herald_get_module_defaults( $type = false ) {

		$defaults = array(
			'posts' => array(
				'type' => 'posts',
				'type_name' => esc_html__( 'Posts', 'herald' ),
				'title' => '',
				'hide_title' => 0,
				'title_link' => '',
				'columns' => 12,
				'layout' => 'b',
				'limit' => 10,
				'starter_layout' => 'none',
				'starter_limit' => 1,
				'cat' => array(),
				'cat_child' => 0,
				'cat_inc_exc' => 'in',
				'tag' => array(),
				'tag_inc_exc' => 'in',
				'manual' => array(),
				'time' => 0,
				'order' => 'date',
				'sort' => 'DESC',
				'format' => 0,
				'unique' => 0,
				'slider' => 0,
				'autoplay' => '',
				'cat_nav' => 0,
				'more_text' => '',
				'more_url' => '',
				'css_class' => '',
				'author' => array(),
				'author_inc_exc' => 'in',
				'exclude_by_id' => array(),
				'active' => 1
			),
			'featured' => array(
				'post_type' => 'post',
				'type' => 'featured',
				'type_name' => esc_html__( 'Featured', 'herald' ),
				'title' => '',
				'hide_title' => 0,
				'title_link' => '',
				'layout' => '1',
				'cat' => array(),
				'cat_child' => 0,
				'cat_inc_exc' => 'in',
				'tag' => array(),
				'tag_inc_exc' => 'in',
				'manual' => array(),
				'time' => 0,
				'order' => 'date',
				'sort' => 'DESC',
				'format' => 0,
				'unique' => 0,
				'cat_nav' => 0,
				'more_text' => '',
				'more_url' => '',
				'css_class' => '',
				'author' => array(),
				'author_inc_exc' => 'in',
				'exclude_by_id' => array(),
				'active' => 1
			),

			'cats' => array(
				'type' => 'cats',
				'type_name' => esc_html__( 'Categories', 'herald'),
				'title' => '',
				'hide_title' => 0,
				'title_link' => '',
				'columns' => 12,
				'layout' => 'f',
				'cat' => array(),
				'display_count' => 1,
				'display_icon'	=> 0,
				'count_label'	=> esc_html__( 'articles', 'herald'),
				'css_class' => '',
				'slider' => 0,
				'autoplay' => '',
				'more_text' => '',
				'more_url' => '',
				'active' => 1
			),

			'text' => array(
				'type' => 'text',
				'type_name' => esc_html__( 'Text', 'herald' ),
				'title' => '',
				'hide_title' => 0,
				'title_link' => '',
				'columns' => 12,
				'content' => '',
				'autop' => 0,
				'css_class' => '',
				'active' => 1
			), 
			'authors' => array(
				'type' => 'authors',
				'type_name' => esc_html__( 'Authors', 'herald' ),
				'title' => '',
				'hide_title' => 0,
				'title_link' => '',
				'columns' => 12,
				'layout' => 'col2',
				'limit' => '',
				'authors_number' => '',
				'slider' => 0,
				'autoplay' => '',
				'more_text' => '',
				'more_url' => '',
				'css_class' => '',
				'orderby' => 'post_count', 
				'sort' => 'DESC', 
				'exclude' => '', 
				'roles' => array(),
				'active' => 1
			)

		);

		if ( herald_is_woocommerce_active() ) {

			$defaults['woocommerce'] = array(
				'type' => 'woocommerce',
				'type_name' => esc_html__( 'Products', 'herald' ),
				'title' => '',
				'hide_title' => 0,
				'title_link' => '',
				'columns' => 12,
				'layout' => 'i',
				'limit' => 8,
				'display_price' => 1,
				'display_cat' => 1,
				'cat' => array(),
                'cat_inc_exc' => 'in',
                'tag' => array(),
                'tag_inc_exc' => 'in',
				'manual' => array(),
				'time' => 0,
				'order' => 'date',
				'slider' => 0,
				'autoplay' => '',
				'more_text' => '',
				'more_url' => '',
				'css_class' => '',
				'active' => 1
			);
		}

		$custom_post_types = herald_get_custom_post_types();

		if ( !empty( $custom_post_types ) ) {
			foreach ( $custom_post_types as $custom_post_type ) {
				$defaults[$custom_post_type] = array(
					'type' => $custom_post_type,
					'cpt' => true,
					'type_name' => esc_html__( 'CPT', 'herald' ) . ' '.ucfirst( $custom_post_type ),
					'title' => '',
					'hide_title' => 0,
					'title_link' => '',
					'columns' => 12,
					'layout' => 'b',
					'limit' => 10,
					'tax' => array(),
					'starter_layout' => 'none',
					'starter_limit' => 1,
					'manual' => array(),
					'time' => 0,
					'order' => 'date',
					'sort' => 'DESC',
					'unique' => 0,
					'slider' => 0,
					'autoplay' => '',
					'more_text' => '',
					'more_url' => '',
					'css_class' => '',
					'exclude_by_id' => array(),
					'active' => 1
				);
                $custom_post_type_taxonomies = herald_get_taxonomies( $custom_post_type );
                if(!empty($custom_post_type_taxonomies)){
                    foreach ($custom_post_type_taxonomies as $custom_post_type_taxonomy) {
                        $defaults[$custom_post_type][$custom_post_type_taxonomy['id'] . '_inc_exc'] = 'in';
                    }
                }
			}
		}


		if ( !empty( $type ) && array_key_exists( $type, $defaults ) ) {
			return $defaults[$type];
		}

		return $defaults;

	}
endif;

/**
 * Get module options
 *
 * @param string  $type Module type
 * @return array Options for sepcific module
 * @since  1.0
 */

if ( !function_exists( 'herald_get_module_options' ) ):
	function herald_get_module_options( $type = false ) {

		$options = array(
			'posts' => array(
				'layouts' => herald_get_main_layouts(),
				'starter_layouts' => herald_get_main_layouts( false, true ),
				'columns' => herald_get_module_columns(),
				'cats' => get_categories( array( 'hide_empty' => false, 'number' => 0 ) ),
				'time' => herald_get_time_diff_opts(),
				'order' => herald_get_post_order_opts(),
				'formats' => herald_get_post_format_opts(),
			),

			'featured' => array(
				'layouts' => herald_get_featured_layouts(),
				'cats' => get_categories( array( 'hide_empty' => false, 'number' => 0 ) ),
				'time' => herald_get_time_diff_opts(),
				'order' => herald_get_post_order_opts(),
				'formats' => herald_get_post_format_opts(),
				'post_types' => herald_get_posts_types_with_taxonomies(array('page'))
			),

			'cats' => array(
				'layouts' => herald_get_main_layouts(false, false, array('a', 'a1', 'a2', 'a3', 'b', 'b1', 'd', 'd1', 'e', 'g', 'g1', 'h', 'j')),
				'cats' => get_categories( array( 'hide_empty' => false, 'number' => 0 ) )
			),

			'text' => array(
				'columns' => herald_get_module_columns(),
			),

			'authors' => array(
				'layouts' => herald_get_author_layouts(),
				'time' => herald_get_time_diff_opts(),
			),

		);

		if ( herald_is_woocommerce_active() ) {

			$options['woocommerce'] = array(
				'cats' => get_terms( 'product_cat', array( 'hide_empty' => false, 'number' => 0 ) ),
				'order' => herald_get_product_order_opts(),
				'time' => herald_get_time_diff_opts()
			);

		}

		$custom_post_types = herald_get_custom_post_types();

		if ( !empty( $custom_post_types ) ) {
			foreach ( $custom_post_types as $custom_post_type ) {
				$options[$custom_post_type] = array(
					'layouts' => herald_get_main_layouts(),
					'starter_layouts' => herald_get_main_layouts( false, true ),
					'columns' => herald_get_module_columns(),
					'time' => herald_get_time_diff_opts(),
					'order' => herald_get_post_order_opts(),
					'taxonomies' => herald_get_taxonomies( $custom_post_type )
				);
			}
		}


		if ( !empty( $type ) && array_key_exists( $type, $options ) ) {
			return $options[$type];
		}

		return $options;

	}
endif;



/**
 * Get module layout
 *
 * Functions gets current post layout for specific module
 *
 * @param array   $module Module data
 * @param int     $i      index of current post
 * @return string id of current layout
 * @since  1.0
 */

if ( !function_exists( 'herald_get_module_layout' ) ):
	function herald_get_module_layout( $module, $i ) {

		if ( herald_module_is_slider( $module ) ) {

			return $module['layout'];

		} else if ( isset( $module['starter_layout'] ) && $module['starter_layout'] != 'none' &&  $i < absint( $module['starter_limit'] ) ) {

				return $module['starter_layout'];
			}

		return $module['layout'];
	}
endif;

/**
 * Is module slider
 *
 * Check if slider is applied to module
 *
 * @param array   $module Module data
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'herald_module_is_slider' ) ):
	function herald_module_is_slider( $module ) {

		if ( isset( $module['slider'] ) && !empty( $module['slider'] ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Is module combined
 *
 * Check if module has starter posts
 *
 * @param array   $module Module data
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'herald_module_is_combined' ) ):
	function herald_module_is_combined( $module ) {

		if ( isset( $module['starter_layout'] ) && $module['starter_layout'] != 'none' && !empty( $module['starter_limit'] ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Is module paginated
 *
 * Check if current module has a pagination
 *
 * @param unknown $i current section index
 * @param unknown $j current module index
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'herald_module_is_paginated' ) ):
	function herald_module_is_paginated( $i, $j ) {
		global $herald_module_pag_index;

		if ( !empty( $herald_module_pag_index ) && $herald_module_pag_index['s_ind'] == $i && $herald_module_pag_index['m_ind'] == $j ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Set paginated module index
 *
 * Get last posts module index so we know to which module we should apply pagination
 * and set indexes to $herald_module_pag_index global var
 *
 * @param array   $sections Sections data array
 * @return void
 * @since  1.0
 */

if ( !function_exists( 'herald_set_paginated_module_index' ) ):
	function herald_set_paginated_module_index( $sections, $paged = false ) {

		global $herald_module_pag_index;

		//If we are on paginated modules page it shows only one section and module so index is set to "0"
		if ( $paged ) {

			$herald_module_pag_index = array( 's_ind' => 0, 'm_ind' => 0 );

		} else {

			$last_section_index = false;
			$last_module_index = false;
			foreach ( $sections as $m => $section ) {
				if ( !empty( $section['modules'] ) ) {
					foreach ( $section['modules'] as $n => $module ) {
						if ( $module['type'] == 'posts' ) {
							$last_section_index = $m;
							$last_module_index = $n;
						}
					}
				}
			}

			if ( $last_section_index !== false && $last_module_index !== false ) {
				$herald_module_pag_index = array( 's_ind' => $last_section_index, 'm_ind' => $last_module_index );
			}
		}
	}
endif;

/**
 * Module template is paged
 *
 * Check if we are on paginated modules page
 *
 * @return int|false
 * @since  1.0
 */

if ( !function_exists( 'herald_module_template_is_paged' ) ):
	function herald_module_template_is_paged() {
		$curr_page = is_front_page() ? absint( get_query_var( 'page' ) ) : absint( get_query_var( 'paged' ) );
		return $curr_page > 1 ? $curr_page : false;
	}
endif;


/**
 * Parse paged module template
 *
 * When we are on paginated module page
 * pull only the last posts module and its section
 * but check queries for other modules in other sections
 *
 * @param array   $sections existing sections data
 * @return array parsed new section data
 * @since  1.0
 */

if ( !function_exists( 'herald_parse_paged_module_template' ) ):
	function herald_parse_paged_module_template( $sections ) {

		foreach ( $sections as $s_ind => $section ) {
			if ( !empty( $section['modules'] ) ) {
				foreach ( $section['modules'] as $m_ind => $module ) {

					$module = herald_parse_args( $module, herald_get_module_defaults( $module['type'] ) );

					if ( $module['type'] == 'posts' ) {

						if ( herald_module_is_paginated( $s_ind, $m_ind ) ) {

							$new_sections = array( 0 => $section );
							$module['starter_layout'] = 'none';
							$new_sections[0]['modules'] = array( 0 => $module );
							return $new_sections;

						} else {

							if ( $module['unique'] ) {
								herald_get_module_query( $module );
							}
						}

					} else if ( $module['type'] == 'featured' ) {

							if ( $module['unique'] ) {
								herald_get_featured_module_query( $module );
							}
						}
				}
			}
		}

	}
endif;




/**
 * Get module heading
 *
 * Function gets heading/title html for current module
 *
 * @param array   $module Module data
 * @return string HTML output
 * @since  1.0
 */

if ( !function_exists( 'herald_get_module_heading' ) ):
	function herald_get_module_heading( $module ) {

		$args = array();
		$sub_cats = array();

		if ( !empty( $module['cat'] ) && count( $module['cat'] ) == 1 && $module['cat_inc_exc'] == 'in') {
			$args['cat'] = $module['cat'][0];
		}

		if ( isset( $args['cat'] ) && isset( $module['cat_nav'] ) && !empty( $module['cat_nav'] ) ) {
			$sub_cats = get_categories( array( 'parent' => $args['cat'], 'hide_empty' => false ) );
			if ( !empty( $sub_cats ) ) {
				$args['subnav'] = '';
				foreach ( $sub_cats as $child ) {
					$args['subnav'] .= '<a href="'.esc_url( get_category_link( $child ) ).'">'.$child->name.'</a>';
				}
			}
		}

		if ( !empty( $module['title'] ) && empty( $module['hide_title'] ) ) {

			$icon_responsive_class = !empty( $sub_cats ) ? 'herald-mobile-hidden' : '';

			if ( !empty( $module['title_link'] ) ) {
				$module['title'] = '<a href="'.esc_url( $module['title_link'] ).'">'.$module['title'].'<i class="fa fa-chevron-right '.$icon_responsive_class.'"></i></a>';
			}

			if ( !empty( $sub_cats ) ) {
				$module['title'] .= '<i class="fa fa-angle-down herald-sub-cat-icon" aria-hidden="true"></i><div class="herald-mod-subnav-mobile">'.$args['subnav'].'</div>';
			}

			$args['title'] = '<h2 class="h6 herald-mod-h herald-color">'.$module['title'].'</h2>';

		}

		$args['actions'] = '';

		if ( isset( $module['more_text'] ) && !empty( $module['more_text'] ) && !empty( $module['more_url'] ) ) {
			$args['actions'].= '<a class="herald-all-link" href="'.esc_url( $module['more_url'] ).'">'.$module['more_text'].'</a>';
		}

		if ( herald_module_is_slider( $module ) ) {
			$args['actions'].= '<div class="herald-slider-controls" data-col="'.esc_attr( herald_layout_columns( $module['layout'] ) ).'" data-autoplay="'.absint( $module['autoplay'] ).'"></div>';
		}

		return !empty( $args ) ? herald_print_heading( $args ) : '';

	}
endif;

/**
 * Get module query
 *
 * @param array   $module Module data
 * @return object WP_query
 * @since  1.0
 */

if ( !function_exists( 'herald_get_module_query' ) ):
	function herald_get_module_query( $module, $paged = false ) {

		global $herald_unique_module_posts;

		$module = wp_parse_args( $module, herald_get_module_defaults( $module['type'] ) );

		$args['ignore_sticky_posts'] = 1;

		if ( !empty( $module['manual'] ) ) {

			$args['posts_per_page'] = absint( count( $module['manual'] ) );
			$args['orderby'] =  'post__in';
			$args['post__in'] =  $module['manual'];
			$args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			$args['post_type'] = 'post';
			$args['posts_per_page'] = absint( $module['limit'] );

			if ( !empty( $module['cat'] ) ) {

				if ( $module['cat_child'] ) {
					$child_cat_temp = array();
					foreach ( $module['cat'] as $parent ) {
						$child_cats = get_categories( array( 'child_of' => $parent ) );
						if ( !empty( $child_cats ) ) {
							foreach ( $child_cats as $child ) {
								$child_cat_temp[] = $child->term_id;
							}
						}
					}
					$module['cat'] = array_merge( $module['cat'], $child_cat_temp );
				}

				$args['category__'.$module['cat_inc_exc']] = $module['cat'];
			}

			if ( !empty( $module['tag'] ) ) {
				$args['tag__'.$module['tag_inc_exc']] = herald_get_tax_term_id_by_slug( $module['tag'] );
			}

			if ( !empty( $module['author'] ) ) {
				$args['author__'.$module['author_inc_exc']] = $module['author'];
			}

			if ( !empty( $module['format'] ) ) {

				if ( $module['format'] == 'standard' ) {

					$terms = array();
					$formats = get_theme_support( 'post-formats' );
					if ( !empty( $formats ) && is_array( $formats[0] ) ) {
						foreach ( $formats[0] as $format ) {
							$terms[] = 'post-format-'.$format;
						}
					}
					$operator = 'NOT IN';

				} else {
					$terms = array( 'post-format-'.$module['format'] );
					$operator = 'IN';
				}

				$args['tax_query'] = array(
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => $terms,
						'operator' => $operator
					)
				);
			}

			$args['orderby'] = $module['order'];

			if ( $args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {

				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = ev_get_meta_key();

			} else if ( strpos( $args['orderby'], 'reviews' ) !== false && herald_is_wp_review_active() ) {

				if ( strpos( $args['orderby'], 'user' ) !== false ) {
					
					$review_type = substr( $args['orderby'], 13, strlen( $args['orderby'] ) );

					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = 'wp_review_user_reviews';

					$args['meta_query'] = array(
						array(
							'key'     => 'wp_review_user_review_type',
							'value'   => $review_type,
						)
					);

				} else {

					$review_type = substr( $args['orderby'], 8, strlen( $args['orderby'] ) );

					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = 'wp_review_total';

					$args['meta_query'] = array(
						array(
							'key'     => 'wp_review_type',
							'value'   => $review_type,
						)
					);
				}

			} 
			

			$args['order'] = $module['sort'];

			if ( $time_diff = $module['time'] ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', herald_calculate_time_diff( $time_diff ) ) );
			}

			if ( !empty( $herald_unique_module_posts ) ) {
				$args['post__not_in'] = $herald_unique_module_posts;
			}

			if ( !empty( $module['exclude_by_id'] ) ) {

				if ( !empty( $args['post__not_in'] ) ) {
					$args['post__not_in'] = array_unique( array_merge( $args['post__not_in'], $module['exclude_by_id'] ) ) ;
				} else {
					$args['post__not_in'] = $module['exclude_by_id'];
				}
			}


		}

		if ( $paged ) {
			$args['paged'] = $paged;
		}

		$args = apply_filters('herald_modify_module_query_args', $args ); //Allow child themes or plugins to modify

		$query = new WP_Query( $args );

		if ( $module['unique'] && !is_wp_error( $query ) && !empty( $query ) ) {

			foreach ( $query->posts as $p ) {
				$herald_unique_module_posts[] = $p->ID;
			}
		}

		return $query;

	}
endif;

/**
 * Get featured module query
 *
 * @param array   $module Module data
 * @return object WP_query
 * @since  1.0
 */

if ( !function_exists( 'herald_get_featured_module_query' ) ):
	function herald_get_featured_module_query( $module ) {

		global $herald_unique_module_posts;

		$module = wp_parse_args( $module, herald_get_module_defaults( $module['type'] ) );

		$args['ignore_sticky_posts'] = 1;

		if ( !empty( $module['manual'] ) ) {

			$args['orderby'] =  'post__in';
			$args['post__in'] =  $module['manual'];
			$args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			$args['post_type'] = $module['post_type'];
			$post_type_with_taxonomies = herald_get_post_type_with_taxonomies($module['post_type']);
			$args['posts_per_page'] = absint( herald_get_featured_area_numposts( $module['layout'] ) );
			
			if(!empty($post_type_with_taxonomies->taxonomies)){
				foreach ( $post_type_with_taxonomies->taxonomies as $taxonomy ) {
					$taxonomy_id = herald_patch_taxonomy_id($taxonomy['id']);
					
					if(empty($module[$taxonomy_id . '_inc_exc']) || empty($module[$taxonomy_id])){
						continue;
					}
					
					$operator = $module[$taxonomy_id . '_inc_exc'] === 'not_in' ? 'NOT IN' : 'IN';
					
					if($taxonomy['hierarchical']){
						$include_children = !empty($module[$taxonomy_id . '_child']) ? boolval($module[$taxonomy_id . '_child']) : false;
						$args['tax_query'][] = array(
							'taxonomy' => $taxonomy['id'],
							'field'    => 'id',
							'terms'    => $module[$taxonomy_id],
							'operator' => $operator,
							'include_children' => $include_children
						);
					}else{
						$args['tax_query'][] = array(
							'taxonomy' => $taxonomy['id'],
							'field'    => 'id',
							'terms'    => herald_get_tax_term_id_by_slug( $module[$taxonomy_id], $taxonomy['id']),
							'operator' => $operator
						);
					}
				}
			}

			if ( !empty( $module['author'] ) ) {
				$args['author__'.$module['author_inc_exc']] = $module['author'];
			}

			if ( !empty( $module['format'] ) && $module['post_type'] == 'post' ) {

				if ( $module['format'] == 'standard' ) {

					$terms = array();
					$formats = get_theme_support( 'post-formats' );
					if ( !empty( $formats ) && is_array( $formats[0] ) ) {
						foreach ( $formats[0] as $format ) {
							$terms[] = 'post-format-'.$format;
						}
					}
					$operator = 'NOT IN';

				} else {
					$terms = array( 'post-format-'.$module['format'] );
					$operator = 'IN';
				}

				$args['tax_query'][] =
					array(
						'taxonomy' => 'post_format',
						'field'    => 'slug',
						'terms'    => $terms,
						'operator' => $operator
					);
			}

			$args['orderby'] = $module['order'];

			if ( $args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = ev_get_meta_key();
			} else if ( strpos( $args['orderby'], 'reviews' ) !== false && herald_is_wp_review_active() ) {

				if ( strpos( $args['orderby'], 'user' ) !== false ) {
					
					$review_type = substr( $args['orderby'], 13, strlen( $args['orderby'] ) );

					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = 'wp_review_user_reviews';

					$args['meta_query'] = array(
						array(
							'key'     => 'wp_review_user_review_type',
							'value'   => $review_type,
						)
					);

				} else {

					$review_type = substr( $args['orderby'], 8, strlen( $args['orderby'] ) );

					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = 'wp_review_total';

					$args['meta_query'] = array(
						array(
							'key'     => 'wp_review_type',
							'value'   => $review_type,
						)
					);
				}

			}

			$args['order'] = $module['sort'];

			if ( $time_diff = $module['time'] ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', herald_calculate_time_diff( $time_diff ) ) );
			}

			if ( !empty( $herald_unique_module_posts ) ) {
				$args['post__not_in'] = $herald_unique_module_posts;
			}

			if ( !empty( $module['exclude_by_id'] ) ) {

				if ( !empty( $args['post__not_in'] ) ) {
					$args['post__not_in'] = array_unique( array_merge( $args['post__not_in'], $module['exclude_by_id'] ) ) ;
				} else {
					$args['post__not_in'] = $module['exclude_by_id'];
				}
			}
		}

		$args = apply_filters('herald_modify_featured_module_query_args', $args ); //Allow child themes or plugins to modify

		$query = new WP_Query( $args );

		if ( $module['unique'] && !is_wp_error( $query ) && !empty( $query ) ) {

			foreach ( $query->posts as $p ) {
				$herald_unique_module_posts[] = $p->ID;
			}
		}

		return $query;

	}
endif;

/**
 * Get module products query
 *
 * @param array   $module Module data
 * @return object WP_query
 * @since  1.0
 */

if ( !function_exists( 'herald_get_module_products_query' ) ):
	function herald_get_module_products_query( $module ) {

		$module = wp_parse_args( $module, herald_get_module_defaults( $module['type'] ) );

		$args['ignore_sticky_posts'] = 1;

		if ( !empty( $module['manual'] ) ) {

			$args['posts_per_page'] = absint( count( $module['manual'] ) );
			$args['orderby'] =  'post__in';
			$args['post__in'] =  $module['manual'];
			$args['post_type'] = 'product';

		} else {

			$args['post_type'] = 'product';
			$args['posts_per_page'] = absint( $module['limit'] );

			$args['tax_query'] = array();

			if ( !empty( $module['cat'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $module['cat'],
                    'operator' => $module["cat_inc_exc"] == 'not_in' ? 'NOT IN' : 'IN'
				);
			}

			if ( !empty( $module['tag'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_tag',
					'field'    => 'slug',
					'terms'    => $module['tag'],
                    'operator' => $module["tag_inc_exc"] == 'not_in' ? 'NOT IN' : 'IN'
				);
			}

			if ( count( $args['tax_query'] ) > 1 ) {
				$args['tax_query']['relation'] = 'AND';
			}

			$args['orderby'] = $module['order'];

			if ( $args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = ev_get_meta_key();
			}

			if ( $time_diff = $module['time'] ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', herald_calculate_time_diff( $time_diff ) ) );
			}

		}

		$args = apply_filters('herald_modify_products_module_query_args', $args ); //Allow child themes or plugins to modify

		$query = new WP_Query( $args );

		return $query;

	}
endif;

/**
 * Get module cpt query
 *
 * @param array   $module Module data
 * @return object WP_query
 * @since  1.6
 */

if ( !function_exists( 'herald_get_module_cpt_query' ) ):
	function herald_get_module_cpt_query( $module, $paged = false ) {

		global $herald_unique_module_posts;

		$module = wp_parse_args( $module, herald_get_module_defaults( $module['type'] ) );

		$args['ignore_sticky_posts'] = 1;

		if ( !empty( $module['manual'] ) ) {
			$args['posts_per_page'] = absint( count( $module['manual'] ) );
			$args['orderby'] =  'post__in';
			$args['post__in'] =  $module['manual'];
			$args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			$args['post_type'] = $module['type'];
			$args['posts_per_page'] = absint( $module['limit'] );

			$args['orderby'] = $module['order'];

			if ( $args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {

				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = ev_get_meta_key();

			} else if ( strpos( $args['orderby'], 'reviews' ) !== false && herald_is_wp_review_active() ) {

				if ( strpos( $args['orderby'], 'user' ) !== false ) {
					
					$review_type = substr( $args['orderby'], 13, strlen( $args['orderby'] ) );

					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = 'wp_review_user_reviews';

					$args['meta_query'] = array(
						array(
							'key'     => 'wp_review_user_review_type',
							'value'   => $review_type,
						)
					);

				} else {

					$review_type = substr( $args['orderby'], 8, strlen( $args['orderby'] ) );

					$args['orderby'] = 'meta_value_num';
					$args['meta_key'] = 'wp_review_total';

					$args['meta_query'] = array(
						array(
							'key'     => 'wp_review_type',
							'value'   => $review_type,
						)
					);
				}

			}

			$args['order'] = $module['sort'];

			if ( $time_diff = $module['time'] ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', herald_calculate_time_diff( $time_diff ) ) );
			}

			if ( !empty( $herald_unique_module_posts ) ) {
				$args['post__not_in'] = $herald_unique_module_posts;
			}

			if ( !empty( $module['exclude_by_id'] ) ) {

				if ( !empty( $args['post__not_in'] ) ) {
					$args['post__not_in'] = array_unique( array_merge( $args['post__not_in'], $module['exclude_by_id'] ) ) ;
				} else {
					$args['post__not_in'] = $module['exclude_by_id'];
				}
			}

			if ( !empty( $module['tax'] ) ) {
				$taxonomies = array();
				foreach ( $module['tax'] as $k => $v ) {
					$temp = array();
					$temp['fields'] = 'id';
					$temp['taxonomy'] = $k;
					$temp['terms'] = $v;
                    $temp['operator'] = $module["{$k}_inc_exc"] == 'not_in' ? 'NOT IN' : 'IN';
					$taxonomies[] = $temp;
				}

				$args['tax_query'] = $taxonomies;
			}
		}

		if ( $paged ) {
			$args['paged'] = $paged;
		}

		$args = apply_filters('herald_modify_cpt_module_query_args', $args ); //Allow child themes or plugins to modify

		$query = new WP_Query( $args );

		if ( $module['unique'] && !is_wp_error( $query ) && !empty( $query ) ) {

			foreach ( $query->posts as $p ) {
				$herald_unique_module_posts[] = $p->ID;
			}
		}

		return $query;

	}
endif;

/**
 * Get layout columns
 *
 * @param string  $layout Layout ID
 * @return int Bootsrap col-lg ID
 * @since  1.0
 */

if ( !function_exists( 'herald_layout_columns' ) ):
	function herald_layout_columns( $layout ) {

		$layouts = array(
			'a' => 12,
			'a1' => 12,
			'a2' => 12,
			'a3' => 12,
			'col1' => 12,
			'b' => 12,
			'b1' => 12,
			'col2' => 6,
			'c' => 6,
			'c1' =>  6,
			'd' =>  6,
			'd1' =>  6,
			'e' =>  6,
			'f' =>  4,
			'f1' =>  4,
			'g' =>  4,
			'g1' =>  4,
			'col3' => 4,
			'h' =>  4,
			'i' =>  3,
			'i1' => 3,
			'j' =>  3,
			'k' =>  2,
			'l' => 2
		);

		$layouts = apply_filters('herald_modify_layout_columns', $layouts ); //Allow child themes or plugins to modify
		return $layouts[$layout];

	}
endif;


/**
 * Check if we need to apply eq height class to specific posts module
 *
 * @param array   $module
 * @return bool
 * @since  1.3
 */

if ( !function_exists( 'herald_module_is_eq_height' ) ):
	function herald_module_is_eq_height( $module ) {

		if ( !herald_module_is_combined( $module ) ) {
			return true;
		}

		if ( ( herald_layout_columns( $module['starter_layout'] ) * $module['starter_limit'] ) % $module['columns'] ) {
			return false;
		}

		return true;

	}
endif;


/**
 * Get module css classes
 *
 * @param array   $module
 * @return string
 * @since  1.5.2
 */

if ( !function_exists( 'herald_get_module_class' ) ):
	function herald_get_module_class( $module ) {

		$class = '';

		if ( $module['type'] == 'featured' ) {
			$class = 'col-lg-12 col-md-12 col-sm-12';
		} else {
			$class = 'col-lg-' . $module['columns'] . ' col-md-' . $module['columns'] .' col-sm-' . $module['columns'];
		}

		if ( !empty( $module['css_class'] ) ) {
			$class .= ' ' . $module['css_class'];
		}

		return $class;

	}
endif;

/**
 * Get posts from manually selected field in modules  
 *
 * @since  1.9 
 *
 * @param srting $post_ids - Selected posts ids from choose manually meta field
 * @return array - List of selected posts or empty list
 */
if ( !function_exists( 'herald_get_manually_selected_posts' ) ):
	function herald_get_manually_selected_posts( $post_ids, $module_type = 'posts' ) {
		
		if ( empty($post_ids) ) {
			return array();
		}

		$post_type = in_array($module_type, array('posts', 'featured')) ? array_keys( get_post_types( array( 'public' => true ) ) ) : $module_type;

		$get_selected_posts = get_posts( 
			array(
				'post__in' => $post_ids, 
				'orderby' => 'post__in', 
				'post_type' => $post_type,
				'posts_per_page' => '-1'
			) 
		);

		return wp_list_pluck( $get_selected_posts, 'post_title', 'ID' );
	}
endif;


/**
 * Display manualy selected posts  
 *
 * @since  1.9 
 *
 * @param array $posts - Array of manualy selected posts
 * @return HTML - Title of manualy selected post
 */
if ( !function_exists( 'herald_display_manually_selected_posts' ) ):
	function herald_display_manually_selected_posts($posts) {
		
		if ( empty($posts) ) {
			return;
		}

		$output = '';
	 	foreach ( $posts as $id => $title ){
			$output .= '<span><button type="button" class="ntdelbutton" data-id="'. esc_attr($id) .'"><span class="remove-tag-icon"></span></button><span class="herald-searched-title">'. esc_html( $title ). '</span></span>';
		} 

		echo $output;
	}
endif;

/**
 * Used for getting post types with all taxonomies
 *
 * @return array
 * @since    2.0.1
 */
if (!function_exists('herald_get_posts_types_with_taxonomies')):
	function herald_get_posts_types_with_taxonomies( $exclude = array() ) {
		
		$post_types_with_taxonomies = array();
		
		$post_types = herald_get_custom_post_types( true, array( 'topic', 'forum', 'guest-author', 'reply' ) );
		$post_types[] = get_post_type_object('post');
		
		if (empty($post_types))
			return null;
		
		foreach ($post_types as $post_type) {
			if(in_array($post_type->name, $exclude)){
				continue;
			}
			
			$post_taxonomies = herald_get_taxonomies($post_type->name);
			
			$post_type->taxonomies = $post_taxonomies;
			$post_types_with_taxonomies[] = $post_type;
		}
		
		return apply_filters('herald_modify_posts_types_with_taxonomies', $post_types_with_taxonomies);
	}
endif;


/**
 * Now when taxonomies are dynamical in cover area depending on post type we have to overwrite old settings.
 * For Category to cat and for post_tag to tag
 *
 * @string $taxonomy_id
 * @since 1.7
 * @return $taxonomy_id
 */
if(!function_exists('herald_patch_category_and_tags')):
	function herald_patch_taxonomy_id($taxonomy_id){
		
		if ( in_array( $taxonomy_id, array( 'category', 'post_tag' ) ) ) {
			if ( $taxonomy_id === 'category' ) {
				$taxonomy_id = 'cat';
			}
			if ( $taxonomy_id === 'post_tag' ) {
				$taxonomy_id = 'tag';
			}
		}
		
		return $taxonomy_id;
	}
endif;
?>
