<!-- Default category template (matching with layout-1-4) -->

<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>

<main role="main">

<!-- intro header -->
<!-- ====================================== -->
<?php
  $category = get_category( get_query_var( 'cat' ) );
  $cat_id = $category->cat_ID;
  set_query_var('cat_id', $cat_id);
?>
<?php get_template_part( 'parts/sec-cat-header' ); ?>
<?php wp_reset_query(); ?> <!-- reset -->


<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if ($paged == 1){
?>


<!-- editor's choice -->
<!-- ====================================== -->
<?php
  set_query_var('typeTitle', 'small');
  set_query_var('customTitle', 'Tuyển chọn');
  set_query_var('customURL', get_site_url().'/choice');
  set_query_var('customIcon', 'icon-star-circled');
  set_query_var('customSecClass', 'sec-choice-cat section-border-bottom');
  // list of posts
  $list_post_args = array(
    'meta_key'         => 'top_choice',
    'meta_value'       => 1,
    'numberposts' 		 => 4,
    'category'         => $cat_id,
    'orderby'          => 'rand',
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-photo-behind' ); ?>
<?php wp_reset_query(); // reset ?>
<?php } // endif paged==1 ?>


<!-- List of posts -->
<!-- ====================================== -->
<?php
  // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  // $posts_per_page = 16;
  $posts_per_page = get_option('posts_per_page');
  $list_post_args = array(
    'category'          => $cat_id,
    'posts_per_page'    => $posts_per_page,
    'paged'             => $paged,
    'post_status'      => 'publish'
  );
  $list_posts = get_posts($list_post_args);
  set_query_var('typeTitle', '');
  set_query_var('list_posts', $list_posts);
  set_query_var('customSecClass', '');

  // pagination
  $cat_count = get_category($cat_id);
  $found_posts = $cat_count->count;
  $number_of_pages = ceil($found_posts / $posts_per_page);

  $big = 999999999; // need an unlikely integer
  $pag_arg = array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'prev_text' => __('«'),
    'next_text' => __('»'),
    'current' => max( 1, get_query_var('paged') ),
    'total' => $number_of_pages
  );

  // for pagination
  set_query_var('pag_arg', $pag_arg);
  set_query_var('number_of_pages', $number_of_pages);
?>

<div class="all-posts">
  <?php get_template_part( 'parts/cat-layout-book' ); ?>
  <?php get_template_part( 'parts/pagination' ); ?>
</div>

<?php wp_reset_query() ?>

</main>

<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>
