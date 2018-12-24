<div class="site-branding">
	<?php
		global $herald_h1_used;
		$logo = herald_get_option('logo');
		$brand = !empty($logo) ? '<img class="herald-logo" src="'.esc_url( $logo ).'" alt="'.esc_attr(get_bloginfo( 'name' )).'" >' : get_bloginfo( 'name' );
	?>
	<?php if ( is_front_page() && empty($herald_h1_used) ) : ?>
		<h1 class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $brand; ?></a></h1>
	<?php else : ?>
		<span class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $brand; ?></a></span>
	<?php endif; ?>
</div>
<?php $herald_h1_used = true; ?>