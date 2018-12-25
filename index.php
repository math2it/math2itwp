<!-- wp:admin thi - pass: ctlae -->

<?php get_header(); ?>

<!-- intro -->
<?php get_template_part( 'parts/sec-idx-intro' ); ?>

<!-- math -->
<?php set_query_var('cat_id', 1); ?>
<?php set_query_var('left_or_right', 'left'); ?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); ?> <!-- reset -->

<!-- tech -->
<?php set_query_var('cat_id', 2); ?>
<?php set_query_var('left_or_right', 'right'); ?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); ?> <!-- reset -->

<!-- tech -->
<?php set_query_var('cat_id', 6); ?>
<?php set_query_var('left_or_right', 'left'); ?>
<?php get_template_part( 'parts/cat-layout-1-4' ); ?>
<?php wp_reset_query(); ?> <!-- reset -->

<!-- footer -->
<?php get_footer(); ?>


