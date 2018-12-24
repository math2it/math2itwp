<?php if ( has_post_thumbnail() ) : ?>
	<div class="meta-media">
		<?php $full_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
		<?php $pop_up_class = herald_get_option('popup_img') ? 'class="herald-image-format"' : '';  ?>
		<a href="<?php echo esc_url($full_img[0]); ?>" <?php echo $pop_up_class; ?>>
		<span class="herald-format-ico"><i class="fa fa-arrows-alt"></i></span>
			<?php get_template_part('template-parts/single/fimg'); ?>
		</a>
	</div>
<?php endif; ?>