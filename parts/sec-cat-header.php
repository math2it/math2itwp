<?php
  $cat_id = get_query_var('cat_id'); // get category
?>

<header class="py-3 header-intro cat-intro bg-cat-<?php if (is_category()){echo $cat_id;}else{echo '2703';} ?>">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8 offset-md-2 col-12 intro">
        <div class="img-avatar">
          <?php if (is_category()){ ?>
            <i class="<?php echo get_field('cat-icon', 'category_'.$cat_id) ?>"></i>
          <?php }else{?>
            <i class="fa fa-tag" aria-hidden="true"></i>
          <?php }?>
        </div>

        <h1 class="title">
          <?php if (is_category()){
            echo get_cat_name($cat_id);
          }else{
            $tag = get_tag( $cat_id );
            echo $tag->name;
          }?>
        </h1>
        <?php if (is_category() and category_description()){ ?>
          <div class="description"><?php echo category_description(); ?></div>
        <?php }elseif(tag_description()){?>
          <div class="description"><?php echo tag_description(); ?></div>
        <?php }?>

        <div class="idx-social">
          <a class="mr-s" href="<?php echo get_bloginfo( 'wpurl' ) ?>/gioi-thieu"><i class="icon-heart"></i><span class="hide-on-xs"> Giới thiệu</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook-group'); ?>"><i class="icon-group"></i><span class="hide-on-xs"> Nhóm Math2IT</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook'); ?>"><i class="icon-facebook-squared"></i><span class="hide-on-xs"> FB Math2IT</span></a>
        </div>
      </div> <!-- /intro -->
    </div>
  </div>
</header>
