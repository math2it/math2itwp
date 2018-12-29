<?php

// =====================================================================
// Top choice posts
// cf. http://bit.ly/2ERWAvm
// =====================================================================


// Step 1: Add custom field to post edit screen in management page.
// ------------------------------------------------------
add_filter( 'manage_post_posts_columns', 'add_columns' );
/**
 * @param array $columns
 * @return array
*/
function add_columns( $columns ) {
    $columns['top_choice'] = 'Choice';
    return $columns;
}


// Step 2: Receive meta-data from database and set it to new column.
// ------------------------------------------------------
add_action( 'manage_posts_custom_column', 'columns_content', 10, 2 );
/**
 * Set content for columns in management page
 *
 * @param string $column_name
 * @param int $post_id
 *
 * @return void
 */
function columns_content( $column_name, $post_id ) {
    if ( 'top_choice' != $column_name ) {
        return;
    }
    $headline_news = get_post_meta( $post_id, 'top_choice', true );
    echo empty( $headline_news ) ? 'No': 'Yes';
}


// Step 3: Add Headline news checkbox to quick edit screen.
// ------------------------------------------------------
add_action( 'quick_edit_custom_box', 'quick_edit_add', 10, 2 );
/**
 * Add Headline news checkbox to quick edit screen
 *
 * @param string $column_name Custom column name, used to check
 * @param string $post_type
 *
 * @return void
 */
function quick_edit_add( $column_name, $post_type ) {
    if ( 'top_choice' != $column_name ) {
        return;
    }
    printf( '
        <input type="checkbox" name="top_choice" class="top_choice"> %s',
        'Make this post a post choice?'
    );
}


// Step 4: Save custom field to database.
// ------------------------------------------------------

add_action( 'save_post', 'save_quick_edit_data' );
 
/**
 * Save quick edit data
 *
 * @param int $post_id
 *
 * @return void|int
 */
function save_quick_edit_data( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) || 'post' != $_POST['post_type'] ) {
        return $post_id;
    }
 
    $data = empty( $_POST['top_choice'] ) ? 0 : 1;
    update_post_meta( $post_id, 'top_choice', $data );
}


// Step 5: By default, your checkbox can’t get its value, that’s why we have to write a javascript function to set value for it.
// ------------------------------------------------------

add_action( 'admin_footer', 'quick_edit_javascript' );

/**
 * Write javascript function to set checked to headline news checkbox
 *
 * @return void
 */
function quick_edit_javascript() {
    global $current_screen;

    if ( 'post' != $current_screen->post_type ) {
        return;
    }
?>
    <script type="text/javascript">
    function checked_headline_news( fieldValue ) {
        inlineEditPost.revert();
        jQuery( '.top_choice' ).attr( 'checked', 0 == fieldValue ? false : true );
    }
    </script>
<?php
}

// Step 6: Receive meta-data value of custom field and pass it to javascript function when user clicks expand quick edit link.
// ------------------------------------------------------

add_filter( 'post_row_actions', 'expand_quick_edit_link', 10, 2 );
/**
 * Pass headline news value to checked_headline_news javascript function
 *
 * @param array $actions
 * @param array $post
 *
 * @return array
 */
function expand_quick_edit_link( $actions, $post ) {
    global $current_screen;

    if ( 'post' != $current_screen->post_type ) {
        return $actions;
    }

    $data                               = get_post_meta( $post->ID, 'top_choice', true );
    $data                               = empty( $data ) ? 0 : 1;
    $actions['inline hide-if-no-js']    = '<a href="#" class="editinline" title="';
    $actions['inline hide-if-no-js']    .= esc_attr( 'Edit this item inline' ) . '"';
    $actions['inline hide-if-no-js']    .= " onclick=\"checked_headline_news('{$data}')\" >";
    $actions['inline hide-if-no-js']    .= 'Quick Edit';
    $actions['inline hide-if-no-js']    .= '</a>';

    return $actions;
}