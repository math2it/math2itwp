<?php get_header(); ?>

<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      
      <div class="col-12">
        <h2 class="search-title">
          <span class="default_query">Kết quả tìm kiếm cho</span> <span class="keyword_quey">"<?php echo get_search_query(); ?>"</span>
        </h2>
      </div>

      <div class="col-12 col-lg-11">
        <div class="result-list">
        <?php /* Start the Loop */ ?>
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : 
          the_post(); 
          $post_id = get_the_ID();
        ?>
          <div class="item">
            <div class="content">
              <div class="meta">
                <?php
                  $first_cat = get_the_category($post_id);
                  $rand_number = rand(0,count($first_cat)-1);
                  $cat_id = $first_cat[$rand_number]->term_id;
                ?>
                <a class="cat-title-<?php echo $cat_id; ?>" href="<?php echo esc_url( get_category_link($cat_id) ) ?>">
                  <?php echo $first_cat[$rand_number]->name; ?>
                </a>
                <span class="dot">&#9679;</span>
                <span>
                  <?php 
                    date_default_timezone_set('Asia/Ho_Chi_Minh
                    ');
                    $from = strtotime(get_the_date());
                    $today = time();
                    $difference = floor(($today - $from)/86400); // day
                    if ($difference == 0):
                      echo 'Vừa mới đăng';
                    elseif ($difference < 7):
                      echo $difference.' ngày trước';
                    else:
                      echo get_the_date('d-m-Y');
                    endif;
                  ?> 
                </span>
              </div>
              <a class="title-excerpt" href="<?php the_permalink(); ?>" >
                <h2 class="title">
                  <?php the_title(); ?>
                </h2>
                <div class="excerpt">
                  <?php the_excerpt(); ?>
                </div>
              </a>
            </div>
            <a href="<?php the_permalink(); ?>" >
              <div class="photo">
                <?php
                  if ( has_post_thumbnail($post_id) ) {
                    $postThumbnail = get_the_post_thumbnail($post_id,'medium' );
                    echo $postThumbnail;
                  }else{
                    $first_cat = get_the_category($post_id);
                    $postThumbnail = get_field('default_posts_feature_image',$first_cat[$rand_number]);
                    echo wp_get_attachment_image( $postThumbnail['id'],'small');
                  }
                ?>
              </div>
            </a>
          </div> <!-- /div item -->
        <?php endwhile; ?>
        <?php else: ?>
          <p>Rất tiếc, không tìm thấy kết quả bạn cần tìm.</p>
        <?php endif; ?>
        </div>
      </div>

    </div> <!-- /div row -->
  </div> <!-- /div container -->
</section>

<?php get_footer(); ?>