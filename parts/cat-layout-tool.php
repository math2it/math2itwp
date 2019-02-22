<?php // only used for tool posts ?>

<?php if ( $list_posts ) {?>

<section class="layout-tool <?php if($customSecClass){echo $customSecClass;} ?>">
  <div class="container">
    <?php $order = ''; ?>
    <?php foreach($list_posts as $post) : 
      $post_id = $post->ID;
    ?>
    <div class="row item align-items-center justify-content-center">
      <div class="col-12 col-md-6 col-lg-7 <?php echo $order ?>">
        <div class="description">
          <h2><?php echo $post->post_title; ?></h2>
          <div class="meta">
            <?php
              $field = get_field_object('pricing',$post_id);
              $value = $field['value'];
              $label = $field['choices'][ $value ]; ?>
              <span class="label pricing-<?php echo $value; ?>"><?php echo $label; ?></span>
            <?php
              $field = get_field_object('platform',$post_id);
              $values = $field['value'];
              foreach ($values as $item){
                foreach ($field['choices'] as $value => $label) {
                  if($label == $item){
                    $value2 = $value;
                    break;
                  }
                }
              ?>
                <span class="label platfom">
                  <i class="icon-<?php echo $value2; ?>"></i>
                  <?php echo $label; ?>
              </span>
            <?php } ?>
          </div>
          <div class="intro">
            <?php if (has_excerpt($post_id)){
              echo esc_attr(get_the_excerpt($post_id));
            }else{
              setup_postdata( $post );
              echo get_the_excerpt();
            } ?>
          </div>
          <div class="more-info">
            <a class="label home-page" href="<?php echo get_field('tool_url',$post_id); ?>">
              <i class="fa fa-link" aria-hidden="true"></i> Trang web
            </a>
            <?php 
              $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink($post_id) . '&title=' . get_the_title($post_id) . '';
            ?>
            <a class="label share" href="javascript:void(0)" onclick="atomicBlocksShare('<?php echo $facebook_url ?>','<?php echo get_the_title($post_id) ?>','600','600')" title="Share on facebook">
              <i class="fa fa-facebook" aria-hidden="true"></i> 
              Chia sẻ
            </a>
            <?php if (get_field('read_more',$post_id)){?>
              <a class="label more" href="<?php echo get_permalink($post_id) ?>">
                Chi tiết hơn
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-5">
        <div class="photo">
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
      </div>
    </div>
    <?php if ($order == ''){$order = 'order-1';}else{$order = '';} ?>
    <?php endforeach; ?>
  </div>
</section>

<?php }?>