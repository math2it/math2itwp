<?php 
  $cat_id = get_query_var('cat_id'); // get category
  $left_or_right = get_query_var('left_or_right'); // left or right, big post?
  if ($left_or_right == 'left'):
    $leftOrRight = '1';
    $leftOrRightOther = '2';
  else:
    $leftOrRight = '2';
    $leftOrRightOther = '1';
  endif;
?>


<?php
$cat_post_args = array(
  'category'         => $cat_id,
  'numberposts' 		 => 5,
);
$cat_posts = get_posts($cat_post_args);
if ( $cat_posts ) {?>

  <section class="layout-1-4 sec-cat sec-cat-<?php echo $cat_id ?>">
    <div class="container">
      <div class="row">

        <!-- title -->
        <?php get_template_part( 'parts/sec-title' ); ?>

        <!-- the 1st big post -->
        <?php 
        foreach($cat_posts as $post) : 
        ?>

          <div class="col-md-6 order-md-<?php echo $leftOrRight ?>">
            <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
            <div class="style-1-2">
                <div class="featured-image">
                  <?php
                  if ( has_post_thumbnail($post->ID) ) {
                    $postThumbnail = get_the_post_thumbnail($post->ID,'large' );
                    echo $postThumbnail;
                  }else{
                    $first_cat = get_the_category($post->ID);
                    $postThumbnail = get_field('default_posts_feature_image','category_'.$cat_id);
                    echo wp_get_attachment_image( $postThumbnail['id'],'large');
                  }
                  ?>
                </div>
                <div class="post-title">
                  <?php echo $post->post_title; ?>
                </div>
                <div class="post-meta">
                  <span class="date">
                    <i class="icon-clock"></i>
                    <?php echo date('d-m-y', strtotime($post->post_date)); ?>
                  </span>
                  <span class="author">
                    <i class="icon-user-outline"></i>
                    <?php echo get_the_author($post->ID); ?>
                  </span>
                </div>
                <div class="post-intro">
                  <?php
                    if (get_field('abstract',$post->ID)):
                      echo get_field('abstract',$post->ID);
                    else:
                      the_excerpt();
                    endif;
                  ?>
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
        <div class="col-md-6 order-md-<?php echo $leftOrRightOther ?>">
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

            <div class="col-12 col-sm-6">
              <a class="no-a-effect" href="<?php echo get_permalink($postID) ?>">
              <div class="item">
                <div class="post-icon">
                  <?php
                    $featureIcon = get_field('feature_icon',$postID);
                    if ( empty($featureIcon) ):
                      $featureIcon = get_field('default_posts_icon','category_'.$cat_id);
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
