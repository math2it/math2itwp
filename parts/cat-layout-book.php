<?php if ( $list_posts ) {?>

<section class="layout-book <?php if($customSecClass){echo $customSecClass;} ?>">
  <div class="container">

    <div class="row justify-content-center">
      <!-- title? -->
      <?php if ($typeTitle){get_template_part( 'parts/sec-title' );} ?>
    </div>

    <div class="row row-eq-height justify-content-center">

      <?php foreach($list_posts as $post) : ?>

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
        </a>
      </div>
      <?php endforeach ?>

    </div> <!-- /div row -->
  </div> <!-- /div layout-1-4 sec-math -->
</section>

<?php }?>