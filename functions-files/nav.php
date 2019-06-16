<?php

// -----------------------------------------------------
// Custom item modification in nav
// Using Avanced Custom Field plugin
// cf. http://bit.ly/2DLeD62
// -----------------------------------------------------
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
	// loop
	foreach( $items as &$item ) {
		// vars
    $nav_icon = get_field('nav-icon', $item);
    $nav_color = get_field('nav-color', $item);
    $nav_classes = $item->classes;
		// append icon
		if( $nav_icon ) {
      if (array_intersect($nav_classes, array('current-menu-item'))){
        $current_style = 'style=color:'.$nav_color.';';
      }else{
        $current_style = '';
      }
			$item->title = ' <i class="'.$nav_icon.'"'.$current_style.'></i><span>'.$item->title.'</span>';
		}
	}
	// return
	return $items;
}

// remove default class in 'li'
// cf. http://bit.ly/2DT5adu
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
  // return is_array($var) ? array() : '';
  return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}

// remove ul, li and only keep <a>
// cf. http://bit.ly/2DJ7wuH
class Description_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $classes = empty($item->classes) ? array () : (array) $item->classes;
        $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        !empty ( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
        $output .= "";
        $attributes  = '';
        !empty( $item->attr_title ) and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        !empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        !empty( $item->xfn ) and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        !empty( $item->url ) and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $item_output = $args->before
        . "<a $attributes $class_names>"
        . $args->link_before
        . $title
        . '</a>'
        . $args->link_after
        . $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
function header_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'math2it-custom-menu',
		'menu'            => '',
		'container'       => '',
		'container_class' => '',
		'container_id'    => '',
		'menu_class'      => '',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
    'items_wrap'      => '%3$s',
    'depth'           => 0,
		'walker'          => new Description_Walker
		)
	);
}
