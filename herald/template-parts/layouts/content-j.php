<article <?php post_class('herald-lay-j'); ?>>
	
	<div class="entry-header">
		<?php if( herald_get_option( 'lay_j_cat' ) ) : ?>
			<span class="meta-category meta-small"><?php echo herald_get_category(); ?></span>
		<?php endif; ?>
		
		<?php the_title( sprintf( '<h2 class="entry-title h7"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if( $meta = herald_get_meta_data( 'j' ) ) : ?>
			<div class="entry-meta meta-small"><?php echo $meta; ?></div>
		<?php endif; ?>
	</div>

</article>