<?php

/**
 * Debug (log) function
 *
 * Outputs any content into log file in theme root directory
 *
 * @param mixed   $mixed Content to output
 * @return void
 * @since  1.0
 */

if ( !function_exists( 'herald_log' ) ):
	function herald_log( $mixed ) {

		if ( is_array( $mixed ) ) {
			$mixed = print_r( $mixed, 1 );
		} else if ( is_object( $mixed ) ) {
				ob_start();
				var_dump( $mixed );
				$mixed = ob_get_clean();
			}

		$handle = fopen( get_template_directory() . '/log', 'a' );
		fwrite( $handle, $mixed . PHP_EOL );
		fclose( $handle );
	}
endif;

/**
 * Get option value from theme options
 *
 * A wrapper function for WordPress native get_option()
 * which gets an option from specific option key (set in theme options panel)
 *
 * @param string  $option Name of the option
 * @return mixed Specific option value or "false" (if option is not found)
 * @since  1.0
 */

if ( !function_exists( 'herald_get_option' ) ):
	function herald_get_option( $option ) {

		global $herald_settings;

		if ( empty( $herald_settings ) ) {
			$herald_settings = get_option( 'herald_settings' );
		}

		if ( isset( $herald_settings[$option] ) ) {
			return is_array( $herald_settings[$option] ) && isset( $herald_settings[$option]['url'] ) ? $herald_settings[$option]['url'] : $herald_settings[$option];
		} else {
			return false;
		}

	}
endif;

/**
 * Get current post layout
 *
 * It checks which posts layout to display based on current template options
 *
 * @param int     $i Index of the current post in loop
 * @return string Layout ID
 * @since  1.0
 */

if ( !function_exists( 'herald_get_current_post_layout' ) ):
	function herald_get_current_post_layout( $i ) {

		$layout = 'a'; //layout a as default
		$starter_limit = 0; //do not display starter layout by default

		$herald_template = herald_detect_template();

		if ( in_array( $herald_template, array( 'search', 'tag', 'author', 'archive' ) ) ) {

			$layout = herald_get_option( $herald_template.'_layout' );
			$starter_layout = herald_get_option( $herald_template.'_starter_layout' );
			$starter_limit = $starter_layout != 'none' ? herald_get_option( $herald_template.'_starter_limit' ) : 0;

		} else if ( $herald_template == 'category' ) {

				$obj = get_queried_object();

				if ( isset( $obj->term_id ) ) {

					$meta = herald_get_category_meta( $obj->term_id );
					$layout = $meta['layout'] == 'inherit' ? herald_get_option( $herald_template.'_layout' ) : $meta['layout'];

					if ( $meta['starter_layout'] != 'inherit' ) {
						$starter_layout = $meta['starter_layout'];
						$starter_limit = $starter_layout != 'none' ? $meta['starter_limit'] : 0;
					} else {
						$starter_layout = herald_get_option( $herald_template.'_starter_layout' );
						$starter_limit = $starter_layout != 'none' ? herald_get_option( $herald_template.'_starter_limit' ) : 0;
					}

				}
			}

		if ( !is_paged() && $starter_limit > $i ) {
			return $starter_layout;
		}

		return $layout;
	}
endif;


/**
 * Get layout of single post
 *
 * It checks which layout to display for current single post
 *
 * @return string Layout ID
 * @since  1.0
 */

if ( !function_exists( 'herald_get_single_layout' ) ):
	function herald_get_single_layout( $post_id = false ) {

		$layout = herald_get_post_meta( $post_id, 'layout' );
		if ( $layout == 'inherit' ) {
			$layout = herald_get_option( 'single_layout' );
		}

		if ( herald_is_paginated_post() && in_array( $layout, array( 3, 6, 9 ) ) ) {
			$layout -= 1;
		}

		return $layout;
	}
endif;

/**
 * Get position of meta bar for single post
 *
 * It checks which layout to display for current single post
 *
 * @return string Layout ID
 * @since  1.3
 */

if ( !function_exists( 'herald_get_single_meta_bar_position' ) ):
	function herald_get_single_meta_bar_position() {

		$layout = herald_get_post_meta( get_the_ID(), 'meta_bar_position' );
		if ( $layout == 'inherit' ) {
			$layout = herald_get_option( 'single_meta_bar_position' );
		}

		return $layout;
	}
endif;


/**
 * Get layout for page
 *
 * It checks which layout to display for current page
 *
 * @return string Layout ID
 * @since  1.0
 */

if ( !function_exists( 'herald_get_page_layout' ) ):
	function herald_get_page_layout( $post_id = false ) {

		$layout = herald_get_page_meta( $post_id, 'layout' );

		if ( $layout == 'inherit' ) {
			$layout = herald_get_option( 'page_layout' );
		}

		return $layout;
	}
endif;



/**
 * Get post meta data
 *
 * @param unknown $field specific option key
 * @return mixed meta data value or set of values
 * @since  1.0
 */

if ( !function_exists( 'herald_get_post_meta' ) ):
	function herald_get_post_meta( $post_id = false, $field = false ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$defaults = array(
			'layout' => 'inherit',
			'use_sidebar' => 'inherit',
			'sidebar' => 'inherit',
			'sticky_sidebar' => 'inherit',
			'meta_bar_position' => 'inherit',
			'display' => array(
				'fimg' => 'inherit',
				'headline' => 'inherit',
				'tags' => 'inherit',
				'author' => 'inherit',
				'sticky_bar' => 'inherit',
				'related' => 'inherit',
				'ad_above' => 1,
				'ad_below'	=> 1
			)
		);

		$meta = get_post_meta( $post_id, '_herald_meta', true );
		$meta = herald_parse_args( $meta, $defaults );


		if ( $field ) {
			if ( isset( $meta[$field] ) ) {
				return $meta[$field];
			} else {
				return false;
			}
		}

		return $meta;
	}
endif;


/**
 * Get page meta data
 *
 * @param unknown $field specific option key
 * @return mixed meta data value or set of values
 * @since  1.0
 */

if ( !function_exists( 'herald_get_page_meta' ) ):
	function herald_get_page_meta( $post_id = false, $field = false ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$defaults = array(
			'layout' => 'inherit',
			'use_sidebar' => 'inherit',
			'sidebar' => 'inherit',
			'sticky_sidebar' => 'inherit',
			'sections' => array(),
			'pag' => 'none',
			'authors' => array(
				'orderby' => 'post_count', 
				'order' => 'DESC', 
				'exclude' => '', 
				'roles' => array()
			),
		);

		$meta = get_post_meta( $post_id, '_herald_meta', true );
		$meta = herald_parse_args( $meta, $defaults );


		if ( $field ) {
			if ( isset( $meta[$field] ) ) {
				return $meta[$field];
			} else {
				return false;
			}
		}

		return $meta;
	}
endif;


/**
 * Get category meta data
 *
 * @param unknown $field specific option key
 * @return mixed meta data value or set of values
 * @since  1.0
 */

