
<?php do_action('herald_before_end_content'); ?>

	</div>

    <?php get_template_part('template-parts/ads/above-footer'); ?>

	<footer id="footer" class="herald-site-footer herald-slide">

		<?php if( herald_get_option('footer_widgets') ): ?>
			<?php get_template_part('template-parts/footer/widgets' ); ?>
		<?php endif; ?>

		<?php if( herald_get_option('footer_bottom') ): ?>
			<?php get_template_part('template-parts/footer/bottom' ); ?>
	    <?php endif; ?>

	</footer>

	<?php if( herald_get_option('scroll_to_top') ) : ?>
		<a href="javascript:void(0)" id="back-top" class="herald-goto-top"><i class="fa fa-angle-up"></i></a>
	<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>