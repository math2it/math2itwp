<?php if ( $video = hybrid_media_grabber( array( 'type' => 'video', 'split_media' => true ) ) ): ?>
		<div class="meta-media"><?php echo $video; ?></div>
<?php endif; ?>