if ( !function_exists( 'herald_get_category_meta' ) ):
	function herald_get_category_meta( $cat_id = false, $field = false ) {
		$defaults = array(
			'layout' => 'inherit',
			'use_sidebar' => 'inherit',
			'sidebar' => 'inherit',
			'sticky_sidebar' => 'inherit',
			'starter_layout' => 'inherit',
			'starter_limit' => herald_get_option( 'category_starter_limit' ),
			'fa_layout' => 'inherit',
			'color_type' => 'inherit',
			'color' => herald_get_option( 'color_content_acc' ),
			'pag' => 'inherit',
			'ppp' => 'inherit',
			'ppp_num' => herald_get_option( 'category_ppp' ) == 'inherit' ? get_option( 'posts_per_page' ) : herald_get_option( 'category_ppp_num' ),
			'image' => ''
		);

		if ( $cat_id ) {
			$meta = get_option( '_herald_category_'.$cat_id );
			$meta = wp_parse_args( (array) $meta, $defaults );
		} else {
			$meta = $defaults;
		}

		if ( $field ) {
			if ( isset( $meta[$field] ) ) {
				return $meta[$field];
			} else {
				return false;
			}
		}

		return $meta;
	}
endif;

/**
 * Get current pagination
 *
 * It checks which pagination type to display based on current template options
 *
 * @return string|bool Pagination layout or false if there is no pagination
 * @since  1.0
 */

if ( !function_exists( 'herald_get_current_pagination' ) ):
	function herald_get_current_pagination() {

		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return false;
		}

		$layout = 'numeric'; //layout numeric as default

		$herald_template = herald_detect_template();

		if ( in_array( $herald_template, array( 'search', 'tag', 'author', 'archive' ) ) ) {

			$layout = herald_get_option( $herald_template.'_pag' );

		} else if ( $herald_template == 'category' ) {

				$obj = get_queried_object();

				if ( isset( $obj->term_id ) ) {
					$meta = herald_get_category_meta( $obj->term_id );
					$layout = $meta['pag'] == 'inherit' ? herald_get_option( $herald_template.'_pag' ) : $meta['pag'];
				}

			}

		return $layout;
	}
endif;

/**
 * Numeric pagination
 *
 * @param string  $prev Previous link text
 * @param string  $next Next link text
 * @return string Pagination HTML output or empty string
 * @since  1.0
 */

if ( !function_exists( 'herald_numeric_pagination' ) ):
	function herald_numeric_pagination( $prev = '&lsaquo;', $next = '&rsaquo;' ) {
		global $wp_query, $wp_rewrite;
		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
		$pagination = array(
			'base' => @add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'prev_text' => $prev,
			'next_text' => $next,
			'type' => 'plain'
		);
		if ( $wp_rewrite->using_permalinks() )
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

		if ( !empty( $wp_query->query_vars['s'] ) )
			$pagination['add_args'] = array( 's' => str_replace( ' ', '+', get_query_var( 's' ) ) );

		$links = paginate_links( $pagination );

		return empty( $links ) ? '' : $links;
	}
endif;


/**
 * Get author social links
 *
 * @param int     $author_id ID of an author/user
 * @return string HTML output of social links
 * @since  1.0
 */

if ( !function_exists( 'herald_get_author_social' ) ):
	function herald_get_author_social( $author_id ) {

		$output = '';

		if ( $url = get_the_author_meta( 'url', $author_id ) ) {
			$output .= '<a href="'.esc_url( $url ).'" target="_blank" class="fa fa-link"></a>';
		}

		$social = herald_get_social();

		if ( !empty( $social ) ) {
			foreach ( $social as $id => $name ) {
				if ( $social_url = get_the_author_meta( $id,  $author_id ) ) {

					if ( $id == 'twitter' ) {
						$pos = strpos( $social_url, '@' );
						if($pos !== false){
							$social_url = 'https://twitter.com/'.substr( $social_url, $pos, strlen( $social_url ) );
						}
					}

					$output .=  '<a href="'.esc_url( $social_url ).'" target="_blank" class="fa fa-'.$id.'"></a>';
				}
			}
		}

		return $output;
	}
endif;


/**
 * Get trending posts
 *
 * @return object WP_Query
 * @since  1.0
 */

if ( !function_exists( 'herald_get_trending_posts' ) ):
	function herald_get_trending_posts( $post_id = false ) {

		$args['ignore_sticky_posts'] = 1;

		$manual = herald_get_option( 'trending_manual' );

		if ( !empty( $manual ) ) {

			$manual = array_map( 'absint', explode( ",", $manual ) );
			$args['posts_per_page'] = absint( count( $manual ) );
			$args['orderby'] =  'post__in';
			$args['post__in'] =  $manual;
			$args['post_type'] = array_keys( get_post_types( array( 'public' => true ) ) ); //support all existing public post types

		} else {

			$number_of_posts =  herald_get_option('trending_slider') == true ? herald_get_option('trending_slider_post') : herald_get_option('trending_number');

			$args['post_type'] = 'post';
			$args['posts_per_page'] = $number_of_posts;
			$args['orderby'] = herald_get_option( 'trending_order' );

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

			$cat = herald_get_option( 'trending_cat' );
			if ( is_array( $cat ) ) {
				$cat = array_keys( array_filter( $cat ) );
				if ( !empty( $cat ) ) {
					$args['category__in'] = $cat;
				}
			}

			$tag = herald_get_option( 'trending_tag' );
			if ( !empty( $tag ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'terms'    => $tag,
					)
				);
			}

			if ( $time_diff = herald_get_option( 'trending_time' ) ) {
				$args['date_query'] = array( 'after' => date( 'Y-m-d', herald_calculate_time_diff( $time_diff ) ) );
			}
		}

		$args = apply_filters('herald_modify_trending_post_query_args', $args ); //Allow child themes or plugins to modify

		$trending_query = new WP_Query( $args );

		return $trending_query;
	}
endif;

/**
 * Get related posts for particular post
 *
 * @param int     $post_id
 * @return object WP_Query
 * @since  1.0
 */

