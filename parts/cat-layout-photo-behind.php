<?php if ( $list_posts ) {?>

<section class="layout-photo-behind <?php if($customSecClass){echo $customSecClass;} ?>">

  <div class="container">

    <div class="row justify-content-center">
      <?php if ($typeTitle){get_template_part( 'parts/sec-title' );} ?>
    </div>

    <div class="row justify-content-center">

      <?php foreach($list_posts as $post) : ?>
      <div class="col-12 col-sm-6 col-md-3">
        <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">

        <?php 
          $first_cat = get_the_category($post->ID);
          $rand_number = rand(0,count($first_cat)-1);
        ?>

        <?php 
          if ( has_post_thumbnail($post->ID) ) {
            $postThumbnail = get_the_post_thumbnail_url($post->ID,'large' );
          }else{
            $first_cat = get_the_category($post->ID);
            $postThumbnail = get_field('default_posts_feature_image',$first_cat[$rand_number]);
            $postThumbnail =  wp_get_attachment_url( $postThumbnail['id'],'medium');
          }
        ?>
        <div class="item d-flex align-items-end" style="background-image: url(<?php echo $postThumbnail ?>)">
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