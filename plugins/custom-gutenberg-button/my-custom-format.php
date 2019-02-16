<?php
/**
 * 3 buttons: <code></code>, <kbd></kbd>, <mark></mark>
*/

function my_custom_format_script_register() {
	wp_register_script(
		'my-custom-format-js',
		get_template_directory_uri() . '/plugins/custom-gutenberg-button/my-custom-format.js',
		array( 'wp-rich-text', 'wp-element', 'wp-editor' )
	);
}
add_action( 'init', 'my_custom_format_script_register' );

function my_custom_format_enqueue_assets_editor() {
	wp_enqueue_script( 'my-custom-format-js',
  get_template_directory_uri() . '/plugins/custom-gutenberg-button/my-custom-format.js');
}
add_action( 'enqueue_block_editor_assets', 'my_custom_format_enqueue_assets_editor' );