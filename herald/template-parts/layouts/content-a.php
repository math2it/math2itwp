<article <?php post_class( 'herald-lay-a' ); ?>>

	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-a' ) ) : ?>
		<div class="herald-post-thumbnail herald-format-icon-big">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php echo $fimg; ?>
				<?php echo herald_post_format_icon(); ?>
			</a>
		</div>
	<?php endif; ?>

<div class="col-mod">
	<div class="entry-header">
		<?php if( herald_get_option( 'lay_a_cat' ) ) : ?>
			<span class="meta-category"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title h2"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		
		<?php if( $meta = herald_get_meta_data( 'a' ) ) : ?>
			<div class="entry-meta"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>

	<?php $content_type = herald_get_option('lay_a_content'); ?>

	<?php if( $content_type == 'excerpt' ) : ?>
		<div class="entry-content">
			<?php echo herald_get_excerpt( 'a' ); ?>
		</div>
	<?php else: ?>
		<?php if( $content_type == 'content' ) : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if( herald_get_option('lay_a_rm') ) : ?>
		<a class="herald-read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo __herald('read_more'); ?></a>
	<?php endif; ?>
</div>
</article>