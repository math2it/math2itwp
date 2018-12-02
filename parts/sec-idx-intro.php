<section id="idx-header">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7 intro">
        <div class="img-avatar">
          Math<i class="icon-math2it"></i>IT
        </div>
        <h4><?php echo get_bloginfo( 'description' ); ?></h4>
        <p>
          <?php echo get_option('site_short_description') ?>
        </p>
        <div class="idx-social">
          <a class="mr-s" href="<?php echo get_bloginfo( 'wpurl' ) ?>/gioi-thieu"><i class="icon-heart"></i> Giới thiệu</a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook-group'); ?>"><i class="icon-group"></i> Math2IT Group</a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook'); ?>"><i class="icon-facebook-squared"></i> FB Math2IT</a>
        </div>
      </div>
      <div class="newest-list col-md-5">
        <div class="latest-top">
          <h3 class="new-title">Mới nhất</h3>
          <a href="" class="view-all">xem thêm</a>
        </div>

        <?php
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => get_option('header_number_latest_post_idx'), // Number of recent posts to display
            'post_status' => 'publish' // Show only the published posts
        ));
        foreach($recent_posts as $post) : ?>
          <a href="<?php echo get_permalink($post['ID']) ?>">
            <div class="new-item">
              <div class="cat-icon"><i class="icon-tex2"></i></div>
              <div class="new-post">
                <div class="post-date"><?php echo date('n-j-Y', strtotime($post['post_date'])); ?></div>
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
</section>
