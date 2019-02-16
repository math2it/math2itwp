<?php // wp:admin thi - pass: ctlae ?>

<?php get_header(); ?>

<!-- intro -->
<!-- ====================================== -->
<?php get_template_part( 'parts/sec-idx-intro' ); ?>

<main role="main">

<!-- editor's choice -->
<!-- ====================================== -->
<?php 
  set_query_var('typeTitle', 'small'); 
  set_query_var('customTitle', 'Tuyển chọn');
  set_query_var('customURL', get_site_url().'/choice');
  set_query_var('customIcon', 'icon-star-circled');
  set_query_var('customSecClass', 'sec-choice');
  set_query_var('display_category', true);
  // list of posts
  $list_post_args = array(
    'meta_key'         => 'top_choice',
    'meta_value'       => 1,
    'numberposts' 		 => 4,
    'orderby'          => 'rand',
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-photo-title' ); ?>
<?php wp_reset_query(); // reset ?>


<!-- math -->
<!-- ====================================== -->
<?php 
  $cat_id = 1;
  set_query_var('cat_id', $cat_id);
  set_query_var('customTitle', '');
  set_query_var('customURL', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'big');
  set_query_var('customSecClass', 'sec-cat-'.$cat_id);
  set_query_var('left_or_right', 'left');
  // list of posts
  $list_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 5,
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); // reset ?>


<!-- tech -->
<!-- ====================================== -->
<?php 
  $cat_id = 2;
  set_query_var('cat_id', $cat_id);
  set_query_var('customTitle', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'big');
  set_query_var('customSecClass', 'sec-cat-'.$cat_id);
  set_query_var('left_or_right', 'right');
  // list of posts
  $list_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 5,
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); // reset ?>


<!-- book -->
<!-- ====================================== -->
<?php 
  $cat_id = 16;
  set_query_var('cat_id', $cat_id);
  set_query_var('customTitle', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'middle');
  set_query_var('customSecClass', 'sec-cat-'.$cat_id.' sec-cat');
  set_query_var('left_or_right', 'right');
  // list of posts
  $list_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 4,
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-book' ); ?>
<?php wp_reset_query(); // reset ?>


<!-- translate -->
<!-- ====================================== -->
<?php 
  $cat_id = 6;
  set_query_var('cat_id', $cat_id);
  set_query_var('customTitle', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'big');
  set_query_var('customSecClass', 'sec-cat-'.$cat_id);
  set_query_var('left_or_right', 'left');
  // list of posts
  $list_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 5,
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); // reset ?>


<!-- latex -->
<!-- ====================================== -->
<?php 
  $cat_id = 7;
  set_query_var('cat_id', $cat_id);
  set_query_var('customTitle', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'big');
  set_query_var('customSecClass', 'sec-cat-'.$cat_id);
  set_query_var('left_or_right', 'right');
  // list of posts
  $list_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 5,
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); // reset ?>

</main>

<!-- footer -->
<?php get_footer(); ?>


