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
  set_query_var('customSecClass', 'sec-choice-cat');
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
<?php get_template_part( 'parts/cat-layout-photo-intro' ); ?>
<?php wp_reset_query(); // reset ?>


<!-- List of posts -->
<!-- ====================================== -->
<?php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $list_post_args = array(
    'category'          => $cat_id,
    'paged'             => $paged,
    'post_status'       => 'publish',
    'posts_per_page'    => 16
  );
  $list_posts1 = get_posts($list_post_args);

  // pagination
  $pag_arg = array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'prev_text' => __('«'),
    'next_text' => __('»'),
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages-1
  );
  global $wp_query;
  $big = 999999999; // need an unlikely integer
?>

<?php if ( $list_posts1 ) {?>
<section class="layout-book sec-cat sec-cat-<?php echo $cat_id ?>">
  <div class="container">
    <div class="row row-eq-height justify-content-center">

    <div class="col-12">
      <?php
        echo '<div class="paginate-links mb-5">';
          echo paginate_links( $pag_arg );
        echo '</div>';
      ?>
    </div>

    <?php foreach($list_posts1 as $post) : ?>
      <div class="col-6 col-md-3">
        <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
          <div class="item mb-4">
            <div class="book-cover px-3 px-md-4 px-lg-5 px-md-3">
              <?php 
              $bookCover = get_field('post_book_cover',$post->ID); 
              echo wp_get_attachment_image( $bookCover['id'],'medium');
              ?>
            </div>
            <div class="book-shelf"></div>
            <div class="book-title">
              <?php echo $post->post_title; ?>
            </div>
            <div class="book-author">
              <?php echo get_field('post_book_author',$post->ID); ?>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach ?>

      <div class="col-12">
        <?php
          echo '<div class="paginate-links mt-5">';
            echo paginate_links( $pag_arg );
          echo '</div>';
        ?>
      </div>

    </div> <!-- /row -->
  </div> <!-- /container -->
</section>
<?php } // end if $list_posts ?> 

<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>