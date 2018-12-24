<article <?php post_class('herald-lay-h'); ?>>
	
	<div class="entry-header">
		<?php if( herald_get_option( 'lay_h_cat' ) ) : ?>
			<span class="meta-category meta-small"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>
		
		<?php the_title( sprintf( '<h2 class="entry-title h6"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if( $meta = herald_get_meta_data( 'h' ) ) : ?>
			<div class="entry-meta meta-small"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>

	<?php if( herald_get_option('lay_h_excerpt') ) : ?>
		<div class="entry-content">
			<?php echo herald_get_excerpt( 'h' ); ?>
		</div>
	<?php endif; ?>

	<?php if( herald_get_option('lay_h_rm') ) : ?>
		<a class="herald-read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo __herald('read_more'); ?></a>
	<?php endif; ?>

</article>