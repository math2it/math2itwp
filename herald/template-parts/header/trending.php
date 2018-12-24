<?php $trending = herald_get_trending_posts(); ?>
<?php $trending_number = herald_get_option('trending_number'); ?>
<?php $col_numb =  12 / $trending_number; ?>
<?php $slider = herald_get_option('trending_slider'); ?>
<?php $header_class = $slider ? 'header-slider' : ''; ?>
<?php $slider_class = $slider ? 'trending-slider' : ''; ?>
<?php $col_class = !$slider ? "col-lg-" . $col_numb . " col-md-" . $col_numb  : 'owl-col' ; ?>
<?php $class_thumb_of = herald_get_option('trending_fimg') ? '' : 'trending-no-featured-image' ?>

<?php if( $trending->have_posts() ) : ?>
<div class="header-trending hidden-xs hidden-sm <?php echo $header_class; ?>">
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 ">		
			<div class="row <?php echo esc_attr( $slider_class ) .' '.  esc_attr( $class_thumb_of ); ?>" data-col="<?php echo $trending_number; ?>">
					<?php herald_set_img_flag('sid'); ?>
					<?php while(  $trending->have_posts() ): $trending->the_post(); ?>
						<div class="<?php echo esc_attr($col_class); ?>">
							<?php if ( herald_get_option('trending_fimg') && $fimg = herald_get_featured_image( 'thumbnail' ) ) : ?>
								<div class="herald-post-thumbnail">
									<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo $fimg; ?></a>
								</div>
							<?php endif; ?>
							<?php the_title( sprintf( '<h4 class="h6"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
						</div>
					<?php endwhile; ?>
					<?php herald_set_img_flag(false); ?>
				
			</div>	
		</div>		
	</div>
</div>
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>