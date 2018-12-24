<?php

       $authors_meta = herald_get_page_meta( get_the_ID(), 'authors' );   

	   $args = array(
            'fields'    => array('ID'),
            'order'     => $authors_meta['order'],
            'orderby'   => $authors_meta['orderby'],
            'role__not_in' => $authors_meta['roles'],
            'exclude'   => $authors_meta['exclude'] 
        );

	   $authors_query = new WP_User_Query($args); 
	   $authors = $authors_query->get_results();

?>
<div id="author" class="herald-vertical-padding">
         
    <?php if( !empty( $authors ) ) : ?>

        <?php foreach ($authors as $key) : 

            $socials = herald_get_author_social(get_the_author_meta('ID',$key->ID));

            if( herald_is_co_authors_active() ) {
                $user = get_user_by( 'ID', $key->ID);           
                $actions = '<a href="'.esc_url( get_author_posts_url( $key->ID, $user->user_login )).'">'.__herald('view_all_posts').'</a>';
            } else {
                $actions = '<a href="'.esc_url( get_author_posts_url(get_the_author_meta('ID', $key->ID))).'">'.__herald('view_all_posts').'</a>';
            }

            ?>

            <div class="herald-author row">

                <div class="herald-author-data col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <?php echo get_avatar( get_the_author_meta('ID', $key->ID), 140 ); ?>
                </div>
                
                <div class="herald-data-content col-lg-10 col-md-10 col-sm-10 col-xs-10">
                    <h4 class="author-title"><?php the_author_meta('display_name', $key->ID); ?></h4>
                    <?php echo wpautop(get_the_author_meta('description', $key->ID)); ?>
                    <div class="herald-socials-actions">
                        <div class="herald-mod-actions"><?php echo $actions; ?></div>
                        <div class="herald-mod-subnav"><?php echo $socials; ?></div>
                    </div>
                </div>

            </div>

            <hr class="herald-shadow">

        <?php endforeach; ?>

    <?php endif; ?>

</div>