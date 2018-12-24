<?php if ( has_nav_menu( 'herald_secondary_menu_1' ) ) : ?>
<nav class="secondary-navigation herald-menu">	
		<?php wp_nav_menu( array( 'theme_location' => 'herald_secondary_menu_1', 'container'=> '' ) ); ?>
</nav>
<?php endif; ?>