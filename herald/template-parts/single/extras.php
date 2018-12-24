<?php if( herald_get_post_display('related' ) ) : ?>
		<?php get_template_part( 'template-parts/single/related' ); ?>
<?php endif; ?>

<?php if( herald_get_post_display( 'author' ) ) : ?>
	<?php get_template_part( 'template-parts/single/author' ); ?>
<?php endif; ?>

<?php if ( comments_open() || get_comments_number() ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>

<?php if( herald_get_post_display( 'sticky_bar' ) ) : ?>
	<?php get_template_part( 'template-parts/single/sticky' ); ?>
<?php endif; ?>