<?php if( $format = get_post_format() ): ?>
	<?php get_template_part('template-parts/single/'.$format); ?>
<?php else: ?>
	<?php get_template_part('template-parts/single/fimg'); ?>
<?php endif; ?>