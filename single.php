<?php
$post = $wp_query->post;

if ( in_category( 'tool' ) ) {
  include( TEMPLATEPATH.'/single-tool.php' );
} 
else {
  include( TEMPLATEPATH.'/single-normal.php' );
}
?>