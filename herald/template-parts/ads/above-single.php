<?php if( $ad = herald_get_option('ad_above_single') ): ?>
	<div class="herald-ad herald-ad-above-single"><?php echo do_shortcode( $ad ); ?></div>
<?php endif; ?>