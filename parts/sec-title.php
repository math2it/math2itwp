<div class="col-12">
  <div class="sec-title sec-title-big">
    <h2 class="new-title">
      <i class="<?php echo get_field('cat-icon', 'category_'.$cat_id) ?>"></i>
      <?php echo get_cat_name($cat_id);?>
    </h2>
    <a href="<?php echo get_category_link($cat_id) ?>" class="view-all">xem thêm</a>
  </div>
</div>