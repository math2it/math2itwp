<article <?php post_class('herald-lay-b herald-post'); ?>>
<div class="row">
	
	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-b' ) ) : ?>
		<div class="col-lg-6 col-md-6 col-sm-5">
			<div class="herald-post-thumbnail herald-format-icon-middle">
				<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
					<?php echo $fimg; ?>
					<?php echo herald_post_format_icon(); ?>
				</a>
			</div>
		</div>
	<?php endif; ?>


	<div class="col-lg-6 col-md-6 col-sm-7">
		<div class="entry-header">
			<?php if( herald_get_option( 'lay_b_cat' ) ) : ?>
				<span class="meta-category"><?php echo herald_get_category(); ?></span>
			<?php endif; ?>

			<?php the_title( sprintf( '<h2 class="entry-title h3"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if( $meta = herald_get_meta_data( 'b' ) ) : ?>
				<div class="entry-meta"><?php echo $meta; ?></div>
			<?php endif; ?>
		</div>

		<?php if( herald_get_option('lay_b_excerpt') ) : ?>
			<div class="entry-content">
				<?php echo herald_get_excerpt( 'b' ); ?>
			</div>
		<?php endif; ?>

		<?php if( herald_get_option('lay_b_rm') ) : ?>
			<a class="herald-read-more" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo __herald('read_more'); ?></a>
		<?php endif; ?>
	</div>
</div>
</article>