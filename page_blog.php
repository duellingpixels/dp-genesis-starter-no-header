<?php

/*
Template Name: Blog
*/
 //* Add custom body class to the head
add_filter( 'body_class', 'thegreenman_body_class' );
function thegreenman_body_class( $classes ) {
	
	$classes[] = 'blog';
	return $classes;
	
}
	
	//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
//remove_action ('get_header', 'the_archive_title'); 
genesis();
