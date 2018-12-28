<?php 
  $cat_id = get_query_var('cat_id'); // get category
  $left_or_right = get_query_var('left_or_right'); // left or right, big post?

  $cat_post_args = array(
    'category'         => $cat_id,
    'numberposts' 		 => 4,
  );
  $cat_posts = get_posts($cat_post_args);
?>

<?php if ( $cat_posts ) {?>

<section class="layout-book sec-cat-<?php echo $cat_id ?> sec-cat">
  <div class="container">
    <div class="row row-eq-height justify-content-center">

      <div class="col-12">
        <div class="sec-title-middle">
          <h2 class="new-title">
            <i class="<?php echo get_field('cat-icon', 'category_'.$cat_id) ?>"></i>
            <?php echo get_cat_name($cat_id);?>
          </h2>
          <div></div>
          <a href="<?php echo get_category_link($cat_id) ?>" class="view-all">xem thêm</a>
        </div>
      </div>

      <?php foreach($cat_posts as $post) : ?>

      <div class="col-6 col-md-3">
        <a class="no-a-effect" href="<?php echo get_permalink($post->ID) ?>">
        <div class="item">
          <div class="book-cover px-3 px-md-4 px-lg-5 px-md-3">
            <?php 
            $bookCover = get_field('post_book_cover',$post->ID); 
            echo wp_get_attachment_image( $bookCover['id'],'medium');
            ?>
          </div>
          <div class="book-shelf"></div>
          <div class="book-title">
            <?php echo $post->post_title; ?>
          </div>
          <div class="book-author">
            <?php echo get_field('post_book_author',$post->ID); ?>
          </div>
        </div>
      </div>
      </a>
      <?php endforeach ?>

    </div> <!-- /div row -->
  </div> <!-- /div layout-1-4 sec-math -->
</section>

<?php }?>