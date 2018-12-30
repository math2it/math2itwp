<!-- Default category template (matching with layout-1-4) -->

<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>


<!-- intro header -->
<!-- ====================================== -->
<?php 
  $category = get_category( get_query_var( 'cat' ) );
  $cat_id = $category->cat_ID;
  set_query_var('cat_id', $cat_id); 
?>
<?php get_template_part( 'parts/sec-cat-header' ); ?>
<?php wp_reset_query(); ?> <!-- reset -->


<!-- editor's choice -->
<!-- ====================================== -->
<?php 
  set_query_var('typeTitle', 'small'); 
  set_query_var('customTitle', 'Tuyển chọn');
  set_query_var('customIcon', 'icon-star-circled');
  set_query_var('customSecClass', 'sec-choice');
  // list of posts
  $list_post_args = array(
    'meta_key'         => 'top_choice',
    'meta_value'       => 1,
    'numberposts' 		 => 4,
    'category'         => $cat_id,
    'orderby'          => 'rand'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-photo-intro' ); ?>
<?php wp_reset_query(); // reset ?>


<?php 
  set_query_var('customTitle', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'big');
  set_query_var('customSecClass', 'sec-cat-'.$cat_id);
  set_query_var('left_or_right', 'left');
  // list of posts
  $list_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 5,
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); // reset ?>
 

<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>