<?php

$share = array();

$title = herald_esc_text(wp_strip_all_tags(get_the_title()));
$url = herald_esc_url(get_the_permalink());

$share['facebook'] = '<a href="javascript:void(0);" data-url="http://www.facebook.com/sharer/sharer.php?u='.$url.'&amp;t='.$title.'"><i class="fa fa-facebook"></i><span>Facebook</span></a>';
$share['twitter'] = '<a href="javascript:void(0);" data-url="http://twitter.com/intent/tweet?url='.$url.'&amp;text='.$title.'"><i class="fa fa-twitter"></i><span>Twitter</span></a>';
$share['gplus'] = '<a href="javascript:void(0);" data-url="https://plus.google.com/share?url='.$url.'"><i class="fa fa-google-plus"></i><span>Google Plus</span></a>';
$pin_img = has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ) : '';
$pin_img = isset( $pin_img[0] ) ? $pin_img[0] : '';
$share['pinterest'] = '<a href="javascript:void(0);" data-url="http://pinterest.com/pin/create/button/?url='.$url.'&amp;media='.urlencode( esc_attr( $pin_img ) ).'&amp;description='.$title.'"><i class="fa fa-pinterest"></i><span>Pinterest</span></a>';
$share['linkedin'] = '<a href="javascript:void(0);" data-url="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$url.'&amp;title='.$title. '"><i class="fa fa-linkedin"></i><span>LinkedIn</span></a>';
$share['reddit'] = '<a href="javascript:void(0);"  data-url="http://www.reddit.com/submit?url='.$url.'&amp;title='.$title.'"><i class="fa fa-reddit-alien"></i><span>ReddIt</span></a>';
$share['email'] = '<a href="mailto:?subject='.$title.'&amp;body='.$url.'" class="no-popup"><i class="fa fa-envelope-o"></i><span>Email</span></a>';
$share['stumbleupon'] = '<a href="javascript:void(0);" data-url="http://www.stumbleupon.com/badge?url='.$url.'&amp;title='.$title.'"><i class="fa fa-stumbleupon"></i><span>StumbleUpon</span></a>';
$share['whatsapp'] = '<a href="https://api.whatsapp.com/send?text='.$title.' '.$url.'" class="no-popup"><i class="fa fa-whatsapp"></i><span>WhatsApp</span></a>';
$share['vkontakte'] = '<a href="javascript:void(0);"  class="herald-vKontakte" data-url="http://vk.com/share.php?url='.$url.'&amp;title='.$title.'"><i class="fa fa-vk"></i><span>vKontakte</span></a>';

$share_options = array_filter( herald_get_option( 'social_share' ) );

?>

<?php if ( !empty( $share_options ) ) : ?>

	<ul class="herald-share">
		<span class="herald-share-meta"><i class="fa fa-share-alt"></i><?php echo __herald( 'share_text' );?></span>
		<div class="meta-share-wrapper">
			<?php foreach ( $share_options as $social => $value ) : ?>
			     <li class="<?php echo esc_attr( $social ); ?>"> <?php echo $share[$social] ?> </li>
			<?php endforeach; ?>
	 	</div>
	</ul>

<?php endif; ?>