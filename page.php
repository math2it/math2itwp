<?php get_header(); ?>

<section class="header-page bg-black">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="page-title">
					<?php echo get_the_title(); ?>
				</h2>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section>

<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php
				// TO SHOW THE PAGE CONTENTS
				while ( have_posts() ) : the_post(); // Because the_content() works only inside a WP Loop
				?>
					<?php the_content(); ?>
				<?php
				endwhile; //resetting the page loop
				wp_reset_query(); //resetting the page query
				?>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</section>

<?php get_footer(); ?>