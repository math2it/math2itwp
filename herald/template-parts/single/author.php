<div id="author" class="herald-vertical-padding">
<?php 
		 
	if( herald_is_co_authors_active() && $coauthors_meta = get_coauthors() ) : ?>
	
	<?php foreach ($coauthors_meta as $key ) :  

		$args = array(
			'title' => '<h4 class="h6 herald-mod-h herald-color">'.__herald('about_author').'</h4>',
			'subnav' => herald_get_author_social( $key->ID ),
			'actions' => '<a href="'.esc_url( get_author_posts_url( $key->ID, $key->user_nicename) )  .'">'.__herald('view_all_posts').'</a>'
		);

		echo herald_print_heading( $args ); 
		?>

		<div class="herald-author row">

			<div class="herald-author-data col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<?php echo get_avatar( $key->user_email, 140 ); ?>
			</div>
			
			<div class="herald-data-content col-lg-10 col-md-10 col-sm-10 col-xs-10">
				<h4 class="author-title"><?php echo $key->display_name; ?></h4>
				<?php echo wpautop( $key->description );  ?>
			</div>

		</div>

	<?php endforeach; ?>

<?php else: ?>
	<?php  
	//<!-- no co authors plugin -->
	$args = array(
		'title' => '<h4 class="h6 herald-mod-h herald-color">'.__herald('about_author').'</h4>',
		'subnav' => herald_get_author_social( get_the_author_meta('ID') ),
		'actions' => '<a href="'.esc_url( get_author_posts_url(get_the_author_meta('ID'))).'">'.__herald('view_all_posts').'</a>'
	);

	echo herald_print_heading( $args ); 

	?>

	<div class="herald-author row">

		<div class="herald-author-data col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<?php echo get_avatar( get_the_author_meta('ID'), 140 ); ?>
		</div>
		
		<div class="herald-data-content col-lg-10 col-md-10 col-sm-10 col-xs-10">
			<h4 class="author-title"><?php the_author_meta('display_name'); ?></h4>
			<?php echo wpautop(get_the_author_meta('description')); ?>
		</div>

	</div>

<?php endif; ?>

</div>