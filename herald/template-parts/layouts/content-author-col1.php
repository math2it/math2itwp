<article class="herald-lay-a">
	<div class="row">
		<!--<div class="author-with-1"> -->
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
			<div>
				<?php echo $author_link_start; ?>
					<?php echo get_avatar( get_the_author_meta('ID', $author->ID), 120 ); ?>
				<?php echo $author_link_end; ?>
			</div>
		</div>

		<!-- <div class="author-with-2 "> -->
			<div class="col-lg-10 col-md-10 col-sm-9 col-xs-8 herald-no-pad">
			<div class="author-header">
				<h3 class="entry-title h3">
					<?php echo $author_link_start; ?>
						<?php the_author_meta('display_name', $author->ID); ?>
					<?php echo $author_link_end; ?>
				</h3>
			</div>
			<div class="entry-content">
				<?php $limit = isset($module['limit']) && !empty($module['limit']) ? herald_trim_chars( get_the_author_meta('description', $author->ID), $module['limit'] ) : get_the_author_meta('description', $author->ID); ?>
				<?php echo wpautop( $limit  ); ?>
			</div>
		</div>

	</div>
</article>
