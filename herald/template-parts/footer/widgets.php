<?php 
	$layout = explode( "_", herald_get_option('footer_layout') );
	$columns = $layout[0];
	$col_class = $layout[1];
?>

<div class="footer-widgets container">
	<div class="row">
		<?php for($i = 1; $i <= $columns; $i++) : ?>
			<div class="col-lg-<?php echo esc_attr($col_class); ?> col-md-<?php echo esc_attr($col_class); ?> col-sm-<?php echo esc_attr($col_class); ?>">
				<?php dynamic_sidebar('herald_footer_sidebar_'.$i);?>
			</div>
		<?php endfor; ?>
	</div>
</div>