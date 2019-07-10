<?php
/*
 * Template Name: Tool articles
 * Template Post Type: post
 */

	get_header();

	// post layout for tool posts
?>

<main>

<?php
// if ( have_posts() ) :
// 	while ( have_posts() ) :
	the_post();
	$post_id = get_the_ID();
	$first_cat = get_the_category($post_id);
	$rand_number = rand(0,count($first_cat)-1);
	$consider_cat = get_category_by_slug( 'tool' );
  $cat_id = $consider_cat->term_id;
?>

<?php
	if ( has_post_thumbnail($post_id) ) {
		$postThumbnail = get_the_post_thumbnail_url($post_id,'large' );
	}else{
		$postThumbnail = get_field('default_posts_feature_image',$first_cat[$rand_number]);
		$postThumbnail =  wp_get_attachment_url( $postThumbnail['id'],'large');
	}
?>

<header class="post-tool" style="background-image: url('<?php echo $postThumbnail; ?>');">
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
							$from = strtotime($post->post_date);
							$today = time();
							$difference = floor(($today - $from)/86400); // day
							if ((get_field('update',$post_id)==true) & $difference < 7):
								echo 'Mới cập nhật';
							elseif ($difference == 0):
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
				</div> <!-- /page-subtitle -->
				<p class="meta text-center mt-2">
					<?php if(get_field('tool_url',$post_id)){ ?>
            <a target="_blank" class="label home-page" href="<?php echo get_field('tool_url',$post_id); ?>">
              <i class="fa fa-link" aria-hidden="true"></i> Trang web
            </a>
          <?php } ?>
					<?php
            $field = get_field_object('pricing',$post_id);
            $value = $field['value'];
            $label = $field['choices'][ $value ]; ?>
            <span class="label pricing-<?php echo $value; ?>"><?php echo $label; ?></span>
          <?php
						$field = get_field_object('platform',$post_id);
						$values = $field['value'];
						if ($values){
							foreach ($values as $item){
								foreach ($field['choices'] as $value => $label) {
									if($label == $item){
										$value2 = $value;
										break;
									}
								}
            ?>
              <span class="label platform">
                <i class="icon-<?php echo $value2; ?>"></i>
                <?php echo $label; ?>
            </span>
          <?php }} ?>
				</p>
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div> <!-- /.container -->
</header>

<?php get_template_part( 'parts/subscribe-bar' ); ?>


<!-- main content -->
<article class="pt-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8 blog-content post-font">
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


	<!-- related posts -->
	<div class="related-post-tool">
	<?php
		set_query_var('cat_id', $cat_id);
		set_query_var('typeTitle', '');
		set_query_var('customTitle', 'Có thể bạn thích?');
		set_query_var('toolPosts', true);
	  $list_post_args = array(
			'category'         => $cat_id,
			'posts_per_page'		=> 4,
			'orderby'          	=> 'rand',
			'post_status'      	=> 'publish'
	  );
		$list_posts = get_posts($list_post_args);
		set_query_var('list_posts', $list_posts);
	?>
	<?php get_template_part( 'parts/cat-layout-photo-behind' ); ?>
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
