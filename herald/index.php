<?php get_header(); ?>

<?php if( $fa = herald_get_featured_area() ) : ?>
		<?php if(!empty($fa['query']) && !empty( $fa['query']->posts ) ): ?>
			<?php $fa_query = $fa['query']; ?>
			<div class="herald-section container herald-no-sid">
				<div class="row">
					<div class="herald-module col-lg-12 col-md-12">
						<?php herald_set_img_flag('full'); ?>
						<?php include( locate_template('template-parts/featured/area-'. $fa['layout'].'.php' ) ); ?>
						<?php herald_set_img_flag(''); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
<?php endif; ?>

<?php global $herald_sidebar_opts; ?>
<?php $section_class = $herald_sidebar_opts['use_sidebar'] == 'none' ? 'herald-no-sid' : '' ?>

<div class="herald-section container <?php echo esc_attr($section_class); ?>">

	<div class="row">

		<?php if($herald_sidebar_opts['use_sidebar'] == 'left'): ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

		<?php $wrap_class = $herald_sidebar_opts['use_sidebar'] != 'none' ? 'herald-main-content col-lg-9 col-md-9' : 'col-lg-12 col-md-12' ?>

		<div class="herald-module col-mod-main <?php echo esc_attr($wrap_class); ?>">
			
			<?php if ( $archive_heading = herald_get_archive_heading() ): ?>
					<?php echo $archive_heading; ?>
			<?php endif; ?>
			
			<?php $ad_position = herald_get_option('ad_between_posts') ? absint( herald_get_option('ad_between_posts_position') - 1 ) : false ; ?>

			<div class="row row-eq-height herald-posts">
				<?php if(have_posts()): ?>
					<?php $i = 0; while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('template-parts/layouts/content',   herald_get_current_post_layout( $i ) ); ?>
					<?php if( $i === $ad_position ) { get_template_part('template-parts/ads/between-posts'); } ?>
					<?php $i++; endwhile; ?>
				<?php else : ?>
					<?php get_template_part('template-parts/layouts/content-none' ); ?>
				<?php endif;?>
			</div>
		
			<?php if( $pagination = herald_get_current_pagination() ) : ?>
				<?php get_template_part( 'template-parts/pagination/' . $pagination ); ?>
			<?php endif; ?>
				
		</div>

		<?php if( $herald_sidebar_opts['use_sidebar'] == 'right' ): ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

	</div>

</div>

<?php get_footer(); ?>