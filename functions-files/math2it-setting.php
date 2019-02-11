<?php

/* Add Menus
-----------------------------------------------------------------*/
add_action('admin_menu', 'ch_essentials_admin');
function ch_essentials_admin() {
    /* Base Menu */
    add_menu_page(
    'Math2IT Settings',
    'Math2IT Settings',
    'manage_options',
    'math2it_setting',
    'math2it_setting_display');
}

add_action('admin_init', 'ch_essentials_options');
function ch_essentials_options(){ 
  // SECTION: site settings
  add_settings_section( 
    'site_setting',
    'Site Setting',
    'site_setting_callback',
    'site_setting_option'
  );

  // facebook
  add_settings_field(
    'facebook', // id of field
    'Facebook URL', // name of field
    'site_setting_facebook', // function to call
    'site_setting_option', 
    'site_setting' // sectom id
  );

  // facebook-group
  add_settings_field(
    'facebook-group', 
    'Facebook Group URL', 
    'site_setting_facebook_group',  // function to call
    'site_setting_option', 
    'site_setting' // sectom id 
  );

  // short introduction
  add_settings_field(
    'site_short_description', 
    'Site\'s short description', 
    'site_setting_site_short_description',  // function to call
    'site_setting_option', 
    'site_setting' // sectom id 
  );

  // disqus
  add_settings_field(
    'site_disqus', 
    'Disqus\' shortname', 
    'site_setting_site_disqus',  // function to call
    'site_setting_option', 
    'site_setting' // sectom id 
  );


  /* Header Options Section */
  add_settings_section( 
    'header_setting',
    'Header: Home page',
    'header_setting_callback',
    'header_setting_option'
  );

  add_settings_field(
    'header_number_latest_post_idx', 
    'Number of latest post', 
    'header_number_latest_post_idx_call',  // function to call
    'header_setting_option', 
    'header_setting' // sectom id 
  );

  // site's setting
  register_setting('site_setting_option', 'facebook');
  register_setting('site_setting_option', 'facebook-group');
  register_setting('site_setting_option', 'site_short_description');
  register_setting('site_setting_option', 'site_disqus');

  // header
  register_setting('header_setting_option','header_number_latest_post_idx');
} // end ch_essentials_admin



function math2it_setting_display() {
?>
  <div class="wrap">  
    <div id="icon-themes" class="icon32"></div>  
    <h2>Math2IT theme options</h2>  
    <?php settings_errors(); ?>  

    <?php  
      $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'site_setting_tab';  
    ?>  

    <h2 class="nav-tab-wrapper">  
      <a href="?page=math2it_setting&tab=site_setting_tab" class="nav-tab <?php echo $active_tab == 'site_setting_tab' ? 'nav-tab-active' : ''; ?>">Site settings</a>  
      <a href="?page=math2it_setting&tab=header_tab" class="nav-tab <?php echo $active_tab == 'header_tab' ? 'nav-tab-active' : ''; ?>">Header</a>  
    </h2>  


    <form method="post" action="options.php">  

        <?php 
        if( $active_tab == 'site_setting_tab' ) {  
            settings_fields( 'site_setting_option' );
            do_settings_sections( 'site_setting_option' ); 
        } else if( $active_tab == 'header_tab' ) {
            settings_fields( 'header_setting_option' );
            do_settings_sections( 'header_setting_option' ); 

        }
        ?>             
        <?php submit_button(); ?>  
    </form> 

  </div> 
<?php
}


// Facebook
function site_setting_facebook() { ?>
  <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

// facebook group
function site_setting_facebook_group() { ?>
  <input type="text" name="facebook-group" id="facebook-group" value="<?php echo get_option('facebook-group'); ?>" />
<?php }

// Site's short discription
function site_setting_site_short_description() { ?>
  <input type="text" name="site_short_description" id="site_short_description" value="<?php echo get_option('site_short_description'); ?>" />
<?php }

// Disqus's shortname
function site_setting_site_disqus() { ?>
  <input type="text" name="site_disqus" id="site_disqus" value="<?php echo get_option('site_disqus'); ?>" />
<?php }


// Number of latest post in home page
function header_number_latest_post_idx_call() { ?>
  <input type="text" name="header_number_latest_post_idx" id="header_number_latest_post_idx" value="<?php echo get_option('header_number_latest_post_idx'); ?>" />
<?php }