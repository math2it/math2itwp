<article <?php post_class('herald-lay-d'); ?>>
<div class="row">
	
	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-d' ) ) : ?>
		<div class="col-lg-6 col-xs-6 col-sm-5">
			<div class="herald-post-thumbnail herald-format-icon-middle">
				<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php echo $fimg; ?>
					<?php echo herald_post_format_icon(); ?>
				</a>
			</div>
		</div>
	<?php endif; ?>


	<div class="col-lg-6 col-xs-6 col-sm-7 herald-no-pad">
		<div class="entry-header">
			<?php if( herald_get_option( 'lay_d_cat' ) ) : ?>
				<span class="meta-category meta-small"><?php echo herald_get_category(); ?></span>
			<?php endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title h6"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if( $meta = herald_get_meta_data( 'd' ) ) : ?>
				<div class="entry-meta meta-small"><?php echo $meta; ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>
</article>