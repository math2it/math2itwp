<?php global $herald_sidebar_opts; ?>
<?php $section_class = $herald_sidebar_opts['use_sidebar'] == 'none' ? 'herald-no-sid' : '' ?>

<div class="herald-section container <?php echo esc_attr($section_class); ?>">

    <article id="post-<?php the_ID(); ?>" <?php post_class('herald-page'); ?>>

        <div class="row">

        <?php if($herald_sidebar_opts['use_sidebar'] == 'left'): ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>

        <div class="col-lg-9 col-mod-single col-mod-main">

            <header class="entry-header<?php echo (herald_has_clear_blur()) ? ' herald-clear-blur' : ''; ?>">
                <?php the_title( '<h1 class="entry-title h1">', '</h1>' ); ?>
            </header>

            <div class="entry-content herald-entry-content">
                <?php echo get_the_password_form(); ?>
            </div>

        </div>	

        <?php if( $herald_sidebar_opts['use_sidebar'] == 'right' ): ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>

    </article>
    
</div>