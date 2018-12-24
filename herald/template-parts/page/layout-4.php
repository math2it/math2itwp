<?php global $herald_sidebar_opts; ?>

<div class="col-lg-12 herald-pag-lay-5 herald-ignore-sticky-height">
	<?php get_template_part('template-parts/page/media', '1'); ?>
</div>
	
<?php if($herald_sidebar_opts['use_sidebar'] == 'left'): ?>
	<?php get_sidebar(); ?>
<?php endif; ?>
		
<div class="col-lg-9 col-mod-single col-mod-main">
	<?php get_template_part('template-parts/page/content'); ?>
	<?php get_template_part('template-parts/page/extras'); ?>
</div>

<?php if( $herald_sidebar_opts['use_sidebar'] == 'right' ): ?>
	<?php get_sidebar(); ?>
<?php endif; ?>