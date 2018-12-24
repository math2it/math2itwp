<?php if( herald_get_option( 'single_infinite_scroll' ) && $next_link = get_previous_post_link('%link','%title', true) ) : ?>
	<nav class="herald-pagination herald-infinite-scroll-single">
		<?php echo $next_link; ?>
		<div class="herald-loader">
			<div class="spinner">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>			
		</div>
	</nav>
<?php endif; ?>