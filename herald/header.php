<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>



	<header id="header" class="herald-site-header">

		<?php $header_sections = array_keys( array_filter( herald_get_option( 'header_sections' ) ) ); ?>
		<?php if ( !empty( $header_sections ) ): ?>
			<?php foreach ( $header_sections as $section ): ?>
				<?php get_template_part( 'template-parts/header/'.$section ); ?>
			<?php endforeach; ?>
		<?php endif; ?>

	</header>

	<?php if ( herald_get_option( 'header_sticky' ) ): ?>
		<?php get_template_part( 'template-parts/header/sticky' ); ?>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/header/responsive' ); ?>
	
    <?php get_template_part( 'template-parts/ads/below-header' ); ?>

	<div id="content" class="herald-site-content herald-slide">

	<?php if ( !is_front_page() ) { herald_breadcrumbs(); } ?>

