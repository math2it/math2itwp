<div class="herald-module <?php echo esc_attr( herald_get_module_class( $module ) );?>" id="herald-module-<?php echo esc_attr($s_ind.'-'.$m_ind); ?>">
	<?php echo herald_get_module_heading( $module ); ?>
	<?php $fa_query = herald_get_featured_module_query( $module ); ?>
	<?php include( locate_template('template-parts/featured/area-'. $module['layout'].'.php' ) ); ?>
</div>