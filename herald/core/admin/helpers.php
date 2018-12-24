<?php

/**
 * Get the list of available options for post ordering
 *
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_post_order_opts' ) ) :
	function herald_get_post_order_opts() {

		$options = array(
			'date' => esc_html__( 'Date', 'herald' ),
			'modified' => esc_html__( 'Modified date', 'herald' ),
			'comment_count' => esc_html__( 'Number of comments', 'herald' ),
			'views' => esc_html__( 'Number of views', 'herald' ),
			'title'	=> esc_html__( 'Title (alphabetically)', 'herald' ),
			'rand' => esc_html__( 'Random', 'herald' ),
		);

		if( herald_is_wp_review_active() ){
			$options['reviews_star'] = esc_html__( 'Author reviews (stars)', 'herald' );
			$options['reviews_point'] = esc_html__( 'Author reviews (points)', 'herald' );
			$options['reviews_percentage'] = esc_html__( 'Author reviews (percentage)', 'herald' );
			$options['user_reviews_star'] = esc_html__( 'User reviews (stars)', 'herald' );
			$options['user_reviews_point'] = esc_html__( 'User reviews (points)', 'herald' );
			$options['user_reviews_percentage'] = esc_html__( 'User reviews (percentage)', 'herald' );
		}

		$options = apply_filters('herald_modify_post_order_opts', $options ); //Allow child themes or plugins to modify
		return $options;
	}
endif;

/**
 * Get the list of available options for products (WooCommerce) ordering
 *
 * @return array List of available options
 * @since  1.2
 */

if ( !function_exists( 'herald_get_product_order_opts' ) ) :
	function herald_get_product_order_opts() {

		$options = array(
			'date' => esc_html__( 'Date', 'herald' ),
			'modified' => esc_html__( 'Modified date', 'herald' ),
			'comment_count' => esc_html__( 'Number of comments', 'herald' ),
			'rand' => esc_html__( 'Random', 'herald' ),
		);

		$options = apply_filters('herald_modify_product_order_opts', $options ); //Allow child themes or plugins to modify
		return $options;
	}
endif;

/**
 * Get the list of available options for post ordering
 *
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_fa_post_opts' ) ) :
	function herald_get_fa_post_opts( $args = false ) {

		$options = array(
			'date' => esc_html__( 'Latest posts', 'herald' ),
			'modified' => esc_html__( 'Recently modified (updated) posts', 'herald' ),
			'comment_count' => esc_html__( 'Most commented posts', 'herald' ),
			'views' => esc_html__( 'Most viewed posts', 'herald' ),
		);

		if( herald_is_wp_review_active() ){
			$options['reviews_star'] = esc_html__( 'Author reviews (stars)', 'herald' );
			$options['reviews_point'] = esc_html__( 'Author reviews (points)', 'herald' );
			$options['reviews_percentage'] = esc_html__( 'Author reviews (percentage)', 'herald' );

			$options['user_reviews_star'] = esc_html__( 'User reviews (stars)', 'herald' );
			$options['user_reviews_point'] = esc_html__( 'User reviews (points)', 'herald' );
			$options['user_reviews_percentage'] = esc_html__( 'User reviews (percentage)', 'herald' );
		}

		$options = apply_filters('herald_modify_fa_post_opts', $options ); //Allow child themes or plugins to modify
		return $options;
	}
endif;

/**
 * Get the list of time limit options
 *
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_time_diff_opts' ) ) :
	function herald_get_time_diff_opts() {

		$options = array(
			'-1 day' => esc_html__( '1 Day', 'herald' ),
			'-3 days' => esc_html__( '3 Days', 'herald' ),
			'-1 week' => esc_html__( '1 Week', 'herald' ),
			'-1 month' => esc_html__( '1 Month', 'herald' ),
			'-3 months' => esc_html__( '3 Months', 'herald' ),
			'-6 months' => esc_html__( '6 Months', 'herald' ),
			'-1 year' => esc_html__( '1 Year', 'herald' ),
			'0' => esc_html__( 'All time', 'herald' )
		);

		return $options;
	}
endif;


/**
 * Get the list of available options to filter posts by format
 *
 * @return array List of available post formats
 * @since  1.3
 */

