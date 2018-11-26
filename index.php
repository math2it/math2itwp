<?php get_header(); ?>

<!-- intro -->
<?php get_template_part( 'parts/sec-idx-intro' ); ?>

<div class="container">
  <div class="row">
    <div class="col-sm-8 blog-main">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
  			  get_template_part( 'content', get_post_format() );
        endwhile;
        get_template_part('parts/pagination');
      endif;
  		?>
    </div><!-- /.blog-main -->
    <?php get_sidebar(); ?>
  </div> <!-- /.row -->
</div> <!-- /.container -->

<?php get_footer(); ?>


