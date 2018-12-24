<?php if ( herald_get_post_display('fimg') && ( !herald_is_paginated_post() || herald_is_paginated_post_first_page() ) && $fimg = herald_get_featured_image( 'herald-lay-single', false, true ) ) : ?>
	<div class="herald-post-thumbnail herald-post-thumbnail-single">
		<span><?php echo $fimg; ?></span>
		<?php if( herald_get_option( 'single_fimg_cap' ) && $caption = get_post( get_post_thumbnail_id())->post_excerpt) : ?>
			<figure class="wp-caption-text"><?php echo $caption;  ?></figure>
		<?php endif; ?>
	</div>
<?php endif; ?>