<?php $more_link = get_next_posts_link( __herald( 'load_more' ) ); ?>
<?php if ( !empty( $more_link ) ) : ?>
	<nav class="herald-pagination herald-infinite-scroll">
		<?php echo $more_link; ?>
		<div class="herald-loader">
			<div class="spinner">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>			
		</div>
	</nav>
<?php endif; ?>