<?php
/**
 * Template Name: Full Width Page
 */
?>
<?php get_header(); ?>

<div class="herald-section container herald-no-sid">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('herald-page'); ?>>
			<div class="row">
				<div class="col-lg-12">
					<?php 
						$layout = herald_get_page_layout();
							herald_set_img_flag('full');
					?>
					<?php get_template_part('template-parts/page/head'); ?>
					<?php get_template_part('template-parts/page/fimg'); ?>
					<?php get_template_part('template-parts/page/content'); ?>
					<?php get_template_part('template-parts/page/extras'); ?>
				</div>
			</div>	
		</article>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>