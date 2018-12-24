<div id="sticky-header" class="herald-header-sticky herald-header-wraper herald-slide hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
				<div class="col-lg-12 hel-el">
				
					<?php $left = array_keys( array_filter( herald_get_option( 'header_sticky_left' ) ) ); ?>
					<?php if(! empty($left) ) : ?>
					<div class="hel-l herald-go-hor">
						<?php foreach( $left as $element ): ?>
							<?php get_template_part('template-parts/header/elements/' . $element ); ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php $center = array_keys( array_filter( herald_get_option( 'header_sticky_center' ) ) ); ?>
					<?php if(! empty($center) ) : ?>
					<div class="hel-c herald-go-hor">
						<?php foreach( $center as $element ): ?>
							<?php get_template_part('template-parts/header/elements/' . $element ); ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php $right = array_keys( array_filter( herald_get_option( 'header_sticky_right' ) ) ); ?>
					<?php if(! empty($right) ) : ?>
					<div class="hel-r herald-go-hor">
						<?php foreach( $right as $element ): ?>
							<?php get_template_part('template-parts/header/elements/' . $element ); ?>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>					
					
				
				</div>
		</div>
		</div>
</div>