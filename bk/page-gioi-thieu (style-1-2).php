<!-- This page template is used only for gioi-thieu -->


<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>


<!-- intro header -->
<!-- ====================================== -->
<section id="idx-header" class="header-intro gioi-thieu">
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


<!-- math & tech -->
<!-- ====================================== -->
<section id="math-tech" class="sec-cat sec-cat-1">
	<div class="container pt-md--3">
		<div class="row row-eq-height justify-content-md-center">
			<div class="col-12 col-md-6">
				<?php $cat_id = 1; // toan-hoc ?>
				<div class="style-1-2">
					<div class="featured-image">
						<?php
						$postThumbnail = get_field('photo_intro','category_'.$cat_id);
						echo wp_get_attachment_image( $postThumbnail['id'],'medium');
						?>
					</div>
					<h2 class="post-title">
						<?php echo get_cat_name($cat_id) ?>
					</h2>
					<div class="post-intro">
						<?php echo category_description($cat_id); ?>
					</div>
					<div class="topic">
						Put later
					</div>
				</div>
			</div> <!-- /col-12 -->
			<div class="col-12 col-md-6">
			<?php $cat_id = 2; // cong-nghe ?>
			<div class="style-1-2">
					<div class="featured-image">
						<?php
						$postThumbnail = get_field('photo_intro','category_'.$cat_id);
						echo wp_get_attachment_image( $postThumbnail['id'],'medium');
						?>
					</div>
					<h2 class="post-title">
						<?php echo get_cat_name($cat_id) ?>
					</h2>
					<div class="post-intro">
						<?php echo category_description($cat_id); ?>
					</div>
					<div class="topic">
						Put later
					</div>
				</div>
			</div> <!-- /col-12 -->
		</div>
	</div>
</section>


<!-- trans & latex & community -->
<!-- ====================================== -->
<section id="3-subjects" class="sec-cat-1">
	<div class="container">
		<div class="row row-eq-height justify-content-md-center">
			<div class="col-12 col-md-4">
				<?php $cat_id = 1;?>
				<div class="style-1-2">
					<div class="featured-image">
						<?php
						$postThumbnail = get_field('photo_intro','category_'.$cat_id);
						echo wp_get_attachment_image( $postThumbnail['id'],'medium');
						?>
					</div>
					<h2 class="post-title">
						<?php echo get_cat_name($cat_id) ?>
					</h2>
					<div class="post-intro">
						<?php echo category_description($cat_id); ?>
					</div>
					<div class="topic">
						Put later
					</div>
				</div>
			</div> <!-- /col-12 -->
			<div class="col-12 col-md-4">
				<?php $cat_id = 1; // toan-hoc ?>
				<div class="style-1-2">
					<div class="featured-image">
						<?php
						$postThumbnail = get_field('photo_intro','category_'.$cat_id);
						echo wp_get_attachment_image( $postThumbnail['id'],'medium');
						?>
					</div>
					<h2 class="post-title">
						<?php echo get_cat_name($cat_id) ?>
					</h2>
					<div class="post-intro">
						<?php echo category_description($cat_id); ?>
					</div>
					<div class="topic">
						Put later
					</div>
				</div>
			</div> <!-- /col-12 -->
		</div>
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