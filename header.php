<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    if (is_front_page()){ ?>
      <meta name="description" content="Toán học - Giáo dục - Công nghệ" />
    <?php }?>
    <meta name="author" content="Math2IT">
    <meta name="google-site-verification" content="181CmgqR5igp35LIcLcdHY9IedJEluRir0meZpAp0rg" />

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.gif" />

    <title>
      <?php
      if (is_category()) {
        single_tag_title('Chủ đề &quot;'); echo '&quot; - ';
      } elseif (function_exists('is_tag') && is_tag()) {
        single_tag_title('Thẻ &quot;'); echo '&quot; - ';
      } elseif (is_page()) {
        echo single_post_title(''); echo ' - ';
      } elseif (is_search()) {
        echo 'Kết quả tìm kiếm cho từ khóa &quot;'.wp_specialchars($s).'&quot; - ';

      } elseif ( is_author() ) {
        $fname = get_the_author_meta('first_name');
        $lname = get_the_author_meta('last_name');
        $full_name = '';
        if( empty($fname)){
            $full_name = $lname;
        } elseif( empty( $lname )){
            $full_name = $fname;
        } else {
            //both first name and last name are present
            $full_name = "{$lname} {$fname}";
        }
        echo 'Tác giả '.$full_name.' - ';
      } elseif (!(is_404()) && (is_single()) || (is_page())) {
        echo single_post_title(''); echo ' - ';
      } elseif (is_404()) {
        echo 'Không tìm thấy trang - ';
      } bloginfo('name');
      ?>
    </title>

    <style type="text/css">
      <?php
        // css with php
        // --------------------------------------
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
          $cat_id = $cat_item->term_id;
          $cat_icon = get_field('cat-icon', $cat_item);
          $cat_color = get_field('cat-color', $cat_item); // text color in nav
          $header_bg = get_field('header_background', $cat_item);
          $sec_title_bg = get_field('section_title_background', $cat_item);
          $sec_bg = get_field('cat_sec_background', $cat_item);
          $sec_title_color = get_field('dark_color', $cat_item);
          // nav hover
          echo '.navbar a:hover .'.$cat_icon.'{color:'.$cat_color.';}';
          // header background in cat template
          echo '.bg-cat-'.$cat_id.'{background-image:'.$header_bg.';}';
          // section background in index.php
          echo '.sec-cat-'.$cat_id.'{background:'.$sec_bg.';}';
          // background for icon
          echo '.sec-cat-'.$cat_id.' .sec-title-big i{background-image:'.$sec_title_bg.';}';
          // title of category in section (index.php)
          echo '.cat-title-'.$cat_id.'{color:'.$sec_title_color.';}';
        }
      ?>
    </style>

    <?php
      $page_id = get_the_ID();
      if (get_field('display_math',$page_id)==true):
      ?>
        <script type="text/javascript">
          window.MathJax = {
            jax: ["input/TeX", "output/SVG"],
            tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]},
            SVG: {
              linebreaks: { automatic: true },
              styles: {".MathJax_SVG_Display": {margin: "1.5rem 0", overflow: "auto"}}
            }
          };
        </script>
        <script type="text/javascript" async
          src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_SVG">
        </script>
    <?php endif; ?>

    <?php if (get_option('google_analytics')){ ?>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', '<?php echo get_option('google_analytics'); ?>', 'auto');
        ga('send', 'pageview');
      </script>
    <?php } ?>


    <?php wp_head();?>
  </head>

<body data-spy="scroll" data-target="#toc">

  <header>

    <?php get_template_part( 'parts/nav' ); ?>

  </header>
