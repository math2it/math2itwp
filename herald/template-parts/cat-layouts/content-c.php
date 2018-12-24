<article <?php post_class('herald-lay-c'); ?>>
	
	<?php if ( $fimg = herald_get_category_featured_image( 'herald-lay-c', $cat->term_id ) ) : ?>
		<div class="herald-post-thumbnail herald-format-icon-middle">
			<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" title="<?php echo esc_attr( $cat->name ); ?>">
				<?php echo $fimg; ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-header">

		 <h2 class="entry-title h3"><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html($cat->name); ?></a></h2>

		<?php if($module['display_count']): ?>
	       <div class="entry-meta"><div class="meta-item"><?php echo esc_html( $cat->count ); ?> <?php echo esc_html($module['count_label']); ?></div></div>
		<?php endif; ?>

	</div>

</article>