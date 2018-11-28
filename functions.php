<?php // start every pure php file


// ---------------------------------------------------------------------
// Add scripts and stylesheets
// ---------------------------------------------------------------------
function math2itwp_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.1.3' );
  wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css' );
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.0' );
  wp_enqueue_style( 'fontello', get_template_directory_uri() . '/css/fontello/fontello.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '4.1.3', true );
}
add_action( 'wp_enqueue_scripts', 'math2itwp_scripts' );


// ---------------------------------------------------------------------
// Add Google Fonts
// ---------------------------------------------------------------------
function math2itwp_google_fonts() {
  wp_register_style('Comfortaa', 'http://fonts.googleapis.com/css?family=Comfortaa:400,700&amp;subset=vietnamese');
  wp_enqueue_style( 'Comfortaa'); // default font
  wp_register_style('Righteous', 'http://fonts.googleapis.com/css?family=Righteous'); // math2it's index title
  wp_enqueue_style( 'Righteous');
}
add_action('wp_print_styles', 'math2itwp_google_fonts');



// ---------------------------------------------------------------------
// WordPress Titles
// ---------------------------------------------------------------------
add_theme_support( 'title-tag' );



// ---------------------------------------------------------------------
// Support Featured Images
// ---------------------------------------------------------------------
add_theme_support( 'post-thumbnails' );



// ---------------------------------------------------------------------
// Custom settings
// ---------------------------------------------------------------------
function custom_settings_add_menu() {
  add_menu_page( 'Math2IT Settings', 'Math2IT Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
  <div class="wrap">
    <h1>Math2IT Settings</h1>
    <form method="post" action="options.php">
       <?php
           settings_fields( 'section' );
           do_settings_sections( 'theme-options' );      
           submit_button(); 
       ?>          
    </form>
  </div>
<?php }

// Twitter
function setting_twitter() { ?>
  <input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

// Github
function setting_github() { ?>
  <input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

// Facebook
function setting_facebook() { ?>
  <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }
function setting_facebook_group() { ?>
  <input type="text" name="facebook-group" id="facebook-group" value="<?php echo get_option('facebook-group'); ?>" />
<?php }


// set up the page to show, accept and save the option fields.
function custom_settings_page_setup() {
  add_settings_section( 'section', 'All Settings', null, 'theme-options' );
  add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
  add_settings_field( 'github', 'Github URL', 'setting_github', 'theme-options', 'section' );
  add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );
  add_settings_field( 'facebook-group', 'Facebook Group URL', 'setting_facebook_group', 'theme-options', 'section' );

  register_setting('section', 'twitter');
  register_setting('section', 'github');
  register_setting('section', 'facebook');
  register_setting('section', 'facebook-group');
}
add_action( 'admin_init', 'custom_settings_page_setup' );



// ---------------------------------------------------------------------
// Custom Post Type
// ---------------------------------------------------------------------
function create_my_custom_post() {
	register_post_type( 'my-custom-post',
    array(
			'labels' => array(
					'name' => __( 'My Custom Post' ),
					'singular_name' => __( 'My Custom Post' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
				  'custom-fields'
      ),
      'taxonomies'   => array(
				'post_tag',
				'category',
			)
    )
  );
  register_taxonomy_for_object_type( 'category', 'my-custom-post' );
	register_taxonomy_for_object_type( 'post_tag', 'my-custom-post' );
}
add_action( 'init', 'create_my_custom_post' );



// ---------------------------------------------------------------------
// Add custom menus to theme
// ---------------------------------------------------------------------
function wp_custom_new_menu() {
  register_nav_menus(
    array(
      'math2it-custom-menu' => __( 'Math2IT Menu' ),
    )
  );
}
add_action( 'init', 'wp_custom_new_menu' );




// ---------------------------------------------------------------------
// Custom item modification in nav
// Using Avanced Custom Field plugin
// cf. http://bit.ly/2DLeD62
// ---------------------------------------------------------------------
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
    function start_el(&$output, $item, $depth, $args)
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



// ---------------------------------------------------------------------
// Additional setting field
// cf. http://bit.ly/2BCZW3m
// cf. http://bit.ly/2E1ELdt
// ---------------------------------------------------------------------
add_action('admin_init', 'my_general_section');  
function my_general_section() {  
    add_settings_section(  
        'my_settings_section', // Section ID 
        'My Options Title', // Section Title
        'my_section_options_callback', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'option_1', // Option ID
        'Option 1', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'option_1' // Should match Option ID
        )  
    ); 

    add_settings_field( // Option 2
        'option_2', // Option ID
        'Option 2', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'option_2' // Should match Option ID
        )  
    ); 

    register_setting('general','option_1', 'esc_attr');
    register_setting('general','option_2', 'esc_attr');
}

function my_section_options_callback() { // Section Callback
    echo '<p>A little message on editing info</p>';  
}

function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}



if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}