if ( !function_exists( 'herald_get_related_posts' ) ):
	function herald_get_related_posts( $post_id = false ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$args['post_type'] = 'post';

		//Exclude current post form query
		$args['post__not_in'] = array( $post_id );

		//If previuos next posts active exclude them too
		if ( herald_get_option( 'single_sticky_prevnext' ) ) {
			$in_same_cat = herald_get_option( 'single_prevnext_same_cat' );
			$prev = get_previous_post( $in_same_cat );

			if ( !empty( $prev ) ) {
				$args['post__not_in'][] = $prev->ID;
			}
			$next = get_next_post( $in_same_cat );
			if ( !empty( $next ) ) {
				$args['post__not_in'][] = $next->ID;
			}
		}

		$num_posts = absint( herald_get_option( 'related_limit' ) );
		if ( $num_posts > 100 ) {
			$num_posts = 100;
		}
		$args['posts_per_page'] = $num_posts;
		$args['orderby'] = herald_get_option( 'related_order' );

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

		if ( $args['orderby'] == 'title' ) {
			$args['order'] = 'ASC';
		}

		if ( $time_diff = herald_get_option( 'related_time' ) ) {
			$args['date_query'] = array( 'after' => date( 'Y-m-d', herald_calculate_time_diff( $time_diff ) ) );
		}

		if ( $type = herald_get_option( 'related_type' ) ) {
			switch ( $type ) {

			case 'cat':
				$cats = get_the_category( $post_id );
				$cat_args = array();
				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$cat_args[] = $cat->term_id;
					}
				}
				$args['category__in'] = $cat_args;
				break;

			case 'tag':
				$tags = get_the_tags( $post_id );
				$tag_args = array();
				if ( !empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$tag_args[] = $tag->term_id;
					}
				}
				$args['tag__in'] = $tag_args;
				break;

			case 'cat_and_tag':
				$cats = get_the_category( $post_id );
				$cat_args = array();
				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$cat_args[] = $cat->term_id;
					}
				}
				$tags = get_the_tags( $post_id );
				$tag_args = array();
				if ( !empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$tag_args[] = $tag->term_id;
					}
				}
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'category',
						'field'    => 'id',
						'terms'    => $cat_args,
					),
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'terms'    => $tag_args,
					)
				);
				break;

			case 'cat_or_tag':
				$cats = get_the_category( $post_id );
				$cat_args = array();
				if ( !empty( $cats ) ) {
					foreach ( $cats as $k => $cat ) {
						$cat_args[] = $cat->term_id;
					}
				}
				$tags = get_the_tags( $post_id );
				$tag_args = array();
				if ( !empty( $tags ) ) {
					foreach ( $tags as $tag ) {
						$tag_args[] = $tag->term_id;
					}
				}
				$args['tax_query'] = array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'category',
						'field'    => 'id',
						'terms'    => $cat_args,
					),
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'id',
						'terms'    => $tag_args,
					)
				);
				break;

			case 'author':
				global $post;
				$author_id = isset( $post->post_author ) ? $post->post_author : 0;
				$args['author'] = $author_id;
				break;

			case 'default':
				break;
			}
		}

		$args = apply_filters('herald_modify_related_post_query_args', $args ); //Allow child themes or plugins to modify
		$related_query = new WP_Query( $args );

		return $related_query;
	}
endif;



/**
 * Get featured area params
 *
 * @return array WP_Query and Layout ID
 * @since  1.0
 */

