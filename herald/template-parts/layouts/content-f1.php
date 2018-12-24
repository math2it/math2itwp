<article <?php post_class('herald-lay-f herald-lay-f1'); ?>>
<div class="herald-ovrld">		
	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-f1' ) ) : ?>
		<div class="herald-post-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo $fimg; ?></a>
		</div>
	<?php endif; ?>

	<div class="entry-header herald-clear-blur">
		<?php if( herald_get_option( 'lay_f1_cat' ) ) : ?>
			<span class="meta-category"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title h6"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if( $meta = herald_get_meta_data( 'f1' ) ) : ?>
			<div class="entry-meta"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>
</div>
	<?php if( herald_get_option('lay_f1_excerpt') ) : ?>
		<div class="entry-content">
			<?php echo herald_get_excerpt( 'f1' ); ?>
		</div>
	<?php endif; ?>

	<?php if( herald_get_option('lay_f1_rm') ) : ?>
		<a class="herald-read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo __herald('read_more'); ?></a>
	<?php endif; ?>

</article>