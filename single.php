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
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
				<div class="page-subtitle">
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
				</div>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>

<!-- main content -->
<article class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8 blog-content">
				<?php the_content(); ?>
				<?php if (get_field('show_author_box',$post_id)==true): ?>
				<div class="alignwide author-box">
					<div class="author-avatar">
						<?php 
							if(get_avatar_url(get_the_author_meta('ID'),50) !== FALSE): 
							$avatar = get_avatar_url(get_the_author_meta('ID'),100);
							?>
								<img src="<?php echo $avatar; ?>" alt="<?php the_author() ?>'s avatar'">
						<?php else: ?>
								<img src="<?php echo get_template_directory_uri() ?>/img/author.svg">
						<?php endif; ?>
					</div>
					<div class="author-info">
						<div class="author-name">
							<?php 
								$fname = get_the_author_meta('first_name');
								$lname = get_the_author_meta('last_name');
								$full_name = '';
								if( empty($fname)){
										$full_name = $lname;
								} elseif( empty( $lname )){
										$full_name = $fname;
								} else {
										//both first name and last name are present
										$full_name = "{$fname} {$lname}";
								}
								echo $full_name;
							?>
						</div>
						<div class="author-role">
							<?php echo get_field('user_role','user_'.get_the_author_meta('ID')) ?>
						</div>
						<div class="author-description">
							<?php echo nl2br(get_the_author_meta('description')); ?>
						</div>
						<div class="author-more">
							<a href="mailto:<?php echo get_the_author_meta('user_email') ?>"> 
								<i class="fa fa-envelope" aria-hidden="true"></i>
								Email cho <?php the_author() ?>
							</a> 
							<a class="author-post" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
								<i class="fa fa-files-o" aria-hidden="true"></i>
								Xem bài <?php the_author() ?> viết
							</a>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<?php
				if (get_field('toc_on_sidebar',$post_id)==true):
			?>
				<div class="toc-sidebar">
					<nav id="toc" data-toggle="toc" class="sticky-top">
						<div>Trong bài này</div>
					</nav>
				</div>
			<?php
				endif;
			?>
		</div>
	</div>
</article>

<?php 
	// endwhile; endif; 
?>

</main>

<?php get_footer(); ?>