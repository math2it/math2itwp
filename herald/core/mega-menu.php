<?php

add_action( 'init', 'herald_add_mega_menu_support' );

/* Add support for our built in mega menu system */
if ( !function_exists( 'herald_add_mega_menu_support' ) ):
	function herald_add_mega_menu_support() {

		if ( herald_get_option( 'mega_menu' ) ) {
			add_filter( 'wp_edit_nav_menu_walker', 'herald_edit_menu_walker', 10, 2 );
			add_filter( 'wp_setup_nav_menu_item', 'herald_add_custom_nav_fields' );
			add_action( 'wp_update_nav_menu_item', 'herald_update_custom_nav_fields', 10, 3 );
			add_filter( 'nav_menu_css_class', 'herald_add_class_to_menu', 10, 2 );
		}
	}
endif;

/* Add custom fields to menu */
if ( !function_exists( 'herald_add_custom_nav_fields' ) ):
	function herald_add_custom_nav_fields( $menu_item ) {
		$menu_item->mega_menu_cat = get_post_meta( $menu_item->ID, '_herald_mega_menu_cat', true ) ? 1 : 0;
		$menu_item->mega_menu = get_post_meta( $menu_item->ID, '_herald_mega_menu', true ) ? 1 : 0;
		return $menu_item;
	}
endif;


/* Save custom fiedls to menu */
if ( !function_exists( 'herald_update_custom_nav_fields' ) ):
	function herald_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		if ( $args['menu-item-object'] == 'category' ) {
			$value = isset( $_REQUEST['menu-item-mega-menu-cat'][$menu_item_db_id] ) ? 1 : 0;
			update_post_meta( $menu_item_db_id, '_herald_mega_menu_cat', $value );
		} else {
			$value = isset( $_REQUEST['menu-item-mega-menu'][$menu_item_db_id] ) ? 1 : 0;
			update_post_meta( $menu_item_db_id, '_herald_mega_menu', $value );
		}
	}
endif;


/* Display our fields in admin */
if ( !function_exists( 'herald_edit_menu_walker' ) ):
	function herald_edit_menu_walker( $walker, $menu_id ) {

		class herald_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {

			public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
				$temp_output = '';
				$mega_menu_html = '';

				if($depth == 0 ){
					if ( $item->object == 'category' ) {
						$mega_menu_html .= '<p class="field-custom description description-wide">
			                <label for="edit-menu-item-mega-'.$item->db_id.'">
			        		<input type="checkbox" id="edit-menu-item-mega-'.$item->db_id.'" class="widefat code edit-menu-item-custom" name="menu-item-mega-menu-cat['.$item->db_id.']" value="1" '.checked( $item->mega_menu_cat, 1, false ). ' />
			                '.esc_html__( 'Mega Menu (display posts from category)', 'herald' ).'</label>
			            </p>';
					} else {
						$mega_menu_html .= '<p class="field-custom description description-wide">
			                <label for="edit-menu-item-mega-'.$item->db_id.'">
			        		<input type="checkbox" id="edit-menu-item-mega-'.$item->db_id.'" class="widefat code edit-menu-item-custom" name="menu-item-mega-menu['.$item->db_id.']" value="1" '.checked( $item->mega_menu, 1, false ). ' />
			                '.esc_html__( 'Mega Menu (classic)', 'herald' ).'
			            </label></p>';
					}
				}

				parent::start_el( $temp_output, $item, $depth, $args, $id );

				$temp_output = preg_replace( '/(?=<div.*submitbox)/', $mega_menu_html, $temp_output );

				$output .= $temp_output;
			}

		}

		return 'herald_Walker_Nav_Menu_Edit';
	}
endif;


/* Add class to menu item when mega menu is detected */
if ( !function_exists( 'herald_add_class_to_menu' ) ):
	function herald_add_class_to_menu( $classes, $item ) {

		if ( $item->object == 'category' && !$item->menu_item_parent && isset( $item->mega_menu_cat ) && $item->mega_menu_cat ) {
			$classes[] = 'herald-mega-menu';
		}

		if ( !$item->menu_item_parent && isset( $item->mega_menu ) && $item->mega_menu ) {
			$classes[] = 'herald-mega-menu';
			$classes[] = 'herald-mega-menu-classic';
		}

		return $classes;

	}
endif;

/* Output category mega menu */
if ( !function_exists( 'herald_load_mega_menu' ) ) :

	function herald_load_mega_menu( $cat_id ) {
		
		global $wp_query;
		
		$output = '';
		$ppp = herald_get_option('mega_menu_limit');
		$sub_cat_nav = herald_get_option('mega_menu_sub_cat');
		$layout = herald_get_option('mega_menu_layout');
		$sub_cats = array();

		if ( $sub_cat_nav ) {
			$sub_cats = get_categories( array( 'parent' => $cat_id, 'hide_empty' => false ) );
		}

		$has_sub_cats = $sub_cat_nav && !empty($sub_cats) ? true : false;

		$section_class = $has_sub_cats ? '' : 'herald-no-sid';
		$wrap_class = $has_sub_cats ? 'col-lg-9' : 'col-lg-12';
		
		//html start
		$output .= '<li class="container herald-section '.$section_class.'"><div class="row">';

		
		//sub cats
		if( $has_sub_cats ){

			$output .= '<div class="col-lg-3 herald-mega-menu-sub-cats"><ul>';

			foreach ( $sub_cats as $cat ) {
				$cat_link = get_category_link( $cat );
				$output .= '<li><a href="'.esc_url( $cat_link ).'">'.$cat->name.'</a></li>';
			}

			$output .= '</ul></div>';
		}

		//posts
		$output .= '<div class="herald-module '.$wrap_class.'"><div class="row row-eq-height">';

		if( $has_sub_cats ){
			herald_set_img_flag('sid');
		} else {
			herald_set_img_flag('full');
		}

		$args = array(
			'post_type'    => 'post',
			'cat'      => $cat_id,
			'posts_per_page' => $ppp
		);

		$wp_query = new WP_Query( $args );

		ob_start();

		if ( have_posts() ) :

			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/layouts/content-'.$layout );
			endwhile;

		endif;

		wp_reset_query();

		herald_set_img_flag('');

		$output .= ob_get_clean();

		$output .= '</div></div>';
		$output .= '</div></li>';

		return $output;
	
	}

endif;

/* Mega menu walker */
class herald_Menu_Walker extends Walker_Nav_menu
{
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		
		if ( herald_get_option( 'mega_menu' ) ) {
			
			if ( $depth == 0 && ( $item->mega_menu_cat ) ) {
				
				$output .= '<ul class="sub-menu">';
				$output .= herald_load_mega_menu( $item->object_id );
				$output .= '</ul>';

			}
		}
	}
}

?>