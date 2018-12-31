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
    'posts_per_page'    => 15
  );
  $list_posts1 = get_posts($list_post_args);
?>

<?php if ( $list_posts1 ) {?>
<section class="layout-photo-intro sec-cat sec-cat-<?php echo $cat_id ?>">
  <div class="container">
    <div class="row row-eq-height justify-content-center">
    <?php foreach($list_posts1 as $post) : ?>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="item">
          <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
            <div class="post-image">
              <?php
                if ( has_post_thumbnail($post->ID) ) {
                  $postThumbnail = get_the_post_thumbnail($post->ID,'medium' );
                  echo $postThumbnail;
                }else{
                  $first_cat = get_the_category($post->ID);
                  $postThumbnail = get_field('default_posts_feature_image','category_'.$cat_id);
                  echo wp_get_attachment_image( $postThumbnail['id'],'medium');
                }
              ?>
            </div>
          </a>
          <?php 
            $first_cat = get_the_category($post->ID);
            $rand_number = rand(0,count($first_cat)-1);
          ?>
          <a class="no-a-effect" href="<?php echo esc_url( get_category_link( $first_cat[0]->term_id ) ) ?>">
            <div class="post-cat" style="background: <?php echo get_field('dark_color', $first_cat[$rand_number]); ?>;">
                <?php echo esc_html( $first_cat[$rand_number]->name ); ?>
            </div>
          </a>
          <div class="post-title">
            <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
              <?php echo $post->post_title; ?>
            </a>
          </div>
          <div class="post-date">
            <i class="icon-clock"></i>
            <?php echo date('d-m-y', strtotime($post->post_date)); ?>
          </div>
          <div class="post-excerpt">
            <?php
              if (get_field('abstract',$post->ID)):
                echo get_field('abstract',$post->ID);
              else:
                the_excerpt();
              endif;
            ?>
          </div>
        </div>
      </div>
    <?php endforeach ?>
    </div>
  </div>

  <?php
    global $wp_query;
  
    $big = 999999999; // need an unlikely integer
    echo '<div class="paginate-links">';
      echo paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'prev_text' => __('<<'),
      'next_text' => __('>>'),
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages-1
      ) );
    echo '</div>';
  ?>

</section>
<?php } // end if $list_posts ?> 

<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>