if ( !function_exists( 'herald_get_featured_area' ) ):
	function herald_get_featured_area() {

		if ( !is_category() ) {
			return false;
		}

		$obj = get_queried_object();

		if(empty($obj)){
			return false;
		}

		$meta= herald_get_category_meta( $obj->term_id );
		$layout = $meta['fa_layout'] == 'inherit' ? herald_get_option( 'category_fa_layout' ) : $meta['fa_layout'];

		if ( $layout == 'none' ) {
			return false;
		}

		$args['post_type'] = 'post';
		$args['posts_per_page'] = herald_get_featured_area_numposts( $layout );
		$args['orderby'] = herald_get_option( 'category_fa_order' );
		$args['cat'] = $obj->term_id;

		if ( $args['orderby'] == 'views' && function_exists( 'ev_get_meta_key' ) ) {
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = ev_get_meta_key();
		} else if ( strpos( $args['orderby'], 'reviews' ) !== false && herald_is_wp_review_active() ) {

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

		if ( $args['orderby'] == 'title' ) {
			$args['order'] = 'ASC';
		}

		$args = apply_filters('herald_modify_featured_area_query_args', $args ); //Allow child themes or plugins to modify

		$query = new WP_Query( $args );

		$params = array(
			'query' => $query,
			'layout' => $layout
		);

		return $params;
	}
endif;


/**
 * Get number of posts for specific featured area layout
 *
 * @param string  $layout ID of a layout
 * @return int Number of posts
 * @since  1.0
 */

if ( !function_exists( 'herald_get_featured_area_numposts' ) ):
	function herald_get_featured_area_numposts( $layout ) {

		$numposts = array(
			'1' => 3,
			'2' => 4,
			'3' => 5,
			'4' => 5,
			'5' => 4
		);

		$numposts = apply_filters( 'herald_modify_featured_area_numposts', $numposts );

		if ( array_key_exists( $layout, $numposts ) ) {
			return $numposts[$layout];
		}

		return false;

	}
endif;


/**
 * Calculate time difference
 *
 * @param string  $timestring String to calculate difference from
 * @return  int Time difference in miliseconds
 * @since  1.0
 */

if ( !function_exists( 'herald_calculate_time_diff' ) ) :
	function herald_calculate_time_diff( $timestring ) {

		$now = current_time( 'timestamp' );

		switch ( $timestring ) {
		case '-1 day' : $time = $now - DAY_IN_SECONDS; break;
		case '-3 days' : $time = $now - ( 3 * DAY_IN_SECONDS ); break;
		case '-1 week' : $time = $now - WEEK_IN_SECONDS; break;
		case '-1 month' : $time = $now - ( YEAR_IN_SECONDS / 12 ); break;
		case '-3 months' : $time = $now - ( 3 * YEAR_IN_SECONDS / 12 ); break;
		case '-6 months' : $time = $now - ( 6 * YEAR_IN_SECONDS / 12 ); break;
		case '-1 year' : $time = $now - ( YEAR_IN_SECONDS ); break;
		default : $time = $now;
		}

		return $time;
	}
endif;


/* Generate list of additional image sizes
 *
 * @return array List of image size parameters
 * @since  1.0
 */

if ( !function_exists( 'herald_get_image_sizes' ) ):
	function herald_get_image_sizes() {

		global $herald_image_matches;

		$options = array(
			'a' => array( 'sid' => 990, 'full' => 1320 ),
			'a1' => array( 'sid' => 990, 'full' => 1320 ),
			'a2' => array( 'sid' => 990, 'full' => 1320 ),
			'a3' => array( 'sid' => 990, 'full' => 1320 ),
			'b' => array( 'sid' => 470, 'full' => 640 ),
			'b1' => array( 'sid' => 300, 'full' => 414 ),
			'c' => array( 'sid' => 470, 'full' => 640 ),
			'c1' => array( 'sid' => 470, 'full' => 640 ),
			'd' => array( 'sid' => 215, 'full' => 300 ),
			'd1' => array( 'sid' => 130, 'full' => 187 ),
			'f' => array( 'sid' => 300, 'full' => 414 ),
			'f1' => array( 'sid' => 300, 'full' => 414 ),
			'g' => array( 'sid' => 130, 'full' => 187 ),
			'g1' => array( 'sid' => 74, 'full' => 111 ),
			'i' => array( 'sid' => 215, 'full' => 300 ),
			'i1' => array( 'sid' => 215, 'full' => 300 ),
			'k' => array( 'sid' => 130, 'full' => 187 ),
			'single' => array( 'sid' => 990, 'full' => 1320 ),
			'page' => array( 'sid' => 990, 'full' => 1320 )

		);

		//allow child themes to modify our sizes options
		$options = apply_filters( 'herald_modify_image_sizes_opts', $options );

		//Check if user has disabled to generate particular image sizes from theme options

		$disable_img_sizes = (array) herald_get_option( 'disable_img_sizes' );
		$disable_img_sizes =array_keys( array_filter( $disable_img_sizes ) );

		$sizes = array();
		$widths = array();
		$herald_image_matches = array();

		foreach ( $options as $layout => $opt ) {

			if ( !in_array( $layout, $disable_img_sizes ) ) {

				$lay_sizes = herald_calculate_image_size( $layout, $opt );

				if ( !empty( $lay_sizes ) ) {
					foreach ( $lay_sizes as $id => $size ) {

						//Check if size with same args already exists and avoid generating same size twice

						if ( !array_key_exists( $size['args']['w'], $widths ) ) {

							$widths[$size['args']['w']][] = $id;
							$sizes[$id] = $size;

						} else {

							$add_size = true;

							foreach ( $widths[$size['args']['w']] as $k => $name ) {
								if ( $size['args']['w'] == $sizes[$name]['args']['w'] && $size['args']['h'] == $sizes[$name]['args']['h'] && $size['args']['crop'] == $sizes[$name]['args']['crop'] ) {
									$add_size = false;
									$herald_image_matches[$id] = $name;
									continue;
								}
							}

							if ( $add_size ) {
								$sizes[$id] = $size;
							}
						}

					}
				}
			}
		}

		//Apply featured area sizes
		if ( !in_array( 'fa1', $disable_img_sizes ) ) {
			$sizes['herald-lay-fa1'] = array( 'title' => 'FA1', 'args' => array( 'w' => 434, 'h' => 420, 'crop' => true ) );
			$sizes['herald-lay-fa1-full'] = array( 'title' => 'FA1 (full)', 'args' => array( 'w' => 550, 'h' => 520, 'crop' => true ) );
		}

		if ( !in_array( 'fa3', $disable_img_sizes ) ) {
			$sizes['herald-lay-fa3-big'] = array( 'title' => 'FA3 Big', 'args' => array( 'w' => 459, 'h' => 420, 'crop' => true ) );
			$sizes['herald-lay-fa3-big-full'] = array( 'title' => 'FA3 Big (full)', 'args' => array( 'w' => 559, 'h' => 520, 'crop' => true ) );
			$sizes['herald-lay-fa3-small'] = array( 'title' => 'FA3 Small', 'args' => array( 'w' => 260, 'h' => 210, 'crop' => true ) );
			$sizes['herald-lay-fa3-small-full'] = array( 'title' => 'FA3 Small (full)', 'args' => array( 'w' => 379, 'h' => 259, 'crop' => true ) );
		}

		if ( !in_array( 'fa5', $disable_img_sizes ) ) {
			$sizes['herald-lay-fa5'] = array( 'title' => 'FA5', 'args' => array( 'w' => 980, 'h' => 420, 'crop' => true ) );
			$sizes['herald-lay-fa5-full'] = array( 'title' => 'FA5 (full)', 'args' => array( 'w' => 1320, 'h' => 520, 'crop' => true ) );
		}

		//Allow child themes to modify sizes
		$sizes = apply_filters( 'herald_modify_image_sizes', $sizes );

		return $sizes;
	}
endif;


/**
 * Calculate image size
 *
 * Helper function to calculate image sizes based on specific layout options
 *
 * @param string  $lay   ID of specific layout
 * @param array   $width An array with 'sid' and 'full' arguments representing width of image with sidebar or full width
 * @return array List of generated sizes
 * @since  1.0
 */

if ( !function_exists( 'herald_calculate_image_size' ) ):
	function herald_calculate_image_size( $lay, $width ) {

		$sizes = array();

		if ( $ratio = herald_get_option( 'img_size_lay_'.$lay.'_ratio' ) ) {
			$crop = true;
			if ( $ratio == 'original' ) {
				$height['sid'] = 9999;
				$height['full'] = 9999;
				$crop = false;
			} else if ( $ratio == 'custom' ) {
					$ratio = herald_get_option( 'img_size_lay_'.$lay.'_custom' );
					$ratio_opts = explode( ":", $ratio );

					if ( !empty( $ratio ) && !empty( $ratio_opts ) ) {
						$height['sid'] = absint( $width['sid'] * absint( $ratio_opts[1] ) / absint( $ratio_opts[0] ) );
						$height['full'] = absint( $width['full'] * absint( $ratio_opts[1] ) / absint( $ratio_opts[0] ) );

					} else {
						//fallback to 16:9 if user haven't set proper ratio
						$height['sid'] = absint( $width['sid'] * 16 / 9 );
						$height['full'] = absint( $width['full'] * 16 / 9 );
					}
				} else {
				$ratio_opts = explode( "_", $ratio );
				$height['sid'] = absint( $width['sid'] * $ratio_opts[1] / $ratio_opts[0] );
				$height['full'] = absint( $width['full'] * $ratio_opts[1] / $ratio_opts[0] );
			}

			$sizes['herald-lay-'.$lay] = array( 'title' => strtoupper( $lay ), 'args' => array( 'w' => $width['sid'], 'h' => $height['sid'], 'crop' => $crop ) );
			$sizes['herald-lay-'.$lay.'-full'] = array( 'title' =>  strtoupper( $lay ) . ' (full)', 'args' => array( 'w' => $width['full'], 'h' => $height['full'], 'crop' => $crop ) );
		}

		return $sizes;

	}
endif;



/**
 * Check if RTL mode is enabled
 *
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'herald_is_rtl' ) ):
	function herald_is_rtl() {

		if ( herald_get_option( 'rtl_mode' ) ) {
			$rtl = true;
			//Check if current language is excluded from RTL
			$rtl_lang_skip = explode( ",", herald_get_option( 'rtl_lang_skip' ) );
			if ( !empty( $rtl_lang_skip )  ) {
				$locale = get_locale();
				if ( in_array( $locale, $rtl_lang_skip ) ) {
					$rtl = false;
				}
			}
		} else {
			$rtl = false;
		}

		return $rtl;
	}
endif;


/**
 * Detect WordPress template
 *
 * It checks which template is currently active
 * so we know what set of options to load later
 *
 * @return string Template name prefix we use in options panel
 * @since  1.0
 */

if ( !function_exists( 'herald_detect_template' ) ):
	function herald_detect_template() {

		if ( is_single() ) {

			$type = get_post_type( get_the_ID() );

			if ( in_array( $type, array( 'product', 'forum', 'topic' ) ) ) {
				$template = $type;
			} else {
				$template = 'single';
			}

		} else if ( is_page_template( 'template-modules.php' ) && is_page() ) {
				$template = 'modules';
		} else if ( is_page() ) {
			$template = 'page';
		} else if ( is_category() ) {
			$template = 'category';
		} else if ( is_tag() ) {
			$template = 'tag';
		} else if ( is_search() ) {
			$template = 'search';
		} else if ( is_author() ) {
			$template = 'author';
		} else if ( is_tax( 'product_cat' ) || is_tax('product_tag') || is_post_type_archive( 'product' ) ) {
			$template = 'product_cat';
		} else if ( is_archive() ) {
			$template = 'archive';
		} else if( herald_is_bbpress_active() && function_exists('bbp_is_single_user') && bbp_is_single_user() ) {
			$template = 'bb_user';
		} else{
			$template = 'archive'; //default
		}

		return $template;
	}
endif;


/**
 * Get image ID from URL
 *
 * It gets image/attachment ID based on URL
 *
 * @param string  $image_url URL of image/attachment
 * @return int|bool Attachment ID or "false" if not found
 * @since  1.0
 */

if ( !function_exists( 'herald_get_image_id_by_url' ) ):
	function herald_get_image_id_by_url( $image_url ) {
		global $wpdb;

		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

		if ( isset( $attachment[0] ) ) {
			return $attachment[0];
		}

		return false;
	}
endif;


/**
 * Calculate reading time by content length
 *
 * @param string  $text Content to calculate
 * @return int Number of minutes
 * @since  1.0
 */

if ( !function_exists( 'herald_read_time' ) ):
	function herald_read_time( $text ) {

		if ( !herald_get_option( 'multibyte_rtime' ) ) {
			//$words = str_word_count( wp_strip_all_tags( $text ) );
			$words = count(preg_split( "/[\n\r\t ]+/", wp_strip_all_tags($text)));
			
		} else {
			//$words = count( explode( ' ', html_entity_decode( mb_convert_encoding( $text, 'HTML-ENTITIES', 'UTF-8' ), ENT_QUOTES, 'UTF-8' ) ) );
			$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', wp_strip_all_tags($text) ), ' ' );
			preg_match_all( '/./u', $text, $words_array );
			$words = count($words_array[0]);
		}

		$number_words_per_minute = herald_get_option('words_read_per_minute');
		$number_words_per_minute = !empty($number_words_per_minute) ? absint( $number_words_per_minute ) : 200;

		if ( !empty( $words ) ) {
			$time_in_minutes = ceil( $words / $number_words_per_minute );
			return $time_in_minutes;
		}

		return false;
	}
endif;


/**
 * Trim chars of a string
 *
 * @param string  $string Content to trim
 * @param int     $limit  Number of characters to limit
 * @param string  $more   Chars to append after trimed string
 * @return string Trimmed part of the string
 * @since  1.0
 */

if ( !function_exists( 'herald_trim_chars' ) ):
	function herald_trim_chars( $string, $limit, $more = '...' ) {

		/*
		if ( !empty( $limit ) && strlen( $string ) > $limit ) {
			$last_space = strrpos( substr( $string, 0, $limit ), ' ' );
			$string = substr( $string, 0, $last_space );
			$string = rtrim( $string, ".,-?!" );
			$string.= $more;
		}
		*/

		if(!empty($limit)){
			$text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $string ), ' ' );
			preg_match_all( '/./u', $text, $chars );
			$chars = $chars[0];
			$count = count($chars);
			if($count > $limit){

				$chars = array_slice( $chars, 0, $limit );

				for($i = ($limit -1 ); $i >= 0; $i--){
					if( in_array($chars[$i], array('.', ' ', '-', '?', '!') ) ){
						break;
					}
				}

				$chars =  array_slice( $chars, 0, $i );
				$string = implode( '', $chars );
				$string = rtrim( $string, ".,-?!" );
				$string.= $more;
			}
		}
				
		return $string;
	}
