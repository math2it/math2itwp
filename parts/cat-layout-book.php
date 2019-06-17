<?php if ( $list_posts ) {?>

<section class="layout-book <?php if($customSecClass){echo $customSecClass;} ?>">
  <div class="container">

    <div class="row justify-content-center">
      <?php if ($typeTitle){get_template_part( 'parts/sec-title' );} ?>
    </div>

    <div class="row list-of-post justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="container">
          <div class="row row-eq-height justify-content-center">
            <?php foreach($list_posts as $post) : ?>
            <?php $post_id = $post->ID; ?>

            <div class="col-6 col-md-3">
              <a class="no-a-effect" href="<?php echo get_permalink($post_id) ?>">
              <div class="item">
                <div class="book-cover px-3 px-md-4 px-lg-5 px-md-3">
                  <?php
                  $bookCover = get_field('post_book_cover',$post_id);
                  echo wp_get_attachment_image( $bookCover['id'],'medium');
                  ?>
                </div>
                <div class="book-shelf"></div>
                <div class="book-title">
                  <?php
                    if(get_field('post_book_title',$post_id)){
                      echo get_field('post_book_title',$post_id);
                    }else{
                      echo $post->post_title;
                    }
                  ?>
                </div>
                <div class="book-author">
                  <?php echo get_field('post_book_author',$post_id); ?>
                </div>
              </div>
              </a>
            </div>
            <?php endforeach ?>
          </div> <!-- /div row small -->
        </div>        <!-- /div.container small -->
      </div>      <!-- /div.col-12.col-xl-10 -->
    </div>    <!-- /div.row big -->

  </div> <!-- /div container big -->
</section>

<?php }?>
