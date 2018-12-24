<?php if( $ad = herald_get_option('ad_between_posts') ): ?>
	<div class="herald-ad"><?php echo do_shortcode( $ad ); ?></div>
<?php endif; ?>