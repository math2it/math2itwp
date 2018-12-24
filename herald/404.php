<?php get_header(); ?>

	<div class="herald-section container herald-no-sid">

	<article class="herald-page">

			<div class="row">
				<div class="herald-module col-lg-12 col-md-12 col-mod-single">
				
				<div class="herald-ovrld">

					<header class="entry-header">
						<h1 class="entry-title h1"><?php echo __herald( '404_title'); ?></h1>
					</header>	
					
					<div class="herald-page-thumbnail">

						<?php $img_404 = herald_get_option('image_404') ? herald_get_option('image_404') : herald_get_option('default_fimg'); ?>
						<?php if(!empty($img_404)): ?>
							<span><img src="<?php echo esc_url( $img_404 ); ?>"/></span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="col-lg-9 col-md-9 col-mod-single">
					<div class="entry-content herald-entry-content">					
						<h3 class="entry-title"><?php echo __herald( '404_subtitle'); ?></h3>
						<p><?php echo __herald( '404_text'); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div>

				</div>
			</div>	

		</article>	
	</div>

<?php get_footer(); ?>