<div id="herald-responsive-header" class="herald-responsive-header herald-slide hidden-lg hidden-md">
	<div class="container">
		<div class="herald-nav-toggle"><i class="fa fa-bars"></i></div>
		<?php $logo = herald_get_option('logo_mini') ? 'logo-mini' : 'logo'; ?>
		<?php get_template_part('template-parts/header/elements/'.$logo ); ?>
		<?php get_template_part('template-parts/header/elements/search-drop'); ?>
	</div>
</div>
<div class="herald-mobile-nav herald-slide hidden-lg hidden-md">
	<?php wp_nav_menu( array( 'theme_location' => 'herald_main_menu', 'container'=> '', 'menu_class' => 'herald-mob-nav', 'walker' => new herald_Menu_Walker ) ); ?>	
	<?php $responsive_elements =  array_keys( array_filter( herald_get_option( 'header_responsive_elements' ) ) ); ?>	
	<?php $group_link = herald_get_option( 'header_responsive_group' ); ?>

	<?php if ( $group_link ): ?>
		<ul class="herald-more-link-wrapper">
			<li class="herald-more-link">
				<a href="#"><?php echo __herald('responsive_more'); ?></a>
				<ul class="sub-menu">
				</ul>
				<span class="herald-menu-toggler fa fa-caret-down"></span>
			</li>
		</ul>
	<?php endif; ?>

	<?php foreach( $responsive_elements as $element ): ?>
			<?php get_template_part('template-parts/header/elements/' . $element ); ?>
	<?php endforeach; ?>
	
</div>