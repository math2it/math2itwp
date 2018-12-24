<div class="entry-content herald-entry-content">

	<?php the_content(); ?>

	<?php if( is_page_template('template-authors.php') ) : ?>
    	<?php get_template_part('template-parts/page/authors'); ?>
	<?php endif; ?>

</div>