<div class="herald-gray-area"><span class="herald-fake-button herald-comment-form-open"><?php echo __herald( 'comment_button' ); ?></span></div>

<?php

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$comment_form_args = array(
	'title_reply' => '',
	'label_submit' => __herald( 'comment_submit' ),
	'cancel_reply_link' => __herald( 'comment_cancel_reply' ),
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __herald( 'comment_text' ) .'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .'</textarea></p>'
);

?>

<?php comment_form( $comment_form_args ); ?>