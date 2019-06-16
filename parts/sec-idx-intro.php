<header class="bg-black py-4 pb-5 pb-md-4 header-intro">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12 col-md-7 col-xl-6 intro">
        <div class="img-avatar">
          Math<i class="icon-math2it"></i>IT
          <h1>Math2IT</h1>
        </div>
        <h2 data-toc-skip class="subtitle"><?php echo get_bloginfo( 'description' ); ?></h2>
        <p class="description">
          <?php echo get_option('site_short_description') ?>
        </p>
        <div class="idx-social">
          <a class="mr-s" href="<?php echo get_bloginfo( 'wpurl' ) ?>/gioi-thieu"><i class="icon-heart"></i><span class="hide-on-xs"> Giới thiệu</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook-group'); ?>"><i class="icon-group"></i><span class="hide-on-xs"> Nhóm Math2IT</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook'); ?>"><i class="icon-facebook-squared"></i><span class="hide-on-xs"> FB Math2IT</span></a>
        </div>
      </div>
      <div class="col-12 col-md-5 col-xl-4 newest-list ">
        <div class="latest-top sec-title">
          <h2 data-toc-skip class="new-title">Mới nhất</h2>
          <a href="<?php echo get_site_url();?>/all" class="view-all">xem thêm</a>
        </div>

        <?php
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => get_option('header_number_latest_post_idx'), // Number of recent posts to display
            'post_status' => 'publish' // Show only the published posts
        ));
        foreach($recent_posts as $post) :
          $post_id = $post['ID'];
          $first_cat = get_the_category($post_id);
          $rand_number = rand(0,count($first_cat)-1);
          $post_cat_icon = get_field('cat-icon', $first_cat[$rand_number]);?>
          <a href="<?php echo get_permalink($post_id) ?>">
            <div class="new-item">
              <div class="cat-icon"><i class="<?php echo $post_cat_icon ?>"></i></div>
              <div class="new-post">
                <div class="post-date">
                  <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh
                    ');
                    $from = strtotime($post['post_date']);
                    $today = time();
                    $difference = floor(($today - $from)/86400); // day
                    if ((get_field('update',$post_id)==true) & $difference < 7):
                      echo 'Mới cập nhật';
                    elseif ($difference == 0):
                      echo 'Vừa mới đăng';
                    elseif ($difference < 7):
                      echo $difference.' ngày trước';
                    else:
                      echo date('d-m-y', strtotime($post['post_date']));
                    endif;
                  ?>
                </div>
                <h4 class="post-title">
                  <?php echo $post['post_title'] ?>
                </h4>
              </div>
            </div>
          </a>
        <?php endforeach; wp_reset_query(); ?>

      </div>
    </div>
  </div>
</header>
