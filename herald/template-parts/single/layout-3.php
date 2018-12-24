<?php global $herald_sidebar_opts; ?>

<?php if($herald_sidebar_opts['use_sidebar'] == 'left'): ?>
    <?php get_sidebar(); ?>
<?php endif; ?>
			
<div class="col-lg-9 col-md-9 col-mod-single col-mod-main">
	
	<?php get_template_part('template-parts/single/media', '3'); ?>
		
		<div class="row">

			<?php get_template_part('template-parts/single/meta'); ?>

			<div class="<?php echo esc_attr(herald_single_content_class()); ?>">
				<?php get_template_part('template-parts/single/content'); ?>
			</div>

			<div id="extras" class="col-lg-12 col-md-12 col-sm-12">
				<?php get_template_part('template-parts/single/extras'); ?>
			</div>

		</div>

</div>

<?php if( $herald_sidebar_opts['use_sidebar'] == 'right' ): ?>
	<?php get_sidebar(); ?>
<?php endif; ?>