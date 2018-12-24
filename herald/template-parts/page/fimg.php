<?php if ( herald_get_option( 'page_fimg' ) && $fimg = herald_get_featured_image( 'herald-lay-page', false, true ) ) : ?>
	<div class="herald-page-thumbnail">
		<span><?php echo $fimg; ?></span>
		<?php if( herald_get_option( 'page_fimg_cap' ) && $caption = get_post( get_post_thumbnail_id())->post_excerpt) : ?>
			<div class="wp-caption-text"><?php echo $caption;  ?></div>
		<?php endif; ?>
	</div>
<?php endif; ?>