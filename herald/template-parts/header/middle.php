<div class="header-middle herald-header-wraper hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
				<div class="col-lg-12 hel-el">
				
					<?php $left = array_keys( array_filter( herald_get_option( 'header_middle_left' ) ) ); ?>
					<?php if(! empty($left) ) : ?>
					<div class="hel-l <?php echo esc_attr('herald-go-'.herald_get_option('header_middle_left_align')); ?>">
						<?php foreach( $left as $element ): ?>
							<?php get_template_part('template-parts/header/elements/' . $element ); ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php $center = array_keys( array_filter( herald_get_option( 'header_middle_center' ) ) ); ?>
					<?php if(! empty($center) ) : ?>
					<div class="hel-c <?php echo esc_attr('herald-go-'.herald_get_option('header_middle_center_align')); ?>">
						<?php foreach( $center as $element ): ?>
							<?php get_template_part('template-parts/header/elements/' . $element ); ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php $right = array_keys( array_filter( herald_get_option( 'header_middle_right' ) ) ); ?>
					<?php if(! empty($right) ) : ?>
					<div class="hel-r <?php echo esc_attr('herald-go-'.herald_get_option('header_middle_right_align')); ?>">
						<?php foreach( $right as $element ): ?>
							<?php get_template_part('template-parts/header/elements/' . $element ); ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>			
					
				
				</div>
		</div>
		</div>
</div>