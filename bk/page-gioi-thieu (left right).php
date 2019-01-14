<!-- This page template is used only for gioi-thieu -->


<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>


<!-- intro header -->
<!-- ====================================== -->
<section id="idx-header" class="py-md-5 pb-5 header-intro">
  <div class="container">
    <div class="row align-items-center">
      <div id="page-intro" class="col-md-8 offset-md-2 col-12 intro">
        <div class="img-avatar">
          Math<i class="icon-math2it"></i>IT
        </div>
        <h4><?php echo get_bloginfo( 'description' ); ?></h4>
        <p>
					<?php echo get_option('site_short_description') ?>
        </p>
        <div class="idx-social">
          <a class="mr-s" href="<?php echo get_bloginfo( 'wpurl' ) ?>"><i class="icon-home"></i><span class="hide-on-xs"> Trang chủ</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook-group'); ?>"><i class="icon-group"></i><span class="hide-on-xs"> Nhóm Math2IT</span></a>
          <a class="mr-s" target="_blank" href="<?php echo get_option('facebook'); ?>"><i class="icon-facebook-squared"></i><span class="hide-on-xs"> FB Math2IT</span></a>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- main section -->
<!-- ====================================== -->
<?php
$categories = get_categories( array(
		'orderby' => 'term_id',
		'parent'  => 0
) );

$left = '2';
$right = '1';

foreach ( $categories as $category ):
	$cat_id = $category->term_id;
	$dark_color = get_field('dark_color','category_'.$cat_id);
?>

<section class="intro-page">
	<div class="container">
		<div class="row align-items-center justify-content-md-center">
			<?php 
				$left = ( $left == '1' ) ? '2' : '1'; 
				if ($left=='1'){$lalign = 'left';}else{$lalign = 'right';}
			?>
			<div class="col-12 col-md-4 order-md-<?php echo $left ?>">
				<div class="photo">
					<?php 
						$catThumbnail = get_field('photo_intro','category_'.$cat_id);
					?>
					<img src="<?php echo $catThumbnail['url'] ?>" alt="<?php echo get_cat_name($cat_id) ?>" >
				</div>
			</div>
			<?php 
				$right = ( $right == '1' ) ? '2' : '1';
			?>
			<div style="text-align: <?php echo $lalign ?>" class="col-12 col-md-6 order-md-<?php echo $right ?>">
				<h2 class="title">
				<a style="color: <?php echo $dark_color ?>" href="<?php echo get_category_link($cat_id) ?>"><?php echo get_cat_name($cat_id) ?></a>
				</h2>
				<div class="description">
					<?php echo category_description($cat_id); ?>
				</div>
			</div>
		</div>
	</div>
</section>


<?php endforeach; ?>


<section class="sec-cat">
	<div class="container">
		<div class="row align-items-center justify-content-md-center">
			<div class="col-12">
				<h2>Đội ngũ Math2IT</h2>
			</div>
		</div>
	</div>
</section>


<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>