if ( !function_exists( 'herald_get_post_format_opts' ) ) :
	function herald_get_post_format_opts() {
		
		$options = array();
		$options['standard'] = esc_html__( 'Standard', 'herald' );
		
		$formats = get_theme_support('post-formats');
		if(!empty($formats) && is_array($formats[0])){
			foreach($formats[0] as $format){
				$options[$format] = ucfirst($format);
			}
		}

		$options['0'] = esc_html__( 'All', 'herald' );

		$options = apply_filters('herald_modify_post_format_opts', $options ); //Allow child themes or plugins to modify
		return $options;
	}
endif;


/**
 * Get the list of available post layouts
 *
 * @param bool    $ihnerit Whether you want to add "inherit" option
 * @param bool    $none    Whether you want to add "none" option ( to set layout to "off")
 * @param array   $exclude    Array to optionally exclude some of layouts
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_main_layouts' ) ):
	function herald_get_main_layouts( $inherit = false, $none = false, $exclude = array() ) {

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/inherit.png', 'col' => 0 );
		}

		if ( $none ) {
			$layouts['none'] = array( 'title' => esc_html__( 'None', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/none.png', 'col' => 0 );
		}

		$layouts['a'] = array( 'title' => esc_html__( 'Layout A', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_a.png', 'col' => 12 );
		$layouts['a1'] = array( 'title' => esc_html__( 'Layout A1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_a1.png', 'col' => 12 );
		$layouts['a2'] = array( 'title' => esc_html__( 'Layout A2', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_a2.png', 'col' => 12 );
		$layouts['a3'] = array( 'title' => esc_html__( 'Layout A3', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_a3.png', 'col' => 12 );
		$layouts['b'] = array( 'title' => esc_html__( 'Layout B', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_b.png', 'col' => 12 );
		$layouts['b1'] = array( 'title' => esc_html__( 'Layout B1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_b1.png', 'col' => 12 );
		$layouts['c'] = array( 'title' => esc_html__( 'Layout C', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_c.png', 'col' => 6 );
		$layouts['c1'] = array( 'title' => esc_html__( 'Layout C1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_c1.png', 'col' => 6 );
		$layouts['d'] = array( 'title' => esc_html__( 'Layout D', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_d.png', 'col' => 6 );
		$layouts['d1'] = array( 'title' => esc_html__( 'Layout D1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_d1.png', 'col' => 6 );
		$layouts['e'] = array( 'title' => esc_html__( 'Layout E', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_e.png', 'col' => 6 );
		$layouts['f'] = array( 'title' => esc_html__( 'Layout F', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_f.png', 'col' => 4 );
		$layouts['f1'] = array( 'title' => esc_html__( 'Layout F1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_f1.png', 'col' => 4 );
		$layouts['g'] = array( 'title' => esc_html__( 'Layout G', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_g.png', 'col' => 4 );
		$layouts['g1'] = array( 'title' => esc_html__( 'Layout G1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_g1.png', 'col' => 4 );
		$layouts['h'] = array( 'title' => esc_html__( 'Layout H', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_h.png', 'col' => 4 );
		$layouts['i'] = array( 'title' => esc_html__( 'Layout I', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_i.png', 'col' => 3 );
		$layouts['i1'] = array( 'title' => esc_html__( 'Layout I1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_i1.png', 'col' => 3 );
		$layouts['j'] = array( 'title' => esc_html__( 'Layout J', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_j.png', 'col' => 3 );
		$layouts['k'] = array( 'title' => esc_html__( 'Layout K', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_k.png', 'col' => 2 );
		$layouts['l'] = array( 'title' => esc_html__( 'Layout L', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_l.png', 'col' => 2 );

		if( !empty( $exclude ) ){

			foreach($exclude as $layout){
				if(array_key_exists($layout, $layouts)){
					unset($layouts[$layout]);
				}
			}
		}

		$layouts = apply_filters('herald_modify_main_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
		
	}
endif;

/**
 * Get the list of available featured layouts
 *
 * @param bool    $ihnerit Whether you want to add "inherit" option
 * @param bool    $none    Whether you want to add "none" option ( to set layout to "off")
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_featured_layouts' ) ):
	function herald_get_featured_layouts( $inherit = false, $none = false ) {

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/inherit.png');
		}

		if ( $none ) {
			$layouts['none'] = array( 'title' => esc_html__( 'None', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/none.png');
		}

		$layouts['1'] = array( 'title' => esc_html__( 'Layout 1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_fa1.png');
		$layouts['2'] = array( 'title' => esc_html__( 'Layout 2', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_fa2.png');
		$layouts['3'] = array( 'title' => esc_html__( 'Layout 3', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_fa3.png');
		$layouts['4'] = array( 'title' => esc_html__( 'Layout 4', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_fa4.png');
		$layouts['5'] = array( 'title' => esc_html__( 'Layout 5', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/layout_fa5.png');

		$layouts = apply_filters('herald_modify_featured_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
		
	}
endif;



/**
 * Get the list of available authors layouts
 *
 * @param bool    $ihnerit Whether you want to add "inherit" option
 * @param bool    $none    Whether you want to add "none" option ( to set layout to "off")
 * @param array   $exclude    Array to optionally exclude some of layouts
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_author_layouts' ) ):
	function herald_get_author_layouts( $inherit = false, $none = false, $exclude = array() ) {

		$layouts['col1'] = array( 'title' => esc_html__( 'Layout 1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/authors_layout_1.png', 'col' => 12 );
		$layouts['col2'] = array( 'title' => esc_html__( 'Layout 2', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/authors_layout_2.png', 'col' => 12 );
		$layouts['col3'] = array( 'title' => esc_html__( 'Layout 3', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/authors_layout_3.png', 'col' => 12 );

		if( !empty( $exclude ) ){

			foreach($exclude as $layout){
				if(array_key_exists($layout, $layouts)){
					unset($layouts[$layout]);
				}
			}
		}

		$layouts = apply_filters('herald_modify_author_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
		
	}
endif;



/**
 * Get the list of available sidebar layouts
 *
 * You may have left sidebar, right sidebar or no sidebar
 *
 * @param bool    $ihnerit Whether you want to include "inherit" option in the list
 * @return array List of available sidebar layouts
 * @since  1.0
 */

