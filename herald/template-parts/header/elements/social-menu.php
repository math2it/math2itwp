<?php if ( has_nav_menu( 'herald_social_menu' ) ) : ?>
		<?php wp_nav_menu( array( 'theme_location' => 'herald_social_menu', 'container'=> '', 'menu_class' => 'herald-soc-nav', 'link_before' => '<span class="herald-social-name">',
'link_after' => '</span>', ) ); ?>
<?php endif; ?>