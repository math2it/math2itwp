<?php if ( $gallery = hybrid_media_grabber( array( 'type' => 'gallery', 'split_media' => true ) ) ): ?>
	<div class="meta-media"><?php echo $gallery; ?></div>
<?php endif; ?>