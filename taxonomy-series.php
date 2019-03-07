<?php get_header(); ?>

<main role="main">

<header class="header-page bg-black">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-8">
				<div class="img-avatar">
          <i class="fas fa-clipboard-list" style="color: #f3bb34;"></i>
        </div>
				<h2 class="page-title">
          <?php echo get_the_archive_title(); ?>
        </h2>
        <?php if (category_description()){ ?>
				<h4 class="page-subtitle">
          <?php echo get_the_archive_description(); ?>
        </h4>
        <?php } ?>
        <div class="idx-social">
          <a class="mr-s" href="<?php echo get_bloginfo( 'wpurl' ) ?>/gioi-thieu"><i class="icon-heart"></i><span class="hide-on-xs"> Giới thiệu</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook-group'); ?>"><i class="icon-group"></i><span class="hide-on-xs"> Nhóm Math2IT</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook'); ?>"><i class="icon-facebook-squared"></i><span class="hide-on-xs"> FB Math2IT</span></a>
        </div>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>

<?php get_template_part( 'parts/subscribe-bar' ); ?>

<div class="all-posts">
<section class="layout-photo-title">
  <div class="container">
    <div class="row row-eq-height justify-content-center">
      <?php while ( have_posts() ) : the_post(); ?>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="item">
          <?php
            $first_cat = get_the_category($post->ID);
            $rand_number = rand(0,count($first_cat)-1);
          ?>
          <?php if ($display_category): ?>
          <div class="thumb-cat" style="background: <?php echo get_field('dark_color', $first_cat[$rand_number]); ?>;">
          <?php endif; ?>
            <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
              <div class="post-image">
                <?php
                  if ( has_post_thumbnail($post->ID) ) {
                    $postThumbnail = get_the_post_thumbnail($post->ID,'medium' );
                  }else{
                    $first_cat = get_the_category($post->ID);
                    $postThumbnail = get_field('default_posts_feature_image',$first_cat[$rand_number]);
                    echo wp_get_attachment_image( $postThumbnail['id'],'small');
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
              <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
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
                if ($difference == 0):
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
      <?php endwhile ?>
    </div>
  </div>
</section>
</div>

</main>

<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>