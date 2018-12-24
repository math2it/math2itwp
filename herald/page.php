<?php get_header(); ?>

<?php global $herald_sidebar_opts; ?>
<?php $section_class = $herald_sidebar_opts['use_sidebar'] == 'none' ? 'herald-no-sid' : '' ?>

<div class="herald-section container <?php echo esc_attr($section_class); ?>">
	
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('herald-page'); ?>>
			<div class="row">
				<?php 
					$layout = herald_get_page_layout();
					if( in_array( $layout, array('4','5', '6') ) ){
						herald_set_img_flag('full');
					} else {
						herald_set_img_flag('sid');
					}
				?>
				<?php get_template_part( 'template-parts/page/layout',  $layout ); ?>
			</div>	
		</article>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>