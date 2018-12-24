<?php

add_action( 'widgets_init', 'herald_register_sidebars' );

/**
 * Register sidebars
 *
 * Callback function for theme sidebars registration and init
 * 
 * @return void
 * @since  1.0
 */

if ( !function_exists( 'herald_register_sidebars' ) ) :
	function herald_register_sidebars() {
		
		/* Default Sidebar */
		register_sidebar(
			array(
				'id' => 'herald_default_sidebar',
				'name' => esc_html__( 'Default Sidebar', 'herald' ),
				'description' => esc_html__( 'This is default sidebar.', 'herald' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title h6"><span>',
				'after_title' => '</span></h4>'
			)
		);

		/* Default Sticky Sidebar */
		register_sidebar(
			array(
				'id' => 'herald_default_sticky_sidebar',
				'name' => esc_html__( 'Default Sticky Sidebar', 'herald' ),
				'description' => esc_html__( 'This is default sticky sidebar. Sticky means that it will be always pinned to top while you are scrolling through your website content.', 'herald' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title h6"><span>',
				'after_title' => '</span></h4>'
			)
		);



		/* Add sidebars from theme options */
		$custom_sidebars = herald_get_option( 'sidebars' );

		if (!empty( $custom_sidebars ) ){
			foreach ( $custom_sidebars as $key => $title) {
				
				if ( is_numeric($key) ) {
					register_sidebar(
						array(
							'id' => 'herald_sidebar_'.$key,
							'name' => $title,
							'description' => '',
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<h4 class="widget-title h6"><span>',
							'after_title' => '</span></h4>'
						)
					);
				}
			}
		}


		/* Footer Sidebar Area 1*/
		register_sidebar(
			array(
				'id' => 'herald_footer_sidebar_1',
				'name' => esc_html__( 'Footer Column 1', 'herald' ),
				'description' => esc_html__( 'This is footer area column 1.', 'herald' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title h6"><span>',
				'after_title' => '</span></h4>'
			)
		);

		/* Footer Sidebar Area 2*/
		register_sidebar(
			array(
				'id' => 'herald_footer_sidebar_2',
				'name' => esc_html__( 'Footer Column 2', 'herald' ),
				'description' => esc_html__( 'This footer area column 2.', 'herald' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title h6"><span>',
				'after_title' => '</span></h4>'
			)
		);


		/* Footer Sidebar Area 3*/
		register_sidebar(
			array(
				'id' => 'herald_footer_sidebar_3',
				'name' => esc_html__( 'Footer Column 3', 'herald' ),
				'description' => esc_html__( 'This footer area column 3.', 'herald' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title h6"><span>',
				'after_title' => '</span></h4>'
			)
		);

		/* Footer Sidebar Area 4 */
		register_sidebar(
			array(
				'id' => 'herald_footer_sidebar_4',
				'name' => esc_html__( 'Footer Column 4', 'herald' ),
				'description' => esc_html__( 'This is footer area column 4.', 'herald' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title h6"><span>',
				'after_title' => '</span></h4>'
			)
		);

	}

endif;



add_action( 'wp', 'herald_set_current_sidebar' );

/**
 * Set current sidebar
 *
 * It checks which sidebar to display based on current template options 
 * and creates a global variable $herald_sidebar_opts
 *
 * @return array Sidebar layout and values
 * @since  1.0
 */

if ( !function_exists( 'herald_set_current_sidebar' ) ):
	function herald_set_current_sidebar() {
		
		global $herald_sidebar_opts;
		
		/* Default */
		$use_sidebar = 'none';
		$sidebar = 'herald_default_sidebar';
		$sticky_sidebar = 'herald_default_sticky_sidebar';

		$herald_template = herald_detect_template();

		if ( in_array( $herald_template, array( 'search', 'tag', 'author', 'archive', 'product', 'product_cat', 'forum', 'topic', 'bb_user' ) ) ) {

			$use_sidebar = herald_get_option( $herald_template.'_use_sidebar' );

			if ( $use_sidebar != 'none' ) {
				$sidebar = herald_get_option( $herald_template.'_sidebar' );
				$sticky_sidebar = herald_get_option( $herald_template.'_sticky_sidebar' );
			}

		} else if ( $herald_template == 'category' ) {
				$obj = get_queried_object();
				if ( isset( $obj->term_id ) ) {
					$meta = herald_get_category_meta( $obj->term_id );
				}

				if ( $meta['use_sidebar'] != 'none' ) {
					$use_sidebar = ( $meta['use_sidebar'] == 'inherit' ) ? herald_get_option( $herald_template.'_use_sidebar' ) : $meta['use_sidebar'];
					if ( $use_sidebar ) {
						$sidebar = ( $meta['sidebar'] == 'inherit' ) ?  herald_get_option( $herald_template.'_sidebar' ) : $meta['sidebar'];
						$sticky_sidebar = ( $meta['sticky_sidebar'] == 'inherit' ) ?  herald_get_option( $herald_template.'_sticky_sidebar' ) : $meta['sticky_sidebar'];
					}
				}

			} else if ( $herald_template == 'single' ) {

				$meta = herald_get_post_meta();
				$use_sidebar = ( $meta['use_sidebar'] == 'inherit' ) ? herald_get_option( $herald_template.'_use_sidebar' ) : $meta['use_sidebar'];
				if ( $use_sidebar != 'none' ) {
					$sidebar = ( $meta['sidebar'] == 'inherit' ) ?  herald_get_option( $herald_template.'_sidebar' ) : $meta['sidebar'];
					$sticky_sidebar = ( $meta['sticky_sidebar'] == 'inherit' ) ?  herald_get_option( $herald_template.'_sticky_sidebar' ) : $meta['sticky_sidebar'];
				}

			} else if ($herald_template == 'page' ) {
				
				$meta = herald_get_page_meta();
				$use_sidebar = ( $meta['use_sidebar'] == 'inherit' ) ? herald_get_option( 'page_use_sidebar' ) : $meta['use_sidebar'];
				if ( $use_sidebar != 'none' ) {
					$sidebar = ( $meta['sidebar'] == 'inherit' ) ?  herald_get_option( 'page_sidebar' ) : $meta['sidebar'];
					$sticky_sidebar = ( $meta['sticky_sidebar'] == 'inherit' ) ?  herald_get_option( 'page_sticky_sidebar' ) : $meta['sticky_sidebar'];
				}

			}

		$herald_sidebar_opts = array(
			'use_sidebar' => $use_sidebar,
			'sidebar' => $sidebar,
			'sticky_sidebar' => $sticky_sidebar
		);

	}
endif;

?>