if ( !function_exists( 'herald_get_sidebar_layouts' ) ):
	function herald_get_sidebar_layouts( $inherit = false ) {

		$layouts = array();

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/inherit.png' );
		}

		$layouts['none'] = array( 'title' => esc_html__( 'None', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/none.png' );
		$layouts['left'] = array( 'title' => esc_html__( 'Left sidebar', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/content_sid_left.png' );
		$layouts['right'] = array( 'title' => esc_html__( 'Right sidebar', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/content_sid_right.png' );

		$layouts = apply_filters('herald_modify_sidebar_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
	}
endif;

/**
 * Get the list of available pagination types
 *
 * @param bool    $ihnerit Whether you want to include "inherit" option in the list
 * @param bool    $none    Whether you want to add "none" option ( to set layout to "off")
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_pagination_layouts' ) ):
	function herald_get_pagination_layouts( $inherit = false, $none = false ) {

		$layouts = array();

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/inherit.png' );
		}

		if ( $none ) {
			$layouts['none'] = array( 'title' => esc_html__( 'None', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/none.png' );
		}

		$layouts['numeric'] = array( 'title' => esc_html__( 'Numeric pagination links', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/pag_numeric.png' );
		$layouts['prev-next'] = array( 'title' => esc_html__( 'Prev/Next page links', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/pag_prev_next.png' );
		$layouts['load-more'] = array( 'title' => esc_html__( 'Load more button', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/pag_load_more.png' );
		$layouts['infinite-scroll'] = array( 'title' => esc_html__( 'Infinite scroll', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/pag_infinite.png' );
		
		$layouts = apply_filters('herald_modify_pagination_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
	}
endif;

/**
 * Get the list of available meta bar layouts
 *
 *
 * @param bool    $ihnerit Whether you want to include "inherit" option in the list
 * @return array List of available meta bar layouts
 * @since  1.3
 */

if ( !function_exists( 'herald_get_meta_bar_layouts' ) ):
	function herald_get_meta_bar_layouts( $inherit = false ) {

		$layouts = array();

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/inherit.png' );
		}

		$layouts['left'] = array( 'title' => esc_html__( 'Left', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/meta_left.png' );
		$layouts['right'] = array( 'title' => esc_html__( 'Right', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/meta_right.png' );
		$layouts['none'] = array( 'title' => esc_html__( 'None', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/meta_none.png' );

		$layouts = apply_filters('herald_modify_meta_bar_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
	}
endif;


/**
 * Get the list of registered sidebars
 *
 * @param bool    $ihnerit Whether you want to include "inherit" option in the list
 * @return array Returns list of available sidebars
 * @since  1.0
 */

if ( !function_exists( 'herald_get_sidebars_list' ) ):
	function herald_get_sidebars_list( $inherit = false ) {

		$sidebars = array();

		if ( $inherit ) {
			$sidebars['inherit'] = esc_html__( 'Inherit', 'herald' );
		}

		$sidebars['none'] = esc_html__( 'None', 'herald' );

		global $wp_registered_sidebars;

		if ( !empty( $wp_registered_sidebars ) ) {

			foreach ( $wp_registered_sidebars as $sidebar ) {
				$sidebars[$sidebar['id']] = $sidebar['name'];
			}

		}
		//Get sidebars from wp_options if global var is not loaded yet
		$fallback_sidebars = get_option( 'herald_registered_sidebars' );
		if ( !empty( $fallback_sidebars ) ) {
			foreach ( $fallback_sidebars as $sidebar ) {
				if ( !array_key_exists( $sidebar['id'], $sidebars ) ) {
					$sidebars[$sidebar['id']] = $sidebar['name'];
				}
			}
		}

		//Check for theme additional sidebars
		$custom_sidebars = herald_get_option( 'sidebars' );

		if ( $custom_sidebars ) {
			foreach ( $custom_sidebars as $k => $title) {
				if ( is_numeric($k) && !array_key_exists( 'herald_sidebar_'.$k, $sidebars ) ) {
					$sidebars['herald_sidebar_'.$k] = $title;
				}
			}
		}

		//Do not display footer sidebars for selection
		unset( $sidebars['herald_footer_sidebar_1'] );
		unset( $sidebars['herald_footer_sidebar_2'] );
		unset( $sidebars['herald_footer_sidebar_3'] );
		unset( $sidebars['herald_footer_sidebar_4'] );

		$sidebars = apply_filters('herald_modify_sidebars_list', $sidebars ); //Allow child themes or plugins to modify
		return $sidebars;
	}
endif;


/**
 * Get the list of single post layouts
 *
 * @param bool    $ihnerit Whether you want to add "inherit" option or not
 * @return array Returns list of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_single_layouts' ) ):
	function herald_get_single_layouts( $inherit = false ) {

		$layouts = array();

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/inherit.png' );
		}

		$layouts['1'] = array( 'title' => esc_html__( 'Layout 1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_1.png' );
		$layouts['2'] = array( 'title' => esc_html__( 'Layout 2', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_2.png' );
		$layouts['3'] = array( 'title' => esc_html__( 'Layout 3', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_3.png' );
		$layouts['4'] = array( 'title' => esc_html__( 'Layout 4', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_4.png' );
		$layouts['5'] = array( 'title' => esc_html__( 'Layout 5', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_5.png' );
		$layouts['6'] = array( 'title' => esc_html__( 'Layout 6', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_6.png' );
		$layouts['7'] = array( 'title' => esc_html__( 'Layout 7', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_7.png' );
		$layouts['8'] = array( 'title' => esc_html__( 'Layout 8', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_8.png' );
		$layouts['9'] = array( 'title' => esc_html__( 'Layout 9', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/single_9.png' );

		$layouts = apply_filters('herald_modify_single_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
	}
endif;


/**
 * Get the list of page layouts
 *
 * @param bool    $ihnerit Whether you want to add "inherit" option or not
 * @return array Returns list of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_page_layouts' ) ):
	function herald_get_page_layouts( $inherit = false ) {

		$layouts = array();

		if ( $inherit ) {
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/inherit.png' );
		}

		$layouts['1'] = array( 'title' => esc_html__( 'Layout 1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/page_1.png' );
		$layouts['2'] = array( 'title' => esc_html__( 'Layout 2', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/page_2.png' );
		$layouts['3'] = array( 'title' => esc_html__( 'Layout 3', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/page_3.png' );
		$layouts['4'] = array( 'title' => esc_html__( 'Layout 4', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/page_4.png' );
		$layouts['5'] = array( 'title' => esc_html__( 'Layout 5', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/page_5.png' );
		$layouts['6'] = array( 'title' => esc_html__( 'Layout 6', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/page_6.png' );

		$layouts = apply_filters('herald_modify_page_layouts', $layouts ); //Allow child themes or plugins to modify
		return $layouts;
	}
endif;


/**
 * Get module columns
 * 
 * It gets the list of options to specify width of a module
 * 
 * @return   array Available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_module_columns' ) ):
	function herald_get_module_columns() {

		$options['12'] = array( 'title' => esc_html__( '1/1', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/col_12.png' );
		$options['6'] = array( 'title' => esc_html__( '1/2', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/col_6.png' );
		$options['4'] = array( 'title' => esc_html__( '1/3', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/col_4.png' );
		$options['8'] = array( 'title' => esc_html__( '2/3', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/col_8.png' );
		$options['3'] = array( 'title' => esc_html__( '1/4', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/col_3.png' );
		$options['9'] = array( 'title' => esc_html__( '3/4', 'herald' ), 'img' => get_template_directory_uri() . '/assets/img/admin/col_9.png' );

		$options = apply_filters('herald_modify_module_columns', $options ); //Allow child themes or plugins to modify
		return $options;
		
	}
endif;

/**
 * Get meta options
 *
 * @param   array $default Enable defaults i.e. array('date', 'comments')
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_meta_opts' ) ):
	function herald_get_meta_opts(	$default = array() ) {

		$options = array();

		$options['date'] = esc_html__( 'Date', 'herald' );
		$options['modified_date'] = esc_html__( 'Modified date', 'herald' );
		$options['time'] = esc_html__( 'Time', 'herald' );
		$options['comments'] = esc_html__( 'Comments', 'herald' );
		$options['author'] = esc_html__( 'Author', 'herald' );
		$options['views'] = esc_html__( 'Views', 'herald' );
		$options['rtime'] = esc_html__( 'Reading time', 'herald' );

		if( herald_is_wp_review_active() ){
			$options['reviews'] = esc_html__( 'Reviews', 'herald' );
		}

		if(!empty($default)){
			foreach($options as $key => $option){
				if(in_array( $key, $default)){
					$options[$key] = 1;
				} else {
					$options[$key] = 0;
				}
			}
		}

		$options = apply_filters('herald_modify_meta_opts', $options ); //Allow child themes or plugins to modify
		return $options;
	}
endif;

/**
 * Get image ratio options
 *
 * @param   bool $original Wheter to include "original (not cropped)" ratio option
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'herald_get_image_ratio_opts' ) ):
	function herald_get_image_ratio_opts( $original = false ) {

		$options = array();

		if ( $original ) {
			$options['original'] = esc_html__( 'Original (ratio as uploaded - do not crop)', 'herald' );
		}

		$options['16_9'] = esc_html__( '16:9', 'herald' );
		$options['3_2'] = esc_html__( '3:2', 'herald' );
		$options['4_3'] = esc_html__( '4:3', 'herald' );
		$options['1_1'] = esc_html__( '1:1 (square)', 'herald' );
		$options['custom'] = esc_html__( 'Your custom ratio', 'herald' );

		$options = apply_filters('herald_modify_image_ratio_opts', $options ); //Allow child themes or plugins to modify
		return $options;
	}
endif;


/**
 * Get header elements
 *
 * Functions gets the list (array) of elements which can be placed in header
 *
 * @param  string $type top|main|bottom|sticky
 * @return array List of available elements
 * @since  1.0
 */

if ( !function_exists( 'herald_get_header_elements' ) ):
	function herald_get_header_elements( $type = 'top' , $position = 'left',  $default = false ) {
		
		$options = array(
			'logo' => array( 'title' => esc_html__('Logo/Title', 'herald'), 'dep' => array( 'middle' => array( 'left'), 'sticky' => array() ) ),
			'logo-mini' => array( 'title' => esc_html__('Mini logo', 'herald'), 'dep' => array( 'bottom' => array(), 'sticky' => array( 'left' ) ) ),
			'main-menu' => array( 'title' => esc_html__('Main menu', 'herald'), 'dep' => array( 'middle' => array(), 'bottom' => array('left'), 'sticky' => array('right') ) ),
			'social-menu' => array( 'title' => esc_html__('Social menu (icons list)', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array('right'), 'sticky' => array() ) ),
			'social-menu-drop' => array( 'title' => esc_html__('Social menu (icon/dropdown)', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array(), 'sticky' => array() ) ),
			'ad' => array( 'title' => esc_html__('Ad', 'herald'), 'dep' => array( 'middle' => array('right') ) ),
			'search' => array( 'title' => esc_html__('Search (form)', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array(), 'sticky' => array() ) ),
			'search-drop' => array( 'title' => esc_html__('Search (icon/dropdown)', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array('left'), 'sticky' => array() ) ),
			'secondary-menu-1' => array( 'title' => esc_html__('Secondary menu 1', 'herald'), 'dep' => array( 'top' => array( 'left' ), 'middle' => array(), 'bottom' => array(), 'sticky' => array() ) ),
			'secondary-menu-2' => array( 'title' => esc_html__('Secondary menu 2', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array(), 'sticky' => array() ) ),
			'secondary-menu-3' => array( 'title' => esc_html__('Secondary menu 3', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array(), 'sticky' => array() ) ),
			'site-desc' => array( 'title' => esc_html__('Site desription', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array(), 'sticky' => array()) ),
			'date' => array( 'title' => esc_html__('Current date', 'herald'), 'dep' => array( 'top' => array('right'), 'bottom' => array() ) ),
			'login-form' => array( 'title' => esc_html__('Login form (icon/dropdown)', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array(), 'sticky' => array() ) ),
		);

		if ( herald_is_woocommerce_active() ){
			$options['woocommerce-cart-icon'] = array( 'title' => esc_html__('WooCommerce Cart Icon', 'herald'), 'dep' => array( 'top' => array(), 'middle' => array(), 'bottom' => array(), 'sticky' => array() ) );
		}

		$options = apply_filters('herald_modify_header_elements', $options ); //Allow child themes or plugins to modify

		foreach( $options as $opt => $data ){
			if( array_key_exists( $type, $data['dep'] ) ){
				if(!$default){
					$output[$opt] = $data['title'];
				} else {
					if( in_array($position, $data['dep'][$type])){
						$output[$opt] = 1;
					} else {
						$output[$opt] = 0;
					}
				}
			}
		}

		return $output;
	}
endif;

/**
 * Get footer elements
 *
 * Functions gets the list (array) of elements which can be placed in footer copyright bar
 *
 * @param  string $type top|main|bottom|sticky
 * @return array List of available elements
 * @since  1.0
 */

if ( !function_exists( 'herald_get_footer_elements' ) ):
	function herald_get_footer_elements( $position = 'left',  $default = false ) {
		
		$options = array(
			'copyright' => array( 'title' => esc_html__('Copyright text', 'herald'), 'dep' => array( 'left' ) ),
			'social-menu' => array( 'title' => esc_html__('Social menu', 'herald'), 'dep' => array('right') ),
			'secondary-menu-1' => array( 'title' => esc_html__('Secondary menu 1', 'herald'), 'dep' => array() ),
			'secondary-menu-2' => array( 'title' => esc_html__('Secondary menu 2', 'herald'), 'dep' => array() ),
			'secondary-menu-3' => array( 'title' => esc_html__('Secondary menu 3', 'herald'), 'dep' => array() ),
			'date' => array( 'title' => esc_html__('Current date', 'herald'), 'dep' => array() ),
		);

		$options = apply_filters('herald_modify_footer_elements', $options ); //Allow child themes or plugins to modify

		foreach( $options as $opt => $data ){
			if(!$default){
				$output[$opt] = $data['title'];
			} else {
				if( in_array($position, $data['dep'])){
					$output[$opt] = 1;
				} else {
					$output[$opt] = 0;
				}
			}
		}

		return $output;
	}
endif;

/**
 * Check if there is available theme update
 *
 * @return string HTML output with update notification and the link to change log
 * @since  1.0
 */

if ( !function_exists( 'herald_get_update_notification' ) ):
	function herald_get_update_notification() {
		$current = get_site_transient( 'update_themes' );
		$message_html = '';
		if ( isset( $current->response['herald'] ) ) {
			$message_html = '<span class="update-message">New update available!</span>
                <span class="update-actions">Version '.$current->response['herald']['new_version'].': <a href="http://demo.mekshq.com/herald/documentation#changelog" target="blank">See what\'s new</a><a href="'.admin_url( 'update-core.php' ).'">Update</a></span>';
		}

		return $message_html;
	}
endif;

/**
 * Sort option items
 *
 * Use this function to properly order sortable options like in categories and series module
 *
 * @param unknown $items    Array of items
 * @param unknown $selected Array of IDs of currently selected items
 * @return array ordered items
 * @since  1.0
 */

if ( !function_exists( 'herald_sort_option_items' ) ):
	function herald_sort_option_items( $items, $selected, $field = 'term_id' ) {

		if ( empty( $selected ) ) {
			return $items;
		}

		$new_items = array();
		$temp_items = array();
		$temp_items_ids = array();

		foreach ( $selected as $selected_item_id ) {

			foreach ( $items as $item ) {
				if ( $selected_item_id == $item->$field ) {
					$new_items[] = $item;
				} else {
					if ( !in_array( $item->$field, $selected ) && !in_array( $item->$field, $temp_items_ids ) ) {
						$temp_items[] = $item;
						$temp_items_ids[] = $item->$field;
					}
				}
			}

		}

		$new_items = array_merge( $new_items, $temp_items );

		return $new_items;
	}
endif;


/**
 * Get Admin JS localized variables 
 *
 * Function creates list of variables from theme to pass
 * them to global JS variable so we can use it in JS files
 *
 * @since  1.9 
 * 
 * @return array List of JS settings
 */
if ( !function_exists( 'herald_get_admin_js_settings' ) ):
	function herald_get_admin_js_settings() {
		
		$js_settings = array();
		$js_settings['ajax_url'] = admin_url( 'admin-ajax.php');
		$js_settings['is_gutenberg'] = herald_is_gutenberg_page();
		return $js_settings;
	}
endif;


/**
 * Get author social links
 *
 * @since  2.1
 *
 * @param   array $default Enable defaults i.e. array('twitter')
 * @return array List of available options
 */

if ( !function_exists( 'herald_get_author_social_opts' ) ):
	function herald_get_author_social_opts( $default = array() ) {

		$options = array();

		$options['twitter'] = esc_html__( 'Twitter', 'herald' );
		$options['facebook'] = esc_html__( 'Facebook', 'herald' );
		$options['instagram'] = esc_html__( 'Instagram', 'herald' );


		if(!empty($default)){
			foreach($options as $key => $option){
				if(in_array( $key, $default)){
					$options[$key] = 1;
				} else {
					$options[$key] = 0;
				}
			}
		}

		$options = apply_filters('herald_modify_author_social_opts', $options ); 
		return $options;
	}
endif;

?>