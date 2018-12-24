<article <?php post_class('herald-lay-f herald-lay-f1'); ?>>
<div class="herald-ovrld">		
	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-f1' ) ) : ?>
		<div class="herald-post-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo $fimg; ?></a>
		</div>
	<?php endif; ?>

	<div class="entry-header">
		<?php if( !empty($instance['cat_link']) ) : ?>
			<span class="meta-category"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title h6"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if( $meta = herald_get_meta_data( false, $instance['meta'] ) ) : ?>
			<div class="entry-meta"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>
</div>

</article>