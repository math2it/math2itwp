<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="Math2IT's Wordpress Theme">
    <meta name="author" content="Anh-Thi Dinh">

    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.gif" />

    <!-- css with php -->
    <style id="math2it-inline-css" type="text/css">
      <?php
        // nav element color depends on color defined in wp admin
        // cf. http://bit.ly/2KAagM9
        
        // hover color nav item
        $menuLocations = get_nav_menu_locations();
        $menuID = $menuLocations['math2it-custom-menu'];
        $primaryNav = wp_get_nav_menu_items($menuID);
        foreach ( $primaryNav as $navItem ) {
          $nav_icon = get_field('nav-icon', $navItem);
          $nav_color = get_field('nav-color', $navItem);
          echo '.navbar a:hover .'.$nav_icon.'{color:'.$nav_color.';}';
        }

        // hover color for cat
        $list_categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC'
        ) );
        foreach ($list_categories as $cat_item){
          $cat_icon = get_field('cat-icon', $cat_item);
          $cat_color = get_field('cat-color', $cat_item);
          echo '.navbar a:hover .'.$cat_icon.'{color:'.$cat_color.';}';
        }
      ?>
    </style>

    <?php wp_head();?>
  </head>

<body>

  <header>

    <!-- navigation -->
    <?php get_template_part( 'parts/nav' ); ?>

  </header>
