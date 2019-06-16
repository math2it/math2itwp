<?php // very simple layout (first used for related posts) ?>

<?php if ( $list_posts ) {?>

<section class="layout-photo-title <?php if($customSecClass){echo $customSecClass;} ?>">

  <div class="container">

    <!-- <div class> -->

    <?php if ($typeTitle){ ?>
    <div class="row justify-content-center">
      <?php get_template_part( 'parts/sec-title' ); ?>
    </div>
    <?php } ?>

    <div class="row row-eq-height justify-content-center">

      <?php foreach($list_posts as $post) : ?>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="item">
        <?php
          $post_id = $post->ID;
          $first_cat = get_the_category($post_id);
          $rand_number = rand(0,count($first_cat)-1);
        ?>
        <?php if ($display_category): ?>
        <div class="thumb-cat" style="background: <?php echo get_field('dark_color', $first_cat[$rand_number]); ?>;">
        <?php endif; ?>
          <a class="no-a-effect" href="<?php echo get_permalink($post_id) ?>">
            <div class="post-image">
              <?php
                if ( has_post_thumbnail($post_id) ) {
                  $postThumbnail = get_the_post_thumbnail($post_id,'medium' );
                }else{
                  $first_cat = get_the_category($post_id);
                  $postThumbnail = get_field('default_posts_feature_image',$first_cat[$rand_number]);
                  echo wp_get_attachment_image( $postThumbnail['id'],'medium');
                }
                echo $postThumbnail;
              ?>
            </div>
          </a>
          <?php if ($display_category): ?>
            <a class="no-a-effect" href="<?php echo esc_url( get_category_link( $first_cat[$rand_number]->term_id ) ) ?>">
              <div class="post-cat">
                  <?php echo esc_html( $first_cat[$rand_number]->name ); ?>
              </div>
            </a>
          </div> <!-- /div thumbnail + cat -->
          <?php endif; ?>
          <div class="post-title">
            <a class="no-a-effect" href="<?php echo get_permalink($post_id) ?>">
              <?php echo $post->post_title; ?>
            </a>
          </div>
          <div class="post-date">
            <i class="icon-clock"></i>
            <?php
							date_default_timezone_set('Asia/Ho_Chi_Minh
							');
							$from = strtotime($post->post_date);
							$today = time();
							$difference = floor(($today - $from)/86400); // day
							if ((get_field('update',$post_id)==true) & $difference < 7):
                echo 'Mới cập nhật';
              elseif ($difference == 0):
								echo 'Vừa mới đăng';
							elseif ($difference < 7):
								echo $difference.' ngày trước';
							else:
								echo date('d-m-y', strtotime($post->post_date));
							endif;
						?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    </div>
    <!-- </div> -->
  </div>
</section>

<?php }?>
