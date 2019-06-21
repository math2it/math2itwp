<?php // wp:admin math2it - pass: 9chuso ?>

<?php get_header(); ?>

<!-- intro -->
<!-- ====================================== -->
<?php get_template_part( 'parts/sec-idx-intro' ); ?>

<?php // get_template_part( 'parts/subscribe-bar' ); ?>

<main role="main">

<?php
  // List of posts
  // ======================================
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



<?php
  // math
  // ======================================
  $consider_cat = get_category_by_slug( 'math' );
  $cat_id = $consider_cat->term_id;
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


<?php
  // tech
  // ======================================
  $consider_cat = get_category_by_slug( 'technology' );
  $cat_id = $consider_cat->term_id;
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


<?php
  // tool
  // ======================================
  $consider_cat = get_category_by_slug( 'tool' );
  $cat_id = $consider_cat->term_id;
  set_query_var('cat_id', $cat_id);
  set_query_var('customTitle', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'big');
  set_query_var('customSecClass', 'sec-cat sec-cat-'.$cat_id);
  // set_query_var('toolPosts', true);
  // list of posts
  $list_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 8,
    'orderby'          => 'date',
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-photo-behind' ); ?>
<?php wp_reset_query(); // reset ?>


<?php
  // edu
  // ======================================
  $consider_cat = get_category_by_slug( 'education' );
  $cat_id = $consider_cat->term_id;
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


<?php
  // book
  // ======================================
  $consider_cat = get_category_by_slug( 'book' );
  $cat_id = $consider_cat->term_id;
  set_query_var('cat_id', $cat_id);
  set_query_var('customTitle', '');
  set_query_var('customIcon', '');
  set_query_var('typeTitle', 'middle');
  set_query_var('customSecClass', 'sec-cat-'.$cat_id.' sec-cat');
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


<?php
  // translate
  // ======================================
  $consider_cat = get_category_by_slug( 'translated-articles' );
  $cat_id = $consider_cat->term_id;
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

</main>

<!-- footer -->
<?php get_footer(); ?>


