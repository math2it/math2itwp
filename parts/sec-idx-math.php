<?php
$cat_post_args = array(
  'category'         => 1, // toan-hoc
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
              Toán học
            </h2>
            <a href="" class="view-all">xem thêm</a>
          </div>
        </div>

        <!-- the 1st big post -->
        <?php 
        $first_post = true;
        foreach($cat_posts as $post) : 
          $post_author = get_the_author($post->ID);
          if ($first_post):
        ?>
        <div class="col-md-6">
          <div class="style-1-2">
            <a href="<?php echo get_permalink($post->ID) ?>">
              <div class="featured-image">
              <?php
              if ( has_post_thumbnail($post->ID) ) {
                $postThumbnail = get_the_post_thumbnail($post->ID,'medium' );
              }
              ?>
                <?php echo $postThumbnail ?>
              </div>
              <div class="post-title">
                <?php echo $post->post_title; ?>
              </div>
              <div class="post-meta">
                <span class="date"><?php echo date('d-m-y', strtotime($post->post_date)); ?></span>
                <span class="author">
                  <?php echo $post_author; ?>
                </span>
              </div>
              <div class="post-intro">
                Toán học muôn hình vạn trạng. Lược sử hình thành khái niệm giới hạn trong Toán học. Toán học muôn hình vạn trạng. Toán học muôn hình vạn trạng. Toán học là gì và như thế nào? Toán học muôn hình vạn trạng. 
              </div>
            </a>
          </div> <!-- /style-1-2 -->
        </div> 

        <!-- the other 4 small posts -->

        <?php 
          endif;
          $first_post = false;
        endforeach; wp_reset_query();
        ?>

      </div> <!-- /div row -->
    </div> <!-- /div layout-1-4 sec-math -->
  </section>

<?php }?>

<section class="layout-1-4 sec-math">
  <div class="container">
    <div class="row">
      
      <div class="col-12">
        <div class="sec-title layout-title">
          <h2 class="new-title">
            <i class="icon-pi-outline"></i>
            Toán học
          </h2>
          <a href="" class="view-all">xem thêm</a>
        </div>
      </div>

      <div class="col-md-6">
        <div class="style-1-2">
          <div class="featured-image">
            <img src="<?php echo get_bloginfo('template_directory'); ?>/img/math.jpeg">
          </div>
          <div class="post-title">
            Toán học muôn hình vạn trạng
          </div>
          <div class="post-meta">
            <span class="date">22-11-18</span>
            <span class="author">Dinh Anh Thi</span>
          </div>
          <div class="post-intro">
            Toán học muôn hình vạn trạng. Lược sử hình thành khái niệm giới hạn trong Toán học. Toán học muôn hình vạn trạng. Toán học muôn hình vạn trạng. Toán học là gì và như thế nào? Toán học muôn hình vạn trạng. 
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="row style-1-4">
          <div class="col-12 col-md-6">

            <div class="item">
              <div class="post-icon">
                <img src="<?php echo get_bloginfo('template_directory'); ?>/img/hinh-1.svg" />
              </div>
              <div class="post-title">
                Lược sử hình thành khái niệm giới hạn trong Toán học
              </div>
              <div class="post-meta">
                <span class="date">21-01-18</span>
                <!-- <span class="author">Nguyen Van A</span> -->
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="item">
              <div class="post-icon">
                <img src="<?php echo get_bloginfo('template_directory'); ?>/img/hinh-2.svg" />
              </div>
              <div class="post-title">
                Toán học là gì và như thế nào?
              </div>
              <div class="post-meta">
                <span class="date">02-11-18</span>
                <!-- <span class="author">Tran Thi B</span> -->
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="item">
              <div class="post-icon">
                <img src="<?php echo get_bloginfo('template_directory'); ?>/img/hinh-3.svg" />
              </div>
              <div class="post-title">
                Lược sử hình thành khái niệm giới hạn trong Toán học
              </div>
              <div class="post-meta">
                <span class="date">21-01-18</span>
                <!-- <span class="author">Nguyen Van A</span> -->
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="item">
              <div class="post-icon">
                <img src="<?php echo get_bloginfo('template_directory'); ?>/img/hinh-4.svg" />
              </div>
              <div class="post-title">
                Toán học là gì và như thế nào?
              </div>
              <div class="post-meta">
                <span class="date">02-11-18</span>
                <!-- <span class="author">Tran Thi B</span> -->
              </div>
            </div>
          </div>
        </div>
      </div>

    </div> <!-- /div row -->
  </div> <!-- /div container -->
</section> 
