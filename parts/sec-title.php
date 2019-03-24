<?php 
  $cat_id = get_query_var('cat_id'); // get category
  $typeTitle = get_query_var('typeTitle'); // small or big title
  $customTitle = get_query_var('customTitle'); 
  $customURL = get_query_var('customURL');
  $customIcon = get_query_var('customIcon');
  if ($typeTitle == 'middle'){
    $secTitleClass = 'sec-title-middle';
  }else{
    $secTitleClass = 'sec-title sec-title-'.$typeTitle;
  }
?>
<div class="col-12">
  <div class="<?php echo $secTitleClass ?>">
    <h2 class="new-title <?php if(!$customIcon){echo 'cat-title-'.$cat_id;} ?>">
      <i class="<?php if($customIcon){echo $customIcon;}else{echo get_field('cat-icon', 'category_'.$cat_id);} ?>"></i>
      <a href="<?php if($customURL){echo $customURL;}else{echo get_category_link($cat_id);} ?>" >
        <?php 
          if (!empty($customTitle)):
            echo $customTitle;
          else:
            echo get_cat_name($cat_id);
          endif;
        ?>
      </a>
    </h2>
    <?php if ($typeTitle=='middle'){echo '<div></div>';} ?>
    <a href="<?php if($customURL){echo get_site_url().$customURL;}else{echo get_category_link($cat_id);} ?>" class="view-all">xem thêm</a>
  </div>
</div>
<?php wp_reset_query(); // reset ?>