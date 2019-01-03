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

	<div class="row">
		<div class="col-sm-12">
		<div>
			Page: Gioi Thieu.
		</div>
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); 	
					get_template_part( 'content', get_post_format() );
				endwhile; endif; 
			?>
		</div> <!-- /.col -->
	</div> <!-- /.row -->
<?php get_footer(); ?>