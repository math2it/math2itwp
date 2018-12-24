<div class="herald-module <?php echo esc_attr( herald_get_module_class( $module ) ); ?>" id="herald-module-<?php echo esc_attr($s_ind.'-'.$m_ind); ?>" data-col="<?php echo esc_attr( $module['columns']);?>">

	<?php echo herald_get_module_heading( $module ); ?>
	<?php $eq_height_class = herald_module_is_eq_height( $module ) ? 'row-eq-height' : ''; ?>
	<?php $mod_cats = get_categories( array( 'include' => implode(",", $module['cat']) ) ); ?>

    <?php 
        $new_mod_cats = array();
        
        foreach( $mod_cats as $cat){
            if(!empty($module['cat'])){
                $new_mod_cats[array_search( $cat->term_id, $module['cat'])] = $cat;
             } else {
                $new_mod_cats[$cat->term_id] = $cat;
             }
        }
        
        ksort($new_mod_cats);
    ?>

    <?php $slider_class = herald_module_is_slider( $module ) && ( count($new_mod_cats) > 1 )  ? 'herald-slider' : ''; ?>

	<div class="row herald-posts herald-cats <?php echo esc_attr( $eq_height_class.' '.$slider_class); ?>">
		
		<?php if( !empty( $new_mod_cats ) ): ?> 
           
            <?php foreach( $new_mod_cats as $cat ): ?>
                
                <?php //$cat_post = new WP_Query( array( 'post_type' => 'post', 'category__in' => array( $cat->term_id ), 'posts_per_page' => 1, 'ignore_sticky_posts' => 1 ) ); ?>
                
                <?php //if( $cat_post->have_posts()): ?>
                    <?php //while( $cat_post->have_posts()): $cat_post->the_post(); ?>
                        <?php $layout = herald_get_module_layout( $module, 0 ); ?>
                        <?php include( locate_template('template-parts/cat-layouts/content-' . $layout . '.php') ); ?>
                    <?php //endwhile; ?>
                <?php //endif; ?>

                <?php //wp_reset_postdata(); ?>
            
            <?php endforeach; ?>
        <?php endif; ?>

	</div>

</div>