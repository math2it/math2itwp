<div class="herald-module <?php echo esc_attr( herald_get_module_class( $module ) ); ?>" id="herald-module-<?php echo esc_attr($s_ind.'-'.$m_ind); ?>" data-col="<?php echo esc_attr( $module['columns']);?>">

	<?php echo herald_get_module_heading( $module ); ?>
	<?php $mod_query = herald_get_module_query( $module, $paged ); ?>
	<?php $slider_class = herald_module_is_slider( $module ) && ( absint($mod_query->post_count) > 1 )  ? 'herald-slider' : ''; ?>
	<?php $eq_height_class = herald_module_is_eq_height( $module ) ? 'row-eq-height' : ''; ?>

	<div class="row herald-posts <?php echo esc_attr( $eq_height_class.' '.$slider_class); ?>">
		
		<?php if( $mod_query->have_posts()): $i = 0; while ( $mod_query->have_posts() ) : $mod_query->the_post(); ?>
			
			<?php $layout = herald_get_module_layout( $module, $i ); ?>
			
			<?php get_template_part( 'template-parts/layouts/content', $layout ); ?>
		
		<?php $i++; endwhile; endif; ?>

		<?php wp_reset_postdata(); ?>

	</div>

	<?php if( herald_module_is_paginated( $s_ind, $m_ind ) ) : ?>
		<?php 
			$temp_query = $wp_query;
			$wp_query = $mod_query;
			get_template_part( 'template-parts/pagination/'.$pagination );
			$wp_query = $temp_query;
		?>
	<?php endif; ?>

</div>