endif;



/**
 * Print module/archive heading
 *
 * Function that outputs the heading of a section based on passed arguments
 *
 * @param array   $args title => heading title, desc => heading description,  actions => action links
 * @return string HTML output
 * @since  1.0
 */

if ( !function_exists( 'herald_print_heading' ) ):
	function herald_print_heading( $args ) {

		$defaults = array(
			'title' => '',
			'desc' => '',
			'actions' => '',
			'subnav' => '',
			'cat' => ''
		);

		$args = herald_parse_args( $args, $defaults );

		$output = '';

		if ( !empty( $args['title'] ) ||  !empty( $args['actions'] ) ) {
			$cat_class = !empty( $args['cat'] ) ? 'herald-cat-'.$args['cat'] : '';
			$output.= '<div class="herald-mod-head '.$cat_class.'">';

			if ( !empty( $args['title'] ) ) {
				$output.= '<div class="herald-mod-title">'.$args['title'].'</div>';
			}

			if ( !empty( $args['subnav'] ) ) {
				$output.= '<div class="herald-mod-subnav">'.$args['subnav'].'</div>';
			}

			if ( !empty( $args['actions'] ) ) {
				$output.= '<div class="herald-mod-actions">'.$args['actions'].'</div>';
			}

			$output.= '</div>';
		}

		if ( !empty( $args['desc'] ) ) {
			$output.= '<div class="herald-mod-desc">'.$args['desc'].'</div>';
		}

		if ( !empty( $output ) ) {
			$output = '<div class="herald-mod-wrap">'.$output.'</div>';
		}

		return $output;
	}
endif;


/**
 * Parse args ( merge arrays )
 *
 * Similar to wp_parse_args() but extended to also merge multidimensional arrays
 *
 * @param array   $a - set of values to merge
 * @param array   $b - set of default values
 * @return array Merged set of elements
 * @since  1.0
 */

if ( !function_exists( 'herald_parse_args' ) ):
	function herald_parse_args( &$a, $b ) {
		$a = (array) $a;
		$b = (array) $b;
		$r = $b;
		foreach ( $a as $k => &$v ) {
			if ( is_array( $v ) && isset( $r[ $k ] ) ) {
				$r[ $k ] = herald_parse_args( $v, $r[ $k ] );
			} else {
				$r[ $k ] = $v;
			}
		}
		return $r;
	}
endif;


/**
 * Compare two values
 *
 * Fucntion compares two values and sanitazes 0
 *
 * @param mixed   $a
 * @param mixed   $b
 * @return bool Returns true if equal
 * @since  1.0
 */

if ( !function_exists( 'herald_compare' ) ):
	function herald_compare( $a, $b ) {
		return (string) $a === (string) $b;
	}
endif;



/**
 * Hex 2 rgba
 *
 * Convert hexadecimal color to rgba
 *
 * @param string  $color   Hexadecimal color value
 * @param float   $opacity Opacity value
 * @return string RGBA color value
 * @since  1.0
 */

if ( !function_exists( 'herald_hex2rgba' ) ):
	function herald_hex2rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if ( empty( $color ) )
			return $default;

		//Sanitize $color if "#" is provided
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map( 'hexdec', $hex );

		//Check if opacity is set(rgba or rgb)
		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) { $opacity = 1.0; }
			$output = 'rgba('.implode( ",", $rgb ).','.$opacity.')';
		} else {
			$output = 'rgb('.implode( ",", $rgb ).')';
		}

		//Return rgb(a) color string
		return $output;
	}
endif;


/**
 * Get list of social options
 *
 * @return array
 * @since  1.0
 */

if ( !function_exists( 'herald_get_social' ) ) :
	function herald_get_social() {
		$social = array(
			'apple' => 'Apple',
			'behance' => 'Behance',
			'delicious' => 'Delicious',
			'deviantart' => 'DeviantArt',
			'digg' => 'Digg',
			'dribbble' => 'Dribbble',
			'facebook' => 'Facebook',
			'flickr' => 'Flickr',
			'github' => 'Github',
			'google' => 'GooglePlus',
			'instagram' => 'Instagram',
			'linkedin' => 'LinkedIN',
			'pinterest' => 'Pinterest',
			'reddit' => 'ReddIT',
			'rss' => 'Rss',
			'skype' => 'Skype',
			'stumbleupon' => 'StumbleUpon',
			'soundcloud' => 'SoundCloud',
			'spotify' => 'Spotify',
			'tumblr' => 'Tumblr',
			'twitter' => 'Twitter',
			'vimeo-square' => 'Vimeo',
			'vine' => 'Vine',
			'wordpress' => 'WordPress',
			'xing' => 'Xing' ,
			'yahoo' => 'Yahoo',
			'youtube' => 'Youtube',
			'quora' => 'Quora'
		);

		$social = apply_filters('herald_modify_socail_options_list', $social ); //Allow child themes or plugins to modify

		return $social;
	}
