<div class="header-top hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				
				<?php $left = array_keys( array_filter( herald_get_option( 'header_top_left' ) ) ); ?>
				<?php if(! empty($left) ) : ?>
				<div class="hel-l">
					<?php foreach( $left as $element ): ?>
						<?php get_template_part('template-parts/header/elements/' . $element ); ?>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<?php $right = array_keys( array_filter( herald_get_option( 'header_top_right' ) ) ); ?>
				<?php if(! empty($right) ) : ?>
				<div class="hel-r">
					<?php foreach( $right as $element ): ?>
						<?php get_template_part('template-parts/header/elements/' . $element ); ?>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<?php $center = array_keys( array_filter( herald_get_option( 'header_top_center' ) ) ); ?>
				<?php if(! empty($center) ) : ?>
				<div class="hel-c">
					<?php foreach( $center as $element ): ?>
						<?php get_template_part('template-parts/header/elements/' . $element ); ?>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</div>