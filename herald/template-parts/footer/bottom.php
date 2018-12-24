<div class="footer-bottom">
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			
			<?php $left = array_keys( array_filter( herald_get_option( 'footer_left' ) ) ); ?>
			<?php if(! empty($left) ) : ?>
			<div class="hel-l herald-go-hor">
				<?php foreach( $left as $element ): ?>
					<?php get_template_part('template-parts/footer/elements/' . $element ); ?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php $right = array_keys( array_filter( herald_get_option( 'footer_right' ) ) ); ?>
			<?php if(! empty($right) ) : ?>
			<div class="hel-r herald-go-hor">
				<?php foreach( $right as $element ): ?>
					<?php get_template_part('template-parts/footer/elements/' . $element ); ?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<?php $center = array_keys( array_filter( herald_get_option( 'footer_center' ) ) ); ?>
			<?php if(! empty($center) ) : ?>
			<div class="hel-c herald-go-hor">
				<?php foreach( $center as $element ): ?>
					<?php get_template_part('template-parts/footer/elements/' . $element ); ?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</div>
</div>