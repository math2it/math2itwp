<?php if ( $pagination = herald_numeric_pagination( __herald( 'previous_posts' ), __herald( 'next_posts' ) ) ) : ?>
	<nav class="herald-pagination">
		<?php echo $pagination; ?>
	</nav>
<?php endif; ?>

