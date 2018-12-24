<?php if ( has_nav_menu( 'herald_social_menu' ) ) : ?>
<div class="herald-menu-popup">
<span class="fa fa-share-alt"></span>
		<?php wp_nav_menu( array( 'theme_location' => 'herald_social_menu', 'container'=> '', 'menu_class' => 'herald-soc-nav herald-in-popup', 'link_before' => '<span class="herald-social-name">',
'link_after' => '</span>', ) ); ?>
</div>
<?php endif; ?>