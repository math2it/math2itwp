<article <?php post_class('herald-lay-i herald-lay-i1'); ?>>
<div class="herald-ovrld">	
	
	<?php if ( $fimg = herald_get_category_featured_image( 'herald-lay-i1', $cat->term_id ) ) : ?>
		<div class="herald-post-thumbnail">
			<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" title="<?php echo esc_attr( $cat->name ); ?>">
					<?php echo $fimg; ?>
			</a>
		</div>
	<?php endif; ?>


	<div class="entry-header herald-clear-blur">
		<h2 class="entry-title h7"><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html($cat->name); ?></a></h2>

		<?php if($module['display_count']): ?>
	       <div class="entry-meta meta-small entry-meta-margin"><div class="meta-item"><?php echo esc_html( $cat->count ); ?> <?php echo esc_html($module['count_label']); ?></div></div>
		<?php endif; ?>
	</div>

</div>	
</article>