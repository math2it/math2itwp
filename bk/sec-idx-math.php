<?php $cat_id = 1 ?>  <!-- Toan hoc -->

<?php
$cat_post_args = array(
  'category'         => $cat_id, // toan-hoc
  'numberposts' 		 => 5,
);
$cat_posts = get_posts($cat_post_args);
if ( $cat_posts ) {?>

  <section class="layout-1-4 sec-math">
    <div class="container">
      <div class="row">

        <div class="col-12">
          <div class="sec-title layout-title">
            <h2 class="new-title">
              <i class="icon-pi-outline"></i>
              <?php echo get_cat_name($cat_id);?>
            </h2>
            <a href="<?php echo get_category_link($cat_id) ?>" class="view-all">xem thêm</a>
          </div>
        </div>

        <!-- the 1st big post -->
        <?php 
        foreach($cat_posts as $post) : 
        ?>

          <div class="col-md-6">
            <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
            <div class="style-1-2">
                <div class="featured-image">
                <?php
                if ( has_post_thumbnail($post->ID) ) {
                  $postThumbnail = get_the_post_thumbnail($post->ID,'large' );
                }
                ?>
                  <?php echo $postThumbnail ?>
                </div>
                <div class="post-title">
                  <?php echo $post->post_title; ?>
                </div>
                <div class="post-meta">
                  <span class="date">
                    <?php echo date('d-m-y', strtotime($post->post_date)); ?>
                  </span>
                  <span class="author">
                    <?php echo get_the_author($post->ID); ?>
                  </span>
                </div>
                <div class="post-intro">
                  <?php echo get_field('abstract',$post->ID); ?> 
                </div>
            </div> <!-- /style-1-2 -->
            </a>
          </div> 

        <?php 
          break; // only consider the 1st post
        endforeach; wp_reset_query();
        ?>

        <!-- ========================================== -->
        <!-- 4 small posts -->
        <div class="col-md-6">
          <div class="row style-1-4">
            <?php 
            $post_count = 0; // for 4 small posts
            $not_first_post = false;
            foreach($cat_posts as $post) :
              $postID = $post->ID;
              $post_author = get_the_author($postID);
              if (($not_first_post) and ($post_count < 4)):
                $post_count = $post_count + 1;
            ?>

            <div class="col-12 col-md-6">
              <a class="no-a-effect" href="<?php echo get_permalink($postID) ?>">
              <div class="item">
                <div class="post-icon">
                  <?php 
                    $featureIcon = get_field('feature_icon',$postID);
                    if ( empty($featureIcon) ):
                      $featureIcon = get_field('default_posts_icon',$cat_id);
                    endif
                  ?>
                  <img src="<?php echo $featureIcon['url'] ?>" />
                </div>
                <div class="post-title">
                  <?php echo $post->post_title; ?>
                </div>
                <div class="post-meta">
                  <span class="date">
                    <?php echo date('d-m-y', strtotime($post->post_date)); ?>
                  </span>
                  <!-- <span class="author">Nguyen Van A</span> -->
                </div>
              </div>
              </a>
            </div>

            <?php 
              endif;
              $not_first_post = true; // ignore the 1st post
            endforeach; wp_reset_query();
            ?>
          </div> <!-- /div style-1-4 -->
        </div> <!-- /div col-md-6 -->

      </div> <!-- /div row -->
    </div> <!-- /div layout-1-4 sec-math -->
  </section>

<?php }?>
