<?php get_header(); ?>

<main>

<?php 
// if ( have_posts() ) : 
// 	while ( have_posts() ) : 
	the_post();
	$post_id = get_the_ID();
	$first_cat = get_the_category($post_id);
	$rand_number = rand(0,count($first_cat)-1);
?>

<header class="header-page bg-cat-<?php echo $first_cat[$rand_number]->term_id; ?>">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10">
				<h1 class="page-title">
					<?php the_title(); ?>
				</h1>
				<div class="page-subtitle">
					<span>
						<i class="icon-folder-open-empty"></i>
						<a href="<?php echo esc_url( get_category_link( $first_cat[$rand_number]->term_id ) ) ?>"><?php echo $first_cat[$rand_number]->name; ?></a>
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
								$full_name = "{$lname} {$fname}";
						}
					?>
					<span>
						<i class="icon-user-outline"></i>
						<a class="author-post" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<?php echo $full_name; ?>
						</a>
					</span>
				</div>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>

<!-- main content -->
<article class="pt-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8 blog-content">
				<?php the_content(); ?>
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
		</div> <!-- /row -->
	</div> <!-- /container -->
</article>

</main>

<div class="extra-info">

<!-- tags -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10 col-xl-8">
			<div class="tags">
				<?php the_tags('',' ',''); ?>
			</div>
		</div>
	</div>
</div>

<!-- sharing buttons -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10 col-xl-8 blog-content">
			<div class="d-flex alignwide sharing-buttons">
				<div class="flex-fill">
					<?php 
						$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&title=' . get_the_title() . '';
					?>
					<a href="javascript:void(0)" onclick="atomicBlocksShare('<?php echo $facebook_url ?>','<?php echo get_the_title() ?>','600','600')" title="Share on facebook">
						<div class="item">
							<i class="fa fa-facebook" aria-hidden="true"></i> 
							Chia sẻ trên facebook
						</div>
					</a>
				</div>
				<div class="flex-fill">
					<?php 
						$email_url = 'mailto:?subject=' . get_the_title() . '&body=Một bài viết hay trên Math2IT: ' . get_the_title() . ' &mdash; ' . get_the_permalink() . '';
					?>
					<a href="<?php echo $email_url ?>" title="Share via email">
						<div class="item">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							Chia sẻ qua email
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function atomicBlocksShare( url, title, w, h ){
		var left = ( window.innerWidth / 2 )-( w / 2 );
		var top  = ( window.innerHeight / 2 )-( h / 2 );
		return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=600, top='+top+', left='+left);
	}
	
</script>


<!-- author's box -->
<?php if (get_field('show_author_box',$post_id)==true): ?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10 col-xl-8 blog-content">
			<div class="alignwide author-box">
				<div class="author-avatar">
					<?php 
						if(get_avatar_url(get_the_author_meta('ID'),50) !== FALSE): 
						$avatar = get_avatar_url(get_the_author_meta('ID'),array("size"=>200));
						?>
							<img src="<?php echo $avatar; ?>" alt="<?php the_author() ?>'s avatar'">
					<?php else: ?>
							<img src="<?php echo get_template_directory_uri() ?>/img/author.svg">
					<?php endif; ?>
				</div>
				<div class="author-info">
					<div class="author-name">
						<?php echo $full_name; ?>
					</div>
					<div class="author-role">
						<?php echo get_field('user_role','user_'.get_the_author_meta('ID')) ?>
					</div>
					<div class="author-description">
						<?php
						if (get_the_author_meta('description')){
							echo nl2br(get_the_author_meta('description')); 
						}else{
							echo "Một tác giả của Math2IT.";
						}
						?>
					</div>
					<div class="author-more">
						<a href="mailto:<?php echo get_the_author_meta('user_email') ?>"> 
							<i class="fa fa-envelope" aria-hidden="true"></i>
							Email cho <?php if ($fname){echo $fname;}else{ the_author();} ?>
						</a> 
						<a class="author-post" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<i class="fa fa-files-o" aria-hidden="true"></i>
							Xem bài <?php if ($fname){echo $fname;}else{ the_author();} ?> viết
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?><!-- /author-box -->


<!-- related posts -->
<div class="related-post">
<?php
	$tags = wp_get_post_tags($post_id);
	$tag_ids = array();
	set_query_var('typeTitle', 'middle'); 
	set_query_var('customTitle', 'Có thể bạn thích?');
	set_query_var('display_category', true);
	set_query_var('customURL', '/all' );
  $list_post_args = array(
		'tag__in' 					=> $tag_ids,
		'post__not_in' 			=> array($post_id),
		'posts_per_page'		=> 4,
		'orderby'          	=> 'rand',
		'post_status'      	=> 'publish'
  );
	$list_posts = get_posts($list_post_args);
	set_query_var('list_posts', $list_posts);
?>
<?php get_template_part( 'parts/cat-layout-photo-title' ); ?>
<?php wp_reset_query(); // reset ?>
</div>


<!-- comments -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10 col-xl-8">
			<div class="comment-section">
				<?php comments_template(); ?>
			</div> <!-- /comment-section -->
		</div>
	</div>
</div>

</div> <!-- /div extra info -->

<?php get_footer(); ?>