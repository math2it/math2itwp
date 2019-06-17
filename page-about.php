<?php get_header(); ?>

<main role="main">

<header class="bg-black header-intro gioi-thieu">
  <div class="container">
    <div class="row align-items-center">
      <div id="page-intro" class="col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-12 intro">
        <div class="img-avatar">
					Math<i class="icon-math2it"></i>IT
					<h1>Math2IT</h1>
        </div>
        <h2 data-toc-skip class="subtitle"><?php echo get_bloginfo( 'description' ); ?></h2>
        <p class="description">
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
</header>


<!-- main topics -->
<!-- ====================================== -->

<?php
$cat_slugs = array(
	'math', // toan hoc
	'technology', // cong nghe
	'translated-articles', // bai dich
	'tool', // latex
	'education' // giao-duc
);
$cat_slugs_lenght = count($cat_slugs);
?>

<section class="style-2-3">
	<div class="container">

		<div class="row list-of-post justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="container">
        	<div class="row row-eq-height justify-content-md-center">
			      <?php
			      for($x = 0; $x < $cat_slugs_lenght; $x++):
			        $cat_slug_text = $cat_slugs[$x];
			        $cat_slug = get_category_by_slug( $cat_slug_text );
			        $cat_id = $cat_slug->term_id;
			        if (($cat_slug_text == 'math') or ($cat_slug_text == 'technology')):
			          $col = 'col-12 col-md-6'; // 2 cards
			        else:
			          $col = 'col-12 col-md-4'; // 3 cards
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
			    </div> <!-- /row small-->
        </div>
      </div>
    </div>

	</div>	<!-- /div.container big -->
</section>


<section class="community">
	<div class="container">
		<div class="row align-items-center justify-content-md-center">
			<div class="col-12 col-sm-6 col-md-6 des">
				<h2>Cộng đồng Math2IT</h2>
				<p><a href="https://www.facebook.com/math2it" target="_blank">Fanpage Math2IT</a> luôn cập nhật và chia sẻ những thông tin hữu ích về học thuật. <a href="https://www.facebook.com/groups/math2it/" target="_blank">Nhóm Math2IT</a> tập hợp những thành viên nhiệt tình, sẵn sàng giúp đỡ và chia sẻ với bạn.</p>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<div class="photo">
					<img src="<?php echo  get_template_directory_uri() ?>/img/community.png">
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">

		<div class="row list-of-post justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="container">
        	<div class="row align-items-center justify-content-md-center">
			      <div class="col-12">
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
      </div>
    </div>

	</div>
</section>


<section id="contact" class="section">
	<div class="container">
		<div class="row align-items-center justify-content-md-center">
			<div class="col-sm-8 col-12">
				<h3 class="title">Liên hệ với chúng tôi?</h3>
				<div class="email">
					<a href="mailto:math2it.blog@gmail.com?subject=Trò chuyện với Math2IT&cc=dinhanhthimail@gmail.com">math2it.blog@gmail.com</a>
				</div>
			</div>
		</div>
	</div>
</section>

</main>

<!-- footer -->
<!-- ====================================== -->
<?php get_footer(); ?>
