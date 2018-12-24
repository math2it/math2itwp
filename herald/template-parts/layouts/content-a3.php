<article <?php post_class( 'herald-lay-a herald-lay-a3' ); ?>>

	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-a3' ) ) : ?>
		<div class="herald-post-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php echo $fimg; ?>
			</a>


			<div class="herald-lay-over">
				<div class="entry-header herald-pf-invert">
					<?php if( herald_get_option( 'lay_a3_cat' ) ) : ?>
						<span class="meta-category"><?php echo herald_get_category(); ?></span>
					<?php endif; ?>

					<?php the_title( sprintf( '<h2 class="entry-title h2"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					
					<?php if( $meta = herald_get_meta_data( 'a3' ) ) : ?>
						<div class="entry-meta"><?php echo $meta; ?></div>
					<?php endif; ?>
				</div>
			</div>

		</div>
	<?php endif; ?>



	<?php if( herald_get_option('lay_a3_excerpt') ) : ?>
		<div class="col-mod">
			<div class="entry-content">
				<?php echo herald_get_excerpt( 'a3' ); ?>
			</div>

			<?php if( herald_get_option('lay_a3_rm') ) : ?>
				<a class="herald-read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo __herald('read_more'); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>


</article>