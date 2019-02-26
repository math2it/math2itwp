<?php 
  if ($left_or_right == 'left'):
    $leftOrRight = '1';
    $leftOrRightOther = '2';
  else:
    $leftOrRight = '2';
    $leftOrRightOther = '1';
  endif;
?>


<?php
if ( $list_posts ) {?>

  <section class="layout-1-4 sec-cat <?php if($customSecClass){echo $customSecClass;} ?>">
    <div class="container">
      
      <?php if ($typeTitle){ ?>
      <div class="row justify-content-center">
        <?php get_template_part( 'parts/sec-title' ); ?>
      </div>
      <?php } ?>

      <div class="row row-eq-height">
        <!-- the 1st big post -->
        <?php 
        foreach($list_posts as $post) : 
          $post_id = $post->ID;
        ?>

          <div class="col-md-6 order-md-<?php echo $leftOrRight ?>">
            <div class="style-1-2">
            <a class="no-a-effect" href="<?php echo get_permalink($post_id) ?>">
              <div class="featured-image">
                <?php
                if ( has_post_thumbnail($post_id) ) {
                  $postThumbnail = get_the_post_thumbnail($post_id,'large' );
                  echo $postThumbnail;
                }else{
                  $first_cat = get_the_category($post_id);
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
                  <?php
                    $author_id = $post->post_author; 
                    $fname = get_the_author_meta('first_name', $author_id);
                    $lname = get_the_author_meta('last_name', $author_id);
                    $full_name = '';
                    if( empty($fname)){
                        $full_name = $lname;
                    } elseif( empty( $lname )){
                        $full_name = $fname;
                    } else {
                        //both first name and last name are present
                        $full_name = "{$lname} {$fname}";
                    }
                    echo $full_name;
                  ?>
                </span>
              </div>
              <div class="post-intro">
                <?php if (has_excerpt($post_id)){
                  echo esc_attr(get_the_excerpt($post_id));
                }else{
                  setup_postdata( $post );
                  echo get_the_excerpt();
                } ?>
              </div>
            </a>
            </div> <!-- /style-1-2 -->
          </div> 

        <?php 
          break; // only consider the 1st post
        endforeach; wp_reset_query();
        ?>

        <!-- ========================================== -->
        <!-- 4 small posts -->
        <div class="col-md-6 order-md-<?php echo $leftOrRightOther ?>">
          <div class="row row-eq-height">
            <?php 
            $post_count = 0; // for 4 small posts
            $not_first_post = false;
            foreach($list_posts as $post) :
              $postID = $post->ID;
              $post_author = get_the_author($postID);
              if (($not_first_post) and ($post_count < 4)):
                $post_count = $post_count + 1;
            ?>

            <div class="col-12 col-sm-6">
              <div class="style-1-4">
              <a class="no-a-effect" href="<?php echo get_permalink($postID) ?>">
                <div class="featured-image">
                  <?php
                  if ( has_post_thumbnail($post_id) ) {
                    $postThumbnail = get_the_post_thumbnail($post_id,'large' );
                    echo $postThumbnail;
                  }else{
                    $first_cat = get_the_category($post_id);
                    $postThumbnail = get_field('default_posts_feature_image','category_'.$cat_id);
                    echo wp_get_attachment_image( $postThumbnail['id'],'thumbnail');
                  }
                  ?>
                </div>
                <div class="post-title">
                  <?php echo $post->post_title; ?>
                </div>
                <div class="post-meta">
                  <span class="date">
                    <?php echo date('d-m-y', strtotime($post->post_date)); ?>
                  </span>
                </div>
              </a>
              </div> <!-- /style-1-4 -->
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
