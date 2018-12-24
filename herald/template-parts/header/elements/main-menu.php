<nav class="main-navigation herald-menu">	
	<?php if ( has_nav_menu( 'herald_main_menu' ) ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'herald_main_menu', 'container'=> '', 'walker' => new herald_Menu_Walker ) ); ?>
	<?php else: ?>
		<?php if ( current_user_can( 'manage_options' ) ): ?>
			<ul class="menu">
				<li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>"><?php esc_html_e( 'Click here to add navigation menu', 'herald' ); ?></a></li>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
</nav>