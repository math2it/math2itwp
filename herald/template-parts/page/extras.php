<?php if ( herald_get_option('page_comments') && ( comments_open() || get_comments_number() ) ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>