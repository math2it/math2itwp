<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>


<main role="main">

<header class="header-page bg-black">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-8">
				<div class="img-avatar">
          <i class="fa fa-files-o" aria-hidden="true" style="color: #f3bb34;"></i>
        </div>
				<h2 class="page-title">
          Tất cả bài đăng
				</h2>
				<h4 class="page-subtitle">
          Những bài viết trau chuốt và có đầu tư của chúng tôi
				</h4>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>


<!-- editor's choice -->
<!-- ====================================== -->
<?php 
  set_query_var('typeTitle', 'small'); 
  set_query_var('customTitle', 'Tuyển chọn');
  set_query_var('customURL', get_site_url().'/choice');
  set_query_var('customIcon', 'icon-star-circled');
  set_query_var('customSecClass', 'sec-choice-cat section-border-bottom');
  // list of posts
  if (is_category()){
    $list_post_args = array(
      'meta_key'         => 'top_choice',
      'meta_value'       => 1,
      'numberposts' 		 => 4,
      'category'         => $taxonomy_id,
      'orderby'          => 'rand',
      'post_status'      => 'publish'
    );
  }elseif (is_tag()){
    $list_post_args = array(
      'meta_key'         => 'top_choice',
      'meta_value'       => 1,
      'numberposts' 		 => 4,
      'tag_id'           => $taxonomy_id,
      'orderby'          => 'rand',
      'post_status'      => 'publish'
    );
  }
  $list_posts = get_posts($list_post_args);
  set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-photo-behind' ); ?>
<?php wp_reset_query(); // reset ?>


<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $posts_per_page = 16;
  $list_post_args = array(
		'paged'            => $paged,
		'post_status'      => 'publish',
		'posts_per_page'   => $posts_per_page
  );
  $list_posts = get_posts($list_post_args);
	set_query_var('typeTitle', ''); 
  set_query_var('list_posts', $list_posts);
  set_query_var('customSecClass', '');
  set_query_var('display_category', true);

  // pagination
  $custom_query = new WP_Query( $list_post_args );
  $found_posts = $custom_query->found_posts;
  $number_of_pages = ceil($found_posts / $posts_per_page);
	
  $big = 999999999; // need an unlikely integer
  $pag_arg = array(
    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format'    => '?paged=%#%',
    'prev_text' => __('«'),
    'next_text' => __('»'),
    'current'   => max( 1, get_query_var('paged') ),
    'total'     => $number_of_pages
  );
?>

<div style="padding: 5rem 0;">

<!-- pagination -->
<?php
if ($number_of_pages > 1):?>
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
  </div>
<?php
endif;
?>

<!-- list of posts -->
<?php get_template_part( 'parts/cat-layout-photo-title' ); ?>

<!-- pagination -->
<?php
if ($number_of_pages > 1):?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <?php
          echo '<div class="paginate-links mt-5">';
            echo paginate_links( $pag_arg );
          echo '</div>';
        ?>
      </div>
    </div>
  </div>
<?php
endif;
?>

</div>

<?php wp_reset_query() ?>

</main>


<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>