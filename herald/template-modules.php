<?php
/**
 * Template Name: Modules
 */
?>
<?php get_header(); ?>

<?php if ( post_password_required() ) : ?>
    <?php get_template_part( 'template-parts/page/protected' ); ?>
<?php else: ?>

	<?php
		global $herald_sidebar_opts;
		$herald_modules_meta = herald_get_page_meta( get_the_ID() );
		$sections = $herald_modules_meta['sections'];
	?>

	<?php if ( !empty( $sections ) ) : ?>

		<?php 
			
			//Check if pagination is set and do required tweaks
			if( $herald_modules_meta['pag'] != 'none' ){
				
				$pagination = $herald_modules_meta['pag'];
				herald_set_paginated_module_index( $sections );
				$paged = herald_module_template_is_paged();
				
				if( $paged ){
					$sections = herald_parse_paged_module_template( $sections );
					herald_set_paginated_module_index( $sections, $paged );
				}
			}

		?>

		<?php foreach ( $sections as $s_ind => $section ) : ?>
		
			<?php 
				$herald_sidebar_opts = $section;
				$section_class = $section['use_sidebar'] == 'none' ? 'herald-no-sid ' : '';
				$section_class .= isset($section['css_class']) && !empty($section['css_class']) ? $section['css_class'] : '';
				$wrap_class = $section['use_sidebar'] != 'none' ? 'herald-main-content col-lg-9 col-md-9 col-mod-main' : 'col-lg-12 col-md-12';

			?>
			
			<div class="herald-section container <?php echo esc_attr( $section_class ); ?>" id="herald-section-<?php echo esc_attr( $s_ind ); ?>">

				<div class="row">

					<?php if( $herald_sidebar_opts['use_sidebar'] == 'left' ): ?>
						<?php get_template_part('sidebar'); ?>
					<?php endif; ?>
					
					<div class="<?php echo esc_attr( $wrap_class ); ?>">

						<div class="row">

							<?php if(!empty($section['modules'])): ?>

								<?php foreach( $section['modules'] as $m_ind => $module ): $module = herald_parse_args( $module, herald_get_module_defaults( $module['type'] ) ); ?>

									<?php if ( isset( $module['active'] ) && $module['active'] ) : ?>
											<?php $module_template = isset( $module['cpt'] ) ? 'cpt' : $module['type']; ?>
											<?php include( locate_template('template-parts/modules/'.$module_template.'.php') ); ?>
									<?php endif; ?>

								<?php endforeach; ?>

							<?php endif; ?>

						</div>

					</div>

					<?php if( $herald_sidebar_opts['use_sidebar'] == 'right' ): ?>
						<?php get_template_part('sidebar'); ?>
					<?php endif; ?>

				</div>

			</div>

		<?php endforeach; ?>

	<?php else: ?>

		<div class="herald-section container col-lg-12 col-md-12">

			<?php

				$args = array(
					'title' => '<h2 class="h6 herald-mod-h herald-color">'. esc_html__( 'Oooops!', 'herald' ).'</h2>',
					'desc' =>  wp_kses( sprintf( __( 'You don\'t have any sections and modules yet. Hurry up and <a href="%s">create your first module</a>.', 'herald' ), admin_url( 'post.php?post='.get_the_ID().'&action=edit#herald_modules' ) ), wp_kses_allowed_html( 'post' ))
				);

				echo herald_print_heading( $args );
			?>

		</div>

	<?php endif; ?>

<?php endif; ?>

<?php get_footer(); ?>