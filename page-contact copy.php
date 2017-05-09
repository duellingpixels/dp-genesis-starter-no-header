<?php



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
	
	if (  get_theme_mod( 'bwpy_titles' ) == 1 )  :
	?>	<h1 class="entry-title"> <?php  the_title();?> </h1> <?php 
		else :
	  
		endif;
	
?>
		
	<div class="contact-address one-third first" ><?php

	if( get_field('business_name', 'option') ): ?>
	    <div itemscope itemtype="http://schema.org/LocalBusiness"><a itemprop="url" href=" <?php echo  site_url() ?> "></a><div itemprop="name"><strong><?php the_field('business_name', 'option'); ?></strong></div>
	<?php endif;   
		
	echo '<p>';
	echo '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
	echo '<span itemprop="streetAddress">';	
		if( get_field('street_address', 'option') ): 
		$street_adress = the_field('street_address', 'option');  
		echo '</span></br>';
		endif;   

	echo '<span itemprop="addressLocality">';
		if( get_field('suburb', 'option') ): 
		$suburb = the_field('suburb', 'option'); 
		echo '</span></br>';
		endif;   
	
	echo '<span itemprop="addressRegion">';
		if( get_field('state', 'option') ): 
		$state = the_field('state', 'option'); 
		endif;   
	
	echo '<span itemprop="addressCountry">';
		if( get_field('country', 'option') ): 
		$country = the_field('country', 'option'); 
		endif;   
	
	echo '</span> <span itemprop="postalCode">';
		if( get_field('postcode', 'option') ): 
		$postcode = the_field('postcode', 'option'); 
		endif; 
	echo '</span>';	
	echo '</p>';	
	echo '<p> P ';
	echo '<span property="telephone">';
	if( get_field('phone_number', 'option') ): ?>
	<?php the_field('phone_number', 'option');
	echo '</span>';	
	 endif;   	
	echo '<br > M  ';	
	echo '<span property="telephone">';	
	if( get_field('mobile_number', 'option') ): ?>
	 <?php the_field('mobile_number', 'option'); ?></p> <?php 
	echo '</span>';	
	endif;  
	echo '</div>';
	?></div> </div> 
	
	<div class="two-thirds"> <?php	if( get_field('contact_message_above_form', 'option') ): 
		$postcode = the_field('contact_message_above_form', 'option'); 
	endif; 
		
	
	echo do_shortcode('[contact]' );?>
	
	</div><?php

	
	}




genesis();