endif;

/**
 * Generate dynamic css
 *
 * Function parses theme options and generates css code dynamically
 *
 * @return string Generated css code
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_dynamic_css' ) ):
	function herald_generate_dynamic_css() {
		ob_start();
		get_template_part( 'assets/css/dynamic-css' );
		$output = ob_get_contents();
		ob_end_clean();
		return herald_compress_css_code( $output );
	}
endif;


/**
 * Compress CSS Code
 *
 * @param string  $code Uncompressed css code
 * @return string Compressed css code
 * @since  1.0
 */

if ( !function_exists( 'herald_compress_css_code' ) ) :
	function herald_compress_css_code( $code ) {

		// Remove Comments
		$code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

		// Remove tabs, spaces, newlines, etc.
		$code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

		return $code;
	}
endif;

/**
 * Set image flag
 *
 * Functions sets image size flag in global variable so we
 * can manipulate with image sizes depend if we need full img size or size
 * with sidebar included in layout
 *
 * @param string  $type Can be 'sid' or 'full'
 * @return void
 * @since  1.0
 */

if ( !function_exists( 'herald_set_img_flag' ) ):
	function herald_set_img_flag( $type ) {
		global $herald_img_flag;
		$herald_img_flag = $type;
	}
endif;


/**
 * Get JS settings
 *
 * Function creates list of settings from thme options to pass
 * them to global JS variable so we can use it in JS files
 *
 * @return array List of JS settings
 * @since  1.0
 */

if ( !function_exists( 'herald_get_js_settings' ) ):
	function herald_get_js_settings() {
		$js_settings = array();

		$protocol = is_ssl() ? 'https://' : 'http://';
		$js_settings['ajax_url'] = admin_url( 'admin-ajax.php', $protocol );
		$js_settings['rtl_mode'] = herald_is_rtl() ? 'true' : 'false';
		$js_settings['header_sticky'] = herald_get_option( 'header_sticky' ) ? true : false;
		$js_settings['header_sticky_offset'] = absint( herald_get_option( 'header_sticky_offset' ) );
		$js_settings['header_sticky_up'] = herald_get_option( 'header_sticky_up' ) ? true : false;
		$js_settings['single_sticky_bar'] = is_single() && herald_get_option( 'single_sticky_bar' ) ? true : false;
		$js_settings['popup_img'] = herald_get_option( 'popup_img' ) ? true : false;
		$js_settings['logo'] = herald_get_option( 'logo' );
		$js_settings['logo_retina'] = herald_get_option( 'logo_retina' );
		$js_settings['logo_mini'] = herald_get_option( 'logo_mini' );
		$js_settings['logo_mini_retina'] = herald_get_option( 'logo_mini_retina' );
		$js_settings['smooth_scroll'] = herald_get_option( 'smooth_scroll' ) ? true : false;
		$js_settings['trending_columns'] = herald_get_option( 'trending_number' );
		$js_settings['responsive_menu_more_link'] = herald_get_option( 'header_responsive_group' );
		$js_settings['header_ad_responsive'] = herald_get_option( 'header_ad_responsive' ) ? true : false;
		$js_settings['header_responsive_breakpoint'] = herald_get_option( 'header_responsive_breakpoint' );

		return $js_settings;
	}
endif;


/**
 * Get all translation options
 *
 * @return array Returns list of all options translation available via theme options panel
 * @since  1.0
 */

if ( !function_exists( 'herald_get_translate_options' ) ):
	function herald_get_translate_options() {
		global $herald_translate;
		get_template_part( 'core/translate' );
		$translate = apply_filters( 'herald_modify_translate_options', $herald_translate );
		return $translate;
	}
endif;


/**
 * Generate fonts link
 *
 * Function creates font link from fonts selected in theme options
 *
 * @return string
 * @since  1.0
 */

if ( !function_exists( 'herald_generate_fonts_link' ) ):
	function herald_generate_fonts_link() {

		$fonts = array();
		$fonts[] = herald_get_option( 'main_font' );
		$fonts[] = herald_get_option( 'h_font' );
		$fonts[] = herald_get_option( 'nav_font' );
		$unique = array(); //do not add same font links
		$native = herald_get_native_fonts();
		$protocol = is_ssl() ? 'https://' : 'http://';
		$link = array();

		foreach ( $fonts as $font ) {
			if ( !in_array( $font['font-family'], $native ) ) {
				$temp = array();
				if ( isset( $font['font-style'] ) ) {
					$temp['font-style'] = $font['font-style'];
				}
				if ( isset( $font['subsets'] ) ) {
					$temp['subsets'] = $font['subsets'];
				}
				if ( isset( $font['font-weight'] ) ) {
					$temp['font-weight'] = $font['font-weight'];
				}
				$unique[$font['font-family']][] = $temp;
			}
		}

		$subsets = array( 'latin' ); //latin as default

		foreach ( $unique as $family => $items ) {

			$link[$family] = $family;

			$weight = array( '400' );


			foreach ( $items as $item ) {

				//Check weight and style
				if ( isset( $item['font-weight'] ) && !empty( $item['font-weight'] ) ) {
					$temp = $item['font-weight'];
					if ( isset( $item['font-style'] ) && empty( $item['font-style'] ) ) {
						$temp .= $item['font-style'];
					}

					if ( !in_array( $temp, $weight ) ) {
						$weight[] = $temp;
					}
				}

				//Check subsets
				if ( isset( $item['subsets'] ) && !empty( $item['subsets'] ) ) {
					if ( !in_array( $item['subsets'], $subsets ) ) {
						$subsets[] = $item['subsets'];
					}
				}
			}

			$link[$family] .= ':'.implode( ",", $weight );
			//$link[$family] .= '&subset='.implode( ",", $subsets );
		}

		if ( !empty( $link ) ) {

			$query_args = array(
				'family' => urlencode( implode( '|', $link ) ),
				'subset' => urlencode( implode( ',', $subsets ) )
			);


			$fonts_url = add_query_arg( $query_args, $protocol.'fonts.googleapis.com/css' );

			return esc_url_raw( $fonts_url );
		}

		return '';

	}
endif;


/**
 * Get native fonts
 *
 *
 * @return array List of native fonts
 * @since  1.0
 */

if ( !function_exists( 'herald_get_native_fonts' ) ):
	function herald_get_native_fonts() {

		$fonts = array(
			"Arial, Helvetica, sans-serif",
			"'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style', serif",
			"'Comic Sans MS', cursive",
			"Courier, monospace",
			"Garamond, serif",
			"Georgia, serif",
			"Impact, Charcoal, sans-serif",
			"'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma,Geneva, sans-serif",
			"'Times New Roman', Times,serif",
			"'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif"
		);

		return $fonts;
	}
