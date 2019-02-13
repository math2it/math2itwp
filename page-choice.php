<!-- This page template is used only for editor's choice -->


<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>


<main role="main">

<header class="header-page bg-black">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-8">
				<div class="img-avatar">
          <i class="icon-star-circled" style="color: #f3bb34;"></i>
        </div>
				<h2 class="page-title">
					Math2IT tuyển chọn
				</h2>
				<h4 class="page-subtitle">
					Dựa trên tiêu chí bổ ích và hay được xem lại nhiều nhất
				</h4>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>


<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  // list of posts
  // $list_post_args = array(
  //   'meta_key'         => 'top_choice',
  //   'meta_value'       => 1,
	// 	'paged'            => $paged,
	// 	'post_status'      => 'publish',
	// 	'posts_per_page'   => 4
  // );
  $list_post_args = array(
    'category'          => 1,
    'paged'             => $paged,
    'post_status'       => 'publish',
    'posts_per_page'    => 8
  );
  $list_posts = get_posts($list_post_args);
	// set_query_var('list_posts', $list_posts);
	
	// pagination
  global $wp_query;
  $big = 999999999; // need an unlikely integer
  $pag_arg = array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'prev_text' => __('«'),
    'next_text' => __('»'),
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages-1
  );
?>

<?php if ( $list_posts ) {?>
<section class="layout-photo-intro sec-cat sec-cat-<?php echo $cat_id ?>">
  <div class="container">

    <div class="row justify-content-center">
      <div class="col-12">
        <?php
          echo '<div class="paginate-links mb-5">';
            echo paginate_links( $pag_arg );
          echo '</div>';
        ?>
      </div>
    </div>

    <div class="row row-eq-height justify-content-center">

    <?php foreach($list_posts as $post) : ?>
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="item">
          <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
            <div class="post-image">
              <?php
                if ( has_post_thumbnail($post->ID) ) {
                  $postThumbnail = get_the_post_thumbnail($post->ID,'medium' );
                  echo $postThumbnail;
                }else{
                  $first_cat = get_the_category($post->ID);
                  $postThumbnail = get_field('default_posts_feature_image','category_'.$cat_id);
                  echo wp_get_attachment_image( $postThumbnail['id'],'medium');
                }
              ?>
            </div>
          </a>
          <?php 
            $first_cat = get_the_category($post->ID);
            $rand_number = rand(0,count($first_cat)-1);
          ?>
          <a class="no-a-effect" href="<?php echo esc_url( get_category_link( $first_cat[0]->term_id ) ) ?>">
            <div class="post-cat" style="background: <?php echo get_field('dark_color', $first_cat[$rand_number]); ?>;">
                <?php echo esc_html( $first_cat[$rand_number]->name ); ?>
            </div>
          </a>
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
          <div class="post-excerpt">
            <?php
              if (get_field('abstract',$post->ID)):
                echo get_field('abstract',$post->ID);
              else:
                the_excerpt();
              endif;
            ?>
          </div>
        </div>
      </div>
    <?php endforeach ?>

    </div> <!-- /row -->
    
    <div class="row justify-content-center">
      <div class="col-12">
        <?php
          echo '<div class="paginate-links mt-5">';
            echo paginate_links( $pag_arg );
          echo '</div>';
        ?>
      </div>
    </div>

  </div> <!-- /container -->
</section>
<?php } // end if $list_posts ?> 



</main>


<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>