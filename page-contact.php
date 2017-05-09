<?php

/*
Template Name: Contact Page
*/

//* This file handles pages, but only exists for the sake of child theme forward compatibility.

 //* Add custom body class to the head
add_filter( 'body_class', 'thegreenman_body_class_contact' );
function thegreenman_body_class_contact( $classes ) {
	
	$classes[] = 'contact';
	return $classes;
	
}

add_action( 'genesis_entry_header', 'genesis_do_post_title' ); 

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'contact_fields' );

		
//* Remove the post content and add our tabbed content
function contact_fields() {
	
?>	<div class="contact-address two-fifths first" >

	<?php
	echo do_shortcode('[contact-card]');//}
	 ?>
		
		</div> 
		
		<div class="three-fifths"> <?php	if( get_field('contact_page_message') ): 
			 the_field('contact_page_message'); 
		endif; 
			
		
		echo do_shortcode('[contact]' );?>
		
		</div><?php
	
		
		}
	

//add_action( 'genesis_loop', 'be_custom_loop' );
//remove_action( 'genesis_loop', 'genesis_do_loop' );


genesis();
