<!-- Idea of layout: https://blog.ghost.org -->

<?php 
  $cat_id = get_query_var('cat_id'); // get category

  $cat_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 4,
  );
  $cat_posts = get_posts($cat_post_args);
?>

<?php if ( $cat_posts ) {?>

<section class="layout-photo-intro sec-choice">

  <div class="container">
    <div class="row row-eq-height justify-content-center">
      
      <div class="col-12">
        <div class="sec-title sec-title-small">
          <h2 class="new-title">
            <i class="icon-star-circled"></i>
            Tuyển chọn
          </h2>
          <a href="<?php echo get_category_link($cat_id) ?>" class="view-all">xem thêm</a>
        </div>
      </div>

      <?php foreach($cat_posts as $post) : ?>
      <div class="col-12 col-sm-6 col-lg-3">
        <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
          <div class="item">
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
            <?php 
              $first_cat = get_the_category($post->ID);
            ?>
            <div class="post-cat" style="background: <?php echo get_field('dark_color', $first_cat[0]); ?>;">
              <?php 
                echo esc_html( $first_cat[0]->name ); 
              ?>
            </div>
            <div class="post-title">
              <?php echo $post->post_title; ?>
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
      </a>
      <?php endforeach ?>

    </div>
  </div>
</section>

<?php }?>