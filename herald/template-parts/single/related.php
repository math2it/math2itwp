<?php $related = herald_get_related_posts(); ?>
<?php if( $related->have_posts() ) : ?>
<div id="related" class="herald-related-wrapper">		
		<?php echo herald_print_heading( array( 'title' => '<h4 class="h6 herald-mod-h herald-color">'.__herald('related').'</h4>' ) ); ?>

		<div class="herald-related row row-eq-height">

			<?php $layout = herald_get_option('related_layout'); ?>
			<?php herald_set_img_flag('sid'); ?>
			<?php while ( $related->have_posts() ) : $related->the_post(); ?>
				<?php get_template_part('template-parts/layouts/content',  $layout ); ?>
			<?php endwhile; ?>
			<?php herald_set_img_flag(''); ?>
		</div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>