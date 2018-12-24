<article class="herald-lay-g author-col-3">
	<div class="row">
		
		<div class="col-lg-3 col-md-3 col-xs-4">
			<div>
				<?php echo $author_link_start; ?>
					<?php echo get_avatar( get_the_author_meta('ID', $author->ID), 80 ); ?>
				<?php echo $author_link_end; ?>
			</div>
		</div>

		<div class="col-lg-9 col-md-9 col-xs-8 herald-no-pad">
			<div class="author-header-2">
				<h3 class="entry-title h6">
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
