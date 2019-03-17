<?php if ( $list_posts ) {?>

<section class="layout-photo-behind <?php if($customSecClass){echo $customSecClass;} ?>">

  <div class="container">

    <?php if ($typeTitle){ ?>
    <div class="row justify-content-center">
      <?php get_template_part( 'parts/sec-title' ); ?>
    </div>
    <?php } ?>

    <div class="row justify-content-center">

      <?php foreach($list_posts as $post) : ?>
      <div class="col-12 col-sm-6 col-md-3">
        <?php
          $post_id = $post->ID;
          // only for tool posts
          // if ($toolPosts){
          //   $cat_slug = get_category($cat_id)->slug;
          //   $post_url = get_site_url().'/category/'.$cat_slug.'/#tool-'.$post_id;
          // }else{
          $post_url = get_permalink($post_id);
          // }
        ?>
        <a class="no-a-effect" href="<?php echo $post_url; ?>">

        <?php 
          $first_cat = get_the_category($post_id);
          $rand_number = rand(0,count($first_cat)-1);
        ?>

        <?php 
          if ( has_post_thumbnail($post_id) ) {
            $postThumbnail = get_the_post_thumbnail_url($post_id,'medium' );
          }else{
            $first_cat = get_the_category($post_id);
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