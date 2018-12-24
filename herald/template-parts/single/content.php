<div class="entry-content herald-entry-content">

	<?php if( herald_is_paginated_post() && strpos( herald_get_option( 'single_paginated_nav_position'), 'above' ) !== false ) : ?>
		<?php get_template_part( 'template-parts/single/paginated-nav' ); ?>
	<?php endif; ?>

	<?php if( herald_get_post_display( 'headline' ) && has_excerpt() ): ?>
		<div class="entry-headline h5"><?php echo get_the_excerpt(); ?></div>
	<?php endif; ?>

	<?php if( herald_get_post_display( 'ad_above' ) ) : ?>
		<?php get_template_part('template-parts/ads/above-single'); ?>
	<?php endif; ?>
	
	<?php the_content(); ?>

	<?php if( herald_is_paginated_post() && strpos( herald_get_option( 'single_paginated_nav_position'), 'below' ) !== false ) : ?>
		<?php get_template_part( 'template-parts/single/paginated-nav' ); ?>
	<?php endif; ?>

	<?php if( herald_get_post_display( 'tags' ) && has_tag() ) : ?>
		<div class="meta-tags">
			<span><?php echo __herald('tagged_as'); ?></span><?php the_tags( false, ' ', false ); ?>
		</div>
	<?php endif; ?>

	<?php if( herald_get_post_display( 'ad_below' ) ) : ?>
		<?php get_template_part('template-parts/ads/below-single'); ?>
	<?php endif; ?>
</div>