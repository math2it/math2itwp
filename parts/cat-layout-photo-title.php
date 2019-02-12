<?php // very simple layout (first used for related posts) ?>

<?php if ( $list_posts ) {?>

<section class="layout-photo-title <?php if($customSecClass){echo $customSecClass;} ?>">

  <div class="container">

    <!-- <div class> -->

    <div class="row justify-content-center">
      <!-- title? -->
      <?php if ($typeTitle){get_template_part( 'parts/sec-title' );} ?>
    </div>

    <div class="row row-eq-height justify-content-center">

      <?php foreach($list_posts as $post) : ?>
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
                  $postThumbnail = get_field('default_posts_feature_image',$first_cat[0]);
                  echo wp_get_attachment_image( $postThumbnail['id'],'small');
                }
              ?>
            </div>
          </a>
          <div class="post-title">
            <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
              <?php echo $post->post_title; ?>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    </div>
    <!-- </div> -->
  </div>
</section>

<?php }?>