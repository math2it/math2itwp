<?php
  $cat_id = get_query_var('cat_id'); // get category
?>

<section id="header-cat-<?php echo $cat_id ?>" class="py-md-5 pb-5 header-intro cat-intro">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-7 intro">
        <div class="img-avatar">
          <i class="<?php echo get_field('cat-icon', 'category_'.$cat_id) ?>"></i>
        </div>
        <h2><?php echo get_cat_name($cat_id);?></h2>
        <p>
          <?php echo category_description(); ?>
        </p>
        <div class="idx-social">
          <a class="mr-s" href="<?php echo get_bloginfo( 'wpurl' ) ?>/gioi-thieu"><i class="icon-heart"></i><span class="hide-on-xs"> Giới thiệu</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook-group'); ?>"><i class="icon-group"></i><span class="hide-on-xs"> Nhóm Math2IT</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook'); ?>"><i class="icon-facebook-squared"></i><span class="hide-on-xs"> FB Math2IT</span></a>
        </div>
      </div> <!-- /intro -->
      <div class="newest-list col-md-5">
        <div class="latest-top sec-title">
          <h3 class="new-title">Mới nhất</h3>
          <a href="" class="view-all">xem thêm</a>
        </div>

        <?php
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => get_option('header_number_latest_post_idx'), // Number of recent posts to display
            'post_status' => 'publish', // Show only the published posts
            'category'    => $cat_id
        ));
        foreach($recent_posts as $post) : 
          $first_cat = get_the_category($post['ID']);
          $post_cat_icon = get_field('cat-icon', 'category_'.$cat_id);?>
          <a href="<?php echo get_permalink($post['ID']) ?>">
            <div class="new-item">
              <div class="cat-icon">
                <i class="<?php echo $post_cat_icon ?>"></i>
              </div>
              <div class="new-post">
                <div class="post-date"><?php echo date('d-m-y', strtotime($post['post_date'])); ?></div>
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
