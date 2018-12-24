<article <?php post_class('herald-lay-f'); ?>>
	
	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-f' ) ) : ?>
		<div class="herald-post-thumbnail herald-format-icon-middle">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php echo $fimg; ?>
				<?php echo herald_post_format_icon(); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-header">
		<?php if( herald_get_option( 'lay_f_cat' ) ) : ?>
			<span class="meta-category meta-small"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title h5"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if( $meta = herald_get_meta_data( 'f' ) ) : ?>
			<div class="entry-meta meta-small"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>

	<?php if( herald_get_option('lay_f_excerpt') ) : ?>
		<div class="entry-content">
			<?php echo herald_get_excerpt( 'f' ); ?>
		</div>
	<?php endif; ?>

	<?php if( herald_get_option('lay_f_rm') ) : ?>
		<a class="herald-read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo __herald('read_more'); ?></a>
	<?php endif; ?>

</article>