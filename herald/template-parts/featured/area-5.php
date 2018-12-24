<div class="herald-fa-wrapper herald-fa-5">
	
	<div class="row">

		<div class="col-lg-12">
	
		<div class="fa-items-container">

		 <?php $i = 0; while( $fa_query->have_posts() ): $fa_query->the_post(); ?>
		  	 
		  	  <?php $category = get_the_category(); $cat_id = isset($category[0]) ? $category[0]->term_id : ''; ?>
			  
			  <?php if($i == 0) : ?>
			  <article class="herald-fa-item herald-cat-<?php echo esc_attr($cat_id); ?>">	    
				    
				    <header class="entry-header">				
						
						<?php if( herald_get_option( 'lay_fa5_cat' ) ) : ?>
							<span class="meta-category"><?php echo herald_get_category(); ?></span>
						<?php endif; ?>
				    	
				    	<?php the_title( sprintf( '<h2 class="entry-title h3"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				      	
				      	<?php if( $meta = herald_get_meta_data( 'fa5' ) ) : ?>
							<div class="entry-meta"><?php echo $meta; ?></div>
						<?php endif; ?>

				      <a href="#" class="fa-post-bg"></a>
				    </header>
					
					<?php if ( $fimg = herald_get_featured_image( 'herald-lay-fa5' ) ) : ?>						
						<a class="fa-post-thumbnail" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo $fimg; ?></a>						
					<?php endif; ?>
			  
			  </article>

		   <?php endif; ?>

		   <?php if( $i == 1 ) : ?>
		   		<div class="fa-sub-items-wrapper">
		   <?php endif; ?>

		   <?php if( $i > 0 ) : ?>
		   		<article class="herald-sub-item">
			  		<header class="entry-header">	
			  			<?php if( herald_get_option( 'lay_fa5_cat' ) ) : ?>
							<span class="meta-category"><?php echo herald_get_category(); ?></span>
						<?php endif; ?>
			  			<?php the_title( sprintf( '<h2 class="entry-title h6"><a href="%s">'.herald_post_format_icon(), esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			  			<?php if( $meta = herald_get_meta_data( 'fa5' ) ) : ?>
							<div class="entry-meta"><?php echo $meta; ?></div>
						<?php endif; ?>
					</header>
					<a class="herald-item-link" href="<?php echo get_the_permalink(); ?>"></a>
		  		</article>
		   <?php endif; ?>
		
		  <?php if( $i == 3 ) : ?>
		   		</div>
		   <?php endif; ?>
		  

		  <?php $i++; endwhile; ?>

		  <?php wp_reset_postdata(); ?>


		</div>

		</div>
	</div>
</div>