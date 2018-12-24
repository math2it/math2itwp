<?php if( $format = get_post_format() ): ?>
	<?php get_template_part('template-parts/single/'.$format); ?>
	<?php get_template_part('template-parts/single/head'); ?>
<?php else: ?>
	<div class="herald-ovrld">
	<?php get_template_part('template-parts/single/head'); ?>
	<?php get_template_part('template-parts/single/fimg'); ?>
	</div>
<?php endif; ?>