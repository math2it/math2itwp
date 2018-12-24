<div class="herald-module <?php echo esc_attr( herald_get_module_class( $module ) ); ?>" id="herald-module-<?php echo esc_attr($s_ind.'-'.$m_ind); ?>" data-col="<?php echo esc_attr( $module['columns']);?>">

	<?php echo herald_get_module_heading( $module ); ?>

	<?php $mod_query = herald_get_module_products_query( $module ); ?>

	<?php $slider_class = herald_module_is_slider( $module ) && ( absint($mod_query->post_count) > 1 ) ? 'herald-slider' : ''; ?>
	<?php $eq_height_class = 'row-eq-height'; ?>
	
	<?php herald_set_img_flag('sid'); ?>

	<div class="row herald-posts <?php echo esc_attr($eq_height_class.' '.$slider_class); ?>">
		
		<?php if( $mod_query->have_posts()): while ( $mod_query->have_posts() ) : $mod_query->the_post(); ?>
			
			<article <?php post_class('herald-lay-i'); ?>>
	

				<?php if ( $fimg = herald_get_featured_image( 'shop_catalog' ) ) : ?>
					<div class="herald-post-thumbnail">
						<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
							<?php echo $fimg; ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="entry-header">
					<?php if(!empty($module['display_cat'])): ?>
						<span class="meta-category meta-small"><?php echo  get_the_term_list(get_the_ID(), 'product_cat', '', ' <span>&bull;</span> ', ''); ?></span>
					<?php endif; ?>
				
					<?php the_title( sprintf( '<h2 class="entry-title h5"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

					<?php if(!empty($module['display_price'])): ?>
						<div class="entry-meta"><?php echo woocommerce_template_loop_price(); ?></div>
					<?php endif; ?>
					
				</div>


			</article>
		
		<?php endwhile; endif; ?>

		<?php wp_reset_postdata(); ?>

	</div>

	<?php herald_set_img_flag(''); ?>

</div>