endif;


/**
 * Get font option
 *
 * @return string Font-family
 * @since  1.0
 */

if ( !function_exists( 'herald_get_font_option' ) ):
	function herald_get_font_option( $option = false ) {

		$font = herald_get_option( $option );
		$native_fonts = herald_get_native_fonts();
		if ( !in_array( $font['font-family'], $native_fonts ) ) {
			$font['font-family'] = "'".$font['font-family']."'";
		}

		return $font;
	}
endif;


/**
 * Get background
 *
 * @return string background CSS
 * @since  1.0
 */

if ( !function_exists( 'herald_get_bg_option' ) ):
	function herald_get_bg_option( $option = false ) {

		$style = herald_get_option( $option );
		$css = '';

		if ( ! empty( $style ) && is_array( $style ) ) {
			foreach ( $style as $key => $value ) {
				if ( ! empty( $value ) && $key != "media" ) {
					if ( $key == "background-image" ) {
						$css .= $key . ":url('" . $value . "');";
					} else {
						$css .= $key . ":" . $value . ";";
					}
				}
			}
		}

		return $css;
	}
endif;


/**
 * Check if post/page is paginated
 *
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'herald_is_paginated_post' ) ):
	function herald_is_paginated_post() {

		global $multipage;
		return 0 !== $multipage;

	}
endif;


/**
 * Check if is first page of paginated post
 *
 * @return bool
 * @since  1.4.1
 */

if ( !function_exists( 'herald_is_paginated_post_first_page' ) ):
	function herald_is_paginated_post_first_page() {

		if ( !herald_is_paginated_post() ) {
			return false;
		}

		global $page;

		return $page === 1;

	}
endif;


/**
 * Find which header section contains main nav
 *
 * @return string middle|bottom
 * @since  1.0
 */

if ( !function_exists( 'herald_main_nav_section' ) ):
	function herald_main_nav_section() {

		$options = array(
			'header_middle_left',
			'header_middle_center',
			'header_middle_right',
			'header_bottom_left',
			'header_bottom_center',
			'header_bottom_right',
		);


		foreach ( $options as $slot ) {
			$elements =  herald_get_option( $slot );
			//herald_log($slot);
			if ( array_key_exists( 'main-menu', $elements ) && $elements['main-menu'] ) {
				return strpos( $slot, 'middle' ) ? 'middle' : 'bottom';
			}
		}

		return 'middle';


	}
endif;


/**
 * Check if WooCommerce is active
 *
 * @return bool
 * @since  1.2
 */

