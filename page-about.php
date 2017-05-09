<?php

/*
Template Name: About
*/
 //* Add custom body class to the head
add_filter( 'body_class', 'thegreenman_body_class' );
function thegreenman_body_class( $classes ) {
	
	$classes[] = 'author';
	return $classes;
	
}


genesis();
