<?php


 //* Add custom body class to the head
add_filter( 'body_class', 'thegreenman_body_class' );
function thegreenman_body_class( $classes ) {
	
	$classes[] = 'author';
	return $classes;
	
}
	
/** Replace the standard loop with our custom loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop',  'sgr_author_info', 20);
/**
 * Function to display author details on the author archive page
 *
 * Here, we're hooking to genesis_before_loop so that it displays
 * above the posts output
 *
 * @author Ade Walker http://www.studiograsshopper.ch
 * @uses get_query_var()
 *
 * @return echo out the author's details
 */
 function sgr_author_info() {
	
    
    if( !is_author() ) return;
    
    if( get_query_var('author') ) {
		global $wp_query;
		$curauth = $wp_query->get_queried_object();
    }
    
    $bio = $curauth->description;
    $name = $curauth->display_name;
    $website = $curauth->user_url; 
    
       
	echo apply_filters('the_content', get_post_meta($author_id->ID, $bio, true));
    
	echo '<div class="entry">';
		echo '<p>' . $bio . '</p>';    
		//echo do_shortcode( get_the_author_meta( 'description' ) ); 
		echo '<p>All posts by : ' . $name . '</p>';

	echo '</div>';
	

		
	echo '</div>';	
		
		echo '<div class="standard-posts" >';				
		$query = new WP_Query($author_id );
				if (  $query->have_posts() ) :		
			echo '<h3 class="entry-title" style="text-align: center"> Recent Blog Posts</h3> ';
			//while (  $query->have_posts() ) :  $query->the_post();

			genesis_standard_loop();
			//endwhile;
		else:
		endif;	
			
		echo '</div>';	
		
	
}



genesis();