if ( !function_exists( 'herald_is_woocommerce_active' ) ):
	function herald_is_woocommerce_active() {

		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Check if we are on WooCommerce page
 *
 * @return bool
 * @since  1.2
 */

if ( !function_exists( 'herald_is_woocommerce_page' ) ):
	function herald_is_woocommerce_page() {

		return is_singular( 'product' ) || is_tax( 'product_cat' ) || is_post_type_archive( 'product' );
	}
endif;

/**
 * Check if bbPress is active
 *
 * @return bool
 * @since  1.2
 */

if ( !function_exists( 'herald_is_bbpress_active' ) ):
	function herald_is_bbpress_active() {

		if ( in_array( 'bbpress/bbpress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Check if WP Review plugin is active
 *
 * @return bool
 * @since  1.4
 */

if ( !function_exists( 'herald_is_wp_review_active' ) ):
	function herald_is_wp_review_active() {

		if ( in_array( 'wp-review/wp-review.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;



/**
 * Support for Co-Authors Plus Plugin
 *
 * Check if plugin is activated 
 * @since  1.5
 */

if ( !function_exists( 'herald_is_co_authors_active' ) ):
	function herald_is_co_authors_active() {

		if ( in_array( 'co-authors-plus/co-authors-plus.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;

/**
 * Check is SEO by Yoast plugin active
 *
 * Check if plugin is activated 
 * @since  1.5
 */

if ( !function_exists( 'herald_is_yoast_active' ) ):
	function herald_is_yoast_active() {

		if ( in_array( 'wordpress-seo/wp-seo.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}

		return false;
	}
endif;


/**
 * Get term slugs by term names for specific taxonomy
 *
 * @param string  $names List of tag names separated by comma
 * @param string  $tax   Taxonomy name
 * @return array List of slugs
 * @since  1.2
 */

if ( !function_exists( 'herald_get_tax_term_slug_by_name' ) ):
	function herald_get_tax_term_slug_by_name( $names, $tax = 'post_tag' ) {

		if ( empty( $names ) ) {
			return '';
		}

		$slugs = array();
		$names = explode( ",", $names );

		foreach ( $names as $name ) {
			$tag = get_term_by( 'name', trim( $name ), $tax );

			if ( !empty( $tag ) && isset( $tag->slug ) ) {
				$slugs[] = $tag->slug;
			}
		}

		return $slugs;

	}
endif;


/**
 * Get term names by term slugs for specific taxonomy
 *
 * @param array   $slugs List of tag slugs
 * @param string  $tax   Taxonomy name
 * @return string List of names separrated by comma
 * @since  1.2
 */

if ( !function_exists( 'herald_get_tax_term_name_by_slug' ) ):
	function herald_get_tax_term_name_by_slug( $slugs, $tax = 'post_tag' ) {

		if ( empty( $slugs ) ) {
			return '';
		}

		$names = array();

		foreach ( $slugs as $slug ) {
			$tag = get_term_by( 'slug', trim( $slug ), $tax );
			if ( !empty( $tag ) && isset( $tag->name ) ) {
				$names[] = $tag->name;
			}
		}

		if ( !empty( $names ) ) {
			$names = implode( ",", $names );
		} else {
			$names = '';
		}

		return $names;

	}
endif;

/**
 * Get term IDs by term slugs for specific taxonomy
 *
 * @param array   $slugs List of term slugs
 * @param string  $tax   Taxonomy name
 * @return array List of term IDs
 * @since  1.5.3
 */

if ( !function_exists( 'herald_get_tax_term_id_by_slug' ) ):
	function herald_get_tax_term_id_by_slug( $slugs, $tax = 'post_tag' ) {

		if ( empty( $slugs ) ) {
			return '';
		}

		$ids = array();

		foreach ( $slugs as $slug ) {
			$tag = get_term_by( 'slug', trim( $slug ), $tax );
			if ( !empty( $tag ) && isset( $tag->term_id ) ) {
				$ids[] = $tag->term_id;
			}
		}

		return $ids;

	}
endif;

/**
 * Get term IDs by term names for specific taxonomy
 *
 * @param array   $names List of term names
 * @param string  $tax   Taxonomy name
 * @return array List of term IDs
 * @since  1.6
 */

if ( !function_exists( 'herald_get_tax_term_id_by_name' ) ):
	function herald_get_tax_term_id_by_name( $names, $tax = 'post_tag' ) {

		if ( empty( $names ) ) {
			return '';
		}

		if(!is_array($names)){
			$names = explode(",", $names );
		}

		$ids = array();

		foreach ( $names as $name ) {
			$tag = get_term_by( 'name', trim( $name ), $tax);
			if ( !empty( $tag ) && isset( $tag->term_id ) ) {
				$ids[] = $tag->term_id;
			}
		}

		return $ids;

	}
endif;

/**
 * Get term names by term id for specific taxonomy
 *
 * @param array   $names List of term ids
 * @param string  $tax   Taxonomy name
 * @return array List of term names
 * @since  1.6
 */

if ( !function_exists( 'herald_get_tax_term_name_by_id' ) ):
	function herald_get_tax_term_name_by_id( $ids, $tax = 'post_tag' ) {

		if ( empty( $ids ) ) {
			return '';
		}

		$names = array();

		foreach ( $ids as $id ) {
			$tag = get_term_by( 'id', trim( $id ), $tax);
			if ( !empty( $tag ) && isset( $tag->name ) ) {
				$names[] = $tag->name;
			}
		}

		$names = implode(',', $names);

		return $names;

	}
endif;


/**
 * Get authors IDs by author username
 *
 * @param array   $slugs List of term slugs
 * @return array List of author IDs
 * @since  1.6  ( R.J. )
 */

if ( !function_exists( 'herald_get_authors_id_by_username' ) ):
	function herald_get_authors_id_by_username( $names ) {

		if ( empty( $names ) ) {
			return '';
		}
		$names = explode( ",", $names );
		$ids = array();

		foreach ( $names as $name ) {

			$meta = get_user_by('login',$name);
			if ( !empty( $meta ) ) {
				$ids[] = $meta->ID;
			}
		}

		return $ids;

	}
endif;


/**
 * Get authors username by author ID
 *
 * @param array   $slugs List of term slugs
 * @return array List of author IDs
 * @since  1.6  ( R.J. )
 */

if ( !function_exists( 'herald_get_authors_username_by_id' ) ):
	function herald_get_authors_username_by_id( $ids ) {

		if ( empty( $ids ) ) {
			return '';
		}

		$names = array();

		foreach ( $ids as $id ) {

			$meta = get_user_by('ID',$id);
			if ( !empty( $meta ) ) {
				$names[] = $meta->user_login;
			}
		}

		$names = implode( ",", $names );
		return $names;

	}
endif;

/**
 * Get all public custom post types 
 *
 * @return array List of slugs
 * @since  1.6  ( R.J. )
 */

if ( !function_exists( 'herald_get_custom_post_types' ) ):
	function herald_get_custom_post_types( $raw = false, $exclude = array( 'topic', 'forum', 'guest-author', 'product', 'reply' ) ) {
		
		$custom_post_types =  get_post_types( array( 'public' => true, '_builtin' => false ), 'object' );
		
		if(!empty( $custom_post_types )){
			
			foreach( $custom_post_types as $i => $obj ){
				if( in_array($obj->name, $exclude) ){
					unset( $custom_post_types[$i] );
				}
			}
			
			if(!$raw) {
				$custom_post_types = array_keys( $custom_post_types );
			}
		}

		$custom_post_types =  apply_filters('herald_modify_custom_post_types_list', $custom_post_types );
		
		return $custom_post_types;
	}
endif;


/**
 * Get all taxonomies for custom post type
 *
 * @param  $cpt Custom post type ID
 * @return array List of custom post types and taxonomies
 * @since  1.6  ( R.J. )
 */
if ( !function_exists( 'herald_get_taxonomies' ) ) :
function herald_get_taxonomies( $cpt) {

    $taxonomies = get_taxonomies( array(
        'object_type' => array($cpt),
        'public' => true,
        'show_ui' => true
    ), 'object');

	$output = array();

	foreach ( $taxonomies as $taxonomy ) {
						
			$tax = array();
			$tax['id'] = $taxonomy->name;
			$tax['name'] = $taxonomy->label;
			$tax['hierarchical'] = $taxonomy->hierarchical;
			if( $tax['hierarchical'] ){
				$tax['terms'] = get_terms( $taxonomy->name, array('hide_empty' => false) ); //false for testing - change to true 
			}
			
			$output[] = $tax;
	}
	
	return $output;
}
endif;

/**
 * Trim text characters with UTF-8
 * for adding to html attributes it's not breaking the code and
 * you are able to have all the kind of characters (Japanese, Cyrillic, German, French, etc.)
 *
 * @param $text
 * @since  1.8
 */
if(!function_exists('herald_esc_text')):
    function herald_esc_text($text){
        return rawurlencode( html_entity_decode( wp_kses( $text, null ), ENT_COMPAT, 'UTF-8') );
    }
endif;

/**
 * Trims URL with special characters like used in (Japanese, Cyrillic, German, French, etc.)
 *
 * @param $url
 * @since  1.8
 */
if(!function_exists('herald_esc_url')):
    function herald_esc_url($url){
        return rawurlencode( esc_url( esc_attr($url) ) );
    }
endif;


/**
 * Get first post in category
 *
 * @since  2.1
 * 
 * @param $category_id 
 * @return object WP Post Object 
 */

if ( !function_exists('herald_get_first_post_in_category') ) :
	function herald_get_first_post_in_category($category_id){
	
		$args = array(
			'post_type' => 'post', 
			'posts_per_page' => 1,
			'category__in' => array($category_id), 
		);
		
		$query = new WP_Query($args);

		if (!$query->have_posts()) {
			return false;
		}

		while ($query->have_posts()) {
			$query->the_post();
			$post_obj = $query->post;
		}

		wp_reset_postdata();
		return $post_obj;
	}
endif;

/** Used for getting post type with all its taxonomies
 *                                    *
 * @return array
 * @since    2.0.1
 */
if (!function_exists('herald_get_post_type_with_taxonomies')):
	function herald_get_post_type_with_taxonomies( $post_type ) {
		
		$post_type = get_post_type_object( $post_type );
		
		if (empty($post_type))
			return null;
		
		
		$post_taxonomies = array();
		$taxonomies = get_taxonomies(array(
			'object_type' => array($post_type->name),
			'public'      => true,
			'show_ui'     => true,
		), 'object');
		
		if (!empty($taxonomies)) {
			foreach ($taxonomies as $taxonomy) {
				
				$tax = array();
				$tax['id'] = $taxonomy->name;
				$tax['name'] = $taxonomy->label;
				$tax['hierarchical'] = $taxonomy->hierarchical;
				if ($tax['hierarchical']) {
					$tax['terms'] = get_terms($taxonomy->name, array('hide_empty' => false));
				}
				
				$post_taxonomies[] = $tax;
			}
		}
		
		if (!empty($post_taxonomies)) {
			$post_type->taxonomies = $post_taxonomies;
		}
		
		
		return apply_filters('herald_modify_post_type_with_taxonomies', $post_type);
	}
endif;


/**
 * Check if is Gutenberg page
 *
 * @return bool
 * @since  2.1.2
 */
if ( !function_exists( 'herald_is_gutenberg_page' ) ):
	function herald_is_gutenberg_page() {

		if ( !function_exists( 'is_gutenberg_page' ) ) {
			return false;
		}

		return is_gutenberg_page();
	}
endif;
?>