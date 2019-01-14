<!-- This page template is used only for gioi-thieu -->


<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>


<!-- intro header -->
<!-- ====================================== -->
<section id="idx-header" class="header-intro gioi-thieu">
  <div class="container">
    <div class="row align-items-center">
      <div id="page-intro" class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-12 intro">
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


<!-- main topics -->
<!-- ====================================== -->

<?php 
$cat_ids = array(
	1, // toan hoc
	2, // cong nghe
	6, // bai dich
	7 // latex
);
$cat_ids_lenght = count($cat_ids);
?>

<section class="sec-cat layout-photo-intro gioi-thieu">
	<div class="container pt-md--3">
		<div class="row row-eq-height justify-content-md-center">
		<?php 
		for($x = 0; $x < $cat_ids_lenght; $x++):
			$cat_id = $cat_ids[$x];
			if (($cat_id == 1) or ($cat_id == 2)):
				$col = 'col-12 col-md-6'; // 2 cards
				$post_image = 'h-250';
			else:
				$col = 'col-12 col-md-4'; // 3 cards
				$post_image = 'h-200';
			endif;
		?>
			<div class="<?php echo $col ?>">
				<div class="item">
					<a class="no-a-effect" href="<?php echo esc_url( get_category_link($cat_id) ) ?>">
						<div class="post-image <?php echo $post_image ?>">
							<?php
							$postThumbnail = get_field('default_posts_feature_image','category_'.$cat_id);
							echo wp_get_attachment_image( $postThumbnail['id'],'medium');
							?>
						</div>
						<div class="post-cat" style="background: <?php echo get_field('dark_color', 'category_'.$cat_id); ?>;">
								<?php echo get_cat_name($cat_id) ?>
						</div>
						<div class="post-intro">
							<?php echo category_description($cat_id); ?>
						</div>
					</a>
				</div> <!-- /item -->
			</div> <!-- /col-12 col-sm-6 -->
		<?php endfor; ?>
			<div class="col-12 col-md-4">
				<?php $cat_id = 8 ?>
				<div class="item">
					<a class="no-a-effect" href="<?php echo esc_url( get_category_link($cat_id) ) ?>">
						<div class="post-image h-200">
							<?php
							$postThumbnail = get_field('default_posts_feature_image','category_'.$cat_id);
							echo wp_get_attachment_image( $postThumbnail['id'],'medium');
							?>
						</div>
						<div class="post-cat" style="background: <?php echo get_field('dark_color', 'category_'.$cat_id); ?>;">
								<?php echo get_cat_name($cat_id) ?>
						</div>
						<div class="post-intro">
							<?php echo category_description($cat_id); ?>
						</div>
					</a>
				</div> <!-- /item -->
			</div> <!-- /col-12 col-sm-6 -->
		</div> <!-- /row -->
	</div>
</section>


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