<?php $color_class = herald_get_option('lay_fa1_color') ? 'herald-fa-colored' : ''  ?>

<div class="herald-fa-wrapper herald-fa-1 <?php echo esc_attr($color_class); ?>">
	
	<div class="row">
		
		<div class="col-lg-12">

		<div class="herald-fa-list">
		  
		  <?php while($fa_query->have_posts()): $fa_query->the_post(); ?>
		  	 
		  	  <?php $category = get_the_category(); $cat_id = isset($category[0]) ? $category[0]->term_id : ''; ?>
			 
			  <article class="herald-fa-item herald-cat-<?php echo esc_attr($cat_id); ?>">	    
				    
				    <header class="entry-header">				
						
						<?php if( herald_get_option( 'lay_fa1_cat' ) ) : ?>
							<span class="meta-category"><?php echo herald_get_category(); ?></span>
						<?php endif; ?>
				    	
				    	<?php the_title( sprintf( '<h2 class="entry-title h5"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				      	
				      	<?php if( $meta = herald_get_meta_data( 'fa1' ) ) : ?>
							<div class="entry-meta"><?php echo $meta; ?></div>
						<?php endif; ?>
					  	
					  	<?php if( herald_get_option('lay_fa1_excerpt') ) : ?>
							<div class="entry-content">
								<?php echo herald_get_excerpt( 'fa1' ); ?>
							</div>
						<?php endif; ?>
				      
				      <a href="#" class="fa-post-bg"></a>

				    </header>

					<?php if ( $fimg = herald_get_featured_image( 'herald-lay-fa1' ) ) : ?>						
						<a class="fa-post-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo $fimg; ?></a>						
					<?php endif; ?>
			  
			  </article>
		  
		  <?php endwhile; ?>
		  
		  <?php wp_reset_postdata(); ?>

		</div>

		</div>

	</div>

</div>