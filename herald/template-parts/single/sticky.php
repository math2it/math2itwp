<div id="single-sticky" class="herald-single-sticky herald-single-wraper hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				
				<?php if( herald_get_option('single_sticky_prevnext') ) : ?>					
					
					<?php $in_same_cat = herald_get_option('single_prevnext_same_cat'); ?>
					

					<?php if( $prev = get_next_post( $in_same_cat )): ?>
						<div class="herald-sticky-prev h6">
							<?php next_post_link('%link','%title', $in_same_cat); ?>
						</div>
					<?php endif; ?>

					<?php if( $prev = get_previous_post( $in_same_cat )): ?>
						<div class="herald-sticky-next h6">
							<?php previous_post_link('%link','%title', $in_same_cat); ?>
						</div>
					<?php endif; ?>

				<?php endif; ?>

					<div class="herald-sticky-share">
						
						<?php if( herald_get_option('single_sticky_comments')  && comments_open() ) : ?>

						<?php 
							ob_start();
							comments_popup_link( __herald( 'comment_action' ), __herald( 'comment_action' ), __herald( 'comment_action' ), 'herald-comment-action' );
							$comment_link = ob_get_contents();
							ob_end_clean();
							echo $comment_link; 
						?>
						
						<?php endif; ?>

						<?php if( herald_get_option('single_sticky_share') ) : ?>
							<?php get_template_part( 'template-parts/single/share' ); ?>
						<?php endif; ?>

					</div>

			</div>
		</div>
	</div>					
</div>