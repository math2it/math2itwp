<article class="herald-lay-d author-col-2">
	<div class="row">

		<div class="col-lg-2 col-xs-3 col-sm-3">
			<div>
				<?php echo $author_link_start; ?>
					<?php echo get_avatar( get_the_author_meta('ID', $author->ID), 80 ); ?>
				<?php echo $author_link_end; ?>
			</div>
		</div>

		<div class="col-lg-10 col-xs-8 col-sm-9 herald-no-pad">
			<div class="author-header-2">
				<h3 class="entry-title h5">
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
