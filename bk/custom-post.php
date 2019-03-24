<?php

// ---------------------------------------------------------------------
// Custom Post Type
// ---------------------------------------------------------------------
function create_my_custom_post() {
	register_post_type( 'my-custom-post',
    array(
			'labels' => array(
					'name' => __( 'My Custom Post' ),
					'singular_name' => __( 'My Custom Post' ),
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array(
					'title',
					'editor',
					'thumbnail',
				  'custom-fields'
      ),
      'taxonomies'   => array(
				'post_tag',
				'category',
			)
    )
  );
  register_taxonomy_for_object_type( 'category', 'my-custom-post' );
	register_taxonomy_for_object_type( 'post_tag', 'my-custom-post' );
}
add_action( 'init', 'create_my_custom_post' );