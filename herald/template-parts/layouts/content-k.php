<article <?php post_class('herald-lay-k'); ?>>
	

	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-k' ) ) : ?>
		<div class="herald-post-thumbnail herald-format-icon-small">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php echo $fimg; ?>
				<?php echo herald_post_format_icon(); ?>
			</a>
		</div>
	<?php endif; ?>


	<div class="entry-header">
		<?php if( herald_get_option( 'lay_k_cat' ) ) : ?>
			<span class="meta-category meta-small"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>

		<?php if( herald_get_option( 'lay_k_title' ) ) : ?>
			<?php the_title( sprintf( '<h2 class="entry-title h7"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>

		<?php if( $meta = herald_get_meta_data( 'k' ) ) : ?>
			<div class="entry-meta meta-small"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>


</article>