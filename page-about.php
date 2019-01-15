<!-- This page template is used only for gioi-thieu -->


<!-- header -->
<!-- ====================================== -->
<?php get_header(); ?>


<!-- intro header -->
<!-- ====================================== -->
<section class="bg-black header-intro gioi-thieu">
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
	7, // latex
	8 // giao-duc
);
$cat_ids_lenght = count($cat_ids);
?>

<section class="style-2-3">
	<div class="container">
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
						<div class="post-image">
							<i style="color: <?php echo get_field('dark_color','category_'.$cat_id) ?>;" class="<?php echo get_field('cat-icon','category_'.$cat_id) ?>"></i>
						</div>
						<div class="post-cat">
								<?php echo get_cat_name($cat_id) ?>
						</div>
						<div class="post-intro">
							<?php echo category_description($cat_id); ?>
						</div>
					</a>
				</div> <!-- /item -->
			</div> <!-- /col-12 col-sm-6 -->
		<?php endfor; ?>
	
		</div> <!-- /row -->
	</div>
</section>


<section class="section community">
	<div class="container">
		<div class="row align-items-center justify-content-md-center">
			<div class="col-12 col-sm-6 col-md-5 des">
				<h2>Cộng đồng Math2IT</h2>
				<p><a href="https://www.facebook.com/math2it" target="_blank">Fanpage Math2IT</a> luôn cập nhật và chia sẻ những thông tin hữu ích về học thuật. <a href="https://www.facebook.com/groups/math2it/" target="_blank">Nhóm Math2IT</a> tập hợp những thành viên nhiệt tình, sẵn sàng giúp đỡ và chia sẻ với bạn.</p>
			</div>
			<div class="col-12 col-sm-6 col-md-5">
				<div class="photo">
					<img src="<?php echo  get_template_directory_uri() ?>/img/community.png">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section" style="padding-bottom: 6rem;">
	<div class="container">
		<div class="row align-items-center justify-content-md-center">
			<div class="col-12 col-lg-10">
				<div class="newsletter">
					<div class="photo">
						<img src="<?php echo  get_template_directory_uri() ?>/img/send.png">
					</div>
					<div class="form">
						<div class="newsletter-text">
							Cập nhật bài đăng mới qua email?
						</div>
						<div class="newsletter-form">
							<input type="email" name="email" placeholder="Email của bạn" class="email">
							<input type="submit" name="submit" value="OK" class="submit"> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <section class="section contact">
	<div class="container">
		<div class="row align-items-center justify-content-md-center">
		<a href="mailto:math2it.blog@gmail.com">math2it.blog@gmail.com</a>.
		</div>
	</div>
</section> -->


<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>