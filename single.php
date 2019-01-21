<?php get_header(); ?>

<main>

<?php 
// if ( have_posts() ) : 
// 	while ( have_posts() ) : 
	the_post();
	$post_id = get_the_ID();
	$first_cat = get_the_category($post_id);
?>

<header class="header-page bg-cat-<?php echo $first_cat[0]->term_id; ?>">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10">
				<h2 class="page-title">
					<?php the_title(); ?>
				</h2>
				<h4 class="page-subtitle">
					<span>
						<i class="icon-folder-open-empty"></i>
						<a href="<?php echo esc_url( get_category_link( $first_cat[0]->term_id ) ) ?>"><?php echo $first_cat[0]->name; ?></a>
					</span>
					<span>
						<i class="icon-clock"></i>
						<?php 
							date_default_timezone_set('Asia/Ho_Chi_Minh
							');
							$from = strtotime(get_the_date());
							$today = time();
							$difference = floor(($today - $from)/86400); // day
							if ($difference == 0):
								echo 'Vừa mới đăng';
							elseif ($difference < 7):
								echo $difference.' ngày trước';
							else:
								echo the_date('d-m-Y');
							endif;
						?> 
					</span>
					<span>
						<i class="icon-user-outline"></i>
						<?php the_author_posts_link('first_name'); ?>
					</span>
				</h4>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>

<article class="section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</article>

<?php 
	// endwhile; endif; 
?>

</main>

<?php get_footer(); ?>