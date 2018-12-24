<?php if( $ad = herald_get_option('ad_below_single') ): ?>
	<div class="herald-ad"><?php echo do_shortcode( $ad ); ?></div>
<?php endif; ?>