<?php 
  $cat_id = get_query_var('cat_id'); // get category

  $cat_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 4,
  );
  $cat_posts = get_posts($cat_post_args);
?>

<?php if ( $cat_posts ) {?>

<section class="layout-photo-behind sec-choice">

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
      <div class="col-12 col-sm-6 col-md-3">
        <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
        <?php 
          if ( has_post_thumbnail($post->ID) ) {
            $postThumbnail = get_the_post_thumbnail_url($post->ID,'large' );
          }else{
            $first_cat = get_the_category($post->ID);
            $postThumbnail = get_field('default_posts_feature_image','category_'.$cat_id);
            $postThumbnail =  wp_get_attachment_url( $postThumbnail['id'],'medium');
          }
        ?>
        <div class="item d-flex align-items-center" style="background-image: url(<?php echo $postThumbnail ?>)">
          <div class="item-content">
            <div class="book-title">
              <?php echo $post->post_title; ?>
            </div>
          </div>
        </div>
      </div>
      </a>
      <?php endforeach ?>

    </div>
  </div>
</section>

<?php }?>