<article <?php post_class(); ?>>
<?php $msg = is_search() ? 'content_none_search' : 'content_none'; ?>
<p><?php echo __herald( $msg ); ?></p>
</article>