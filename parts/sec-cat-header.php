<?php
  $cat_id = get_query_var('cat_id'); // get category
?>

<section id="header-cat-<?php echo $cat_id ?>" class="py-md-5 pb-5 header-intro cat-intro">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8 offset-md-2 col-12 intro">
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
    </div>
  </div>
</section>
