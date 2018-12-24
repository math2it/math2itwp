<?php $meta_bar_position = herald_get_single_meta_bar_position(); ?>

<?php if( $meta_bar_position != 'none') : ?>

	<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs <?php echo esc_attr( 'herald-'.$meta_bar_position); ?>">

		<?php $meta_sticky_class = herald_get_option('single_meta_bar_sticky') ? 'entry-meta-wrapper-sticky' : ''; ?>
		
		<div class="entry-meta-wrapper <?php echo esc_attr( $meta_sticky_class ); ?>">

		<?php if( herald_get_option('single_meta_ad') == 'top' ) : ?>
			<div class="meta-ad"><?php echo do_shortcode( herald_get_option('ad_single_meta') ); ?></div>
		<?php endif; ?>

		<?php if(herald_get_option('single_avatar')): ?>
			<div class="entry-meta-author">					

			<?php if( herald_is_co_authors_active() && $coauthors_meta = get_coauthors() ) : ?>

				<?php foreach ($coauthors_meta as $key ) : ?>					
					<div class="co-author">
						<?php echo get_avatar( $key->user_email, 112 ); ?>
						<a class="herald-author-name" href="<?php echo esc_url( get_author_posts_url($key->ID, $key->user_nicename)); ?>"><?php echo $key->display_name; ?></a>

						<?php $author_links = herald_get_author_social_links( $key->ID ); ?>
						<?php if ( !empty( $author_links ) ) : ?>
							<?php echo wp_kses_post( $author_links ); ?>
						<?php endif; ?>
					
					</div> 

				<?php endforeach; ?>

			<?php else: ?>

				<?php echo get_avatar( get_the_author_meta('ID'), 112 ); ?>
				
				<a class="herald-author-name" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author_meta('display_name') ?></a>

				<?php $author_links = herald_get_author_social_links( get_the_author_meta('ID') ); ?>
				<?php if ( !empty($author_links) ) : ?>
					<?php echo wp_kses_post($author_links); ?>
				<?php endif; ?>

			<?php endif; ?>

			</div>

		<?php endif; ?>

		<?php if( $meta = herald_get_meta_data( 'single_big' ) ) : ?>
			<div class="entry-meta entry-meta-single"><?php echo $meta; ?></div>
		<?php endif; ?>

		<?php if( herald_get_option('single_share') ): ?>
			<?php get_template_part('template-parts/single/share'); ?>
		<?php endif; ?>

		<?php if( herald_get_option('single_meta_ad') == 'bottom' ) : ?>
			<div class="meta-ad"><?php echo do_shortcode(herald_get_option('ad_single_meta')); ?></div>
		<?php endif; ?>

		</div>

	</div>

<?php endif; ?>