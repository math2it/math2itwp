<article <?php post_class('herald-lay-l'); ?>>
	
	<div class="entry-header">

		<h2 class="entry-title h7"><a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html($cat->name); ?></a></h2>

		<?php if($module['display_count']): ?>
	       <div class="entry-meta meta-small"><div class="meta-item"><?php echo esc_html( $cat->count ); ?> <?php echo esc_html($module['count_label']); ?></div></div>
		<?php endif; ?>
		
	</div>

</article>