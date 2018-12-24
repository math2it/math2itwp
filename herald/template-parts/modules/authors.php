<div class="herald-module <?php echo esc_attr( herald_get_module_class( $module ) );?>" id="herald-module-<?php echo esc_attr($s_ind.'-'.$m_ind); ?>" data-col="<?php echo esc_attr( $module['columns']);?>">
	
	<?php echo herald_get_module_heading( $module ); ?>

	<?php   
    $args = array(
        'fields'    => array('ID'),
        'order'     => $module['sort'],
        'orderby'   => $module['orderby'],
        'role__not_in' => $module['roles'],
        'exclude'   => $module['exclude'],
        'number'   => $module['authors_number']
    );
    $authors_query = new WP_User_Query($args); 
    $mod_query = $authors_query->get_results();
    
	?> 

	<?php $slider_class = herald_module_is_slider( $module ) && ( absint(count($mod_query) ) > 1 )  ? 'herald-slider' : ''; ?>
	<?php $eq_height_class = herald_module_is_eq_height( $module ) ? 'row-eq-height' : ''; ?>
	
	<div class="row herald-authors <?php echo esc_attr( $eq_height_class.' '.$slider_class); ?>">
			<?php foreach ($mod_query as $author): ?>
				<?php 
					if( herald_is_co_authors_active() ) {
				        $user = get_user_by( 'ID', $author->ID);           
				        $author_link_start = '<a href="'.esc_url( get_author_posts_url( $author->ID, $user->user_login )).'">';
				        $author_link_end = '</a>';
				    } else {
				        $author_link_start = '<a href="'.esc_url( get_author_posts_url(get_the_author_meta('ID', $author->ID))).'">';
				        $author_link_end = '</a>';
				    } 
				?>
				<?php include( locate_template('template-parts/layouts/content-author-'. $module['layout'].'.php' ) ); ?>
			<?php endforeach ?>
	</div>

</div>