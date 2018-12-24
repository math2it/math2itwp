<article <?php post_class('herald-lay-g'); ?>>
<div class="row">	
		
	<?php if ( $fimg = herald_get_featured_image( 'herald-lay-g1' ) ) : ?>
	<div class="col-lg-4 col-xs-3 col-sm-4">
		<div class="herald-post-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php echo $fimg; ?>
			</a>
		</div>
	</div>
	<?php endif; ?>
	
<div class="col-lg-8 col-xs-9 col-sm-8 herald-no-pad">
	<div class="entry-header">
		<?php if( herald_get_option( 'lay_g1_cat' ) ) : ?>
			<span class="meta-category meta-small"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title h7"><a href="%s">'.herald_post_format_icon() , esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if( $meta = herald_get_meta_data( 'g1' ) ) : ?>
			<div class="entry-meta meta-small"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>
</div>

</div>
</article>