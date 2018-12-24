<div class="meta-media">
	<?php if ($audio = hybrid_media_grabber( array( 'type' => 'audio', 'split_media' => true ) ) ): ?>
 		<?php echo $audio; ?>
 	<?php endif; ?>
 	<?php get_template_part('template-parts/single/fimg'); ?>
</div>