<!-- Idea of layout: https://blog.ghost.org -->

<?php if ( $list_posts ) {?>

<section class="layout-photo-intro <?php if($customSecClass){echo $customSecClass;} ?>">

  <div class="container">
    <div class="row row-eq-height justify-content-center">
      
      <!-- title? -->
      <?php if ($typeTitle){get_template_part( 'parts/sec-title' );} ?>

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
</section>

<?php }?>