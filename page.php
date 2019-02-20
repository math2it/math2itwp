<?php get_header(); ?>

<main role="main">

<header class="header-page bg-black">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-8">
				<h2 class="page-title">
					<?php echo get_the_title(); ?>
				</h2>
				<h4 class="page-subtitle">
					<?php 
						$page_id = get_the_ID();
						echo get_field('subtitle',$page_id);
					?>
				</h4>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>

<?php get_template_part( 'parts/subscribe-bar' ); ?>

<article class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8 blog-content">
				<?php
				// TO SHOW THE PAGE CONTENTS
				while ( have_posts() ) : the_post(); // Because the_content() works only inside a WP Loop
				?>
					<?php the_content(); ?>
				<?php
				endwhile; //resetting the page loop
				// wp_reset_query(); //resetting the page query
				?>
			</div> <!-- /.col -->
			<?php
				if (get_field('toc_on_sidebar',$page_id)==true):
			?>
					<div class="toc-sidebar">
						<nav id="toc" data-toggle="toc" class="sticky-top">
							<div>Trong bài này</div>
						</nav>
					</div>
			<?php
				endif;
				wp_reset_query(); //resetting the page query
			?>
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</article>

</main>

<?php get_footer(); ?>